<?php
$pageTitle = "About Another Level Loft Conversions — 18 Years in North West";
$pageDesc = "Eighteen years converting lofts across Preston, Manchester, Lancashire and Cheshire. 400+ finished projects, in-house team, fixed prices, free CAD design.";
$activePage = "about";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "AboutPage",
    "mainEntity" => [
        "@type" => "LocalBusiness",
        "name" => "Another Level Loft Conversions",
        "foundingDate" => "2008",
        "telephone" => "0800 0862744",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "Old Docks House, 90 Watery Lane",
            "addressLocality" => "Preston",
            "postalCode" => "PR2 1AU",
            "addressCountry" => "GB"
        ],
        "areaServed" => ["Preston", "Manchester", "Lancashire", "Cheshire", "North West England"]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

  <main>

    <!-- Hero Section -->
    <section aria-labelledby="h1">
      <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));align-items:stretch">
        <div style="padding:clamp(28px,4vw,56px) 20px clamp(32px,4vw,56px);display:flex;flex-direction:column;justify-content:center;gap:20px">
          
          <!-- Embedded Breadcrumb & Badge -->
          <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
            <nav aria-label="Breadcrumb" class="breadcrumb-inline">
              <a href="index.php">Home</a>
              <span class="crumb-sep">/</span>
              <span class="crumb-current" aria-current="page">About us</span>
            </nav>
            <span style="color:#D4D4CC;font-size:12px">•</span>
            <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
              <span style="width:5px;height:5px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              Established 2008
            </span>
          </div>

          <h1 id="h1" class="heading-h1" style="font-size:clamp(34px,5.4vw,58px);letter-spacing:-.025em;margin:0">A North West team that <em style="font-style:italic">only</em> builds lofts.</h1>
          <p style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(20px,2.4vw,25px);line-height:1.25;color:#4F6B42;margin:-4px 0 2px;letter-spacing:-.015em">18 years, 400+ finished projects, and zero sub-contractors.</p>
          <p class="lead-text" style="max-width:50ch">We don’t take on kitchens, extensions, or general building work. Every member of our team is a dedicated loft specialist — from Jonny surveying the roof structure to the joiners framing your dormer.</p>
          
          <!-- Key Stats / Numbers Grid -->
          <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1px;background:#E4E4DF;border:1px solid #E4E4DF;max-width:460px;border-radius:3px;overflow:hidden">
            <div style="background:#FAFAF8;padding:12px 16px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(20px,2.2vw,24px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">18 Years</span>
              <span style="font-family:var(--font-sans);font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#6B6B6B;font-weight:600">Converting lofts</span>
            </div>
            <div style="background:#FAFAF8;padding:12px 16px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(20px,2.2vw,24px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">400+</span>
              <span style="font-family:var(--font-sans);font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#6B6B6B;font-weight:600">Completed lofts</span>
            </div>
            <div style="background:#FAFAF8;padding:12px 16px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(20px,2.2vw,24px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">100%</span>
              <span style="font-family:var(--font-sans);font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#6B6B6B;font-weight:600">In-house craft team</span>
            </div>
            <div style="background:#FAFAF8;padding:12px 16px;display:flex;flex-direction:column;gap:3px">
              <span style="font-family:Newsreader,Georgia,serif;font-size:clamp(20px,2.2vw,24px);line-height:1;letter-spacing:-.015em;color:#1A1A1A">9.8 / 10</span>
              <span style="font-family:var(--font-sans);font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#6B6B6B;font-weight:600">Checkatrade score</span>
            </div>
          </div>

          <div class="hero-actions-row" style="margin-top:4px">
            <a href="tel:08000862744" class="btn-primary hero-btn">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16.9v2.6a1.7 1.7 0 0 1-1.9 1.7 16.6 16.6 0 0 1-7.2-2.6 16.3 16.3 0 0 1-5-5A16.6 16.6 0 0 1 4.3 6.4 1.7 1.7 0 0 1 6 4.5h2.6a1.7 1.7 0 0 1 1.7 1.5c.1.9.3 1.7.6 2.5a1.7 1.7 0 0 1-.4 1.8l-1.1 1.1a13.4 13.4 0 0 0 5 5l1.1-1.1a1.7 1.7 0 0 1 1.8-.4c.8.3 1.6.5 2.5.6a1.7 1.7 0 0 1 1.5 1.7z"></path></svg>
              <span>0800 0862744</span>
            </a>
            <a href="#booking" data-open-booking class="btn-secondary hero-btn">
              <span>Book your free survey</span>
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#6B8E5A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"></path></svg>
            </a>
          </div>
          <div style="display:flex;flex-wrap:wrap;gap:8px 20px;font-family:var(--font-sans);font-size:13px;font-weight:500;color:#6B6B6B">
            <span>No obligation</span><span>&middot;</span><span>Free CAD design</span><span>&middot;</span><span>One fixed price</span>
          </div>
        </div>

        <div class="real-img-box" style="min-height:clamp(300px,38vw,520px);border-left:1px solid #EDEDE8">
          <img src="images/another-area-loft-conversions-north-west-england-18.jpeg" alt="Another Level Loft Conversions Project in Preston" class="real-img" loading="eager">
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
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
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

    <!-- Our Story Section -->
    <section id="story" data-reveal aria-labelledby="story-h" class="section-padding-sm bg-white border-bottom">
      <div class="container">
        <!-- Top: Story Narrative & Checkatrade Profile -->
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:clamp(32px,5vw,56px);align-items:start;margin-bottom:40px">
          <!-- Story Narrative -->
          <div>
            <span class="section-label">Our Background &amp; Heritage</span>
            <h2 id="story-h" class="heading-h2" style="font-size:clamp(28px,3.8vw,42px);margin:12px 0 20px;max-width:24ch">Started with one Preston dormer. 18 years of perfecting a single craft.</h2>
            
            <div style="display:grid;gap:18px;font-size:15.5px;line-height:1.75;color:#4A4A45">
              <p style="margin:0;text-wrap:pretty">We began in 2008 as two joiners constructing rear dormers on 1930s semis around Preston. Lofts were originally meant to be a sideline, but we quickly realised they were the only home improvement where a growing family gets a complete new master bedroom suite or two kids' rooms without losing an inch of garden.</p>
              
              <!-- Highlight Callout Box -->
              <div style="background:#F7F9F5;border-left:3px solid #6B8E5A;border-radius:0 8px 8px 0;padding:14px 18px;margin:2px 0">
                <p style="font-family:Newsreader,Georgia,serif;font-style:italic;font-size:18px;line-height:1.45;color:#2D4523;margin:0">"Focus 100% on roofs. Stop doing general building, extensions, and kitchen refits. Master every single detail of loft construction."</p>
              </div>

              <p style="margin:0;text-wrap:pretty">Over the last 18 years we’ve perfected every detail — from calculating complex RSJ structural steel placements and fitting compliant staircases to crafting weatherproof dormers and handling all local authority approvals.</p>
              <p style="margin:0;text-wrap:pretty">Today, the team operates out of Old Docks House in Preston, covering 41 towns across Lancashire, Greater Manchester, and Cheshire. We maintain dedicated in-house build crews, our own CAD architectural studio, structural engineers on call, and a surveyor who visits your home personally.</p>
            </div>
          </div>

          <!-- Right Side: Checkatrade Verified Showcase & Company Profile -->
          <aside style="display:flex;flex-direction:column;gap:20px">
            <!-- Checkatrade Verified Feature Card -->
            <div style="background:#FAFAF8;border:1px solid #E2E5DF;border-radius:10px;padding:clamp(22px,2.8vw,28px);display:flex;flex-direction:column;gap:16px;box-shadow:0 4px 18px -4px rgba(24,34,22,0.05)">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:16px">
                <a href="https://www.checkatrade.com/trades/AnotherLevelLoftConversionsNw" target="_blank" rel="noopener noreferrer" title="View Checkatrade Profile" style="display:block;max-width:180px">
                  <img src="images/checkatrade-proud-member.png" alt="Checkatrade Proud Member" style="height:clamp(48px,4vw,58px);width:auto;object-fit:contain;display:block">
                </a>
                <div style="background:#FFFFFF;border:1px solid #DFEBD9;border-radius:8px;padding:8px 14px;text-align:right;box-shadow:0 2px 6px rgba(0,0,0,0.03)">
                  <div style="font-family:Newsreader,Georgia,serif;font-size:22px;line-height:1;color:#3E5C32;font-weight:700">9.8 / 10</div>
                  <div style="font-family:var(--font-sans);font-size:10px;letter-spacing:.08em;text-transform:uppercase;color:#6B8E5A;margin-top:3px;font-weight:700">★★★★★ Verified</div>
                </div>
              </div>

              <div style="border-top:1px solid #EDEDE8;padding-top:14px">
                <div style="font-size:15px;font-weight:700;color:#1A1A1A;margin-bottom:6px;display:flex;align-items:center;gap:6px">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="#3E5C32" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                  <span>100% Vetted &amp; Independently Checked</span>
                </div>
                <p style="font-size:13.5px;line-height:1.6;color:#555550;margin:0">Every review on our profile is independently verified by Checkatrade. We maintain one of the highest customer satisfaction scores in Lancashire &amp; Greater Manchester.</p>
              </div>

              <a href="https://www.checkatrade.com/trades/AnotherLevelLoftConversionsNw" target="_blank" rel="noopener noreferrer" class="btn-secondary" style="display:flex;align-items:center;justify-content:center;gap:8px;padding:12px 16px;font-size:13.5px;font-weight:600;border-radius:6px">
                <span>View verified Checkatrade reviews</span>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
              </a>
            </div>

            <!-- Company Profile Mini Grid -->
            <div style="background:#FFFFFF;border:1px solid #E2E5DF;border-radius:10px;padding:clamp(20px,2.4vw,26px);display:flex;flex-direction:column;gap:14px;box-shadow:0 4px 18px -4px rgba(24,34,22,0.05)">
              <span class="section-label">Company facts</span>
              <dl style="margin:0;display:grid;gap:0">
                <div style="display:flex;justify-content:space-between;gap:16px;padding:10px 0;border-top:1px solid #EDEDE8">
                  <dt style="font-family:var(--font-sans);font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#6B6B6B;font-weight:600">Registered Office</dt>
                  <dd style="margin:0;font-size:13px;font-weight:600;text-align:right;color:#1A1A1A">Old Docks House, Preston PR2 1AU</dd>
                </div>
                <div style="display:flex;justify-content:space-between;gap:16px;padding:10px 0;border-top:1px solid #EDEDE8">
                  <dt style="font-family:var(--font-sans);font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#6B6B6B;font-weight:600">Coverage Area</dt>
                  <dd style="margin:0;font-size:13px;font-weight:600;text-align:right;color:#1A1A1A">41 North West locations</dd>
                </div>
                <div style="display:flex;justify-content:space-between;gap:16px;padding:10px 0;border-top:1px solid #EDEDE8">
                  <dt style="font-family:var(--font-sans);font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#6B6B6B;font-weight:600">Insurance</dt>
                  <dd style="margin:0;font-size:13px;font-weight:600;text-align:right;color:#1A1A1A">£5M Public Liability</dd>
                </div>
                <div style="display:flex;justify-content:space-between;gap:16px;padding:10px 0;border-top:1px solid #EDEDE8">
                  <dt style="font-family:var(--font-sans);font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#6B6B6B;font-weight:600">Guarantee</dt>
                  <dd style="margin:0;font-size:13px;font-weight:700;text-align:right;color:#3E5C32">10-Year Written Guarantee</dd>
                </div>
              </dl>
              <div style="display:flex;gap:10px;margin-top:4px">
                <a href="contact.php" class="btn-primary" style="flex:1;text-align:center;padding:11px 12px;font-size:13px;border-radius:6px">Contact Office</a>
                <a href="customer-testimonials.php" class="btn-secondary" style="flex:1;text-align:center;padding:11px 12px;font-size:13px;border-radius:6px">Client Reviews</a>
              </div>
            </div>
          </aside>
        </div>

        <!-- Bottom: Full-Width 4 Milestone Cards Row (2x2 on Mobile, 4-col on Desktop) -->
        <div class="milestones-timeline-grid">
          <div class="milestone-card">
            <div class="milestone-card-top">
              <span class="milestone-year-badge">2008</span>
              <span class="milestone-phase-label">Origin</span>
            </div>
            <h3 class="milestone-title">Founded in Preston</h3>
            <p class="milestone-desc">Specialist joinery roots on local terraced &amp; semi homes.</p>
          </div>

          <div class="milestone-card">
            <div class="milestone-card-top">
              <span class="milestone-year-badge">2014</span>
              <span class="milestone-phase-label">Expansion</span>
            </div>
            <h3 class="milestone-title">100th Conversion</h3>
            <p class="milestone-desc">Expanded coverage across Lancashire and Cheshire.</p>
          </div>

          <div class="milestone-card">
            <div class="milestone-card-top">
              <span class="milestone-year-badge">2019</span>
              <span class="milestone-phase-label">Technology</span>
            </div>
            <h3 class="milestone-title">In-house CAD Studio</h3>
            <p class="milestone-desc">Instant bespoke 3D CAD drawings for every survey.</p>
          </div>

          <div class="milestone-card active-today">
            <div class="milestone-card-top">
              <span class="milestone-year-badge today">2026</span>
              <span class="milestone-phase-label today">Today</span>
            </div>
            <h3 class="milestone-title">400+ Finished Lofts</h3>
            <p class="milestone-desc">The leading regional loft specialist across 41 towns.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- How We Work (Core Standards) -->
    <section data-reveal aria-labelledby="prin-h" class="section-padding-sm bg-gray border-bottom">
      <div class="container">
        <div style="display:flex;flex-wrap:wrap;gap:18px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:36px">
          <div style="flex:2 1 420px">
            <span class="section-label">How we work</span>
            <h2 id="prin-h" class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 0;max-width:26ch">Four principles we have never had a reason to break.</h2>
          </div>
          <p style="flex:1 1 260px;max-width:34ch;font-size:15px;line-height:1.6;color:#6B6B6B;margin:0">Over 80% of our new conversions come from direct neighbour recommendations.</p>
        </div>

        <div class="principles-grid">
          
          <!-- Principle 01 -->
          <div class="principle-card" style="background:#FFFFFF;border:1px solid #E2E5DF;border-radius:10px;padding:28px 24px 24px;display:flex;flex-direction:column;gap:14px;position:relative;overflow:hidden;box-shadow:0 4px 18px -4px rgba(24,34,22,0.05),0 1px 3px rgba(0,0,0,0.02);transition:border-color .25s ease,box-shadow .25s ease" onmouseover="this.style.borderColor='#9DC388';this.style.boxShadow='0 12px 28px -6px rgba(79,107,66,0.16),0 2px 6px rgba(0,0,0,0.04)';this.querySelector('.prin-ghost').style.color='#E2EBDC';this.querySelector('.prin-icon-wrap').style.backgroundColor='#E3EFE0'" onmouseout="this.style.borderColor='#E2E5DF';this.style.boxShadow='0 4px 18px -4px rgba(24,34,22,0.05),0 1px 3px rgba(0,0,0,0.02)';this.querySelector('.prin-ghost').style.color='#F1F4EE';this.querySelector('.prin-icon-wrap').style.backgroundColor='#F1F7EE'">
            <div class="prin-ghost" style="position:absolute;top:8px;right:16px;font-family:var(--font-serif);font-size:52px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none;transition:color .25s ease">01</div>
            
            <div style="display:flex;align-items:center;justify-content:space-between;position:relative;z-index:1">
              <div class="prin-icon-wrap" style="width:48px;height:48px;border-radius:10px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#3E5C32;transition:background-color .25s ease">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              </div>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#4F6B42;background:#F4F8F1;padding:4px 10px;border-radius:20px;border:1px solid #E1EBDC">Step 01</span>
            </div>

            <div style="position:relative;z-index:1;display:flex;flex-direction:column;gap:8px">
              <h3 style="font-family:var(--font-serif);font-size:21px;line-height:1.25;font-weight:400;color:#1A1A1A;margin:0;letter-spacing:-.01em">One fixed price, in writing</h3>
              <p style="font-family:var(--font-sans);font-size:14px;line-height:1.65;color:#555550;margin:0">The figure on your survey proposal is the exact figure on your completion invoice. No open-ended estimates, and no mid-build surprises.</p>
            </div>

            <div style="margin-top:auto;padding-top:14px;border-top:1px solid #F0F0EB;display:flex;align-items:center;gap:7px;font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#3E5C32;position:relative;z-index:1">
              <svg viewBox="0 0 16 16" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg>
              <span>No hidden extras guaranteed</span>
            </div>
          </div>

          <!-- Principle 02 -->
          <div class="principle-card" style="background:#FFFFFF;border:1px solid #E2E5DF;border-radius:10px;padding:28px 24px 24px;display:flex;flex-direction:column;gap:14px;position:relative;overflow:hidden;box-shadow:0 4px 18px -4px rgba(24,34,22,0.05),0 1px 3px rgba(0,0,0,0.02);transition:border-color .25s ease,box-shadow .25s ease" onmouseover="this.style.borderColor='#9DC388';this.style.boxShadow='0 12px 28px -6px rgba(79,107,66,0.16),0 2px 6px rgba(0,0,0,0.04)';this.querySelector('.prin-ghost').style.color='#E2EBDC';this.querySelector('.prin-icon-wrap').style.backgroundColor='#E3EFE0'" onmouseout="this.style.borderColor='#E2E5DF';this.style.boxShadow='0 4px 18px -4px rgba(24,34,22,0.05),0 1px 3px rgba(0,0,0,0.02)';this.querySelector('.prin-ghost').style.color='#F1F4EE';this.querySelector('.prin-icon-wrap').style.backgroundColor='#F1F7EE'">
            <div class="prin-ghost" style="position:absolute;top:8px;right:16px;font-family:var(--font-serif);font-size:52px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none;transition:color .25s ease">02</div>
            
            <div style="display:flex;align-items:center;justify-content:space-between;position:relative;z-index:1">
              <div class="prin-icon-wrap" style="width:48px;height:48px;border-radius:10px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#3E5C32;transition:background-color .25s ease">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              </div>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#4F6B42;background:#F4F8F1;padding:4px 10px;border-radius:20px;border:1px solid #E1EBDC">Step 02</span>
            </div>

            <div style="position:relative;z-index:1;display:flex;flex-direction:column;gap:8px">
              <h3 style="font-family:var(--font-serif);font-size:21px;line-height:1.25;font-weight:400;color:#1A1A1A;margin:0;letter-spacing:-.01em">Our own in-house crews</h3>
              <p style="font-family:var(--font-sans);font-size:14px;line-height:1.65;color:#555550;margin:0">The joiners who strip the roof on day one are the same craftsmen who hang your doors at handover. No unknown rotating subbies.</p>
            </div>

            <div style="margin-top:auto;padding-top:14px;border-top:1px solid #F0F0EB;display:flex;align-items:center;gap:7px;font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#3E5C32;position:relative;z-index:1">
              <svg viewBox="0 0 16 16" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg>
              <span>100% employed craftsmen</span>
            </div>
          </div>

          <!-- Principle 03 -->
          <div class="principle-card" style="background:#FFFFFF;border:1px solid #E2E5DF;border-radius:10px;padding:28px 24px 24px;display:flex;flex-direction:column;gap:14px;position:relative;overflow:hidden;box-shadow:0 4px 18px -4px rgba(24,34,22,0.05),0 1px 3px rgba(0,0,0,0.02);transition:border-color .25s ease,box-shadow .25s ease" onmouseover="this.style.borderColor='#9DC388';this.style.boxShadow='0 12px 28px -6px rgba(79,107,66,0.16),0 2px 6px rgba(0,0,0,0.04)';this.querySelector('.prin-ghost').style.color='#E2EBDC';this.querySelector('.prin-icon-wrap').style.backgroundColor='#E3EFE0'" onmouseout="this.style.borderColor='#E2E5DF';this.style.boxShadow='0 4px 18px -4px rgba(24,34,22,0.05),0 1px 3px rgba(0,0,0,0.02)';this.querySelector('.prin-ghost').style.color='#F1F4EE';this.querySelector('.prin-icon-wrap').style.backgroundColor='#F1F7EE'">
            <div class="prin-ghost" style="position:absolute;top:8px;right:16px;font-family:var(--font-serif);font-size:52px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none;transition:color .25s ease">03</div>
            
            <div style="display:flex;align-items:center;justify-content:space-between;position:relative;z-index:1">
              <div class="prin-icon-wrap" style="width:48px;height:48px;border-radius:10px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#3E5C32;transition:background-color .25s ease">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg>
              </div>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#4F6B42;background:#F4F8F1;padding:4px 10px;border-radius:20px;border:1px solid #E1EBDC">Step 03</span>
            </div>

            <div style="position:relative;z-index:1;display:flex;flex-direction:column;gap:8px">
              <h3 style="font-family:var(--font-serif);font-size:21px;line-height:1.25;font-weight:400;color:#1A1A1A;margin:0;letter-spacing:-.01em">All paperwork is on us</h3>
              <p style="font-family:var(--font-sans);font-size:14px;line-height:1.65;color:#555550;margin:0">Structural engineer calculations, Building Control submissions, party wall notices and official completion sign-off are fully managed.</p>
            </div>

            <div style="margin-top:auto;padding-top:14px;border-top:1px solid #F0F0EB;display:flex;align-items:center;gap:7px;font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#3E5C32;position:relative;z-index:1">
              <svg viewBox="0 0 16 16" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg>
              <span>Full Building Control sign-off</span>
            </div>
          </div>

          <!-- Principle 04 -->
          <div class="principle-card" style="background:#FFFFFF;border:1px solid #E2E5DF;border-radius:10px;padding:28px 24px 24px;display:flex;flex-direction:column;gap:14px;position:relative;overflow:hidden;box-shadow:0 4px 18px -4px rgba(24,34,22,0.05),0 1px 3px rgba(0,0,0,0.02);transition:border-color .25s ease,box-shadow .25s ease" onmouseover="this.style.borderColor='#9DC388';this.style.boxShadow='0 12px 28px -6px rgba(79,107,66,0.16),0 2px 6px rgba(0,0,0,0.04)';this.querySelector('.prin-ghost').style.color='#E2EBDC';this.querySelector('.prin-icon-wrap').style.backgroundColor='#E3EFE0'" onmouseout="this.style.borderColor='#E2E5DF';this.style.boxShadow='0 4px 18px -4px rgba(24,34,22,0.05),0 1px 3px rgba(0,0,0,0.02)';this.querySelector('.prin-ghost').style.color='#F1F4EE';this.querySelector('.prin-icon-wrap').style.backgroundColor='#F1F7EE'">
            <div class="prin-ghost" style="position:absolute;top:8px;right:16px;font-family:var(--font-serif);font-size:52px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none;transition:color .25s ease">04</div>
            
            <div style="display:flex;align-items:center;justify-content:space-between;position:relative;z-index:1">
              <div class="prin-icon-wrap" style="width:48px;height:48px;border-radius:10px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#3E5C32;transition:background-color .25s ease">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
              </div>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#4F6B42;background:#F4F8F1;padding:4px 10px;border-radius:20px;border:1px solid #E1EBDC">Step 04</span>
            </div>

            <div style="position:relative;z-index:1;display:flex;flex-direction:column;gap:8px">
              <h3 style="font-family:var(--font-serif);font-size:21px;line-height:1.25;font-weight:400;color:#1A1A1A;margin:0;letter-spacing:-.01em">You live comfortably at home</h3>
              <p style="font-family:var(--font-sans);font-size:14px;line-height:1.65;color:#555550;margin:0">Loft access is sealed, heavy materials enter externally via rear scaffold hoist, and the work area is thoroughly cleaned down every single evening.</p>
            </div>

            <div style="margin-top:auto;padding-top:14px;border-top:1px solid #F0F0EB;display:flex;align-items:center;gap:7px;font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#3E5C32;position:relative;z-index:1">
              <svg viewBox="0 0 16 16" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg>
              <span>External scaffold hoist access</span>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Guarantees & Accreditations Section -->
    <section data-reveal aria-labelledby="acc-h" class="section-padding-sm bg-white border-bottom accred-guarantees-section">
      <div class="container accred-guarantees-container">
        <div class="accred-left-col">
          <span class="section-label">Accreditations &amp; Security</span>
          <h2 id="acc-h" class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:12px 0 18px;max-width:20ch">Paperwork you can hand straight to a buyer.</h2>
          <p style="font-size:16px;line-height:1.7;color:#4A4A45;margin:0 0 24px;max-width:48ch;text-wrap:pretty">Every conversion leaves with a building control completion certificate, structural calculations pack, and our 10-year written guarantee. Keep them in your house deeds file &mdash; a surveyor will ask for them when you eventually sell.</p>
          
          <!-- Real Accreditation Logos (3 Prominent Cards) -->
          <div class="accred-logos-grid">
            <div style="background:#FFFFFF;border:1px solid #E2E5DF;border-radius:8px;padding:2px 6px;display:flex;align-items:center;justify-content:center;height:64px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.03)" title="NICEIC Approved Contractor">
              <img src="images/logo-niceic.jpg" alt="NICEIC Approved Contractor" style="max-height:100%;max-width:100%;width:100%;height:100%;object-fit:contain;display:block">
            </div>
            <div style="background:#FF2600;border:1px solid rgba(255,38,0,0.4);border-radius:8px;padding:2px 4px;display:flex;align-items:center;justify-content:center;height:64px;overflow:hidden;box-shadow:0 2px 8px rgba(255,38,0,0.18)" title="VELUX Certified Installer">
              <img src="images/logo-velux.jpg" alt="VELUX Certified Installer" style="max-height:100%;max-width:100%;width:100%;height:100%;object-fit:contain;display:block">
            </div>
            <div style="background:#302A2C;border:1px solid #302A2C;border-radius:8px;padding:2px 4px;display:flex;align-items:center;justify-content:center;height:64px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08)" title="Gas Safe Register">
              <img src="images/logo-gas-safe.jpg" alt="Gas Safe Register" style="max-height:100%;max-width:100%;width:100%;height:100%;object-fit:contain;display:block">
            </div>
          </div>
        </div>

        <ul class="guarantees-list-card">
          <li class="guarantee-item">
            <span class="guar-num">01</span>
            <span class="guar-content">
              <span class="guar-title">Building Control Completion Certificate</span>
              <span class="guar-desc">Filed and arranged by us, issued in your name on day of final handover.</span>
            </span>
          </li>
          <li class="guarantee-item">
            <span class="guar-num">02</span>
            <span class="guar-content">
              <span class="guar-title">10-Year Written Structural Warranty</span>
              <span class="guar-desc">Covers structural timbers, steels, dormer framework, and flat roof membranes.</span>
            </span>
          </li>
          <li class="guarantee-item">
            <span class="guar-num">03</span>
            <span class="guar-content">
              <span class="guar-title">Signed Structural Calculations Pack</span>
              <span class="guar-desc">Independent structural engineer calculations confirming load bearing specs.</span>
            </span>
          </li>
          <li class="guarantee-item">
            <span class="guar-num">04</span>
            <span class="guar-content">
              <span class="guar-title">£5M Public Liability Insurance</span>
              <span class="guar-desc">Comprehensive contractors insurance protecting your property at all stages.</span>
            </span>
          </li>
          <li class="guarantee-item">
            <span class="guar-num">05</span>
            <span class="guar-content">
              <span class="guar-title">Plain-English Fixed-Price Contract</span>
              <span class="guar-desc">No deposit, staged payments against verified completed milestones.</span>
            </span>
          </li>
        </ul>
      </div>
    </section>

    <!-- Property CTA Banner -->
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
        <div style="background:#FFFFFF;color:#1A1A1A;border-radius:3px;padding:clamp(24px,3vw,34px)">
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

  <!-- 41 Service Areas -->
  <?php include 'includes/service-areas.php'; ?>

  <?php include 'includes/booking-modal.php'; ?>
  <?php include 'includes/footer.php'; ?>
