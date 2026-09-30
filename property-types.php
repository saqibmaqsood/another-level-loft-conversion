<?php
$pageTitle = "Loft Conversions by Property Type — Another Level";
$pageDesc = "Loft conversions by property type: terrace 40m³, semi-detached and detached 50m³, bungalow roof-lifts. What each house can take, timeline and permitted development limits.";
$activePage = "property";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "ItemList",
    "name" => "Loft conversions by property type",
    "itemListElement" => [
        ["@type" => "ListItem", "position" => 1, "name" => "Terraced house loft conversion", "url" => "/terrace-property.php"],
        ["@type" => "ListItem", "position" => 2, "name" => "Semi-detached loft conversion", "url" => "/semi-detached-property.php"],
        ["@type" => "ListItem", "position" => 3, "name" => "Detached house loft conversion", "url" => "/detached-property.php"],
        ["@type" => "ListItem", "position" => 4, "name" => "Bungalow loft conversion", "url" => "/bungalow-property.php"]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$propertyRows = [
    [
        'name' => 'Terrace', 'volume' => '40m³', 'party' => 'Both sides', 'route' => 'Rear dormer',
        'price' => '4 weeks', 'ruledOut' => 'Wrap around, hip-to-gable (mid-terrace)', 'href' => 'terrace-property.php'
    ],
    [
        'name' => 'Semi-detached', 'volume' => '50m³', 'party' => 'One side', 'route' => 'Hip-to-gable',
        'price' => '3.5 weeks', 'ruledOut' => 'Nothing, if the volume allows', 'href' => 'semi-detached-property.php'
    ],
    [
        'name' => 'Detached', 'volume' => '50m³', 'party' => 'None', 'route' => 'Hip-to-gable',
        'price' => '3.5 weeks', 'ruledOut' => 'Both hips plus a dormer — over 50m³', 'href' => 'detached-property.php'
    ],
    [
        'name' => 'Bungalow', 'volume' => 'On survey', 'party' => 'Usually none', 'route' => 'Roof-lift',
        'price' => '6–8 weeks', 'ruledOut' => 'Anything, if the pitch is too shallow', 'href' => 'bungalow-property.php'
    ]
];

$detailedProperties = [
    [
        'num' => '01', 'name' => 'Terrace', 'volume' => '40m³', 'href' => 'terrace-property.php',
        'meta' => '4 weeks · 28–32 m² typical',
        'glyph' => 'M4 30V14l10-8 10 8v16M24 30V14l10-8 10 8v16M14 30v-8h10v8',
        'body' => 'A terrace has the smallest volume allowance of any property type, no hip to square off, and neighbours on both sides. That narrows the design to the rear slope — but within 40m³ a full-width rear dormer still delivers two rooms at full standing height.',
        'options' => [
            ['name' => 'Rear Dormer', 'price' => 'from £38,000', 'href' => 'rear-dormer-conversion.php'],
            ['name' => 'Velux', 'price' => 'from £24,000', 'href' => 'velux-conversion.php'],
            ['name' => 'Hip-to-Gable', 'price' => 'from £37,000', 'href' => 'hip-to-gable-conversion.php']
        ],
        'points' => [
            'Party wall notices to both neighbours, served two months before work starts',
            'Materials come in over the roof by scaffold and rear hoist, not through the house',
            'End-terraces often have a hipped end, which puts hip-to-gable back on the table'
        ]
    ],
    [
        'num' => '02', 'name' => 'Semi-detached', 'volume' => '50m³', 'href' => 'semi-detached-property.php',
        'meta' => '3.5 weeks · 25–44 m² typical',
        'glyph' => 'M8 30V13l12-9 12 9v17M20 30V13M14 30v-7h12v7',
        'body' => 'The most converted house in the North West and the most flexible. A 50m³ allowance and a hipped side roof mean every conversion type is on the table — from a three-week rooflight room to a wrap around with two bedrooms and a bathroom.',
        'options' => [
            ['name' => 'Hip-to-Gable', 'price' => 'from £37,000', 'href' => 'hip-to-gable-conversion.php'],
            ['name' => 'Rear Dormer', 'price' => 'from £38,000', 'href' => 'rear-dormer-conversion.php'],
            ['name' => 'Wrap Around', 'price' => 'from £48,000', 'href' => 'wrap-around-conversion.php'],
            ['name' => 'Velux', 'price' => 'from £24,000', 'href' => 'velux-conversion.php']
        ],
        'points' => [
            'One party wall rather than two, which makes the paperwork simpler than a terrace',
            'A full gable on a matched pair is a design question — hip-end dormer is the gentler option',
            'A wrap around uses most of the 50m³, so planning becomes more likely'
        ]
    ],
    [
        'num' => '03', 'name' => 'Detached', 'volume' => '50m³', 'href' => 'detached-property.php',
        'meta' => '3.5 weeks · 25–46 m² typical',
        'glyph' => 'M8 30V14l16-10 16 10v16zM19 30v-8h10v8',
        'body' => 'Hips on both sides, a 50m³ allowance and no party wall to negotiate. Detached houses give the most design freedom of any property type — and the fewest reasons for a conversion to end up compromised.',
        'options' => [
            ['name' => 'Hip-to-Gable', 'price' => 'from £37,000', 'href' => 'hip-to-gable-conversion.php'],
            ['name' => 'Rear Dormer', 'price' => 'from £38,000', 'href' => 'rear-dormer-conversion.php'],
            ['name' => 'Wrap Around', 'price' => 'from £48,000', 'href' => 'wrap-around-conversion.php'],
            ['name' => 'Hip-End Dormer', 'price' => 'from £37,000', 'href' => 'hip-end-dormer-conversion.php']
        ],
        'points' => [
            'No party wall notices, so no two-month waiting period before work starts',
            'Squaring off both hips plus a dormer exceeds 50m³ — that becomes a planning application',
            'More staircase routes available, which usually means a better-proportioned landing'
        ]
    ],
    [
        'num' => '04', 'name' => 'Bungalow', 'volume' => 'On survey', 'href' => 'bungalow-property.php',
        'meta' => '6–8 weeks · full floor',
        'glyph' => 'M4 30V18l20-12 20 12v12zM18 30v-7h12v7',
        'body' => 'A bungalow roof is usually shallow, so headroom decides everything. Where there is height a dormer works. Where there is not, the roof comes off and goes back higher — which turns a bungalow into a house, and needs planning permission to do it.',
        'options' => [
            ['name' => 'Roof-Lift', 'price' => 'on survey', 'href' => 'roof-lift-conversion.php'],
            ['name' => 'Rear Dormer', 'price' => 'from £38,000', 'href' => 'rear-dormer-conversion.php'],
            ['name' => 'Velux', 'price' => 'from £24,000', 'href' => 'velux-conversion.php']
        ],
        'points' => [
            'Chalet bungalows often already have the 2.2m needed, so price a dormer first',
            'No existing stairwell, so the new flight has to come out of a hallway or bedroom',
            'We price a ground-floor extension against going up when that is the better answer'
        ]
    ]
];

$faqs = [
    ['q' => 'How does my property type affect permitted development volume?', 'a' => 'Permitted development rules grant 40m³ of additional roof volume for terraced houses and 50m³ for semi-detached and detached homes. This allowance includes all historical roof enlargements, which our surveyor calculates accurately during your free CAD survey.'],
    ['q' => 'What if my semi-detached house has a hipped roof?', 'a' => 'A hipped side roof is ideal for a hip-to-gable conversion. It converts the sloping side into a straight vertical gable, providing the headroom required for a standard staircase and landing without losing habitable floor space below.'],
    ['q' => 'Do I need party wall agreements for a terraced or semi-detached conversion?', 'a' => 'Yes. On terraced houses, notices must be served to neighbours on both sides. On semi-detached properties, only the adjoining neighbour needs notice. We prepare the complete structural notices alongside your CAD drawings at least two months in advance.'],
    ['q' => 'Can a bungalow take a conversion without lifting the roof?', 'a' => 'If the existing ridge height exceeds 2.2m (common in chalet bungalows), a rear dormer or Velux conversion is often possible without raising the roof. For shallow-pitch bungalows, a roof-lift provides a full second floor with 2 to 3 bedrooms and a bathroom.']
];

include 'includes/header.php';
?>

  <main>

    <!-- Hero Section with Quick Booking Widget -->
    <section aria-labelledby="h1" class="border-bottom">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));max-width:1280px;margin:0 auto;align-items:stretch">
        <div style="padding:clamp(26px,3.6vw,52px) 20px clamp(30px,3.6vw,52px);display:flex;flex-direction:column;justify-content:center;gap:18px">
          
          <!-- Embedded Breadcrumb & Badge -->
          <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
            <nav aria-label="Breadcrumb" class="breadcrumb-inline">
              <a href="index.php">Home</a>
              <span class="crumb-sep">/</span>
              <span class="crumb-current" aria-current="page">Property Types</span>
            </nav>
            <span style="color:#D4D4CC;font-size:12px">•</span>
            <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
              <span style="width:5px;height:5px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              All 4 Property Types
            </span>
          </div>

          <h1 id="h1" class="heading-h1" style="font-size:clamp(34px,5.4vw,56px);letter-spacing:-.025em;margin:0">Loft Conversions by Property Type</h1>
          <p style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(20px,2.4vw,25px);line-height:1.25;color:#4F6B42;margin:-4px 0 2px;letter-spacing:-.015em">Your house decides what is possible.</p>
          <p class="lead-text" style="max-width:46ch">Permitted development gives a terrace 40m³ of added roof volume and a semi or detached 50m³. Whether your roof has a hip decides which types are available, and party walls decide the paperwork. Start from the house and the shortlist writes itself.</p>
          
          <!-- Key Stats / Numbers Grid on Left -->
          <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1px;background:#E4E4DF;border:1px solid #E4E4DF;max-width:440px;border-radius:3px;overflow:hidden">
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">40m³</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Terrace allowance</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">50m³</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Semi &amp; detached</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">2.2m</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Min headroom</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">2 Months</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Party wall notice</span>
            </div>
          </div>

          <div class="hero-actions-row" style="margin-top:4px">
            <a href="tel:08000862744" class="btn-primary hero-btn">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16.9v2.6a1.7 1.7 0 0 1-1.9 1.7 16.6 16.6 0 0 1-7.2-2.6 16.3 16.3 0 0 1-5-5A16.6 16.6 0 0 1 4.3 6.4 1.7 1.7 0 0 1 6 4.5h2.6a1.7 1.7 0 0 1 1.7 1.5c.1.9.3 1.7.6 2.5a1.7 1.7 0 0 1-.4 1.8l-1.1 1.1a13.4 13.4 0 0 0 5 5l1.1-1.1a1.7 1.7 0 0 1 1.8-.4c.8.3 1.6.5 2.5.6a1.7 1.7 0 0 1 1.5 1.7z"></path></svg>
              <span>0800 0862744</span>
            </a>
            <a href="#booking" data-open-booking class="btn-secondary hero-btn">
              <span>Book free survey</span>
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#6B8E5A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"></path></svg>
            </a>
          </div>
          <div style="display:flex;flex-wrap:wrap;gap:6px 14px;font-family:var(--font-sans);font-size:12.5px;font-weight:500;color:#6B6B6B">
            <span>No obligation</span><span>&middot;</span><span>Free CAD design</span><span>&middot;</span><span>400+ finished projects</span>
          </div>
        </div>

        <!-- Inline Step 1 Widget -->
        <div style="background:#FFFFFF;border-left:1px solid #EDEDE8;display:flex;flex-direction:column">
          <div style="flex:1 1 auto;display:flex;flex-direction:column;background:#FFFFFF">
            <div style="padding:26px 26px 20px;border-bottom:1px solid #EDEDE8">
              <div style="display:flex;align-items:baseline;justify-content:space-between;gap:12px;margin-bottom:8px">
                <span class="section-label">Free survey booking</span>
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#6B6B6B;white-space:nowrap">Step 1 / 3</span>
              </div>
              <h2 style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(22px,2.3vw,28px);line-height:1.14;letter-spacing:-.01em;margin:0">Book your free survey</h2>
            </div>
            <div style="height:3px;background:#EDEDE8"><div style="height:3px;background:#6B8E5A;width:33%"></div></div>
            <div style="flex:1 1 auto;padding:26px;display:flex;flex-direction:column">
              <p style="font-size:15px;line-height:1.6;color:#6B6B6B;margin:0 0 18px">What kind of property is it? This tells us which conversion types are possible before we visit.</p>
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:18px">
                <button type="button" class="property-opt-btn" data-property="Terrace">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M4 30V14l10-8 10 8v16M24 30V14l10-8 10 8v16M14 30v-8h10v8"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Terrace</div>
                  <div style="font-family:var(--font-sans);font-size:11px;font-weight:600;color:#6B6B6B;margin-top:3px">40m³ limit</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Semi-detached">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V13l12-9 12 9v17M20 30V13M14 30v-7h12v7"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Semi-detached</div>
                  <div style="font-family:var(--font-sans);font-size:11px;font-weight:600;color:#6B6B6B;margin-top:3px">Most common</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Detached">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V14l16-10 16 10v16zM19 30v-8h10v8"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Detached</div>
                  <div style="font-family:var(--font-sans);font-size:11px;font-weight:600;color:#6B6B6B;margin-top:3px">50m³ limit</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Bungalow">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M4 30V18l20-12 20 12v12zM18 30v-7h12v7"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Bungalow</div>
                  <div style="font-family:var(--font-sans);font-size:11px;font-weight:600;color:#6B6B6B;margin-top:3px">Roof-lift option</div>
                </button>
              </div>
              <label style="display:block;margin-bottom:18px">
                <span style="display:block;font-size:13px;font-weight:600;letter-spacing:.02em;margin-bottom:8px">Postcode</span>
                <input type="text" id="heroPostcode" placeholder="e.g. PR2 1AU" autocomplete="postal-code" style="width:100%;padding:14px 16px;font-size:16px;border:1px solid #DCDCD6;border-radius:3px;background:#FAFAF8;color:#1A1A1A;box-sizing:border-box">
              </label>
              <button type="button" id="heroContinue" class="btn-primary" style="width:100%">Continue</button>
              <div id="heroError" style="font-size:13px;color:#B4423A;margin-top:10px;min-height:18px"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Side-by-Side Comparison Table Section -->
    <section id="compare" data-reveal aria-labelledby="cmp-h" class="section-padding-sm bg-gray border-bottom">
      <div class="container">
        <div style="display:flex;flex-wrap:wrap;gap:18px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:28px">
          <div style="flex:2 1 380px">
            <span class="section-label">At a glance</span>
            <h2 id="cmp-h" class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0">All four, side by side.</h2>
          </div>
          <div class="cmp-header-actions">
            <p style="flex:1 1 260px;max-width:34ch;font-size:15px;line-height:1.6;color:#6B6B6B;margin:0">Volume limits are set by permitted development. Starting prices and timelines are fixed after survey.</p>
            <div class="cmp-carousel-nav" aria-label="Carousel navigation">
              <button type="button" class="cmp-prev-btn" aria-label="Previous property type">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
              </button>
              <button type="button" class="cmp-next-btn" aria-label="Next property type">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Desktop Comparison Table (Visible >768px) -->
        <div class="cmp-table-desktop" style="background:#FFFFFF;border:1px solid #E4E4DF;border-radius:3px;overflow:hidden">
          <div style="display:grid;grid-template-columns:1.2fr .7fr .8fr 1.2fr .8fr 1.3fr;gap:16px;padding:14px 22px;background:#FAFAF8;border-bottom:1px solid #E4E4DF;font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">
            <span>Property</span>
            <span>PD volume</span>
            <span>Party walls</span>
            <span>Usual route</span>
            <span>Timeline</span>
            <span>Ruled out</span>
          </div>
          <?php foreach ($propertyRows as $idx => $r): ?>
            <a href="<?php echo $r['href']; ?>" style="display:grid;grid-template-columns:1.2fr .7fr .8fr 1.2fr .8fr 1.3fr;gap:16px;align-items:center;padding:18px 22px;text-decoration:none;color:#1A1A1A;transition:background .2s;<?php if ($idx < count($propertyRows) - 1) echo 'border-bottom:1px solid #EDEDE8;'; ?>" onmouseover="this.style.background='#F1F5EE'" onmouseout="this.style.background='#FFFFFF'">
              <span style="font-family:Newsreader,Georgia,serif;font-size:19px;line-height:1.2;color:#1A1A1A"><?php echo $r['name']; ?></span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:13px;color:#4F6B42;font-weight:500"><?php echo $r['volume']; ?></span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:13px;color:#6B6B6B"><?php echo $r['party']; ?></span>
              <span style="font-size:13px;line-height:1.5;color:#1A1A1A"><?php echo $r['route']; ?></span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:13px;color:#6B6B6B"><?php echo $r['price']; ?></span>
              <span style="font-size:13px;line-height:1.5;color:#A0662F"><?php echo $r['ruledOut']; ?></span>
            </a>
          <?php endforeach; ?>
        </div>

        <!-- Mobile Comparison Carousel (Visible <=768px) -->
        <div class="cmp-cards-mobile">
          <?php foreach ($propertyRows as $r): ?>
            <a href="<?php echo $r['href']; ?>" class="cmp-mobile-card">
              <div>
                <div class="cmp-card-header">
                  <h3 class="cmp-card-title"><?php echo $r['name']; ?></h3>
                  <span class="cmp-planning-badge badge-ok">
                    <?php echo $r['volume']; ?> PD limit
                  </span>
                </div>
                <div class="cmp-card-stats" style="margin-top:12px">
                  <div class="cmp-stat-box">
                    <span class="cmp-stat-label">Party Walls</span>
                    <span class="cmp-stat-val"><?php echo $r['party']; ?></span>
                  </div>
                  <div class="cmp-stat-box">
                    <span class="cmp-stat-label">Timeline</span>
                    <span class="cmp-stat-val text-accent"><?php echo $r['price']; ?></span>
                  </div>
                </div>
                <div class="cmp-card-suits" style="margin-top:12px">
                  <span class="cmp-suits-label">Usual Route:</span>
                  <span class="cmp-suits-text" style="color:#1A1A1A;font-weight:600"><?php echo $r['route']; ?></span>
                </div>
                <div class="cmp-card-suits" style="margin-top:6px">
                  <span class="cmp-suits-label" style="color:#A0662F">Ruled Out:</span>
                  <span class="cmp-suits-text" style="color:#7A5525"><?php echo $r['ruledOut']; ?></span>
                </div>
              </div>
              <div class="cmp-card-footer">
                <span>Explore <?php echo $r['name']; ?> conversions</span>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- In Detail Cards -->
    <section data-reveal aria-labelledby="detail-h" class="section-padding-sm bg-white">
      <div class="container">
        <div class="detail-header-row" style="margin-bottom:32px">
          <div>
            <span class="section-label">In detail</span>
            <h2 id="detail-h" class="heading-h2" style="font-size:clamp(26px,4vw,44px);margin:12px 0 0">What each house can take.</h2>
          </div>
          <div class="detail-carousel-nav" aria-label="Carousel navigation">
            <button type="button" class="detail-prev-btn" aria-label="Previous property detail">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button type="button" class="detail-next-btn" aria-label="Next property detail">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>
        </div>
        <div class="detail-types-grid">
          <?php foreach ($detailedProperties as $p): ?>
            <article class="detail-type-card">
              <div>
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px">
                  <div style="display:flex;gap:14px;align-items:flex-start">
                    <span style="flex:0 0 auto;width:54px;height:42px;display:flex;align-items:center;justify-content:center;background:#F5F5F3;border:1px solid #EDEDE8;border-radius:4px">
                      <svg viewBox="0 0 48 32" width="36" height="24" fill="none" stroke="#4F6B42" stroke-width="1.4" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo $p['glyph']; ?>"></path></svg>
                    </span>
                    <div style="min-width:0">
                      <h3 style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(21px,2.4vw,28px);line-height:1.15;letter-spacing:-.02em;margin:0;color:#1A1A1A"><?php echo $p['name']; ?></h3>
                      <div style="display:flex;flex-wrap:wrap;gap:4px 10px;margin-top:4px;font-family:var(--font-sans);font-size:12.5px;font-weight:600">
                        <span style="color:#4F6B42"><?php echo $p['volume']; ?> PD limit</span>
                        <span style="color:#B8BCB2">•</span>
                        <span style="color:#6B6B6B"><?php echo $p['meta']; ?></span>
                      </div>
                    </div>
                  </div>
                  <span class="detail-card-num"><?php echo $p['num']; ?></span>
                </div>
                <p style="font-size:15px;line-height:1.6;color:#4A4A45;margin:16px 0 0;max-width:62ch;text-wrap:pretty"><?php echo $p['body']; ?></p>
                <div style="border-top:1px solid #EDEDE8;padding-top:14px;margin-top:16px">
                  <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#6B6B6B;display:block;margin-bottom:10px">Conversion types available</span>
                  <div style="display:flex;flex-wrap:wrap;gap:8px">
                    <?php foreach ($p['options'] as $o): ?>
                      <a href="<?php echo $o['href']; ?>" style="display:flex;flex-direction:column;gap:2px;border:1px solid #DCDCD6;border-radius:4px;padding:8px 12px;font-size:13px;color:#1A1A1A;text-decoration:none;transition:border-color .2s,background .2s" onmouseover="this.style.borderColor='#6B8E5A';this.style.background='#F1F5EE';this.style.color='#4F6B42'" onmouseout="this.style.borderColor='#DCDCD6';this.style.background='transparent';this.style.color='#1A1A1A'">
                        <span style="font-weight:600"><?php echo $o['name']; ?></span>
                        <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:600;color:#6B6B6B"><?php echo $o['price']; ?></span>
                      </a>
                    <?php endforeach; ?>
                  </div>
                </div>
                <ul style="list-style:none;margin:16px 0 0;padding:0;display:grid;gap:9px;border-top:1px solid #EDEDE8;padding-top:14px">
                  <?php foreach ($p['points'] as $pt): ?>
                    <li style="display:flex;gap:10px;align-items:flex-start;font-size:13.5px;line-height:1.5;color:#1A1A1A">
                      <span style="width:6px;height:6px;flex:0 0 6px;margin-top:7px;border-radius:50%;background:#6B8E5A"></span>
                      <span><?php echo $pt; ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <a href="<?php echo $p['href']; ?>" class="detail-btn" style="border:1px solid #6B8E5A;color:#4F6B42;font-size:13.5px;font-weight:600;border-radius:4px;padding:11px 18px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:all .2s ease" onmouseover="this.style.background='#6B8E5A';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#4F6B42'">
                <span><?php echo $p['name']; ?> conversions in detail</span>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Universal Rules Section with dark-qa-card hover -->
    <section data-reveal aria-labelledby="pw-h" class="section-padding-sm bg-dark">
      <div class="container">
        <div class="qa-header-row" style="display:flex;flex-wrap:wrap;gap:18px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:34px">
          <div style="flex:2 1 400px">
            <span class="section-label-light">The rules that apply to every house</span>
            <h2 id="pw-h" class="heading-h2" style="color:#FFFFFF;max-width:24ch;margin:12px 0 0">Four things no property type escapes.</h2>
          </div>
          <div class="qa-header-actions" style="display:flex;align-items:center;gap:12px">
            <p style="flex:1 1 280px;max-width:34ch;font-size:15px;line-height:1.65;color:#B8B8B0;margin:0">All four are inside your fixed price. None of them is a surprise cost we add later.</p>
            <div class="qa-carousel-nav" aria-label="Carousel navigation">
              <button type="button" class="qa-prev-btn" aria-label="Previous rule">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
              </button>
              <button type="button" class="qa-next-btn" aria-label="Next rule">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="qa-cards-grid">
          <div class="dark-qa-card">
            <div>
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A">RULE 01</span>
                <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A"></span>
              </div>
              <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.2;color:#FFFFFF;font-weight:400;margin:0 0 10px">Building Control</h3>
              <p style="font-size:14.5px;line-height:1.6;color:#B8B8B0;margin:0">Inspections at the steels, insulation, fire stopping and completion. U-values of 0.15 to the roof and 0.18 to walls and floors.</p>
            </div>
            <div style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#A8B79E;padding-top:12px;border-top:1px solid #2E2E2A">Fees inside your fixed price</div>
          </div>
          <div class="dark-qa-card">
            <div>
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A">RULE 02</span>
                <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A"></span>
              </div>
              <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.2;color:#FFFFFF;font-weight:400;margin:0 0 10px">The protected stair</h3>
              <p style="font-size:14.5px;line-height:1.6;color:#B8B8B0;margin:0">A loft makes a two-storey house three storeys, so the stairwell becomes an escape route: fire doors, 30-minute protection, interlinked alarms.</p>
            </div>
            <div style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#A8B79E;padding-top:12px;border-top:1px solid #2E2E2A">Applies to every conversion</div>
          </div>
          <div class="dark-qa-card">
            <div>
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A">RULE 03</span>
                <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A"></span>
              </div>
              <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.2;color:#FFFFFF;font-weight:400;margin:0 0 10px">Staircase geometry</h3>
              <p style="font-size:14.5px;line-height:1.6;color:#B8B8B0;margin:0">Maximum 42° pitch, 1.9m headroom at the centre of the flight and 1.8m at the edges under a slope. Usually the tightest design constraint.</p>
            </div>
            <div style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#A8B79E;padding-top:12px;border-top:1px solid #2E2E2A">Shown on your CAD drawing</div>
          </div>
          <div class="dark-qa-card">
            <div>
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A">RULE 04</span>
                <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A"></span>
              </div>
              <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.2;color:#FFFFFF;font-weight:400;margin:0 0 10px">Escape window</h3>
              <p style="font-size:14.5px;line-height:1.6;color:#B8B8B0;margin:0">One window with a clear opening of at least 0.33m², no dimension under 450mm, and a sill no more than 1.1m above the floor.</p>
            </div>
            <div style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#A8B79E;padding-top:12px;border-top:1px solid #2E2E2A">Sized at the survey</div>
          </div>
        </div>
      </div>
    </section>

    <!-- By Conversion Types Overview Section -->
    <section data-reveal aria-labelledby="types-h" class="section-padding-sm bg-white">
      <div class="container">
        <div style="display:flex;flex-wrap:wrap;gap:18px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:34px">
          <div style="flex:2 1 400px">
            <span class="section-label">By conversion</span>
            <h2 id="types-h" class="heading-h2" style="max-width:24ch;margin:12px 0 0">Or start from the conversion type.</h2>
          </div>
          <div class="byconv-header-actions" style="display:flex;align-items:center;gap:12px">
            <a href="conversion-types.php" class="btn-secondary byconv-all-btn" style="padding:10px 18px;font-size:14px;font-weight:600;display:inline-flex;align-items:center;gap:6px">
              <span>All conversion types</span>
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <div class="byconv-carousel-nav" aria-label="Carousel navigation">
              <button type="button" class="byconv-prev-btn" aria-label="Previous conversion type">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
              </button>
              <button type="button" class="byconv-next-btn" aria-label="Next conversion type">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="byconv-types-grid">
          <a href="velux-conversion.php" class="byconv-type-card">
            <div>
              <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:6px">
                <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.15;margin:0;color:#1A1A1A;font-weight:400">Velux</h3>
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A;margin-top:2px">01</span>
              </div>
              <p style="font-size:14px;line-height:1.6;color:#6B6B6B;margin:0">Rooflights in the existing slope. Cheapest and quickest.</p>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:6px 12px;margin-top:auto;padding-top:12px;border-top:1px solid #EDEDE8;font-family:var(--font-sans);font-size:12.5px;font-weight:600">
              <span style="color:#4F6B42">£24,000</span><span style="color:#8A8A82">•</span><span style="color:#6B6B6B">3 wks</span>
            </div>
          </a>
          <a href="rear-dormer-conversion.php" class="byconv-type-card">
            <div>
              <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:6px">
                <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.15;margin:0;color:#1A1A1A;font-weight:400">Rear Dormer</h3>
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A;margin-top:2px">02</span>
              </div>
              <p style="font-size:14px;line-height:1.6;color:#6B6B6B;margin:0">Flat-roof box across the rear. Most floor area.</p>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:6px 12px;margin-top:auto;padding-top:12px;border-top:1px solid #EDEDE8;font-family:var(--font-sans);font-size:12.5px;font-weight:600">
              <span style="color:#4F6B42">£38,000</span><span style="color:#8A8A82">•</span><span style="color:#6B6B6B">4 wks</span>
            </div>
          </a>
          <a href="hip-to-gable-conversion.php" class="byconv-type-card">
            <div>
              <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:6px">
                <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.15;margin:0;color:#1A1A1A;font-weight:400">Hip-to-Gable</h3>
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A;margin-top:2px">03</span>
              </div>
              <p style="font-size:14px;line-height:1.6;color:#6B6B6B;margin:0">Sloping side built up into a vertical gable wall.</p>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:6px 12px;margin-top:auto;padding-top:12px;border-top:1px solid #EDEDE8;font-family:var(--font-sans);font-size:12.5px;font-weight:600">
              <span style="color:#4F6B42">£37,000</span><span style="color:#8A8A82">•</span><span style="color:#6B6B6B">3.5 wks</span>
            </div>
          </a>
          <a href="hip-end-dormer-conversion.php" class="byconv-type-card">
            <div>
              <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:6px">
                <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.15;margin:0;color:#1A1A1A;font-weight:400">Hip-End Dormer</h3>
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A;margin-top:2px">04</span>
              </div>
              <p style="font-size:14px;line-height:1.6;color:#6B6B6B;margin:0">Dormer into the hipped end. Keeps the roof shape.</p>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:6px 12px;margin-top:auto;padding-top:12px;border-top:1px solid #EDEDE8;font-family:var(--font-sans);font-size:12.5px;font-weight:600">
              <span style="color:#4F6B42">£37,000</span><span style="color:#8A8A82">•</span><span style="color:#6B6B6B">3.5 wks</span>
            </div>
          </a>
          <a href="wrap-around-conversion.php" class="byconv-type-card">
            <div>
              <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:6px">
                <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.15;margin:0;color:#1A1A1A;font-weight:400">Wrap Around</h3>
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A;margin-top:2px">05</span>
              </div>
              <p style="font-size:14px;line-height:1.6;color:#6B6B6B;margin:0">Gable plus dormer. The largest option available.</p>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:6px 12px;margin-top:auto;padding-top:12px;border-top:1px solid #EDEDE8;font-family:var(--font-sans);font-size:12.5px;font-weight:600">
              <span style="color:#4F6B42">£48,000</span><span style="color:#8A8A82">•</span><span style="color:#6B6B6B">6 wks</span>
            </div>
          </a>
          <a href="roof-lift-conversion.php" class="byconv-type-card">
            <div>
              <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:6px">
                <h3 style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1.15;margin:0;color:#1A1A1A;font-weight:400">Roof-Lift</h3>
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;color:#6B8E5A;margin-top:2px">06</span>
              </div>
              <p style="font-size:14px;line-height:1.6;color:#6B6B6B;margin:0">Roof off, back higher. For bungalows and low lofts.</p>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:6px 12px;margin-top:auto;padding-top:12px;border-top:1px solid #EDEDE8;font-family:var(--font-sans);font-size:12.5px;font-weight:600">
              <span style="color:#4F6B42">On survey</span><span style="color:#8A8A82">•</span><span style="color:#6B6B6B">6–8 wks</span>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section data-reveal aria-labelledby="faq-h" class="section-padding bg-gray border-top">
      <div class="container faq-layout">
        <div class="faq-sticky-col">
          <span class="section-label">Property questions</span>
          <h2 id="faq-h" class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 18px;max-width:16ch">Before you decide.</h2>
          <p style="font-size:16px;line-height:1.65;color:#4A4A45;margin:0 0 24px;max-width:38ch">Answers on permitted development volume, party walls, hips and bungalow roof-lifts. Anything else, ask the surveyor &mdash; the visit is free whether you go ahead or not.</p>
          <div class="hero-actions-row" style="margin-top:4px">
            <a href="#booking" data-open-booking class="btn-primary hero-btn">Book Free Survey</a>
            <a href="tel:08000862744" class="btn-secondary hero-btn">Ask us directly</a>
          </div>
        </div>
        <div class="faq-container-box">
          <?php foreach ($faqs as $idx => $f): 
            $num = str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
            $isOpen = ($idx === 0);
          ?>
            <div class="faq-wrap <?php if ($isOpen) echo 'open'; ?>">
              <button type="button" class="faq-btn" aria-expanded="<?php echo $isOpen ? 'true' : 'false'; ?>">
                <span class="faq-num"><?php echo $num; ?></span>
                <span class="faq-question"><?php echo $f['q']; ?></span>
                <span class="faq-sign"><?php echo $isOpen ? '–' : '+'; ?></span>
              </button>
              <div class="faq-answer">
                <p><?php echo $f['a']; ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- 41 Service Areas -->
    <?php include 'includes/service-areas.php'; ?>

    <!-- CTA Banner -->
    <section data-reveal aria-labelledby="cta-h" class="section-padding bg-primary cta-banner-section">
      <div class="container cta-banner-grid">
        <div class="cta-banner-content">
          <span class="section-label-subtle">One free visit</span>
          <h2 id="cta-h" class="heading-h1" style="font-size:clamp(34px,5vw,60px);color:#FFFFFF;margin-top:14px">Every house is different. <em style="font-style:italic">Yours</em> gets measured.</h2>
          <p style="font-size:18px;line-height:1.6;margin:20px 0 30px;color:#EDF2E9;max-width:42ch">Volume allowance, hips, ridge height and staircase route — all four checked in forty-five minutes. One fixed price after.</p>
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
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Volume allowance, hips, ridge height, staircase route.</span>
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
      let selectedProp = '';
      const propBtns = document.querySelectorAll('.property-opt-btn');
      const errBox = document.getElementById('heroError');
      const pcInput = document.getElementById('heroPostcode');
      const continueBtn = document.getElementById('heroContinue');

      propBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          propBtns.forEach(b => {
            b.classList.remove('active');
            b.removeAttribute('aria-pressed');
          });
          btn.classList.add('active');
          btn.setAttribute('aria-pressed', 'true');
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

  <?php include 'includes/booking-modal.php'; ?>
  <?php include 'includes/footer.php'; ?>
