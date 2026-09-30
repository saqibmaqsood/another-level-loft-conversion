<?php
$pageTitle = "Our 6-Year Structural Guarantee & Quality Promise | Another Level";
$pageDesc = "6-year written structural guarantee, 100% dedicated build crew with our one-loft-at-a-time policy, and complete respect for your home. Learn about our guarantee.";
$activePage = "guarantee";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "name" => "Our 6-Year Guarantee & Quality Commitment",
    "description" => "Another Level Loft Conversions provides a 6-year written structural guarantee on all completed works, backed by full Building Control sign-off.",
    "publisher" => [
        "@type" => "Organization",
        "name" => "Another Level Loft Conversions"
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<main>

  <!-- Creative Hero Section -->
  <section class="border-bottom" style="background:#FAF9F5;position:relative;overflow:hidden">
    <div style="max-width:1280px;margin:0 auto;padding:clamp(32px,4.5vw,64px) 20px clamp(40px,5.5vw,72px);display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));gap:clamp(32px,4vw,64px);align-items:center">
      
      <!-- Left: Narrative & Key Guarantees -->
      <div style="display:flex;flex-direction:column;gap:18px">
        
        <!-- Embedded Breadcrumb & Assurance Tag -->
        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
          <nav aria-label="Breadcrumb" class="breadcrumb-inline">
            <a href="index.php">Home</a>
            <span class="crumb-sep">/</span>
            <a href="about.php">About</a>
            <span class="crumb-sep">/</span>
            <span class="crumb-current" aria-current="page">Our Guarantee</span>
          </nav>
          <span style="color:#D4D4CC;font-size:12px">•</span>
          <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 11px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
            <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
            Homeowner Protection Promise
          </span>
        </div>

        <h1 class="heading-h1" style="font-family:var(--font-serif);font-size:clamp(34px,4.8vw,56px);letter-spacing:-.025em;line-height:1.14;font-weight:400;margin:0;color:#1A1A1A">
          Our Guarantee: Total peace of mind, built to last.
        </h1>
        
        <p class="lead-text" style="font-family:var(--font-sans);font-size:clamp(16px,1.8vw,17.5px);color:#4A4A45;line-height:1.7;margin:0;max-width:54ch">
          Inviting tradesmen into your home requires complete trust. That is why we work on only <strong>one loft conversion at a time</strong>, protect your carpets with heavy-duty coverings, and back every steel, joist, and joint with our <strong>10-year written structural guarantee</strong>.
        </p>

        <div class="hero-actions-row" style="margin-top:6px">
          <a href="#booking" data-open-booking class="btn-primary hero-btn">
            <span>Book Free Survey</span>
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
          </a>
          <a href="start-to-finish-how-your-loft-is-built.php" class="btn-secondary hero-btn">See How We Build</a>
        </div>

        <!-- Quick Trust Pill Row -->
        <div class="proc-hero-trust-bullets">
          <span class="proc-trust-bullet"><strong style="color:#3E5C32">✓</strong> 10-Yr Structural Warranty</span>
          <span class="proc-trust-bullet"><strong style="color:#3E5C32">✓</strong> Zero Upfront Deposit</span>
          <span class="proc-trust-bullet"><strong style="color:#3E5C32">✓</strong> 1 Crew · 1 Loft Policy</span>
          <span class="proc-trust-bullet proc-trust-bullet-mobile"><strong style="color:#3E5C32">✓</strong> £5M Public Liability</span>
        </div>
      </div>

      <!-- Right: Creative Assurance Covenant Dashboard Card -->
      <div class="guar-covenant-card">
        
        <!-- Header Badge -->
        <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:18px;margin-bottom:20px;border-bottom:1px solid #EDEDE8">
          <div>
            <span style="font-family:var(--font-sans);font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#4F6B42;display:block;margin-bottom:3px">Quality Covenant</span>
            <h2 style="font-family:var(--font-serif);font-size:22px;margin:0;color:#1A1A1A;font-weight:400">The Another Level Standard</h2>
          </div>
          <span style="width:42px;height:42px;border-radius:50%;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0" title="Certified Guarantee">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#4F6B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              <path d="M9 12l2 2 4-4"/>
            </svg>
          </span>
        </div>

        <!-- 4 Core Guarantee Metric Badges (2x2 Grid) -->
        <div class="guar-metrics-grid">
          
          <div class="guar-metric-badge">
            <span class="guar-metric-val">10 Years</span>
            <strong class="guar-metric-title">Written Warranty</strong>
            <span class="guar-metric-sub">All timbers, steels &amp; roof</span>
          </div>

          <div class="guar-metric-badge">
            <span class="guar-metric-val">&pound;0 Deposit</span>
            <strong class="guar-metric-title">Zero Risk Start</strong>
            <span class="guar-metric-sub">Pay only on milestones</span>
          </div>

          <div class="guar-metric-badge">
            <span class="guar-metric-val">1 Single Crew</span>
            <strong class="guar-metric-title">Dedicated Focus</strong>
            <span class="guar-metric-sub">On your site every day</span>
          </div>

          <div class="guar-metric-badge">
            <span class="guar-metric-val">&pound;5,000,000</span>
            <strong class="guar-metric-title">Public Liability</strong>
            <span class="guar-metric-sub">Comprehensive coverage</span>
          </div>

        </div>

        <!-- Official Sign-Off Checklist -->
        <div style="background:#F1F7EE;border:1px solid #DFEBD9;border-radius:8px;padding:14px 16px;display:flex;flex-direction:column;gap:8px;font-family:var(--font-sans);font-size:12.5px;color:#2C4524">
          <div style="display:flex;align-items:center;gap:8px">
            <span style="color:#4F6B42;font-weight:bold">✓</span>
            <span>Official Local Authority Building Control Certificate</span>
          </div>
          <div style="display:flex;align-items:center;gap:8px">
            <span style="color:#4F6B42;font-weight:bold">✓</span>
            <span>Firestone EPDM 50-Year Flat Roof Rubber Membrane</span>
          </div>
          <div style="display:flex;align-items:center;gap:8px">
            <span style="color:#4F6B42;font-weight:bold">✓</span>
            <span>Certified Part P Electrical &amp; Gas Safe installations</span>
          </div>
        </div>

        <!-- Director Handover Note -->
        <div style="margin-top:16px;padding-top:12px;border-top:1px solid #F0F0EB;display:flex;align-items:center;justify-content:space-between;font-family:var(--font-sans);font-size:12px;color:#70706A">
          <span>Overseen personally by <strong>Jonny Mee</strong></span>
          <span style="color:#4F6B42;font-weight:700">400+ Lofts Completed</span>
        </div>

      </div>

    </div>
  </section>

  <!-- In-Depth Guarantee Details (Creative Safeguards Grid) -->
  <section class="section-padding bg-white border-bottom">
    <div class="container">
      
      <!-- Section Header -->
      <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:44px">
        <div style="max-width:680px">
          <span class="section-label" style="display:inline-flex;align-items:center;gap:6px">
            <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
            Confidence in Craftsmanship
          </span>
          <h2 class="heading-h2" style="font-family:var(--font-serif);font-size:clamp(28px,3.8vw,42px);margin:10px 0 12px;color:#1A1A1A;font-weight:400">
            Why Our Guarantee Gives You Total Confidence
          </h2>
          <p style="font-family:var(--font-sans);font-size:16px;color:#4A4A45;line-height:1.65;margin:0">
            Having major building work in your home can feel daunting. We eliminate every risk with rock-solid warranties, single-crew dedication, and transparent milestone payments.
          </p>
        </div>
        <div class="guar-header-actions" style="display:flex;align-items:center;gap:12px">
          <div class="guar-header-trust-pill" style="display:inline-flex;align-items:center;gap:8px;background:#FAF9F5;border:1px solid #E6E6DF;padding:8px 16px;border-radius:24px;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
            <span>✓ 10-Yr Guarantee</span>
            <span style="color:#D4D4CC">•</span>
            <span>✓ 400+ Lofts Completed</span>
          </div>
          <div class="guar-carousel-nav" aria-label="Carousel navigation">
            <button type="button" class="guar-prev-btn" aria-label="Previous guarantee safeguard">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button type="button" class="guar-next-btn" aria-label="Next guarantee safeguard">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- 6 Creative Feature Cards -->
      <div class="guar-safeguards-grid">
        
        <!-- Card 1: Dedicated Team -->
        <div class="guar-safeguard-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 8px 24px -4px rgba(24,34,22,0.06)'" onmouseout="this.style.borderColor='#E4E4DF';this.style.boxShadow='none'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
              <span style="width:44px;height:44px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#4F6B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                  <circle cx="9" cy="7" r="4"></circle>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
              </span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:12px">
                100% In-House
              </span>
            </div>
            <h3 style="font-family:var(--font-serif);font-size:21px;margin:0 0 10px;color:#1A1A1A;font-weight:400">
              Direct Master Builder, Never Subcontracted Brokers
            </h3>
            <p style="font-family:var(--font-sans);font-size:14.5px;color:#4A4A45;line-height:1.65;margin:0 0 16px">
              Another Level is an independent, family-run company. The person who visits your home for the initial survey is Jonny Mee, who personally oversees your build schedule and on-site craftsmen.
            </p>
          </div>
          <div style="border-top:1px solid #EBEBE6;padding-top:12px;font-family:var(--font-sans);font-size:12.5px;color:#4F6B42;font-weight:600">
            ✓ Single point of contact from day one
          </div>
        </div>

        <!-- Card 2: EPDM Roof -->
        <div class="guar-safeguard-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 8px 24px -4px rgba(24,34,22,0.06)'" onmouseout="this.style.borderColor='#E4E4DF';this.style.boxShadow='none'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
              <span style="width:44px;height:44px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#4F6B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
              </span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:12px">
                50-Yr Lifespan
              </span>
            </div>
            <h3 style="font-family:var(--font-serif);font-size:21px;margin:0 0 10px;color:#1A1A1A;font-weight:400">
              Firestone RubberCover™ EPDM Membrane
            </h3>
            <p style="font-family:var(--font-sans);font-size:14.5px;color:#4A4A45;line-height:1.65;margin:0 0 16px">
              We never use traditional hot felt or bitumen that cracks under weather. All flat dormer roofs are sealed with seamless single-sheet Firestone EPDM rubber, offering exceptional UV resistance and 50+ years durability.
            </p>
          </div>
          <div style="border-top:1px solid #EBEBE6;padding-top:12px;font-family:var(--font-sans);font-size:12.5px;color:#4F6B42;font-weight:600">
            ✓ 100% seamless watertight protection
          </div>
        </div>

        <!-- Card 3: Direct Communication -->
        <div class="guar-safeguard-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 8px 24px -4px rgba(24,34,22,0.06)'" onmouseout="this.style.borderColor='#E4E4DF';this.style.boxShadow='none'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
              <span style="width:44px;height:44px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#4F6B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
              </span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:12px">
                Direct Line
              </span>
            </div>
            <h3 style="font-family:var(--font-serif);font-size:21px;margin:0 0 10px;color:#1A1A1A;font-weight:400">
              Daily Communication &amp; Live Project Updates
            </h3>
            <p style="font-family:var(--font-sans);font-size:14.5px;color:#4A4A45;line-height:1.65;margin:0 0 16px">
              You get a direct phone number to our lead build manager throughout the conversion. Need to adjust a socket position or review stair rail finish? You speak directly with the team working in your roof.
            </p>
          </div>
          <div style="border-top:1px solid #EBEBE6;padding-top:12px;font-family:var(--font-sans);font-size:12.5px;color:#4F6B42;font-weight:600">
            ✓ Zero call centres or third-party gatekeepers
          </div>
        </div>

        <!-- Card 4: Zero Deposit -->
        <div class="guar-safeguard-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 8px 24px -4px rgba(24,34,22,0.06)'" onmouseout="this.style.borderColor='#E4E4DF';this.style.boxShadow='none'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
              <span style="width:44px;height:44px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#4F6B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                  <line x1="12" y1="8" x2="12" y2="12"></line>
                  <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
              </span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:12px">
                Zero Upfront Risk
              </span>
            </div>
            <h3 style="font-family:var(--font-serif);font-size:21px;margin:0 0 10px;color:#1A1A1A;font-weight:400">
              Zero Upfront Deposit &amp; Milestone Payments
            </h3>
            <p style="font-family:var(--font-sans);font-size:14.5px;color:#4A4A45;line-height:1.65;margin:0 0 16px">
              You never pay upfront for work not yet delivered. Our structured payment schedule is linked to real on-site milestones &mdash; you only pay when steels are placed, dormer is watertight, and plaster is completed.
            </p>
          </div>
          <div style="border-top:1px solid #EBEBE6;padding-top:12px;font-family:var(--font-sans);font-size:12.5px;color:#4F6B42;font-weight:600">
            ✓ Fixed written quotation with no hidden extras
          </div>
        </div>

        <!-- Card 5: £5M Insurance -->
        <div class="guar-safeguard-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 8px 24px -4px rgba(24,34,22,0.06)'" onmouseout="this.style.borderColor='#E4E4DF';this.style.boxShadow='none'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
              <span style="width:44px;height:44px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#4F6B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                  <line x1="12" y1="8" x2="12" y2="12"></line>
                  <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
              </span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:12px">
                &pound;5,000,000
              </span>
            </div>
            <h3 style="font-family:var(--font-serif);font-size:21px;margin:0 0 10px;color:#1A1A1A;font-weight:400">
              Full Public &amp; Employer Liability Cover
            </h3>
            <p style="font-family:var(--font-sans);font-size:14.5px;color:#4A4A45;line-height:1.65;margin:0 0 16px">
              We hold comprehensive public liability insurance coverage up to £5,000,000. Your home, boundary walls, neighbouring properties, and team members are completely protected from the first scaffold pole.
            </p>
          </div>
          <div style="border-top:1px solid #EBEBE6;padding-top:12px;font-family:var(--font-sans);font-size:12.5px;color:#4F6B42;font-weight:600">
            ✓ Total financial and legal protection
          </div>
        </div>

        <!-- Card 6: Aftercare -->
        <div class="guar-safeguard-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 8px 24px -4px rgba(24,34,22,0.06)'" onmouseout="this.style.borderColor='#E4E4DF';this.style.boxShadow='none'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
              <span style="width:44px;height:44px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#4F6B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
              </span>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:12px">
                Lifetime Care
              </span>
            </div>
            <h3 style="font-family:var(--font-serif);font-size:21px;margin:0 0 10px;color:#1A1A1A;font-weight:400">
              Dedicated Aftercare &amp; Seasonal Timber Tuning
            </h3>
            <p style="font-family:var(--font-sans);font-size:14.5px;color:#4A4A45;line-height:1.65;margin:0 0 16px">
              Our relationship does not end on completion day. If you notice seasonal timber settlement, need door adjustments, or have questions months later, our aftercare team is always just a phone call away.
            </p>
          </div>
          <div style="border-top:1px solid #EBEBE6;padding-top:12px;font-family:var(--font-sans);font-size:12.5px;color:#4F6B42;font-weight:600">
            ✓ 10-Year written certificate presented at handover
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Real Finished Projects Under Guarantee (Architectural Showcase) -->
  <section class="section-padding bg-light border-bottom">
    <div class="container">
      
      <!-- Section Header -->
      <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:40px">
        <div style="max-width:680px">
          <span class="section-label" style="display:inline-flex;align-items:center;gap:6px">
            <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
            Verified Workmanship
          </span>
          <h2 class="heading-h2" style="font-family:var(--font-serif);font-size:clamp(28px,3.8vw,42px);margin:10px 0 12px;color:#1A1A1A;font-weight:400">
            Real Conversions, Backed by Our 10-Year Guarantee
          </h2>
          <p style="font-family:var(--font-sans);font-size:16px;color:#4A4A45;line-height:1.65;margin:0">
            Every project below was surveyed, engineered, and built by our permanent crew to strict UK Building Regulations standards &mdash; signed off with full legal completion certificates.
          </p>
        </div>
        <div class="guar-showcase-actions" style="display:flex;align-items:center;gap:12px">
          <a href="gallery.php" class="btn-secondary guar-gallery-btn" style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;font-size:14px">
            <span>View Full 40+ Project Gallery</span>
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <div class="showcase-carousel-nav" aria-label="Carousel navigation">
            <button type="button" class="showcase-prev-btn" aria-label="Previous project showcase">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button type="button" class="showcase-next-btn" aria-label="Next project showcase">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- 4 Architectural Showcase Cards -->
      <div class="guar-showcase-grid">
        
        <!-- Project 1 -->
        <div class="guar-showcase-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 6px 20px -4px rgba(24,34,22,0.07)'" onmouseout="this.style.borderColor='#E2E5DF';this.style.boxShadow='0 2px 10px rgba(0,0,0,0.03)'">
          <div>
            <div style="position:relative;overflow:hidden;aspect-ratio:16/10">
              <img src="images/another-area-loft-conversions-north-west-england-01.jpeg" alt="Master Bedroom &amp; En-Suite Dormer" style="width:100%;height:100%;object-fit:cover;display:block" loading="lazy">
              <span style="position:absolute;top:10px;left:10px;background:rgba(26,36,24,0.85);color:#FFFFFF;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.04em;text-transform:uppercase">
                Rear Dormer
              </span>
              <span style="position:absolute;top:10px;right:10px;background:rgba(255,255,255,0.92);color:#2A2A28;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:11px;font-weight:600">
                📍 Bolton
              </span>
            </div>
            <div style="padding:20px 20px 0">
              <h3 style="font-family:var(--font-serif);font-size:19px;line-height:1.25;margin:0 0 8px;color:#1A1A1A;font-weight:400">
                Master Bedroom &amp; En-Suite Dormer
              </h3>
              <p style="font-family:var(--font-sans);font-size:13.5px;color:#555550;line-height:1.6;margin:0 0 16px">
                Full structural steel framework, bespoke matching staircase, and Firestone EPDM rubber roof.
              </p>
            </div>
          </div>
          <div style="padding:0 20px 18px">
            <div style="background:#F1F7EE;border:1px solid #DFEBD9;border-radius:8px;padding:8px 12px;display:flex;align-items:center;justify-content:space-between;font-family:var(--font-sans);font-size:11.5px;font-weight:700;color:#3E5C32">
              <span>✓ 10-Yr Warranty</span>
              <span style="color:#6B8E5A">•</span>
              <span>Regs Approved</span>
            </div>
          </div>
        </div>

        <!-- Project 2 -->
        <div class="guar-showcase-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 6px 20px -4px rgba(24,34,22,0.07)'" onmouseout="this.style.borderColor='#E2E5DF';this.style.boxShadow='0 2px 10px rgba(0,0,0,0.03)'">
          <div>
            <div style="position:relative;overflow:hidden;aspect-ratio:16/10">
              <img src="images/another-area-loft-conversions-north-west-england-02.jpeg" alt="Side Elevation Hip-to-Gable Extension" style="width:100%;height:100%;object-fit:cover;display:block" loading="lazy">
              <span style="position:absolute;top:10px;left:10px;background:rgba(26,36,24,0.85);color:#FFFFFF;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.04em;text-transform:uppercase">
                Hip-to-Gable
              </span>
              <span style="position:absolute;top:10px;right:10px;background:rgba(255,255,255,0.92);color:#2A2A28;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:11px;font-weight:600">
                📍 Stockport
              </span>
            </div>
            <div style="padding:20px 20px 0">
              <h3 style="font-family:var(--font-serif);font-size:19px;line-height:1.25;margin:0 0 8px;color:#1A1A1A;font-weight:400">
                Side Elevation Hip-to-Gable Extension
              </h3>
              <p style="font-family:var(--font-sans);font-size:13.5px;color:#555550;line-height:1.6;margin:0 0 16px">
                Sloping roof converted to vertical brick gable with matched masonry and double rear dormer.
              </p>
            </div>
          </div>
          <div style="padding:0 20px 18px">
            <div style="background:#F1F7EE;border:1px solid #DFEBD9;border-radius:8px;padding:8px 12px;display:flex;align-items:center;justify-content:space-between;font-family:var(--font-sans);font-size:11.5px;font-weight:700;color:#3E5C32">
              <span>✓ 10-Yr Warranty</span>
              <span style="color:#6B8E5A">•</span>
              <span>Regs Approved</span>
            </div>
          </div>
        </div>

        <!-- Project 3 -->
        <div class="guar-showcase-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 6px 20px -4px rgba(24,34,22,0.07)'" onmouseout="this.style.borderColor='#E2E5DF';this.style.boxShadow='0 2px 10px rgba(0,0,0,0.03)'">
          <div>
            <div style="position:relative;overflow:hidden;aspect-ratio:16/10">
              <img src="images/another-area-loft-conversions-north-west-england-03.jpeg" alt="Velux Roof Light Conversion" style="width:100%;height:100%;object-fit:cover;display:block" loading="lazy">
              <span style="position:absolute;top:10px;left:10px;background:rgba(26,36,24,0.85);color:#FFFFFF;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.04em;text-transform:uppercase">
                Velux Suite
              </span>
              <span style="position:absolute;top:10px;right:10px;background:rgba(255,255,255,0.92);color:#2A2A28;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:11px;font-weight:600">
                📍 Preston
              </span>
            </div>
            <div style="padding:20px 20px 0">
              <h3 style="font-family:var(--font-serif);font-size:19px;line-height:1.25;margin:0 0 8px;color:#1A1A1A;font-weight:400">
                High-Performance Velux Studio &amp; Office
              </h3>
              <p style="font-family:var(--font-sans);font-size:13.5px;color:#555550;line-height:1.6;margin:0 0 16px">
                Celotex rigid insulation throughout, integrated eaves storage, and solar-reflective roof windows.
              </p>
            </div>
          </div>
          <div style="padding:0 20px 18px">
            <div style="background:#F1F7EE;border:1px solid #DFEBD9;border-radius:8px;padding:8px 12px;display:flex;align-items:center;justify-content:space-between;font-family:var(--font-sans);font-size:11.5px;font-weight:700;color:#3E5C32">
              <span>✓ 10-Yr Warranty</span>
              <span style="color:#6B8E5A">•</span>
              <span>Regs Approved</span>
            </div>
          </div>
        </div>

        <!-- Project 4 -->
        <div class="guar-showcase-card" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 6px 20px -4px rgba(24,34,22,0.07)'" onmouseout="this.style.borderColor='#E2E5DF';this.style.boxShadow='0 2px 10px rgba(0,0,0,0.03)'">
          <div>
            <div style="position:relative;overflow:hidden;aspect-ratio:16/10">
              <img src="images/another-area-loft-conversions-north-west-england-04.jpeg" alt="Traditional Tile-Hung Luxury Suite" style="width:100%;height:100%;object-fit:cover;display:block" loading="lazy">
              <span style="position:absolute;top:10px;left:10px;background:rgba(26,36,24,0.85);color:#FFFFFF;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.04em;text-transform:uppercase">
                Tile-Hung Dormer
              </span>
              <span style="position:absolute;top:10px;right:10px;background:rgba(255,255,255,0.92);color:#2A2A28;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:11px;font-weight:600">
                📍 Didsbury
              </span>
            </div>
            <div style="padding:20px 20px 0">
              <h3 style="font-family:var(--font-serif);font-size:19px;line-height:1.25;margin:0 0 8px;color:#1A1A1A;font-weight:400">
                Traditional Tile-Hung Luxury Suite
              </h3>
              <p style="font-family:var(--font-sans);font-size:13.5px;color:#555550;line-height:1.6;margin:0 0 16px">
                Hand-hung roof tiles matching original property exterior, LED lighting, and FD30 fire doors.
              </p>
            </div>
          </div>
          <div style="padding:0 20px 18px">
            <div style="background:#F1F7EE;border:1px solid #DFEBD9;border-radius:8px;padding:8px 12px;display:flex;align-items:center;justify-content:space-between;font-family:var(--font-sans);font-size:11.5px;font-weight:700;color:#3E5C32">
              <span>✓ 10-Yr Warranty</span>
              <span style="color:#6B8E5A">•</span>
              <span>Regs Approved</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

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

  <!-- Service Areas Section -->
  <?php include 'includes/service-areas.php'; ?>
</main>

<?php 
include 'includes/booking-modal.php';
include 'includes/footer.php'; 
?>
