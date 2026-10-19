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
        'weeks' => '8 weeks', 'area' => '31 m²', 'property' => 'Semi-detached', 'price' => '£50,000',
        'body' => 'A full-width rear dormer under permitted development. The old hatch became a dog-leg staircase off the landing, which kept both existing bedrooms full size.'
    ],
    [
        'type' => 'Rear Dormer', 'town' => 'Chorlton', 'title' => 'Rear dormer home office with rooftop terrace.',
        'weeks' => '6–8 weeks', 'area' => '22 m²', 'property' => 'Terrace', 'price' => '£48,000',
        'body' => 'Bespoke slate-clad rear dormer creating a bright home office with generous standing headroom and external walk-out access.'
    ],
    [
        'type' => 'Velux', 'town' => 'Stockport', 'title' => 'Light-filled guest bedroom and landing.',
        'weeks' => '4–5 weeks', 'area' => '24 m²', 'property' => 'Detached', 'price' => '£30,000+',
        'body' => 'Velux rooflight conversion creating a bright guest room and staircase landing under the original roofline, keeping the exterior character intact.'
    ],
    [
        'type' => 'Hip to Gable Rear Dormer', 'town' => 'Sale', 'title' => 'Full-width hip-to-gable rear dormer master suite.',
        'weeks' => '8–10 weeks', 'area' => '44 m²', 'property' => 'Semi-detached', 'price' => '£55,000',
        'body' => 'Tile-hung hip-to-gable combined with a full-width rear dormer, maximizing standing headroom and floor area across the full footprint of the house.'
    ],
    [
        'type' => 'Hip-End Dormer', 'town' => 'Preston', 'title' => 'Twin rooms for two growing children.',
        'weeks' => '4 weeks', 'area' => '29 m²', 'property' => 'Semi-detached', 'price' => '£39,500',
        'body' => 'Hip-end dormer with partition wall creating two identical rooms. Building control signed off the fire door and mains-linked alarms on the first visit.'
    ],
    [
        'type' => 'Hip-End Dormer', 'town' => 'Didsbury', 'title' => 'Ridge extended in hanging tiles to match.',
        'weeks' => '6–8 weeks', 'area' => '24 m²', 'property' => 'Semi-detached', 'price' => '£40,000',
        'body' => 'A conservation-sensitive street, so the dormer was clad in hanging tiles taken from the same range as the roof. From the pavement you have to look twice.'
    ],
    [
        'type' => 'Rear Dormer', 'town' => 'Bury', 'title' => 'Spacious rear dormer master bedroom with ensuite.',
        'weeks' => '8.5 weeks', 'area' => '32 m²', 'property' => 'Semi-detached', 'price' => '£39,000',
        'body' => 'Full-width rear dormer creating a spacious master suite with ensuite bathroom, built-in storage and maximum natural light.'
    ],
    [
        'type' => 'Velux', 'town' => 'Warrington', 'title' => 'Quiet study over a terraced kitchen.',
        'weeks' => '3–4 weeks', 'area' => '16 m²', 'property' => 'Terrace', 'price' => '£30,000+',
        'body' => 'The tightest plan we have done this year. A space-saver staircase, built-in desk run under the slope, and storage in the eaves on both sides.'
    ],
    [
        'type' => 'Front Dormer', 'town' => 'Lytham', 'title' => 'Front-facing dormer bedroom and ensuite.',
        'weeks' => '6–8 weeks', 'area' => '30 m²', 'property' => 'Detached', 'price' => '£45,000',
        'body' => 'Front-facing dormer bedroom designed to blend with the original elevation, adding substantial standing headroom and natural light.'
    ],
    [
        'type' => 'Hip-End Dormer', 'town' => 'Manchester', 'title' => 'Rental conversion turned into two lettable rooms.',
        'weeks' => '6–8 weeks', 'area' => '33 m²', 'property' => 'Semi-detached', 'price' => '£45,000',
        'body' => 'Hip-end dormer built to HMO standards with two rooms, shower room, and full fire-separation sign-off.'
    ],
    [
        'type' => 'Staircase', 'town' => 'Chorley', 'title' => 'Custom architectural staircase & spindle balustrade.',
        'weeks' => '2–3 weeks', 'area' => 'Bespoke joinery', 'property' => 'Semi-detached', 'price' => 'Included in build',
        'body' => 'Bespoke timber staircase custom-manufactured to match the existing ground-floor woodwork, balustrades, and newel posts for a seamless transition.'
    ],
    [
        'type' => 'Rear Dormer', 'town' => 'Southport', 'title' => 'Full-width rear dormer with triple sash windows.',
        'weeks' => '6–8 weeks', 'area' => '30 m²', 'property' => 'Semi-detached', 'price' => '£50,000+',
        'body' => 'Slate-hung rear dormer featuring three large sash windows, creating an expansive master bedroom with full standing height throughout.'
    ]
];

$filterTypes = ['All', 'Velux', 'Rear Dormer', 'Front Dormer', 'Hip-End Dormer', 'Hip to Gable Rear Dormer', 'Staircase'];

include 'includes/header.php';
?>

  <main>

    <!-- Minimalist Gallery Header -->
    <section aria-labelledby="h1" class="border-bottom" style="background:#FAF9F5">
      <div style="max-width:1280px;margin:0 auto;padding:clamp(26px,3.2vw,42px) 20px clamp(18px,2.2vw,26px)">
        <nav aria-label="Breadcrumb" class="breadcrumb-inline" style="margin-bottom:10px">
          <a href="index.php">Home</a>
          <span class="crumb-sep">/</span>
          <span class="crumb-current" aria-current="page">Gallery</span>
        </nav>
        <h1 id="h1" class="heading-h1" style="font-family:var(--font-serif);font-size:clamp(28px,3.4vw,42px);letter-spacing:-.02em;line-height:1.2;font-weight:400;margin:0 0 8px 0;color:#1A1A1A">
          Real North West loft conversions, photographed on handover day.
        </h1>
        <p style="font-family:var(--font-sans);font-size:15px;color:#5A5A55;line-height:1.55;margin:0;max-width:62ch">
          Explore real completed floorplans, timescales, and handover photography across Greater Manchester, Lancashire, and Cheshire.
        </p>
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



    <!-- 41 Service Areas -->
    <?php include 'includes/service-areas.php'; ?>

    <!-- Property CTA Banner (Standard Site-Wide CTA) -->
    <section id="booking" data-reveal aria-labelledby="cta-h" class="section-padding bg-primary cta-banner-section">
      <div class="container cta-banner-grid">
        <div class="cta-banner-content">
          <span class="section-label-subtle">One free visit</span>
          <h2 id="cta-h" class="heading-h1" style="font-size:clamp(34px,5vw,60px);color:#FFFFFF;margin-top:14px">Meet the surveyor before you decide anything.</h2>
          <p style="font-size:18px;line-height:1.6;margin:20px 0 30px;color:#EDF2E9;max-width:42ch">Forty-five minutes, expert layout advice, one fixed price. Say no afterwards and it has cost you nothing.</p>
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
                <span style="font-size:16px;font-weight:600;line-height:1.3">Survey &amp; fixed quote</span>
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">A detailed written proposal with one guaranteed fixed price.</span>
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
          <p style="margin:20px 0 0;font-size:13px;line-height:1.6;color:#6B6B6B">No obligation, and your fixed-price quote stands whatever you decide.</p>
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
