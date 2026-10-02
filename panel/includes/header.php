<?php
require_once __DIR__ . '/auth.php';
requireLogin();
require_once __DIR__ . '/sites.php';

$currentUser = getCurrentUser();
$db = getDB();

$allSitesList = getAllSites();
$activeSiteId = getActiveSiteId();
$activeSite = getActiveSite();
$isAllSites = isAllSitesMode();

// Live counts for badges (filtered by active site or aggregate)
$newBookingsCount = 0;
$newContactsCount = 0;
try {
    $siteFilterB = buildSiteFilterSql('site_id', 'AND');
    $stmt = $db->prepare("SELECT COUNT(*) FROM bookings WHERE LOWER(status) = 'new'" . $siteFilterB['clause']);
    $stmt->execute($siteFilterB['params']);
    $newBookingsCount = (int)$stmt->fetchColumn();

    $siteFilterC = buildSiteFilterSql('site_id', 'AND');
    $stmt2 = $db->prepare("SELECT COUNT(*) FROM contacts WHERE LOWER(status) = 'new'" . $siteFilterC['clause']);
    $stmt2->execute($siteFilterC['params']);
    $newContactsCount = (int)$stmt2->fetchColumn();
} catch (Exception $e) {
    // Ignore db count errors in header
}

if (!isset($pageTitle)) {
    $pageTitle = "Management Panel";
}
if (!isset($activeNav)) {
    $activeNav = "dashboard";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($pageTitle); ?> &mdash; <?php echo $isAllSites ? 'Multi-Site Operations Hub' : htmlspecialchars($activeSite['short_name'] ?? 'Panel'); ?></title>
  <meta name="robots" content="noindex, nofollow">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400&family=Manrope:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="css/panel.css?v=<?php echo time(); ?>">
  <script>
    (function() {
      try {
        var mode = localStorage.getItem('al_panel_sidebar_mode');
        if (mode === 'compact') {
          document.documentElement.classList.add('sidebar-compact');
        }
      } catch (e) {}
    })();
  </script>
</head>
<body class="panel-body">

<div class="panel-wrapper">
  <!-- Mobile Sidebar Backdrop Overlay -->
  <div class="panel-sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- Left Navigation Sidebar -->
  <aside class="panel-sidebar" id="panelSidebar">
    
    <!-- Sidebar Brand Header (Clean Static Display, Site Switcher removed) -->
    <div class="sidebar-header-brand" style="padding: 18px 16px 16px; border-bottom: 1px solid rgba(255, 255, 255, 0.07);">
      <a href="index.php" style="display: flex; align-items: center; gap: 11px; text-decoration: none; color: inherit;" title="Another Level Loft Conversions">
        <div class="workspace-mark" style="background: linear-gradient(135deg, #3D5A40, #283C2A); color: #FFFFFF; width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 13px; flex-shrink: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.15);">
          AL
        </div>
        <div class="brand-text" style="display: flex; flex-direction: column; min-width: 0; overflow: hidden;">
          <span style="font-size: 14.5px; font-weight: 800; color: #FFFFFF; letter-spacing: -0.2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.2;">Another Level</span>
          <span style="font-size: 11px; color: #94A3B8; font-weight: 500; margin-top: 2px;">Operations Portal</span>
        </div>
      </a>
    </div>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Main Menu</div>
      
      <a href="index.php" class="nav-link <?php echo $activeNav === 'dashboard' ? 'active' : ''; ?>" title="Dashboard">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        <span>Dashboard</span>
      </a>

      <a href="calendar.php" class="nav-link <?php echo $activeNav === 'calendar' ? 'active' : ''; ?>" title="Booking Calendar">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        <span>Booking Calendar</span>
      </a>

      <a href="bookings.php" class="nav-link <?php echo $activeNav === 'bookings' ? 'active' : ''; ?>" title="Survey Leads">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect><path d="M9 14l2 2 4-4"></path></svg>
        <span>Survey Leads</span>
        <?php if ($newBookingsCount > 0): ?>
          <span class="nav-badge"><?php echo $newBookingsCount; ?></span>
        <?php endif; ?>
      </a>

      <a href="contacts.php" class="nav-link <?php echo $activeNav === 'contacts' ? 'active' : ''; ?>" title="Contact Queries">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        <span>Contact Queries</span>
        <?php if ($newContactsCount > 0): ?>
          <span class="nav-badge" style="background:#4A5568"><?php echo $newContactsCount; ?></span>
        <?php endif; ?>
      </a>

      <a href="postcodes.php" class="nav-link <?php echo $activeNav === 'postcodes' ? 'active' : ''; ?>" title="Postcodes &amp; Routes">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
        <span>Postcodes &amp; Routes</span>
      </a>

      <a href="live-chats.php" class="nav-link <?php echo $activeNav === 'live-chats' ? 'active' : ''; ?>" title="AI Live Chats">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        <span>AI Live Chats</span>
      </a>

      <div class="nav-section-label" style="margin-top:16px">Marketing &amp; Insights</div>

      <a href="analytics.php" class="nav-link <?php echo $activeNav === 'analytics' ? 'active' : ''; ?>" title="Analytics">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
        <span>Analytics</span>
      </a>

      <a href="email-marketing.php" class="nav-link <?php echo $activeNav === 'email' ? 'active' : ''; ?>" title="Email Marketing">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"></path><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
        <span>Email Marketing</span>
      </a>

    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user-mini" style="display:flex;align-items:center;gap:10px;padding:8px 10px;margin-bottom:8px;border-radius:8px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);">
        <div class="user-avatar" style="width:28px;height:28px;font-size:11px;background:#1E293B;color:#FFFFFF;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">
          <?php echo strtoupper(substr($currentUser['username'] ?? 'J', 0, 1)); ?>
        </div>
        <div style="flex:1;min-width:0;overflow:hidden">
          <div style="font-size:12px;font-weight:700;color:#FFFFFF;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
            <?php echo htmlspecialchars($currentUser['full_name'] ?? 'Jonny Mee'); ?>
          </div>
          <div style="font-size:10.5px;color:#94A3B8;display:flex;align-items:center;gap:5px">
            <span class="status-dot-green"></span> Online &bull; Admin
          </div>
        </div>
      </div>

      <a href="sites-manager.php" class="nav-link <?php echo $activeNav === 'sites-manager' ? 'active' : ''; ?>" title="Sites &amp; Platforms">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
        <span>Sites &amp; Platforms</span>
      </a>

      <a href="settings.php" class="nav-link <?php echo $activeNav === 'settings' ? 'active' : ''; ?>" title="Settings &amp; Alerts">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
        <span>Settings &amp; Alerts</span>
      </a>

      <button type="button" class="nav-link sidebar-footer-toggle-btn" id="sidebarFooterToggle" title="Collapse to Compact Icons" style="background:none;border:none;width:100%;cursor:pointer;text-align:left;font-family:inherit;">
        <svg class="icon-to-compact" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="9" y1="3" x2="9" y2="21"></line>
          <path d="M15 15l-3-3 3-3"></path>
        </svg>
        <svg class="icon-to-normal" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
          <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="9" y1="3" x2="9" y2="21"></line>
          <path d="M13 9l3 3-3 3"></path>
        </svg>
        <span>Compact Sidebar</span>
      </button>

      <a href="logout.php" class="nav-link nav-logout" title="Log Out" style="color:#FC8181;background:rgba(229,62,62,0.12);font-weight:700;margin-top:4px;">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color:#FC8181"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        <span>Log Out</span>
      </a>
    </div>
  </aside>

  <!-- Main Content Area -->
  <div class="panel-main">
    <!-- Top Header Bar -->
    <header class="panel-topbar">
      <div class="topbar-left">
        <button type="button" class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle navigation">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>

        <button type="button" class="desktop-sidebar-toggle" id="sidebarModeToggle" title="Collapse to Compact Icons" aria-label="Toggle sidebar width">
          <svg class="icon-to-compact" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="9" y1="3" x2="9" y2="21"></line>
            <path d="M15 15l-3-3 3-3"></path>
          </svg>
          <svg class="icon-to-normal" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="9" y1="3" x2="9" y2="21"></line>
            <path d="M13 9l3 3-3 3"></path>
          </svg>
        </button>

        <div class="mobile-topbar-brand">
          <span class="brand-logo-mark-sm" style="background: <?php echo $isAllSites ? 'linear-gradient(135deg, #1E293B, #0F172A)' : htmlspecialchars($activeSite['color']); ?>; color:#FFFFFF">
            <?php echo $isAllSites ? 'HUB' : strtoupper(substr($activeSite['short_name'] ?? 'AL', 0, 2)); ?>
          </span>
          <div>
            <h1 class="topbar-title">
              <span class="topbar-title-full"><?php echo htmlspecialchars($pageTitle); ?></span>
              <span class="topbar-title-mobile"><?php echo $activeNav === 'dashboard' ? 'Dashboard' : htmlspecialchars($pageTitle); ?></span>
            </h1>
            <div class="mobile-brand-subtitle">
              <?php if ($isAllSites): ?>
                All Websites &bull; Operations Hub
              <?php else: ?>
                <span style="color:<?php echo htmlspecialchars($activeSite['color']); ?>;font-weight:700"><?php echo htmlspecialchars($activeSite['name']); ?></span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="topbar-right">
        <!-- Site Shuffle Switcher Dropdown -->
        <div class="site-switcher-wrap" id="siteSwitcherWrap">
          <button type="button" class="site-switcher-btn" id="siteSwitcherToggle" aria-haspopup="true" aria-expanded="false" title="Switch Platform View">
            <?php if ($isAllSites): ?>
              <svg class="site-switcher-globe-icon" viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color:#0F172A;flex-shrink:0"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
              <span class="site-switcher-text">All Websites</span>
            <?php else: ?>
              <span class="site-dot" style="background:<?php echo htmlspecialchars($activeSite['color']); ?>;box-shadow:0 0 0 2px <?php echo htmlspecialchars($activeSite['badge_bg']); ?>"></span>
              <span class="site-switcher-text"><?php echo htmlspecialchars($activeSite['short_name']); ?></span>
            <?php endif; ?>
            <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color:#64748B"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <div class="site-switcher-dropdown" id="siteSwitcherMenu">
            <div class="site-dropdown-header">
              <span>Switch Platform View</span>
            </div>

            <!-- All Sites (Combined Overview) -->
            <a href="?switch_site=all" class="site-switcher-item <?php echo $isAllSites ? 'active' : ''; ?>">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#0F172A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
              <div style="flex:1;min-width:0">
                <div style="font-weight:700;color:#0F172A;font-size:13px">All Websites (Combined)</div>
                <div style="font-size:11px;color:#64748B">Mixed stats &amp; overall booking calendar</div>
              </div>
              <?php if ($isAllSites): ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0F172A" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <?php endif; ?>
            </a>

            <!-- Individual Sites -->
            <?php foreach ($allSitesList as $s): 
              $isCurrent = !$isAllSites && (int)$activeSiteId === (int)$s['id'];
            ?>
              <a href="?switch_site=<?php echo $s['id']; ?>" class="site-switcher-item <?php echo $isCurrent ? 'active' : ''; ?>">
                <span class="site-dot" style="background:<?php echo htmlspecialchars($s['color']); ?>"></span>
                <div style="flex:1;min-width:0">
                  <div style="font-weight:700;color:#0F172A;font-size:13px"><?php echo htmlspecialchars($s['name']); ?></div>
                  <div style="font-size:11px;color:#64748B"><?php echo htmlspecialchars($s['domain'] ?: 'Platform #' . $s['id']); ?></div>
                </div>
                <?php if ($isCurrent): ?>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="<?php echo htmlspecialchars($s['color']); ?>" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <?php endif; ?>
              </a>
            <?php endforeach; ?>
</div>
        </div>

        <div class="topbar-live-status">
          <span class="pulse-green"></span>
          <span>Lead Engine Active</span>
        </div>

        <a href="calendar.php" class="btn-topbar-quick" title="View Today's Bookings">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          <span>Calendar</span>
        </a>
      </div>
    </header>

    <?php if ($newBookingsCount > 0 || $newContactsCount > 0): ?>
      <!-- Mobile Native Priority Alert Banner (Instant Attention) -->
      <div class="mobile-priority-alert">
        <div class="mobile-alert-left">
          <span class="mobile-alert-pulse-dot"></span>
          <div class="mobile-alert-info">
            <strong class="mobile-alert-title">Priority Inquiries Pending</strong>
            <span class="mobile-alert-sub">
              <?php 
                $alertParts = [];
                if ($newBookingsCount > 0) $alertParts[] = "{$newBookingsCount} Survey" . ($newBookingsCount > 1 ? 's' : '');
                if ($newContactsCount > 0) $alertParts[] = "{$newContactsCount} Message" . ($newContactsCount > 1 ? 's' : '');
                echo implode(' &bull; ', $alertParts);
              ?>
            </span>
          </div>
        </div>
        <a href="<?php echo $newBookingsCount > 0 ? 'bookings.php?status=New' : 'contacts.php'; ?>" class="mobile-alert-cta">
          <span>Review</span>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </a>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_msg'])): ?>
      <div class="flash-alert flash-<?php echo htmlspecialchars($_SESSION['flash_type'] ?? 'info'); ?>" style="margin:16px 20px 0">
        <?php 
          echo htmlspecialchars($_SESSION['flash_msg']); 
          unset($_SESSION['flash_msg'], $_SESSION['flash_type']);
        ?>
      </div>
    <?php endif; ?>

    <main class="panel-content">
