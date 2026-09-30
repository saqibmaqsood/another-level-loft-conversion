<?php
$pageTitle = "Loft Conversion Gallery — Another Level";
$pageDesc = "Before and after photographs of finished loft conversions in Bolton, Manchester, Preston, Stockport and across the North West.";
$activePage = "gallery";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "CollectionPage",
    "name" => "Loft conversion gallery",
    "about" => [
        "@type" => "LocalBusiness",
        "name" => "Another Level Loft Conversions"
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$galleryProjects = [
    [
        'type' => 'Rear Dormer', 'town' => 'Bolton', 'title' => 'Two bedrooms and a bathroom over a 1930s semi.',
        'weeks' => '4 weeks', 'area' => '31 m²', 'property' => 'Semi-detached', 'price' => '£38,000',
        'body' => 'A full-width rear dormer under permitted development. The old hatch became a dog-leg staircase off the landing, which kept both existing bedrooms full size.'
    ],
    [
        'type' => 'Velux', 'town' => 'Chorlton', 'title' => 'A home office under the original roof line.',
        'weeks' => '3 weeks', 'area' => '18 m²', 'property' => 'Terrace', 'price' => '£24,000',
        'body' => 'Ridge height was already 2.5m, so nothing outside changed. Three Velux windows, a full insulation upgrade and a fixed staircase where the loft ladder used to be.'
    ],
    [
        'type' => 'Hip-to-Gable', 'town' => 'Stockport', 'title' => 'Squared-off roof, en-suite guest room.',
        'weeks' => '3.5 weeks', 'area' => '27 m²', 'property' => 'Detached', 'price' => '£37,000',
        'body' => 'The hip came off the side elevation and went back as a gable wall in matching brick. That single change gave the staircase the head height it needed at the top.'
    ],
    [
        'type' => 'Wrap Around', 'town' => 'Sale', 'title' => 'Full-width master suite across the roof.',
        'weeks' => '6 weeks', 'area' => '44 m²', 'property' => 'Semi-detached', 'price' => '£48,000',
        'body' => 'Hip-to-gable plus a rear dormer, so the floor plate runs the full footprint of the house. Dressing area, en-suite, and a window seat over the garden.'
    ],
    [
        'type' => 'Rear Dormer', 'town' => 'Preston', 'title' => 'Twin rooms for two growing children.',
        'weeks' => '4 weeks', 'area' => '29 m²', 'property' => 'Semi-detached', 'price' => '£39,500',
        'body' => 'One dormer, one partition wall, two identical rooms. Building control signed off the fire door and mains-linked alarms on the first visit.'
    ],
    [
        'type' => 'Hip-End Dormer', 'town' => 'Didsbury', 'title' => 'Ridge extended in hanging tiles to match.',
        'weeks' => '3.5 weeks', 'area' => '24 m²', 'property' => 'Semi-detached', 'price' => '£37,000',
        'body' => 'A conservation-sensitive street, so the dormer was clad in hanging tiles taken from the same range as the roof. From the pavement you have to look twice.'
    ],
    [
        'type' => 'Roof-Lift', 'town' => 'Bury', 'title' => 'A 1960s bungalow that gained a first floor.',
        'weeks' => '8 weeks', 'area' => '52 m²', 'property' => 'Bungalow', 'price' => 'On survey',
        'body' => 'Original loft was 2.1m. The roof came off in a day, the walls went up, and the new roof went back 900mm higher with two dormers to the front.'
    ],
    [
        'type' => 'Velux', 'town' => 'Warrington', 'title' => 'Quiet study over a terraced kitchen.',
        'weeks' => '3 weeks', 'area' => '16 m²', 'property' => 'Terrace', 'price' => '£24,000',
        'body' => 'The tightest plan we have done this year. A space-saver staircase, built-in desk run under the slope, and storage in the eaves on both sides.'
    ],
    [
        'type' => 'Hip-to-Gable', 'town' => 'Lytham', 'title' => 'Sea-view bedroom with a dormer to the rear.',
        'weeks' => '4 weeks', 'area' => '30 m²', 'property' => 'Detached', 'price' => '£41,000',
        'body' => 'Gable to the side and a small rear dormer for the shower room. Rendered to match the existing elevation rather than left in brick.'
    ],
    [
        'type' => 'Rear Dormer', 'town' => 'Manchester', 'title' => 'Rental conversion turned into two lettable rooms.',
        'weeks' => '4.5 weeks', 'area' => '33 m²', 'property' => 'Terrace', 'price' => '£40,000',
        'body' => 'A landlord job with a hard deadline. Two rooms, one shower room, and all the fire-separation paperwork completed for the HMO licence.'
    ],
    [
        'type' => 'Wrap Around', 'town' => 'Chorley', 'title' => 'Family bathroom moved upstairs, twice over.',
        'weeks' => '6 weeks', 'area' => '46 m²', 'property' => 'Semi-detached', 'price' => '£49,000',
        'body' => 'The largest job of the year. Two double bedrooms and a family bathroom, with the plumbing re-run so nothing crosses the original landing.'
    ],
    [
        'type' => 'Velux', 'town' => 'Southport', 'title' => 'Guest room kept deliberately simple.',
        'weeks' => '3 weeks', 'area' => '19 m²', 'property' => 'Semi-detached', 'price' => '£25,500',
        'body' => 'The customer wanted the cheapest honest option, so we talked them out of a dormer. Two Velux windows and a proper staircase did the job.'
    ]
];

$filterTypes = ['All', 'Velux', 'Rear Dormer', 'Hip-to-Gable', 'Hip-End Dormer', 'Wrap Around', 'Roof-Lift'];

include 'includes/header.php';
?>

  <main>

    <!-- Creative Hero Section -->
    <section aria-labelledby="h1" class="border-bottom" style="background:#FAF9F5;position:relative;overflow:hidden">
      <div class="gallery-hero-grid">
        
        <!-- Left: Headline & Trust Intro -->
        <div style="display:flex;flex-direction:column;gap:18px">
          
          <!-- Embedded Breadcrumb & Badge -->
          <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
            <nav aria-label="Breadcrumb" class="breadcrumb-inline">
              <a href="index.php">Home</a>
              <span class="crumb-sep">/</span>
              <span class="crumb-current" aria-current="page">Gallery</span>
            </nav>
            <span style="color:#D4D4CC;font-size:12px">•</span>
            <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 11px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
              <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              Real Completed Projects
            </span>
          </div>

          <h1 id="h1" class="heading-h1" style="font-family:var(--font-serif);font-size:clamp(34px,4.8vw,58px);letter-spacing:-.025em;line-height:1.14;font-weight:400;margin:0;color:#1A1A1A">
            Real North West loft conversions, photographed on handover day.
          </h1>
          
          <p class="lead-text" style="font-family:var(--font-sans);font-size:clamp(16px,1.8vw,17.5px);color:#4A4A45;line-height:1.7;margin:0;max-width:52ch">
            Every project below was surveyed, engineered, and completed by our permanent in-house craftsmen across Lancashire, Greater Manchester, and Cheshire. Explore real floorplans, timescales, and architectural details.
          </p>

          <div class="hero-actions-row" style="margin-top:4px">
            <a href="#booking" data-open-booking class="btn-primary hero-btn">
              <span>Book Free Survey</span>
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
            </a>
            <a href="#projects" class="btn-secondary hero-btn">Explore Projects Below</a>
          </div>

          <!-- Trust Pill Row -->
          <div style="display:flex;flex-wrap:wrap;gap:14px;margin-top:6px;padding-top:16px;border-top:1px solid #EAEAE4;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
            <span style="display:inline-flex;align-items:center;gap:6px">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              Building Control Signed Off
            </span>
            <span style="display:inline-flex;align-items:center;gap:6px">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              10-Year Written Guarantee
            </span>
            <span style="display:inline-flex;align-items:center;gap:6px">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              £0 Upfront Deposit
            </span>
          </div>
        </div>

        <!-- Right: 2x2 Architectural Metrics Dashboard -->
        <div class="gallery-metrics-grid">
          
          <div class="gallery-metric-card">
            <span style="font-family:var(--font-serif);font-size:clamp(28px,3.2vw,40px);font-weight:400;color:#1A1A1A;line-height:1">400+</span>
            <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;color:#4F6B42;letter-spacing:.04em;text-transform:uppercase">Lofts Completed</span>
            <span style="font-family:var(--font-sans);font-size:12px;color:#70706A;margin-top:2px">Across North West</span>
          </div>

          <div class="gallery-metric-card">
            <span style="font-family:var(--font-serif);font-size:clamp(28px,3.2vw,40px);font-weight:400;color:#1A1A1A;line-height:1">41</span>
            <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;color:#4F6B42;letter-spacing:.04em;text-transform:uppercase">Towns Covered</span>
            <span style="font-family:var(--font-sans);font-size:12px;color:#70706A;margin-top:2px">Lancs, Gtr MCR &amp; Chesh</span>
          </div>

          <div class="gallery-metric-card">
            <span style="font-family:var(--font-serif);font-size:clamp(28px,3.2vw,40px);font-weight:400;color:#1A1A1A;line-height:1">3–6</span>
            <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;color:#4F6B42;letter-spacing:.04em;text-transform:uppercase">Weeks on Site</span>
            <span style="font-family:var(--font-sans);font-size:12px;color:#70706A;margin-top:2px">Dedicated single crew</span>
          </div>

          <div class="gallery-metric-card">
            <span style="font-family:var(--font-serif);font-size:clamp(28px,3.2vw,40px);font-weight:400;color:#1A1A1A;line-height:1">9.8<span style="font-size:16px;color:#70706A">/10</span></span>
            <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;color:#4F6B42;letter-spacing:.04em;text-transform:uppercase">Checkatrade Score</span>
            <span style="font-family:var(--font-sans);font-size:12px;color:#70706A;margin-top:2px">400+ verified reviews</span>
          </div>

        </div>

      </div>
    </section>

    <!-- Sticky Filter Buttons Bar -->
    <section id="projects" aria-label="Filter projects" class="gallery-filter-sticky">
      <div class="gallery-filter-wrap">
        <div class="gallery-filter-scroll">
          <?php foreach ($filterTypes as $ft): 
            $count = ($ft === 'All') ? count($galleryProjects) : count(array_filter($galleryProjects, fn($p) => $p['type'] === $ft));
            $isActive = ($ft === 'All');
          ?>
            <button type="button" class="gallery-filter-btn <?php echo $isActive ? 'active' : ''; ?>" data-filter="<?php echo $ft; ?>" aria-pressed="<?php echo $isActive ? 'true' : 'false'; ?>">
              <span><?php echo $ft; ?></span>
              <span class="filter-count-badge" style="font-size:11px;padding:1px 6px;border-radius:10px;background:<?php echo $isActive ? 'rgba(255,255,255,0.22)' : 'rgba(0,0,0,0.06)'; ?>"><?php echo $count; ?></span>
            </button>
          <?php endforeach; ?>
        </div>
        <div class="gallery-count-row">
          <span class="gallery-count-label" style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#6B8E5A">
            Showing 12 projects
          </span>
        </div>
      </div>
    </section>

    <!-- Gallery Projects Grid (12 Architectural Cards) -->
    <section aria-label="Projects" class="section-padding bg-white border-bottom">
      <div class="container gallery-projects-grid">
        <?php foreach ($galleryProjects as $idx => $p): 
          $projectImgNum = sprintf("%02d", ($idx % 23) + 1);
          $realImgPath = "images/another-area-loft-conversions-north-west-england-{$projectImgNum}.jpeg";
        ?>
          <article class="gallery-card" data-type="<?php echo $p['type']; ?>" data-index="<?php echo $idx; ?>">
            
            <!-- Top Image & Overlay Tags -->
            <div>
              <div class="real-img-box" style="position:relative;overflow:hidden;aspect-ratio:16/10">
                <img src="<?php echo $realImgPath; ?>" alt="<?php echo htmlspecialchars($p['title']); ?>" class="real-img" loading="lazy">
                <span style="position:absolute;top:10px;left:10px;background:rgba(26,36,24,0.88);color:#FFFFFF;backdrop-filter:blur(4px);padding:3px 10px;border-radius:12px;font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.04em;text-transform:uppercase">
                  <?php echo $p['type']; ?>
                </span>
                <span style="position:absolute;top:10px;right:10px;background:rgba(255,255,255,0.92);color:#2A2A28;backdrop-filter:blur(4px);padding:3px 10px;border-radius:12px;font-family:var(--font-sans);font-size:11px;font-weight:600">
                  📍 <?php echo $p['town']; ?>
                </span>
              </div>

              <!-- Card Body Content -->
              <div style="padding:20px 20px 0">
                <h2 style="font-family:var(--font-serif);font-size:20px;line-height:1.25;margin:0 0 10px;color:#1A1A1A;font-weight:400">
                  <?php echo $p['title']; ?>
                </h2>
                <p style="font-family:var(--font-sans);font-size:14px;color:#555550;line-height:1.6;margin:0 0 16px">
                  <?php echo $p['body']; ?>
                </p>

                <!-- Project Spec Chips -->
                <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:16px">
                  <span style="font-family:var(--font-sans);font-size:11.5px;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 9px;border-radius:6px;font-weight:600">
                    ⏱ <?php echo $p['weeks']; ?>
                  </span>
                  <span style="font-family:var(--font-sans);font-size:11.5px;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 9px;border-radius:6px;font-weight:600">
                    📐 <?php echo $p['area']; ?>
                  </span>
                  <span style="font-family:var(--font-sans);font-size:11.5px;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 9px;border-radius:6px;font-weight:600">
                    🏡 <?php echo $p['property']; ?>
                  </span>
                  <span style="font-family:var(--font-sans);font-size:11.5px;color:#2D3B28;background:#EAF3E6;border:1px solid #CDE2C6;padding:3px 9px;border-radius:6px;font-weight:700">
                    💰 <?php echo $p['price']; ?>
                  </span>
                </div>
              </div>
            </div>

            <!-- Card Bottom Guarantee Strip -->
            <div style="padding:0 20px 18px">
              <div style="background:#FAF9F5;border:1px solid #EBEBE6;border-radius:8px;padding:8px 12px;display:flex;align-items:center;justify-content:space-between;font-family:var(--font-sans);font-size:11.5px;font-weight:700;color:#3E5C32">
                <span>✓ 10-Yr Guarantee</span>
                <span style="color:#6B8E5A">•</span>
                <span>Building Regs Signed Off</span>
              </div>
            </div>

          </article>
        <?php endforeach; ?>
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

    <!-- 41 Service Areas -->
    <?php include 'includes/service-areas.php'; ?>

    <!-- Property CTA Banner (Standard Site-Wide CTA) -->
    <section id="booking" data-reveal aria-labelledby="cta-h" class="section-padding bg-primary cta-banner-section">
      <div class="container cta-banner-grid">
        <div class="cta-banner-content">
          <span class="section-label-subtle">One free visit</span>
          <h2 id="cta-h" class="heading-h1" style="font-size:clamp(34px,5vw,60px);color:#FFFFFF;margin-top:14px">Meet the surveyor before you decide anything.</h2>
          <p style="font-size:18px;line-height:1.6;margin:20px 0 30px;color:#EDF2E9;max-width:42ch">Forty-five minutes, a CAD drawing you keep, one fixed price. Say no afterwards and it has cost you nothing.</p>
          <div class="cta-btn-group">
            <a href="#booking" data-open-booking class="btn-dark">Book Free Survey</a>
            <a href="tel:08000862744" class="btn-outline-white">
              <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              Call 0800 0862744
            </a>
          </div>
        </div>
        <div class="cta-what-next-card" style="background:#FFFFFF;color:#1A1A1A;border-radius:4px;padding:clamp(22px,3vw,34px)">
          <span class="section-label">What happens next</span>
          <ol style="list-style:none;margin:18px 0 0;padding:0;display:grid;gap:0">
            <li style="display:flex;gap:14px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #EDEDE8">
              <span style="font-family:var(--font-sans);font-size:13px;color:#4F6B42;flex:0 0 26px;padding-top:2px;font-weight:700">01</span>
              <span style="display:flex;flex-direction:column;gap:4px">
                <span style="font-size:16px;font-weight:600;line-height:1.3">The survey</span>
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Measurements, ridge height, staircase options, your questions.</span>
              </span>
              <span style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#8A8A82;margin-left:auto;white-space:nowrap;padding-top:2px">45 min</span>
            </li>
            <li style="display:flex;gap:14px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #EDEDE8">
              <span style="font-family:var(--font-sans);font-size:13px;color:#4F6B42;flex:0 0 26px;padding-top:2px;font-weight:700">02</span>
              <span style="display:flex;flex-direction:column;gap:4px">
                <span style="font-size:16px;font-weight:600;line-height:1.3">CAD design + fixed quote</span>
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">A drawing of the finished layout and one written price.</span>
              </span>
              <span style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#8A8A82;margin-left:auto;white-space:nowrap;padding-top:2px">A few days</span>
            </li>
            <li style="display:flex;gap:14px;align-items:flex-start;padding:16px 0">
              <span style="font-family:var(--font-sans);font-size:13px;color:#4F6B42;flex:0 0 26px;padding-top:2px;font-weight:700">03</span>
              <span style="display:flex;flex-direction:column;gap:4px">
                <span style="font-size:16px;font-weight:600;line-height:1.3">You decide</span>
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Amend it, sit on it, or book a start date. No chasing from us.</span>
              </span>
              <span style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#8A8A82;margin-left:auto;white-space:nowrap;padding-top:2px">Your call</span>
            </li>
          </ol>
          <p style="margin:20px 0 0;font-size:13px;line-height:1.6;color:#6B6B6B">No deposit, no obligation, and the drawings stay yours whatever you decide.</p>
        </div>
      </div>
    </section>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const filterBtns = document.querySelectorAll('.gallery-filter-btn');
      const cards = document.querySelectorAll('.gallery-card');
      const countLabel = document.querySelector('.gallery-count-label');

      filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          filterBtns.forEach(b => {
            b.classList.remove('active');
            b.setAttribute('aria-pressed', 'false');
            const span = b.querySelector('.filter-count-badge');
            if (span) {
              span.style.background = 'rgba(0,0,0,0.06)';
            }
          });
          btn.classList.add('active');
          btn.setAttribute('aria-pressed', 'true');
          const activeSpan = btn.querySelector('.filter-count-badge');
          if (activeSpan) {
            activeSpan.style.background = 'rgba(255,255,255,0.22)';
          }

          const f = btn.getAttribute('data-filter');
          let visibleCount = 0;

          cards.forEach(card => {
            const cardType = card.getAttribute('data-type');
            if (f === 'All' || cardType === f) {
              card.style.display = 'flex';
              visibleCount++;
            } else {
              card.style.display = 'none';
            }
          });

          if (countLabel) {
            countLabel.textContent = 'Showing ' + visibleCount + (visibleCount === 1 ? ' project' : ' projects');
          }
        });
      });
    });
  </script>

  <?php include 'includes/booking-modal.php'; ?>
  <?php include 'includes/footer.php'; ?>
