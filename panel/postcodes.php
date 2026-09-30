<?php
$pageTitle = "Postcodes & Driving Directions";
$activeNav = "postcodes";
require_once __DIR__ . '/includes/header.php';

// Helper to sanitize and lookup UK postcode
function lookupUKPostcode($raw) {
    $clean = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', (string)$raw));
    if (strlen($clean) < 5 || strlen($clean) > 7) {
        return ['success' => false, 'error' => 'Please enter a valid UK postcode format (5 to 7 characters, e.g. PR1 2AB).'];
    }

    $incode = substr($clean, -3);
    $outcode = substr($clean, 0, strlen($clean) - 3);
    $formatted = $outcode . ' ' . $incode;

    $apiUrl = 'https://api.postcodes.io/postcodes/' . urlencode($clean);
    $ctx = stream_context_create([
        'http' => [
            'timeout' => 3.5,
            'user_agent' => 'AnotherLevel-PanelRoute/1.0',
            'ignore_errors' => true
        ]
    ]);

    $resp = @file_get_contents($apiUrl, false, $ctx);
    if ($resp) {
        $json = json_decode($resp, true);
        if (!empty($json['status']) && $json['status'] === 200 && !empty($json['result'])) {
            $r = $json['result'];
            return [
                'success'   => true,
                'postcode'  => $r['postcode'],
                'town'      => $r['admin_district'] ?? $r['primary_care_trust'] ?? $r['parish'] ?? 'North West Area',
                'district'  => $r['admin_district'] ?? '',
                'county'    => $r['admin_county'] ?? $r['region'] ?? 'England',
                'region'    => $r['region'] ?? 'North West',
                'country'   => $r['country'] ?? 'England',
                'latitude'  => $r['latitude'] ?? null,
                'longitude' => $r['longitude'] ?? null,
                'outcode'   => $r['outcode'] ?? $outcode
            ];
        }
    }

    // Fallback if network offline or third party slow
    return [
        'success'   => true,
        'postcode'  => $formatted,
        'town'      => 'UK Area',
        'district'  => '',
        'county'    => 'North West England',
        'region'    => 'North West',
        'country'   => 'United Kingdom',
        'latitude'  => 53.7582, // Preston default
        'longitude' => -2.7051,
        'fallback'  => true
    ];
}

// Fetch all active booking leads that have postcodes
$leadsList = [];
try {
    $stmt = $db->query("SELECT id, name, phone, email, postcode, address, property_type, loft_height, preferred_date, preferred_slot, status, created_at 
                        FROM bookings 
                        WHERE LOWER(status) != 'spam' AND postcode IS NOT NULL AND TRIM(postcode) != '' 
                        ORDER BY preferred_date DESC, id DESC LIMIT 60");
    $leadsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {}

// Determine active query
$activePostcode = trim($_GET['postcode'] ?? $_POST['postcode'] ?? '');
$activeLeadId = (int)($_GET['lead_id'] ?? 0);
$matchedLead = null;

if ($activeLeadId > 0) {
    foreach ($leadsList as $lead) {
        if ((int)$lead['id'] === $activeLeadId) {
            $matchedLead = $lead;
            if (empty($activePostcode)) {
                $activePostcode = $lead['postcode'];
            }
            break;
        }
    }
}

if (empty($activePostcode)) {
    if (!empty($leadsList)) {
        $matchedLead = $leadsList[0];
        $activePostcode = $leadsList[0]['postcode'];
    } else {
        $activePostcode = 'PR1 2AB';
    }
}

$postcodeResult = lookupUKPostcode($activePostcode);
$foundPostcode = $postcodeResult['success'] ? $postcodeResult['postcode'] : strtoupper($activePostcode);

// Determine destination query for navigation links
$navDestination = $foundPostcode;
if ($matchedLead && !empty($matchedLead['address'])) {
    $navDestination = $matchedLead['address'] . ', ' . $foundPostcode;
}

// Another Level Headquarters (Origin for Route Calculation)
$hqAddress  = 'Old Docks House, 90 Watery Lane, Preston PR2 1AU';
$hqPostcode = 'PR2 1AU';
$hqLat      = 53.7656;
$hqLon      = -2.7303;

// 1. Google Maps driving directions with HQ origin prefilled
$gmapRouteHqUrl = 'https://www.google.com/maps/dir/?api=1&origin=' . urlencode($hqAddress) . '&destination=' . urlencode($navDestination) . '&travelmode=driving';

// 2. Google Maps directions from current GPS location
$gmapRouteGpsUrl = 'https://www.google.com/maps/dir/?api=1&destination=' . urlencode($navDestination) . '&travelmode=driving';

// 3. Direct Google Maps location search / pinpoint
$gmapSearchUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($navDestination);

// 4. Apple Maps with origin prefilled
$appleMapsUrl = 'https://maps.apple.com/?saddr=' . urlencode($hqAddress) . '&daddr=' . urlencode($navDestination) . '&dirflg=d';

// 5. Waze with navigation
$wazeUrl = 'https://waze.com/ul?q=' . urlencode($navDestination) . '&navigate=yes';
?>

<!-- Leaflet.js for Interactive Map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
/* ==========================================================================
   Postcodes & Driving Routes Responsive Layout
   ========================================================================== */
.postcodes-container {
  max-width: 1440px;
  margin: 0 auto;
  padding: 24px 20px 80px;
}

.postcodes-header-row {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 22px;
}

.postcodes-title-area h1 {
  font-family: 'Newsreader', Georgia, serif;
  font-size: 28px;
  font-weight: 500;
  color: #1A202C;
  margin: 4px 0 0;
}

.postcodes-title-area p {
  font-size: 13.5px;
  color: #718096;
  margin: 4px 0 0;
}

.postcodes-top-action {
  display: flex;
  align-items: center;
  gap: 10px;
}

.postcodes-top-btn {
  background: #2563EB;
  border-color: #1D4ED8;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  font-size: 13.5px;
  font-weight: 600;
  box-shadow: 0 2px 6px rgba(37,99,235,0.2);
}

.postcodes-search-box {
  padding: 18px 20px;
  margin-bottom: 22px;
  background: #FFFFFF;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
  border: 1px solid #E2E8F0;
}

.postcodes-search-form {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 12px;
}

.postcodes-input-wrap {
  flex: 1;
  min-width: 240px;
  position: relative;
}

.postcodes-input-field {
  padding-left: 42px !important;
  height: 46px !important;
  font-size: 15px !important;
  font-weight: 600 !important;
  font-family: 'IBM Plex Mono', monospace !important;
  text-transform: uppercase !important;
  width: 100% !important;
  box-sizing: border-box !important;
}

.postcodes-search-btn {
  height: 46px;
  padding: 0 24px;
  font-size: 14px;
  font-weight: 600;
}

.postcodes-chips-container {
  margin-top: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}

/* Custom Leaflet Route Popup with Centered Content and Prominent Close Cross */
.custom-route-popup .leaflet-popup-content-wrapper {
  border-radius: 12px;
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.2);
  padding: 4px;
  border: 1px solid #E2E8F0;
  background: #FFFFFF;
}

.custom-route-popup .leaflet-popup-content {
  margin: 12px 30px 12px 14px !important;
  line-height: 1.45;
}

.custom-route-popup a.leaflet-popup-close-button {
  top: 8px !important;
  right: 8px !important;
  width: 26px !important;
  height: 26px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  background: #F1F5F9 !important;
  border-radius: 50% !important;
  color: #1E293B !important;
  font-size: 16px !important;
  font-weight: 800 !important;
  text-decoration: none !important;
  padding: 0 !important;
  box-shadow: 0 1px 3px rgba(0,0,0,0.15) !important;
  transition: all 0.15s ease !important;
  z-index: 1000 !important;
}

.custom-route-popup a.leaflet-popup-close-button:hover {
  background: #E2E8F0 !important;
  color: #0F172A !important;
}

/* 2-Column Inspector Layout on Desktop */
.postcode-inspector-grid {
  display: grid;
  grid-template-columns: 1fr 1.35fr;
  gap: 24px;
  align-items: start;
  margin-bottom: 26px;
}

.postcodes-left-stack {
  display: grid;
  gap: 20px;
}

.postcodes-verify-card {
  padding: 22px;
  background: #FFFFFF;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
}

.postcodes-verify-head {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  padding-bottom: 16px;
  border-bottom: 1px solid #F1F5F9;
}

.postcodes-verify-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #DCFCE7;
  color: #166534;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 12px;
  font-weight: 700;
  border: 1px solid #86EFAC;
  white-space: nowrap;
  flex-shrink: 0;
}

.postcodes-geo-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
  margin-top: 18px;
  font-size: 13.5px;
}

.postcodes-nav-card {
  padding: 20px;
  background: #F8FAFC;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
}

.postcodes-map-card {
  padding: 0;
  background: #FFFFFF;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}

.postcodes-map-head {
  padding: 14px 20px;
  border-bottom: 1px solid #E2E8F0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #FAF5FF;
  flex-wrap: wrap;
  gap: 10px;
}

#surveyRouteMap {
  height: 480px;
  width: 100%;
  background: #E2E8F0;
  position: relative;
}

.postcodes-map-foot {
  padding: 12px 20px;
  background: #F8FAFC;
  border-top: 1px solid #E2E8F0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
  font-size: 12px;
  color: #64748B;
}

.postcodes-table-card {
  padding: 22px;
  background: #FFFFFF;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
}

/* Mobile Media Queries (Under 991px) */
@media (max-width: 991px) {
  .postcodes-container {
    padding: 14px 14px 90px;
  }

  .postcodes-header-row {
    flex-direction: column;
    align-items: stretch;
    gap: 14px;
    margin-bottom: 16px;
  }

  .postcodes-title-area h1 {
    font-size: 24px;
  }

  .postcodes-top-action {
    width: 100%;
  }

  .postcodes-top-btn {
    width: 100%;
    justify-content: center;
    padding: 12px 14px;
    font-size: 14px;
  }

  .postcodes-search-box {
    padding: 16px 14px;
    margin-bottom: 18px;
  }

  .postcodes-search-form {
    flex-direction: column;
    align-items: stretch;
    gap: 10px;
  }

  .postcodes-input-wrap {
    width: 100%;
    min-width: 0;
  }

  .postcodes-search-btn {
    width: 100%;
    justify-content: center;
    height: 46px;
  }

  .postcodes-chips-container {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 12px;
    overflow-x: visible;
  }

  /* Single Column Stack on Mobile */
  .postcode-inspector-grid {
    grid-template-columns: 1fr;
    gap: 18px;
    margin-bottom: 20px;
  }

  .postcodes-verify-card {
    padding: 18px 16px;
  }

  #surveyRouteMap {
    height: 320px;
  }

  .postcodes-map-head {
    padding: 12px 14px;
  }

  .postcodes-map-head #routeMetricsBadge {
    width: 100%;
    justify-content: center;
    order: 3;
    margin-top: 4px;
  }

  .postcodes-map-foot {
    padding: 10px 14px;
    font-size: 11.5px;
  }

  .postcodes-table-card {
    padding: 18px 14px;
  }
}

/* Mobile Card Transformation for Table (Under 768px) */
@media (max-width: 768px) {
  .postcodes-responsive-table thead {
    display: none;
  }

  .postcodes-responsive-table,
  .postcodes-responsive-table tbody,
  .postcodes-responsive-table tr,
  .postcodes-responsive-table td {
    display: block;
    width: 100%;
    box-sizing: border-box;
  }

  .postcodes-responsive-table tr {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 10px;
    padding: 14px;
    margin-bottom: 12px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.03);
  }

  .postcodes-responsive-table tr:last-child {
    margin-bottom: 0;
  }

  .postcodes-responsive-table td {
    padding: 4px 0 !important;
    border: none !important;
  }

  .postcodes-responsive-table td.cell-customer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 8px !important;
    border-bottom: 1px solid #F1F5F9 !important;
    margin-bottom: 8px;
  }

  .postcodes-responsive-table td.cell-actions {
    margin-top: 10px;
    padding-top: 10px !important;
    border-top: 1px solid #F1F5F9 !important;
  }

  .postcodes-responsive-table td.cell-actions .mobile-btn-group {
    display: flex !important;
    width: 100%;
    gap: 8px;
  }

  .postcodes-responsive-table td.cell-actions .mobile-btn-group a {
    flex: 1;
    text-align: center;
    justify-content: center;
    padding: 9px 12px;
    font-size: 13px;
  }

  /* Mobile Load More Visits (6 at a time) */
  .survey-visit-row.is-hidden-mobile {
    display: none !important;
  }

  .mobile-load-more-wrap {
    display: flex !important;
  }
}

@media (min-width: 769px) {
  .mobile-load-more-wrap {
    display: none !important;
  }
}
</style>

<main class="panel-content postcodes-container">
  
  <!-- Breadcrumb & Top Bar -->
  <div class="postcodes-header-row">
    <div class="postcodes-title-area">
      <div style="font-size:12px;font-family:'IBM Plex Mono',monospace;color:#6B8E5A;font-weight:700;text-transform:uppercase;letter-spacing:0.06em">
        Survey Route Planning &amp; GPS Location
      </div>
      <h1>Postcode Verification &amp; Directions</h1>
      <p>Verify UK customer addresses, calculate driving routes from Preston HQ, and launch GPS navigation.</p>
    </div>

    <!-- Quick Actions -->
    <div class="postcodes-top-action">
      <a href="<?php echo htmlspecialchars($gmapRouteHqUrl); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open(this.href, '_blank'); return true;" class="btn btn-primary postcodes-top-btn">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
        <span>Open Driving Directions (Google Maps)</span>
      </a>
    </div>
  </div>

  <!-- Search Bar & Recent Postcodes Filter -->
  <div class="panel-card postcodes-search-box">
    <form method="GET" action="postcodes.php" class="postcodes-search-form">
      <div class="postcodes-input-wrap">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#94A3B8" stroke-width="2" style="position:absolute;left:14px;top:50%;transform:translateY(-50%)"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input 
          type="text" 
          name="postcode" 
          value="<?php echo htmlspecialchars($foundPostcode); ?>" 
          placeholder="Enter UK postcode e.g. PR1 2AB, M1 2WD, WA14 5QQ..." 
          class="form-input postcodes-input-field" 
          required 
        />
      </div>
      <button type="submit" class="btn btn-primary postcodes-search-btn">
        Verify &amp; Locate
      </button>
    </form>

    <!-- Quick Pick Chips of Active Leads (Last 3 Queries Only, Fully Visible) -->
    <?php if (!empty($leadsList)): ?>
      <div class="postcodes-chips-container">
        <span style="font-size:11.5px;color:#64748B;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;flex-shrink:0">
          Recent Survey Postcodes:
        </span>
        <?php 
          $chipsShown = 0;
          foreach ($leadsList as $item): 
            if (empty($item['postcode'])) continue;
            $chipsShown++;
            if ($chipsShown > 3) break;
            $isChipActive = strtoupper(str_replace(' ', '', $item['postcode'])) === strtoupper(str_replace(' ', '', $foundPostcode));
        ?>
          <a 
            href="postcodes.php?postcode=<?php echo urlencode($item['postcode']); ?>&lead_id=<?php echo $item['id']; ?>" 
            style="display:inline-flex;align-items:center;gap:6px;padding:6px 13px;border-radius:20px;font-size:12.5px;text-decoration:none;transition:all 0.15s ease;white-space:nowrap;
                   <?php echo $isChipActive ? 'background:#1E293B;color:#FFFFFF;font-weight:700;box-shadow:0 2px 5px rgba(0,0,0,0.15)' : 'background:#F1F5F9;color:#334155;border:1px solid #CBD5E1'; ?>"
          >
            <span style="font-weight:600"><?php echo htmlspecialchars($item['name']); ?></span>
            <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;opacity:0.85">(<?php echo htmlspecialchars($item['postcode']); ?>)</span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Main Inspector Layout (2-Column on Desktop, 1-Column on Mobile) -->
  <div class="postcode-inspector-grid">
    
    <!-- Left Column: Verification Card & Navigation Details -->
    <div class="postcodes-left-stack">
      
      <!-- Postcode Verification Result Card -->
      <div class="panel-card postcodes-verify-card">
        <div class="postcodes-verify-head">
          <div>
            <div style="font-size:11px;font-family:'IBM Plex Mono',monospace;color:#475569;text-transform:uppercase;font-weight:700">
              UK National Postcode Database
            </div>
            <div style="font-size:28px;font-family:'IBM Plex Mono',monospace;font-weight:800;color:#0F172A;margin-top:4px;letter-spacing:0.04em">
              <?php echo htmlspecialchars($foundPostcode); ?>
            </div>
          </div>
          <?php if ($postcodeResult['success']): ?>
            <span class="postcodes-verify-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Verified UK Code</span>
            </span>
          <?php else: ?>
            <span class="postcodes-verify-badge" style="background:#FEE2E2;color:#991B1B;border-color:#FCA5A5">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
              <span>Verification Notice</span>
            </span>
          <?php endif; ?>
        </div>

        <!-- Geographic Details Grid -->
        <div class="postcodes-geo-grid">
          <div>
            <span style="color:#64748B;font-size:12px;text-transform:uppercase;font-weight:600">Town / District</span>
            <div style="font-weight:700;color:#1E293B;margin-top:2px">
              <?php echo htmlspecialchars($postcodeResult['town'] ?? 'Not found'); ?>
            </div>
          </div>
          <div>
            <span style="color:#64748B;font-size:12px;text-transform:uppercase;font-weight:600">County</span>
            <div style="font-weight:700;color:#1E293B;margin-top:2px">
              <?php echo htmlspecialchars($postcodeResult['county'] ?? 'England'); ?>
            </div>
          </div>
          <div>
            <span style="color:#64748B;font-size:12px;text-transform:uppercase;font-weight:600">Region</span>
            <div style="font-weight:600;color:#334155;margin-top:2px">
              <?php echo htmlspecialchars($postcodeResult['region'] ?? 'North West'); ?>
            </div>
          </div>
          <div>
            <span style="color:#64748B;font-size:12px;text-transform:uppercase;font-weight:600">GPS Coordinates</span>
            <div style="font-family:'IBM Plex Mono',monospace;font-size:12.5px;color:#334155;margin-top:2px">
              <?php echo $postcodeResult['latitude'] ? htmlspecialchars(round((float)$postcodeResult['latitude'], 4) . ', ' . round((float)$postcodeResult['longitude'], 4)) : 'Available'; ?>
            </div>
          </div>
        </div>

        <!-- Coverage Banner -->
        <div style="margin-top:18px;padding:12px 14px;background:#F0FDF4;border-radius:8px;border:1px solid #BBF7D0;display:flex;align-items:center;gap:10px">
          <div style="width:28px;height:28px;border-radius:50%;background:#22C55E;color:#FFFFFF;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
          </div>
          <div>
            <div style="font-size:13px;font-weight:700;color:#15803D">Within Primary Operating Area</div>
            <div style="font-size:12px;color:#166534">Another Level provides free physical surveys across this postcode zone.</div>
          </div>
        </div>
      </div>

      <!-- Associated Lead / Customer Card (if matched) -->
      <?php if ($matchedLead): ?>
        <div class="panel-card" style="padding:20px;background:#FFFFFF;border-radius:12px;border:1px solid #E2E8F0">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
            <span style="font-size:11px;font-weight:700;color:#6B46C1;text-transform:uppercase;letter-spacing:0.04em">
              Associated Booking Lead #<?php echo $matchedLead['id']; ?>
            </span>
            <a href="bookings.php?lead_id=<?php echo $matchedLead['id']; ?>" style="font-size:12px;font-weight:600;color:#2563EB;text-decoration:none">
              View in Leads &rarr;
            </a>
          </div>

          <div style="font-size:18px;font-weight:700;color:#0F172A">
            <?php echo htmlspecialchars($matchedLead['name']); ?>
          </div>

          <div style="margin-top:8px;font-size:13.5px;color:#334155;display:grid;gap:6px">
            <div>
              <strong>Address:</strong> 
              <span style="color:#0F172A;font-weight:600"><?php echo htmlspecialchars($matchedLead['address'] ?: 'Not entered'); ?>, <?php echo htmlspecialchars($matchedLead['postcode']); ?></span>
            </div>
            <div>
              <strong>Survey Scheduled:</strong> 
              <span><?php echo htmlspecialchars($matchedLead['preferred_date']); ?> &bull; <?php echo htmlspecialchars($matchedLead['preferred_slot']); ?></span>
            </div>
            <div>
              <strong>Property:</strong> 
              <span><?php echo htmlspecialchars($matchedLead['property_type']); ?> (Loft: <?php echo htmlspecialchars($matchedLead['loft_height'] ?: 'Standard'); ?>)</span>
            </div>
            <div>
              <strong>Phone:</strong> 
              <a href="tel:<?php echo htmlspecialchars($matchedLead['phone']); ?>" style="color:#2563EB;font-weight:700;text-decoration:none">
                <?php echo htmlspecialchars($matchedLead['phone']); ?>
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Turn-by-Turn Driving Navigation Buttons -->
      <div class="panel-card postcodes-nav-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
          <div style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.04em">
            Launch Navigation App
          </div>
          <span style="font-size:11px;color:#16A34A;font-weight:700;background:#DCFCE7;padding:2px 8px;border-radius:10px">
            HQ: Old Docks House PR2 1AU
          </span>
        </div>

        <div style="display:grid;gap:10px">
          <!-- Google Maps Button (From Preston HQ) -->
          <a href="<?php echo htmlspecialchars($gmapRouteHqUrl); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open(this.href, '_blank'); return true;" class="btn" style="background:#1E40AF;color:#FFFFFF;border:none;display:flex;align-items:center;justify-content:space-between;padding:12px 16px;border-radius:8px;font-weight:600;font-size:13.5px;text-decoration:none">
            <span style="display:flex;align-items:center;gap:10px">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
              <span>
                <strong style="display:block;font-size:13.5px">Google Maps (Route from Preston HQ)</strong>
                <small style="font-size:11px;opacity:0.85;font-weight:400">Direct driving route starting at Old Docks House</small>
              </span>
            </span>
            <span style="font-size:14px;font-weight:700">&rarr;</span>
          </a>

          <!-- Google Maps Button (From Current Device GPS) -->
          <a href="<?php echo htmlspecialchars($gmapRouteGpsUrl); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open(this.href, '_blank'); return true;" class="btn" style="background:#2563EB;color:#FFFFFF;border:none;display:flex;align-items:center;justify-content:space-between;padding:11px 16px;border-radius:8px;font-weight:600;font-size:13px;text-decoration:none">
            <span style="display:flex;align-items:center;gap:10px">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
              <span>
                <strong style="display:block;font-size:13px">Route from My Current GPS Location</strong>
                <small style="font-size:11px;opacity:0.85;font-weight:400">For surveyors already travelling on the road</small>
              </span>
            </span>
            <span style="font-size:13px;opacity:0.85">&rarr;</span>
          </a>

          <!-- Direct Pin Search on Google Maps -->
          <a href="<?php echo htmlspecialchars($gmapSearchUrl); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open(this.href, '_blank'); return true;" class="btn" style="background:#FFFFFF;color:#1E293B;border:1px solid #CBD5E1;display:flex;align-items:center;justify-content:space-between;padding:10px 16px;border-radius:8px;font-weight:600;font-size:13px;text-decoration:none">
            <span style="display:flex;align-items:center;gap:10px">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
              <span>View Property Pinpoint &amp; Satellite</span>
            </span>
            <span style="font-size:12px;color:#64748B">&rarr;</span>
          </a>

          <!-- Apple Maps Button -->
          <a href="<?php echo htmlspecialchars($appleMapsUrl); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open(this.href, '_blank'); return true;" class="btn" style="background:#0F172A;color:#FFFFFF;border:none;display:flex;align-items:center;justify-content:space-between;padding:11px 16px;border-radius:8px;font-weight:600;font-size:13px;text-decoration:none">
            <span style="display:flex;align-items:center;gap:10px">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="4"></rect><path d="M8 12h8"></path></svg>
              <span>Apple Maps (iOS / macOS)</span>
            </span>
            <span style="font-size:12px;opacity:0.8">&rarr;</span>
          </a>

          <!-- Waze Button -->
          <a href="<?php echo htmlspecialchars($wazeUrl); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open(this.href, '_blank'); return true;" class="btn" style="background:#0284C7;color:#FFFFFF;border:none;display:flex;align-items:center;justify-content:space-between;padding:11px 16px;border-radius:8px;font-weight:600;font-size:13px;text-decoration:none">
            <span style="display:flex;align-items:center;gap:10px">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"></circle><path d="M10 10h4v4h-4z"></path></svg>
              <span>Waze App (Speed Cameras &amp; Live Alerts)</span>
            </span>
            <span style="font-size:12px;opacity:0.8">&rarr;</span>
          </a>

          <!-- Copy Address Button -->
          <button type="button" class="btn btn-secondary" onclick="copyNavLocation('<?php echo addslashes($navDestination); ?>')" style="display:flex;align-items:center;justify-content:center;gap:8px;padding:10px;font-size:13px">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
            <span id="copyBtnText">Copy Full Destination Address</span>
          </button>
        </div>
      </div>

    </div>

    <!-- Right Column: Interactive Map View with Driving Route -->
    <div>
      <div class="panel-card postcodes-map-card">
        
        <!-- Map Header with Live Driving Route Metrics -->
        <div class="postcodes-map-head">
          <div style="display:flex;align-items:center;gap:10px">
            <div style="width:10px;height:10px;border-radius:50%;background:#10B981"></div>
            <div>
              <div style="font-size:13.5px;font-weight:700;color:#1E293B">
                Live Route: <?php echo htmlspecialchars($foundPostcode); ?>
              </div>
              <div style="font-size:12px;color:#64748B">
                <?php echo htmlspecialchars($postcodeResult['town'] ?? 'Area'); ?>, <?php echo htmlspecialchars($postcodeResult['county'] ?? 'Lancashire'); ?>
              </div>
            </div>
          </div>

          <!-- Live Drive Metrics Badge (Calculated from Preston HQ) -->
          <div id="routeMetricsBadge" style="display:inline-flex;align-items:center;gap:6px;background:#EFF6FF;border:1px solid #BFDBFE;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:700;color:#1D4ED8">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            <span id="routeSummaryText">Calculating driving route...</span>
          </div>

          <a href="<?php echo htmlspecialchars($gmapRouteHqUrl); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open(this.href, '_blank'); return true;" style="font-size:12px;font-weight:600;color:#2563EB;text-decoration:none;display:inline-flex;align-items:center;gap:4px">
            <span>Open in Google Maps</span>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
          </a>
        </div>

        <!-- Interactive Map Container -->
        <div id="surveyRouteMap"></div>

        <!-- Prominent Driving Distance & Travel Time Card Directly Under Map -->
        <div id="routeMetricsBottomCard" style="background:#F8FAFC;border-top:1px solid #E2E8F0;padding:16px 20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px">
          <div style="display:flex;align-items:center;gap:14px">
            <div style="width:42px;height:42px;border-radius:10px;background:#2563EB;color:#FFFFFF;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 2px 6px rgba(37,99,235,0.25)">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
            </div>
            <div>
              <div style="font-size:11.5px;font-weight:700;color:#2563EB;text-transform:uppercase;letter-spacing:0.05em">
                Estimated Driving Route (From Preston HQ)
              </div>
              <div id="routeBottomMetricsTitle" style="font-size:15px;font-weight:800;color:#0F172A;margin-top:2px">
                Calculating road distance &amp; travel time...
              </div>
            </div>
          </div>

          <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
            <!-- Distance Pill -->
            <div style="display:inline-flex;align-items:center;gap:8px;background:#EFF6FF;border:1px solid #BFDBFE;padding:7px 14px;border-radius:8px">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
              <div>
                <div style="font-size:10px;font-weight:700;color:#1E40AF;text-transform:uppercase">Driving Distance</div>
                <div id="routeBottomMiles" style="font-size:14px;font-weight:800;color:#1E3A8A">-- miles</div>
              </div>
            </div>

            <!-- Travel Time Pill -->
            <div style="display:inline-flex;align-items:center;gap:8px;background:#F0FDF4;border:1px solid #BBF7D0;padding:7px 14px;border-radius:8px">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 16"></polyline></svg>
              <div>
                <div style="font-size:10px;font-weight:700;color:#166534;text-transform:uppercase">Avg Travel Time</div>
                <div id="routeBottomEta" style="font-size:14px;font-weight:800;color:#14532D">-- mins</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Route Details Footer -->
        <div class="postcodes-map-foot">
          <div>
            <span style="color:#0F172A;font-weight:700">Origin:</span> Another Level HQ, PR2 1AU &rarr; <span style="color:#0F172A;font-weight:700">Destination:</span> <?php echo htmlspecialchars($navDestination); ?>
          </div>
          <div>
            Lat: <code><?php echo $postcodeResult['latitude'] ? round((float)$postcodeResult['latitude'], 5) : '53.7582'; ?></code>, 
            Lon: <code><?php echo $postcodeResult['longitude'] ? round((float)$postcodeResult['longitude'], 5) : '-2.7051'; ?></code>
          </div>
        </div>

      </div>
    </div>

  </div>

  <!-- Booked Surveys & Scheduled Visits List -->
  <div class="panel-card postcodes-table-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;flex-wrap:wrap;gap:8px">
      <div>
        <h2 style="font-family:'Newsreader',Georgia,serif;font-size:22px;font-weight:500;margin:0;color:#1A202C">
          Booked Surveys &amp; Scheduled On-Site Visits
        </h2>
        <p style="font-size:13px;color:#718096;margin:4px 0 0">
          All client properties scheduled for surveys. Click "Directions" to launch Google Maps driving route directly from Preston HQ.
        </p>
      </div>
      <span style="font-size:12px;font-weight:700;color:#475569;background:#F1F5F9;padding:4px 10px;border-radius:20px">
        <?php echo count($leadsList); ?> Total Survey Appointments
      </span>
    </div>

    <div class="table-responsive">
      <table class="panel-table postcodes-responsive-table" style="width:100%;font-size:13.5px">
        <thead>
          <tr style="border-bottom:2px solid #E2E8F0;text-align:left;color:#64748B;font-size:12px;text-transform:uppercase">
            <th style="padding:10px">Customer &amp; Phone</th>
            <th style="padding:10px">Survey Date &amp; Slot</th>
            <th style="padding:10px">Full Address</th>
            <th style="padding:10px">Postcode</th>
            <th style="padding:10px">Property / Loft</th>
            <th style="padding:10px;text-align:right">Driving Navigation</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($leadsList)): ?>
            <tr>
              <td colspan="6" style="text-align:center;padding:36px;color:#A0AEC0">
                No active survey bookings recorded yet.
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $visitIndex = 0;
              foreach ($leadsList as $lead): 
                $visitIndex++;
                $isHiddenMobile = ($visitIndex > 6);
                $leadDest = (!empty($lead['address']) ? $lead['address'] . ', ' : '') . $lead['postcode'];
                $gmapLeadUrl = 'https://www.google.com/maps/dir/?api=1&origin=' . urlencode($hqAddress) . '&destination=' . urlencode($leadDest) . '&travelmode=driving';
                $isCurrentInspected = strtoupper(str_replace(' ', '', $lead['postcode'])) === strtoupper(str_replace(' ', '', $foundPostcode));
            ?>
              <tr class="survey-visit-row <?php echo $isHiddenMobile ? 'is-hidden-mobile' : ''; ?> <?php echo $isCurrentInspected ? 'is-inspected-row' : ''; ?>" style="<?php echo $isCurrentInspected ? 'background:#F0FDF4;' : ''; ?>">
                <td class="cell-customer" style="padding:12px 10px">
                  <div>
                    <div style="font-weight:700;color:#0F172A"><?php echo htmlspecialchars($lead['name']); ?></div>
                    <a href="tel:<?php echo htmlspecialchars($lead['phone']); ?>" style="font-size:12.5px;color:#2563EB;text-decoration:none">
                      <?php echo htmlspecialchars($lead['phone']); ?>
                    </a>
                  </div>
                  <!-- Mobile-only inline postcode tag -->
                  <span class="mono-badge d-md-none" style="background:#E2E8F0;padding:3px 7px;border-radius:4px;font-weight:700;font-size:12px">
                    <?php echo htmlspecialchars($lead['postcode']); ?>
                  </span>
                </td>
                <td class="cell-date" style="padding:12px 10px">
                  <div style="font-weight:600;color:#1E293B"><?php echo htmlspecialchars($lead['preferred_date']); ?></div>
                  <div style="font-size:11.5px;color:#64748B"><?php echo htmlspecialchars($lead['preferred_slot']); ?></div>
                </td>
                <td class="cell-address" style="padding:12px 10px">
                  <div style="color:#334155;font-weight:500"><?php echo htmlspecialchars($lead['address'] ?: 'Not entered'); ?></div>
                </td>
                <td class="cell-postcode d-none d-md-table-cell" style="padding:12px 10px">
                  <span class="mono-badge" style="background:#E2E8F0;padding:3px 7px;border-radius:4px;font-weight:700">
                    <?php echo htmlspecialchars($lead['postcode']); ?>
                  </span>
                </td>
                <td class="cell-property" style="padding:12px 10px">
                  <div><?php echo htmlspecialchars($lead['property_type']); ?></div>
                  <div style="font-size:11.5px;color:#64748B"><?php echo htmlspecialchars($lead['loft_height'] ?: 'Standard'); ?></div>
                </td>
                <td class="cell-actions" style="padding:12px 10px;text-align:right">
                  <div class="mobile-btn-group" style="display:inline-flex;gap:6px;align-items:center">
                    <a 
                      href="postcodes.php?postcode=<?php echo urlencode($lead['postcode']); ?>&lead_id=<?php echo $lead['id']; ?>" 
                      class="btn btn-secondary btn-sm" 
                      style="font-size:12px;padding:6px 11px;border-radius:6px;display:inline-flex;align-items:center;gap:5px"
                      title="Inspect coordinates and view on map"
                    >
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                      <span>Map</span>
                    </a>
                    <a 
                      href="<?php echo htmlspecialchars($gmapLeadUrl); ?>" 
                      target="_blank" 
                      rel="noopener noreferrer"
                      onclick="window.open(this.href, '_blank'); return true;"
                      class="btn btn-primary btn-sm" 
                      style="background:#2563EB;border-color:#1D4ED8;font-size:12px;padding:6px 12px;border-radius:6px;display:inline-flex;align-items:center;gap:5px"
                      title="Open Google Maps Driving Route from Preston HQ"
                    >
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                      <span>Directions</span>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Mobile Load More Button (Show 6 Visits at a Time) -->
    <?php if (count($leadsList) > 6): ?>
      <div class="mobile-load-more-wrap" id="mobileLoadMoreContainer" style="margin-top:18px;display:none;flex-direction:column;align-items:center;gap:10px">
        <button type="button" id="btnLoadMoreVisits" class="btn" style="background:#FFFFFF;border:1.5px solid #2563EB;color:#2563EB;font-weight:700;font-size:14px;padding:12px 24px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 1px 4px rgba(37,99,235,0.1);width:100%;max-width:340px;cursor:pointer">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
          <span id="loadMoreBtnText">Load More Visits (+6)</span>
        </button>
        <div id="loadMoreVisitsCounter" style="font-size:12px;color:#64748B;font-weight:600">
          Showing 6 of <?php echo count($leadsList); ?> visits
        </div>
      </div>
    <?php endif; ?>
  </div>

</main>

<!-- Initialize Leaflet Interactive Map & Driving Route -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  var hqLat = <?php echo (float)$hqLat; ?>;
  var hqLon = <?php echo (float)$hqLon; ?>;
  var destLat = <?php echo (float)($postcodeResult['latitude'] ?? 53.7582); ?>;
  var destLon = <?php echo (float)($postcodeResult['longitude'] ?? -2.7051); ?>;
  var destination = <?php echo json_encode($navDestination); ?>;
  var postcode = <?php echo json_encode($foundPostcode); ?>;
  var town = <?php echo json_encode($postcodeResult['town'] ?? 'Area'); ?>;
  var gmapHqUrl = <?php echo json_encode($gmapRouteHqUrl); ?>;

  // Initialize Map
  var map = L.map('surveyRouteMap', {
    center: [(hqLat + destLat) / 2, (hqLon + destLon) / 2],
    zoom: 11,
    scrollWheelZoom: false
  });

  // OpenStreetMap Tile Layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // Office HQ Marker (Old Docks House, Preston) - Clean SVG building icon
  var hqIcon = L.divIcon({
    className: 'custom-hq-pin',
    html: '<div style="background:#1E293B;color:#FFFFFF;border:2px solid #FFFFFF;box-shadow:0 3px 8px rgba(0,0,0,0.3);border-radius:50%;width:34px;height:34px;display:flex;align-items:center;justify-content:center"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M3 21h18M3 7v14M21 7v14M6 11h2M6 15h2M10 11h2M10 15h2M14 11h2M14 15h2M9 21v-4h6v4M3 7l9-4 9 4"></path></svg></div>',
    iconSize: [34, 34],
    iconAnchor: [17, 17]
  });

  var hqMarker = L.marker([hqLat, hqLon], { icon: hqIcon }).addTo(map);
  hqMarker.bindPopup(
    '<div style="font-family:Manrope,sans-serif;padding:4px">' +
      '<strong style="font-size:13px;color:#1E293B">Another Level Head Office</strong><br>' +
      '<span style="font-size:12px;color:#64748B">Old Docks House, 90 Watery Lane, Preston PR2 1AU</span>' +
    '</div>'
  );

  // Customer Survey Destination Marker - Clean SVG pin icon
  var destIcon = L.divIcon({
    className: 'custom-dest-pin',
    html: '<div style="background:#2563EB;color:#FFFFFF;border:2px solid #FFFFFF;box-shadow:0 3px 8px rgba(0,0,0,0.3);border-radius:50%;width:34px;height:34px;display:flex;align-items:center;justify-content:center"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>',
    iconSize: [34, 34],
    iconAnchor: [17, 17]
  });

  var destMarker = L.marker([destLat, destLon], { icon: destIcon }).addTo(map);
  var popupHtml = '<div style="font-family:Manrope,sans-serif;padding:2px 4px;min-width:190px">' +
      '<strong style="font-size:14px;color:#0F172A;display:block">' + destination + '</strong>' +
      '<span style="font-size:12px;color:#64748B;display:block;margin-top:2px">' + town + ' &bull; Scheduled Survey</span>' +
      '<a href="' + gmapHqUrl + '" target="_blank" rel="noopener noreferrer" onclick="window.open(this.href, \'_blank\'); return true;" style="display:inline-flex;align-items:center;gap:5px;margin-top:8px;font-size:12px;color:#2563EB;font-weight:700;text-decoration:none">' +
        '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>' +
        '<span>Launch Google Maps Route &rarr;</span>' +
      '</a>' +
    '</div>';

  destMarker.bindPopup(popupHtml, {
    className: 'custom-route-popup',
    autoPan: true,
    autoPanPaddingTopLeft: L.point(40, 40),
    autoPanPaddingBottomRight: L.point(40, 40),
    closeButton: true,
    offset: [0, -12]
  });

  // Helper for straight line distance (Haversine in miles)
  function getHaversineMiles(lat1, lon1, lat2, lon2) {
    var R = 3958.8; // Radius of the earth in miles
    var dLat = (lat2 - lat1) * Math.PI / 180;
    var dLon = (lon2 - lon1) * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
            Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    return R * c;
  }

  // Fetch Real Driving Route via OSRM (Preston HQ -> Destination)
  var osrmUrl = 'https://router.project-osrm.org/route/v1/driving/' + hqLon + ',' + hqLat + ';' + destLon + ',' + destLat + '?overview=full&geometries=geojson';
  
  var controller = new AbortController();
  var timeoutId = setTimeout(function() { controller.abort(); }, 4000);

  fetch(osrmUrl, { signal: controller.signal })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      clearTimeout(timeoutId);
      if (data && data.code === 'Ok' && data.routes && data.routes.length > 0) {
        var route = data.routes[0];
        var miles = (route.distance / 1609.34).toFixed(1);
        var durationMins = Math.round(route.duration / 60);

        // Update top badge
        var summaryElem = document.getElementById('routeSummaryText');
        if (summaryElem) {
          summaryElem.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline-block;vertical-align:-2px;margin-right:4px"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg><strong>' + miles + ' miles</strong> &bull; approx. <strong>' + durationMins + ' mins</strong> from HQ';
        }

        // Update bottom prominent metrics card
        var bottomTitle = document.getElementById('routeBottomMetricsTitle');
        var bottomMiles = document.getElementById('routeBottomMiles');
        var bottomEta = document.getElementById('routeBottomEta');
        if (bottomTitle) bottomTitle.innerHTML = '<strong>' + miles + ' miles</strong> &bull; approx. <strong>' + durationMins + ' mins</strong> driving from Preston HQ';
        if (bottomMiles) bottomMiles.innerText = miles + ' miles';
        if (bottomEta) bottomEta.innerText = durationMins + ' mins';

        // Draw driving path
        var routeLayer = L.geoJSON(route.geometry, {
          style: {
            color: '#2563EB',
            weight: 5,
            opacity: 0.85,
            lineJoin: 'round'
          }
        }).addTo(map);

        // Fit map bounds with generous padding so markers and popups stay completely framed
        map.fitBounds(routeLayer.getBounds(), {
          paddingTopLeft: [50, 60],
          paddingBottomRight: [50, 50],
          maxZoom: 13
        });
        
        // Open popup after zoom animation completes
        setTimeout(function() {
          destMarker.openPopup();
        }, 300);
      } else {
        fallbackRoute();
      }
    })
    .catch(function(err) {
      clearTimeout(timeoutId);
      fallbackRoute();
    });

  function fallbackRoute() {
    // Draw clean dashed connection line & estimate distance
    var fallbackLine = L.polyline([[hqLat, hqLon], [destLat, destLon]], {
      color: '#2563EB',
      weight: 3,
      dashArray: '6, 8',
      opacity: 0.75
    }).addTo(map);

    var estMiles = getHaversineMiles(hqLat, hqLon, destLat, destLon).toFixed(1);
    var summaryElem = document.getElementById('routeSummaryText');
    if (summaryElem) {
      summaryElem.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline-block;vertical-align:-2px;margin-right:4px"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>~<strong>' + estMiles + ' miles</strong> direct distance from HQ';
    }

    var bottomTitle = document.getElementById('routeBottomMetricsTitle');
    var bottomMiles = document.getElementById('routeBottomMiles');
    var bottomEta = document.getElementById('routeBottomEta');
    if (bottomTitle) bottomTitle.innerHTML = '~' + estMiles + ' miles direct distance from Preston HQ';
    if (bottomMiles) bottomMiles.innerText = '~' + estMiles + ' miles';
    if (bottomEta) bottomEta.innerText = 'Direct distance';

    map.fitBounds(fallbackLine.getBounds(), {
      paddingTopLeft: [50, 60],
      paddingBottomRight: [50, 50],
      maxZoom: 13
    });
    setTimeout(function() {
      destMarker.openPopup();
    }, 300);
  }
});

function copyNavLocation(text) {
  navigator.clipboard.writeText(text).then(function() {
    var btn = document.getElementById('copyBtnText');
    if (btn) {
      var oldText = btn.innerText;
      btn.innerText = '✓ Copied to Clipboard!';
      setTimeout(function() {
        btn.innerText = oldText;
      }, 2000);
    }
  }).catch(function() {
    alert('Destination: ' + text);
  });
}

// Progressive Visit Cards Loading on Mobile (6 at a time)
document.addEventListener('DOMContentLoaded', function() {
  var totalRows = document.querySelectorAll('.survey-visit-row');
  var btn = document.getElementById('btnLoadMoreVisits');
  var counter = document.getElementById('loadMoreVisitsCounter');
  var btnText = document.getElementById('loadMoreBtnText');
  if (!totalRows.length || !btn) return;

  var totalCount = totalRows.length;

  function updateCounter() {
    var visibleNow = document.querySelectorAll('.survey-visit-row:not(.is-hidden-mobile)').length;
    if (counter) {
      counter.innerText = 'Showing ' + visibleNow + ' of ' + totalCount + ' visits';
    }
    if (visibleNow >= totalCount) {
      btn.style.display = 'none';
      if (counter) {
        counter.innerHTML = '<span style="color:#16A34A;font-weight:700">✓ All ' + totalCount + ' visits displayed</span>';
      }
    } else {
      var remaining = totalCount - visibleNow;
      var nextBatch = remaining < 6 ? remaining : 6;
      if (btnText) {
        btnText.innerText = 'Load More Visits (+' + nextBatch + ')';
      }
    }
  }

  btn.addEventListener('click', function(e) {
    e.preventDefault();
    var hiddenRows = document.querySelectorAll('.survey-visit-row.is-hidden-mobile');
    var batch = Array.from(hiddenRows).slice(0, 6);
    batch.forEach(function(row) {
      row.classList.remove('is-hidden-mobile');
    });
    updateCounter();
  });

  // If the currently inspected lead is beyond index 6, reveal rows up to it so it is visible
  var activeRow = document.querySelector('.survey-visit-row.is-inspected-row');
  if (activeRow && activeRow.classList.contains('is-hidden-mobile')) {
    var allRowsArr = Array.from(totalRows);
    var activeIdx = allRowsArr.indexOf(activeRow);
    if (activeIdx >= 0) {
      for (var i = 0; i <= activeIdx; i++) {
        allRowsArr[i].classList.remove('is-hidden-mobile');
      }
    }
  }

  updateCounter();
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
