<?php
$pageTitle = "Roof-Lift Loft Conversions — Bungalows & Low Lofts — Another Level";
$pageDesc = "Roof-lift loft conversions for bungalows and low lofts. The roof comes off and goes back higher, creating headroom where there was none. Priced case by case.";
$activePage = "types";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "Service",
    "serviceType" => "Roof-Lift loft conversion",
    "provider" => [
        "@type" => "LocalBusiness",
        "name" => "Another Level Loft Conversions",
        "telephone" => "0800 0862744"
    ],
    "offers" => [
        "@type" => "Offer",
        "priceCurrency" => "GBP",
        "priceSpecification" => "Quoted per project on survey"
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$facts = [
    ['value' => 'On survey', 'label' => 'Fixed price'],
    ['value' => '6–8 weeks', 'label' => 'On site'],
    ['value' => 'Under 2.2m', 'label' => 'Solves headroom of']
];

$galleryImages = [
    'images/another-area-loft-conversions-north-west-england-06.jpeg',
    'images/another-area-loft-conversions-north-west-england-07.jpeg',
    'images/another-area-loft-conversions-north-west-england-08.jpeg',
    'images/another-area-loft-conversions-north-west-england-09.jpeg',
    'images/another-area-loft-conversions-north-west-england-10.jpeg',
    'images/another-area-loft-conversions-north-west-england-11.jpeg',
    'images/another-area-loft-conversions-north-west-england-12.jpeg',
    'images/another-area-loft-conversions-north-west-england-13.jpeg',
];

$timeline = [
    ['when' => 'Weeks 1–2', 'what' => 'Scaffold and temporary roof up, existing roof stripped and removed.'],
    ['when' => 'Weeks 2–3', 'what' => 'New structure built to the agreed height, steels and floor joists in.'],
    ['when' => 'Week 4', 'what' => 'New roof covered and made watertight, windows fitted, temporary roof struck.'],
    ['when' => 'Weeks 5–6', 'what' => 'Insulation, stairwell, staircase, partitions and first-fix services.'],
    ['when' => 'Weeks 7–8', 'what' => 'Plastering, second-fix electrics, external finishes, sign-off and handover.']
];

$fit = [
    ['yes' => true, 'text' => 'You have under 2.2m of headroom and no ceilings below worth dropping.'],
    ['yes' => true, 'text' => 'You live in a bungalow, chalet or shallow-pitch house and want a full floor.'],
    ['yes' => true, 'text' => 'You are prepared for a planning application and a longer build.'],
    ['yes' => false, 'text' => 'You already have 2.2m or more — a Velux or dormer conversion is far cheaper.'],
    ['yes' => false, 'text' => 'You only need one room and the first floor has generous ceilings — price a ceiling drop first.'],
    ['yes' => false, 'text' => 'You need the work finished inside a month — a roof-lift cannot be rushed.']
];

$included = [
    'Structural design, calculations and engineer’s sign-off',
    'Temporary weatherproof scaffold roof for the whole open period',
    'Existing roof removed and materials set aside for reuse where possible',
    'New roof structure built to the agreed height and pitch',
    'Tiles or slate matched to the house, new eaves, verge and rainwater goods',
    'Bespoke staircase, landing and fire-rated doors to the protected stair',
    'Insulation, plasterboard, skim and full first-fix and second-fix electrics',
    'Planning drawings, Building Control fees and completion certificate'
];

$addOns = [
    ['name' => 'Planning application', 'price' => 'Included as standard', 'note' => 'A roof-lift needs one. Drawings, fees and submission are inside your fixed price.'],
    ['name' => 'Bathroom and en-suite', 'price' => '+ Quoted per spec', 'note' => 'A roof-lift usually creates a full floor, so most schemes include more than one wet room.'],
    ['name' => 'Dormers to the new roof', 'price' => '+ Quoted per spec', 'note' => 'Adds floor area at full height once the new pitch is set.'],
    ['name' => 'Ceiling drop instead', 'price' => 'Priced as an alternative', 'note' => 'Where you are only slightly short of height, we price this against the lift so you can compare.'],
    ['name' => 'Upgraded finishes', 'price' => 'Quoted per spec', 'note' => 'Engineered timber floors, fitted wardrobes, feature lighting. Standard spec is included above.']
];

$faqs = [
    ['q' => 'Does a roof-lift need planning permission?', 'a' => 'Almost always, yes. Permitted development does not allow the roof to go above the height of the existing highest part, and raising the ridge is the whole point of a roof-lift. Budget for a full application — we prepare the drawings and submit it, and typically allow around eight weeks for a decision.'],
    ['q' => 'When is a roof-lift the right answer?', 'a' => 'When you have under 2.2m from the joists to the ridge, no ceilings below worth dropping, and you still need the space. Bungalows, chalet bungalows and shallow-pitch houses from the 1960s and 70s are the usual candidates. On a Victorian terrace it is rarely necessary — the pitch is normally steep enough already.'],
    ['q' => 'Is dropping the ceilings below a cheaper alternative?', 'a' => 'Often, yes, and we always price it first. If the first floor has generous ceilings, taking 200 to 300mm off them can recover just enough headroom for a conventional conversion at a fraction of the cost. It means replastering those rooms, so it is disruptive in a different way.'],
    ['q' => 'What actually happens to the house while the roof is off?', 'a' => 'The roof comes off in a planned sequence under a temporary weatherproof scaffold roof, so the house is never left open. That scaffold roof is the single biggest reason a roof-lift costs more than a dormer — and the reason a wet week does not become water damage.'],
    ['q' => 'Can I stay in the house?', 'a' => 'Usually yes, but this is the one conversion type where we sometimes advise otherwise. It depends on the layout, whether the first floor is bedrooms, and how long the roof is off. We give you a straight answer at the survey rather than after you have signed.'],
    ['q' => 'Will it look like an extension?', 'a' => 'Not if the new roof is designed as the roof the house should have had. Raising the ridge changes the proportions, so the pitch, eaves detail, verge and materials all matter — and a planning officer will judge exactly those. Your CAD drawing shows the finished elevation before anything is ordered.'],
    ['q' => 'How much space does it create?', 'a' => 'More than any other option in a low roof, because you are creating the headroom rather than working around it. On a typical bungalow a roof-lift produces a full first floor — two or three bedrooms and a bathroom — rather than a single room.'],
    ['q' => 'Why can you not publish a starting price?', 'a' => 'Because the honest range is too wide to be useful. A modest bungalow lift and a full storey addition on a chalet are different projects with different structures, and quoting a low headline figure we then have to walk back is exactly what we do not do. You get one fixed written figure after the survey.']
];

include 'includes/header.php';
?>

  <main>
    <!-- Hero Section with Quick Booking Widget -->
    <section aria-labelledby="v-h" class="border-bottom">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));max-width:1280px;margin:0 auto;align-items:stretch">
        <div style="padding:clamp(26px,3.6vw,52px) 20px clamp(30px,3.6vw,52px);display:flex;flex-direction:column;justify-content:center;gap:18px">
          <!-- Embedded Breadcrumb & Badge -->
          <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
            <nav aria-label="Breadcrumb" class="breadcrumb-inline">
              <a href="index.php">Home</a>
              <span class="crumb-sep">/</span>
              <a href="conversion-types.php">Conversion types</a>
              <span class="crumb-sep">/</span>
              <span class="crumb-current" aria-current="page">Roof Lift</span>
            </nav>
            <span style="color:#D4D4CC;font-size:12px">•</span>
            <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
              <span style="width:5px;height:5px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              Type 05 of 06
            </span>
          </div>
          <h1 id="v-h" class="heading-h1" style="font-size:clamp(34px,5.4vw,56px);letter-spacing:-.025em;margin:0">Roof-Lift Loft Conversions</h1>
          <p style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(20px,2.4vw,25px);line-height:1.25;color:#4F6B42;margin:-4px 0 2px;letter-spacing:-.015em">Rebuilds the roof higher to create full headroom where there was none.</p>
          <p class="lead-text" style="max-width:46ch">The existing roof is removed and rebuilt at a greater height or steeper pitch. It is the permanent answer for bungalows, chalets and shallow 1960s roofs.</p>
          
          <!-- Key Stats / Numbers Grid on Left -->
          <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1px;background:#E4E4DF;border:1px solid #E4E4DF;max-width:440px;border-radius:3px;overflow:hidden">
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">6–8 Wks</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">On site build</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">On survey</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Fixed quote</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">Full floor</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Layout gained</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">&lt; 2.2m</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Solves headroom</span>
            </div>
          </div>

          <div class="hero-actions-row" style="margin-top:2px">
            <a href="tel:08000862744" class="btn-primary hero-btn" style="display:inline-flex;align-items:center;gap:10px">
              <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16.9v2.6a1.7 1.7 0 0 1-1.9 1.7 16.6 16.6 0 0 1-7.2-2.6 16.3 16.3 0 0 1-5-5A16.6 16.6 0 0 1 4.3 6.4 1.7 1.7 0 0 1 6 4.5h2.6a1.7 1.7 0 0 1 1.7 1.5c.1.9.3 1.7.6 2.5a1.7 1.7 0 0 1-.4 1.8l-1.1 1.1a13.4 13.4 0 0 0 5 5l1.1-1.1a1.7 1.7 0 0 1 1.8-.4c.8.3 1.6.5 2.5.6a1.7 1.7 0 0 1 1.5 1.7z"></path></svg>
              0800 0862744
            </a>
            <a href="#booking" data-open-booking class="btn-secondary hero-btn" style="display:inline-flex;align-items:center;gap:9px">
              Book your free survey
              <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="#6B8E5A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="animation:alNudge 1.5s ease-in-out infinite"><path d="M4 12h15M13 6l6 6-6 6"></path></svg>
            </a>
          </div>
          <div style="display:flex;flex-wrap:wrap;gap:8px 14px;font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#6B6B6B">
            <span>No obligation</span><span>•</span><span>Free CAD design</span><span>•</span><span>400+ finished projects</span>
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
                  <div style="font-family:var(--font-sans);font-size:11.5px;font-weight:600;color:#6B6B6B;margin-top:3px">40m³ limit</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Semi-detached">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V13l12-9 12 9v17M20 30V13M14 30v-7h12v7"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Semi-detached</div>
                  <div style="font-family:var(--font-sans);font-size:11.5px;font-weight:600;color:#6B6B6B;margin-top:3px">Most common</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Detached">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V14l16-10 16 10v16zM19 30v-8h10v8"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Detached</div>
                  <div style="font-family:var(--font-sans);font-size:11.5px;font-weight:600;color:#6B6B6B;margin-top:3px">50m³ limit</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Bungalow">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M4 30V18l20-12 20 12v12zM18 30v-7h12v7"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Bungalow</div>
                  <div style="font-family:var(--font-sans);font-size:11.5px;font-weight:600;color:#6B6B6B;margin-top:3px">Roof-lift option</div>
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

    <!-- Gallery Grid -->
    <section data-reveal class="section-padding-sm bg-white">
      <div class="container">
        <div class="gallery-header-wrap" style="display:flex;flex-wrap:wrap;gap:20px;align-items:flex-end;justify-content:space-between;margin-bottom:32px">
          <div>
            <span class="section-label">Gallery</span>
            <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0">Roof-lifts we've finished</h2>
          </div>
          <div class="gallery-header-meta" style="display:flex;align-items:center;gap:14px">
            <span style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#6B6B6B">8 of 400+ roof-lift projects</span>
            <div class="type-gal-nav" aria-label="Gallery controls">
              <button type="button" class="type-gal-prev" aria-label="Previous gallery image">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 19l-7-7 7-7"/></svg>
              </button>
              <button type="button" class="type-gal-next" aria-label="Next gallery image">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="type-gallery-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:14px">
          <?php foreach ($galleryImages as $img): ?>
            <div class="real-img-box type-gallery-card" style="aspect-ratio:4/3;border-radius:6px;overflow:hidden"><img src="<?php echo $img; ?>" alt="Loft Conversion" class="real-img" loading="lazy"></div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Process & Fit Section -->
    <section data-reveal class="section-padding-sm bg-gray border-top border-bottom">
      <div class="container" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:44px;align-items:start">
        <div>
          <span class="section-label">Process notes</span>
          <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 24px;max-width:20ch">What 6–8 weeks looks like</h2>
          <ol style="list-style:none;margin:0;padding:0;display:grid;gap:14px">
            <?php foreach ($timeline as $t): ?>
              <li style="display:flex;gap:16px;align-items:baseline;padding-bottom:14px;border-bottom:1px solid #DCDCD6">
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;color:#4F6B42;flex:0 0 68px"><?php echo $t['when']; ?></span>
                <span style="font-size:15px;line-height:1.6;color:#1A1A1A"><?php echo $t['what']; ?></span>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>
        <div>
          <span class="section-label">Suits / doesn't suit</span>
          <div style="display:grid;gap:14px;margin-top:20px">
            <?php foreach ($fit as $item): ?>
              <div style="display:flex;gap:12px;align-items:flex-start;background:#FFFFFF;border:1px solid #E4E4DF;border-radius:3px;padding:16px 18px">
                <span style="width:9px;height:9px;flex:0 0 9px;margin-top:6px;border-radius:50%;background:<?php echo $item['yes'] ? '#6B8E5A' : '#C9C9C2'; ?>"></span>
                <span style="font-size:15px;line-height:1.55"><?php echo $item['text']; ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing Section -->
    <section data-reveal aria-labelledby="price-h" class="section-padding-sm bg-dark">
      <div class="container">
        <div style="display:flex;flex-wrap:wrap;gap:20px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:40px">
          <div style="flex:1 1 420px">
            <span class="section-label-light">Pricing</span>
            <h2 id="price-h" class="heading-h2" style="color:#FFFFFF;max-width:24ch">How a roof-lift is priced &mdash; and what pushes it up</h2>
          </div>
          <p style="flex:1 1 300px;max-width:38ch;font-size:15px;line-height:1.65;color:#B8B8B0;margin:0">Every roof-lift is unique to the existing structure, the height gained and the layout planned. We price after measuring at your free survey &mdash; in writing, fixed, with no hidden extras.</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:1px;background:#2C2C29;border:1px solid #2C2C29">
          <div style="background:#6B8E5A;padding:clamp(24px,3vw,32px);display:flex;flex-direction:column;gap:18px">
            <div>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#EDF2E9">Pricing method</span>
              <div style="font-family:Newsreader,Georgia,serif;font-size:clamp(34px,4vw,48px);line-height:1.05;letter-spacing:-.02em;color:#FFFFFF;margin-top:10px">Quoted per project on survey</div>
              <span style="display:block;font-size:14px;line-height:1.6;color:#EDF2E9;margin-top:10px">A bespoke structural scheme, six to eight weeks on site.</span>
            </div>
            <ul style="list-style:none;margin:0;padding:0;display:grid;gap:9px">
              <?php foreach ($included as $inc): ?>
                <li style="display:flex;gap:10px;align-items:flex-start;font-size:14px;line-height:1.5;color:#FFFFFF">
                  <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#FFFFFF" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="flex:0 0 15px;margin-top:3px"><path d="M4 12.5l5 5L20 6.5"></path></svg>
                  <?php echo $inc; ?>
                </li>
              <?php endforeach; ?>
            </ul>
            <span style="font-family:var(--font-sans);font-size:12px;color:#EDF2E9;margin-top:auto">No deposit. Staged payments against completed work.</span>
          </div>

          <div style="background:#1A1A1A;padding:clamp(24px,3vw,32px);display:flex;flex-direction:column">
            <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#A8B79E">What pushes it up</span>
            <dl style="margin:16px 0 0;display:grid;gap:0">
              <?php foreach ($addOns as $a): ?>
                <div class="price-addon-item">
                  <div style="display:flex;flex-wrap:wrap;gap:6px 16px;align-items:baseline;justify-content:space-between">
                    <dt style="font-size:15px;font-weight:600;color:#FFFFFF"><?php echo $a['name']; ?></dt>
                    <dd class="price-tag" style="margin:0;font-family:var(--font-sans);font-size:14px;font-weight:700;color:#A8B79E;white-space:nowrap;transition:color .2s"><?php echo $a['price']; ?></dd>
                  </div>
                  <p style="margin:6px 0 0;font-size:13px;line-height:1.6;color:#B8B8B0;max-width:52ch"><?php echo $a['note']; ?></p>
                </div>
              <?php endforeach; ?>
            </dl>
            <p style="margin:20px 0 0;font-size:12.5px;line-height:1.6;color:#8A8A82;font-family:var(--font-sans)">Ranges reflect 2026 UK market rates. Your survey converts them into one fixed figure &mdash; nothing is added later.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Inline Booking Section -->
    <section id="booking" data-reveal class="section-padding-sm bg-gray">
      <div class="container-narrow">
        <div style="display:flex;flex-wrap:wrap;gap:20px 48px;align-items:flex-end;justify-content:space-between;margin:0 0 36px">
          <div style="flex:2 1 420px">
            <span class="section-label">Free survey</span>
            <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0">Does your loft need a roof-lift?</h2>
          </div>
          <p style="flex:1 1 260px;max-width:36ch;font-size:17px;line-height:1.6;color:#4A4A45;margin:0">We measure existing ridge height, check ceiling drops, and explain the structural route. Three steps to book.</p>
        </div>
        <?php 
          $widgetHeading = "Book a Roof-Lift survey";
          include 'includes/booking-widget.php'; 
        ?>
      </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section data-reveal aria-labelledby="faq-h" class="section-padding bg-white border-top">
      <div class="container faq-layout">
        <div class="faq-sticky-col">
          <span class="section-label">Roof-Lift questions</span>
          <h2 id="faq-h" class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 18px;max-width:16ch">Before you decide.</h2>
          <p style="font-size:16px;line-height:1.65;color:#4A4A45;margin:0 0 24px;max-width:38ch">Answers on planning permission, weather protection, ceiling drops and cost. Anything else, ask the surveyor &mdash; the visit is free whether you go ahead or not.</p>
          <div class="hero-actions-row" style="margin-top:4px">
            <a href="#booking" data-open-booking class="btn-primary hero-btn" style="padding:12px 18px;font-size:14px;white-space:nowrap">Book Free Survey</a>
            <a href="tel:08000862744" class="btn-secondary hero-btn" style="padding:11px 16px;font-size:14px;white-space:nowrap">Ask us directly</a>
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

    <!-- Conversion CTA Banner -->
    <section data-reveal aria-labelledby="cta-h" class="section-padding bg-primary cta-banner-section">
      <div class="container cta-banner-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:clamp(32px,5vw,72px);align-items:center">
        <div class="cta-banner-content">
          <span class="section-label-subtle">One free visit</span>
          <h2 id="cta-h" class="heading-h1" style="font-size:clamp(34px,5vw,60px);color:#FFFFFF;margin-top:14px">We'll check if a ceiling drop is possible <em style="font-style:italic">before</em> planning a full roof-lift.</h2>
          <p style="font-size:18px;line-height:1.6;margin:20px 0 30px;color:#EDF2E9;max-width:42ch">If there is a cheaper, faster way to gain the headroom we will show you. Forty-five minutes, a CAD drawing you keep, one fixed price.</p>
          <div class="cta-btn-group" style="display:flex;flex-wrap:wrap;gap:14px;align-items:center">
            <a href="#booking" data-open-booking class="btn-dark hero-btn">Book Free Survey</a>
            <a href="tel:08000862744" class="btn-outline-white hero-btn">
              <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              Call 0800 0862744
            </a>
          </div>
        </div>
        <div class="cta-what-next-card" style="background:#FFFFFF;color:#1A1A1A;border-radius:4px;padding:clamp(22px,3vw,34px)">
          <span class="section-label">What happens next</span>
          <ol style="list-style:none;margin:18px 0 0;padding:0;display:grid;gap:0">
            <li style="display:flex;gap:14px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #EDEDE8">
              <span style="font-family:var(--font-sans);font-size:13px;color:#4F6B42;font-weight:700;flex:0 0 26px;padding-top:2px">01</span>
              <span style="display:flex;flex-direction:column;gap:4px">
                <span style="font-size:16px;font-weight:600;line-height:1.3">The survey</span>
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Ridge height, trusses, staircase route, your questions.</span>
              </span>
              <span style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#8A8A82;margin-left:auto;white-space:nowrap;padding-top:2px">45 min</span>
            </li>
            <li style="display:flex;gap:14px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #EDEDE8">
              <span style="font-family:var(--font-sans);font-size:13px;color:#4F6B42;font-weight:700;flex:0 0 26px;padding-top:2px">02</span>
              <span style="display:flex;flex-direction:column;gap:4px">
                <span style="font-size:16px;font-weight:600;line-height:1.3">CAD design + fixed quote</span>
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">A drawing of the finished layout and one written price.</span>
              </span>
              <span style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#8A8A82;margin-left:auto;white-space:nowrap;padding-top:2px">A few days</span>
            </li>
            <li style="display:flex;gap:14px;align-items:flex-start;padding:16px 0">
              <span style="font-family:var(--font-sans);font-size:13px;color:#4F6B42;font-weight:700;flex:0 0 26px;padding-top:2px">03</span>
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

  <!-- 41 Service Areas -->
  <?php include 'includes/service-areas.php'; ?>

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
