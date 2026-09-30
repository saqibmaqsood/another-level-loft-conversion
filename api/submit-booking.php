<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed.']);
    exit;
}

require_once __DIR__ . '/../panel/includes/db.php';
require_once __DIR__ . '/../panel/includes/mailer.php';
require_once __DIR__ . '/../panel/includes/sites.php';

// Support both JSON input and standard form POST
$input = json_decode(file_get_contents('php://input'), true);
if (!$input || !is_array($input)) {
    $input = $_POST;
}

// Multi-Site attribution
$siteId = 1;
if (!empty($input['site_id'])) {
    $siteId = (int)$input['site_id'];
} elseif (!empty($input['site_key'])) {
    $matchedSite = getSiteByKey(trim($input['site_key']));
    if ($matchedSite) {
        $siteId = (int)$matchedSite['id'];
    }
}
$siteObj = getSiteById($siteId);
$siteRefPrefix = $siteObj && !empty($siteObj['short_name']) ? strtoupper(preg_replace('/[^A-Z0-9]/', '', $siteObj['short_name'])) : 'AL';

$propertyType  = trim($input['property_type'] ?? $input['property'] ?? 'Terrace');
$postcode      = strtoupper(trim($input['postcode'] ?? ''));
$address       = trim($input['address'] ?? '');
$loftHeight    = trim($input['loft_height'] ?? $input['height'] ?? '');
$notSureHeight = !empty($input['not_sure_height']) || !empty($input['notSure']) ? 1 : 0;
if ($notSureHeight) {
    $loftHeight = 'Not sure (to measure on survey)';
}
$preferredDate = trim($input['preferred_date'] ?? $input['date'] ?? '');
$preferredSlot = trim($input['preferred_slot'] ?? $input['slot'] ?? '');
$name          = trim($input['name'] ?? '');
$phone         = trim($input['phone'] ?? '');
$email         = trim($input['email'] ?? '');
$notes         = trim($input['notes'] ?? '');
$sourcePage    = trim($input['page_url'] ?? $_SERVER['HTTP_REFERER'] ?? '/');
$referrer      = trim($input['referrer_url'] ?? '');

// Validation
if (empty($name) || empty($phone)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Full name and phone number are required.']);
    exit;
}

if (empty($postcode)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Postcode is required.']);
    exit;
}

if (empty($address)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'House number & street address are required.']);
    exit;
}

if (empty($preferredDate) || empty($preferredSlot)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Please select both a date and a time slot.']);
    exit;
}

// Client metadata
$ipAddress  = getClientIP();
$userAgent  = $_SERVER['HTTP_USER_AGENT'] ?? '';
$deviceType = getDeviceType($userAgent);
$browser    = getBrowserName($userAgent);

// Extract city/town from page URL
$locationCity = '';
if (preg_match('/loft-conversions-in-([a-z-]+)/i', $sourcePage, $matches)) {
    $locationCity = ucwords(str_replace('-', ' ', $matches[1]));
}

$db = getDB();

try {
    // 1. Check for slot collision on this platform
    $checkStmt = $db->prepare("
        SELECT id FROM bookings 
        WHERE preferred_date = ? 
          AND LOWER(preferred_slot) = LOWER(?) 
          AND (site_id = ? OR (site_id IS NULL AND ? = 1))
          AND LOWER(status) NOT IN ('cancelled', 'lost', 'spam')
        LIMIT 1
    ");
    $checkStmt->execute([$preferredDate, $preferredSlot, $siteId, $siteId]);
    if ($checkStmt->fetch()) {
        http_response_code(409);
        echo json_encode([
            'success' => false, 
            'error' => "The {$preferredSlot} slot on {$preferredDate} is already booked. Please choose an alternative date or slot."
        ]);
        exit;
    }

    // 2. Generate unique reference ID
    $refId = $siteRefPrefix . '-' . date('ymd') . '-' . strtoupper(substr(md5(uniqid('', true)), 0, 4));

    // 3. Insert new booking
    $stmt = $db->prepare("
        INSERT INTO bookings (
            site_id, reference_id, property_type, postcode, address, loft_height,
            preferred_date, preferred_slot, name, phone, email, status,
            internal_notes, source_page, ip_address, device_type, browser,
            location_city, referrer, created_at, updated_at
        ) VALUES (
            ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, 'New',
            ?, ?, ?, ?, ?,
            ?, ?, datetime('now'), datetime('now')
        )
    ");

    $stmt->execute([
        $siteId, $refId, $propertyType, $postcode, $address, $loftHeight,
        $preferredDate, $preferredSlot, $name, $phone, $email,
        $notes, $sourcePage, $ipAddress, $deviceType, $browser,
        $locationCity, $referrer
    ]);

    $bookingId = (int)$db->lastInsertId();

    // Log to events_tracking table
    try {
        $eventStmt = $db->prepare("
            INSERT INTO events_tracking (
                site_id, event_type, event_target, source_page,
                ip_address, device_type, browser, referrer, created_at
            ) VALUES (
                ?, 'survey_booked', ?, ?,
                ?, ?, ?, ?, datetime('now')
            )
        ");
        $eventStmt->execute([
            $siteId,
            "Survey: {$refId} ({$postcode})",
            $sourcePage,
            $ipAddress,
            $deviceType,
            $browser,
            $referrer
        ]);
    } catch (Exception $e) {
        // Silently continue
    }

    // 4. Dispatch automated emails
    $bookingData = [
        'id'             => $bookingId,
        'reference_id'   => $refId,
        'name'           => $name,
        'phone'          => $phone,
        'email'          => $email,
        'postcode'       => $postcode,
        'address'        => $address,
        'property_type'  => $propertyType,
        'loft_height'    => $loftHeight,
        'preferred_date' => $preferredDate,
        'preferred_slot' => $preferredSlot,
        'source_page'    => $sourcePage,
        'ip_address'     => $ipAddress,
        'device_type'    => $deviceType,
        'location_city'  => $locationCity,
        'panel_url'      => 'panel/bookings.php?lead_id=' . $bookingId
    ];

    // Customer confirmation
    if (!empty($email)) {
        sendTemplatedEmail('booking_confirmation', $email, $name, $bookingData);
    }

    // Surveyor / Admin Alert
    $adminAlertEmail = getSetting('admin_notification_email', 'info@anotherlevelloftconversions.co.uk');
    sendTemplatedEmail('booking_admin_alert', $adminAlertEmail, 'Surveyor Dispatch', $bookingData);

    echo json_encode([
        'success'      => true,
        'booking_id'   => $bookingId,
        'reference_id' => $refId,
        'message'      => 'Survey appointment booked successfully.'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error'   => 'Server error saving booking: ' . $e->getMessage()
    ]);
}
