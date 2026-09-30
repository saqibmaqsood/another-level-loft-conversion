<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();
$db = getDB();
require_once __DIR__ . '/includes/mailer.php';

// Handle Template Updates or Broadcasts
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action'])) {
    if (!validateCSRF($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash_msg'] = 'Security validation failed.';
        $_SESSION['flash_type'] = 'error';
    } else {
        if ($_POST['action'] === 'update_template') {
            $tKey     = trim($_POST['template_key'] ?? '');
            $tSubject = trim($_POST['subject'] ?? '');
            $tBody    = trim($_POST['body_html'] ?? '');

            if (!empty($tKey) && !empty($tSubject) && !empty($tBody)) {
                $stmt = $db->prepare("
                    UPDATE email_templates 
                    SET subject = ?, body_html = ?, updated_at = datetime('now') 
                    WHERE template_key = ?
                ");
                $stmt->execute([$tSubject, $tBody, $tKey]);
                $_SESSION['flash_msg'] = "Template '{$tKey}' saved successfully.";
                $_SESSION['flash_type'] = 'success';
            }
        } elseif ($_POST['action'] === 'send_broadcast') {
            $targetGroup = trim($_POST['target_group'] ?? 'all');
            $bSubject    = trim($_POST['broadcast_subject'] ?? '');
            $bBody       = trim($_POST['broadcast_body'] ?? '');

            if (!empty($bSubject) && !empty($bBody)) {
                if ($targetGroup === 'all') {
                    $leadsStmt = $db->query("
                        SELECT DISTINCT email, name FROM bookings WHERE email IS NOT NULL AND email != ''
                        UNION
                        SELECT DISTINCT email, name FROM contacts WHERE email IS NOT NULL AND email != ''
                    ");
                } else {
                    $leadsStmt = $db->query("
                        SELECT DISTINCT email, name FROM bookings 
                        WHERE email IS NOT NULL AND email != '' AND status = " . $db->quote($targetGroup)
                    );
                }
                $recipients = $leadsStmt ? $leadsStmt->fetchAll(PDO::FETCH_ASSOC) : [];

                $sentCount = 0;
                $isHtml = (strpos($bBody, '<div') !== false || strpos($bBody, '<p') !== false || strpos($bBody, '<ul') !== false || strpos($bBody, '<table') !== false);

                foreach ($recipients as $rec) {
                    $rawName = trim((string)($rec['name'] ?? ''));
                    $displayName = !empty($rawName) ? $rawName : 'Valued Homeowner';
                    
                    $personalized = str_replace('{{name}}', htmlspecialchars($displayName), $bBody);
                    $finalBody = $isHtml ? $personalized : nl2br($personalized);

                    $res = sendRawEmail($rec['email'], $bSubject, $finalBody, $displayName);
                    if ($res) $sentCount++;
                }

                $_SESSION['flash_msg'] = "Marketing broadcast dispatched to {$sentCount} recipient(s).";
                $_SESSION['flash_type'] = 'success';
            }
        } elseif ($_POST['action'] === 'test_email') {
            $testTo = trim($_POST['test_email'] ?? '');
            $tKey   = trim($_POST['test_template_key'] ?? 'booking_confirmation');
            if (!empty($testTo)) {
                $sampleData = [
                    'name' => 'Jonny Mee',
                    'property_type' => 'Semi-detached',
                    'postcode' => 'PR2 1AU',
                    'address' => 'Old Docks House',
                    'preferred_date' => '2026-09-18',
                    'preferred_slot' => 'Morning',
                    'loft_height' => '2.4m',
                    'page_url' => '/loft-conversions-in-preston.php'
                ];
                $testRes = sendTemplatedEmail($tKey, $testTo, 'Jonny Mee', $sampleData);
                if ($testRes) {
                    $_SESSION['flash_msg'] = "Test email for '{$tKey}' dispatched to {$testTo}.";
                    $_SESSION['flash_type'] = 'success';
                } else {
                    $_SESSION['flash_msg'] = "Failed to dispatch test email.";
                    $_SESSION['flash_type'] = 'error';
                }
            }
        }
        header("Location: email-marketing.php");
        exit;
    }
}

// Fetch templates
$templatesStmt = $db->query("SELECT * FROM email_templates ORDER BY id ASC");
$templates = $templatesStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch recent dispatch logs
$logsStmt = $db->query("SELECT * FROM email_logs ORDER BY id DESC LIMIT 25");
$emailLogs = $logsStmt->fetchAll(PDO::FETCH_ASSOC);

$smtpActive = getSetting('smtp_enabled', '0') === '1';

// Sample dataset used for rendering realistic live email previews
$sampleEmailData = [
    'reference_id'   => 'AL-849201',
    'name'           => 'Jonny Mee',
    'phone'          => '07700 900123',
    'email'          => 'jonny.mee@example.co.uk',
    'property_type'  => 'Semi-Detached (Dormer)',
    'postcode'       => 'PR2 1AU',
    'address'        => 'Old Docks House, 90 Watery Lane, Preston',
    'loft_height'    => '2.45m',
    'preferred_date' => 'Friday, 18 Sep 2026',
    'preferred_slot' => 'Morning (09:00 – 12:00)',
    'page_url'       => '/loft-conversions-in-preston.php',
    'notes'          => 'Interested in a master bedroom with an en-suite shower room.',
    'created_at'     => date('d M Y, H:i')
];

/**
 * Wrap rendered template HTML with a responsive email shell for iframe preview
 */
function wrapEmailPreviewDoc(string $bodyHtml): string {
    return '<!DOCTYPE html><html><head>'
      . '<meta charset="utf-8">'
      . '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">'
      . '<style>'
      . 'html, body { margin:0 !important; padding:0 !important; font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif !important; -webkit-text-size-adjust:100%; background:#FAF9F5; overflow-x:hidden; width:100% !important; }'
      . '*, *:before, *:after { box-sizing:border-box !important; }'
      . 'img { max-width:100% !important; height:auto !important; }'
      . 'table { max-width:100% !important; width:100% !important; border-collapse:collapse !important; table-layout:auto !important; }'
      . 'div[style*="max-width: 600px"], div[style*="max-width:600px"] { max-width:100% !important; width:100% !important; margin:0 auto !important; border-radius:0 !important; border-left:none !important; border-right:none !important; }'
      . '@media (max-width: 580px) {'
      . '  div[style*="padding: 30px"], div[style*="padding: 24px 30px"], div[style*="padding: 24px"] { padding: 16px 12px !important; }'
      . '  div[style*="padding: 18px 20px"] { padding: 12px 10px !important; }'
      . '  td[style*="width: 140px"] { width: 100px !important; font-size: 12px !important; padding: 4px 4px 4px 0 !important; }'
      . '  td { font-size: 12px !important; word-break: break-word !important; padding: 4px 0 !important; }'
      . '  h1 { font-size: 17px !important; line-height: 1.3 !important; }'
      . '  h2 { font-size: 16px !important; line-height: 1.3 !important; }'
      . '  h3 { font-size: 13.5px !important; }'
      . '  p, li { font-size: 13px !important; line-height: 1.5 !important; }'
      . '  ul { padding-left: 18px !important; }'
      . '}'
      . '</style></head><body>' . $bodyHtml . '</body></html>';
}

/**
 * Render an HTML email template with realistic sample variables
 */
function renderTemplatePreview(string $htmlBody, string $subject, array $sampleData): array {
    $renderedSubject = $subject;
    $renderedBody = $htmlBody;
    foreach ($sampleData as $key => $val) {
        $renderedSubject = str_replace('{{' . $key . '}}', (string)$val, $renderedSubject);
        $renderedBody    = str_replace('{{' . $key . '}}', (string)$val, $renderedBody);
    }
    return [
        'subject' => $renderedSubject,
        'body'    => wrapEmailPreviewDoc($renderedBody)
    ];
}

/**
 * Format a template key into a human readable concise label
 */
function formatTemplateLabel(string $key): string {
    $map = [
        'booking_confirmation'   => 'Survey Conf',
        'booking_admin_alert'    => 'Admin Alert',
        'contact_confirmation'   => 'Contact Conf',
        'raw_custom'             => 'Broadcast',
        'cad_drawings_followup'  => 'CAD Followup'
    ];
    if (isset($map[$key])) {
        return $map[$key];
    }
    return ucwords(str_replace(['_', '-'], ' ', $key));
}

// Pre-built Marketing Campaign Presets for Direct Broadcasts
$marketingPresets = [
    'new_year' => [
        'id'          => 'new_year',
        'icon'        => '🎉',
        'title'       => 'New Year Fresh Start',
        'badge'       => 'Occasional / New Year',
        'target'      => 'all',
        'target_desc' => 'All Contacts & Leads',
        'subject'     => 'New Year, New Floor — Transform Your Home in 2026 with Another Level',
        'body'        => '<p>Hi {{name}},</p>
<p>As we begin 2026, many homeowners across Lancashire and Greater Manchester are asking the same question: <em>"Should we move house for more space, or extend the home we already love?"</em></p>
<p>With stamp duty, estate agent fees, and moving stress averaging over &pound;25,000, converting your existing loft into a luxury master bedroom suite or two extra rooms is consistently the smartest financial and lifestyle decision.</p>
<p><strong>Why start planning with Another Level in January?</strong></p>
<ul>
  <li><strong>Beat the Spring Rush:</strong> Early surveys allow architectural drawings and building control notices to complete before the busy construction season.</li>
  <li><strong>Fixed Price Guarantee:</strong> Lock in current trade material pricing with 0% surprise cost increases.</li>
  <li><strong>Clean 4&ndash;6 Week Build:</strong> Exterior scaffold access only &mdash; no builders walking through your house.</li>
</ul>
<p>We have opened a limited number of complimentary site feasibility surveys for local homeowners this month.</p>
<p>Reply directly to this email or call our team on <strong>01772 978 770</strong> / <strong>0161 820 8900</strong> to reserve your surveyor slot.</p>
<p>Warmest New Year wishes,<br><strong>Jonny Mee &amp; The Team</strong><br>Another Level Loft Conversions Ltd</p>'
    ],
    'spring_rush' => [
        'id'          => 'spring_rush',
        'icon'        => '🌸',
        'title'       => 'Spring Renovation Rush',
        'badge'       => 'Seasonal / Spring',
        'target'      => 'all',
        'target_desc' => 'All Contacts & Leads',
        'subject'     => 'Planning Your Loft Before Summer? Book Your Free Spring Feasibility Survey',
        'body'        => '<p>Hi {{name}},</p>
<p>Spring is traditionally the most popular time for home extensions across the North West. If your goal is to have your new loft bedroom, luxury en-suite, or quiet home office ready for this summer, the planning window starts right now.</p>
<p><strong>What you get with an Another Level conversion:</strong></p>
<ul>
  <li><strong>Rapid 4&ndash;6 Week On-Site Completion:</strong> From structural steels to final plaster skim.</li>
  <li><strong>Zero Disruption to Your Living Space:</strong> Scaffold-only access &mdash; you live comfortably below throughout.</li>
  <li><strong>Turnkey Package:</strong> Architectural design, Building Control fees, bespoke staircase, and full structural guarantee included.</li>
</ul>
<p>Our build schedule for pre-summer completion fills up quickly every year. Book your complimentary 30-minute roof inspection and receive a fixed, itemised quotation within 48 hours.</p>
<p>Reply to this email with your preferred day or call <strong>01772 978 770</strong> to speak with our survey team.</p>
<p>Kind regards,<br><strong>Another Level Loft Conversions</strong><br>Preston &bull; Manchester &bull; Lancashire &bull; Cheshire</p>'
    ],
    'free_3d_cad' => [
        'id'          => 'free_3d_cad',
        'icon'        => '📐',
        'title'       => 'Free 3D CAD Visualisation',
        'badge'       => 'Special Offer / £450 Value',
        'target'      => 'New',
        'target_desc' => 'New / Uncontacted Leads',
        'subject'     => 'Exclusive Offer: Complimentary 3D Architectural Loft Visualisation (Valued at £450)',
        'body'        => '<p>Hi {{name}},</p>
<p>One of the biggest hurdles when considering a loft conversion is visualising how the space will actually look and feel. <em>Where will the staircase arrive? How much headroom will there be? How will the dormer transform your roofline?</em></p>
<p>For enquiries confirmed this month, we are including our <strong>Comprehensive 3D Architectural CAD Visualisation</strong> completely free of charge (normally &pound;450).</p>
<p><strong>With your bespoke 3D design package, you will see:</strong></p>
<ul>
  <li>Exact second-floor room layout with proposed furniture placement.</li>
  <li>Natural light flow and window / Velux positioning.</li>
  <li>Detailed external 3D renders showing matching brickwork and roof tiles.</li>
  <li>Precise structural calculations and guaranteed fixed pricing.</li>
</ul>
<p>There is zero obligation to proceed. If you would like our design team to create a 3D model of your roof, simply reply <strong>"YES"</strong> to this email or call <strong>01772 978 770</strong>.</p>
<p>Warm regards,<br><strong>Jonny Mee</strong><br>Another Level Loft Conversions</p>'
    ],
    'surveyor_slots' => [
        'id'          => 'surveyor_slots',
        'icon'        => '📍',
        'title'       => 'Senior Surveyor in Your Area',
        'badge'       => 'Urgent / Area Slots',
        'target'      => 'New',
        'target_desc' => 'New / Uncontacted Leads',
        'subject'     => 'Senior Loft Surveyor in your local area this week — 2 complimentary slots open',
        'body'        => '<p>Hi {{name}},</p>
<p>Our senior loft surveyor will be carrying out feasibility assessments and roof inspections in your neighborhood this week.</p>
<p>Since we will already have equipment and surveyors active in your immediate area, we have set aside <strong>two complimentary 30-minute survey slots</strong> for homeowners who have expressed interest in extending their property.</p>
<p><strong>During the 30-minute site visit, we will:</strong></p>
<ul>
  <li>Measure existing ridge height and usable floor area.</li>
  <li>Confirm whether your property qualifies under <strong>Permitted Development</strong> (no planning permission required).</li>
  <li>Advise on the best conversion type for your roof (Rear Dormer, Hip-to-Gable, Velux, or Mansard).</li>
  <li>Provide an honest, exact fixed-price feasibility figure on the spot.</li>
</ul>
<p>Would you like us to stop by and assess your loft while we are in your area? Reply with your address or call <strong>01772 978 770</strong> to claim one of the open slots.</p>
<p>Best regards,<br><strong>Survey Scheduling Desk</strong><br>Another Level Loft Conversions</p>'
    ],
    'price_lock' => [
        'id'          => 'price_lock',
        'icon'        => '🔒',
        'title'       => 'Fixed Price Guarantee Lock',
        'badge'       => 'Negotiation / Price Lock',
        'target'      => 'Quote Sent',
        'target_desc' => 'Quote Sent / In Negotiation',
        'subject'     => 'Important: Lock In Your 2026 Fixed Loft Conversion Quote Today',
        'body'        => '<p>Hi {{name}},</p>
<p>We noticed you were recently exploring a loft conversion for your home. With nationwide fluctuations in timber, structural steel, and insulation costs, we want to help you protect your renovation budget.</p>
<p>For the next 14 days, Another Level is offering our <strong>2026 Price Lock Guarantee</strong>. When you confirm your booking, your bespoke quotation will be legally held for a full 6 months &mdash; immune to trade price increases.</p>
<p><strong>Our Absolute Price Promise:</strong></p>
<ul>
  <li><strong>No Hidden Costs:</strong> Steel beams, Building Control fees, insulation, bespoke stairs &mdash; everything is included in one fixed number.</li>
  <li><strong>No Milestone Surprises:</strong> The price agreed before we start is the exact price you pay on completion.</li>
  <li><strong>10-Year Insurance-Backed Guarantee:</strong> Complete structural peace of mind.</li>
</ul>
<p>If you are still considering turning that unused roof space into valuable living accommodation, let&apos;s have a quick chat this week.</p>
<p>Call Jonny Mee directly on <strong>07700 900123</strong> or reply to this email.</p>
<p>Best regards,<br><strong>Another Level Loft Conversions Ltd</strong></p>'
    ],
    'autumn_insulation' => [
        'id'          => 'autumn_insulation',
        'icon'        => '🍂',
        'title'       => 'Autumn Warmth & Insulation',
        'badge'       => 'Seasonal / Energy Saving',
        'target'      => 'all',
        'target_desc' => 'All Contacts & Leads',
        'subject'     => 'Stop 25% of Your Heating Escaping: Insulate & Convert Your Loft Before Winter',
        'body'        => '<p>Hi {{name}},</p>
<p>Did you know that in an uninsulated or poorly insulated roof, up to <strong>25% of your household heat escapes straight through the roof</strong>?</p>
<p>A professional loft conversion does not just add 35&ndash;45 m&sup2; of beautiful living space &mdash; it completely wraps your upper floor in high-performance rigid PIR insulation (Kingspan / Celotex) installed to modern Part L Building Regulations.</p>
<p><strong>The Double Benefit:</strong></p>
<ul>
  <li><strong>Lower Energy Bills:</strong> Traps ambient warmth inside your home throughout the cold North West winter.</li>
  <li><strong>Massive Equity Boost:</strong> Adds up to 20% to your home&apos;s resale value while transforming how you live.</li>
</ul>
<p>Pre-winter survey dates are now open. Find out how much usable space you have and how quickly your conversion can be completed.</p>
<p>Reply to this email or call <strong>01772 978 770</strong> / <strong>0161 820 8900</strong> to book your free survey.</p>
<p>Warm regards,<br><strong>The Team at Another Level</strong></p>'
    ]
];

$pageTitle = "Email Marketing & Auto-Responders";
$activeNav = "email";
require_once __DIR__ . '/includes/header.php';
?>

<div class="panel-grid-2-1" style="display:grid;grid-template-columns:1.5fr 1.25fr;gap:24px">
  
  <!-- Left: Template Editor & Broadcast Manager -->
  <div style="display:grid;gap:24px">
    
    <!-- Template Editor Card -->
    <div class="panel-card">
      <div class="panel-card-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
        <div>
          <h2 class="panel-card-title">Automated Email Templates</h2>
          <p class="panel-card-sub">Customer auto-responder and internal surveyor notification triggers</p>
        </div>
        <span class="badge badge-won" style="min-width:auto;height:24px;padding:0 10px;font-size:11px">
          <?php echo count($templates); ?> Active Templates
        </span>
      </div>

      <div style="display:grid;gap:18px">
        <?php foreach ($templates as $tmpl): 
          $tKey = (string)($tmpl['template_key'] ?? '');
          $prevData = renderTemplatePreview((string)($tmpl['body_html'] ?? ''), (string)($tmpl['subject'] ?? ''), $sampleEmailData);
        ?>
          <details id="details-<?php echo htmlspecialchars($tKey); ?>" class="template-details-card" <?php echo $tKey === 'booking_confirmation' ? 'open' : ''; ?>>
            <summary class="template-summary-row">
              <div class="template-summary-title-wrap">
                <span class="template-summary-title"><?php echo htmlspecialchars((string)($tmpl['title'] ?? $tmpl['template_name'] ?? $tKey)); ?></span>
                <span class="template-pill" style="font-size:10.5px"><code><?php echo htmlspecialchars($tKey); ?></code></span>
              </div>
              <div class="template-summary-actions">
                <button type="button" class="btn btn-sm btn-outline template-view-btn" onclick="event.preventDefault(); event.stopPropagation(); openEmailPreviewModal('<?php echo htmlspecialchars($tKey); ?>')" title="Open full visual email preview">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  <span>View Version</span>
                </button>
                <span class="badge-status-pill badge-status-sent template-active-badge">Active</span>
              </div>
            </summary>

            <!-- Mode Switcher Tabs: Visual Preview vs Edit Code -->
            <div style="margin-top:14px;border-top:1px solid #E2E8F0;padding-top:14px">
              <div class="template-tabs-bar">
                <div class="email-view-tabs">
                  <button type="button" class="email-view-tab-btn active" id="tab-btn-prev-<?php echo htmlspecialchars($tKey); ?>" onclick="switchTemplateTab('<?php echo htmlspecialchars($tKey); ?>', 'preview')">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    <span>Visual Email View</span>
                  </button>
                  <button type="button" class="email-view-tab-btn" id="tab-btn-edit-<?php echo htmlspecialchars($tKey); ?>" onclick="switchTemplateTab('<?php echo htmlspecialchars($tKey); ?>', 'edit')">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    <span>Edit Subject &amp; HTML</span>
                  </button>
                </div>

                <div class="template-tab-actions">
                  <button type="button" class="btn btn-sm btn-outline" onclick="openEmailPreviewModal('<?php echo htmlspecialchars($tKey); ?>')" style="font-size:11px;padding:4px 10px;background:#FFFFFF;display:inline-flex;align-items:center;gap:4px">
                    <span>Full Screen View</span>
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline></svg>
                  </button>
                </div>
              </div>

              <!-- VIEW 1: Visual Rendered Email Preview -->
              <div id="panel-prev-<?php echo htmlspecialchars($tKey); ?>" class="email-preview-frame-wrap">
                <div class="email-preview-header">
                  <div class="email-preview-header-row">
                    <span class="email-preview-header-label">Subject:</span>
                    <strong class="email-preview-header-val" id="prev-subj-<?php echo htmlspecialchars($tKey); ?>">
                      <?php echo htmlspecialchars($prevData['subject']); ?>
                    </strong>
                  </div>
                  <div class="email-preview-header-row">
                    <span class="email-preview-header-label">From:</span>
                    <span class="email-preview-header-val" style="color:#64748B">
                      Another Level Loft Conversions &lt;info@anotherlevelloftconversions.co.uk&gt;
                    </span>
                  </div>
                  <div class="email-preview-header-row">
                    <span class="email-preview-header-label">To:</span>
                    <span class="email-preview-header-val" style="color:#64748B">
                      Jonny Mee &lt;jonny.mee@example.co.uk&gt;
                    </span>
                  </div>
                </div>
                <iframe id="iframe-prev-<?php echo htmlspecialchars($tKey); ?>" class="email-preview-iframe" sandbox="allow-same-origin" srcdoc="<?php echo htmlspecialchars($prevData['body']); ?>"></iframe>
              </div>

              <!-- VIEW 2: Edit Form -->
              <div id="panel-edit-<?php echo htmlspecialchars($tKey); ?>" style="display:none">
                <form method="POST" action="email-marketing.php" style="display:grid;gap:12px">
                  <input type="hidden" name="action" value="update_template">
                  <input type="hidden" name="template_key" value="<?php echo htmlspecialchars($tKey); ?>">
                  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars((string)getCSRFToken()); ?>">

                  <div>
                    <label class="form-label" style="font-size:12px">Email Subject Line</label>
                    <input type="text" id="input-subj-<?php echo htmlspecialchars($tKey); ?>" name="subject" class="form-input" value="<?php echo htmlspecialchars((string)($tmpl['subject'] ?? '')); ?>" oninput="syncLivePreview('<?php echo htmlspecialchars($tKey); ?>')" required>
                  </div>

                  <div>
                    <label class="form-label" style="font-size:12px">Email HTML Body</label>
                    <textarea id="input-body-<?php echo htmlspecialchars($tKey); ?>" name="body_html" class="form-input" style="height:160px;font-family:'IBM Plex Mono',monospace;font-size:12px;resize:vertical" oninput="syncLivePreview('<?php echo htmlspecialchars($tKey); ?>')" required><?php echo htmlspecialchars((string)($tmpl['body_html'] ?? '')); ?></textarea>
                    <div style="font-size:11px;color:#718096;margin-top:4px">
                      Available tags: <code>{{name}}</code>, <code>{{reference_id}}</code>, <code>{{preferred_date}}</code>, <code>{{preferred_slot}}</code>, <code>{{postcode}}</code>, <code>{{property_type}}</code>, <code>{{loft_height}}</code>, <code>{{phone}}</code>, <code>{{address}}</code>
                    </div>
                  </div>

                  <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="switchTemplateTab('<?php echo htmlspecialchars($tKey); ?>', 'preview')">
                      <span>View Formatted Email &rarr;</span>
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">Save Template Changes</button>
                  </div>
                </form>
              </div>

            </div>
          </details>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Lead Broadcast Follow-Up Card with High-Converting Presets -->
    <div class="panel-card" id="broadcastSection">
      <div class="panel-card-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
        <div>
          <h2 class="panel-card-title">Direct Lead Campaign / Broadcast</h2>
          <p class="panel-card-sub">Send seasonal promotions, occasional campaigns, or targeted offers to homeowner leads</p>
        </div>
        <span class="badge-status-pill badge-status-sent" style="font-size:10.5px;padding:0 9px;height:22px">
          ⚡ 6 Pre-Built Campaigns
        </span>
      </div>

      <!-- Quick Preset Selector Section -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:10px;padding:14px;margin-bottom:18px">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:10px">
          <div style="display:flex;align-items:center;gap:6px">
            <span style="font-size:15px">⚡</span>
            <strong style="font-size:13px;color:#1E293B">Marketing Campaign Presets:</strong>
            <span style="font-size:11.5px;color:#64748B">(Click any preset to auto-fill subject &amp; copy)</span>
          </div>
          <button type="button" class="btn btn-sm btn-outline" onclick="clearCampaignPreset()" style="font-size:11px;padding:2px 8px;background:#FFFFFF" title="Reset form to blank">
            <span>Reset / Custom</span>
          </button>
        </div>

        <div class="campaign-presets-grid" id="presetsGrid">
          <?php foreach ($marketingPresets as $pKey => $p): ?>
            <div class="campaign-preset-card" id="preset-card-<?php echo $pKey; ?>" onclick="loadCampaignPreset('<?php echo $pKey; ?>')">
              <div class="campaign-preset-header">
                <span class="campaign-preset-title">
                  <span><?php echo $p['icon']; ?></span>
                  <span><?php echo htmlspecialchars($p['title']); ?></span>
                </span>
                <span class="campaign-preset-badge"><?php echo htmlspecialchars($p['badge']); ?></span>
              </div>
              <span class="campaign-preset-desc">
                Target: <strong><?php echo htmlspecialchars($p['target_desc']); ?></strong>
              </span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Broadcast Form -->
      <form method="POST" action="email-marketing.php" style="display:grid;gap:14px">
        <input type="hidden" name="action" value="send_broadcast">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars((string)getCSRFToken()); ?>">

        <div class="grid-2-col-responsive">
          <div>
            <label class="form-label">Target Lead Segment</label>
            <select name="target_group" id="broadcastTargetGroup" class="form-input">
              <option value="all">All Contacts &amp; Survey Leads with Email</option>
              <option value="New">New / Uncontacted Leads Only</option>
              <option value="Survey Booked">Survey Booked Homeowners</option>
              <option value="Quote Sent">Quote Sent / In Negotiation (Closing)</option>
            </select>
          </div>
          <div>
            <label class="form-label">Quick Campaign Switcher</label>
            <select id="broadcastDropdown" class="form-input" onchange="if(this.value)loadCampaignPreset(this.value); else clearCampaignPreset();">
              <option value="">-- Choose Campaign Preset --</option>
              <?php foreach ($marketingPresets as $pKey => $p): ?>
                <option value="<?php echo $pKey; ?>">
                  <?php echo $p['icon']; ?> <?php echo htmlspecialchars($p['title']); ?> (<?php echo htmlspecialchars($p['badge']); ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div>
          <label class="form-label">Broadcast Subject</label>
          <input type="text" name="broadcast_subject" id="broadcastSubject" class="form-input" placeholder="e.g. New Year, New Floor — Transform Your Home in 2026 with Another Level" oninput="syncBroadcastPreview()" required>
        </div>

        <!-- Unified Campaign Message Box (Visual Email View vs Edit HTML / Plain Text) -->
        <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:10px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,0.03)">
          
          <!-- Tab Navigation Bar -->
          <div style="padding:10px 14px;background:#F8FAFC;border-bottom:1px solid #E2E8F0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
            <div class="email-view-tabs">
              <button type="button" class="email-view-tab-btn active" id="tab-broadcast-prev" onclick="switchBroadcastTab('preview')">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                <span>Visual Email View</span>
              </button>
              <button type="button" class="email-view-tab-btn" id="tab-broadcast-edit" onclick="switchBroadcastTab('edit')">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                <span>Edit HTML / Plain Text</span>
              </button>
            </div>
            
            <div style="font-size:11px;color:#64748B;display:flex;align-items:center;gap:6px">
              <span>Personalised with: <strong>Jonny Mee</strong></span>
            </div>
          </div>

          <!-- TAB 1: Visual Rendered Email View -->
          <div id="panel-broadcast-prev" style="display:block">
            <div class="email-preview-header">
              <div class="email-preview-header-row">
                <span class="email-preview-header-label">Subject:</span>
                <strong id="prevBroadcastSubject" class="email-preview-header-val">Your Subject Line Will Appear Here</strong>
              </div>
              <div class="email-preview-header-row">
                <span class="email-preview-header-label">From:</span>
                <span class="email-preview-header-val" style="color:#64748B">Another Level Loft Conversions &lt;info@anotherlevelloftconversions.co.uk&gt;</span>
              </div>
              <div class="email-preview-header-row">
                <span class="email-preview-header-label">To:</span>
                <span class="email-preview-header-val" style="color:#64748B">Jonny Mee &lt;customer@example.co.uk&gt;</span>
              </div>
            </div>
            <div style="padding:16px 20px;background:#FAFAF9;font-size:13.5px;line-height:1.65;color:#1E293B;min-height:220px;max-height:360px;overflow-y:auto;word-break:break-word" id="prevBroadcastBody">
              <p style="color:#94A3B8;font-style:italic">Select a campaign preset above or switch to the Edit tab to write your message.</p>
            </div>
          </div>

          <!-- TAB 2: Edit HTML / Plain Text Code Area -->
          <div id="panel-broadcast-edit" style="display:none;padding:14px">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
              <span style="font-size:12px;font-weight:600;color:#334155">Broadcast Body Code:</span>
              <span style="font-size:11px;color:#64748B">Tags: <code>{{name}}</code>, <code>{{property_type}}</code>, <code>{{postcode}}</code></span>
            </div>
            <textarea name="broadcast_body" id="broadcastBody" class="form-input" style="height:220px;font-family:'IBM Plex Mono',monospace;font-size:12px;resize:vertical;line-height:1.5" placeholder="Write your broadcast message or select a marketing preset from above..." oninput="syncBroadcastPreview()" required></textarea>
            <div style="display:flex;justify-content:flex-end;margin-top:8px">
              <button type="button" class="btn btn-secondary btn-sm" onclick="switchBroadcastTab('preview')">
                <span>View Formatted Email &rarr;</span>
              </button>
            </div>
          </div>

        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-top:4px">
          <div style="font-size:11.5px;color:#64748B">
            ⚡ Unsubscribe &amp; company disclosures automatically attached to footer.
          </div>
          <button type="submit" class="btn btn-primary btn-sm" style="background:#16A34A;border-color:#16A34A;padding:8px 18px;font-size:13px;font-weight:700" onclick="return confirm('Are you sure you want to dispatch this email campaign to the selected recipients? This cannot be undone.')">
            <span>🚀 Send Campaign Broadcast</span>
          </button>
        </div>
      </form>
    </div>

  </div>

  <!-- Right: Quick Test & Logs -->
  <div style="display:grid;gap:24px;align-content:start">
    
    <!-- SMTP Server Status & Setup -->
    <div class="panel-card" style="border-left:4px solid <?php echo $smtpActive ? '#38A169' : '#D69E2E'; ?>">
      <div class="panel-card-header" style="display:flex;justify-content:space-between;align-items:center">
        <h3 class="panel-card-title" style="font-size:15px">SMTP Mail Server</h3>
        <span class="badge <?php echo $smtpActive ? 'badge-won' : 'badge-quote'; ?>" style="min-width:auto;height:24px;padding:0 10px;font-size:11px">
          <?php echo $smtpActive ? 'SMTP Active' : 'PHP Mail'; ?>
        </span>
      </div>
      <p style="font-size:12.5px;color:#4A5568;margin-bottom:12px;line-height:1.5">
        <?php if ($smtpActive): ?>
          Connected to <strong><?php echo htmlspecialchars((string)getSetting('smtp_host', '')); ?></strong> (Port <?php echo htmlspecialchars((string)getSetting('smtp_port', '587')); ?>).
        <?php else: ?>
          Using standard PHP server mail. Configure SMTP for custom domains (Gmail, Outlook, cPanel).
        <?php endif; ?>
      </p>
      <a href="settings.php" class="btn btn-secondary btn-sm" style="width:100%;justify-content:center;text-decoration:none">
        Configure SMTP Settings &rarr;
      </a>
    </div>

    <!-- Test Email Dispatch -->
    <div class="panel-card">
      <div class="panel-card-header">
        <h3 class="panel-card-title">Send Test Email</h3>
      </div>

      <form method="POST" action="email-marketing.php" style="display:grid;gap:12px">
        <input type="hidden" name="action" value="test_email">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars((string)getCSRFToken()); ?>">

        <div>
          <label class="form-label" style="font-size:12px">Recipient Email</label>
          <input type="email" name="test_email" class="form-input" placeholder="your-email@example.co.uk" required>
        </div>

        <div>
          <label class="form-label" style="font-size:12px">Select Template</label>
          <select name="test_template_key" class="form-input">
            <?php foreach ($templates as $t): ?>
              <option value="<?php echo htmlspecialchars((string)$t['template_key']); ?>" <?php echo ($t['template_key'] ?? '') === 'booking_confirmation' ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars((string)($t['title'] ?? $t['template_key'])); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-secondary btn-sm" style="justify-content:center">Send Test Email</button>
      </form>
    </div>

    <!-- Dispatch History Logs (No Horizontal Scroll) -->
    <div class="panel-card" style="padding:0;overflow:hidden">
      <div class="panel-card-header" style="padding:14px 16px;border-bottom:1px solid #E2E8F0;display:flex;align-items:center;justify-content:space-between">
        <h3 class="panel-card-title" style="font-size:14px">Recent Dispatch Logs</h3>
        <span style="font-size:11px;color:#64748B;font-weight:600"><?php echo count($emailLogs); ?> logs</span>
      </div>
      <div class="table-responsive" style="overflow-x:hidden">
        <table class="panel-table panel-table-compact" style="width:100%;table-layout:fixed">
          <thead>
            <tr>
              <th style="width:38%;padding-left:14px">Recipient</th>
              <th style="width:26%">Template</th>
              <th style="width:16%;text-align:center">Status</th>
              <th style="width:20%;text-align:right;padding-right:14px">Time</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($emailLogs)): ?>
              <tr>
                <td colspan="4" style="text-align:center;padding:24px;color:#A0AEC0">No emails sent yet.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($emailLogs as $log): 
                $recEmail = $log['recipient'] ?? $log['recipient_email'] ?? 'Unknown';
                $tKey = $log['template_key'] ?? 'Custom';
                $logStatus = strtolower(trim((string)($log['status'] ?? 'sent')));
                $sentTime = $log['sent_at'] ?? $log['created_at'] ?? date('Y-m-d H:i:s');
              ?>
                <tr>
                  <td style="padding-left:14px">
                    <div style="font-weight:600;color:#1E293B;font-size:11.5px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="<?php echo htmlspecialchars((string)$recEmail); ?>">
                      <?php echo htmlspecialchars((string)$recEmail); ?>
                    </div>
                  </td>
                  <td>
                    <span class="template-pill" title="<?php echo htmlspecialchars((string)$tKey); ?>">
                      <?php echo htmlspecialchars((string)formatTemplateLabel($tKey)); ?>
                    </span>
                  </td>
                  <td style="text-align:center">
                    <span class="badge-status-pill badge-status-<?php echo $logStatus === 'sent' ? 'sent' : 'failed'; ?>">
                      <?php echo htmlspecialchars(ucfirst((string)$logStatus)); ?>
                    </span>
                  </td>
                  <td style="text-align:right;padding-right:14px">
                    <span style="font-size:10.5px;color:#64748B;white-space:nowrap" title="<?php echo date('Y-m-d H:i:s', strtotime((string)$sentTime)); ?>">
                      <?php echo date('d M, H:i', strtotime((string)$sentTime)); ?>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

</div>

<!-- Modal: Full Email Preview (Desktop & Mobile Simulation) -->
<div class="panel-modal-overlay" id="emailPreviewModal" style="display:none" onclick="if(event.target===this)closeEmailPreviewModal()">
  <div class="panel-modal-card" style="max-width:760px;width:95%;padding:0;overflow:hidden;max-height:92vh;display:flex;flex-direction:column">
    
    <!-- Modal Header -->
    <div style="padding:14px 18px;border-bottom:1px solid #E2E8F0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;background:#F8FAFC">
      <div>
        <h3 id="modalPreviewTitle" style="font-size:15.5px;font-weight:700;color:#1E293B;margin:0">Customer Survey Booking Confirmation</h3>
        <p style="font-size:11.5px;color:#64748B;margin:2px 0 0">Visual email simulation with sample homeowner data</p>
      </div>
      
      <!-- Device Switcher & Close -->
      <div style="display:flex;align-items:center;gap:8px">
        <div class="email-view-tabs" style="background:#E2E8F0">
          <button type="button" class="email-view-tab-btn active" id="btnModeDesktop" onclick="setModalPreviewDevice('desktop')">
            🖥️ Desktop View
          </button>
          <button type="button" class="email-view-tab-btn" id="btnModeMobile" onclick="setModalPreviewDevice('mobile')">
            📱 Mobile View
          </button>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeEmailPreviewModal()">&times;</button>
      </div>
    </div>

    <!-- Email Meta Bar -->
    <div class="email-preview-header" style="border-bottom:1px solid #E2E8F0">
      <div class="email-preview-header-row">
        <span class="email-preview-header-label">Subject:</span>
        <strong id="modalPreviewSubject" class="email-preview-header-val">Survey Confirmation — Another Level Loft Conversions [AL-849201]</strong>
      </div>
      <div class="email-preview-header-row">
        <span class="email-preview-header-label">From:</span>
        <span class="email-preview-header-val" style="color:#64748B">Another Level Loft Conversions &lt;info@anotherlevelloftconversions.co.uk&gt;</span>
      </div>
      <div class="email-preview-header-row">
        <span class="email-preview-header-label">To:</span>
        <span class="email-preview-header-val" style="color:#64748B">Jonny Mee &lt;jonny.mee@example.co.uk&gt;</span>
      </div>
    </div>

    <!-- Preview Container (Scrollable) -->
    <div style="padding:20px;overflow-y:auto;flex:1;background:#F1F5F9;display:flex;justify-content:center">
      <div id="modalPreviewWrapper" style="width:100%;max-width:640px;transition:all 0.25s ease">
        <iframe id="modalPreviewIframe" sandbox="allow-same-origin" style="width:100%;height:520px;border:none;border-radius:6px;background:#FFFFFF;box-shadow:0 2px 12px rgba(0,0,0,0.06)"></iframe>
      </div>
    </div>

    <!-- Modal Footer -->
    <div style="padding:12px 18px;border-top:1px solid #E2E8F0;background:#FFFFFF;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
      <span style="font-size:11.5px;color:#64748B">Template key: <code id="modalPreviewKey">booking_confirmation</code></span>
      <div style="display:flex;gap:8px">
        <button type="button" class="btn btn-secondary btn-sm" onclick="closeEmailPreviewModal()">Close Preview</button>
      </div>
    </div>

  </div>
</div>

<script>
// Sample variables for live rendering in the browser
const sampleEmailVars = <?php echo json_encode($sampleEmailData); ?>;

// Database templates snapshot
const templateDb = <?php 
  $rawTmpls = [];
  foreach ($templates as $t) {
    $rawTmpls[$t['template_key']] = [
      'title' => $t['title'] ?? $t['template_key'],
      'key' => $t['template_key'],
      'subject' => $t['subject'],
      'body_html' => $t['body_html']
    ];
  }
  echo json_encode($rawTmpls);
?>;

function wrapEmailPreviewHtml(bodyHtml) {
  return `<!DOCTYPE html><html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style>
      html, body { margin:0 !important; padding:0 !important; font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif !important; -webkit-text-size-adjust:100%; background:#FAF9F5; overflow-x:hidden; width:100% !important; }
      *, *:before, *:after { box-sizing:border-box !important; }
      img { max-width:100% !important; height:auto !important; }
      table { max-width:100% !important; width:100% !important; border-collapse:collapse !important; table-layout:auto !important; }
      div[style*="max-width: 600px"], div[style*="max-width:600px"] { max-width:100% !important; width:100% !important; margin:0 auto !important; border-radius:0 !important; border-left:none !important; border-right:none !important; }
      @media (max-width: 580px) {
        div[style*="padding: 30px"], div[style*="padding: 24px 30px"], div[style*="padding: 24px"] { padding: 16px 12px !important; }
        div[style*="padding: 18px 20px"] { padding: 12px 10px !important; }
        td[style*="width: 140px"] { width: 100px !important; font-size: 12px !important; padding: 4px 4px 4px 0 !important; }
        td { font-size: 12px !important; word-break: break-word !important; padding: 4px 0 !important; }
        h1 { font-size: 17px !important; line-height: 1.3 !important; }
        h2 { font-size: 16px !important; line-height: 1.3 !important; }
        h3 { font-size: 13.5px !important; }
        p, li { font-size: 13px !important; line-height: 1.5 !important; }
        ul { padding-left: 18px !important; }
      }
    </style></head><body>${bodyHtml}</body></html>`;
}

function renderEmailTemplateWithVars(bodyHtml, subjectText, vars) {
  let sub = subjectText || '';
  let body = bodyHtml || '';
  for (const [k, v] of Object.entries(vars)) {
    const reg = new RegExp('{{' + k + '}}', 'g');
    sub = sub.replace(reg, v);
    body = body.replace(reg, v);
  }
  return { subject: sub, body: wrapEmailPreviewHtml(body), rawBody: body };
}

function switchTemplateTab(key, tab) {
  const btnPrev = document.getElementById('tab-btn-prev-' + key);
  const btnEdit = document.getElementById('tab-btn-edit-' + key);
  const panelPrev = document.getElementById('panel-prev-' + key);
  const panelEdit = document.getElementById('panel-edit-' + key);

  if (tab === 'preview') {
    if (btnPrev) btnPrev.classList.add('active');
    if (btnEdit) btnEdit.classList.remove('active');
    if (panelPrev) panelPrev.style.display = 'block';
    if (panelEdit) panelEdit.style.display = 'none';
    syncLivePreview(key);
  } else {
    if (btnPrev) btnPrev.classList.remove('active');
    if (btnEdit) btnEdit.classList.add('active');
    if (panelPrev) panelPrev.style.display = 'none';
    if (panelEdit) panelEdit.style.display = 'block';
  }
}

function syncLivePreview(key) {
  const inputSubj = document.getElementById('input-subj-' + key);
  const inputBody = document.getElementById('input-body-' + key);
  const prevSubj = document.getElementById('prev-subj-' + key);
  const iframe = document.getElementById('iframe-prev-' + key);

  const rawSubj = inputSubj ? inputSubj.value : (templateDb[key]?.subject || '');
  const rawBody = inputBody ? inputBody.value : (templateDb[key]?.body_html || '');

  const rendered = renderEmailTemplateWithVars(rawBody, rawSubj, sampleEmailVars);

  if (prevSubj) prevSubj.textContent = rendered.subject;
  if (iframe) iframe.srcdoc = rendered.body;
}

let currentModalPreviewKey = 'booking_confirmation';

function openEmailPreviewModal(key) {
  currentModalPreviewKey = key;
  const inputSubj = document.getElementById('input-subj-' + key);
  const inputBody = document.getElementById('input-body-' + key);

  const rawSubj = inputSubj ? inputSubj.value : (templateDb[key]?.subject || '');
  const rawBody = inputBody ? inputBody.value : (templateDb[key]?.body_html || '');
  const title = templateDb[key]?.title || key;

  const rendered = renderEmailTemplateWithVars(rawBody, rawSubj, sampleEmailVars);

  document.getElementById('modalPreviewTitle').textContent = title;
  document.getElementById('modalPreviewKey').textContent = key;
  document.getElementById('modalPreviewSubject').textContent = rendered.subject;
  document.getElementById('modalPreviewIframe').srcdoc = rendered.body;

  setModalPreviewDevice('desktop');

  const modal = document.getElementById('emailPreviewModal');
  if (modal) modal.style.display = 'flex';
}

function closeEmailPreviewModal() {
  const modal = document.getElementById('emailPreviewModal');
  if (modal) modal.style.display = 'none';
}

function setModalPreviewDevice(device) {
  const wrapper = document.getElementById('modalPreviewWrapper');
  const btnDesktop = document.getElementById('btnModeDesktop');
  const btnMobile = document.getElementById('btnModeMobile');
  const iframe = document.getElementById('modalPreviewIframe');

  if (device === 'mobile') {
    wrapper.style.maxWidth = '375px';
    wrapper.className = 'email-phone-frame';
    if (btnDesktop) btnDesktop.classList.remove('active');
    if (btnMobile) btnMobile.classList.add('active');
    if (iframe) {
      iframe.style.height = '500px';
      iframe.style.borderRadius = '20px';
    }
  } else {
    wrapper.style.maxWidth = '640px';
    wrapper.className = '';
    if (btnDesktop) btnDesktop.classList.add('active');
    if (btnMobile) btnMobile.classList.remove('active');
    if (iframe) {
      iframe.style.height = '520px';
      iframe.style.borderRadius = '6px';
    }
  }
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeEmailPreviewModal();
  }
});

// Marketing Campaign Presets Database
const marketingPresetsDb = <?php echo json_encode($marketingPresets); ?>;

function switchBroadcastTab(tab) {
  const btnPrev = document.getElementById('tab-broadcast-prev');
  const btnEdit = document.getElementById('tab-broadcast-edit');
  const panelPrev = document.getElementById('panel-broadcast-prev');
  const panelEdit = document.getElementById('panel-broadcast-edit');

  if (tab === 'preview') {
    if (btnPrev) btnPrev.classList.add('active');
    if (btnEdit) btnEdit.classList.remove('active');
    if (panelPrev) panelPrev.style.display = 'block';
    if (panelEdit) panelEdit.style.display = 'none';
    syncBroadcastPreview();
  } else {
    if (btnPrev) btnPrev.classList.remove('active');
    if (btnEdit) btnEdit.classList.add('active');
    if (panelPrev) panelPrev.style.display = 'none';
    if (panelEdit) panelEdit.style.display = 'block';
  }
}

function loadCampaignPreset(key) {
  const p = marketingPresetsDb[key];
  if (!p) return;

  const subjectInput = document.getElementById('broadcastSubject');
  const bodyInput = document.getElementById('broadcastBody');
  const targetSelect = document.getElementById('broadcastTargetGroup');
  const dropdown = document.getElementById('broadcastDropdown');

  if (subjectInput) subjectInput.value = p.subject;
  if (bodyInput) bodyInput.value = p.body;
  if (targetSelect && p.target) targetSelect.value = p.target;
  if (dropdown) dropdown.value = key;

  // Highlight selected preset card
  document.querySelectorAll('.campaign-preset-card').forEach(card => card.classList.remove('active'));
  const activeCard = document.getElementById('preset-card-' + key);
  if (activeCard) activeCard.classList.add('active');

  syncBroadcastPreview();
}

function clearCampaignPreset() {
  const subjectInput = document.getElementById('broadcastSubject');
  const bodyInput = document.getElementById('broadcastBody');
  const dropdown = document.getElementById('broadcastDropdown');

  if (subjectInput) subjectInput.value = '';
  if (bodyInput) bodyInput.value = '';
  if (dropdown) dropdown.value = '';

  document.querySelectorAll('.campaign-preset-card').forEach(card => card.classList.remove('active'));
  syncBroadcastPreview();
}

function syncBroadcastPreview() {
  const subjectInput = document.getElementById('broadcastSubject');
  const bodyInput = document.getElementById('broadcastBody');
  const prevSubj = document.getElementById('prevBroadcastSubject');
  const prevBody = document.getElementById('prevBroadcastBody');

  const rawSub = (subjectInput ? subjectInput.value : '').trim();
  const rawBody = (bodyInput ? bodyInput.value : '').trim();

  const rendered = renderEmailTemplateWithVars(rawBody, rawSub, sampleEmailVars);

  if (prevSubj) {
    prevSubj.textContent = rendered.subject || 'Your Subject Line Will Appear Here';
  }

  if (prevBody) {
    if (!rawBody) {
      prevBody.innerHTML = '<p style="color:#94A3B8;font-style:italic">Select a campaign preset above or type in the message body to preview the exact customer email output.</p>';
    } else {
      const isHtml = (rawBody.indexOf('<div') !== -1 || rawBody.indexOf('<p') !== -1 || rawBody.indexOf('<ul') !== -1 || rawBody.indexOf('<table') !== -1);
      prevBody.innerHTML = isHtml ? rendered.rawBody : rendered.rawBody.replace(/\n/g, '<br>');
    }
  }
}

// Auto load first high-converting preset on page load for immediate usability
document.addEventListener('DOMContentLoaded', function() {
  loadCampaignPreset('new_year');
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

