<?php
$pageTitle = "Another Level Loft Conversions — Fixed-price loft conversions, North West";
$pageDesc = "Loft conversions in Preston, Manchester, Lancashire and Cheshire. Fixed price, free CAD design, no hidden costs. Book a free survey.";
$activePage = "home";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    [
        "@context" => "https://schema.org",
        "@type" => "LocalBusiness",
        "name" => "Another Level Loft Conversions",
        "image" => "images/another-area-loft-conversions-north-west-england-01.jpeg",
        "telephone" => "0800 0862744",
        "email" => "info@anotherlevelloftconversions.co.uk",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "Old Docks House, 90 Watery Lane",
            "addressLocality" => "Preston",
            "postalCode" => "PR2 1AU",
            "addressCountry" => "GB"
        ],
        "areaServed" => ["Preston", "Manchester", "Lancashire", "Cheshire"],
        "aggregateRating" => [
            "@type" => "AggregateRating",
            "ratingValue" => "4.9",
            "reviewCount" => "400"
        ]
    ],
    [
        "@context" => "https://schema.org",
        "@type" => "Service",
        "serviceType" => "Loft conversion",
        "provider" => [
            "@type" => "LocalBusiness",
            "name" => "Another Level Loft Conversions"
        ],
        "offers" => [
            "@type" => "AggregateOffer",
            "priceCurrency" => "GBP",
            "lowPrice" => "24000"
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

  <main id="top">

    <!-- Hero Section (Minimalist Full-Bleed Architectural Design) -->
    <section class="hero-minimal" aria-labelledby="hero-h">
      <div class="hero-minimal-overlay"></div>
      <div class="hero-minimal-inner">
        <span class="hero-minimal-pill">Preston · Manchester · Lancashire · Cheshire</span>
        <h1 id="hero-h" class="hero-minimal-title">Your loft, converted at a fixed price.</h1>
        <p class="hero-minimal-subtitle">Free home survey, free CAD design, one written quote that doesn't move. Most conversions are finished in three to six weeks.</p>
        <div class="hero-minimal-actions">
          <a href="#booking" data-open-booking class="hero-minimal-cta">
            <span>Book Free Survey</span>
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="tel:08000862744" class="hero-minimal-phone">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span>Call 0800 0862744</span>
          </a>
        </div>
        <div class="hero-minimal-features">
          <span class="hero-minimal-feature"><svg viewBox="0 0 16 16" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M3.5 8.5l3 3 6-6"/></svg> Guaranteed Fixed Price</span>
          <span class="hero-minimal-feature"><svg viewBox="0 0 16 16" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M3.5 8.5l3 3 6-6"/></svg> Free CAD Design</span>
          <span class="hero-minimal-feature"><svg viewBox="0 0 16 16" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M3.5 8.5l3 3 6-6"/></svg> No Hidden Costs</span>
          <span class="hero-minimal-feature"><svg viewBox="0 0 16 16" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M3.5 8.5l3 3 6-6"/></svg> 6-Year Guarantee</span>
        </div>
      </div>
    </section>

    <!-- Trust Indicators Bar (Containerized & Creative Design) -->
    <section data-stats-bar aria-label="Trust indicators" class="trust-bar-section">
      <div class="trust-bar-card">
        <div class="trust-item">
          <div class="trust-item-icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
          </div>
          <div class="trust-item-content">
            <span class="trust-item-val" data-target-value="9.8" data-decimals="1" data-suffix="/ 10">9.8 / 10</span>
            <span class="trust-item-lbl">Checkatrade rating</span>
          </div>
        </div>

        <div class="trust-item">
          <div class="trust-item-icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
          </div>
          <div class="trust-item-content">
            <span class="trust-item-val" data-target-value="18" data-decimals="0" data-suffix="yrs">18 yrs</span>
            <span class="trust-item-lbl">Converting lofts</span>
          </div>
        </div>

        <div class="trust-item">
          <div class="trust-item-icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
          </div>
          <div class="trust-item-content">
            <span class="trust-item-val" data-target-value="400" data-decimals="0" data-suffix="+">400+</span>
            <span class="trust-item-lbl">Completed projects</span>
          </div>
        </div>

        <div class="trust-item">
          <div class="trust-item-icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
          </div>
          <div class="trust-item-content">
            <span class="trust-item-val" data-target-value="4.9" data-decimals="1" data-suffix="★">4.9 ★</span>
            <span class="trust-item-lbl">Google reviews</span>
          </div>
        </div>
      </div>
    </section>

    <!-- How It Works (Process) -->
    <section id="process" data-reveal aria-labelledby="proc-h" class="section-padding bg-white border-bottom">
      <div class="container">
        <div class="proc-header-row" style="display:flex;flex-wrap:wrap;gap:20px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:44px">
          <div class="proc-header-left">
            <span class="section-label">How it works</span>
            <div class="proc-title-controls-wrap">
              <h2 id="proc-h" class="heading-h2 proc-heading-title" style="margin:12px 0 0;max-width:24ch">Five steps, no surprises in between.</h2>
              <div class="proc-controls-group">
                <div class="proc-step-counter">
                  <span class="proc-counter-label">Step</span>
                  <span class="proc-current-num">01</span>
                  <span class="proc-total-num">/ 05</span>
                </div>
                <div class="carousel-nav-arrows proc-carousel-arrows">
                  <button type="button" class="carousel-nav-btn proc-prev-btn" aria-label="Previous step">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                  </button>
                  <button type="button" class="carousel-nav-btn proc-next-btn" aria-label="Next step">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="proc-checkatrade-box" style="display:flex;align-items:flex-end">
            <a href="https://www.checkatrade.com/trades/AnotherLevelLoftConversionsNw" target="_blank" rel="noopener noreferrer" class="proc-checkatrade-link" style="display:inline-flex;align-items:center;transition:opacity 0.2s ease" title="Checkatrade Verified - Another Level Loft Conversions">
              <img src="images/checkatrade-proud-member.png" alt="Proud members of Checkatrade.com - Where reputation matters" class="proc-checkatrade-img" style="height:clamp(85px,7.8vw,115px);width:auto;object-fit:contain;display:block">
            </a>
          </div>
        </div>
        <div class="proc-steps-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:1px;background:#E4E4DF;border:1px solid #E4E4DF">
          
          <div class="proc-step-card" style="background:#FFFFFF;padding:24px 22px 26px;display:flex;flex-direction:column;gap:12px;color:#1A1A1A;transition:background .2s ease" onmouseover="this.style.background='#F1F5EE'" onmouseout="this.style.background='#FFFFFF'">
            <div class="proc-step-top" style="display:flex;align-items:center;justify-content:space-between">
              <span class="proc-step-num" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B8E5A;letter-spacing:.14em;font-weight:600">01</span>
              <svg class="proc-step-icon" viewBox="0 0 32 32" width="30" height="30" fill="none" stroke="#1A1A1A" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 27h24M8 27V13l8-6 8 6v14M13 27v-7h6v7"></path></svg>
            </div>
            <span class="proc-step-title" style="font-family:Newsreader,Georgia,serif;font-size:21px;line-height:1.15">Free survey</span>
            <span class="proc-step-desc" style="font-size:14px;line-height:1.6;color:#6B6B6B">We measure the ridge height, check the trusses and talk through what fits.</span>
            <span class="proc-step-tags" style="display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:auto;padding-top:8px;font-family:'IBM Plex Mono',monospace;font-size:12px">
              <span class="proc-step-tag proc-tag-accent" style="color:#4F6B42">45 mins</span><span class="proc-step-tag" style="color:#6B6B6B">No obligation</span>
            </span>
          </div>

          <div class="proc-step-card" style="background:#FFFFFF;padding:24px 22px 26px;display:flex;flex-direction:column;gap:12px;color:#1A1A1A;transition:background .2s ease" onmouseover="this.style.background='#F1F5EE'" onmouseout="this.style.background='#FFFFFF'">
            <div class="proc-step-top" style="display:flex;align-items:center;justify-content:space-between">
              <span class="proc-step-num" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B8E5A;letter-spacing:.14em;font-weight:600">02</span>
              <svg class="proc-step-icon" viewBox="0 0 32 32" width="30" height="30" fill="none" stroke="#1A1A1A" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 4h14l4 4v20H7zM11 13h10M11 18h10M11 23h6"></path></svg>
            </div>
            <span class="proc-step-title" style="font-family:Newsreader,Georgia,serif;font-size:21px;line-height:1.15">Design &amp; fixed quote</span>
            <span class="proc-step-desc" style="font-size:14px;line-height:1.6;color:#6B6B6B">A free CAD drawing plus one written price. It includes building control fees.</span>
            <span class="proc-step-tags" style="display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:auto;padding-top:8px;font-family:'IBM Plex Mono',monospace;font-size:12px">
              <span class="proc-step-tag proc-tag-accent" style="color:#4F6B42">Free CAD</span><span class="proc-step-tag" style="color:#6B6B6B">Fixed price</span>
            </span>
          </div>

          <div class="proc-step-card" style="background:#FFFFFF;padding:24px 22px 26px;display:flex;flex-direction:column;gap:12px;color:#1A1A1A;transition:background .2s ease" onmouseover="this.style.background='#F1F5EE'" onmouseout="this.style.background='#FFFFFF'">
            <div class="proc-step-top" style="display:flex;align-items:center;justify-content:space-between">
              <span class="proc-step-num" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B8E5A;letter-spacing:.14em;font-weight:600">03</span>
              <svg class="proc-step-icon" viewBox="0 0 32 32" width="30" height="30" fill="none" stroke="#1A1A1A" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 4l11 5v8c0 6-4.6 10.3-11 11-6.4-.7-11-5-11-11V9zM11 16l4 4 7-7"></path></svg>
            </div>
            <span class="proc-step-title" style="font-family:Newsreader,Georgia,serif;font-size:21px;line-height:1.15">Approval</span>
            <span class="proc-step-desc" style="font-size:14px;line-height:1.6;color:#6B6B6B">Structural survey, calculations, and we file with Building Control for you.</span>
            <span class="proc-step-tags" style="display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:auto;padding-top:8px;font-family:'IBM Plex Mono',monospace;font-size:12px">
              <span class="proc-step-tag proc-tag-accent" style="color:#4F6B42">Fully handled</span><span class="proc-step-tag" style="color:#6B6B6B">Building control</span>
            </span>
          </div>

          <div class="proc-step-card" style="background:#FFFFFF;padding:24px 22px 26px;display:flex;flex-direction:column;gap:12px;color:#1A1A1A;transition:background .2s ease" onmouseover="this.style.background='#F1F5EE'" onmouseout="this.style.background='#FFFFFF'">
            <div class="proc-step-top" style="display:flex;align-items:center;justify-content:space-between">
              <span class="proc-step-num" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B8E5A;letter-spacing:.14em;font-weight:600">04</span>
              <svg class="proc-step-icon" viewBox="0 0 32 32" width="30" height="30" fill="none" stroke="#1A1A1A" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 28V12l10-7 10 7v16M6 12h20M16 5v23M11 20h10"></path></svg>
            </div>
            <span class="proc-step-title" style="font-family:Newsreader,Georgia,serif;font-size:21px;line-height:1.15">Build</span>
            <span class="proc-step-desc" style="font-size:14px;line-height:1.6;color:#6B6B6B">Steels, floor, dormer, staircase, insulation, plaster. Three to six weeks.</span>
            <span class="proc-step-tags" style="display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:auto;padding-top:8px;font-family:'IBM Plex Mono',monospace;font-size:12px">
              <span class="proc-step-tag proc-tag-accent" style="color:#4F6B42">3–6 weeks</span><span class="proc-step-tag" style="color:#6B6B6B">In-house team</span>
            </span>
          </div>

          <div class="proc-step-card" style="background:#FFFFFF;padding:24px 22px 26px;display:flex;flex-direction:column;gap:12px;color:#1A1A1A;transition:background .2s ease" onmouseover="this.style.background='#F1F5EE'" onmouseout="this.style.background='#FFFFFF'">
            <div class="proc-step-top" style="display:flex;align-items:center;justify-content:space-between">
              <span class="proc-step-num" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B8E5A;letter-spacing:.14em;font-weight:600">05</span>
              <svg class="proc-step-icon" viewBox="0 0 32 32" width="30" height="30" fill="none" stroke="#1A1A1A" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 16l7 7L27 8"></path></svg>
            </div>
            <span class="proc-step-title" style="font-family:Newsreader,Georgia,serif;font-size:21px;line-height:1.15">Handover</span>
            <span class="proc-step-desc" style="font-size:14px;line-height:1.6;color:#6B6B6B">Completion certificate, guarantee paperwork, and the site left clean.</span>
            <span class="proc-step-tags" style="display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:auto;padding-top:8px;font-family:'IBM Plex Mono',monospace;font-size:12px">
              <span class="proc-step-tag proc-tag-accent" style="color:#4F6B42">10-yr guarantee</span><span class="proc-step-tag" style="color:#6B6B6B">Certified</span>
            </span>
          </div>

        </div>
      </div>
    </section>

    <!-- Free Survey Booking Inline Section -->
    <section id="booking" data-reveal aria-labelledby="book-h" class="section-padding bg-gray border-top">
      <div class="container-narrow">
        <div style="display:flex;flex-wrap:wrap;gap:24px 48px;align-items:flex-end;justify-content:space-between;margin:0 0 40px">
          <div style="flex:2 1 460px">
            <span class="section-label">Free survey</span>
            <h2 id="book-h" class="heading-h2">Book a surveyor, not a call centre.</h2>
          </div>
          <p style="flex:1 1 280px;max-width:38ch;font-size:17px;line-height:1.6;color:#4A4A45;margin:0">Three short steps, about ninety seconds. You'll get a written fixed-price proposal and a CAD drawing within a few days of the visit.</p>
        </div>
        <?php 
          $widgetHeading = "Book your free survey";
          include 'includes/booking-widget.php'; 
        ?>
      </div>
    </section>

    <!-- Conversion Types Section -->
    <section id="types" data-reveal aria-labelledby="types-h" class="section-padding bg-white">
      <div class="container">
        <div class="conv-types-header" style="display:flex;flex-wrap:wrap;gap:20px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:44px">
          <div style="flex:2 1 420px">
            <span class="section-label">Conversion types</span>
            <h2 id="types-h" class="heading-h2" style="max-width:26ch">Six ways up. We'll tell you which two suit your roof.</h2>
          </div>
          <div class="conv-types-actions" style="display:flex;align-items:center;gap:12px">
            <a href="conversion-types.php" class="btn-secondary conv-types-btn" style="padding:13px 20px;font-size:15px;font-weight:600">Compare all six</a>
            <div class="carousel-nav-arrows">
              <button type="button" class="carousel-nav-btn carousel-prev-btn" aria-label="Previous conversion type">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
              </button>
              <button type="button" class="carousel-nav-btn carousel-next-btn" aria-label="Next conversion type">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="conversion-types-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:20px">
          <a href="velux-conversion.php" class="conversion-card">
            <div class="conversion-card-img-wrap">
              <img src="images/another-area-loft-conversions-north-west-england-03.jpeg" alt="Velux Loft Conversion Bedroom" class="real-img" loading="lazy">
            </div>
            <div class="conversion-card-body">
              <h3 class="conversion-card-title">Velux</h3>
              <p class="conversion-card-desc">Roof profile untouched. The quickest, cleanest route when you already have the headroom.</p>
              <div class="conversion-card-meta">
                <span class="meta-tag">Quickest build</span>
                <span class="meta-sub">3 weeks on site</span>
              </div>
            </div>
          </a>

          <a href="rear-dormer-conversion.php" class="conversion-card">
            <div class="conversion-card-img-wrap">
              <img src="images/another-area-loft-conversions-north-west-england-01.jpeg" alt="Rear Dormer Loft Conversion" class="real-img" loading="lazy">
            </div>
            <div class="conversion-card-body">
              <h3 class="conversion-card-title">Rear Dormer</h3>
              <p class="conversion-card-desc">Flat-roof timber box across the rear. Maximum floor area, usually permitted development.</p>
              <div class="conversion-card-meta">
                <span class="meta-tag">Maximum floor space</span>
                <span class="meta-sub">4 weeks on site</span>
              </div>
            </div>
          </a>

          <a href="hip-to-gable-conversion.php" class="conversion-card">
            <div class="conversion-card-img-wrap">
              <img src="images/another-area-loft-conversions-north-west-england-02.jpeg" alt="Hip-to-Gable Loft Conversion" class="real-img" loading="lazy">
            </div>
            <div class="conversion-card-body">
              <h3 class="conversion-card-title">Hip-to-Gable</h3>
              <p class="conversion-card-desc">Squares off a sloping side roof to win the volume a new staircase needs.</p>
              <div class="conversion-card-meta">
                <span class="meta-tag">Ideal for 1930s semis</span>
                <span class="meta-sub">3.5 weeks on site</span>
              </div>
            </div>
          </a>

          <a href="hip-end-dormer-conversion.php" class="conversion-card">
            <div class="conversion-card-img-wrap">
              <img src="images/another-area-loft-conversions-north-west-england-04.jpeg" alt="Hip-End Dormer Loft Conversion" class="real-img" loading="lazy">
            </div>
            <div class="conversion-card-body">
              <h3 class="conversion-card-title">Hip-End Dormer</h3>
              <p class="conversion-card-desc">Extends the ridge on a hipped roof, finished in hanging tiles to match.</p>
              <div class="conversion-card-meta">
                <span class="meta-tag">Tile-hung extension</span>
                <span class="meta-sub">3.5 weeks on site</span>
              </div>
            </div>
          </a>

          <a href="wrap-around-conversion.php" class="conversion-card">
            <div class="conversion-card-img-wrap">
              <img src="images/another-area-loft-conversions-north-west-england-05.jpeg" alt="Wrap Around Loft Conversion" class="real-img" loading="lazy">
            </div>
            <div class="conversion-card-body">
              <h3 class="conversion-card-title">Wrap Around</h3>
              <p class="conversion-card-desc">Hip-to-gable plus rear dormer. The largest option, and the most technical.</p>
              <div class="conversion-card-meta">
                <span class="meta-tag">Master suite + en-suite</span>
                <span class="meta-sub">6 weeks on site</span>
              </div>
            </div>
          </a>

          <a href="roof-lift-conversion.php" class="conversion-card">
            <div class="conversion-card-img-wrap">
              <img src="images/another-area-loft-conversions-north-west-england-06.jpeg" alt="Roof-Lift Loft Conversion" class="real-img" loading="lazy">
            </div>
            <div class="conversion-card-body">
              <h3 class="conversion-card-title">Roof-Lift</h3>
              <p class="conversion-card-desc">For bungalows and low lofts: the roof comes off and goes back higher.</p>
              <div class="conversion-card-meta">
                <span class="meta-tag">For low headroom</span>
                <span class="meta-sub">6–8 weeks on site</span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- Property Types Section -->
    <section id="property" data-reveal aria-labelledby="prop-h" class="section-padding bg-gray border-top">
      <div class="container">
        <div class="prop-types-header" style="display:flex;flex-wrap:wrap;gap:20px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:40px">
          <div style="flex:2 1 420px">
            <span class="section-label">Property types</span>
            <h2 id="prop-h" class="heading-h2" style="max-width:24ch">Your house decides what is possible.</h2>
          </div>
          <div class="prop-types-actions" style="display:flex;align-items:center;gap:12px">
            <a href="property-types.php" class="btn-secondary prop-types-btn" style="padding:13px 20px;font-size:15px;font-weight:600">Compare all four</a>
            <div class="carousel-nav-arrows prop-carousel-arrows">
              <button type="button" class="carousel-nav-btn prop-prev-btn" aria-label="Previous property type">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
              </button>
              <button type="button" class="carousel-nav-btn prop-next-btn" aria-label="Next property type">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="property-overview-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1px;background:#E4E4DF;border:1px solid #E4E4DF">
          <a href="terrace-property.php" class="property-overview-card">
            <svg viewBox="0 0 48 32" width="52" height="35" fill="none" stroke="#1A1A1A" stroke-width="1.5" stroke-linejoin="round" aria-hidden="true"><path d="M4 30V14l10-8 10 8v16M24 30V14l10-8 10 8v16M14 30v-8h10v8"></path></svg>
            <span style="font-family:Newsreader,Georgia,serif;font-size:23px;line-height:1.15">Terrace</span>
            <span style="font-size:14px;line-height:1.6;color:#6B6B6B">No hip to square off and neighbours both sides, so the rear slope does the work.</span>
            <span style="display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:auto;padding-top:8px;font-family:'IBM Plex Mono',monospace;font-size:12px">
              <span style="color:#4F6B42">Rear Dormer Specialist</span><span style="color:#6B6B6B">2-Month Party Wall</span>
            </span>
          </a>

          <a href="semi-detached-property.php" class="property-overview-card">
            <svg viewBox="0 0 48 32" width="52" height="35" fill="none" stroke="#1A1A1A" stroke-width="1.5" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V13l12-9 12 9v17M20 30V13M14 30v-7h12v7"></path></svg>
            <span style="font-family:Newsreader,Georgia,serif;font-size:23px;line-height:1.15">Semi-detached</span>
            <span style="font-size:14px;line-height:1.6;color:#6B6B6B">The most converted house in the North West, and the most flexible.</span>
            <span style="display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:auto;padding-top:8px;font-family:'IBM Plex Mono',monospace;font-size:12px">
              <span style="color:#4F6B42">Hip-to-Gable Flexible</span><span style="color:#6B6B6B">50m³ Allowance</span>
            </span>
          </a>

          <a href="detached-property.php" class="property-overview-card">
            <svg viewBox="0 0 48 32" width="52" height="35" fill="none" stroke="#1A1A1A" stroke-width="1.5" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V14l16-10 16 10v16zM19 30v-8h10v8"></path></svg>
            <span style="font-family:Newsreader,Georgia,serif;font-size:23px;line-height:1.15">Detached</span>
            <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Hips both sides and no party wall. The most design freedom of any type.</span>
            <span style="display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:auto;padding-top:8px;font-family:'IBM Plex Mono',monospace;font-size:12px">
              <span style="color:#4F6B42">Maximum Design Freedom</span><span style="color:#6B6B6B">No Party Wall</span>
            </span>
          </a>

          <a href="bungalow-property.php" class="property-overview-card">
            <svg viewBox="0 0 48 32" width="52" height="35" fill="none" stroke="#1A1A1A" stroke-width="1.5" stroke-linejoin="round" aria-hidden="true"><path d="M4 30V18l20-12 20 12v12zM18 30v-7h12v7"></path></svg>
            <span style="font-family:Newsreader,Georgia,serif;font-size:23px;line-height:1.15">Bungalow</span>
            <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Shallow pitch, so headroom decides. Sometimes the roof comes off.</span>
            <span style="display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:auto;padding-top:8px;font-family:'IBM Plex Mono',monospace;font-size:12px">
              <span style="color:#4F6B42">Dormer &amp; Roof-Lift</span><span style="color:#6B6B6B">Ground vs Upwards</span>
            </span>
          </a>
        </div>
      </div>
    </section>

    <!-- Before / After Interactive Slider Section -->
    <section id="gallery" data-reveal aria-labelledby="ba-h" class="section-padding bg-white border-top border-bottom">
      <div class="container">
        <div style="display:flex;flex-wrap:wrap;gap:20px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:28px">
          <div style="flex:2 1 460px">
            <span class="section-label">Before / After</span>
            <h2 id="ba-h" class="heading-h2">Dusty roof space to finished room.</h2>
          </div>
          <p style="flex:1 1 260px;max-width:34ch;font-size:16px;line-height:1.6;color:#4A4A45;margin:0">Drag the handle. Four real projects, photographed the week before we started and the day we handed over.</p>
        </div>

        <div class="ba-container">
          <div class="ba-slider-area">
            <div class="ba-before-layer">
              <img src="images/another-area-loft-conversions-north-west-england-06.jpeg" alt="Loft Space Before Conversion" style="width:100%;height:100%;object-fit:cover;display:block">
            </div>
            <div class="ba-after-layer" style="clip-path: inset(0 0 0 50%)">
              <img src="images/another-area-loft-conversions-north-west-england-01.jpeg" alt="Finished Luxury Loft Conversion Bedroom" style="width:100%;height:100%;object-fit:cover;display:block">
            </div>
            <div class="ba-handle-line" style="left: 50%">
              <span class="ba-handle-knob">&#8596;</span>
            </div>
            <span class="ba-badge-before">Before</span>
            <span class="ba-badge-after">After</span>
          </div>

          <div class="ba-meta-container" style="background:#FFFFFF;padding:clamp(20px,2.4vw,28px);display:flex;flex-direction:column;gap:18px">
            <div>
              <span class="section-label ba-tag">Rear dormer · Bolton</span>
              <h3 class="ba-title" style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(22px,2.2vw,28px);line-height:1.15;letter-spacing:-.01em;margin:10px 0 0">Two bedrooms and a bathroom over a 1930s semi.</h3>
            </div>
            <dl class="ba-facts" style="margin:0;display:grid;gap:0">
              <div class="ba-fact-item" style="display:flex;justify-content:space-between;gap:16px;padding:11px 0;border-top:1px solid #EDEDE8">
                <dt style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#6B6B6B">Property</dt>
                <dd style="margin:0;font-size:14px;font-weight:600;text-align:right">Semi-detached</dd>
              </div>
              <div class="ba-fact-item" style="display:flex;justify-content:space-between;gap:16px;padding:11px 0;border-top:1px solid #EDEDE8">
                <dt style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#6B6B6B">On site</dt>
                <dd style="margin:0;font-size:14px;font-weight:600;text-align:right">4 weeks</dd>
              </div>
              <div class="ba-fact-item" style="display:flex;justify-content:space-between;gap:16px;padding:11px 0;border-top:1px solid #EDEDE8">
                <dt style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#6B6B6B">Floor added</dt>
                <dd style="margin:0;font-size:14px;font-weight:600;text-align:right">31 m²</dd>
              </div>
              <div class="ba-fact-item" style="display:flex;justify-content:space-between;gap:16px;padding:11px 0;border-top:1px solid #EDEDE8">
                <dt style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#6B6B6B">Guarantee</dt>
                <dd style="margin:0;font-size:14px;font-weight:600;text-align:right">6 Years</dd>
              </div>
            </dl>
            <div class="ba-projects-grid" style="margin-top:auto;display:grid;gap:6px">
              <button type="button" class="ba-project-btn active" data-proj="0">
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#4F6B42">01</span>
                <span style="font-size:13px;font-weight:500">Bolton semi</span>
              </button>
              <button type="button" class="ba-project-btn" data-proj="1">
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#9C9C95">02</span>
                <span style="font-size:13px;font-weight:500">Chorlton terrace</span>
              </button>
              <button type="button" class="ba-project-btn" data-proj="2">
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#9C9C95">03</span>
                <span style="font-size:13px;font-weight:500">Stockport detached</span>
              </button>
              <button type="button" class="ba-project-btn" data-proj="3">
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#9C9C95">04</span>
                <span style="font-size:13px;font-weight:500">Sale semi</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section data-reveal aria-labelledby="test-h" class="section-padding bg-gray border-top">
      <div class="container">
        <div style="display:flex;flex-wrap:wrap;gap:14px 28px;align-items:flex-end;justify-content:space-between;margin-bottom:28px">
          <div>
            <span class="section-label">Customer feedback</span>
            <h2 id="test-h" class="heading-h2">What the neighbours said.</h2>
          </div>
          <span style="font-family:'IBM Plex Mono',monospace;font-size:12px;color:#6B6B6B">Verified via Checkatrade &middot; 400+ reviews</span>
        </div>
        <div class="testimonials-grid">
          <figure class="testimonial-card dark wide">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
              <span style="letter-spacing:.16em;font-size:13px;color:#FFFFFF">★★★★★</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#DCE6D6">Rear dormer</span>
            </div>
            <blockquote class="testimonial-quote">Two bedrooms and a bathroom out of a loft we used for storing boxes. The number on the quote was the number we paid.</blockquote>
            <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
              <span class="testimonial-avatar">S</span>
              <span style="display:flex;flex-direction:column;line-height:1.35">
                <span style="font-size:14px;font-weight:600;color:#FFFFFF">Sarah</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#DCE6D6">Bolton · Sept 2025</span>
              </span>
            </figcaption>
          </figure>

          <figure class="testimonial-card">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
              <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Hip-to-gable</span>
            </div>
            <blockquote class="testimonial-quote">Four weeks start to finish, and they swept up every evening — which mattered with a toddler in the house.</blockquote>
            <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
              <span class="testimonial-avatar">D</span>
              <span style="display:flex;flex-direction:column;line-height:1.35">
                <span style="font-size:14px;font-weight:600;color:#1A1A1A">Daniel</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B">Chorlton · June 2025</span>
              </span>
            </figcaption>
          </figure>

          <figure class="testimonial-card accent">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
              <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Velux</span>
            </div>
            <blockquote class="testimonial-quote">They talked us out of the bigger option because our roof did not need it.</blockquote>
            <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
              <span class="testimonial-avatar">P</span>
              <span style="display:flex;flex-direction:column;line-height:1.35">
                <span style="font-size:14px;font-weight:600;color:#1A1A1A">Priya</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B">Stockport · Mar 2025</span>
              </span>
            </figcaption>
          </figure>

          <figure class="testimonial-card">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
              <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Rear dormer</span>
            </div>
            <blockquote class="testimonial-quote">Building control paperwork was all handled. We never had to chase anybody once.</blockquote>
            <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
              <span class="testimonial-avatar">M</span>
              <span style="display:flex;flex-direction:column;line-height:1.35">
                <span style="font-size:14px;font-weight:600;color:#1A1A1A">Mark</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B">Preston · Jan 2025</span>
              </span>
            </figcaption>
          </figure>

          <figure class="testimonial-card">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
              <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Wrap around</span>
            </div>
            <blockquote class="testimonial-quote">The CAD drawing sold it to my husband. Seeing the staircase landing made the whole thing real.</blockquote>
            <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
              <span class="testimonial-avatar">E</span>
              <span style="display:flex;flex-direction:column;line-height:1.35">
                <span style="font-size:14px;font-weight:600;color:#1A1A1A">Elaine</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B">Lytham · Nov 2024</span>
              </span>
            </figcaption>
          </figure>

          <figure class="testimonial-card accent">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
              <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Roof-lift</span>
            </div>
            <blockquote class="testimonial-quote">Our loft was 2.1m so I assumed it was a no. They dropped the landing ceiling and it works beautifully.</blockquote>
            <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
              <span class="testimonial-avatar">J</span>
              <span style="display:flex;flex-direction:column;line-height:1.35">
                <span style="font-size:14px;font-weight:600;color:#1A1A1A">Joseph</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B">Bury · Aug 2025</span>
              </span>
            </figcaption>
          </figure>

          <figure class="testimonial-card">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
              <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Hip-end dormer</span>
            </div>
            <blockquote class="testimonial-quote">Second conversion we have had done in the family. Straight back to the same team, no hesitation.</blockquote>
            <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
              <span class="testimonial-avatar">N</span>
              <span style="display:flex;flex-direction:column;line-height:1.35">
                <span style="font-size:14px;font-weight:600;color:#1A1A1A">Nadia</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B">Didsbury · May 2025</span>
              </span>
            </figcaption>
          </figure>

          <figure class="testimonial-card">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
              <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Velux</span>
            </div>
            <blockquote class="testimonial-quote">Quiet, tidy, and they warned us the day the steels were coming so we could work elsewhere.</blockquote>
            <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
              <span class="testimonial-avatar">T</span>
              <span style="display:flex;flex-direction:column;line-height:1.35">
                <span style="font-size:14px;font-weight:600;color:#1A1A1A">Tom</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B">Warrington · Feb 2025</span>
              </span>
            </figcaption>
          </figure>

          <figure class="testimonial-card dark wide">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
              <span style="letter-spacing:.16em;font-size:13px;color:#FFFFFF">★★★★★</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#DCE6D6">Rear dormer</span>
            </div>
            <blockquote class="testimonial-quote">The valuation came back £62,000 higher than before the work. Best money we have spent on the house.</blockquote>
            <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
              <span class="testimonial-avatar">R</span>
              <span style="display:flex;flex-direction:column;line-height:1.35">
                <span style="font-size:14px;font-weight:600;color:#FFFFFF">Rachel</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#DCE6D6">Sale · Oct 2024</span>
              </span>
            </figcaption>
          </figure>

          <a href="https://www.checkatrade.com/trades/AnotherLevelLoftConversionsNw" target="_blank" rel="noopener noreferrer" class="testimonial-checkatrade-card" style="border:1px solid #6B8E5A;border-radius:3px;padding:24px 22px 22px;display:flex;flex-direction:column;gap:14px;background:#F1F5EE;color:#1A1A1A;text-decoration:none;transition:background .2s">
            <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#4F6B42">Checkatrade verified</span>
            <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(30px,3vw,38px);line-height:1;letter-spacing:-.02em">9.8 / 10</span>
            <span style="font-size:14px;line-height:1.55;color:#4A4A45">Every review left by a customer whose conversion we finished. 400+ reviews and counting.</span>
            <span style="margin-top:auto;padding-top:8px;font-size:14px;font-weight:600;color:#4F6B42;border-bottom:1px solid #6B8E5A;align-self:flex-start;padding-bottom:3px">Read them all</span>
          </a>
        </div>
      </div>
    </section>

    <!-- Our Commitments & Guarantees (Replacing Pricing Friction) -->
    <section id="guarantees" data-reveal aria-labelledby="guar-h" class="section-padding bg-dark">
      <div class="container">
        <div class="promise-header" style="display:flex;flex-wrap:wrap;gap:20px;align-items:flex-end;justify-content:space-between;margin-bottom:44px">
          <div>
            <span class="section-label-light">The Another Level Promise</span>
            <h2 id="guar-h" class="heading-h2" style="color:#FFFFFF;max-width:24ch">Fixed price certainty, zero deposit required.</h2>
          </div>
          <p class="promise-header-desc" style="font-size:14px;line-height:1.6;color:#B8B8B0;margin:0;max-width:34ch">Every quote is a fixed-price written contract that never moves once signed. Staged payments on Building Control completion milestones.</p>
        </div>
        <div class="promise-cards-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1px;background:#2C2C29;border:1px solid #2C2C29">
          <div class="promise-card" style="background:#1A1A1A;padding:28px 24px;display:flex;flex-direction:column;gap:12px">
            <span class="promise-tag" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#A8B79E;letter-spacing:.12em;text-transform:uppercase">01 / Deposit</span>
            <span class="promise-title" style="font-family:Newsreader,Georgia,serif;font-size:clamp(22px,2.4vw,28px);line-height:1.2;color:#FFFFFF">&pound;0 Upfront Deposit</span>
            <p class="promise-desc" style="font-size:13.5px;line-height:1.65;color:#B8B8B0;margin:0">You only pay in stages as verified structural milestones are signed off by Building Control.</p>
          </div>
          <div class="promise-card" style="background:#1A1A1A;padding:28px 24px;display:flex;flex-direction:column;gap:12px">
            <span class="promise-tag" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#A8B79E;letter-spacing:.12em;text-transform:uppercase">02 / Guarantee</span>
            <span class="promise-title" style="font-family:Newsreader,Georgia,serif;font-size:clamp(22px,2.4vw,28px);line-height:1.2;color:#FFFFFF">6-Year Written Warranty</span>
            <p class="promise-desc" style="font-size:13.5px;line-height:1.65;color:#B8B8B0;margin:0">Full structural warranty covering all timber frameworks, structural steelwork, and dormer envelopes.</p>
          </div>
          <div class="promise-card" style="background:#1A1A1A;padding:28px 24px;display:flex;flex-direction:column;gap:12px">
            <span class="promise-tag" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#A8B79E;letter-spacing:.12em;text-transform:uppercase">03 / Commitment</span>
            <span class="promise-title" style="font-family:Newsreader,Georgia,serif;font-size:clamp(22px,2.4vw,28px);line-height:1.2;color:#FFFFFF">1 Project at a Time</span>
            <p class="promise-desc" style="font-size:13.5px;line-height:1.65;color:#B8B8B0;margin:0">Dedicated full-time craftsmen on your property every single day until completion. No subcontract juggling.</p>
          </div>
          <div class="promise-card" style="background:#1A1A1A;padding:28px 24px;display:flex;flex-direction:column;gap:12px">
            <span class="promise-tag" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#A8B79E;letter-spacing:.12em;text-transform:uppercase">04 / Design</span>
            <span class="promise-title" style="font-family:Newsreader,Georgia,serif;font-size:clamp(22px,2.4vw,28px);line-height:1.2;color:#FFFFFF">Free 3D CAD Plans</span>
            <p class="promise-desc" style="font-size:13.5px;line-height:1.65;color:#B8B8B0;margin:0">See your exact stairs and bedroom layout drawn to scale within days of your home survey.</p>
          </div>
        </div>
        <!-- Creative Integrated CTA Banner (No harsh lines, pure architectural trust) -->
        <div class="promise-cta-banner" style="margin-top:32px;background:linear-gradient(135deg,#232B20 0%,#191E16 100%);border:1px solid rgba(107,142,90,0.3);border-radius:6px;padding:clamp(24px,3vw,36px);display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:24px;box-shadow:0 16px 40px -12px rgba(0,0,0,0.5)">
          <div class="promise-cta-content" style="flex:1 1 360px;display:flex;flex-direction:column;gap:8px">
            <span class="promise-cta-pill" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#A8B79E;letter-spacing:.12em;text-transform:uppercase;display:flex;align-items:center;gap:8px">
              <span class="pulse-dot" style="display:inline-block;width:7px;height:7px;border-radius:50%;background:#6B8E5A"></span>
              No obligations &middot; 100% Free Consultation
            </span>
            <h3 class="promise-cta-heading" style="font-family:Newsreader,Georgia,serif;font-size:clamp(22px,2.2vw,28px);font-weight:400;color:#FFFFFF;line-height:1.2;margin:0">
              Ready to explore what's possible for your loft?
            </h3>
            <p class="promise-cta-sub" style="font-size:13.5px;line-height:1.55;color:#B8B8B0;margin:0">
              Get an accurate fixed quote &amp; bespoke 3D layout from Jonny Mee — without paying a penny upfront.
            </p>
          </div>
          <div class="promise-cta-action" style="display:flex;align-items:center">
            <a href="#booking" data-open-booking class="btn-primary promise-cta-btn" style="background:#6B8E5A;color:#FFFFFF !important;display:inline-flex;align-items:center;gap:10px;padding:16px 28px;font-size:15.5px;font-weight:600;border-radius:4px;box-shadow:0 8px 24px rgba(107,142,90,0.35);text-decoration:none;white-space:nowrap;transition:all .25s ease">
              <span>Book Your Free Survey</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- 41 Service Areas Component -->
    <?php include 'includes/service-areas.php'; ?>

    <!-- FAQ Accordion Section -->
    <section data-reveal aria-labelledby="faq-h" class="section-padding bg-gray border-top">
      <div class="container faq-layout">
        <div class="faq-sticky-col">
          <span class="section-label">Questions</span>
          <h2 id="faq-h" class="heading-h2" style="margin:12px 0 18px;max-width:16ch">The six we're asked every week.</h2>
          <p style="font-size:16px;line-height:1.65;color:#4A4A45;margin:0 0 24px;max-width:38ch">Anything else, ask the surveyor &mdash; the visit is free whether you go ahead or not.</p>
          <div class="faq-action-btns" style="display:flex;flex-wrap:nowrap;gap:10px;align-items:center;margin-top:4px">
            <a href="#booking" data-open-booking class="btn-primary" style="padding:12px 18px;font-size:14px;white-space:nowrap">Book Free Survey</a>
            <a href="tel:08000862744" class="btn-secondary" style="padding:11px 16px;font-size:14px;white-space:nowrap">Ask us directly</a>
          </div>
        </div>
        <div class="faq-container-box">
          <div class="faq-wrap open">
            <button type="button" class="faq-btn" aria-expanded="true">
              <span class="faq-num">01</span>
              <span class="faq-question">Do I need planning permission?</span>
              <span class="faq-sign">–</span>
            </button>
            <div class="faq-answer">
              <p>Usually not. Most conversions fall under permitted development, up to 50m³ for a detached or semi and 40m³ for a terrace. Conservation areas, listed buildings and designated land are the exceptions, and we tell you which applies at the survey.</p>
            </div>
          </div>

          <div class="faq-wrap">
            <button type="button" class="faq-btn" aria-expanded="false">
              <span class="faq-num">02</span>
              <span class="faq-question">How long does it take?</span>
              <span class="faq-sign">+</span>
            </button>
            <div class="faq-answer">
              <p>Three weeks for a Velux, four for a rear dormer, around six for a wrap around. Plans and approval run before that — typically two to four weeks from signing.</p>
            </div>
          </div>

          <div class="faq-wrap">
            <button type="button" class="faq-btn" aria-expanded="false">
              <span class="faq-num">03</span>
              <span class="faq-question">Will it be messy?</span>
              <span class="faq-sign">+</span>
            </button>
            <div class="faq-answer">
              <p>There is dust, but the loft is sealed off and the stairwell is only cut through late in the build. Scaffolding and a rear hoist keep most material out of the house entirely.</p>
            </div>
          </div>

          <div class="faq-wrap">
            <button type="button" class="faq-btn" aria-expanded="false">
              <span class="faq-num">04</span>
              <span class="faq-question">Do I need to move out?</span>
              <span class="faq-sign">+</span>
            </button>
            <div class="faq-answer">
              <p>No. Almost every customer stays in the house. Water is off for a few hours when radiators go in, and there is one noisy day when the steels land.</p>
            </div>
          </div>

          <div class="faq-wrap">
            <button type="button" class="faq-btn" aria-expanded="false">
              <span class="faq-num">05</span>
              <span class="faq-question">What if my loft height is too low?</span>
              <span class="faq-sign">+</span>
            </button>
            <div class="faq-answer">
              <p>2.2m from the ceiling joists to the underside of the ridge is the working minimum — 2.4m on modern trusses. If you are slightly short and have generous ceilings below, dropping the first-floor ceilings is often possible. A roof-lift is the other route.</p>
            </div>
          </div>

          <div class="faq-wrap">
            <button type="button" class="faq-btn" aria-expanded="false">
              <span class="faq-num">06</span>
              <span class="faq-question">How much does it cost?</span>
              <span class="faq-sign">+</span>
            </button>
            <div class="faq-answer">
              <p>Velux conversions start at £24,000 and a wrap around at £48,000. After the survey you get one fixed written figure covering structure, staircase, insulation, plastering and building control.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Banner Section -->
    <section data-reveal aria-labelledby="cta-h" class="section-padding bg-primary">
      <div class="container final-cta-layout" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:clamp(32px,5vw,72px);align-items:center">
        <div class="final-cta-left">
          <span class="section-label-subtle">One free visit</span>
          <h2 id="cta-h" class="heading-h1 final-cta-title" style="font-size:clamp(34px,5vw,60px);color:#FFFFFF;margin-top:14px">Find out what your loft is worth <em style="font-style:italic">before</em> you spend a penny.</h2>
          <p class="final-cta-desc" style="font-size:18px;line-height:1.6;margin:20px 0 30px;color:#EDF2E9;max-width:42ch">Forty-five minutes in your house, a CAD drawing you keep, and one fixed price. Say no afterwards and it has cost you nothing.</p>
          <div class="final-cta-btns" style="display:flex;flex-wrap:wrap;gap:14px;align-items:center">
            <a href="#booking" data-open-booking class="btn-dark final-cta-btn-book">Book Free Survey</a>
            <a href="tel:08000862744" class="btn-outline-white final-cta-btn-call">
              <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <span>Call 0800 0862744</span>
            </a>
          </div>
        </div>
        <div class="final-cta-card" style="background:#FFFFFF;color:#1A1A1A;border-radius:3px;padding:clamp(24px,3vw,34px)">
          <span class="section-label">What happens next</span>
          <ol class="final-cta-steps" style="list-style:none;margin:18px 0 0;padding:0;display:grid;gap:0">
            <li class="final-cta-step" style="display:flex;gap:14px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #EDEDE8">
              <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B8E5A;flex:0 0 26px;padding-top:4px">01</span>
              <span style="display:flex;flex-direction:column;gap:4px">
                <span style="font-size:16px;font-weight:600;line-height:1.3">The survey</span>
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Measurements, trusses, staircase options, your questions.</span>
              </span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#9C9C95;margin-left:auto;white-space:nowrap;padding-top:4px">45 min</span>
            </li>
            <li class="final-cta-step" style="display:flex;gap:14px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #EDEDE8">
              <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B8E5A;flex:0 0 26px;padding-top:4px">02</span>
              <span style="display:flex;flex-direction:column;gap:4px">
                <span style="font-size:16px;font-weight:600;line-height:1.3">CAD design + fixed quote</span>
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">A drawing of the finished layout and one written price.</span>
              </span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#9C9C95;margin-left:auto;white-space:nowrap;padding-top:4px">A few days</span>
            </li>
            <li class="final-cta-step" style="display:flex;gap:14px;align-items:flex-start;padding:16px 0">
              <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B8E5A;flex:0 0 26px;padding-top:4px">03</span>
              <span style="display:flex;flex-direction:column;gap:4px">
                <span style="font-size:16px;font-weight:600;line-height:1.3">You decide</span>
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Amend it, sit on it, or book a start date. No chasing from us.</span>
              </span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#9C9C95;margin-left:auto;white-space:nowrap;padding-top:4px">Your call</span>
            </li>
          </ol>
          <p class="final-cta-card-foot" style="margin:20px 0 0;font-size:13px;line-height:1.6;color:#6B6B6B">No deposit, no obligation, and the drawings stay yours whatever you decide.</p>
        </div>
      </div>
    </section>

  </main>

  <?php include 'includes/booking-modal.php'; ?>
  <?php include 'includes/footer.php'; ?>
