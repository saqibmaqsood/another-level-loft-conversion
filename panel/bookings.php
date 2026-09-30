<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();
$db = getDB();
require_once __DIR__ . '/includes/mailer.php';
require_once __DIR__ . '/includes/sites.php';

// Handle Status or Notes updates
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action'])) {
    if (!validateCSRF($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash_msg'] = 'Security validation failed.';
        $_SESSION['flash_type'] = 'error';
    } else {
        $leadId = (int)($_POST['lead_id'] ?? 0);
        
        if ($_POST['action'] === 'update_status' && $leadId > 0) {
            $newStatus = trim($_POST['status'] ?? 'new');
            $stmt = $db->prepare("UPDATE bookings SET status = ?, updated_at = datetime('now') WHERE id = ?");
            $stmt->execute([$newStatus, $leadId]);
            $_SESSION['flash_msg'] = "Lead #{$leadId} status updated to " . ucwords(str_replace('_', ' ', $newStatus));
            $_SESSION['flash_type'] = 'success';
        } elseif ($_POST['action'] === 'save_notes' && $leadId > 0) {
            $notes = trim($_POST['notes'] ?? '');
            $stmt = $db->prepare("UPDATE bookings SET internal_notes = ?, updated_at = datetime('now') WHERE id = ?");
            $stmt->execute([$notes, $leadId]);
            $_SESSION['flash_msg'] = "Survey notes updated for Lead #{$leadId}.";
            $_SESSION['flash_type'] = 'success';
        } elseif ($_POST['action'] === 'send_direct_email' && $leadId > 0) {
            $toEmail = trim($_POST['to_email'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');
            if (!empty($toEmail) && !empty($subject) && !empty($message)) {
                $sendRes = sendRawEmail($toEmail, $subject, nl2br(htmlspecialchars((string)$message)));
                if ($sendRes) {
                    $_SESSION['flash_msg'] = "Follow-up email dispatched to {$toEmail}.";
                    $_SESSION['flash_type'] = 'success';
                } else {
                    $_SESSION['flash_msg'] = "Failed to send email to {$toEmail}.";
                    $_SESSION['flash_type'] = 'error';
                }
            }
        } elseif ($_POST['action'] === 'delete_lead' && $leadId > 0) {
            $stmt = $db->prepare("DELETE FROM bookings WHERE id = ?");
            $stmt->execute([$leadId]);
            $_SESSION['flash_msg'] = "Lead #{$leadId} was permanently deleted.";
            $_SESSION['flash_type'] = 'success';
            header("Location: bookings.php");
            exit;
        } elseif ($_POST['action'] === 'mark_spam' && $leadId > 0) {
            $stmt = $db->prepare("UPDATE bookings SET status = 'spam', updated_at = datetime('now') WHERE id = ?");
            $stmt->execute([$leadId]);
            $_SESSION['flash_msg'] = "Lead #{$leadId} marked as Spam / Fake and hidden from active views. Calendar slot is released.";
            $_SESSION['flash_type'] = 'info';
            header("Location: bookings.php");
            exit;
        } elseif ($_POST['action'] === 'restore_lead' && $leadId > 0) {
            $stmt = $db->prepare("UPDATE bookings SET status = 'New', updated_at = datetime('now') WHERE id = ?");
            $stmt->execute([$leadId]);
            $_SESSION['flash_msg'] = "Lead #{$leadId} restored to active list.";
            $_SESSION['flash_type'] = 'success';
            header("Location: bookings.php?lead_id={$leadId}");
            exit;
        }
        $leadParam = isset($_GET['lead_id']) ? "?lead_id=" . (int)$_GET['lead_id'] : ($leadId > 0 ? "?lead_id=" . $leadId : "");
        header("Location: bookings.php" . $leadParam);
        exit;
    }
}

// Multi-Site Filter setup
$isAllSites = isAllSitesMode();
$activeSite = getActiveSite();
$siteFilter = buildSiteFilterSql('site_id', 'AND');

// Handle CSV Export
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=loft_leads_' . date('Y-m-d_His') . '.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, [
        'ID', 'Reference ID', 'Site/Platform', 'Date Created', 'Customer Name', 'Phone', 'Email', 'Property Type',
        'Postcode', 'Address', 'Loft Height', 'Preferred Date', 'Preferred Slot',
        'Status', 'Source Town', 'Source Page URL', 'Visitor IP', 'Device', 'Browser', 'Notes'
    ]);

    $allSql = "SELECT * FROM bookings WHERE 1=1 " . $siteFilter['clause'] . " ORDER BY id DESC";
    $allStmt = $db->prepare($allSql);
    $allStmt->execute($siteFilter['params']);
    while ($row = $allStmt->fetch(PDO::FETCH_ASSOC)) {
        $siteObj = getSiteById((int)($row['site_id'] ?? 1));
        $siteName = $siteObj ? $siteObj['name'] : 'Another Level';
        fputcsv($output, [
            $row['id'] ?? '',
            $row['reference_id'] ?? '',
            $siteName,
            $row['created_at'] ?? '',
            $row['name'] ?? '',
            $row['phone'] ?? '',
            $row['email'] ?? '',
            $row['property_type'] ?? '',
            $row['postcode'] ?? '',
            $row['address'] ?? '',
            $row['loft_height'] ?? 'Standard',
            $row['preferred_date'] ?? '',
            $row['preferred_slot'] ?? '',
            $row['status'] ?? 'New',
            $row['location_city'] ?? '',
            $row['source_page'] ?? $row['page_url'] ?? '/',
            $row['ip_address'] ?? '',
            $row['device_type'] ?? '',
            $row['browser'] ?? '',
            $row['internal_notes'] ?? ''
        ]);
    }
    fclose($output);
    exit;
}

// Filters & Search
$statusFilter = trim($_GET['status'] ?? 'all');
$searchQuery  = trim($_GET['q'] ?? '');

$spamStmt = $db->prepare("SELECT COUNT(*) FROM bookings WHERE LOWER(status) = 'spam' " . $siteFilter['clause']);
$spamStmt->execute($siteFilter['params']);
$spamCount = (int)$spamStmt->fetchColumn();

$sql = "SELECT * FROM bookings WHERE 1=1";
$params = [];

// Apply site filter
$sql .= $siteFilter['clause'];
$params = array_merge($params, $siteFilter['params']);

if ($statusFilter === 'all') {
    // Hide spam/fake leads from normal active list
    $sql .= " AND LOWER(status) != 'spam'";
} elseif ($statusFilter === 'spam') {
    $sql .= " AND LOWER(status) = 'spam'";
} elseif (!empty($statusFilter)) {
    $sql .= " AND LOWER(status) = LOWER(?)";
    $params[] = $statusFilter;
}

if (!empty($searchQuery)) {
    $sql .= " AND (name LIKE ? OR phone LIKE ? OR email LIKE ? OR postcode LIKE ? OR location_city LIKE ? OR reference_id LIKE ?)";
    $like = "%{$searchQuery}%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
}

$sql .= " ORDER BY id DESC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$leads = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Focused lead for the inspector drawer
$hasSpecificLead = isset($_GET['lead_id']) && (int)$_GET['lead_id'] > 0;
$focusedId = $hasSpecificLead ? (int)$_GET['lead_id'] : 0;
$focusedLead = null;
if ($focusedId > 0) {
    foreach ($leads as $l) {
        if ((int)$l['id'] === $focusedId) {
            $focusedLead = $l;
            break;
        }
    }
}
if (!$focusedLead && !empty($leads)) {
    $focusedLead = $leads[0];
}

$pageTitle = "Survey Leads & Bookings";
$activeNav = "bookings";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Filter & Search Bar -->
<div class="panel-card filter-search-card" style="margin-bottom:20px;padding:16px 20px">
  
  <!-- Platform Quick Filter Strip -->
  <div class="site-tabs-bar" style="display:flex;align-items:center;gap:8px;overflow-x:auto;padding-bottom:12px;margin-bottom:14px;border-bottom:1px solid #EDF2F7">
    <span style="font-size:12px;font-weight:700;color:#718096;text-transform:uppercase;margin-right:4px">Platform:</span>
    <a href="?switch_site=all" class="site-tab-pill <?php echo $isAllSites ? 'active' : ''; ?>" style="text-decoration:none;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:6px;border:1px solid <?php echo $isAllSites ? '#1A202C' : '#E2E8F0'; ?>;background:<?php echo $isAllSites ? '#1A202C' : '#FFFFFF'; ?>;color:<?php echo $isAllSites ? '#FFFFFF' : '#4A5568'; ?>">
      <span>🌐 All Sites Combined</span>
    </a>
    <?php foreach (getAllSites() as $st): $isActiveSt = (!$isAllSites && $activeSite && $activeSite['id'] == $st['id']); ?>
      <a href="?switch_site=<?php echo $st['id']; ?>" class="site-tab-pill <?php echo $isActiveSt ? 'active' : ''; ?>" style="text-decoration:none;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:6px;border:1px solid <?php echo $isActiveSt ? $st['color'] : '#E2E8F0'; ?>;background:<?php echo $isActiveSt ? $st['color'] : '#FFFFFF'; ?>;color:<?php echo $isActiveSt ? '#FFFFFF' : '#4A5568'; ?>">
        <span style="width:8px;height:8px;border-radius:50%;background:<?php echo $isActiveSt ? '#FFFFFF' : $st['color']; ?>;display:inline-block"></span>
        <span><?php echo htmlspecialchars($st['name']); ?></span>
      </a>
    <?php endforeach; ?>
  </div>

  <form method="GET" action="bookings.php" style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:14px">
    <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;flex:1;max-width:600px">
      <input 
        type="text" 
        name="q" 
        class="form-input" 
        style="height:38px;font-size:13.5px;max-width:280px" 
        placeholder="Search name, phone, postcode..." 
        value="<?php echo htmlspecialchars($searchQuery); ?>"
      >
      <select name="status" class="form-input" style="height:38px;font-size:13.5px;width:auto" onchange="this.form.submit()">
        <option value="all" <?php echo $statusFilter === 'all' ? 'selected' : ''; ?>>All Active Leads</option>
        <option value="new" <?php echo $statusFilter === 'new' ? 'selected' : ''; ?>>New Leads</option>
        <option value="survey_booked" <?php echo $statusFilter === 'survey_booked' ? 'selected' : ''; ?>>Survey Booked</option>
        <option value="cad_sent" <?php echo $statusFilter === 'cad_sent' ? 'selected' : ''; ?>>CAD Sent</option>
        <option value="won" <?php echo $statusFilter === 'won' ? 'selected' : ''; ?>>Won / Converted</option>
        <option value="lost" <?php echo $statusFilter === 'lost' ? 'selected' : ''; ?>>Lost</option>
        <option value="cancelled" <?php echo $statusFilter === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
        <option value="spam" <?php echo $statusFilter === 'spam' ? 'selected' : ''; ?>>🚫 Spam / Fake Leads (<?php echo $spamCount; ?>)</option>
      </select>
      <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
      <?php if (!empty($searchQuery) || $statusFilter !== 'all'): ?>
        <a href="bookings.php" class="btn btn-secondary btn-sm" style="color:#C53030">Reset</a>
      <?php endif; ?>
    </div>

    <div style="display:flex;align-items:center;gap:12px">
      <span style="font-size:13px;color:#718096">Showing <strong><?php echo count($leads); ?></strong> leads</span>
      <a href="bookings.php?export=csv" class="btn btn-secondary btn-sm">
        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        <span>Export CSV</span>
      </a>
    </div>
  </form>
</div>

<!-- Two-Column Leads Manager (List on Left, Lead Detail & Actions on Right) -->
<div class="panel-grid-2-1 bookings-split-layout <?php echo $hasSpecificLead ? 'show-details-mobile' : 'show-list-mobile'; ?>" style="display:grid;grid-template-columns:1.2fr 1fr;gap:24px">
  
  <!-- Left Column: Leads Table List -->
  <div class="panel-card leads-list-col" style="padding:0;overflow:hidden">
    <div class="table-responsive">
      <table class="panel-table bookings-leads-table">
        <thead>
          <tr>
            <th>Lead / Customer</th>
            <th>Site</th>
            <th>Property</th>
            <th>Survey Slot</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($leads)): ?>
            <tr>
              <td colspan="5" style="text-align:center;padding:40px;color:#A0AEC0">
                No leads match your criteria.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($leads as $lead): ?>
              <?php $isSelected = ($focusedLead && $focusedLead['id'] == $lead['id']); ?>
              <tr 
                onclick="window.location.href='bookings.php?lead_id=<?php echo $lead['id']; ?>&status=<?php echo urlencode($statusFilter); ?>&q=<?php echo urlencode($searchQuery); ?>'"
                style="cursor:pointer;<?php echo $isSelected ? 'background:#F0FDF4;border-left:4px solid #4F6B42;' : ''; ?>"
              >
                <td>
                  <div style="font-weight:700;color:#1A202C">
                    #<?php echo $lead['id']; ?> <?php echo htmlspecialchars($lead['name']); ?>
                  </div>
                  <div style="font-size:12px;color:#718096">
                    <a href="tel:<?php echo htmlspecialchars($lead['phone']); ?>" onclick="event.stopPropagation()" style="color:#4F6B42;font-weight:600;display:inline-flex;align-items:center;gap:4px">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                      <span><?php echo htmlspecialchars($lead['phone']); ?></span>
                    </a>
                  </div>
                  <div style="font-size:11px;color:#A0AEC0">
                    <?php echo date('d M Y, H:i', strtotime($lead['created_at'])); ?>
                  </div>
                </td>
                <td>
                  <?php echo renderSiteBadge($lead['site_id'] ?? 1); ?>
                </td>
                <td>
                  <div><?php echo htmlspecialchars($lead['property_type']); ?></div>
                  <span class="mono-badge"><?php echo htmlspecialchars($lead['postcode']); ?></span>
                </td>
                <td>
                  <div style="font-weight:600;font-size:13px;color:#2D3748"><?php echo htmlspecialchars($lead['preferred_date']); ?></div>
                  <div style="font-size:11.5px;color:#718096"><?php echo htmlspecialchars($lead['preferred_slot']); ?></div>
                </td>
                <td>
                  <?php if (strtolower($lead['status'] ?? '') === 'spam'): ?>
                    <span class="badge" style="background:#FEE2E2;color:#991B1B;border:1px solid #FCA5A5;font-size:11px;font-weight:700">
                      🚫 Spam / Fake
                    </span>
                  <?php else: ?>
                    <span class="badge badge-<?php echo htmlspecialchars($lead['status']); ?>">
                      <?php echo ucwords(str_replace('_', ' ', $lead['status'])); ?>
                    </span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Right Column: Focused Lead Details & Actions -->
  <div class="lead-details-col">
    <?php if ($focusedLead): ?>
      <div class="mobile-back-header">
        <a href="bookings.php<?php echo !empty($statusFilter) && $statusFilter !== 'all' ? '?status=' . urlencode($statusFilter) : ''; ?>" class="btn-mobile-back">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
          <span>Back to All Leads</span>
        </a>
      </div>
      <div class="panel-card" id="leadInspectorCard" style="position:sticky;top:90px">
        
        <!-- Header -->
        <?php if (strtolower($focusedLead['status'] ?? '') === 'spam'): ?>
          <div style="background:#FEF2F2;border:1.5px solid #FCA5A5;border-radius:6px;padding:10px 14px;margin-bottom:14px;display:flex;align-items:center;gap:10px">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.5" style="flex-shrink:0"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
            <span style="font-size:12.5px;color:#991B1B;font-weight:600">
              This lead is marked as <strong>Spam / Fake</strong>. It is hidden from active views and its calendar booking slot has been released.
            </span>
          </div>
        <?php endif; ?>

        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;padding-bottom:16px;border-bottom:1px solid #E2E8F0">
          <div>
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px">
              <span style="font-size:11px;font-family:'IBM Plex Mono',monospace;color:#6B8E5A;font-weight:700;text-transform:uppercase">
                Lead #<?php echo $focusedLead['id']; ?> &bull; Received <?php echo date('j M Y, g:ia', strtotime($focusedLead['created_at'])); ?>
              </span>
              <?php echo renderSiteBadge($focusedLead['site_id'] ?? 1); ?>
            </div>
            <h2 style="font-family:'Newsreader',Georgia,serif;font-size:24px;margin:4px 0 0;color:#1A1A1A;font-weight:400">
              <?php echo htmlspecialchars($focusedLead['name']); ?>
            </h2>
          </div>
          <?php if (strtolower($focusedLead['status'] ?? '') === 'spam'): ?>
            <span class="badge" style="background:#FEE2E2;color:#991B1B;border:1px solid #FCA5A5;font-size:12px;padding:4px 10px;font-weight:800">
              🚫 Spam / Fake
            </span>
          <?php else: ?>
            <span class="badge badge-<?php echo htmlspecialchars($focusedLead['status']); ?>" style="font-size:12px;padding:4px 10px">
              <?php echo ucwords(str_replace('_', ' ', $focusedLead['status'])); ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Quick Contacts -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:16px 0;padding:12px;background:#F8FAFC;border-radius:8px;border:1px solid #E2E8F0">
          <div>
            <div style="font-size:11px;color:#718096;font-weight:700;text-transform:uppercase">Telephone</div>
            <a href="tel:<?php echo htmlspecialchars($focusedLead['phone']); ?>" style="font-size:15px;font-weight:700;color:#4F6B42;display:flex;align-items:center;gap:6px;margin-top:2px">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <?php echo htmlspecialchars($focusedLead['phone']); ?>
            </a>
          </div>
          <div>
            <div style="font-size:11px;color:#718096;font-weight:700;text-transform:uppercase">Email</div>
            <?php if (!empty($focusedLead['email'])): ?>
              <a href="mailto:<?php echo htmlspecialchars($focusedLead['email']); ?>" style="font-size:13.5px;color:#4F6B42;word-break:break-all;display:block;margin-top:2px">
                <?php echo htmlspecialchars($focusedLead['email']); ?>
              </a>
            <?php else: ?>
              <span style="font-size:13px;color:#A0AEC0">Not provided</span>
            <?php endif; ?>
          </div>
        </div>

        <!-- Appointment & Property Details -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;font-size:13px;margin-bottom:16px">
          <div>
            <span style="color:#718096">Survey Date:</span>
            <div style="font-weight:700;color:#2D3748"><?php echo htmlspecialchars($focusedLead['preferred_date']); ?></div>
          </div>
          <div>
            <span style="color:#718096">Survey Slot:</span>
            <div style="font-weight:700;color:#2D3748"><?php echo htmlspecialchars($focusedLead['preferred_slot']); ?></div>
          </div>
          <div>
            <span style="color:#718096">Property Type:</span>
            <div style="font-weight:700;color:#2D3748"><?php echo htmlspecialchars($focusedLead['property_type']); ?></div>
          </div>
          <div>
            <span style="color:#718096">Postcode:</span>
            <div><span class="mono-badge"><?php echo htmlspecialchars($focusedLead['postcode']); ?></span></div>
          </div>
          <div>
            <span style="color:#718096">Address:</span>
            <div style="font-weight:600;color:#2D3748"><?php echo htmlspecialchars($focusedLead['address'] ?: 'Not entered'); ?></div>
          </div>
          <div>
            <span style="color:#718096">Loft Height:</span>
            <div style="font-weight:600;color:#2D3748"><?php echo htmlspecialchars($focusedLead['loft_height'] ?? 'Standard / To measure'); ?></div>
          </div>
        </div>

        <!-- Driving Directions & Route Planner Quick Action -->
        <?php 
          $leadNavDest = (!empty($focusedLead['address']) ? $focusedLead['address'] . ', ' : '') . $focusedLead['postcode'];
          $leadGmapUrl = 'https://www.google.com/maps/dir/?api=1&destination=' . urlencode($leadNavDest);
          $leadRouteUrl = 'postcodes.php?postcode=' . urlencode($focusedLead['postcode']) . '&lead_id=' . $focusedLead['id'];
        ?>
        <div style="margin:0 0 16px;padding:12px 14px;background:#EFF6FF;border:1px solid #BFDBFE;border-radius:8px;display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap">
          <div style="display:flex;align-items:center;gap:10px">
            <div style="width:32px;height:32px;border-radius:6px;background:#2563EB;color:#FFFFFF;display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
            </div>
            <div>
              <div style="font-size:12px;font-weight:700;color:#1E40AF">Customer Survey Location</div>
              <div style="font-size:11.5px;color:#2563EB"><?php echo htmlspecialchars($leadNavDest); ?></div>
            </div>
          </div>
          <div style="display:flex;align-items:center;gap:6px">
            <a href="<?php echo htmlspecialchars($leadRouteUrl); ?>" class="btn btn-secondary btn-sm" style="font-size:12px;padding:5px 9px;background:#FFFFFF;display:inline-flex;align-items:center;gap:5px">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
              <span>Route Map</span>
            </a>
            <a href="<?php echo htmlspecialchars($leadGmapUrl); ?>" target="_blank" class="btn btn-primary btn-sm" style="background:#2563EB;border-color:#1D4ED8;font-size:12px;padding:5px 10px;display:inline-flex;align-items:center;gap:5px">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
              <span>Directions &rarr;</span>
            </a>
          </div>
        </div>

        <!-- Full Customer Attribution Section -->
        <div style="margin-bottom:16px;padding:12px;background:#FAF5FF;border:1px solid #E9D8FD;border-radius:6px;font-size:12px">
          <div style="font-weight:700;color:#6B46C1;margin-bottom:6px;text-transform:uppercase;font-size:10.5px">Visitor Attribution &amp; Source Context</div>
          <div style="display:grid;gap:6px;color:#4A5568">
            <div style="display:flex;align-items:center;gap:6px"><strong>Platform / Site:</strong> <?php echo renderSiteBadge($focusedLead['site_id'] ?? 1); ?></div>
            <div><strong>Reference ID:</strong> <code><?php echo htmlspecialchars((string)($focusedLead['reference_id'] ?? 'AL-' . $focusedLead['id'])); ?></code></div>
            <?php 
              $leadSrc = $focusedLead['source_page'] ?? $focusedLead['page_url'] ?? '/';
              $leadLink = getSitePageUrl($focusedLead['site_id'] ?? 1, (string)$leadSrc);
              $leadPageTitle = formatPageLocation((string)$leadSrc);
            ?>
            <div>
              <strong>Source Page:</strong> 
              <a href="<?php echo htmlspecialchars($leadLink); ?>" target="_blank" style="color:#6B46C1;font-weight:700;text-decoration:underline;display:inline-flex;align-items:center;gap:4px">
                <span><?php echo htmlspecialchars($leadPageTitle); ?></span>
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
              </a>
            </div>
            <?php $city = $focusedLead['location_city'] ?? $focusedLead['location_town'] ?? ''; ?>
            <?php if (!empty($city)): ?>
              <div><strong>Target Town:</strong> <?php echo htmlspecialchars((string)$city); ?></div>
            <?php endif; ?>
            <div><strong>IP Address:</strong> <code><?php echo htmlspecialchars($focusedLead['ip_address'] ?? 'N/A'); ?></code> &bull; <strong>Device:</strong> <?php echo htmlspecialchars($focusedLead['device_type'] ?? 'Unknown'); ?> (<?php echo htmlspecialchars($focusedLead['browser'] ?? 'Browser'); ?>)</div>

            <?php 
              $chatLeadId = null;
              if (!empty($focusedLead['phone'])) {
                  $cleanPh = preg_replace('/[^0-9]/', '', $focusedLead['phone']);
                  if (strlen($cleanPh) >= 7) {
                      $cStmt = $db->prepare("SELECT id FROM chat_conversations WHERE REPLACE(REPLACE(REPLACE(user_phone, ' ', ''), '-', ''), '+', '') LIKE ? ORDER BY id DESC LIMIT 1");
                      $cStmt->execute(['%' . substr($cleanPh, -8) . '%']);
                      $chatLeadId = $cStmt->fetchColumn();
                  }
              }
            ?>
            <?php if ($chatLeadId): ?>
              <div style="margin-top:6px;padding-top:6px;border-top:1px dashed #DDD6FE">
                <a href="live-chats.php?id=<?php echo $chatLeadId; ?>" class="btn btn-secondary btn-sm" style="background:#F0FDF4;color:#166534;border-color:#BBF7D0;font-weight:700;display:inline-flex;align-items:center;gap:6px">
                  <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                  <span>View AI Live Chat Transcript (#<?php echo $chatLeadId; ?>) &rarr;</span>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Update Status Form -->
        <form method="POST" action="bookings.php?lead_id=<?php echo $focusedLead['id']; ?>" style="margin-bottom:16px">
          <input type="hidden" name="action" value="update_status">
          <input type="hidden" name="lead_id" value="<?php echo $focusedLead['id']; ?>">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">

          <label class="form-label" style="font-size:12px">Update Workflow Status</label>
          <div style="display:flex;gap:8px">
            <select name="status" class="form-input" style="height:38px;font-size:13px">
              <?php $st = strtolower($focusedLead['status'] ?? 'new'); ?>
              <option value="New" <?php echo $st === 'new' ? 'selected' : ''; ?>>New Lead</option>
              <option value="Survey Booked" <?php echo in_array($st, ['survey_booked', 'survey booked']) ? 'selected' : ''; ?>>Survey Booked</option>
              <option value="CAD Sent" <?php echo in_array($st, ['cad_sent', 'cad sent']) ? 'selected' : ''; ?>>3D CAD Sent</option>
              <option value="Won" <?php echo $st === 'won' ? 'selected' : ''; ?>>Won / Contract Signed</option>
              <option value="Lost" <?php echo $st === 'lost' ? 'selected' : ''; ?>>Lost / Declined</option>
              <option value="Cancelled" <?php echo $st === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
              <option value="spam" <?php echo $st === 'spam' ? 'selected' : ''; ?>>🚫 Mark as Spam / Fake (Hide)</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
          </div>
        </form>

        <!-- Internal Notes Form -->
        <form method="POST" action="bookings.php?lead_id=<?php echo $focusedLead['id']; ?>">
          <input type="hidden" name="action" value="save_notes">
          <input type="hidden" name="lead_id" value="<?php echo $focusedLead['id']; ?>">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">

          <label class="form-label" style="font-size:12px">Internal Surveyor Notes</label>
          <textarea name="notes" class="form-input" style="height:70px;resize:vertical;font-size:13px" placeholder="Add notes (e.g. Needs rear dormer + en-suite, customer home after 5pm)..."><?php echo htmlspecialchars($focusedLead['internal_notes'] ?? $focusedLead['notes'] ?? ''); ?></textarea>
          <button type="submit" class="btn btn-secondary btn-sm" style="margin-top:8px">Save Notes</button>
        </form>

        <!-- Lead Moderation: Spam/Hide & Permanent Delete -->
        <div style="margin-top:20px;padding:14px;background:#FFF5F5;border:1px solid #FED7D7;border-radius:8px">
          <div style="font-size:11.5px;font-weight:800;color:#9B2C2C;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:8px">
            Lead Moderation &amp; Removal
          </div>
          <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
            <?php if (strtolower($focusedLead['status'] ?? '') === 'spam'): ?>
              <!-- Restore Button -->
              <form method="POST" action="bookings.php?lead_id=<?php echo $focusedLead['id']; ?>" style="display:inline">
                <input type="hidden" name="action" value="restore_lead">
                <input type="hidden" name="lead_id" value="<?php echo $focusedLead['id']; ?>">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
                <button type="submit" class="btn btn-secondary btn-sm" style="color:#15803D;background:#FFFFFF;border-color:#86EFAC;display:inline-flex;align-items:center;gap:6px">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                  <span>Restore to Active Leads</span>
                </button>
              </form>
            <?php else: ?>
              <!-- Mark as Spam / Fake (Hide) Button -->
              <form method="POST" action="bookings.php" class="js-confirm-form"
                    data-confirm-title="Mark Lead as Spam / Fake?"
                    data-confirm-message="This lead will be hidden from your active list and its calendar booking slot will be released immediately."
                    data-confirm-btn="Yes, Mark as Spam"
                    data-confirm-type="warning"
                    style="display:inline">
                <input type="hidden" name="action" value="mark_spam">
                <input type="hidden" name="lead_id" value="<?php echo $focusedLead['id']; ?>">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
                <button type="submit" class="btn btn-secondary btn-sm" style="color:#C2410C;background:#FFFFFF;border-color:#FED7AA;display:inline-flex;align-items:center;gap:6px" title="Hide this lead and release the slot">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                  <span>Mark as Spam / Fake (Hide)</span>
                </button>
              </form>
            <?php endif; ?>

            <!-- Permanent Delete Button -->
            <form method="POST" action="bookings.php" class="js-confirm-form"
                  data-confirm-title="Permanently Delete Lead #<?php echo $focusedLead['id']; ?>?"
                  data-confirm-message="Are you sure you want to permanently delete Lead #<?php echo $focusedLead['id']; ?> (<?php echo htmlspecialchars(addslashes($focusedLead['name'])); ?>)? All surveyor notes and appointment records will be erased. This action cannot be undone."
                  data-confirm-btn="Yes, Delete"
                  data-confirm-type="danger"
                  style="display:inline">
              <input type="hidden" name="action" value="delete_lead">
              <input type="hidden" name="lead_id" value="<?php echo $focusedLead['id']; ?>">
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
              <button type="submit" class="btn btn-secondary btn-sm" style="color:#DC2626;background:#FFFFFF;border-color:#FECACA;display:inline-flex;align-items:center;gap:6px" title="Delete permanently from database">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                <span>Delete Permanently</span>
              </button>
            </form>
          </div>
        </div>

        <!-- Mobile Sticky Call Action Bar (Sticks above Bottom Dock on Mobile) -->
        <div class="mobile-sticky-lead-bar">
          <a href="tel:<?php echo htmlspecialchars($focusedLead['phone']); ?>" class="btn-mobile-call-action">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span>Call <?php echo htmlspecialchars(explode(' ', $focusedLead['name'])[0]); ?>: <?php echo htmlspecialchars($focusedLead['phone']); ?></span>
          </a>
        </div>

      </div>
    <?php else: ?>
      <div class="panel-card" style="text-align:center;padding:40px;color:#A0AEC0">
        Select a lead on the left to review attribution details, update progress status, or record surveyor notes.
      </div>
    <?php endif; ?>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
