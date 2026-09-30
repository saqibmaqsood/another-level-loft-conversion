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

<header class="site-header">
  <div class="header-inner">
    <a href="<?php echo $homeHref; ?>" class="brand-link">
      <span class="brand-icon"></span>
      <span class="brand-text">
        <span class="brand-title">Another Level</span>
        <span class="brand-subtitle">Loft Conversions</span>
      </span>
    </a>

    <nav aria-label="Primary" class="nav-desktop">
      <?php if ($activePage !== 'home'): ?>
        <a href="index.php" class="nav-link">Home</a>
      <?php endif; ?>

      <!-- Conversion Types Dropdown -->
      <div class="nav-dropdown-wrapper has-mega">
        <a href="conversion-types.php" 
           class="nav-link nav-dropdown-trigger <?php echo ($activePage === 'types') ? 'active' : ''; ?>"
           <?php if ($activePage === 'types') echo 'aria-current="page"'; ?>>
          Conversion Types
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>
        </a>
        <div class="nav-dropdown-mega glass-mega">
          <!-- Left Navigation List -->
          <div class="mega-side-list">
            <a href="velux-conversion.php" class="mega-side-link active" data-target="panel-velux">
              <div class="mega-side-title">
                <strong>Velux</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>Quickest build &amp; most affordable</span>
            </a>

            <a href="rear-dormer-conversion.php" class="mega-side-link" data-target="panel-dormer">
              <div class="mega-side-title">
                <strong>Rear Dormer</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>Maximum floor space &amp; headroom</span>
            </a>

            <a href="hip-to-gable-conversion.php" class="mega-side-link" data-target="panel-hiptogable">
              <div class="mega-side-title">
                <strong>Hip-to-Gable</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>Best for 1930s semi-detached homes</span>
            </a>

            <a href="hip-end-dormer-conversion.php" class="mega-side-link" data-target="panel-hipend">
              <div class="mega-side-title">
                <strong>Hip-End Dormer</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>Preserves original roofline aesthetics</span>
            </a>

            <a href="wrap-around-conversion.php" class="mega-side-link" data-target="panel-wraparound">
              <div class="mega-side-title">
                <strong>Wrap Around</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>Ultimate master suite &amp; 2 full rooms</span>
            </a>

            <a href="roof-lift-conversion.php" class="mega-side-link" data-target="panel-rooflift">
              <div class="mega-side-title">
                <strong>Roof-Lift</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>For shallow pitch &amp; bungalows</span>
            </a>
            
            <div style="margin-top:auto;padding-top:8px;border-top:1px solid rgba(0,0,0,0.06)">
              <a href="conversion-types.php" style="font-size:11.5px;font-weight:700;color:var(--color-primary-dark);text-decoration:none;display:inline-flex;align-items:center;gap:4px">Compare all 6 types →</a>
            </div>
          </div>

          <!-- Right Dynamic Interactive Preview Content -->
          <div class="mega-preview-container">
            
            <!-- Panel 1: Velux -->
            <div class="mega-preview-panel active" id="panel-velux">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-08.jpeg" alt="Velux Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">3 Weeks · 18–22 m²</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Velux Loft Conversion</h4>
                  <p>Rooflights are fitted flush into the existing roof slope without altering the roof profile. Quickest build time and most cost-effective.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>No structural roof alterations</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Permitted development rights</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Needs 2.2m ridge height</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Fixed price from survey</span></div>
                </div>
                <a href="velux-conversion.php" class="mega-panel-action">View Velux Details &amp; Floor Plans →</a>
              </div>
            </div>

            <!-- Panel 2: Rear Dormer -->
            <div class="mega-preview-panel" id="panel-dormer">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-02.jpeg" alt="Rear Dormer Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">4 Weeks · 28–32 m²</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Rear Dormer Conversion</h4>
                  <p>A flat-roof extension built across the rear elevation. Delivers maximum usable floor space, straight vertical walls and full standing height.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Maximum floor area &amp; headroom</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Fits master bedroom &amp; ensuite</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Most popular for terraced homes</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Optional Juliet balcony</span></div>
                </div>
                <a href="rear-dormer-conversion.php" class="mega-panel-action">View Rear Dormer Details &amp; Floor Plans →</a>
              </div>
            </div>

            <!-- Panel 3: Hip-to-Gable -->
            <div class="mega-preview-panel" id="panel-hiptogable">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-05.jpeg" alt="Hip-to-Gable Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">3.5 Weeks · 25–28 m²</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Hip-to-Gable Conversion</h4>
                  <p>Extends the sloping side roof into a vertical brick gable wall. Creates essential headroom for a compliant staircase and landing on 1930s semis.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Essential staircase headroom</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Matching brickwork/render</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Perfect for semi-detached homes</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Seamless architectural finish</span></div>
                </div>
                <a href="hip-to-gable-conversion.php" class="mega-panel-action">View Hip-to-Gable Details &amp; Floor Plans →</a>
              </div>
            </div>

            <!-- Panel 4: Hip-End Dormer -->
            <div class="mega-preview-panel" id="panel-hipend">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-06.jpeg" alt="Hip-End Dormer Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">3.5 Weeks · 24–28 m²</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Hip-End Dormer Conversion</h4>
                  <p>A dormer built into the hipped end slope. Preserves the original external roofline symmetry and is preferred in sensitive conservation areas.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Preserves original roofline</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Tile-hung cheek aesthetics</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Conservation area friendly</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Full standing headroom inside</span></div>
                </div>
                <a href="hip-end-dormer-conversion.php" class="mega-panel-action">View Hip-End Dormer Details &amp; Floor Plans →</a>
              </div>
            </div>

            <!-- Panel 5: Wrap Around -->
            <div class="mega-preview-panel" id="panel-wraparound">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-07.jpeg" alt="Wrap Around Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">6 Weeks · 40–46 m²</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Wrap Around Conversion</h4>
                  <p>A combined hip-to-gable and rear dormer that wraps around the roof. Our largest conversion, regularly delivering 2 bedrooms and a bathroom.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>40–46 m² maximum living area</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Delivers 2 rooms + bathroom</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Complete upper floor living</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Full planning support included</span></div>
                </div>
                <a href="wrap-around-conversion.php" class="mega-panel-action">View Wrap Around Details &amp; Floor Plans →</a>
              </div>
            </div>

            <!-- Panel 6: Roof-Lift -->
            <div class="mega-preview-panel" id="panel-rooflift">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-10.jpeg" alt="Roof-Lift Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">6–8 Weeks · Full Floor</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Roof-Lift Conversion</h4>
                  <p>The roof ridge is rebuilt at a higher pitch to create headroom where none existed. The definitive solution for bungalows and low-pitch properties.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Converts shallow pitch roofs</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Ideal for bungalows &amp; chalets</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Temporary canopy protection</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Full architectural sign-off</span></div>
                </div>
                <a href="roof-lift-conversion.php" class="mega-panel-action">View Roof-Lift Details &amp; Floor Plans →</a>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Property Types Dropdown -->
      <div class="nav-dropdown-wrapper has-mega">
        <a href="property-types.php" 
           class="nav-link nav-dropdown-trigger <?php echo ($activePage === 'property') ? 'active' : ''; ?>"
           <?php if ($activePage === 'property') echo 'aria-current="page"'; ?>>
          Property Types
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>
        </a>
        <div class="nav-dropdown-mega glass-mega mega-property">
          <!-- Left Navigation List -->
          <div class="mega-side-list">
            <a href="terrace-property.php" class="mega-side-link active" data-target="panel-prop-terrace">
              <div class="mega-side-title">
                <strong>Terrace</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>Rear dormers &amp; space optimization</span>
            </a>

            <a href="semi-detached-property.php" class="mega-side-link" data-target="panel-prop-semi">
              <div class="mega-side-title">
                <strong>Semi-detached</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>Hip-to-gable master suites</span>
            </a>

            <a href="detached-property.php" class="mega-side-link" data-target="panel-prop-detached">
              <div class="mega-side-title">
                <strong>Detached</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>Maximum layout freedom</span>
            </a>

            <a href="bungalow-property.php" class="mega-side-link" data-target="panel-prop-bungalow">
              <div class="mega-side-title">
                <strong>Bungalow</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>Dormer &amp; roof-lift solutions</span>
            </a>

            <div style="margin-top:auto;padding-top:8px;border-top:1px solid rgba(0,0,0,0.06)">
              <a href="property-types.php" style="font-size:11.5px;font-weight:700;color:var(--color-primary-dark);text-decoration:none;display:inline-flex;align-items:center;gap:4px">Compare all 4 properties →</a>
            </div>
          </div>

          <!-- Right Dynamic Interactive Preview Content -->
          <div class="mega-preview-container">
            
            <!-- Panel 1: Terrace -->
            <div class="mega-preview-panel active" id="panel-prop-terrace">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-04.jpeg" alt="Terraced House Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">40m³ Allowance · 4 Weeks</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Terraced House Conversion</h4>
                  <p>A full-width rear box dormer maximizes every square inch within the 40m³ volume allowance, giving straight vertical walls and 2 standing rooms.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>40m³ permitted development</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>28–32 m² generous master suite</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Scaffold crane &amp; roof hoist</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Party wall notices prepared</span></div>
                </div>
                <a href="terrace-property.php" class="mega-panel-action">View Terraced Property Details →</a>
              </div>
            </div>

            <!-- Panel 2: Semi-detached -->
            <div class="mega-preview-panel" id="panel-prop-semi">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-01.jpeg" alt="Semi-detached Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">50m³ Allowance · 3.5 Weeks</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Semi-detached Loft Conversion</h4>
                  <p>The most converted home type in the North West. Squaring off the hipped roof into a gable creates full headroom for the staircase and a luxury master suite.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Full 50m³ volume allowance</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>25–44 m² flexible floor layouts</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Hip-to-gable or wrap around</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Single party wall notice</span></div>
                </div>
                <a href="semi-detached-property.php" class="mega-panel-action">View Semi-detached Details →</a>
              </div>
            </div>

            <!-- Panel 3: Detached -->
            <div class="mega-preview-panel" id="panel-prop-detached">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-07.jpeg" alt="Detached House Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">50m³ Allowance · 3.5 Weeks</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Detached House Conversion</h4>
                  <p>Zero party wall constraints, hips on both sides, and full 50m³ capacity. Maximum architectural freedom for wrap arounds, balconies and dual rooms.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Zero party wall waiting period</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>25–46 m² multiple room options</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Dual-gable &amp; wrap around</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Custom luxury staircases</span></div>
                </div>
                <a href="detached-property.php" class="mega-panel-action">View Detached Property Details →</a>
              </div>
            </div>

            <!-- Panel 4: Bungalow -->
            <div class="mega-preview-panel" id="panel-prop-bungalow">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-10.jpeg" alt="Bungalow Loft Conversion" loading="lazy">
                <div class="mega-panel-badge">Full Floor · 6–8 Weeks</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Bungalow Loft Conversion</h4>
                  <p>Turn a single-storey bungalow into a spacious two-storey home. We price dormer additions for high lofts or full roof-lifts for shallow rooflines.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Adds a full new second floor</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>2–3 bedrooms plus bathroom</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Temporary weatherproof canopy</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Full architectural sign-off</span></div>
                </div>
                <a href="bungalow-property.php" class="mega-panel-action">View Bungalow Details →</a>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- About Dropdown -->
      <div class="nav-dropdown-wrapper has-mega">
        <a href="about.php" 
           class="nav-link nav-dropdown-trigger <?php echo in_array($activePage, ['about', 'start-to-finish', 'guarantee', 'testimonials']) ? 'active' : ''; ?>"
           <?php if ($activePage === 'about') echo 'aria-current="page"'; ?>>
          About
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>
        </a>
        <div class="nav-dropdown-mega glass-mega mega-about">
          <!-- Left Navigation List -->
          <div class="mega-side-list">
            <a href="about.php" class="mega-side-link active" data-target="panel-about-us">
              <div class="mega-side-title">
                <strong>About Us</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>18+ years North West specialists</span>
            </a>

            <a href="start-to-finish-how-your-loft-is-built.php" class="mega-side-link" data-target="panel-about-process">
              <div class="mega-side-title">
                <strong>Start To Finish</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>8-step scaffold-first process</span>
            </a>

            <a href="our-guarantee.php" class="mega-side-link" data-target="panel-about-guarantee">
              <div class="mega-side-title">
                <strong>Our Guarantee</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>6-year warranty &amp; fixed price</span>
            </a>

            <a href="customer-testimonials.php" class="mega-side-link" data-target="panel-about-testimonials">
              <div class="mega-side-title">
                <strong>Customer Testimonials</strong>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <span>9.8/10 from 400+ families</span>
            </a>

            <div style="margin-top:auto;padding-top:8px;border-top:1px solid rgba(0,0,0,0.06)">
              <a href="about.php" style="font-size:11.5px;font-weight:700;color:var(--color-primary-dark);text-decoration:none;display:inline-flex;align-items:center;gap:4px">About Another Level →</a>
            </div>
          </div>

          <!-- Right Dynamic Interactive Preview Content -->
          <div class="mega-preview-container">
            
            <!-- Panel 1: About Us -->
            <div class="mega-preview-panel active" id="panel-about-us">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-03.jpeg" alt="About Another Level Loft Conversions" loading="lazy">
                <div class="mega-panel-badge">Est. 2008 · 400+ Lofts</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Family-Run Loft Specialists</h4>
                  <p>Founded in 2008 by Jonny Mee. We run one project at a time with our own dedicated master carpenters, structural engineers and certified trades.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>1-project policy — full focus</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>18+ years North West experience</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Complete project management</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Direct daily contact with Jonny</span></div>
                </div>
                <a href="about.php" class="mega-panel-action">Read Our Full Story &amp; Philosophy →</a>
              </div>
            </div>

            <!-- Panel 2: Start To Finish -->
            <div class="mega-preview-panel" id="panel-about-process">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-08.jpeg" alt="How Your Loft Is Built" loading="lazy">
                <div class="mega-panel-badge">8-Step Process · Scaffold-First</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>How Your Loft Is Built</h4>
                  <p>All heavy structural work, steel beams and timber framing are brought in through the roof scaffold. Your home stays clean and fully livable throughout.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>External roof access protects home</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Laser CAD &amp; structural calcs</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Weekly milestone sign-offs</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Stairs installed in final week</span></div>
                </div>
                <a href="start-to-finish-how-your-loft-is-built.php" class="mega-panel-action">Explore the 8-Step Build Process →</a>
              </div>
            </div>

            <!-- Panel 3: Our Guarantee -->
            <div class="mega-preview-panel" id="panel-about-guarantee">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-02.jpeg" alt="Our 6-Year Guarantee" loading="lazy">
                <div class="mega-panel-badge">6-Year Warranty · Fixed Price</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>The Another Level Guarantee</h4>
                  <p>Every conversion is backed by our comprehensive 6-year structural guarantee and a strict fixed-price survey agreement with zero hidden variation costs.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>6-year structural &amp; timber warranty</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Fixed price quote — no extras</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Building control certified</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>£5M public liability insurance</span></div>
                </div>
                <a href="our-guarantee.php" class="mega-panel-action">View Guarantee &amp; Warranty Terms →</a>
              </div>
            </div>

            <!-- Panel 4: Testimonials -->
            <div class="mega-preview-panel" id="panel-about-testimonials">
              <div class="mega-panel-thumb">
                <img src="images/another-area-loft-conversions-north-west-england-05.jpeg" alt="Customer Testimonials" loading="lazy">
                <div class="mega-panel-badge">9.8 / 10 · 400+ Reviews</div>
              </div>
              <div class="mega-panel-content">
                <div class="mega-panel-heading">
                  <h4>Real Client Reviews &amp; Stories</h4>
                  <p>Read verified feedback from homeowners across Lancashire, Greater Manchester and Cheshire who trusted Another Level with their home transformation.</p>
                </div>
                <div class="mega-panel-specs">
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>9.8/10 average independent rating</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Contactable previous references</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>Genuine before/after customer tours</span></div>
                  <div class="spec-item"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><span>100% on-time completion record</span></div>
                </div>
                <a href="customer-testimonials.php" class="mega-panel-action">Read Verified Customer Reviews →</a>
              </div>
            </div>

          </div>
        </div>
      </div>

      <a href="gallery.php" class="nav-link <?php echo ($activePage === 'gallery') ? 'active' : ''; ?>">Gallery</a>
      <a href="contact.php" class="nav-link <?php echo ($activePage === 'contact') ? 'active' : ''; ?>">Contact</a>
    </nav>

    <div class="header-actions">
      <a href="<?php echo $telHref; ?>" class="header-phone"><?php echo htmlspecialchars($phone); ?></a>
      <a href="#booking" data-open-booking class="header-book-btn">Book Free Survey</a>
      <button type="button" class="burger-btn" aria-label="Menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>

  <!-- Rich Creative Mobile Navigation Drawer -->
  <nav aria-label="Mobile" class="nav-mobile-drawer">
    
    <!-- Top Quick Links Header (Home, About, Process, Guarantee) -->
    <div class="mobile-drawer-topbar">
      <a href="index.php" class="mobile-top-pill <?php echo ($activePage === 'home') ? 'active' : ''; ?>">
        <span>Home</span>
      </a>
      <a href="about.php" class="mobile-top-pill <?php echo ($activePage === 'about') ? 'active' : ''; ?>">
        <span>About</span>
      </a>
      <a href="start-to-finish-how-your-loft-is-built.php" class="mobile-top-pill <?php echo in_array($activePage, ['process', 'start-to-finish']) ? 'active' : ''; ?>">
        <span>Process</span>
      </a>
      <a href="our-guarantee.php" class="mobile-top-pill <?php echo in_array($activePage, ['guarantee', 'our-guarantee']) ? 'active' : ''; ?>">
        <span>Guarantee</span>
      </a>
    </div>

    <!-- Section 1: Conversion Types Creative Card -->
    <div class="mobile-section-card">
      <div class="mobile-section-header">
        <div class="mobile-section-badge">01</div>
        <div>
          <strong>Conversion Types</strong>
          <span>6 architectural roof styles</span>
        </div>
      </div>
      <div class="mobile-pills-grid">
        <a href="velux-conversion.php" class="mobile-type-chip">
          <strong>Velux</strong>
          <small>3 Weeks · 18–22m²</small>
        </a>
        <a href="rear-dormer-conversion.php" class="mobile-type-chip">
          <strong>Rear Dormer</strong>
          <small>4 Weeks · Max Space</small>
        </a>
        <a href="hip-to-gable-conversion.php" class="mobile-type-chip">
          <strong>Hip-to-Gable</strong>
          <small>3.5 Wks · 1930s Semis</small>
        </a>
        <a href="hip-end-dormer-conversion.php" class="mobile-type-chip">
          <strong>Hip-End Dormer</strong>
          <small>3.5 Wks · Roofline Fit</small>
        </a>
        <a href="wrap-around-conversion.php" class="mobile-type-chip">
          <strong>Wrap Around</strong>
          <small>6 Wks · 2 Bed Suite</small>
        </a>
        <a href="roof-lift-conversion.php" class="mobile-type-chip">
          <strong>Roof-Lift</strong>
          <small>Full Floor · Bungalows</small>
        </a>
      </div>
      <div class="mobile-card-footer">
        <a href="conversion-types.php">Compare all 6 conversion types &amp; specs →</a>
      </div>
    </div>

    <!-- Section 2: Property Types Creative Card -->
    <div class="mobile-section-card">
      <div class="mobile-section-header">
        <div class="mobile-section-badge">02</div>
        <div>
          <strong>Property Types</strong>
          <span>Tailored to house structure</span>
        </div>
      </div>
      <div class="mobile-pills-grid">
        <a href="terrace-property.php" class="mobile-type-chip">
          <strong>Terrace</strong>
          <small>40m³ volume limit</small>
        </a>
        <a href="semi-detached-property.php" class="mobile-type-chip">
          <strong>Semi-detached</strong>
          <small>50m³ volume limit</small>
        </a>
        <a href="detached-property.php" class="mobile-type-chip">
          <strong>Detached</strong>
          <small>Max layout freedom</small>
        </a>
        <a href="bungalow-property.php" class="mobile-type-chip">
          <strong>Bungalow</strong>
          <small>Dormer &amp; roof-lift</small>
        </a>
      </div>
      <div class="mobile-card-footer">
        <a href="property-types.php">Compare all 4 property styles →</a>
      </div>
    </div>

    <!-- Quick Action Tiles (Gallery, Testimonials, Contact) -->
    <div class="mobile-action-tiles">
      <a href="gallery.php" class="mobile-action-tile">
        <div class="mobile-tile-text">
          <strong>Gallery</strong>
          <span>Real Projects</span>
        </div>
      </a>
      <a href="customer-testimonials.php" class="mobile-action-tile">
        <div class="mobile-tile-text">
          <strong>Testimonials</strong>
          <span>400+ Reviews</span>
        </div>
      </a>
      <a href="contact.php" class="mobile-action-tile">
        <div class="mobile-tile-text">
          <strong>Contact Us</strong>
          <span>Get in Touch</span>
        </div>
      </a>
    </div>

    <!-- Bottom Survey Callout in Drawer -->
    <div class="mobile-drawer-cta">
      <div class="mobile-drawer-cta-text">
        <strong>Free 3D CAD Design &amp; Survey</strong>
        <p>Book your no-obligation survey with Jonny Mee.</p>
      </div>
      <a href="#booking" data-open-booking class="mobile-drawer-cta-btn">Book Free Survey</a>
    </div>

  </nav>
</header>
