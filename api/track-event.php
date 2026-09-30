<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed.']);
    exit;
}

require_once __DIR__ . '/../panel/includes/db.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input || !is_array($input)) {
    $input = $_POST;
}

$eventType   = trim($input['event_type'] ?? 'unknown');
$eventTarget = trim($input['event_label'] ?? $input['event_target'] ?? '');
$sourcePage  = trim($input['page_url'] ?? $_SERVER['HTTP_REFERER'] ?? '/');
$referrer    = trim($input['referrer_url'] ?? $input['referrer'] ?? $_SERVER['HTTP_REFERER'] ?? '');

// Filter out panel administrative views from public analytics
if (strpos($sourcePage, '/panel') !== false || strpos($sourcePage, 'panel/') !== false) {
    echo json_encode(['success' => true, 'ignored' => 'admin_panel']);
    exit;
}

$ipAddress       = getClientIP();
$userAgent       = $_SERVER['HTTP_USER_AGENT'] ?? '';
$isBot           = isBotUserAgent($userAgent) ? 1 : 0;
$deviceType      = getDeviceType($userAgent);
$browser         = getBrowserName($userAgent);
$durationSeconds = max(0, (int)($input['duration_seconds'] ?? 0));
$sessionId       = trim((string)($input['session_id'] ?? ''));
$trafficSource   = determineTrafficSource($referrer, $sourcePage);

$db = getDB();

try {
    // If it's a duration update / heartbeat from an active visitor session
    if ($eventType === 'time_update' && !empty($sessionId)) {
        $stmt = $db->prepare("
            UPDATE events_tracking 
            SET duration_seconds = MAX(duration_seconds, ?) 
            WHERE session_id = ?
        ");
        $stmt->execute([$durationSeconds, $sessionId]);
        echo json_encode(['success' => true, 'updated' => 'duration']);
        exit;
    }

    $stmt = $db->prepare("
        INSERT INTO events_tracking (
            event_type, event_target, source_page,
            ip_address, device_type, browser, referrer,
            traffic_source, duration_seconds, is_bot, session_id,
            created_at
        ) VALUES (
            ?, ?, ?,
            ?, ?, ?, ?,
            ?, ?, ?, ?,
            datetime('now')
        )
    ");

    $stmt->execute([
        $eventType, $eventTarget, $sourcePage,
        $ipAddress, $deviceType, $browser, $referrer,
        $trafficSource, $durationSeconds, $isBot, $sessionId
    ]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
