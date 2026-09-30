<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$postcode = trim($_GET['postcode'] ?? $_POST['postcode'] ?? '');

if (empty($postcode)) {
    $rawInput = file_get_contents('php://input');
    if ($rawInput) {
        $data = json_decode($rawInput, true);
        $postcode = trim($data['postcode'] ?? '');
    }
}

if (empty($postcode)) {
    echo json_encode(['success' => false, 'error' => 'Postcode is required.']);
    exit;
}

// Clean and normalize postcode
$clean = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $postcode));

// Standard UK postcode format check: length 5 to 7 characters
// Outcode (2-4 chars) + Incode (3 chars: 1 digit + 2 letters)
if (strlen($clean) < 5 || strlen($clean) > 7) {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid UK postcode format. Example: PR1 2AB, BL1 4QR, M1 1AA.'
    ]);
    exit;
}

// Re-format with space: e.g. "PR12AB" -> "PR1 2AB"
$incode = substr($clean, -3);
$outcode = substr($clean, 0, strlen($clean) - 3);
$formatted = $outcode . ' ' . $incode;

// Regex validation
$ukRegex = '/^([Gg][Ii][Rr]\s?0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})$/';
if (!preg_match($ukRegex, $formatted)) {
    echo json_encode([
        'success' => false,
        'error' => "Postcode '{$formatted}' does not match standard UK postcode format."
    ]);
    exit;
}

// Lookup via postcodes.io
$apiUrl = 'https://api.postcodes.io/postcodes/' . urlencode($clean);
$ctx = stream_context_create([
    'http' => [
        'timeout' => 4,
        'user_agent' => 'AnotherLevel-PostcodeVerifier/1.0',
        'ignore_errors' => true
    ]
]);

$response = @file_get_contents($apiUrl, false, $ctx);
if ($response) {
    $resData = json_decode($response, true);
    if (!empty($resData['status']) && $resData['status'] === 200 && !empty($resData['result'])) {
        $res = $resData['result'];
        $town = $res['admin_district'] ?? $res['primary_care_trust'] ?? $res['parish'] ?? 'North West';
        $county = $res['admin_county'] ?? $res['region'] ?? 'England';
        $region = $res['region'] ?? 'North West';

        echo json_encode([
            'success'   => true,
            'postcode'  => $res['postcode'],
            'town'      => $town,
            'district'  => $res['admin_district'] ?? '',
            'county'    => $county,
            'region'    => $region,
            'country'   => $res['country'] ?? 'England',
            'latitude'  => $res['latitude'] ?? null,
            'longitude' => $res['longitude'] ?? null,
            'outcode'   => $res['outcode'] ?? $outcode
        ]);
        exit;
    } elseif (!empty($resData['status']) && $resData['status'] === 404) {
        echo json_encode([
            'success' => false,
            'error'   => "Postcode '{$formatted}' was not found in the UK National Postcode database."
        ]);
        exit;
    }
}

// Fallback: If api.postcodes.io timed out or network blocked, but format matches valid UK regex:
echo json_encode([
    'success'   => true,
    'postcode'  => $formatted,
    'town'      => 'UK Area',
    'district'  => '',
    'county'    => 'North West England',
    'region'    => 'North West',
    'country'   => 'United Kingdom',
    'latitude'  => null,
    'longitude' => null,
    'fallback'  => true
]);
