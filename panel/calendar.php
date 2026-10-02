<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();
$db = getDB();
require_once __DIR__ . '/includes/sites.php';

// Multi-Site Setup
$isAllSites = isAllSitesMode();
$activeSite = getActiveSite();
$siteFilter = buildSiteFilterSql('site_id', 'AND');

// Handle Month & Year navigation
$selectedYear  = isset($_GET['year']) ? (int)$_GET['year'] : 2026;
$selectedMonth = isset($_GET['month']) ? (int)$_GET['month'] : 9;

if ($selectedMonth < 1) {
    $selectedMonth = 12;
    $selectedYear--;
} elseif ($selectedMonth > 12) {
    $selectedMonth = 1;
    $selectedYear++;
}

$monthStr = sprintf('%04d-%02d', $selectedYear, $selectedMonth);
$monthName = date('F Y', strtotime("{$selectedYear}-{$selectedMonth}-01"));

// Prev and Next month links
$prevMonth = $selectedMonth - 1;
$prevYear  = $selectedYear;
if ($prevMonth < 1) { $prevMonth = 12; $prevYear--; }

$nextMonth = $selectedMonth + 1;
$nextYear  = $selectedYear;
if ($nextMonth > 12) { $nextMonth = 1; $nextYear++; }

// Handle Manual Admin Slot Booking / Blocking
$actionMsg = '';
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action']) && $_POST['action'] === 'manual_book') {
    if (!validateCSRF($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash_msg'] = 'Security validation failed.';
        $_SESSION['flash_type'] = 'error';
    } else {
        $bDate     = trim($_POST['block_date'] ?? '');
        $bSlot     = trim($_POST['block_slot'] ?? '');
        $bSiteId   = (int)($_POST['block_site_id'] ?? ($activeSite ? $activeSite['id'] : 1));
        $bName     = trim($_POST['block_name'] ?? 'Admin Reserved / Blocked');
        $bPhone    = trim($_POST['block_phone'] ?? '0800 0862744');
        $bProperty = trim($_POST['block_property'] ?? 'General');
        $bPostcode = strtoupper(trim($_POST['block_postcode'] ?? 'NORTH WEST'));
        $bNotes    = trim($_POST['block_notes'] ?? 'Reserved via Admin Calendar');

        if (!empty($bDate) && !empty($bSlot)) {
            $refId = 'AL-' . date('ymd') . '-' . strtoupper(substr(uniqid(), -4));
            $stmt = $db->prepare("
                INSERT INTO bookings (
                    site_id, reference_id, property_type, postcode, address, loft_height,
                    preferred_date, preferred_slot, name, phone, email, status,
                    internal_notes, source_page, ip_address, device_type, browser, location_city,
                    created_at, updated_at
                ) VALUES (
                    ?, ?, ?, ?, '', 'Standard',
                    ?, ?, ?, ?, '', 'survey_booked',
                    ?, 'admin_calendar', '127.0.0.1', 'Desktop', 'Admin Panel', 'Local',
                    datetime('now'), datetime('now')
                )
            ");
            $stmt->execute([$bSiteId, $refId, $bProperty, $bPostcode, $bDate, $bSlot, $bName, $bPhone, $bNotes]);
            $_SESSION['flash_msg'] = "Slot {$bSlot} on {$bDate} reserved successfully.";
            $_SESSION['flash_type'] = 'success';
            header("Location: calendar.php?year={$selectedYear}&month={$selectedMonth}");
            exit;
        }
    }
}

// Fetch all bookings for this month (with multi-site filter)
$calSql = "
    SELECT * FROM bookings 
    WHERE preferred_date LIKE ? 
      AND LOWER(status) NOT IN ('cancelled', 'lost', 'spam')
      " . $siteFilter['clause'] . "
    ORDER BY preferred_date ASC, preferred_slot ASC
";
$stmt = $db->prepare($calSql);
$calParams = array_merge(["{$monthStr}%"], $siteFilter['params']);
$stmt->execute($calParams);
$monthBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Map bookings by date string YYYY-MM-DD
$bookingsByDate = [];
foreach ($monthBookings as $b) {
    $d = $b['preferred_date'];
    if (!isset($bookingsByDate[$d])) {
        $bookingsByDate[$d] = [];
    }
    $bookingsByDate[$d][] = $b;
}

// Calendar grid calculations
$daysInMonth = function_exists('cal_days_in_month') 
    ? cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear) 
    : (int)date('t', strtotime(sprintf('%04d-%02d-01', $selectedYear, $selectedMonth)));
$firstDayOfWeek = (int)date('N', strtotime("{$selectedYear}-{$selectedMonth}-01")); // 1 (Mon) to 7 (Sun)

$pageTitle = "Interactive Booking Calendar";
$activeNav = "calendar";
require_once __DIR__ . '/includes/header.php';
?>

<div class="calendar-admin-wrap">
  
  <!-- Platform Quick Filter Strip -->
  <div class="site-tabs-bar" style="display:flex;align-items:center;gap:8px;overflow-x:auto;padding-bottom:12px;margin-bottom:16px">
    <span style="font-size:12px;font-weight:700;color:#718096;text-transform:uppercase;margin-right:4px">Platform:</span>
    <a href="?switch_site=all&year=<?php echo $selectedYear; ?>&month=<?php echo $selectedMonth; ?>" class="site-tab-pill <?php echo $isAllSites ? 'active' : ''; ?>" style="text-decoration:none;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:6px;border:1px solid <?php echo $isAllSites ? '#1A202C' : '#CBD5E1'; ?>;background:<?php echo $isAllSites ? '#1A202C' : '#FFFFFF'; ?>;color:<?php echo $isAllSites ? '#FFFFFF' : '#4A5568'; ?>">
      <span>🌐 All Sites Combined</span>
    </a>
    <?php foreach (getAllSites() as $st): $isActiveSt = (!$isAllSites && $activeSite && $activeSite['id'] == $st['id']); ?>
      <a href="?switch_site=<?php echo $st['id']; ?>&year=<?php echo $selectedYear; ?>&month=<?php echo $selectedMonth; ?>" class="site-tab-pill <?php echo $isActiveSt ? 'active' : ''; ?>" style="text-decoration:none;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:6px;border:1px solid <?php echo $isActiveSt ? $st['color'] : '#CBD5E1'; ?>;background:<?php echo $isActiveSt ? $st['color'] : '#FFFFFF'; ?>;color:<?php echo $isActiveSt ? '#FFFFFF' : '#4A5568'; ?>">
        <span style="width:8px;height:8px;border-radius:50%;background:<?php echo $isActiveSt ? '#FFFFFF' : $st['color']; ?>;display:inline-block"></span>
        <span><?php echo htmlspecialchars($st['name']); ?></span>
      </a>
    <?php endforeach; ?>
  </div>

  <!-- Calendar Header Bar -->
  <div class="panel-card calendar-header-card">
    <div class="calendar-header-flex">
      <div class="calendar-title-box">
        <h2 class="calendar-month-title">
          <?php echo htmlspecialchars($monthName); ?>
        </h2>
        <span class="badge badge-survey_booked calendar-appointments-badge">
          <?php echo count($monthBookings); ?> Survey Appointments
        </span>
      </div>

      <div class="calendar-controls-box">
        <div class="calendar-nav-buttons">
          <a href="calendar.php?year=<?php echo $prevYear; ?>&month=<?php echo $prevMonth; ?>" class="btn btn-secondary btn-sm cal-nav-btn" title="Previous Month">
            <span class="cal-nav-arrow">&larr;</span> <span class="cal-nav-text-desktop">Previous Month</span><span class="cal-nav-text-mobile">Prev</span>
          </a>
          <a href="calendar.php?year=2026&month=9" class="btn btn-secondary btn-sm cal-nav-btn cal-nav-today" title="Current Month">
            <span class="cal-nav-text-desktop">Current (Sept 2026)</span><span class="cal-nav-text-mobile">Sept 2026</span>
          </a>
          <a href="calendar.php?year=<?php echo $nextYear; ?>&month=<?php echo $nextMonth; ?>" class="btn btn-secondary btn-sm cal-nav-btn" title="Next Month">
            <span class="cal-nav-text-desktop">Next Month</span><span class="cal-nav-text-mobile">Next</span> <span class="cal-nav-arrow">&rarr;</span>
          </a>
        </div>
        <button type="button" class="btn btn-primary btn-sm cal-reserve-btn" onclick="openManualBookModal()">
          <span>+ Block / Reserve Slot</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Main Calendar Grid Card -->
  <div class="panel-card calendar-grid-card">
    <!-- Day Names Header -->
    <div class="calendar-days-header">
      <div class="cal-day-header-cell"><span class="day-full">Monday</span><span class="day-short">Mon</span></div>
      <div class="cal-day-header-cell"><span class="day-full">Tuesday</span><span class="day-short">Tue</span></div>
      <div class="cal-day-header-cell"><span class="day-full">Wednesday</span><span class="day-short">Wed</span></div>
      <div class="cal-day-header-cell"><span class="day-full">Thursday</span><span class="day-short">Thu</span></div>
      <div class="cal-day-header-cell"><span class="day-full">Friday</span><span class="day-short">Fri</span></div>
      <div class="cal-day-header-cell"><span class="day-full">Saturday</span><span class="day-short">Sat</span></div>
      <div class="cal-day-header-cell"><span class="day-full">Sunday</span><span class="day-short">Sun</span></div>
    </div>

    <!-- Days Grid -->
    <div class="calendar-days-grid">
      <?php
      // 1. Empty cells before day 1
      for ($i = 1; $i < $firstDayOfWeek; $i++) {
          echo '<div class="cal-day-empty"></div>';
      }

      // 2. Day cells
      for ($day = 1; $day <= $daysInMonth; $day++) {
          $dateFormatted = sprintf('%04d-%02d-%02d', $selectedYear, $selectedMonth, $day);
          $dayOfWeek = (int)date('N', strtotime($dateFormatted));
          $isSunday = ($dayOfWeek === 7);
          $dayBookings = $bookingsByDate[$dateFormatted] ?? [];
          $slotCount = count($dayBookings);
          $isFull = ($slotCount >= 3);
          ?>
          <div 
            class="cal-day-cell <?php echo $isSunday ? 'cal-day-sunday' : ''; ?> <?php echo $slotCount > 0 ? 'has-bookings' : ''; ?>"
            <?php if ($slotCount > 0): ?>
            onclick="handleDayCellClick(<?php echo htmlspecialchars(json_encode($dayBookings)); ?>)"
            title="<?php echo $slotCount; ?> appointment(s) - Click to view details"
            <?php endif; ?>
          >
            <div class="cal-day-top">
              <span class="cal-day-number">
                <?php echo $day; ?>
              </span>
              <?php if ($isFull): ?>
                <span class="badge cal-badge-full">FULL</span>
              <?php elseif ($slotCount > 0): ?>
                <span class="badge cal-badge-booked">
                  <span class="booked-full"><?php echo $slotCount; ?> booked</span>
                  <span class="booked-short"><?php echo $slotCount; ?></span>
                </span>
              <?php endif; ?>
            </div>

            <!-- Mobile Booking Count Pill -->
            <?php if ($slotCount > 0): ?>
              <div class="cal-mobile-booking-pill">
                <span class="cal-mobile-count"><?php echo $slotCount; ?></span>
              </div>
            <?php endif; ?>

            <!-- Desktop List of Bookings on this day -->
            <div class="cal-bookings-list">
              <?php foreach ($dayBookings as $bk): ?>
                <?php
                  $bSiteId = (int)($bk['site_id'] ?? 1);
                  $bSite = getSiteById($bSiteId);
                  $bColor = $bSite ? $bSite['color'] : '#2D4428';
                  $bShort = $bSite ? $bSite['short_name'] : 'AL';
                ?>
                <div 
                  class="cal-lead-pill" 
                  style="border-left: 3.5px solid <?php echo htmlspecialchars($bColor); ?>"
                  onclick="event.stopPropagation(); viewBookingDetails(<?php echo htmlspecialchars(json_encode($bk)); ?>)"
                  title="<?php echo htmlspecialchars($bSite ? $bSite['name'] : 'Site'); ?> - <?php echo htmlspecialchars($bk['name']); ?>"
                >
                  <div class="cal-lead-slot-row">
                    <span class="cal-lead-slot"><?php echo htmlspecialchars($bk['preferred_slot']); ?></span>
                    <span class="mono-badge" style="font-size:10px;padding:0 4px;background:<?php echo htmlspecialchars($bColor); ?>18;color:<?php echo htmlspecialchars($bColor); ?>;border-color:<?php echo htmlspecialchars($bColor); ?>40;font-weight:700"><?php echo htmlspecialchars($bShort); ?></span>
                    <span class="cal-lead-postcode"><?php echo htmlspecialchars($bk['postcode']); ?></span>
                  </div>
                  <div class="cal-lead-name">
                    <?php echo htmlspecialchars($bk['name']); ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php
      }

      // 3. Trailing blank cells
      $totalCells = ($firstDayOfWeek - 1) + $daysInMonth;
      $remainingCells = (7 - ($totalCells % 7)) % 7;
      for ($i = 0; $i < $remainingCells; $i++) {
          echo '<div class="cal-day-empty"></div>';
      }
      ?>
    </div>
  </div>
</div>

<!-- Modal 1: Lead Details -->
<div class="panel-modal-overlay" id="leadDetailModal" style="display:none">
  <div class="panel-modal-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #E2E8F0">
      <h3 style="font-family:'Manrope',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;font-size:18px;font-weight:700;margin:0;color:#1E293B;letter-spacing:-0.2px" id="mLeadTitle">Survey Appointment</h3>
      <button type="button" class="btn-close-modal" onclick="closeModal('leadDetailModal')">&times;</button>
    </div>

    <div id="mLeadBody" style="display:grid;gap:12px;font-size:13.5px">
      <!-- Injected via JS -->
    </div>

    <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px;padding-top:14px;border-top:1px solid #E2E8F0">
      <a href="bookings.php" id="mLeadLink" class="btn btn-primary btn-sm">Open in Leads Manager &rarr;</a>
      <button type="button" class="btn btn-secondary btn-sm" onclick="closeModal('leadDetailModal')">Close</button>
    </div>
  </div>
</div>

<!-- Modal 2: Block / Reserve Slot -->
<div class="panel-modal-overlay" id="manualBookModal" style="display:none">
  <div class="panel-modal-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #E2E8F0">
      <h3 style="font-family:'Manrope',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;font-size:18px;font-weight:700;margin:0;color:#1E293B;letter-spacing:-0.2px">Block / Reserve Survey Slot</h3>
      <button type="button" class="btn-close-modal" onclick="closeModal('manualBookModal')">&times;</button>
    </div>

    <form method="POST" action="calendar.php?year=<?php echo $selectedYear; ?>&month=<?php echo $selectedMonth; ?>">
      <input type="hidden" name="action" value="manual_book">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
        <div>
          <label class="form-label">Date (YYYY-MM-DD) *</label>
          <input type="date" name="block_date" class="form-input" required value="<?php echo sprintf('%04d-%02d-15', $selectedYear, $selectedMonth); ?>">
        </div>
        <div>
          <label class="form-label">Slot *</label>
          <select name="block_slot" class="form-input" required>
            <option value="Morning">Morning (08:30 – 12:00)</option>
            <option value="Afternoon">Afternoon (12:00 – 16:30)</option>
            <option value="Evening">Evening (17:00 – 19:00)</option>
          </select>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1.2fr 1fr;gap:14px;margin-bottom:14px">
        <div>
          <label class="form-label">Customer / Reason Label *</label>
          <input type="text" name="block_name" class="form-input" placeholder="e.g. Phone Booking - Mr Harrison" required>
        </div>
        <div>
          <label class="form-label">Site / Platform *</label>
          <select name="block_site_id" class="form-input">
            <?php foreach (getAllSites() as $st): ?>
              <option value="<?php echo $st['id']; ?>" <?php echo (!$isAllSites && $activeSite && $activeSite['id'] == $st['id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($st['name']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
        <div>
          <label class="form-label">Phone Contact</label>
          <input type="text" name="block_phone" class="form-input" placeholder="07700 900000" value="0800 0862744">
        </div>
        <div>
          <label class="form-label">Postcode / Area</label>
          <input type="text" name="block_postcode" class="form-input" placeholder="e.g. PR1 2AB">
        </div>
      </div>

      <div style="margin-bottom:14px">
        <label class="form-label">Property Type</label>
        <select name="block_property" class="form-input">
          <option value="Semi-detached">Semi-detached</option>
          <option value="Terrace">Terrace</option>
          <option value="Detached">Detached</option>
          <option value="Bungalow">Bungalow</option>
          <option value="Surveyor Blocked">Blocked / Holiday</option>
        </select>
      </div>

      <div style="margin-bottom:18px">
        <label class="form-label">Internal Notes</label>
        <textarea name="block_notes" class="form-input" style="height:60px;resize:vertical" placeholder="Notes for surveyor..."></textarea>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px">
        <button type="button" class="btn btn-secondary" onclick="closeModal('manualBookModal')">Cancel</button>
        <button type="submit" class="btn btn-primary">Save &amp; Lock Slot</button>
      </div>
    </form>
  </div>
</div>

<script>
const SITES_MAP = <?php echo json_encode(array_column(getAllSites(), null, 'id')); ?>;

function formatDateNice(dateStr) {
  if (!dateStr) return '';
  try {
    const parts = dateStr.split('-');
    if (parts.length === 3) {
      const d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
      return d.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
    }
  } catch(e) {}
  return dateStr;
}

const phoneSvgWhite = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;vertical-align:-2px"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>`;

function viewBookingDetails(b) {
  const modal = document.getElementById('leadDetailModal');
  const body = document.getElementById('mLeadBody');
  const title = document.getElementById('mLeadTitle');
  const link = document.getElementById('mLeadLink');

  const prettyDate = formatDateNice(b.preferred_date);
  title.textContent = prettyDate ? `Survey Appointment • ${prettyDate}` : 'Survey Appointment';

  const site = SITES_MAP[b.site_id || 1] || { name: 'Another Level', color: '#2D4428', short_name: 'AL' };
  const sourceRaw = b.source_page || b.page_url || '/';
  const cleanSource = sourceRaw.startsWith('/') ? sourceRaw : '/' + sourceRaw;
  const sourceLabel = (cleanSource === '/' || cleanSource === '/index.php') ? 'Home Page (/)' : cleanSource;
  const isLocalHost = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';
  let sourceLink = `..${cleanSource}`;
  if (parseInt(b.site_id, 10) === 2) {
    sourceLink = isLocalHost ? `http://${window.location.hostname}:8001${cleanSource}` : `https://loftconversionsnorth.co.uk${cleanSource}`;
  } else if (isLocalHost) {
    sourceLink = `http://${window.location.hostname}:8000${cleanSource}`;
  }
  const loftHeight = b.loft_height ? b.loft_height : 'Standard / To measure';
  const refId = b.reference_id || ('AL-' + (b.id ? b.id : 'REF'));
  const statusSlug = (b.status || 'new').toLowerCase().replace(/\s+/g, '_');
  const statusLabel = b.status || 'New';

  body.innerHTML = `
    <div style="background:#F8FAFC;padding:12px 14px;border-radius:8px;border:1px solid #E2E8F0;border-left:4px solid ${site.color}">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
        <strong style="font-size:15px;color:#1A202C">${b.name || 'Anonymous Lead'}</strong>
        <div style="display:flex;align-items:center;gap:6px">
          <span class="mono-badge" style="background:${site.color}15;color:${site.color};border-color:${site.color}40;font-weight:700;font-size:11px">${site.name}</span>
          <span class="mono-badge" style="font-size:11px">${refId}</span>
        </div>
      </div>
      <div style="font-size:13px;color:#4A5568"><strong>Email:</strong> ${b.email ? `<a href="mailto:${b.email}" style="color:#4F6B42">${b.email}</a>` : '<span style="color:#A0AEC0">Not provided</span>'}</div>
      <div style="font-size:13px;color:#4A5568;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-top:6px;padding-top:6px;border-top:1px dashed #E2E8F0">
        <div><strong>Phone:</strong> <a href="tel:${b.phone}" style="color:#4F6B42;font-weight:700">${b.phone || 'N/A'}</a></div>
        ${b.phone ? `
          <a href="tel:${b.phone}" class="btn btn-primary btn-sm" style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;font-size:12px;text-decoration:none;border-radius:6px;background:#4F6B42;color:#FFFFFF;border:none">
            ${phoneSvgWhite}
            <span style="color:#FFFFFF;font-weight:700">Call Now</span>
          </a>
        ` : ''}
      </div>
    </div>
    
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;font-size:13px">
      <div><span style="color:#718096">Date:</span> <strong>${prettyDate || b.preferred_date || 'N/A'}</strong></div>
      <div><span style="color:#718096">Slot:</span> <strong>${b.preferred_slot || 'N/A'}</strong></div>
      <div><span style="color:#718096">Property:</span> <strong>${b.property_type || 'General'}</strong></div>
      <div><span style="color:#718096">Postcode:</span> <code style="font-weight:700">${b.postcode || 'N/A'}</code></div>
      <div><span style="color:#718096">Loft Height:</span> <strong style="color:#2D3748;background:#EDF2F7;padding:2px 6px;border-radius:4px">${loftHeight}</strong></div>
      <div><span style="color:#718096">Status:</span> <span class="badge badge-${statusSlug}">${statusLabel}</span></div>
      <div style="grid-column:span 2"><span style="color:#718096">Address:</span> <strong>${b.address || 'Not specified'}</strong></div>
    </div>

    <div style="background:#FAF5FF;border:1px solid #E9D8FD;padding:10px 12px;border-radius:6px;font-size:12px;display:grid;gap:4px">
      <div><strong style="color:#6B46C1">Platform / Site:</strong> <span style="font-weight:700;color:${site.color}">${site.name}</span></div>
      <div><strong style="color:#6B46C1">Source Page:</strong> <a href="${sourceLink}" target="_blank" style="color:#6B46C1;font-weight:600;text-decoration:underline">${sourceLabel}</a></div>
      <div style="color:#4A5568"><strong>Attribution:</strong> IP: <code>${b.ip_address || '127.0.0.1'}</code> &bull; Town: <strong>${b.location_city || 'North West'}</strong> &bull; Device: <strong>${b.device_type || 'Desktop'}</strong></div>
    </div>

    ${(b.internal_notes || b.notes) ? `<div><strong style="font-size:12px;color:#718096">Surveyor Notes:</strong><p style="margin:4px 0 0;background:#FFFBEB;border:1px solid #FEF3C7;padding:8px 10px;border-radius:6px;color:#92400E;font-size:12.5px">${b.internal_notes || b.notes}</p></div>` : ''}
  `;

  link.href = `bookings.php?lead_id=${b.id}`;
  modal.style.display = 'flex';
}

function handleDayCellClick(bookings) {
  if (!bookings || bookings.length === 0) return;
  if (bookings.length === 1) {
    viewBookingDetails(bookings[0]);
  } else {
    showMultipleBookingsModal(bookings);
  }
}

function showMultipleBookingsModal(bookings) {
  const modal = document.getElementById('leadDetailModal');
  const body = document.getElementById('mLeadBody');
  const title = document.getElementById('mLeadTitle');
  const link = document.getElementById('mLeadLink');

  const prettyDate = formatDateNice(bookings[0].preferred_date);
  title.textContent = `${bookings.length} Appointments • ${prettyDate}`;
  link.href = 'bookings.php';
  link.textContent = 'View in Leads Manager →';

  let html = `<div style="display:grid;gap:12px">`;
  bookings.forEach(function(b) {
    const bSite = SITES_MAP[b.site_id || 1] || { name: 'Another Level', color: '#2D4428', short_name: 'AL' };
    const refId = b.reference_id || ('AL-' + (b.id ? b.id : 'REF'));
    const safeData = JSON.stringify(b).replace(/"/g, '&quot;');
    html += `
      <div style="background:#F8FAFC;padding:12px 14px;border-radius:8px;border:1px solid #E2E8F0;border-left:4px solid ${bSite.color}">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
          <strong style="font-size:15px;color:#1A202C">${b.name || 'Anonymous Lead'}</strong>
          <div style="display:flex;align-items:center;gap:6px">
            <span class="mono-badge" style="background:${bSite.color}15;color:${bSite.color};border-color:${bSite.color}40;font-weight:700;font-size:11px">${bSite.name}</span>
            <span class="mono-badge" style="font-size:11px">${refId}</span>
          </div>
        </div>
        <div style="font-size:13px;color:#4A5568;margin-bottom:4px">
          <strong>Slot:</strong> <span class="badge badge-survey_booked" style="font-size:11px">${b.preferred_slot || 'Morning'}</span> &bull; 
          <strong>Postcode:</strong> <code>${b.postcode || 'N/A'}</code>
        </div>
        <div style="font-size:13px;color:#4A5568;margin-bottom:10px">
          <strong>Phone:</strong> <a href="tel:${b.phone}" style="color:#4F6B42;font-weight:700">${b.phone || 'N/A'}</a>
        </div>
        <div style="display:flex;gap:8px">
          <a href="tel:${b.phone}" class="btn btn-primary btn-sm" style="flex:1;display:inline-flex;align-items:center;justify-content:center;gap:7px;padding:8px 12px;font-size:12.5px;text-decoration:none;border-radius:6px;background:#4F6B42;color:#FFFFFF;border:none">
            ${phoneSvgWhite}
            <span style="color:#FFFFFF;font-weight:700">Call Homeowner</span>
          </a>
          <button type="button" class="btn btn-secondary btn-sm" style="padding:8px 12px;font-size:12px;border-radius:6px" onclick="viewBookingDetails(${safeData})">Full Details</button>
        </div>
      </div>
    `;
  });
  html += `</div>`;
  body.innerHTML = html;
  modal.style.display = 'flex';
}

function openManualBookModal() {
  document.getElementById('manualBookModal').style.display = 'flex';
}

function closeModal(id) {
  document.getElementById(id).style.display = 'none';
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
