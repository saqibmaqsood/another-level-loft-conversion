<?php
declare(strict_types=1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed.']);
    exit;
}

require_once __DIR__ . '/../panel/includes/db.php';
require_once __DIR__ . '/../panel/includes/mailer.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input || !is_array($input)) {
    $input = $_POST;
}

$userMessage = trim((string)($input['message'] ?? ''));
$sessionId   = trim((string)($input['session_id'] ?? ''));
$sourcePage  = trim((string)($input['page'] ?? $_SERVER['HTTP_REFERER'] ?? '/'));
$history     = is_array($input['history'] ?? null) ? $input['history'] : [];

if (empty($sessionId)) {
    $sessionId = 'chat_' . bin2hex(random_bytes(8));
}

if ($userMessage === '') {
    echo json_encode(['success' => false, 'error' => 'Empty message received.']);
    exit;
}

$db = getDB();

// 1. Fetch system settings
$settStmt = $db->query("SELECT key, value FROM settings");
$settings = $settStmt->fetchAll(PDO::FETCH_KEY_PAIR);

$chatEnabled     = ($settings['ai_chat_enabled'] ?? '1') === '1';
$openAiKey       = trim((string)($settings['openai_api_key'] ?? ''));
$openAiModel     = trim((string)($settings['openai_model'] ?? 'gpt-4o-mini'));
$botName         = trim((string)($settings['ai_chat_name'] ?? 'Sarah — Loft Specialist'));
$notifySurveyor  = ($settings['ai_chat_lead_notify'] ?? '1') === '1';
$surveyorEmail   = trim((string)($settings['surveyor_email'] ?? $settings['admin_notification_email'] ?? 'info@anotherlevelloftconversions.co.uk'));

if (!$chatEnabled) {
    echo json_encode([
        'success' => true,
        'reply'   => "Our live chat assistant is currently offline. Please give our team a call directly on 0800 0862744 or request a free survey via our booking form.",
        'session_id' => $sessionId,
        'disabled' => true
    ]);
    exit;
}

// Helper: Verify Postcode via UK Database and check North West service coverage
function lookupUKPostcode(string $rawPostcode): array {
    $clean = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $rawPostcode));
    if (strlen($clean) < 2) {
        return ['valid' => false];
    }
    
    $isOutcode = strlen($clean) <= 4;
    $apiUrl = $isOutcode 
        ? 'https://api.postcodes.io/outcodes/' . urlencode($clean)
        : 'https://api.postcodes.io/postcodes/' . urlencode($clean);

    $ctx = stream_context_create([
        'http' => [
            'timeout' => 3,
            'user_agent' => 'AnotherLevel-PostcodeVerifier/1.0',
            'ignore_errors' => true
        ]
    ]);

    $response = @file_get_contents($apiUrl, false, $ctx);
    if ($response) {
        $resData = json_decode($response, true);
        if (!empty($resData['status']) && $resData['status'] === 200 && !empty($resData['result'])) {
            $r = $resData['result'];
            $dist = $r['admin_district'] ?? '';
            $town = is_array($dist) ? implode(', ', $dist) : (string)$dist;
            if (empty($town)) {
                $town = $r['parish'] ?? $r['region'] ?? 'North West';
            }
            $county = is_array($r['admin_county'] ?? null) ? implode(', ', $r['admin_county']) : (string)($r['admin_county'] ?? '');
            $region = (string)($r['region'] ?? 'North West');
            $postcode = (string)($r['postcode'] ?? $r['outcode'] ?? $clean);

            // Check coverage across North West towns
            $nwKeywords = ['manchester', 'preston', 'bolton', 'bury', 'salford', 'trafford', 'stockport', 'oldham', 'rochdale', 'wigan', 'tameside', 'cheshire', 'warrington', 'halton', 'liverpool', 'sefton', 'st helens', 'wirral', 'knowsley', 'blackpool', 'fylde', 'lancaster', 'blackburn', 'burnley', 'chorley', 'ribble', 'lancashire', 'north west'];
            $fullCheck = strtolower($town . ' ' . $county . ' ' . $region);
            $isCovered = false;
            foreach ($nwKeywords as $kw) {
                if (strpos($fullCheck, $kw) !== false) {
                    $isCovered = true;
                    break;
                }
            }

            return [
                'valid'      => true,
                'postcode'   => $postcode,
                'town'       => $town,
                'county'     => $county,
                'region'     => $region,
                'is_covered' => $isCovered
            ];
        }
    }

    return ['valid' => false];
}

// 2. Retrieve existing conversation state first so memory is never lost
$existingStmt = $db->prepare("SELECT * FROM chat_conversations WHERE session_id = ? LIMIT 1");
$existingStmt->execute([$sessionId]);
$conv = $existingStmt->fetch(PDO::FETCH_ASSOC);

$knownName     = $conv['user_name'] ?? null;
$knownPhone    = $conv['user_phone'] ?? null;
$knownEmail    = $conv['user_email'] ?? null;
$knownPostcode = $conv['user_postcode'] ?? null;
$knownAddress  = $conv['user_address'] ?? null;
$knownTown     = $conv['area_town'] ?? null;
$leadCaptured  = (int)($conv['lead_captured'] ?? 0);

// 3. Extract any newly provided details from the current message
$postcodeVerificationContext = '';
if (preg_match('/\b([A-Z]{1,2}[0-9][0-9A-Z]?\s?[0-9][A-Z]{2})\b/i', $userMessage, $matches) || preg_match('/\b(PR|BL|M|SK|WA|WN|OL|FY|BB|CH|L)[0-9]{1,2}\b/i', $userMessage, $matches)) {
    $rawPc = $matches[0];
    $pcInfo = lookupUKPostcode($rawPc);
    if ($pcInfo['valid']) {
        $knownPostcode = $pcInfo['postcode'];
        $knownTown     = $pcInfo['town'];
        $coverageText  = $pcInfo['is_covered'] ? "IN CORE COVERAGE AREA (North West) ✅" : "OUTSIDE CORE NORTH WEST REGION ⚠️";
        $postcodeVerificationContext = "SYSTEM POSTCODE VERIFICATION: Visitor provided '{$knownPostcode}', located in '{$pcInfo['town']}', {$pcInfo['county']} ({$pcInfo['region']}). Service Coverage Status: {$coverageText}. Explicitly acknowledge this town/area in your reply!";
    } else {
        $knownPostcode = strtoupper(trim($rawPc));
    }
}

// Phone extraction
if (preg_match('/(?:(?:\+44\s?|0)(?:7\d{3}|1\d{3}|2\d{2}|3\d{2}|800)\s?\d{3}\s?\d{3,4})|(?:0\d{9,10})|(?:\b0[0-9]{6,11}\b)/i', $userMessage, $matches)) {
    $knownPhone = preg_replace('/\s+/', ' ', trim($matches[0]));
}

// Email extraction
if (preg_match('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}\b/', $userMessage, $matches)) {
    $knownEmail = strtolower(trim($matches[0]));
}

// Name extraction
if (preg_match('/(?:my name is|i am|i\'m|this is)\s+([A-Za-z]{2,20}(?:\s+[A-Za-z]{2,20})?)/i', $userMessage, $matches)) {
    $knownName = ucwords(trim($matches[1]));
} elseif (preg_match('/^[A-Za-z]{2,20}(?:\s+[A-Za-z]{2,20})?$/', trim($userMessage)) && !preg_match('/\b(hi|hello|hey|yes|no|ok|okay|cost|price|quote|bolton|preston|manchester|cheshire|survey|book|thanks|thank you|help|semi|detached|terraced|terrace|bungalow|house|home|loft|roof|bedroom|room|office)\b/i', trim($userMessage))) {
    $knownName = ucwords(trim($userMessage));
}

// Address extraction (if street or house number provided)
if (preg_match('/\b\d+\s+([A-Za-z0-9\s,]+(?:road|rd|street|st|avenue|ave|lane|ln|close|cl|drive|dr|way|grove|crescent|place|terrace))\b/i', $userMessage, $matches)) {
    $knownAddress = trim($matches[0]);
}

// 4. Build Dynamic Dossier of already-collected info to prevent repetitive questions
$visitorDossier = "CURRENT VISITOR DOSSIER (ALREADY COLLECTED IN THIS CHAT):\n";
$visitorDossier .= "- Homeowner Name: " . ($knownName ? "{$knownName} (ALREADY PROVIDED - DO NOT ASK AGAIN)" : "Not yet provided") . "\n";
$visitorDossier .= "- Postcode & Area: " . ($knownPostcode ? "{$knownPostcode}" . ($knownTown ? " (Town/Area: {$knownTown})" : "") . " (ALREADY PROVIDED & VERIFIED - DO NOT ASK AGAIN)" : "Not yet provided") . "\n";
$visitorDossier .= "- Mobile / Phone: " . ($knownPhone ? "{$knownPhone} (ALREADY PROVIDED - DO NOT ASK AGAIN)" : "Not yet provided") . "\n";
$visitorDossier .= "- Full Street Address: " . ($knownAddress ? "{$knownAddress} (ALREADY PROVIDED - DO NOT ASK AGAIN)" : "Not yet provided") . "\n";

// 5. Process AI Response (OpenAI or Rule-based fallback)
$reply = '';
$usedFallback = false;

if (!empty($openAiKey)) {
    $systemPrompt = "You are {$botName}, a friendly, down-to-earth, and highly experienced Senior Loft Specialist at Another Level Loft Conversions (NW) Ltd.
You are chatting live with a homeowner. Your communication must feel 100% human, authentic, warm, and natural — exactly like an experienced specialist chatting on WhatsApp. Never sound like a robot, AI script, or marketing brochure.

======================================================================
STRICT BUSINESS SCOPE & OUT-OF-BOUNDS TOPIC GUARDRAIL (ABSOLUTE RULE):
You represent Another Level Loft Conversions. Your ONLY job is to advise homeowners about converting their loft, roof spaces, dormers, and home extensions.

YOU MUST NEVER DISCUSS OR HELP WITH UNRELATED TOPICS:
- NEVER discuss or assist with: website creation, WordPress, coding, programming, SEO, tech support, general business, recipes, homework, essays, medical, politics, or any subject outside of home loft conversions!
- IF A VISITOR ASKS ABOUT ANYTHING UNRELATED (e.g. 'can you help me create website', 'how to make pizza', 'write a poem', 'coding python'):
  1. DO NOT ANSWER THEIR OFF-TOPIC QUESTION. Do NOT provide lists, guides, tools, or recommendations for outside topics!
  2. POLITELY DECLINE AND PIVOT IMMEDIATELY BACK TO LOFT CONVERSIONS:
     Say something like:
     'I’m exclusively here to assist with bespoke loft conversions and home extensions at Another Level! I can’t help with [topic], but if you’re ever looking to add an extra bedroom, bathroom, or dormer to your home, I’d love to help. Do you have a loft project in mind?'
======================================================================

{$visitorDossier}
" . ($postcodeVerificationContext ? "\n{$postcodeVerificationContext}\n" : "") . "

CRITICAL RULES TO PREVENT REPETITIVE QUESTIONS:
1. NEVER ASK FOR ANY DETAIL THAT HAS ALREADY BEEN COLLECTED IN THE DOSSIER ABOVE!
   - If Postcode is ALREADY collected (e.g. {$knownPostcode}), DO NOT ASK FOR POSTCODE AGAIN UNDER ANY CIRCUMSTANCES!
   - If Phone is ALREADY collected (e.g. {$knownPhone}), DO NOT ASK FOR PHONE AGAIN!
   - If Name is ALREADY collected (e.g. {$knownName}), address them warmly by name and DO NOT ASK FOR NAME AGAIN!
2. POSTCODE & AREA VERIFICATION:
   When a user shares their postcode (or if newly verified above), explicitly confirm the town and service area (e.g. 'Great news, {Town} is right in our core North West service area where our installation teams work every week!').
3. FOCUS ONLY ON THE NEXT MISSING PIECE:
   - If we have Postcode and Name, ask for their Mobile Number so we can confirm survey times.
   - If we have Postcode, Name, and Mobile, ask for their full street address and whether a weekday morning, afternoon, or Saturday suits them best for a quick 20-minute survey.
4. Keep replies concise, conversational, and friendly (2-3 short sentences).

CORE ACCURATE COMPANY FACTS:
- Velux Rooflight: ~£25,000 – £35,000
- Rear Dormer (most popular): ~£38,000 – £52,000 (full standing height master bedroom + ensuite)
- Hip-to-Gable: ~£42,000 – £56,000 (ideal for semi-detached)
- Mansard / L-shape Wrap-around: £48,000 – £65,000+
- Built in 4 to 6 weeks on site with external scaffold access (minimal disruption).
- 10-Year Insurance-Backed Structural Guarantee.
- 85%+ lofts fall under Permitted Development (no full planning needed). We handle all drawings, structural engineering, and building control sign-offs.
- Free, zero-obligation 20-minute feasibility survey with fixed quotes.";

    $messages = [
        ['role' => 'system', 'content' => $systemPrompt]
    ];

    // Include recent history (up to last 20 messages so full context is preserved)
    if (!empty($history)) {
        $recent = array_slice($history, -20);
        foreach ($recent as $h) {
            $r = ($h['sender'] ?? 'user') === 'bot' ? 'assistant' : 'user';
            $c = trim((string)($h['text'] ?? ''));
            if ($c !== '') {
                $messages[] = ['role' => $r, 'content' => $c];
            }
        }
    }

    $messages[] = ['role' => 'user', 'content' => $userMessage];

    $payload = json_encode([
        'model' => $openAiModel,
        'messages' => $messages,
        'temperature' => 0.7,
        'max_tokens' => 350
    ]);

    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_TIMEOUT, 8);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $openAiKey
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($response && $httpCode === 200) {
        $data = json_decode($response, true);
        $reply = trim((string)($data['choices'][0]['message']['content'] ?? ''));
    } else {
        error_log("OpenAI API call failed (HTTP {$httpCode}): {$curlError} - falling back to rule engine.");
        $usedFallback = true;
    }
} else {
    $usedFallback = true;
}

// 4. Rule-Based Fallback Knowledge Engine if OpenAI was not configured or failed
if (empty($reply)) {
    $msgLower = strtolower($userMessage);

    // If user provided a phone number directly
    if ($extractedPhone !== null) {
        $nameGreeting = $extractedName ? " {$extractedName}" : "";
        $reply = "Thanks so much{$nameGreeting}! I've passed your phone number to our senior surveying team. We'll be in touch shortly to chat through your loft ideas and answer any questions you have. If you have a preferred time or day to speak, just let me know!";
    }
    // If user provided just their name (e.g. "saqib")
    elseif ($extractedName !== null && strlen($userMessage) < 25 && !preg_match('/\b(cost|price|quote|how long|planning|survey)\b/i', $msgLower)) {
        $reply = "Hi {$extractedName}! Lovely to meet you. Are you thinking about adding a master bedroom, extra ensuite, or home office to your loft? What type of property do you have (e.g. semi-detached, terraced)?";
    }
    // Conversational Affirmations (yes / sure / ok)
    elseif (preg_match('/^(yes|yeah|yep|sure|ok|okay|definitely|absolutely)\b/i', $msgLower)) {
        $reply = "Brilliant! To help give you the best advice, what's your postcode or what style of house is it (semi-detached, terraced, or detached)?";
    }
    // Conversational Negations (no / not yet)
    elseif (preg_match('/^(no|nope|not yet|maybe)\b/i', $msgLower)) {
        $reply = "No problem at all! Feel free to ask me anything about typical costs, how long the work takes, or planning permission whenever you're ready.";
    }
    // Politeness / thanks
    elseif (preg_match('/\b(thanks|thank you|thx|cheers)\b/i', $msgLower)) {
        $reply = "You're very welcome! If any other questions come to mind or you'd like our surveyor to pop by for a free look, just drop a message anytime.";
    }
    // How are you
    elseif (preg_match('/\b(how are you|how r u|how are u|hows it going|how\'s it going)\b/i', $msgLower)) {
        $reply = "I'm doing really well, thank you for asking! How are you doing today? Are you exploring some loft conversion ideas for your home?";
    }
    // Property style response (semi-detached, terraced, detached, bungalow)
    elseif (preg_match('/\b(semi|semi-detached|terraced|terrace|detached|bungalow|townhouse)\b/i', $msgLower)) {
        $reply = "Semi-detached and terraced homes are our absolute specialty! On a semi-detached, a **Hip-to-Gable with a Rear Dormer** creates huge space for a master bedroom and ensuite without needing full planning permission. Would you like a ballpark cost or should we check if your postcode qualifies for a free survey?";
    }
    // Cost / Pricing
    elseif (preg_match('/\b(cost|price|quote|how much|pricing|estimate|rates|fee)\b/i', $msgLower)) {
        $reply = "Loft conversion costs typically depend on your roof shape and desired layout:\n\n"
               . "• **Velux / Rooflight**: £25,000 – £35,000\n"
               . "• **Rear Dormer**: £38,000 – £52,000 (adds full standing height + master ensuite)\n"
               . "• **Hip-to-Gable**: £42,000 – £56,000 (ideal for 1930s semi-detached)\n"
               . "• **Mansard / Wrap-Around**: £48,000 – £65,000+\n\n"
               . "All our projects come with a 10-Year Insurance-Backed Guarantee. Would you like to check if your roof qualifies for a free survey?";
    }
    // Time / Duration
    elseif (preg_match('/\b(how long|time|weeks|duration|timeline|schedule|start)\b/i', $msgLower)) {
        $reply = "A typical loft conversion takes just **4 to 6 weeks on site** from start to final sign-off. The first few weeks of structural timber and steel installation are accessed entirely via external scaffolding, keeping interior disruption to your home at an absolute minimum!";
    }
    // Planning Permission
    elseif (preg_match('/\b(planning|permission|permitted development|council|regulations|building control)\b/i', $msgLower)) {
        $reply = "Great news — over **85% of our loft conversions** (including most rear dormers and Velux lofts) fall under **Permitted Development rights** and do not need full planning permission! We manage all architectural drawings, structural engineering calculations, and Council Building Regulations sign-offs from start to finish.";
    }
    // Locations / Areas covered
    elseif (preg_match('/\b(area|areas|location|locations|cover|manchester|preston|cheshire|bolton|bury|altrincham|wilmslow|merseyside|lancashire|warrington|wigan|chorley)\b/i', $msgLower)) {
        $reply = "Yes, we cover the entire North West! We regularly convert lofts across Greater Manchester, Preston, Cheshire, Bolton, Bury, Altrincham, Wilmslow, Warrington, Chorley, and surrounding towns. What is your postcode so I can confirm for you?";
    }
    // Types of conversions
    elseif (preg_match('/\b(dormer|hip to gable|velux|mansard|wrap around|types|options)\b/i', $msgLower)) {
        $reply = "We specialise in all conversion types: Rear Dormers (maximum head height), Hip-to-Gable (expands sloping hip roofs into vertical walls), Velux (simplest & most cost-effective), and Mansards. If you're unsure which suits your property, our surveyor can inspect your roof rafters free of charge!";
    }
    // Booking / Appointment
    elseif (preg_match('/\b(book|survey|appointment|visit|free survey|consultation)\b/i', $msgLower)) {
        $reply = "We'd love to arrange a Free Architectural Loft Survey for you! Simply leave your phone number and postcode right here, or call our team directly on freephone 0800 0862744.";
    }
    // Contact / Phone / Talk
    elseif (preg_match('/\b(call|phone|number|contact|speak|human|agent)\b/i', $msgLower)) {
        $reply = "You can speak with our friendly team directly on freephone **0800 0862744** or Preston line **01772 978 775** (Mon–Sat 8am–6pm). Or feel free to drop your phone number here and we'll call you right back!";
    }
    // Greetings
    elseif (preg_match('/\b(hi|hello|hey|good morning|good afternoon|good evening|hiya)\b/i', $msgLower)) {
        $reply = "Hello! Welcome to Another Level Loft Conversions. I'm Sarah, your Loft Specialist. Are you thinking about adding an extra bedroom, home office, or master ensuite to your loft? How can I help you today?";
    }
    // General conversational fallback
    else {
        $reply = "I'd love to help you with that! I can give you quick ballpark costs, check if you need planning permission, or book a free architectural survey for your home. What would you like to know more about?";
    }
}

// 5. Database: Save or Update Conversation in `chat_conversations`
try {
    $existingStmt = $db->prepare("SELECT id, user_name, user_phone, user_email, user_postcode, transcript, lead_captured FROM chat_conversations WHERE session_id = ? LIMIT 1");
    $existingStmt->execute([$sessionId]);
    $conv = $existingStmt->fetch(PDO::FETCH_ASSOC);

    $transcriptArray = [];
    if ($conv && !empty($conv['transcript'])) {
        $transcriptArray = json_decode($conv['transcript'], true) ?: [];
    }

    // Append current turn
    $transcriptArray[] = [
        'sender' => 'user',
        'text' => $userMessage,
        'time' => date('Y-m-d H:i:s')
    ];
    $transcriptArray[] = [
        'sender' => 'bot',
        'text' => $reply,
        'time' => date('Y-m-d H:i:s')
    ];

    $userName     = $knownName;
    $userPhone    = $knownPhone;
    $userEmail    = $knownEmail;
    $userPostcode = $knownPostcode;
    $userAddress  = $knownAddress;
    $userTown     = $knownTown;

    // 6. Lead Capture: If we now have a phone number or email and hasn't been captured yet
    if (($userPhone !== null || $userEmail !== null) && $leadCaptured === 0) {
        $leadRef = 'AL-CHAT-' . strtoupper(substr(uniqid(), -5));
        $custName = $userName ?: 'Live Chat Visitor';

        $leadStmt = $db->prepare("
            INSERT INTO bookings (
                reference_id, name, phone, email, postcode,
                address, property_type, loft_height, preferred_date, preferred_slot,
                status, internal_notes, source_page, ip_address, device_type,
                created_at, updated_at
            ) VALUES (
                ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?,
                'New', ?, ?, ?, ?,
                datetime('now'), datetime('now')
            )
        ");

        $ipAddress  = getClientIP();
        $userAgent  = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $deviceType = getDeviceType($userAgent);

        $notes = "Captured automatically via AI Live Chat on {$sourcePage}.\nTown/Area: " . ($userTown ?: 'Not specified') . "\nUser initial query: {$userMessage}";

        $leadStmt->execute([
            $leadRef,
            $custName,
            $userPhone ?: '',
            $userEmail ?: '',
            $userPostcode ?: '',
            $userAddress ?: '',
            'Loft Conversion (Live Chat)',
            'Not specified',
            date('Y-m-d', strtotime('+3 days')),
            'Flexible',
            $notes,
            $sourcePage,
            $ipAddress,
            $deviceType
        ]);

        $leadCaptured = 1;

        // Dispatch surveyor notification if enabled
        if ($notifySurveyor && !empty($surveyorEmail)) {
            $subject = "🔥 High-Intent Live Chat Lead Captured: {$custName} ({$leadRef})";
            $htmlBody = "
            <div style='font-family:Arial,sans-serif;max-width:600px;margin:0 auto;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;'>
                <div style='background:#4F6B42;padding:20px;color:#ffffff;'>
                    <h2 style='margin:0;font-size:20px;'>New AI Live Chat Lead Captured</h2>
                    <p style='margin:4px 0 0;font-size:14px;opacity:0.9;'>Reference: <strong>{$leadRef}</strong></p>
                </div>
                <div style='padding:24px;background:#ffffff;'>
                    <p style='font-size:15px;color:#2D3748;'>A website visitor has just requested details or provided contact info via the AI Live Chat:</p>
                    <table style='width:100%;border-collapse:collapse;margin:16px 0;font-size:14px;'>
                        <tr><td style='padding:8px;border-bottom:1px solid #edf2f7;font-weight:bold;color:#4A5568;'>Name:</td><td style='padding:8px;border-bottom:1px solid #edf2f7;'>{$custName}</td></tr>
                        <tr><td style='padding:8px;border-bottom:1px solid #edf2f7;font-weight:bold;color:#4A5568;'>Phone:</td><td style='padding:8px;border-bottom:1px solid #edf2f7;font-weight:bold;color:#4F6B42;'><a href='tel:{$userPhone}'>{$userPhone}</a></td></tr>
                        " . ($userEmail ? "<tr><td style='padding:8px;border-bottom:1px solid #edf2f7;font-weight:bold;color:#4A5568;'>Email:</td><td style='padding:8px;border-bottom:1px solid #edf2f7;'>{$userEmail}</td></tr>" : "") . "
                        " . ($userPostcode ? "<tr><td style='padding:8px;border-bottom:1px solid #edf2f7;font-weight:bold;color:#4A5568;'>Postcode:</td><td style='padding:8px;border-bottom:1px solid #edf2f7;'>{$userPostcode} (" . htmlspecialchars($userTown ?: 'North West') . ")</td></tr>" : "") . "
                        " . ($userAddress ? "<tr><td style='padding:8px;border-bottom:1px solid #edf2f7;font-weight:bold;color:#4A5568;'>Address:</td><td style='padding:8px;border-bottom:1px solid #edf2f7;'>{$userAddress}</td></tr>" : "") . "
                        <tr><td style='padding:8px;border-bottom:1px solid #edf2f7;font-weight:bold;color:#4A5568;'>Source Page:</td><td style='padding:8px;border-bottom:1px solid #edf2f7;'>{$sourcePage}</td></tr>
                        <tr><td style='padding:8px;border-bottom:1px solid #edf2f7;font-weight:bold;color:#4A5568;'>Timestamp:</td><td style='padding:8px;border-bottom:1px solid #edf2f7;'>" . date('d M Y, H:i') . "</td></tr>
                    </table>
                    <div style='margin-top:20px;text-align:center;'>
                        <a href='http://" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . "/panel/bookings.php' style='display:inline-block;padding:12px 24px;background:#4F6B42;color:#ffffff;text-decoration:none;border-radius:6px;font-weight:bold;'>View Lead in Admin Panel</a>
                    </div>
                </div>
            </div>";

            @sendRawEmail($surveyorEmail, $subject, $htmlBody, 'Surveying Team');
        }
    } elseif ($leadCaptured === 1) {
        // Lead already created earlier in session: keep updating name, email, postcode, address in bookings
        try {
            $upBooking = $db->prepare("
                UPDATE bookings 
                SET name = CASE WHEN (? != '' AND (name = 'Live Chat Visitor' OR name = '')) THEN ? ELSE name END,
                    email = CASE WHEN (? != '' AND email = '') THEN ? ELSE email END,
                    postcode = CASE WHEN (? != '' AND (postcode = '' OR postcode IS NULL)) THEN ? ELSE postcode END,
                    address = CASE WHEN (? != '' AND (address = '' OR address IS NULL)) THEN ? ELSE address END,
                    updated_at = datetime('now')
                WHERE phone = ? OR (email != '' AND email = ?)
            ");
            $upBooking->execute([
                $userName ?: '', $userName ?: '',
                $userEmail ?: '', $userEmail ?: '',
                $userPostcode ?: '', $userPostcode ?: '',
                $userAddress ?: '', $userAddress ?: '',
                $userPhone ?: '', $userEmail ?: ''
            ]);
        } catch (Throwable $e) {}
    }

    $transcriptJson = json_encode($transcriptArray, JSON_UNESCAPED_UNICODE);
    $msgCount = count($transcriptArray);

    if ($conv) {
        $upStmt = $db->prepare("
            UPDATE chat_conversations 
            SET user_name = ?, user_phone = ?, user_email = ?, user_postcode = ?, 
                user_address = ?, area_town = ?,
                transcript = ?, message_count = ?, lead_captured = ?, updated_at = datetime('now')
            WHERE session_id = ?
        ");
        $upStmt->execute([$userName, $userPhone, $userEmail, $userPostcode, $userAddress, $userTown, $transcriptJson, $msgCount, $leadCaptured, $sessionId]);
    } else {
        $inStmt = $db->prepare("
            INSERT INTO chat_conversations (
                session_id, user_name, user_phone, user_email, user_postcode,
                user_address, area_town, message_count, lead_captured, source_page, transcript, created_at, updated_at
            ) VALUES (
                ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?, datetime('now'), datetime('now')
            )
        ");
        $inStmt->execute([$sessionId, $userName, $userPhone, $userEmail, $userPostcode, $userAddress, $userTown, $msgCount, $leadCaptured, $sourcePage, $transcriptJson]);
    }

    // 7. Track analytics event
    $ipAddress  = getClientIP();
    $userAgent  = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $deviceType = getDeviceType($userAgent);
    $browser    = getBrowserName($userAgent);
    $isBot      = isBotUserAgent($userAgent) ? 1 : 0;
    $referrer   = trim((string)($_SERVER['HTTP_REFERER'] ?? ''));
    $trafficSrc = determineTrafficSource($referrer, $sourcePage);

    $evtStmt = $db->prepare("
        INSERT INTO events_tracking (
            event_type, event_target, source_page,
            ip_address, device_type, browser, referrer,
            traffic_source, duration_seconds, is_bot, session_id,
            created_at
        ) VALUES (
            'chat_message', 'ai_live_chat', ?,
            ?, ?, ?, ?,
            ?, 0, ?, ?,
            datetime('now')
        )
    ");
    $evtStmt->execute([$sourcePage, $ipAddress, $deviceType, $browser, $referrer, $trafficSrc, $isBot, $sessionId]);

} catch (Throwable $e) {
    error_log("Error in chat persistence: " . $e->getMessage());
}

echo json_encode([
    'success' => true,
    'reply' => $reply,
    'session_id' => $sessionId,
    'lead_captured' => $leadCaptured ?? 0,
    'fallback' => $usedFallback
]);
