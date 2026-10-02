<?php
// Default SEO parameters if not defined by the page
if (!isset($pageTitle)) {
    $pageTitle = "Another Level Loft Conversions — Fixed-price loft conversions, North West";
}
if (!isset($pageDesc)) {
    $pageDesc = "Loft conversions in Preston, Manchester, Lancashire and Cheshire. Fixed price, free CAD design, no hidden costs. Book a free survey.";
}
if (!isset($activePage)) {
    $activePage = "";
}
if (!isset($phone)) {
    $phone = "0800 0862744";
}
$telHref = "tel:" . preg_replace('/\s+/', '', $phone);
$homeHref = "index.php";

$navItems = [
    ['key' => 'types', 'label' => 'Conversion Types', 'href' => 'conversion-types.php'],
    ['key' => 'property', 'label' => 'Property Types', 'href' => 'property-types.php'],
    ['key' => 'about', 'label' => 'About', 'href' => 'about.php'],
    ['key' => 'gallery', 'label' => 'Gallery', 'href' => 'gallery.php'],
    ['key' => 'contact', 'label' => 'Contact', 'href' => 'contact.php'],
];

// Fetch Google Analytics / GTM IDs from database if present
$gaMeasurementId = '';
$gtmContainerId = '';
try {
    $sqlitePath = __DIR__ . '/../data/database.sqlite';
    if (file_exists($sqlitePath)) {
        $dbConn = new PDO("sqlite:" . $sqlitePath, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $st = $dbConn->query("SELECT key, value FROM settings WHERE key IN ('ga_measurement_id', 'gtm_container_id')");
        if ($st) {
            $settRows = $st->fetchAll(PDO::FETCH_KEY_PAIR);
            $gaMeasurementId = trim($settRows['ga_measurement_id'] ?? '');
            $gtmContainerId = trim($settRows['gtm_container_id'] ?? '');
        }
    }
} catch (Throwable $e) {
    // Graceful silent fallback
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($pageDesc); ?>">

  <?php if (!empty($gtmContainerId)): ?>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','<?php echo htmlspecialchars($gtmContainerId); ?>');</script>
  <!-- End Google Tag Manager -->
  <?php endif; ?>

  <?php if (!empty($gaMeasurementId)): ?>
  <!-- Google tag (gtag.js) GA4 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars($gaMeasurementId); ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo htmlspecialchars($gaMeasurementId); ?>', {
      'send_page_view': true
    });
  </script>
  <?php endif; ?>
  
  <!-- Open Graph / Meta -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($pageDesc); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars($ogImage ?? 'images/another-area-loft-conversions-north-west-england-01.jpeg'); ?>">
  <meta name="twitter:card" content="summary_large_image">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300;0,6..72,400;0,6..72,500;1,6..72,400&family=Manrope:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

  <!-- External Stylesheets -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">

  <!-- GSAP for Smooth Reveals -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js" defer></script>

  <!-- Application JS -->
  <script src="js/main.js" defer></script>
  <script src="js/booking.js" defer></script>
  <script src="js/events.js" defer></script>

  <?php if (isset($schemaJson)): ?>
    <script type="application/ld+json">
      <?php echo $schemaJson; ?>
    </script>
  <?php endif; ?>
</head>
<body>
<?php if (!empty($gtmContainerId)): ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo htmlspecialchars($gtmContainerId); ?>"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
<?php endif; ?>
<div class="page-wrapper">

<!-- Minimal Top Announcement & Direct Call Bar (Bayford Lofts Inspiration) -->
<div class="header-topbar">
  <div class="topbar-inner">
    <div class="topbar-left">
      <span class="topbar-highlight">North West Loft Specialists</span>
      <span class="topbar-sep">•</span>
      <span class="topbar-text">Fixed Price Guarantee · Free 3D CAD Survey</span>
    </div>
    <div class="topbar-right">
      <a href="<?php echo $telHref; ?>" class="topbar-link topbar-phone">
        <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        <span>Call: <?php echo htmlspecialchars($phone); ?></span>
      </a>
      <a href="#booking" data-open-booking class="topbar-link topbar-survey">Book Site Survey</a>
    </div>
  </div>
</div>

<!-- Main Clean Header (Bayford Lofts Style: Clear, Airy, Easy to Navigate) -->
<header class="site-header">
  <div class="header-inner">
    <a href="<?php echo $homeHref; ?>" class="brand-link" aria-label="Another Level Loft Conversions Homepage">
      <span class="brand-icon"></span>
      <span class="brand-text">
        <span class="brand-title">Another Level</span>
        <span class="brand-subtitle">Loft Conversions</span>
      </span>
    </a>

    <!-- Primary Navigation: Clean Typography & Dropdowns -->
    <nav aria-label="Primary" class="nav-desktop">
      <a href="index.php" class="nav-link <?php echo ($activePage === 'home') ? 'active' : ''; ?>">Home</a>

      <!-- Conversion Types Clean Dropdown -->
      <div class="nav-dropdown-wrapper">
        <a href="conversion-types.php" 
           class="nav-link nav-dropdown-trigger <?php echo ($activePage === 'types') ? 'active' : ''; ?>"
           <?php if ($activePage === 'types') echo 'aria-current="page"'; ?>>
          <span>Conversion Types</span>
          <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>
        </a>
        <div class="nav-dropdown-menu clean-dropdown">
          <div class="dropdown-list">
            <a href="velux-conversion.php" class="dropdown-item">
              <span class="dropdown-item-title">Velux Conversion</span>
              <span class="dropdown-item-desc">Quickest build time &amp; most affordable</span>
            </a>
            <a href="rear-dormer-conversion.php" class="dropdown-item">
              <span class="dropdown-item-title">Rear Dormer</span>
              <span class="dropdown-item-desc">Maximum usable floor space &amp; headroom</span>
            </a>
            <a href="hip-to-gable-conversion.php" class="dropdown-item">
              <span class="dropdown-item-title">Hip-to-Gable</span>
              <span class="dropdown-item-desc">Ideal for 1930s semi-detached homes</span>
            </a>
            <a href="hip-end-dormer-conversion.php" class="dropdown-item">
              <span class="dropdown-item-title">Hip-End Dormer</span>
              <span class="dropdown-item-desc">Preserves original roofline aesthetics</span>
            </a>
            <a href="wrap-around-conversion.php" class="dropdown-item">
              <span class="dropdown-item-title">Wrap Around</span>
              <span class="dropdown-item-desc">Ultimate master suite &amp; 2 full bedrooms</span>
            </a>
            <a href="roof-lift-conversion.php" class="dropdown-item">
              <span class="dropdown-item-title">Roof-Lift</span>
              <span class="dropdown-item-desc">For shallow pitch roofs &amp; bungalows</span>
            </a>
          </div>
          <div class="dropdown-footer">
            <a href="conversion-types.php">Compare all 6 conversion types →</a>
          </div>
        </div>
      </div>

      <!-- Property Types Clean Dropdown -->
      <div class="nav-dropdown-wrapper">
        <a href="property-types.php" 
           class="nav-link nav-dropdown-trigger <?php echo ($activePage === 'property') ? 'active' : ''; ?>"
           <?php if ($activePage === 'property') echo 'aria-current="page"'; ?>>
          <span>Property Types</span>
          <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>
        </a>
        <div class="nav-dropdown-menu clean-dropdown">
          <div class="dropdown-list">
            <a href="terrace-property.php" class="dropdown-item">
              <span class="dropdown-item-title">Terraced Homes</span>
              <span class="dropdown-item-desc">Rear dormers &amp; smart space planning</span>
            </a>
            <a href="semi-detached-property.php" class="dropdown-item">
              <span class="dropdown-item-title">Semi-Detached</span>
              <span class="dropdown-item-desc">Hip-to-gable &amp; dormer conversions</span>
            </a>
            <a href="detached-property.php" class="dropdown-item">
              <span class="dropdown-item-title">Detached Homes</span>
              <span class="dropdown-item-desc">Full upper floor &amp; wrap-around potential</span>
            </a>
            <a href="bungalow-property.php" class="dropdown-item">
              <span class="dropdown-item-title">Bungalows</span>
              <span class="dropdown-item-desc">Dormer additions &amp; complete roof-lifts</span>
            </a>
          </div>
          <div class="dropdown-footer">
            <a href="property-types.php">Compare all property types →</a>
          </div>
        </div>
      </div>

      <!-- About Us Clean Dropdown -->
      <div class="nav-dropdown-wrapper">
        <a href="about.php" 
           class="nav-link nav-dropdown-trigger <?php echo in_array($activePage, ['about', 'start-to-finish', 'guarantee', 'testimonials']) ? 'active' : ''; ?>"
           <?php if ($activePage === 'about') echo 'aria-current="page"'; ?>>
          <span>About</span>
          <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>
        </a>
        <div class="nav-dropdown-menu clean-dropdown">
          <div class="dropdown-list">
            <a href="about.php" class="dropdown-item">
              <span class="dropdown-item-title">About Another Level</span>
              <span class="dropdown-item-desc">18+ years family-run specialists</span>
            </a>
            <a href="start-to-finish-how-your-loft-is-built.php" class="dropdown-item">
              <span class="dropdown-item-title">Start To Finish</span>
              <span class="dropdown-item-desc">Our 8-step scaffold-first build process</span>
            </a>
            <a href="our-guarantee.php" class="dropdown-item">
              <span class="dropdown-item-title">Our Guarantee</span>
              <span class="dropdown-item-desc">6-year structural warranty &amp; fixed-price</span>
            </a>
            <a href="customer-testimonials.php" class="dropdown-item">
              <span class="dropdown-item-title">Customer Reviews</span>
              <span class="dropdown-item-desc">9.8/10 from 400+ North West homeowners</span>
            </a>
          </div>
          <div class="dropdown-footer">
            <a href="about.php">Learn about our philosophy &amp; team →</a>
          </div>
        </div>
      </div>

      <a href="gallery.php" class="nav-link <?php echo ($activePage === 'gallery') ? 'active' : ''; ?>">Gallery</a>
      <a href="contact.php" class="nav-link <?php echo ($activePage === 'contact') ? 'active' : ''; ?>">Contact</a>
    </nav>

    <!-- Header Actions (Direct Call + Clean CTA) -->
    <div class="header-actions">
      <a href="<?php echo $telHref; ?>" class="header-phone" aria-label="Call Jonny Mee">
        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        <span><?php echo htmlspecialchars($phone); ?></span>
      </a>
      <a href="#booking" data-open-booking class="header-book-btn">Book Free Survey</a>
      <button type="button" class="burger-btn" aria-label="Toggle navigation menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>

  <!-- Clean, Intuitive Mobile Navigation Drawer (Bayford Lofts Style) -->
  <nav aria-label="Mobile Navigation" class="nav-mobile-drawer">
    <div class="mobile-drawer-inner">
      <div class="mobile-nav-list">
        <a href="index.php" class="mobile-nav-link <?php echo ($activePage === 'home') ? 'active' : ''; ?>">
          <span>Home</span>
        </a>

        <!-- Mobile Accordion: Conversion Types -->
        <div class="mobile-accordion-group">
          <button type="button" class="mobile-accordion-btn" aria-expanded="false">
            <span>Conversion Types</span>
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <div class="mobile-accordion-content">
            <a href="conversion-types.php" class="mobile-sublink overview-sublink">Overview — All 6 Types →</a>
            <a href="velux-conversion.php" class="mobile-sublink">Velux Loft Conversion</a>
            <a href="rear-dormer-conversion.php" class="mobile-sublink">Rear Dormer Conversion</a>
            <a href="hip-to-gable-conversion.php" class="mobile-sublink">Hip-to-Gable Conversion</a>
            <a href="hip-end-dormer-conversion.php" class="mobile-sublink">Hip-End Dormer Conversion</a>
            <a href="wrap-around-conversion.php" class="mobile-sublink">Wrap Around Conversion</a>
            <a href="roof-lift-conversion.php" class="mobile-sublink">Roof-Lift Conversion</a>
          </div>
        </div>

        <!-- Mobile Accordion: Property Types -->
        <div class="mobile-accordion-group">
          <button type="button" class="mobile-accordion-btn" aria-expanded="false">
            <span>Property Types</span>
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <div class="mobile-accordion-content">
            <a href="property-types.php" class="mobile-sublink overview-sublink">Overview — All Properties →</a>
            <a href="terrace-property.php" class="mobile-sublink">Terraced Homes</a>
            <a href="semi-detached-property.php" class="mobile-sublink">Semi-Detached Homes</a>
            <a href="detached-property.php" class="mobile-sublink">Detached Homes</a>
            <a href="bungalow-property.php" class="mobile-sublink">Bungalow Conversions</a>
          </div>
        </div>

        <!-- Mobile Accordion: About -->
        <div class="mobile-accordion-group">
          <button type="button" class="mobile-accordion-btn" aria-expanded="false">
            <span>About</span>
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <div class="mobile-accordion-content">
            <a href="about.php" class="mobile-sublink">About Another Level</a>
            <a href="start-to-finish-how-your-loft-is-built.php" class="mobile-sublink">How It's Built (8-Step Process)</a>
            <a href="our-guarantee.php" class="mobile-sublink">Our 6-Year Guarantee</a>
            <a href="customer-testimonials.php" class="mobile-sublink">Customer Testimonials</a>
          </div>
        </div>

        <a href="gallery.php" class="mobile-nav-link <?php echo ($activePage === 'gallery') ? 'active' : ''; ?>">
          <span>Gallery</span>
        </a>
        <a href="contact.php" class="mobile-nav-link <?php echo ($activePage === 'contact') ? 'active' : ''; ?>">
          <span>Contact</span>
        </a>
      </div>

      <!-- Clean Mobile Actions (Call & Survey) -->
      <div class="mobile-drawer-actions">
        <a href="<?php echo $telHref; ?>" class="mobile-call-btn">
          <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          <span>Call: <?php echo htmlspecialchars($phone); ?></span>
        </a>
        <a href="#booking" data-open-booking class="mobile-cta-btn">Book Free Survey</a>
      </div>
    </div>
  </nav>
</header>
