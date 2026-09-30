<?php
$pageTitle = "Velux Loft Conversions Fixed-Price Survey & CAD Design — Another Level";
$pageDesc = "Velux loft conversions Fixed-Price Survey & CAD Design finished in about three weeks. Free survey and CAD design across Preston, Manchester, Lancashire and Cheshire.";
$activePage = "types";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "Service",
    "serviceType" => "Velux loft conversion",
    "provider" => [
        "@type" => "LocalBusiness",
        "name" => "Another Level Loft Conversions",
        "telephone" => "0800 0862744"
    ],
    "offers" => [
        "@type" => "Offer",
        "priceCurrency" => "GBP",
        "price" => "24000",
        "priceSpecification" => "from"
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$facts = [
    ['value' => 'Fixed-Price Survey & CAD Design', 'label' => 'Fixed price'],
    ['value' => '3 weeks', 'label' => 'On site'],
    ['value' => '2.2m', 'label' => 'Min. headroom']
];

$galleryImages = [
    'images/another-area-loft-conversions-north-west-england-03.jpeg',
    'images/another-area-loft-conversions-north-west-england-05.jpeg',
    'images/another-area-loft-conversions-north-west-england-07.jpeg',
    'images/another-area-loft-conversions-north-west-england-09.jpeg',
    'images/another-area-loft-conversions-north-west-england-11.jpeg',
    'images/another-area-loft-conversions-north-west-england-13.jpeg',
    'images/another-area-loft-conversions-north-west-england-15.jpeg',
    'images/another-area-loft-conversions-north-west-england-17.jpeg',
];

$timeline = [
    ['when' => 'Days 1–2', 'what' => 'Scaffold up, materials delivered, loft cleared and boarded for safe working.'],
    ['when' => 'Days 3–5', 'what' => 'Steels and primary beams in, new deeper floor joists laid over the existing ceiling.'],
    ['when' => 'Week 2', 'what' => 'Roof upgraded, Velux windows fitted and flashed, insulation to current regulations.'],
    ['when' => 'Week 2–3', 'what' => 'Stairwell aperture cut, bespoke staircase fitted, partitions and joinery finished.'],
    ['when' => 'Week 3', 'what' => 'Plastering, second-fix electrics, building control sign-off and handover.']
];

$fit = [
    ['yes' => true, 'text' => '2.2m or more from ceiling joists to the underside of the ridge (2.4m on modern trusses).'],
    ['yes' => true, 'text' => 'You want the shortest, least disruptive build and the lowest fixed price.'],
    ['yes' => true, 'text' => 'The roof shape must stay as it is — conservation area, or you simply prefer it.'],
    ['yes' => false, 'text' => 'You need maximum floor area with full standing height across the room — choose a rear dormer.'],
    ['yes' => false, 'text' => 'The loft has a hipped roof with little usable volume — hip-to-gable is the route.'],
    ['yes' => false, 'text' => 'Headroom is under 2.2m with no ceilings to drop — look at a roof-lift instead.']
];

$included = [
    'Structural steels, calculations and engineer’s sign-off',
    'New floor joists laid over the existing ceiling',
    'Two Velux rooflights, fitted and flashed',
    'Bespoke staircase and fire-rated doors to the protected stair',
    'Insulation to current Part L standards',
    'Plasterboard, skim and second-fix electrics',
    'Building Control fees and completion certificate',
    'Scaffolding, waste removal and daily clean-down'
];

$addOns = [
    ['name' => 'En-suite shower room', 'price' => '+ £6,500 – £12,000', 'note' => 'The biggest single step. Cheaper near the existing soil stack; a macerator handles the awkward layouts.'],
    ['name' => 'Extra rooflights', 'price' => '+ £800 – £1,100 each', 'note' => 'Supplied and fitted. Integra remote operation or a Cabrio balcony window costs more.'],
    ['name' => 'Ceiling drop below', 'price' => 'On survey', 'note' => 'Where you are just under 2.2m and the first floor has generous ceilings. Adds plastering and redecoration.'],
    ['name' => 'Larger floor area', 'price' => '£24k → £38k', 'note' => 'A 32 m² master-plus-ensuite in a Victorian terrace sits at the top of the rooflight range.'],
    ['name' => 'Upgraded finishes', 'price' => 'Quoted per spec', 'note' => 'Engineered timber floors, fitted eaves storage, feature lighting. Standard spec is included above.']
];

$faqs = [
    ['q' => 'Do I need planning permission for a Velux conversion?', 'a' => 'Rarely. Because the roof profile is unchanged, a rooflight conversion almost always sits within permitted development. The conditions: the window must not project more than 150mm from the roof slope, side-facing units must be obscure glazed and non-opening below 1.7m, and front-facing windows onto a highway usually do need permission. Conservation areas and Article 4 zones are the real exception — there a full application is likely.'],
    ['q' => 'Is my loft tall enough?', 'a' => 'You need at least 2.2m of headroom over half the usable floor area — measured from the joists to the underside of the ridge. Modern trussed roofs usually want 2.4m because the structure eats into the space. We measure it properly at the survey and tell you straight if a rooflight conversion will not work.'],
    ['q' => 'How many windows will I get, and how big?', 'a' => 'Regulations expect a glazed area of roughly one tenth of the floor area, so two windows covers most single rooms. One has to double as the escape window: a clear opening of at least 0.33m² with no dimension under 450mm, and the sill no more than 1.1m above the floor. We size and place them at the survey so the light lands where you will actually use it.'],
    ['q' => 'Which Velux window should I choose?', 'a' => 'Centre-pivot units suit furniture placed underneath and pitches from 15° to 90°. Top-hung units open fully outward, suit 15° to 55°, and give a better view and more headroom at the window. Polyurethane finishes are the right call in a loft bathroom, and triple glazing is worth it on a north-facing slope.'],
    ['q' => 'What does Building Control actually check?', 'a' => 'Inspections at key stages: the steels going in, insulation, fire stopping, and a final visit before sign-off. They check the roof reaches a 0.15 W/m²K U-value, walls and floors 0.18, the escape window, interlinked mains-powered smoke alarms on every floor, and the stair geometry. You get a completion certificate at the end — you will need it when you sell.'],
    ['q' => 'Will the new staircase fit?', 'a' => 'Almost always, and it is a design question rather than a structural one. The rules: maximum 42° pitch, 1.9m headroom at the centre of the flight and 1.8m at the edges under a slope. We show the landing and stair position on your CAD drawing so you can see what it takes off the floor below before committing.'],
    ['q' => 'What fire protection is needed?', 'a' => 'A loft room makes a two-storey house into three storeys, so the stairwell becomes a protected escape route. In practice that means fire-rated doors to habitable rooms off the stairwell, 30-minute protection to the stair enclosure, and interlinked mains-powered smoke alarms on every level. All of it is inside your fixed price.'],
    ['q' => 'Warm roof or cold roof insulation?', 'a' => 'Cold roof puts insulation between the rafters and keeps the ceiling line high — the usual choice when headroom is tight. Warm roof puts it above the rafters, performs better and avoids cold bridging, but costs a little of your height. We recommend one or the other after measuring, not before.'],
    ['q' => 'Can I add a bathroom to a Velux conversion?', 'a' => 'Yes, though it is easier if the new room sits near the existing soil stack. Where it does not, a macerator moves waste to the main stack. Mechanical ventilation is required either way. It is the biggest single cost step — budget £6,500 to £12,000 — and it can always be added later.'],
    ['q' => 'How much value does it add?', 'a' => 'A loft conversion typically adds 15% to 20% to a property value, and a rooflight conversion is the cheapest route to it. An extra bedroom with a shower room is the single highest-value addition for most North West houses, and the conversion normally costs less than the uplift.'],
    ['q' => 'Will noise carry to the room below?', 'a' => 'Not if it is built properly. Acoustic insulation between the new floor joists and resilient bars under the plasterboard stop most of it — Part E of the regulations sets the standard. It is included in our specification rather than sold as an upgrade.'],
    ['q' => 'Can I live in the house during the work?', 'a' => 'Yes, and nearly everyone does. Access is through a scaffold and rear hoist for most of the three weeks, so material never comes through the house. The stairwell is only cut through late in the build, and there is one noisy day when the steels land.']
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
              <span class="crumb-current" aria-current="page">Velux™</span>
            </nav>
            <span style="color:#D4D4CC;font-size:12px">•</span>
            <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
              <span style="width:5px;height:5px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              Type 01 of 06
            </span>
          </div>
          <h1 id="v-h" class="heading-h1" style="font-size:clamp(34px,5.4vw,56px);letter-spacing:-.025em;margin:0">Velux Loft Conversions</h1>
          <p style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(20px,2.4vw,25px);line-height:1.25;color:#4F6B42;margin:-4px 0 2px;letter-spacing:-.015em">The roof line never changes, so there is rarely a planning question and the build is short.</p>
          <p class="lead-text" style="max-width:46ch">Every Velux loft conversion works within your existing roof structure. The right choice when your ridge height is already generous (minimum 2.2m). Our team provides fixed-price conversions with drawings you keep across the North West.</p>
          
          <!-- Key Stats / Numbers Grid on Left -->
          <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1px;background:#E4E4DF;border:1px solid #E4E4DF;max-width:440px;border-radius:3px;overflow:hidden">
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">3 Weeks</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Fastest build</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">£24,000</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Fixed price from</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">22 m²</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Typical floor</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">Zero</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">PD volume used</span>
            </div>
          </div>

          <div class="hero-actions-row">
            <a href="tel:08000862744" class="btn-primary hero-btn" style="display:inline-flex;align-items:center;justify-content:center;gap:8px">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16.9v2.6a1.7 1.7 0 0 1-1.9 1.7 16.6 16.6 0 0 1-7.2-2.6 16.3 16.3 0 0 1-5-5A16.6 16.6 0 0 1 4.3 6.4 1.7 1.7 0 0 1 6 4.5h2.6a1.7 1.7 0 0 1 1.7 1.5c.1.9.3 1.7.6 2.5a1.7 1.7 0 0 1-.4 1.8l-1.1 1.1a13.4 13.4 0 0 0 5 5l1.1-1.1a1.7 1.7 0 0 1 1.8-.4c.8.3 1.6.5 2.5.6a1.7 1.7 0 0 1 1.5 1.7z"></path></svg>
              0800 0862744
            </a>
            <a href="#booking" data-open-booking class="btn-secondary hero-btn" style="display:inline-flex;align-items:center;justify-content:center;gap:7px">
              Book free survey
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#6B8E5A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="animation:alNudge 1.5s ease-in-out infinite"><path d="M4 12h15M13 6l6 6-6 6"></path></svg>
            </a>
          </div>
          <div style="display:flex;flex-wrap:wrap;gap:8px 16px;font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#6B6B6B">
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
                  <div style="font-family:var(--font-sans);font-size:11px;color:#6B6B6B;margin-top:3px">40m³ limit</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Semi-detached">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V13l12-9 12 9v17M20 30V13M14 30v-7h12v7"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Semi-detached</div>
                  <div style="font-family:var(--font-sans);font-size:11px;color:#6B6B6B;margin-top:3px">Most common</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Detached">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M8 30V14l16-10 16 10v16zM19 30v-8h10v8"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Detached</div>
                  <div style="font-family:var(--font-sans);font-size:11px;color:#6B6B6B;margin-top:3px">50m³ limit</div>
                </button>
                <button type="button" class="property-opt-btn" data-property="Bungalow">
                  <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:34px">
                    <svg viewBox="0 0 48 32" width="46" height="31" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M4 30V18l20-12 20 12v12zM18 30v-7h12v7"></path></svg>
                  </div>
                  <div style="font-size:14px;font-weight:600;margin-top:10px">Bungalow</div>
                  <div style="font-family:var(--font-sans);font-size:11px;color:#6B6B6B;margin-top:3px">Roof-lift option</div>
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

    <!-- Gallery Grid with Mobile Carousel -->
    <section data-reveal class="section-padding-sm bg-white">
      <div class="container">
        <div class="gallery-header-wrap" style="display:flex;flex-wrap:wrap;gap:16px;align-items:flex-end;justify-content:space-between;margin-bottom:28px">
          <div>
            <span class="section-label">Gallery</span>
            <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0">Velux conversions we've finished</h2>
          </div>
          <div class="gallery-header-meta" style="display:flex;align-items:center;gap:12px">
            <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#6B6B6B">8 of 400+ projects</span>
            <div class="velux-gal-nav" style="display:none;align-items:center;gap:8px">
              <button type="button" class="velux-gal-prev" aria-label="Previous gallery image">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
              </button>
              <button type="button" class="velux-gal-next" aria-label="Next gallery image">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="velux-gallery-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:14px">
          <?php foreach ($galleryImages as $img): ?>
            <div class="real-img-box velux-gallery-card" style="aspect-ratio:4/3;border-radius:6px;overflow:hidden"><img src="<?php echo $img; ?>" alt="Velux Loft Conversion" class="real-img" loading="lazy"></div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Process & Fit Section -->
    <section data-reveal class="section-padding-sm bg-gray border-top border-bottom">
      <div class="container" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:44px;align-items:start">
        <div>
          <span class="section-label">Process notes</span>
          <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 24px;max-width:20ch">What three weeks actually looks like</h2>
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
            <h2 id="price-h" class="heading-h2" style="color:#FFFFFF;max-width:24ch">What £24,000 includes &mdash; and what pushes it up</h2>
          </div>
          <p style="flex:1 1 300px;max-width:38ch;font-size:15px;line-height:1.65;color:#B8B8B0;margin:0">Rooflight conversions run £22,000–£38,000 across the UK in 2026. North West build costs sit below that average, and our starting figure is a real fixed price, not a teaser.</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:1px;background:#2C2C29;border:1px solid #2C2C29">
          <div style="background:#6B8E5A;padding:clamp(24px,3vw,32px);display:flex;flex-direction:column;gap:18px">
            <div>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#EDF2E9">Fixed price from</span>
              <div style="font-family:Newsreader,Georgia,serif;font-size:clamp(40px,5vw,58px);line-height:1;letter-spacing:-.03em;color:#FFFFFF;margin-top:10px">£24,000</div>
              <span style="display:block;font-size:14px;line-height:1.6;color:#EDF2E9;margin-top:10px">A typical 18–22 m² rooflight conversion, three weeks on site.</span>
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
            <p style="margin:20px 0 0;font-size:12.5px;line-height:1.6;color:#8A8A82">Ranges reflect 2026 UK market rates. Your survey converts them into one fixed figure &mdash; nothing is added later.</p>
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
            <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0">Is your loft tall enough for a Velux?</h2>
          </div>
          <p style="flex:1 1 260px;max-width:36ch;font-size:17px;line-height:1.6;color:#4A4A45;margin:0">We'll measure it for you. Three steps, and "not sure" is a valid answer.</p>
        </div>
        <?php 
          $widgetHeading = "Book a Velux survey";
          include 'includes/booking-widget.php'; 
        ?>
      </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section data-reveal aria-labelledby="faq-h" class="section-padding bg-white border-top">
      <div class="container faq-layout">
        <div class="faq-sticky-col">
          <span class="section-label">Velux questions</span>
          <h2 id="faq-h" class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 18px;max-width:16ch">Before you decide.</h2>
          <p style="font-size:16px;line-height:1.65;color:#4A4A45;margin:0 0 24px;max-width:38ch">Answers on planning, headroom, Building Control, stairs and cost. Anything else, ask the surveyor &mdash; the visit is free whether a rooflight conversion turns out to be right for you or not.</p>
          <div class="hero-actions-row">
            <a href="#booking" data-open-booking class="btn-primary hero-btn" style="display:inline-flex;align-items:center;justify-content:center;white-space:nowrap">Book Free Survey</a>
            <a href="tel:08000862744" class="btn-secondary hero-btn" style="display:inline-flex;align-items:center;justify-content:center;white-space:nowrap">Ask us directly</a>
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
      <div class="container cta-banner-grid">
        <div class="cta-banner-content">
          <span class="section-label-subtle">One free visit</span>
          <h2 id="cta-h" class="heading-h1" style="font-size:clamp(34px,5vw,60px);color:#FFFFFF;margin-top:14px">We'll measure the ridge <em style="font-style:italic">before</em> you commit to anything.</h2>
          <p style="font-size:18px;line-height:1.6;margin:20px 0 30px;color:#EDF2E9;max-width:42ch">If a Velux won't work on your roof we'll say so, and show you what will. Forty-five minutes, a CAD drawing you keep, one fixed price.</p>
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
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Ridge height, trusses, staircase route, your questions.</span>
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
