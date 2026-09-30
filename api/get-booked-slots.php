<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../panel/includes/db.php';

try {
    $db = getDB();
    
    // Fetch all active booked slots (excluding cancelled)
    $stmt = $db->query("
        SELECT preferred_date, preferred_slot, COUNT(*) as count 
        FROM bookings 
        WHERE LOWER(status) NOT IN ('cancelled', 'lost', 'spam') 
          AND preferred_date IS NOT NULL 
          AND preferred_date != ''
        GROUP BY preferred_date, preferred_slot
    ");
    $slots = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Also get dates that are completely booked (e.g. 3 slots full or blocked)
    $bookedList = [];
    foreach ($slots as $row) {
        $bookedList[] = [
            'date' => $row['preferred_date'],
            'slot' => $row['preferred_slot']
        ];
    }

    echo json_encode([
        'success' => true,
        'booked_slots' => $bookedList
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Unable to fetch availability at this time.'
    ]);
}
