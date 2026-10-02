<?php
require_once __DIR__ . '/includes/sites.php';
initSession();
$pageTitle = "Dashboard & Lead Metrics";
$activeNav = "dashboard";
require_once __DIR__ . '/includes/header.php';

// Multi-Site Filter logic
$isAllSites = isAllSitesMode();
$activeSite = getActiveSite();
$siteFilter = buildSiteFilterSql('site_id', 'AND');
$sfClause   = $siteFilter['clause'];
$sfParams   = $siteFilter['params'];

try {
    // 1. Total Leads & Pipeline
    $qTotal = $db->prepare("SELECT COUNT(*) FROM bookings WHERE LOWER(status) != 'spam' " . $sfClause);
    $qTotal->execute($sfParams);
    $totalBookings = (int)$qTotal->fetchColumn();

    $qNew = $db->prepare("SELECT COUNT(*) FROM bookings WHERE LOWER(status) = 'new' " . $sfClause);
    $qNew->execute($sfParams);
    $newBookings = (int)$qNew->fetchColumn();

    $qSurvey = $db->prepare("SELECT COUNT(*) FROM bookings WHERE LOWER(status) IN ('survey_booked', 'survey booked', 'confirmed') " . $sfClause);
    $qSurvey->execute($sfParams);
    $surveyBooked = (int)$qSurvey->fetchColumn();

    $qCad = $db->prepare("SELECT COUNT(*) FROM bookings WHERE LOWER(status) IN ('cad_sent', 'cad sent') " . $sfClause);
    $qCad->execute($sfParams);
    $cadSent = (int)$qCad->fetchColumn();

    $qWon = $db->prepare("SELECT COUNT(*) FROM bookings WHERE LOWER(status) = 'won' " . $sfClause);
    $qWon->execute($sfParams);
    $wonBookings = (int)$qWon->fetchColumn();

    $conversionRate = $totalBookings > 0 ? round(($wonBookings / $totalBookings) * 100, 1) : 0;

    // 2. Direct Inquiries (Contacts)
    $qContactsTotal = $db->prepare("SELECT COUNT(*) FROM contacts WHERE LOWER(status) != 'spam' " . $sfClause);
    $qContactsTotal->execute($sfParams);
    $totalContacts = (int)$qContactsTotal->fetchColumn();

    $qContactsNew = $db->prepare("SELECT COUNT(*) FROM contacts WHERE LOWER(status) = 'new' " . $sfClause);
    $qContactsNew->execute($sfParams);
    $newContacts = (int)$qContactsNew->fetchColumn();

    // 3. Analytics Tracking Events
    $qCall = $db->prepare("SELECT COUNT(*) FROM events_tracking WHERE event_type = 'call_click' " . $sfClause);
    $qCall->execute($sfParams);
    $callClicks = (int)$qCall->fetchColumn();

    $qChat = $db->prepare("SELECT COUNT(*) FROM events_tracking WHERE event_type = 'chat_click' " . $sfClause);
    $qChat->execute($sfParams);
    $chatClicks = (int)$qChat->fetchColumn();

    // 4. Recent Inquiries (Full unified cross-site feed)
    $recentLeadsStmt = $db->prepare("
        SELECT * FROM bookings 
        WHERE LOWER(status) != 'spam' " . $sfClause . "
        ORDER BY id DESC 
        LIMIT 10
    ");
    $recentLeadsStmt->execute($sfParams);
    $recentLeads = $recentLeadsStmt->fetchAll(PDO::FETCH_ASSOC);

    // 5. Upcoming Surveys Agenda (Next 4 scheduled appointments)
    $upcomingSurveysStmt = $db->prepare("
        SELECT id, name, phone, preferred_date, preferred_slot, property_type, postcode, site_id, status 
        FROM bookings 
        WHERE LOWER(status) IN ('survey_booked', 'confirmed') " . $sfClause . "
        ORDER BY preferred_date ASC, id ASC 
        LIMIT 4
    ");
    $upcomingSurveysStmt->execute($sfParams);
    $upcomingSurveys = $upcomingSurveysStmt->fetchAll(PDO::FETCH_ASSOC);

    // 6. Top Demand Location Towns
    $townsStmt = $db->prepare("
        SELECT location_city, COUNT(*) as lead_count 
        FROM bookings 
        WHERE location_city IS NOT NULL AND location_city != '' " . $sfClause . "
        GROUP BY location_city 
        ORDER BY lead_count DESC 
        LIMIT 5
    ");
    $townsStmt->execute($sfParams);
    $topTowns = $townsStmt->fetchAll(PDO::FETCH_ASSOC);

    // 7. Multi-Site Proportional Share Breakdown (when in All-Sites mode)
    $siteBreakdowns = [];
    $totalNetworkLeads = 0;
    if ($isAllSites) {
        $allSitesList = getAllSites();
        foreach ($allSitesList as $s) {
            $sid = (int)$s['id'];
            $stTotal = (int)$db->query("SELECT COUNT(*) FROM bookings WHERE LOWER(status) != 'spam' AND (site_id = $sid OR (site_id IS NULL AND $sid = 1))")->fetchColumn();
            $stNew   = (int)$db->query("SELECT COUNT(*) FROM bookings WHERE LOWER(status) = 'new' AND (site_id = $sid OR (site_id IS NULL AND $sid = 1))")->fetchColumn();
            $stWon   = (int)$db->query("SELECT COUNT(*) FROM bookings WHERE LOWER(status) = 'won' AND (site_id = $sid OR (site_id IS NULL AND $sid = 1))")->fetchColumn();
            $totalNetworkLeads += $stTotal;
            $siteBreakdowns[] = [
                'site'  => $s,
                'total' => $stTotal,
                'new'   => $stNew,
                'won'   => $stWon
            ];
        }
        foreach ($siteBreakdowns as &$sb) {
            $sb['share'] = $totalNetworkLeads > 0 ? round(($sb['total'] / $totalNetworkLeads) * 100) : 0;
        }
        unset($sb);
    }

} catch (Exception $e) {
    $errorMsg = $e->getMessage();
}
?>

<!-- Luxury Executive Header -->
<div class="luxury-dashboard-header">
  <div>
    <h1 class="luxury-header-title">
      <?php if ($isAllSites): ?>
        Operations Executive Hub
      <?php else: ?>
        <?php echo htmlspecialchars($activeSite['name']); ?>
      <?php endif; ?>
    </h1>
    <div class="luxury-header-sub">
      <?php if ($isAllSites): ?>
        Unified operations &bull; Multi-site intelligence across <?php echo count($siteBreakdowns); ?> active platforms
      <?php else: ?>
        Performance metrics &bull; <?php echo htmlspecialchars($activeSite['domain'] ?: $activeSite['short_name']); ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="luxury-header-actions" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">
    <div class="luxury-network-pill">
      <span style="width:7px;height:7px;border-radius:50%;background:<?php echo $isAllSites ? '#22C55E' : htmlspecialchars($activeSite['color']); ?>;display:inline-block;box-shadow:0 0 0 2px rgba(34,197,94,0.2)"></span>
      <span>
        <?php if ($isAllSites): ?>
          All Platforms Connected
        <?php else: ?>
          Filtered: <?php echo htmlspecialchars($activeSite['short_name']); ?>
        <?php endif; ?>
      </span>
    </div>

    <?php if (!$isAllSites): ?>
      <a href="?switch_site=all" class="btn btn-secondary btn-sm luxury-restore-btn" title="Restore All Platforms View" style="font-size:11.5px;padding:5px 11px;font-weight:600;white-space:nowrap;display:inline-flex;align-items:center;gap:4px">
        &times; Restore All Platforms View
      </a>
    <?php endif; ?>

    <a href="bookings.php?export=csv" class="btn btn-secondary btn-sm luxury-export-csv-btn" style="font-size:12px;padding:6px 12px">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
      <span>Export CSV</span>
    </a>
  </div>
</div>

<!-- Luxury Segmented Platform Share Bar (In Combined Mode) -->
<?php if ($isAllSites && !empty($siteBreakdowns) && $totalNetworkLeads > 0): ?>
<div class="luxury-share-strip">
  <div class="luxury-share-header">
    <span style="letter-spacing:-0.2px">Cross-Platform Lead Distribution</span>
    <span style="font-family:var(--font-mono);font-size:11.5px;color:#64748B;font-weight:600"><?php echo number_format($totalNetworkLeads); ?> Total Inquiries</span>
  </div>

  <!-- Segmented Proportional Track -->
  <div class="luxury-share-track">
    <?php foreach ($siteBreakdowns as $sb): 
      $width = max((int)$sb['share'], 3);
    ?>
      <div class="luxury-share-seg" style="width:<?php echo $width; ?>%;background:<?php echo htmlspecialchars($sb['site']['color']); ?>" title="<?php echo htmlspecialchars($sb['site']['short_name']); ?>: <?php echo $sb['share']; ?>% (<?php echo $sb['total']; ?> leads)"></div>
    <?php endforeach; ?>
  </div>

  <!-- Legend & Instant Site Filter -->
  <div class="luxury-share-legend">
    <?php foreach ($siteBreakdowns as $sb): 
      $s = $sb['site'];
    ?>
      <a href="?switch_site=<?php echo $s['id']; ?>" class="luxury-legend-item" style="text-decoration:none;color:inherit" title="Filter to <?php echo htmlspecialchars($s['name']); ?>">
        <span class="luxury-legend-dot" style="background:<?php echo htmlspecialchars($s['color']); ?>"></span>
        <strong style="font-weight:700;color:#1E293B"><?php echo htmlspecialchars($s['short_name']); ?></strong>
        <span style="font-family:var(--font-mono);color:#64748B"><?php echo $sb['share']; ?>% (<?php echo $sb['total']; ?>)</span>
      </a>
    <?php endforeach; ?>

    <a href="sites-manager.php" style="margin-left:auto;font-size:11.5px;color:#64748B;text-decoration:none;font-weight:600">
      Manage Platforms &rarr;
    </a>
  </div>
</div>
<?php endif; ?>

<!-- Luxury Minimalist KPI Matrix -->
<div class="luxury-kpi-grid">
  <!-- KPI 1: Pipeline Volume -->
  <div class="luxury-kpi-card">
    <div class="luxury-kpi-top">
      <span class="luxury-kpi-label">Survey Pipeline</span>
      <span class="luxury-chip luxury-chip-green">
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <span><?php echo $newBookings; ?> new</span>
      </span>
    </div>
    <div class="luxury-kpi-val"><?php echo number_format($totalBookings); ?></div>
    <div class="luxury-kpi-footer">
      <span>Total client booking requests</span>
    </div>
  </div>

  <!-- KPI 2: Active In-Flight -->
  <div class="luxury-kpi-card">
    <div class="luxury-kpi-top">
      <span class="luxury-kpi-label">Active In-Flight</span>
      <span class="luxury-chip luxury-chip-blue">
        <span><?php echo $cadSent; ?> CAD</span>
      </span>
    </div>
    <div class="luxury-kpi-val"><?php echo number_format($surveyBooked + $cadSent); ?></div>
    <div class="luxury-kpi-footer">
      <span><?php echo $surveyBooked; ?> booked &bull; <?php echo $cadSent; ?> in design</span>
    </div>
  </div>

  <!-- KPI 3: Won Contracts -->
  <div class="luxury-kpi-card">
    <div class="luxury-kpi-top">
      <span class="luxury-kpi-label">Converted Projects</span>
      <span class="luxury-chip luxury-chip-purple">
        <span><?php echo $conversionRate; ?>% won</span>
      </span>
    </div>
    <div class="luxury-kpi-val"><?php echo number_format($wonBookings); ?></div>
    <div class="luxury-kpi-footer">
      <span>Completed &amp; signed contracts</span>
    </div>
  </div>

  <!-- KPI 4: Direct Client Contacts -->
  <div class="luxury-kpi-card">
    <div class="luxury-kpi-top">
      <span class="luxury-kpi-label">Direct Inquiries</span>
      <span class="luxury-chip luxury-chip-amber">
        <span><?php echo $newContacts; ?> unread</span>
      </span>
    </div>
    <div class="luxury-kpi-val"><?php echo number_format($totalContacts); ?></div>
    <div class="luxury-kpi-footer">
      <span><?php echo $callClicks; ?> calls &bull; <?php echo $chatClicks; ?> chats</span>
    </div>
  </div>
</div>

<!-- Operations Row: Survey Appointments & Quick Operations (Above Latest Inquiries) -->
<div class="dashboard-operations-row">
  
  <!-- Upcoming Surveys Agenda -->
  <div class="panel-card" style="flex:1.4;min-width:0">
    <div class="panel-card-header" style="display:flex;align-items:flex-start;justify-content:space-between;gap:8px">
      <div>
        <h3 class="panel-card-title" style="line-height:1.2">Survey Appointments</h3>
        <p class="panel-card-sub" style="margin-top:3px">Next scheduled visits</p>
      </div>
      <a href="calendar.php" class="btn btn-secondary btn-sm" style="font-size:11.5px;padding:3px 9px;margin-top:1px;white-space:nowrap;line-height:1.4">Calendar &rarr;</a>
    </div>

    <?php if (empty($upcomingSurveys)): ?>
      <p style="font-size:12.5px;color:#94A3B8;margin:0;padding:8px 0">No upcoming surveys scheduled at the moment.</p>
    <?php else: ?>
      <div class="luxury-agenda-list">
        <?php foreach ($upcomingSurveys as $sLead): 
          $ts = !empty($sLead['preferred_date']) ? strtotime($sLead['preferred_date']) : null;
          $dayNum = $ts ? date('d', $ts) : '--';
          $moName = $ts ? date('M', $ts) : 'FLEX';
        ?>
          <a href="bookings.php?lead_id=<?php echo $sLead['id']; ?>" class="luxury-agenda-item">
            <div class="luxury-agenda-date">
              <span class="luxury-agenda-day"><?php echo $dayNum; ?></span>
              <span class="luxury-agenda-mo"><?php echo $moName; ?></span>
            </div>
            <div class="luxury-agenda-info">
              <div class="luxury-agenda-name"><?php echo htmlspecialchars($sLead['name']); ?></div>
              <div class="luxury-agenda-meta">
                <span><?php echo htmlspecialchars($sLead['preferred_slot'] ?: 'Flexible'); ?></span>
                <span>&bull;</span>
                <span><?php echo htmlspecialchars($sLead['postcode']); ?></span>
              </div>
            </div>
            <div class="luxury-agenda-badge">
              <?php echo renderSiteBadge($sLead['site_id'] ?? 1, true); ?>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Quick Operations & Top Towns Column -->
  <div class="dashboard-side-ops" style="flex:1;min-width:0;display:flex;flex-direction:column;gap:16px">
    
    <!-- Quick Operations -->
    <div class="panel-card">
      <div class="panel-card-header">
        <h3 class="panel-card-title">Quick Operations</h3>
      </div>
      <div style="display:grid;gap:8px">
        <a href="calendar.php" class="luxury-quick-action-link">
          <div class="luxury-quick-action-icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          </div>
          <div style="flex:1">
            <div>Booking Calendar</div>
            <div style="font-size:11px;color:#64748B;font-weight:400">Schedule &amp; surveyor slots</div>
          </div>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </a>

        <a href="live-chats.php" class="luxury-quick-action-link">
          <div class="luxury-quick-action-icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
          </div>
          <div style="flex:1">
            <div>AI Live Chat Conversations</div>
            <div style="font-size:11px;color:#64748B;font-weight:400">Visitor transcripts &amp; questions</div>
          </div>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </a>
      </div>
    </div>

    <!-- Top Towns Card -->
    <?php if (!empty($topTowns)): ?>
    <div class="panel-card">
      <div class="panel-card-header">
        <h3 class="panel-card-title">Top Demand Locations</h3>
      </div>
      <div style="display:grid;gap:8px">
        <?php foreach ($topTowns as $t): ?>
          <div style="display:flex;align-items:center;justify-content:space-between;padding:8px 12px;background:#F8FAFC;border-radius:8px;border:1px solid #E2E8F0">
            <span style="font-size:13px;font-weight:600;color:#1E293B"><?php echo htmlspecialchars($t['location_city']); ?></span>
            <span class="badge" style="background:#E2E8F0;color:#1E293B;font-weight:700"><?php echo $t['lead_count']; ?> leads</span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

  </div>
</div>

<!-- Full-Width Section: Latest Survey Inquiries (Last 10) -->
<div class="panel-card dashboard-leads-card" style="margin-top:20px;overflow:hidden">
  <div class="panel-card-header" style="display:flex;align-items:center;justify-content:space-between">
    <div>
      <h2 class="panel-card-title">Latest Survey Inquiries</h2>
      <p class="panel-card-sub">
        <?php echo $isAllSites ? 'Real-time multi-site intake across all web platforms' : 'Real-time intake for ' . htmlspecialchars($activeSite['short_name']); ?>
      </p>
    </div>
    <a href="bookings.php" class="btn btn-secondary btn-sm" style="white-space:nowrap;font-size:12px">
      View All (<?php echo $totalBookings; ?>) &rarr;
    </a>
  </div>

  <div class="table-responsive">
    <table class="panel-table dashboard-leads-table" style="width:100%">
      <thead>
        <tr>
          <th style="min-width:115px">Customer</th>
          <th style="min-width:78px">Platform</th>
          <th style="min-width:95px">Property / Postcode</th>
          <th style="min-width:92px">Survey Date</th>
          <th style="min-width:75px">Status</th>
          <th style="min-width:85px">Source Page</th>
          <th style="min-width:65px;text-align:right">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($recentLeads)): ?>
          <tr>
            <td colspan="7" style="text-align:center;padding:40px 20px;color:#94A3B8">
              <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 10px;display:block;opacity:0.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
              No bookings recorded yet for this platform view.
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($recentLeads as $lead): ?>
            <tr>
              <td>
                <strong style="color:#0F172A"><?php echo htmlspecialchars($lead['name']); ?></strong>
                <div style="font-size:11.5px;color:#64748B;margin-top:2px">
                  <a href="tel:<?php echo htmlspecialchars($lead['phone']); ?>" style="color:#475569;text-decoration:none"><?php echo htmlspecialchars($lead['phone']); ?></a>
                </div>
              </td>
              <td>
                <?php echo renderSiteBadge($lead['site_id'] ?? 1); ?>
              </td>
              <td>
                <div style="font-weight:600;color:#1E293B"><?php echo htmlspecialchars($lead['property_type'] ?: 'Loft Conversion'); ?></div>
                <span class="mono-badge" style="font-size:11px"><?php echo htmlspecialchars($lead['postcode'] ?: 'N/A'); ?></span>
              </td>
              <td>
                <div style="font-weight:600;color:#0F172A">
                  <?php echo htmlspecialchars($lead['preferred_date'] ?: 'Flexible'); ?>
                </div>
                <div style="font-size:11px;color:#64748B">
                  <?php echo htmlspecialchars($lead['preferred_slot'] ?: 'Any Slot'); ?>
                </div>
              </td>
              <td>
                <span class="badge badge-<?php echo htmlspecialchars((string)$lead['status']); ?>">
                  <?php echo ucwords(str_replace('_', ' ', (string)$lead['status'])); ?>
                </span>
              </td>
              <td style="white-space:nowrap">
                <?php 
                  $rawSrc = $lead['source_page'] ?? $lead['page_url'] ?? '/';
                  $linkUrl = getSitePageUrl($lead['site_id'] ?? 1, (string)$rawSrc);
                  $readableName = formatPageLocation((string)$rawSrc);
                ?>
                <a href="<?php echo htmlspecialchars($linkUrl); ?>" target="_blank" class="source-pill" title="View page: <?php echo htmlspecialchars($readableName); ?>">
                  <span><?php echo htmlspecialchars($readableName); ?></span>
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="opacity:0.5;flex-shrink:0"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                </a>
              </td>
              <td style="text-align:right;white-space:nowrap">
                <a href="bookings.php?lead_id=<?php echo $lead['id']; ?>" class="btn btn-sm btn-secondary" style="font-size:11px;padding:4px 9px;white-space:nowrap">
                  Review &rarr;
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
