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
<!-- Minimal Top Announcement & Direct Call Bar (Bayford Lofts Style) -->
<div class="header-topbar">
  <div class="topbar-inner">
    <div class="topbar-left">
      <span class="topbar-highlight">North West Loft Specialists</span>
      <span class="topbar-sep">•</span>
      <span class="topbar-text">Fixed Price Guarantee · Free 3D CAD Survey</span>
    </div>
    <div class="topbar-right">
      <a href="#booking" data-open-booking class="topbar-link topbar-survey">Book a Free site survey</a>
      <span class="topbar-dash">-</span>
      <a href="<?php echo $telHref; ?>" class="topbar-link topbar-phone">Call us</a>
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

    <!-- Primary Desktop Navigation with Full-Width Bayford Dropdowns -->
    <nav aria-label="Primary" class="nav-desktop">
      <?php if ($activePage !== 'home'): ?>
        <a href="index.php" class="nav-link">HOME</a>
      <?php endif; ?>

      <!-- Conversion Types (All 6 Options in 2 Rows) -->
      <div class="nav-dropdown-wrapper has-bayford">
        <a href="conversion-types.php" 
           class="nav-link nav-dropdown-trigger <?php echo ($activePage === 'types') ? 'active' : ''; ?>"
           <?php if ($activePage === 'types') echo 'aria-current="page"'; ?>>
          <span>LOFT CONVERSIONS</span>
        </a>

        <!-- Bayford Style Dropdown Panel (Glassmorphism & Fixed Left Column) -->
        <div class="bayford-dropdown">
          <div class="bayford-dropdown-inner">
            <!-- Left Info Column -->
            <div class="bayford-left-col">
              <div class="bayford-accent-bar"></div>
              <h3 class="bayford-heading">LOFT CONVERSION TYPES</h3>
              <p class="bayford-desc">
                All 6 architectural conversion packages engineered to maximise headroom, floor space, and property value with full structural sign-off.
              </p>
              <a href="#booking" data-open-booking class="bayford-split-btn">
                <span class="bayford-btn-text">CALCULATE YOUR BUDGET</span>
                <span class="bayford-btn-arrow">
                  <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
              </a>
            </div>

            <!-- Right 6 Photo Cards Grid (2 Rows of 3 Cards) -->
            <div class="bayford-cards-grid grid-6">
              <!-- Card 1: Velux -->
              <a href="velux-conversion.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/bayford-velux-loft.jpg" alt="Velux Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">VELUX CONVERSION</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 2: Rear Dormer -->
              <a href="rear-dormer-conversion.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/bayford-dormer-loft.jpg" alt="Rear Dormer Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">REAR DORMER</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 3: Hip-to-Gable -->
              <a href="hip-to-gable-conversion.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/bayford-hiptogable-loft.jpg" alt="Hip-to-Gable Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">HIP-TO-GABLE</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 4: Hip-End Dormer -->
              <a href="hip-end-dormer-conversion.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-06.jpeg" alt="Hip-End Dormer Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">HIP-END DORMER</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 5: Wrap Around -->
              <a href="wrap-around-conversion.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-07.jpeg" alt="Wrap Around Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">WRAP AROUND</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 6: Roof-Lift -->
              <a href="roof-lift-conversion.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-10.jpeg" alt="Roof-Lift Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">ROOF-LIFT</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Property Types (All 4 Options in 2 Rows) -->
      <div class="nav-dropdown-wrapper has-bayford">
        <a href="property-types.php" 
           class="nav-link nav-dropdown-trigger <?php echo ($activePage === 'property') ? 'active' : ''; ?>"
           <?php if ($activePage === 'property') echo 'aria-current="page"'; ?>>
          <span>PROPERTY TYPES</span>
        </a>

        <!-- Bayford Style Dropdown Panel -->
        <div class="bayford-dropdown">
          <div class="bayford-dropdown-inner">
            <!-- Left Info Column -->
            <div class="bayford-left-col">
              <div class="bayford-accent-bar"></div>
              <h3 class="bayford-heading">PROPERTY STYLES</h3>
              <p class="bayford-desc">
                Tailored architectural solutions engineered specifically for North West houses — from Victorian terraced homes to 1930s semi-detached, detached, and bungalows.
              </p>
              <a href="property-types.php" class="bayford-split-btn">
                <span class="bayford-btn-text">ALL PROPERTY STYLES</span>
                <span class="bayford-btn-arrow">
                  <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
              </a>
            </div>

            <!-- Right 4 Photo Cards Column -->
            <div class="bayford-cards-grid grid-4">
              <!-- Card 1: Terrace -->
              <a href="terrace-property.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-01.jpeg" alt="Terrace House Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">TERRACED HOMES</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 2: Semi-Detached -->
              <a href="semi-detached-property.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-04.jpeg" alt="Semi-Detached Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">SEMI-DETACHED</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 3: Detached -->
              <a href="detached-property.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-09.jpeg" alt="Detached Property Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">DETACHED HOMES</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 4: Bungalow -->
              <a href="bungalow-property.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-10.jpeg" alt="Bungalow Loft Conversion" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">BUNGALOWS</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- About Us / Company (All 4 Options in 2 Rows) -->
      <div class="nav-dropdown-wrapper has-bayford">
        <a href="about.php" 
           class="nav-link nav-dropdown-trigger <?php echo in_array($activePage, ['about', 'start-to-finish', 'guarantee', 'testimonials']) ? 'active' : ''; ?>"
           <?php if ($activePage === 'about') echo 'aria-current="page"'; ?>>
          <span>COMPANY</span>
        </a>

        <!-- Bayford Style Dropdown Panel -->
        <div class="bayford-dropdown">
          <div class="bayford-dropdown-inner">
            <!-- Left Info Column -->
            <div class="bayford-left-col">
              <div class="bayford-accent-bar"></div>
              <h3 class="bayford-heading">MEET ANOTHER LEVEL</h3>
              <p class="bayford-desc">
                Founded in 2008 by Jonny Mee. 18+ years North West specialists operating with our strict 1-project policy, fixed-price quote and 6-year structural warranty.
              </p>
              <a href="about.php" class="bayford-split-btn">
                <span class="bayford-btn-text">OUR STORY &amp; PROCESS</span>
                <span class="bayford-btn-arrow">
                  <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
              </a>
            </div>

            <!-- Right 4 Photo Cards Column -->
            <div class="bayford-cards-grid grid-4">
              <!-- Card 1: Build Process -->
              <a href="start-to-finish-how-your-loft-is-built.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-08.jpeg" alt="How Your Loft Is Built" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">8-STEP BUILD PROCESS</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 2: 6-Year Guarantee -->
              <a href="our-guarantee.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-02.jpeg" alt="Our 6-Year Guarantee" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">6-YEAR GUARANTEE</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 3: Testimonials -->
              <a href="customer-testimonials.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-05.jpeg" alt="Customer Testimonials" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">CUSTOMER REVIEWS</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>

              <!-- Card 4: About Us -->
              <a href="about.php" class="bayford-card">
                <div class="bayford-card-media">
                  <img src="images/another-area-loft-conversions-north-west-england-03.jpeg" alt="About Another Level" loading="lazy">
                </div>
                <div class="bayford-card-label-wrap">
                  <span class="bayford-card-label">ABOUT OUR TEAM</span>
                  <span class="bayford-card-arrow">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>

      <a href="gallery.php" class="nav-link <?php echo ($activePage === 'gallery') ? 'active' : ''; ?>">GALLERY</a>
      <a href="contact.php" class="nav-link <?php echo ($activePage === 'contact') ? 'active' : ''; ?>">CONTACT</a>
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
