<?php
$pageTitle = "Loft Conversions in Chorlton — Another Level";
$pageDesc = "Loft conversions in Chorlton. Fixed price, free survey, free CAD design. Velux, dormer and hip-to-gable conversions across M21.";
$activePage = "contact";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "Service",
    "serviceType" => "Loft conversion",
    "areaServed" => [
        "@type" => "City",
        "name" => "Chorlton"
    ],
    "provider" => [
        "@type" => "LocalBusiness",
        "name" => "Another Level Loft Conversions",
        "telephone" => "0800 0862744"
    ],
    "offers" => [
        "@type" => "AggregateOffer",
        "priceCurrency" => "GBP",
        "lowPrice" => "24000"
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$city = "Chorlton";
$postcodes = "M21";
$team = "Manchester";
$localPhone = "0161 4100155";
$projectCount = "40+";
$conservationCount = "22";
$intro = "Chorlton's Victorian and Edwardian red-brick terraces and semi-detached properties feature high pitches that create stunning master suites and home studios. Our Manchester team works regularly across M21.";

$localProjects = [
    ['title' => 'Master bedroom suite with rear dormer', 'meta' => 'Victorian terrace · Beech Road · 4 weeks', 'img' => 'images/another-area-loft-conversions-north-west-england-03.jpeg'],
    ['title' => 'Hip-to-gable conversion with en-suite', 'meta' => '1930s semi · Chorlton Green · 3.5 weeks', 'img' => 'images/another-area-loft-conversions-north-west-england-04.jpeg'],
    ['title' => 'Velux rooflight artist studio', 'meta' => 'Edwardian terrace · St Clements · 3 weeks', 'img' => 'images/another-area-loft-conversions-north-west-england-04.jpeg'],
];

$faqs = [
    ['q' => 'Do Chorlton loft conversions need planning permission?', 'a' => 'Most conversions fall under Permitted Development. However, properties within the Chorlton Green conservation area require planning permission from Manchester City Council for rear roof alterations.'],
    ['q' => 'What design options work best on Victorian terraces in M21?', 'a' => 'Full-width rear dormers with timber cladding or slate hanging create large light-filled double bedrooms with ensuite shower rooms.'],
    ['q' => 'How do you handle fire safety on three-storey houses?', 'a' => 'Converting a loft creates a three-storey home. We install mains-wired interlinked smoke alarms, protected escape corridors, and fire-rated doors (FD30) to meet Part B regulations.'],
    ['q' => 'Can you install solar panels or Velux rooflights on a Chorlton loft?', 'a' => 'Yes, we are Velux certified installers and integrate top-hung rooflights, electric blackout blinds, and solar panel integration into your roof design.'],
    ['q' => 'How quickly can you survey in Chorlton?', 'a' => 'Our surveyor is in South Manchester throughout the week. Free surveys can be booked in M21 within 48 to 72 hours.'],
    ['q' => 'What is the average timeline for an M21 conversion?', 'a' => 'On-site construction takes between 3.5 and 5 weeks, depending on whether an en-suite and custom dormer windows are specified.'],
    ['q' => 'Are CAD drawings included for free?', 'a' => 'Yes, every survey includes a complimentary 2D/3D CAD design showing your proposed room layout, staircase, and head clearances.'],
    ['q' => 'How does payment work?', 'a' => 'No deposit is needed. Payments are staged across milestones (scaffold/timbers, watertight shell, first-fix, plastering, completion).'],
];

$nearby = ['Didsbury', 'Sale', 'Stretford', 'Manchester', 'Salford'];

include 'includes/header.php';
?>

  <main>
    <!-- Hero Section with Quick Booking Widget -->
    <section aria-labelledby="c-h" class="border-bottom">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));max-width:1280px;margin:0 auto;align-items:stretch">
        <div style="padding:clamp(26px,3.6vw,52px) 20px clamp(30px,3.6vw,52px);display:flex;flex-direction:column;justify-content:center;gap:20px">
          <!-- Embedded Breadcrumb & Badge -->
          <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
            <nav aria-label="Breadcrumb" class="breadcrumb-inline">
              <a href="index.php">Home</a>
              <span class="crumb-sep">/</span>
              <span class="crumb-current" aria-current="page"><?php echo $city; ?></span>
            </nav>
            <span style="color:#D4D4CC;font-size:12px">•</span>
            <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
              <span style="width:5px;height:5px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              <?php echo $postcodes; ?>
            </span>
          </div>
          <h1 id="c-h" class="heading-h1" style="font-size:clamp(34px,5.4vw,56px);letter-spacing:-.025em;margin:0">Loft Conversions in <?php echo $city; ?></h1>
          <p style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(20px,2.4vw,25px);line-height:1.25;color:#4F6B42;margin:-4px 0 2px;letter-spacing:-.015em">Fixed-price specialist conversions, from survey to sign-off.</p>
          <p class="lead-text" style="max-width:46ch"><?php echo $intro; ?></p>
          <div class="hero-actions-row" style="margin-top:2px">
            <a href="#booking" data-open-booking class="btn-primary hero-btn">
              <span>Book Free Survey</span>
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
            </a>
            <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $localPhone); ?>" class="btn-secondary hero-btn">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <span><?php echo $localPhone; ?></span>
            </a>
          </div>
          <div style="display:flex;flex-wrap:wrap;gap:8px 20px;font-family:'IBM Plex Mono',monospace;font-size:13px;color:#6B6B6B">
            <span><?php echo $projectCount; ?> projects in <?php echo $city; ?></span><span>Checkatrade member</span><span>Free CAD design</span>
          </div>
        </div>

        <!-- Inline Step 1 Widget -->
        <div style="background:#FFFFFF;border-left:1px solid #EDEDE8;display:flex;flex-direction:column">
          <div style="flex:1 1 auto;display:flex;flex-direction:column;background:#FFFFFF">
            <div style="padding:26px 26px 20px;border-bottom:1px solid #EDEDE8">
              <div style="display:flex;align-items:baseline;justify-content:space-between;gap:12px;margin-bottom:8px">
                <span class="section-label">Free survey booking</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:12px;color:#6B6B6B;white-space:nowrap">Step 1 / 3</span>
              </div>
              <h2 style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(22px,2.3vw,28px);line-height:1.14;letter-spacing:-.01em;margin:0">Book your free survey</h2>
            </div>
            <div style="height:3px;background:#EDEDE8"><div style="height:3px;background:#6B8E5A;width:33%"></div></div>
            <div style="flex:1 1 auto;padding:26px;display:flex;flex-direction:column">
              <p style="font-size:15px;line-height:1.6;color:#6B6B6B;margin:0 0 18px">What kind of property is it? This tells us which conversion types are possible before we visit.</p>
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:18px">
                <button type="button" class="property-opt-btn" data-property="Terrace" style="text-align:left;padding:14px 14px 16px;font-family:inherit;border-radius:3px;cursor:pointer;transition:border-color .2s,background .2s;border:1px solid #DCDCD6;background:#FFFFFF;color:#1A1A1A">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M4 30V14l10-8 10 8v16M24 30V14l10-8 10 8v16M14 30v-8h10v8"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Terrace</div>
                  <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:3px">40m³ limit</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Semi-detached" style="text-align:left;padding:14px 14px 16px;font-family:inherit;border-radius:3px;cursor:pointer;transition:border-color .2s,background .2s;border:1px solid #DCDCD6;background:#FFFFFF;color:#1A1A1A">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V13l12-9 12 9v17M20 30V13M14 30v-7h12v7"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Semi-detached</div>
                  <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:3px">Most common</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Detached" style="text-align:left;padding:14px 14px 16px;font-family:inherit;border-radius:3px;cursor:pointer;transition:border-color .2s,background .2s;border:1px solid #DCDCD6;background:#FFFFFF;color:#1A1A1A">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V14l16-10 16 10v16zM19 30v-8h10v8"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Detached</div>
                  <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:3px">50m³ limit</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Bungalow" style="text-align:left;padding:14px 14px 16px;font-family:inherit;border-radius:3px;cursor:pointer;transition:border-color .2s,background .2s;border:1px solid #DCDCD6;background:#FFFFFF;color:#1A1A1A">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M4 30V18l20-12 20 12v12zM18 30v-7h12v7"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Bungalow</div>
                  <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:3px">Roof-lift option</div>
                </button>
              </div>
              <label style="display:block;margin-bottom:18px">
                <span style="display:block;font-size:13px;font-weight:600;letter-spacing:.02em;margin-bottom:8px">Postcode</span>
                <input type="text" id="cityHeroPostcode" placeholder="e.g. <?php echo explode(',', $postcodes)[0]; ?> 1AA" autocomplete="postal-code" style="width:100%;padding:14px 16px;font-size:16px;border:1px solid #DCDCD6;border-radius:3px;background:#FAFAF8;color:#1A1A1A;box-sizing:border-box">
              </label>
              <button type="button" id="cityHeroContinue" class="btn-primary" style="width:100%">Continue</button>
              <div id="cityHeroError" style="font-size:13px;color:#B4423A;margin-top:10px;min-height:18px"></div>
              <div style="display:flex;flex-wrap:wrap;gap:6px 16px;font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:auto;padding-top:12px">
                <span>No obligation</span><span>Free CAD design</span><span><?php echo $projectCount; ?> in <?php echo $city; ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Recent Projects Near City -->
    <section data-reveal class="section-padding-sm bg-white">
      <div class="container">
        <div style="display:flex;flex-wrap:wrap;gap:20px;align-items:flex-end;justify-content:space-between;margin-bottom:32px">
          <div>
            <span class="section-label">Portfolio</span>
            <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0">Recent projects near <?php echo $city; ?></h2>
          </div>
          <a href="gallery.php" style="font-size:15px;font-weight:600;border-bottom:1px solid #6B8E5A;padding-bottom:3px">Full before / after gallery</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px">
          <?php foreach ($localProjects as $p): ?>
            <figure style="margin:0;border:1px solid #E4E4DF;border-radius:3px;overflow:hidden">
              <div class="real-img-box" style="aspect-ratio:4/3">
                <img src="<?php echo $p['img']; ?>" alt="<?php echo htmlspecialchars($p['title']); ?>" class="real-img" loading="lazy">
              </div>
              <figcaption style="padding:18px 20px 20px;display:flex;flex-direction:column;gap:6px">
                <span style="font-size:16px;font-weight:600"><?php echo $p['title']; ?></span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:12px;color:#6B6B6B"><?php echo $p['meta']; ?></span>
              </figcaption>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Booking Inline Widget -->
    <section id="booking" data-reveal class="section-padding-sm bg-gray border-top border-bottom">
      <div class="container-narrow">
        <div style="display:flex;flex-wrap:wrap;gap:20px 48px;align-items:flex-end;justify-content:space-between;margin:0 0 36px">
          <div style="flex:2 1 420px">
            <span class="section-label">Free survey</span>
            <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0">Book a surveyor in <?php echo $city; ?></h2>
          </div>
          <p style="flex:1 1 260px;max-width:36ch;font-size:17px;line-height:1.6;color:#4A4A45;margin:0">Our <?php echo $team; ?> team covers <?php echo $city; ?>. Three steps, about ninety seconds.</p>
        </div>
        <?php 
          $widgetHeading = "Book your free survey";
          include 'includes/booking-widget.php'; 
        ?>
      </div>
    </section>

                <!-- Local Specifics (FAQs) -->
    <section data-reveal class="section-padding-sm bg-white">
      <div class="container">
        <div style="margin-bottom:28px">
          <span class="section-label"><?php echo $city; ?> questions</span>
          <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:10px 0 0">Local specifics</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:44px;align-items:stretch">
          <div class="faq-container-box" style="max-width:100%;margin:0">
            <?php foreach ($faqs as $idx => $f): 
              $num = sprintf("%02d", $idx + 1);
              $isOpen = ($idx === 0) ? ' open' : '';
              $ariaExp = ($idx === 0) ? 'true' : 'false';
              $sign = ($idx === 0) ? '–' : '+';
            ?>
              <div class="faq-wrap<?php echo $isOpen; ?>">
                <button type="button" class="faq-btn" aria-expanded="<?php echo $ariaExp; ?>">
                  <span class="faq-num"><?php echo $num; ?></span>
                  <span class="faq-question"><?php echo htmlspecialchars($f['q']); ?></span>
                  <span class="faq-sign"><?php echo $sign; ?></span>
                </button>
                <div class="faq-answer">
                  <p><?php echo htmlspecialchars($f['a']); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div style="display:flex;flex-direction:column;justify-content:space-between">
            <div style="flex:1 1 auto;min-height:380px;border:1px solid #E4E4DF;border-radius:3px;overflow:hidden;margin-bottom:20px;background:#F5F5F3;box-shadow:0 2px 8px rgba(0,0,0,0.03);display:flex;flex-direction:column">
              <iframe 
                title="Loft Conversions <?php echo htmlspecialchars($city); ?> Service Area Map"
                width="100%" 
                height="100%" 
                style="border:0;width:100%;height:100%;min-height:380px;flex:1 1 auto;display:block" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade" 
                src="https://maps.google.com/maps?q=<?php echo urlencode($city . ', UK'); ?>&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=&amp;output=embed">
              </iframe>
            </div>
            <div style="margin-top:auto">
              <span class="section-label">Nearby areas</span>
              <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:10px">
                <?php foreach ($nearby as $n): 
                  $nSlug = function_exists('getTownSlug') ? getTownSlug($n) : strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $n));
                ?>
                  <a href="<?php echo $nSlug; ?>.php" class="town-pill" style="font-size:12px;padding:7px 11px"><?php echo $n; ?></a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- Local CTA Banner -->
    <section data-reveal aria-labelledby="cta-h" class="section-padding bg-primary">
      <div class="container" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:clamp(32px,5vw,64px);align-items:center">
        <div>
          <span class="section-label-subtle"><?php echo $postcodes; ?></span>
          <h2 id="cta-h" class="heading-h1" style="font-size:clamp(34px,5vw,60px);color:#FFFFFF;margin-top:14px">The surveyor is already in <?php echo $city; ?> this week.</h2>
          <p style="font-size:18px;line-height:1.6;margin:20px 0 30px;color:#EDF2E9;max-width:40ch">Forty-five minutes, a CAD drawing you keep, one fixed written price. Nothing to pay whatever you decide afterwards.</p>
          <div style="display:flex;flex-wrap:wrap;gap:14px;align-items:center">
            <a href="#booking" data-open-booking class="btn-dark">Book Free Survey</a>
            <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $localPhone); ?>" class="btn-outline-white">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16.9v2.6a1.7 1.7 0 0 1-1.9 1.7 16.6 16.6 0 0 1-7.2-2.6 16.3 16.3 0 0 1-5-5A16.6 16.6 0 0 1 4.3 6.4 1.7 1.7 0 0 1 6 4.5h2.6a1.7 1.7 0 0 1 1.7 1.5c.1.9.3 1.7.6 2.5a1.7 1.7 0 0 1-.4 1.8l-1.1 1.1a13.4 13.4 0 0 0 5 5l1.1-1.1a1.7 1.7 0 0 1 1.8-.4c.8.3 1.6.5 2.5.6a1.7 1.7 0 0 1 1.5 1.7z"></path></svg>
              <?php echo $localPhone; ?>
            </a>
          </div>
        </div>
        <div style="background:#FFFFFF;border-radius:3px;padding:clamp(24px,3vw,34px);box-shadow:0 12px 32px -8px rgba(0,0,0,0.12);display:flex;flex-direction:column;gap:18px">
          <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid #EDEDE8">
            <span class="section-label" style="display:inline-flex;align-items:center;gap:6px">
              <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              <?php echo $city; ?> Surveyor Guarantee
            </span>
            <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 9px;border-radius:12px">100% Free Survey</span>
          </div>

          <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1px;background:#E4E4DF;border:1px solid #E4E4DF;border-radius:3px;overflow:hidden">
            <div style="background:#FAFAF8;padding:16px 18px;display:flex;flex-direction:column;gap:4px">
              <span style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(24px,2.6vw,30px);line-height:1;letter-spacing:-.02em;color:#1A1A1A"><?php echo $projectCount; ?></span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B8E5A">Local Projects</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;line-height:1.5;color:#6B6B6B;margin-top:2px">Conversions finished across <?php echo $city; ?> &amp; postcodes.</span>
            </div>

            <div style="background:#FAFAF8;padding:16px 18px;display:flex;flex-direction:column;gap:4px">
              <span style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(24px,2.6vw,30px);line-height:1;letter-spacing:-.02em;color:#1A1A1A">5 Days</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B8E5A">To Survey</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;line-height:1.5;color:#6B6B6B;margin-top:2px">Typical wait for a slot, evenings included.</span>
            </div>

            <div style="background:#FAFAF8;padding:16px 18px;display:flex;flex-direction:column;gap:4px">
              <span style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(24px,2.6vw,30px);line-height:1;letter-spacing:-.02em;color:#1A1A1A">26</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B8E5A">Conservation Areas</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;line-height:1.5;color:#6B6B6B;margin-top:2px">Checked against your address before we quote.</span>
            </div>

            <div style="background:#FAFAF8;padding:16px 18px;display:flex;flex-direction:column;gap:4px">
              <span style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(24px,2.6vw,30px);line-height:1;letter-spacing:-.02em;color:#1A1A1A">£0</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B8E5A">Cost To You</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;line-height:1.5;color:#6B6B6B;margin-top:2px">Survey, 3D CAD drawing and fixed quote.</span>
            </div>
          </div>

          <div style="display:flex;align-items:center;gap:10px;padding-top:12px;border-top:1px solid #EDEDE8;font-family:var(--font-sans);font-size:13px;color:#4A4A45;line-height:1.5">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0"><path d="M20 6L9 17l-5-5"/></svg>
            <span>Survey, drawing and quote. Say no afterwards and owe nothing.</span>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      let selectedProp = '';
      const propBtns = document.querySelectorAll('.property-opt-btn');
      const errBox = document.getElementById('cityHeroError');
      const pcInput = document.getElementById('cityHeroPostcode');
      const continueBtn = document.getElementById('cityHeroContinue');

      propBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          propBtns.forEach(b => {
            b.style.borderColor = '#DCDCD6';
            b.style.background = '#FFFFFF';
            b.style.boxShadow = 'none';
          });
          btn.style.borderColor = '#6B8E5A';
          btn.style.background = '#F1F5EE';
          btn.style.boxShadow = 'inset 0 0 0 1px #6B8E5A';
          selectedProp = btn.getAttribute('data-property');
          if (errBox) errBox.textContent = '';
        });
      });

      if (continueBtn) {
        continueBtn.addEventListener('click', () => {
          if (!selectedProp) {
            if (errBox) errBox.textContent = 'Pick your property type to continue.';
            return;
          }
          const pc = pcInput ? pcInput.value.trim() : '';
          if (pc.length < 5) {
            if (errBox) errBox.textContent = 'Enter a full postcode so we can check coverage.';
            return;
          }
          if (errBox) errBox.textContent = '';
          window.dispatchEvent(new CustomEvent('open-booking', {
            detail: { property: selectedProp, postcode: pc }
          }));
        });
      }
    });
  </script>

  <!-- 41 Service Areas -->
  <?php 
    $activeCity = "Chorlton";
    include 'includes/service-areas.php'; 
  ?>

  <?php include 'includes/booking-modal.php'; ?>
  <?php include 'includes/footer.php'; ?>