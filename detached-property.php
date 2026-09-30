<?php
$pageTitle = "Detached House Loft Conversions — Another Level";
$pageDesc = "Loft conversions for detached houses. 50m³ permitted development allowance, no party wall notices, hip-to-gable from £37,000.";
$activePage = "property";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "Service",
    "serviceType" => "Loft conversion — Detached",
    "provider" => [
        "@type" => "LocalBusiness",
        "name" => "Another Level Loft Conversions",
        "telephone" => "0800 0862744"
    ],
    "offers" => [
        "@type" => "Offer",
        "priceCurrency" => "GBP",
        "price" => "37000",
        "priceSpecification" => "from"
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$facts = [
    ['value' => '50m³', 'label' => 'PD volume limit'],
    ['value' => 'No party wall', 'label' => 'Notices needed'],
    ['value' => '3.5 weeks', 'label' => 'On site']
];

$galleryImages = [
    'images/another-area-loft-conversions-north-west-england-15.jpeg',
    'images/another-area-loft-conversions-north-west-england-18.jpeg',
    'images/another-area-loft-conversions-north-west-england-07.jpeg',
    'images/another-area-loft-conversions-north-west-england-09.jpeg',
    'images/another-area-loft-conversions-north-west-england-17.jpeg',
    'images/another-area-loft-conversions-north-west-england-19.jpeg',
    'images/another-area-loft-conversions-north-west-england-20.jpeg',
    'images/another-area-loft-conversions-north-west-england-21.jpeg',
];

$timeline = [
    ['when' => 'Before', 'what' => 'Survey, CAD drawing, structural calculations, Building Control application. No party wall notices.'],
    ['when' => 'Days 1–3', 'what' => 'Scaffold up, loft cleared, hip carefully taken down.'],
    ['when' => 'Days 4–7', 'what' => 'New gable built up off the engineer’s load-bearing line, steels and joists in.'],
    ['when' => 'Weeks 2–3', 'what' => 'Roof extended and made watertight, windows fitted, staircase and partitions in.'],
    ['when' => 'Final days', 'what' => 'Plastering, second-fix electrics, Building Control sign-off and handover.']
];

$fit = [
    ['yes' => true, 'text' => 'Hip-to-gable on one side — the efficient choice, and usually enough.'],
    ['yes' => true, 'text' => 'Wrap around where you want a genuine second floor rather than one room.'],
    ['yes' => true, 'text' => 'Rear dormer where the side elevation is prominent and best left alone.'],
    ['yes' => false, 'text' => 'Squaring off both hips plus a dormer — that exceeds 50m³ and needs planning.'],
    ['yes' => false, 'text' => 'Assuming a large roof means a large allowance — the 50m³ cap applies regardless.'],
    ['yes' => false, 'text' => 'Any conversion under 2.2m with no ceilings to drop — a roof-lift is the route.']
];

$included = [
    'Structural steels, calculations and engineer’s sign-off',
    'New gable wall in matching brick, block or render',
    'Roof extended over the new gable with matching tiles or slate',
    'New floor joists laid over the existing ceiling',
    'Bespoke staircase, landing and fire-rated doors to the protected stair',
    'Insulation, plasterboard, skim and second-fix electrics',
    'Scaffolding, waste removal and daily clean-down',
    'Building Control fees and completion certificate'
];

$addOns = [
    ['name' => 'Hip-to-gable', 'price' => 'from £37,000', 'note' => 'One side squared off. Usually all the volume a good layout needs.'],
    ['name' => 'Rear dormer', 'price' => 'from £38,000', 'note' => 'Maximum floor area at full standing height, four weeks on site.'],
    ['name' => 'Wrap around', 'price' => 'from £48,000', 'note' => 'Gable plus dormer, around 44 m² — two bedrooms and a bathroom, six weeks.'],
    ['name' => 'Velux / rooflight', 'price' => 'from £24,000', 'note' => 'Cheapest and quickest at three weeks, where the ridge height allows.'],
    ['name' => 'En-suite shower room', 'price' => '+ £6,500 – £12,000', 'note' => 'The biggest single step. Cheaper near the existing soil stack.']
];

$faqs = [
    ['q' => 'How much can I build on a detached house?', 'a' => 'Permitted development allows 50m³ of added roof volume. It covers every roof enlargement ever made to the property, so an existing dormer counts against the total. On a larger detached roof the allowance, not the floor area, is usually what limits the design — we calculate the remainder at the survey.'],
    ['q' => 'Can I square off both hips?', 'a' => 'Physically yes, and there is no party wall to stop you — but two gables plus a dormer will normally exceed 50m³, which means a full planning application. It is often better to square off one side and put the volume into a deeper rear dormer instead. We model both on your drawings.'],
    ['q' => 'Do I still need Party Wall notices?', 'a' => 'No — that is the practical advantage of a detached house. No notices, no two-month waiting period, no neighbour surveyor. You do still need Building Control approval and structural calculations, both of which are inside your fixed price.'],
    ['q' => 'Which conversion gives the best result?', 'a' => 'On a detached house a wrap around usually wins on space, around 44 m², but a single hip-to-gable often gives everything you actually need for £11,000 less. The deciding factors are the staircase route and how much of the 50m³ is left. We recommend one rather than upselling the largest.'],
    ['q' => 'Where will the new staircase go?', 'a' => 'You normally have more choices than in a terrace or semi, which is worth exploiting. Over the existing flight keeps the landing compact; taking space from a large bedroom gives a better-proportioned landing and a straighter run. Either way, maximum 42° pitch with 1.9m headroom at the centre.'],
    ['q' => 'Do I need planning permission?', 'a' => 'Usually not, provided the design stays inside 50m³, sits 200mm back from the original eaves and does not exceed the existing ridge. Larger detached houses in Green Belt, conservation areas or on Article 4 land are the exception — we check your address before drawing.'],
    ['q' => 'Is a bigger roof more expensive to convert?', 'a' => 'Only partly. Steels, staircase, Building Control and scaffolding cost much the same whatever the floor area; what scales is flooring, plastering, electrics and insulation. That is why our prices start from the same figures as a semi and rise with area rather than property type.'],
    ['q' => 'How much value does it add?', 'a' => 'Loft conversions typically add 15% to 20% to a property value. On a detached house the ceiling is usually set by the street rather than the house, so it is worth asking a local agent what the top of your road achieves before choosing between a £37,000 and a £48,000 scheme.']
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
              <a href="property-types.php">Property types</a>
              <span class="crumb-sep">/</span>
              <span class="crumb-current" aria-current="page">Detached</span>
            </nav>
            <span style="color:#D4D4CC;font-size:12px">•</span>
            <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
              <span style="width:5px;height:5px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              Property Type 03 of 04
            </span>
          </div>
          <h1 id="v-h" class="heading-h1" style="font-size:clamp(34px,5.4vw,56px);letter-spacing:-.025em;margin:0">Detached House Loft Conversions</h1>
          <p style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(20px,2.4vw,25px);line-height:1.25;color:#4F6B42;margin:-4px 0 2px;letter-spacing:-.015em">Complete design freedom with zero party wall paperwork.</p>
          <p class="lead-text" style="max-width:46ch">A 50m³ allowance, hips on both sides and no party wall to negotiate. Detached houses give the most design freedom of any property type with no neighbour delays.</p>
          
          <!-- Key Stats / Numbers Grid on Left -->
          <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1px;background:#E4E4DF;border:1px solid #E4E4DF;max-width:440px;border-radius:3px;overflow:hidden">
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">3.5 Weeks</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">On site build</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">£37,000</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Fixed price from</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">25–46 m²</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">Typical floor</span>
            </div>
            <div style="background:#FAFAF8;padding:10px 14px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(19px,2vw,22px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">50m³</span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:#6B6B6B">PD volume limit</span>
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
                <button type="button" class="property-opt-btn active" data-property="Detached" aria-pressed="true">
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

    <!-- Gallery Grid -->
    <section data-reveal class="section-padding-sm bg-white">
      <div class="container">
        <div class="gallery-header-wrap" style="display:flex;flex-wrap:wrap;gap:20px;align-items:flex-end;justify-content:space-between;margin-bottom:32px">
          <div>
            <span class="section-label">Gallery</span>
            <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0">Detached houses we've converted</h2>
          </div>
          <div class="gallery-header-meta" style="display:flex;align-items:center;gap:12px">
            <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#6B6B6B">8 of 400+ detached projects</span>
            <div class="type-gal-nav" aria-label="Gallery carousel navigation">
              <button type="button" class="type-gal-prev" aria-label="Previous image">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
              </button>
              <button type="button" class="type-gal-next" aria-label="Next image">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="type-gallery-grid">
          <?php foreach ($galleryImages as $img): ?>
            <div class="type-gallery-card real-img-box" style="aspect-ratio:4/3;border-radius:4px"><img src="<?php echo $img; ?>" alt="Property Conversion" class="real-img" loading="lazy"></div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Process & Fit Section -->
    <section data-reveal class="section-padding-sm bg-gray border-top border-bottom">
      <div class="container" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:44px;align-items:start">
        <div>
          <span class="section-label">Process notes</span>
          <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 24px;max-width:20ch">What a detached build looks like</h2>
          <ol style="list-style:none;margin:0;padding:0;display:grid;gap:14px">
            <?php foreach ($timeline as $t): ?>
              <li style="display:flex;gap:16px;align-items:baseline;padding-bottom:14px;border-bottom:1px solid #DCDCD6">
                <span style="font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.02em;color:#6B8E5A;flex:0 0 70px"><?php echo $t['when']; ?></span>
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
            <h2 id="price-h" class="heading-h2" style="color:#FFFFFF;max-width:24ch">What a detached conversion costs</h2>
          </div>
          <p style="flex:1 1 300px;max-width:38ch;font-size:15px;line-height:1.65;color:#B8B8B0;margin:0">With no party wall delays, detached conversions move fast. Starting figures are real fixed prices after survey, not estimates.</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:1px;background:#2C2C29;border:1px solid #2C2C29">
          <div style="background:#6B8E5A;padding:clamp(24px,3vw,32px);display:flex;flex-direction:column;gap:18px">
            <div>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#EDF2E9">Hip-to-gable from</span>
              <div style="font-family:Newsreader,Georgia,serif;font-size:clamp(40px,5vw,58px);line-height:1;letter-spacing:-.03em;color:#FFFFFF;margin-top:10px">£37,000</div>
              <span style="display:block;font-size:14px;line-height:1.6;color:#EDF2E9;margin-top:10px">A typical 25–28 m² hip-to-gable on a detached house, 3.5 weeks.</span>
            </div>
            <ul style="list-style:none;margin:0;padding:0;display:grid;gap:9px">
              <?php foreach ($included as $inc): ?>
                <li style="display:flex;gap:10px;align-items:flex-start;font-size:14px;line-height:1.5;color:#FFFFFF">
                  <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#FFFFFF" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="flex:0 0 15px;margin-top:3px"><path d="M4 12.5l5 5L20 6.5"></path></svg>
                  <?php echo $inc; ?>
                </li>
              <?php endforeach; ?>
            </ul>
            <span style="font-family:var(--font-sans);font-size:12px;font-weight:600;color:#EDF2E9;margin-top:auto">No deposit. Staged payments against completed work.</span>
          </div>

          <div style="background:#1A1A1A;padding:clamp(24px,3vw,32px);display:flex;flex-direction:column">
            <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#A8B79E">Your options on a detached</span>
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
            <p style="margin:20px 0 0;font-size:12.5px;line-height:1.6;color:#8A8A82;font-family:var(--font-sans)">Figures are starting prices for a detached property. Your survey converts them into one fixed written figure — nothing is added later.</p>
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
            <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0">Book a survey on your detached home</h2>
          </div>
          <p style="flex:1 1 260px;max-width:36ch;font-size:17px;line-height:1.6;color:#4A4A45;margin:0">We measure both hips, the rear slope, and provide a full CAD design. Three steps to book.</p>
        </div>
        <?php 
          $widgetHeading = "Book a Detached survey";
          include 'includes/booking-widget.php'; 
        ?>
      </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section data-reveal aria-labelledby="faq-h" class="section-padding bg-white border-top">
      <div class="container faq-layout">
        <div class="faq-sticky-col">
          <span class="section-label">Detached questions</span>
          <h2 id="faq-h" class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 18px;max-width:16ch">Before you decide.</h2>
          <p style="font-size:16px;line-height:1.65;color:#4A4A45;margin:0 0 24px;max-width:38ch">Answers on the 50m³ volume limit, double-hip options, staircase layouts and cost. Anything else, ask the surveyor &mdash; the visit is free whether you go ahead or not.</p>
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

    <!-- Property CTA Banner -->
    <section data-reveal aria-labelledby="cta-h" class="section-padding bg-primary cta-banner-section">
      <div class="container cta-banner-grid">
        <div class="cta-banner-content">
          <span class="section-label-subtle">One free visit</span>
          <h2 id="cta-h" class="heading-h1" style="font-size:clamp(34px,5vw,60px);color:#FFFFFF;margin-top:14px">We'll check both hips and the rear slope <em style="font-style:italic">before</em> you commit.</h2>
          <p style="font-size:18px;line-height:1.6;margin:20px 0 30px;color:#EDF2E9;max-width:42ch">Detached homes give you options. We will model the best layout for your staircase and volume allowance with one fixed price.</p>
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
                <span style="font-size:14px;line-height:1.6;color:#6B6B6B">Ridge height, double hip check, staircase route.</span>
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
      let selectedProp = 'Detached';
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
