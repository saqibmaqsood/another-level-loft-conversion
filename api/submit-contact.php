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

$name       = trim($input['name'] ?? '');
$email      = trim($input['email'] ?? '');
$phone      = trim($input['phone'] ?? '');
$subject    = trim($input['subject'] ?? 'General Inquiry');
$message    = trim($input['message'] ?? '');
$sourcePage = trim($input['page_url'] ?? $_SERVER['HTTP_REFERER'] ?? '/contact.php');

if (empty($name) || (empty($email) && empty($phone)) || empty($message)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Name, contact info, and message are required.']);
    exit;
}

$ipAddress  = getClientIP();
$userAgent  = $_SERVER['HTTP_USER_AGENT'] ?? '';
$deviceType = getDeviceType($userAgent);

$db = getDB();

try {
    $stmt = $db->prepare("
        INSERT INTO contacts (
            site_id, name, email, phone, subject, message,
            status, source_page, ip_address, device_type, created_at
        ) VALUES (
            ?, ?, ?, ?, ?, ?,
            'New', ?, ?, ?, datetime('now')
        )
    ");

    $stmt->execute([
        $siteId, $name, $email, $phone, $subject, $message,
        $sourcePage, $ipAddress, $deviceType
    ]);

    $contactId = (int)$db->lastInsertId();

    // Log to events_tracking table
    try {
        $eventStmt = $db->prepare("
            INSERT INTO events_tracking (
                site_id, event_type, event_target, source_page,
                ip_address, device_type, browser, created_at
            ) VALUES (
                ?, 'contact_submitted', ?, ?,
                ?, ?, ?, datetime('now')
            )
        ");
        $eventStmt->execute([
            $siteId,
            "Contact: {$name} (" . ($subject ?: 'General Query') . ")",
            $sourcePage,
            $ipAddress,
            $deviceType,
            getBrowserName($_SERVER['HTTP_USER_AGENT'] ?? '')
        ]);
    } catch (Exception $e) {}

    $contactData = [
        'id'          => $contactId,
        'name'        => $name,
        'email'       => $email,
        'phone'       => $phone,
        'subject'     => $subject,
        'message'     => $message,
        'source_page' => $sourcePage,
        'ip_address'  => $ipAddress
    ];

    // Customer confirmation email if email provided
    if (!empty($email)) {
        sendTemplatedEmail('contact_confirmation', $email, $name, $contactData);
    }

    // Admin alert email
    $adminAlertEmail = getSetting('admin_notification_email', 'info@anotherlevelloftconversions.co.uk');
    $alertHtml = "
      <p><strong>New Contact Inquiry Received</strong></p>
      <p><strong>From:</strong> " . htmlspecialchars($name) . " (" . htmlspecialchars($email) . " / " . htmlspecialchars($phone) . ")</p>
      <p><strong>Subject:</strong> " . htmlspecialchars($subject) . "</p>
      <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
      <p><strong>Source Page:</strong> " . htmlspecialchars($sourcePage) . "<br><strong>IP:</strong> {$ipAddress}</p>
    ";
    sendRawEmail($adminAlertEmail, "New Contact Message: {$name} - {$subject}", $alertHtml);

    echo json_encode([
        'success'    => true,
        'contact_id' => $contactId,
        'message'    => 'Thank you. Your message has been received and our team will get back to you shortly.'
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error'   => 'Server error saving message: ' . $e->getMessage()
    ]);
}
