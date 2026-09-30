<?php
$pageTitle = "Start To Finish — How Your Loft Conversion Is Built | Another Level";
$pageDesc = "From initial CAD design and building control approval to steel beams, bespoke stairs and 6-year guarantee sign-off. See our 8-step build process.";
$activePage = "start-to-finish";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "HowTo",
    "name" => "How a Loft Conversion Is Built from Start to Finish",
    "description" => "A step-by-step guide to the loft conversion process by Another Level Loft Conversions.",
    "step" => [
        ["@type" => "HowToStep", "name" => "Initial Survey & Free CAD Design", "text" => "Free home visit to measure headroom, assess roof trusses, and produce 3D CAD drawings."],
        ["@type" => "HowToStep", "name" => "Planning & Building Regulations", "text" => "Full structural engineering calculations and Building Control submissions handled for you."],
        ["@type" => "HowToStep", "name" => "Structural Steel & Floor Joists", "text" => "Steel beams installed above existing ceilings to support independent new floor joists."],
        ["@type" => "HowToStep", "name" => "Roof Work & Dormer Construction", "text" => "Dormer construction with Firestone EPDM rubber roof or Velux rooflight installation."],
        ["@type" => "HowToStep", "name" => "Bespoke Staircase Installation", "text" => "Precision-manufactured staircase aligned with existing flights for seamless flow."],
        ["@type" => "HowToStep", "name" => "Insulation, Electrics & Plumbing", "text" => "Rigid insulation, Part P certified electrical wiring, and en-suite plumbing."],
        ["@type" => "HowToStep", "name" => "Plastering & Internal Joinery", "text" => "Smooth multi-finish plastering, skirting, architraves, and fire doors."],
        ["@type" => "HowToStep", "name" => "Final Sign-off & 6-Year Guarantee", "text" => "Building Control completion certificate issued with 6-year written structural guarantee."]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<main>

  <!-- Hero Section with Embedded Creative Breadcrumb -->
  <section class="border-bottom" style="background:#FAF9F5">
    <div class="container" style="max-width:1280px;margin:0 auto;padding:clamp(28px,4vw,56px) 20px clamp(36px,5vw,64px);display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:clamp(32px,5vw,64px);align-items:center">
      <div style="display:flex;flex-direction:column;gap:18px">
        
        <!-- Embedded Breadcrumb & Process Badge -->
        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
          <nav aria-label="Breadcrumb" style="font-family:var(--font-sans);font-size:12.5px;color:#7A7A72;display:inline-flex;align-items:center;gap:6px">
            <a href="index.php" style="color:#66665E;text-decoration:none;transition:color .2s ease" onmouseover="this.style.color='#3E5C32'" onmouseout="this.style.color='#66665E'">Home</a>
            <span style="color:#C4C4BC;font-size:11px">/</span>
            <a href="about.php" style="color:#66665E;text-decoration:none;transition:color .2s ease" onmouseover="this.style.color='#3E5C32'" onmouseout="this.style.color='#66665E'">About</a>
            <span style="color:#C4C4BC;font-size:11px">/</span>
            <span style="color:#2E4A22;font-weight:600" aria-current="page">Start To Finish</span>
          </nav>

          <span style="color:#D4D4CC;font-size:12px">•</span>

          <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 10px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
            <span style="width:5px;height:5px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
            8-Stage Process
          </span>
        </div>
        
        <h1 class="heading-h1" style="font-family:var(--font-serif);font-size:clamp(34px,4.6vw,56px);letter-spacing:-.02em;line-height:1.15;color:#1A1A1A;font-weight:400;margin:0">
          How your loft is built &mdash; from first sketch to final sign-off.
        </h1>
        
        <p class="lead-text" style="font-family:var(--font-sans);font-size:16.5px;line-height:1.7;color:#4A4A45;max-width:54ch;margin:0">
          Have you ever wondered how a loft conversion is actually constructed? We manage every phase in-house &mdash; architectural CAD drawings, structural steels, Building Control inspections, and bespoke joinery. No guesswork, no subcontracted strangers.
        </p>
        
        <div class="hero-actions-row" style="margin-top:4px">
          <a href="#booking" data-open-booking class="btn-primary hero-btn">
            <span>Book Free Survey</span>
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"></path></svg>
          </a>
          <a href="guarantee.php" class="btn-secondary hero-btn"><span class="hide-mobile">Read Our </span>10-Year Guarantee</a>
        </div>

        <div class="proc-hero-trust-bullets">
          <span class="proc-trust-bullet"><strong style="color:#3E5C32">✓</strong> 3–6 Weeks Typical Build</span>
          <span class="proc-trust-bullet"><strong style="color:#3E5C32">✓</strong> 100% In-House Craftsmen</span>
          <span class="proc-trust-bullet"><strong style="color:#3E5C32">✓</strong> Zero Deposit Required</span>
          <span class="proc-trust-bullet proc-trust-bullet-mobile"><strong style="color:#3E5C32">✓</strong> 10-Year Guarantee</span>
        </div>
      </div>

      <!-- Right Creative Process Assurance Card -->
      <div style="border:1px solid #E2E5DF;border-radius:12px;background:#FFFFFF;padding:26px 26px 22px;box-shadow:0 16px 36px -10px rgba(24,34,22,0.08),0 2px 6px rgba(0,0,0,0.02);display:flex;flex-direction:column;gap:16px">
        <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:12px;border-bottom:1px solid #F0F0EB">
          <span style="font-family:var(--font-sans);font-size:11.5px;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;font-weight:700;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 10px;border-radius:14px">Why Our Process Works</span>
          <span style="font-family:var(--font-sans);font-size:12px;color:#7A7A72;font-weight:600">Guaranteed Standards</span>
        </div>

        <ul style="list-style:none;margin:0;padding:0;display:grid;gap:10px">
          <li style="display:flex;gap:14px;align-items:flex-start;padding:10px 12px;border-radius:8px;transition:background-color .2s ease" onmouseover="this.style.backgroundColor='#F7FAF5'" onmouseout="this.style.backgroundColor='transparent'">
            <div style="width:36px;height:36px;border-radius:8px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#3E5C32;flex-shrink:0;margin-top:2px">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div style="font-family:var(--font-sans);font-size:14px;line-height:1.55;color:#4A4A45">
              <strong style="color:#1A1A1A;font-weight:600;display:block">One project at a time</strong>
              100% dedicated build crew on your site daily until completion.
            </div>
          </li>

          <li style="display:flex;gap:14px;align-items:flex-start;padding:10px 12px;border-radius:8px;transition:background-color .2s ease" onmouseover="this.style.backgroundColor='#F7FAF5'" onmouseout="this.style.backgroundColor='transparent'">
            <div style="width:36px;height:36px;border-radius:8px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#3E5C32;flex-shrink:0;margin-top:2px">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </div>
            <div style="font-family:var(--font-sans);font-size:14px;line-height:1.55;color:#4A4A45">
              <strong style="color:#1A1A1A;font-weight:600;display:block">Fixed-price written quotation</strong>
              No hidden extras for steels, scaffolding or building control fees.
            </div>
          </li>

          <li style="display:flex;gap:14px;align-items:flex-start;padding:10px 12px;border-radius:8px;transition:background-color .2s ease" onmouseover="this.style.backgroundColor='#F7FAF5'" onmouseout="this.style.backgroundColor='transparent'">
            <div style="width:36px;height:36px;border-radius:8px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#3E5C32;flex-shrink:0;margin-top:2px">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
            </div>
            <div style="font-family:var(--font-sans);font-size:14px;line-height:1.55;color:#4A4A45">
              <strong style="color:#1A1A1A;font-weight:600;display:block">Zero deposit required</strong>
              Staged payment schedule tied to verified build milestones.
            </div>
          </li>

          <li style="display:flex;gap:14px;align-items:flex-start;padding:10px 12px;border-radius:8px;transition:background-color .2s ease" onmouseover="this.style.backgroundColor='#F7FAF5'" onmouseout="this.style.backgroundColor='transparent'">
            <div style="width:36px;height:36px;border-radius:8px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#3E5C32;flex-shrink:0;margin-top:2px">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg>
            </div>
            <div style="font-family:var(--font-sans);font-size:14px;line-height:1.55;color:#4A4A45">
              <strong style="color:#1A1A1A;font-weight:600;display:block">Full Building Control certification</strong>
              Officially signed off and registered with Land Registry.
            </div>
          </li>
        </ul>

        <div style="margin-top:4px;padding-top:14px;border-top:1px solid #F0F0EB;display:flex;align-items:center;justify-content:space-between;font-family:var(--font-sans);font-size:12.5px;color:#3E5C32;font-weight:600">
          <span style="display:inline-flex;align-items:center;gap:6px">
            <svg viewBox="0 0 16 16" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg>
            10-Year Written Guarantee
          </span>
          <a href="guarantee.php" style="color:#4F6B42;text-decoration:none;font-weight:600">Learn more &rarr;</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Step by Step Timeline -->
  <section class="section-padding bg-white border-bottom" id="build-timeline">
    <div class="container" style="max-width:1280px">
      
    <!-- Section Header -->
    <div class="timeline-header-wrap" style="display:flex;flex-wrap:wrap;gap:20px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:36px">
      <div style="max-width:720px">
        <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:7px;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 12px;border-radius:20px;color:#3E5C32;font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;margin-bottom:12px">
          <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
          Interactive Build Roadmap
        </span>
        <h2 class="heading-h2" style="font-size:clamp(28px,4vw,44px);margin:0 0 12px;color:#1A1A1A;font-weight:400">The 8 Stages of Your Loft Conversion</h2>
        <p style="font-family:var(--font-sans);font-size:16px;color:#555550;line-height:1.6;margin:0">
          Click any stage below to inspect the architectural process, trade milestones, and real on-site photography from start to handover.
        </p>
      </div>

      <!-- Overall Progress Indicator with Next / Previous Stage Buttons -->
      <div class="timeline-duration-box" style="background:#FAF9F5;border:1px solid #EAEAE5;padding:10px 14px;border-radius:10px;display:flex;align-items:center;justify-content:space-between;gap:14px;font-family:var(--font-sans)">
        <div style="display:flex;align-items:center;gap:10px">
          <div style="width:36px;height:36px;border-radius:50%;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#3E5C32;font-weight:700;font-size:13px;flex-shrink:0" id="progress-circle">
            1/8
          </div>
          <div>
            <span style="font-size:10.5px;letter-spacing:.06em;text-transform:uppercase;color:#7A7A72;font-weight:700;display:block;line-height:1.2">Typical Build Duration</span>
            <span style="font-size:13.5px;color:#1A1A1A;font-weight:600;line-height:1.2">3 to 6 Weeks on site</span>
          </div>
        </div>

        <!-- Prev / Next Stage Buttons -->
        <div class="timeline-nav-controls" style="display:flex;align-items:center;gap:6px">
          <button type="button" onclick="navigateStage(-1)" aria-label="Previous Stage" class="timeline-ctrl-btn" style="width:34px;height:34px;border-radius:8px;background:#FFFFFF;border:1px solid #DFE5DC;display:inline-flex;align-items:center;justify-content:center;color:#3E5C32;cursor:pointer;transition:all .2s ease" onmouseover="this.style.borderColor='#4F6B42';this.style.backgroundColor='#F1F7EE'" onmouseout="this.style.borderColor='#DFE5DC';this.style.backgroundColor='#FFFFFF'">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
          </button>
          <button type="button" onclick="navigateStage(1)" aria-label="Next Stage" class="timeline-ctrl-btn" style="width:34px;height:34px;border-radius:8px;background:#FFFFFF;border:1px solid #DFE5DC;display:inline-flex;align-items:center;justify-content:center;color:#3E5C32;cursor:pointer;transition:all .2s ease" onmouseover="this.style.borderColor='#4F6B42';this.style.backgroundColor='#F1F7EE'" onmouseout="this.style.borderColor='#DFE5DC';this.style.backgroundColor='#FFFFFF'">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </button>
        </div>
      </div>
    </div>

    <style>
      .timeline-nav-controls {
        display: none !important;
      }
      .timeline-master-grid {
        display: grid;
        grid-template-columns: minmax(320px, 390px) 1fr;
        gap: 28px;
        align-items: stretch;
      }
      #stage-nav-rail {
        display: flex;
        flex-direction: column;
        gap: 8px;
        height: 100%;
        justify-content: space-between;
      }
      .stage-nav-btn {
        flex: 1 1 0;
        min-height: 52px;
        text-align: left;
        border-radius: 10px;
        padding: 10px 16px;
        cursor: pointer;
        transition: all .2s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
      }
      .stage-panel {
        min-height: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }

      /* Mobile Optimizations for 8 Stages */
      @media (max-width: 880px) {
        .timeline-nav-controls {
          display: flex !important;
          align-items: center;
          gap: 6px;
        }
        .timeline-header-wrap {
          flex-direction: column;
          align-items: flex-start !important;
          gap: 16px !important;
          margin-bottom: 20px !important;
        }
        .timeline-duration-box {
          width: 100%;
          justify-content: space-between !important;
          padding: 10px 14px !important;
          box-sizing: border-box !important;
        }
        .timeline-master-grid {
          grid-template-columns: 1fr;
          gap: 14px;
        }
        #stage-nav-rail {
          display: flex;
          flex-direction: row;
          overflow-x: auto;
          scroll-snap-type: x mandatory;
          gap: 8px;
          padding: 2px 0 10px 0;
          margin: 0;
          -webkit-overflow-scrolling: touch;
          scrollbar-width: none;
        }
        #stage-nav-rail::-webkit-scrollbar {
          display: none;
        }
        .stage-nav-btn {
          flex: 0 0 auto;
          scroll-snap-align: start;
          min-height: 42px;
          padding: 8px 14px;
          border-radius: 22px;
          gap: 8px;
        }
        .stage-nav-btn .stage-arrow {
          display: none !important;
        }
        .stage-nav-btn .stage-sub {
          display: none !important;
        }
        .stage-nav-btn strong {
          font-size: 13px !important;
          white-space: nowrap;
        }
        .stage-nav-btn .stage-num-badge {
          width: 24px !important;
          height: 24px !important;
          font-size: 11px !important;
          border-radius: 6px !important;
        }
        .stage-panel {
          padding: 20px 16px !important;
          border-radius: 12px !important;
        }
        .stage-panel h3 {
          font-size: clamp(20px, 5.5vw, 24px) !important;
          line-height: 1.25 !important;
        }
        .stage-panel p {
          font-size: 14.5px !important;
          line-height: 1.65 !important;
        }
      }
    </style>

    <!-- Master-Detail Interactive Grid (Fills Full 1280px Container & Balanced Heights) -->
    <div class="timeline-master-grid">
      
      <!-- Left: 8-Stage Interactive List Rail (Equal Height Distribution) -->
      <div id="stage-nav-rail" role="tablist" aria-label="Loft conversion build stages">
        
        <!-- Stage 1 Button -->
        <button type="button" role="tab" aria-selected="true" aria-controls="panel-1" id="tab-1" onclick="switchStage(1)" class="stage-nav-btn active" style="background:#F1F7EE;border:1.5px solid #4F6B42">
          <div style="display:flex;align-items:center;gap:12px">
            <span class="stage-num-badge" style="font-family:var(--font-sans);font-size:13px;font-weight:800;color:#FFFFFF;background:#4F6B42;width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">01</span>
            <div class="stage-title-wrap">
              <strong style="font-family:var(--font-sans);font-size:14px;color:#1A1A1A;display:block;font-weight:700">Initial Survey &amp; 3D CAD</strong>
              <span class="stage-sub" style="font-family:var(--font-sans);font-size:11.5px;color:#4F6B42;font-weight:500">Days 1–3 &middot; Feasibility &amp; Quote</span>
            </div>
          </div>
          <span class="stage-arrow" style="color:#4F6B42;font-size:16px;font-weight:bold">&rarr;</span>
        </button>

        <!-- Stage 2 Button -->
        <button type="button" role="tab" aria-selected="false" aria-controls="panel-2" id="tab-2" onclick="switchStage(2)" class="stage-nav-btn" style="background:#FFFFFF;border:1px solid #E2E5DF" onmouseover="if(!this.classList.contains('active'))this.style.borderColor='#9DC388'" onmouseout="if(!this.classList.contains('active'))this.style.borderColor='#E2E5DF'">
          <div style="display:flex;align-items:center;gap:12px">
            <span class="stage-num-badge" style="font-family:var(--font-sans);font-size:13px;font-weight:700;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">02</span>
            <div class="stage-title-wrap">
              <strong style="font-family:var(--font-sans);font-size:14px;color:#1A1A1A;display:block;font-weight:600">Architectural Plans &amp; PD Check</strong>
              <span class="stage-sub" style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65;font-weight:500">Week 1–2 &middot; Construction Drawings</span>
            </div>
          </div>
          <span class="stage-arrow" style="color:#A0A09A;font-size:16px">&rarr;</span>
        </button>

        <!-- Stage 3 Button -->
        <button type="button" role="tab" aria-selected="false" aria-controls="panel-3" id="tab-3" onclick="switchStage(3)" class="stage-nav-btn" style="background:#FFFFFF;border:1px solid #E2E5DF" onmouseover="if(!this.classList.contains('active'))this.style.borderColor='#9DC388'" onmouseout="if(!this.classList.contains('active'))this.style.borderColor='#E2E5DF'">
          <div style="display:flex;align-items:center;gap:12px">
            <span class="stage-num-badge" style="font-family:var(--font-sans);font-size:13px;font-weight:700;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">03</span>
            <div class="stage-title-wrap">
              <strong style="font-family:var(--font-sans);font-size:14px;color:#1A1A1A;display:block;font-weight:600">Structural Engineering &amp; Regs</strong>
              <span class="stage-sub" style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65;font-weight:500">Pre-Start &middot; Steel Load Calculations</span>
            </div>
          </div>
          <span class="stage-arrow" style="color:#A0A09A;font-size:16px">&rarr;</span>
        </button>

        <!-- Stage 4 Button -->
        <button type="button" role="tab" aria-selected="false" aria-controls="panel-4" id="tab-4" onclick="switchStage(4)" class="stage-nav-btn" style="background:#FFFFFF;border:1px solid #E2E5DF" onmouseover="if(!this.classList.contains('active'))this.style.borderColor='#9DC388'" onmouseout="if(!this.classList.contains('active'))this.style.borderColor='#E2E5DF'">
          <div style="display:flex;align-items:center;gap:12px">
            <span class="stage-num-badge" style="font-family:var(--font-sans);font-size:13px;font-weight:700;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">04</span>
            <div class="stage-title-wrap">
              <strong style="font-family:var(--font-sans);font-size:14px;color:#1A1A1A;display:block;font-weight:600">Scaffolding, Steels &amp; Floor Joists</strong>
              <span class="stage-sub" style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65;font-weight:500">Week 1 On Site &middot; External Hoist</span>
            </div>
          </div>
          <span class="stage-arrow" style="color:#A0A09A;font-size:16px">&rarr;</span>
        </button>

        <!-- Stage 5 Button -->
        <button type="button" role="tab" aria-selected="false" aria-controls="panel-5" id="tab-5" onclick="switchStage(5)" class="stage-nav-btn" style="background:#FFFFFF;border:1px solid #E2E5DF" onmouseover="if(!this.classList.contains('active'))this.style.borderColor='#9DC388'" onmouseout="if(!this.classList.contains('active'))this.style.borderColor='#E2E5DF'">
          <div style="display:flex;align-items:center;gap:12px">
            <span class="stage-num-badge" style="font-family:var(--font-sans);font-size:13px;font-weight:700;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">05</span>
            <div class="stage-title-wrap">
              <strong style="font-family:var(--font-sans);font-size:14px;color:#1A1A1A;display:block;font-weight:600">Dormer Framing &amp; Velux Windows</strong>
              <span class="stage-sub" style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65;font-weight:500">Week 2 &middot; EPDM Rubber Weatherproofing</span>
            </div>
          </div>
          <span class="stage-arrow" style="color:#A0A09A;font-size:16px">&rarr;</span>
        </button>

        <!-- Stage 6 Button -->
        <button type="button" role="tab" aria-selected="false" aria-controls="panel-6" id="tab-6" onclick="switchStage(6)" class="stage-nav-btn" style="background:#FFFFFF;border:1px solid #E2E5DF" onmouseover="if(!this.classList.contains('active'))this.style.borderColor='#9DC388'" onmouseout="if(!this.classList.contains('active'))this.style.borderColor='#E2E5DF'">
          <div style="display:flex;align-items:center;gap:12px">
            <span class="stage-num-badge" style="font-family:var(--font-sans);font-size:13px;font-weight:700;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">06</span>
            <div class="stage-title-wrap">
              <strong style="font-family:var(--font-sans);font-size:14px;color:#1A1A1A;display:block;font-weight:600">Bespoke Staircase Installation</strong>
              <span class="stage-sub" style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65;font-weight:500">Week 2–3 &middot; Matched Joinery &amp; 2.0m Headroom</span>
            </div>
          </div>
          <span class="stage-arrow" style="color:#A0A09A;font-size:16px">&rarr;</span>
        </button>

        <!-- Stage 7 Button -->
        <button type="button" role="tab" aria-selected="false" aria-controls="panel-7" id="tab-7" onclick="switchStage(7)" class="stage-nav-btn" style="background:#FFFFFF;border:1px solid #E2E5DF" onmouseover="if(!this.classList.contains('active'))this.style.borderColor='#9DC388'" onmouseout="if(!this.classList.contains('active'))this.style.borderColor='#E2E5DF'">
          <div style="display:flex;align-items:center;gap:12px">
            <span class="stage-num-badge" style="font-family:var(--font-sans);font-size:13px;font-weight:700;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">07</span>
            <div class="stage-title-wrap">
              <strong style="font-family:var(--font-sans);font-size:14px;color:#1A1A1A;display:block;font-weight:600">Insulation, Electrics &amp; Plastering</strong>
              <span class="stage-sub" style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65;font-weight:500">Week 3–4 &middot; Celotex &amp; Mirror Skim</span>
            </div>
          </div>
          <span class="stage-arrow" style="color:#A0A09A;font-size:16px">&rarr;</span>
        </button>

        <!-- Stage 8 Button -->
        <button type="button" role="tab" aria-selected="false" aria-controls="panel-8" id="tab-8" onclick="switchStage(8)" class="stage-nav-btn" style="background:#FFFFFF;border:1px solid #E2E5DF" onmouseover="if(!this.classList.contains('active'))this.style.borderColor='#9DC388'" onmouseout="if(!this.classList.contains('active'))this.style.borderColor='#E2E5DF'">
          <div style="display:flex;align-items:center;gap:12px">
            <span class="stage-num-badge" style="font-family:var(--font-sans);font-size:13px;font-weight:700;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">08</span>
            <div class="stage-title-wrap">
              <strong style="font-family:var(--font-sans);font-size:14px;color:#1A1A1A;display:block;font-weight:600">2nd Fix, Sign-Off &amp; 10-Yr Warranty</strong>
              <span class="stage-sub" style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65;font-weight:500">Handover &middot; Official Completion Cert</span>
            </div>
          </div>
          <span class="stage-arrow" style="color:#A0A09A;font-size:16px">&rarr;</span>
        </button>

      </div>

      <!-- Right: Dynamic Showcase Display (Fills Remaining Width & Matches Height) -->
      <div style="position:relative;height:100%">
          
          <!-- Stage 1 Showcase Panel -->
          <div class="stage-panel active" id="panel-1" role="tabpanel" aria-labelledby="tab-1" style="background:#FFFFFF;border:1px solid #E2E5DF;border-radius:14px;padding:clamp(24px,3.5vw,36px);box-shadow:0 8px 24px -6px rgba(24,34,22,0.06);position:relative;overflow:hidden;transition:opacity .3s ease">
            <div style="position:absolute;top:12px;right:24px;font-family:var(--font-serif);font-size:72px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none">01</div>
            
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:16px;position:relative;z-index:1">
              <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 12px;border-radius:16px">Stage 01 of 08</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#4F6B42">⏱ Within 3–5 Days of Inquiry</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12px;color:#6B6B65">Phase: Survey &amp; Feasibility</span>
            </div>

            <h3 style="font-family:var(--font-serif);font-size:clamp(24px,2.8vw,32px);line-height:1.2;margin:0 0 14px;color:#1A1A1A;font-weight:400;position:relative;z-index:1">Initial Survey, Feasibility Check &amp; Free 3D CAD Design</h3>
            
            <p style="font-family:var(--font-sans);font-size:15.5px;color:#4A4A45;line-height:1.75;margin:0 0 20px;position:relative;z-index:1">
              Jonny personally visits your property to measure ridge-to-joist headroom, evaluate existing roof trusses or purlins, check chimney breasts, and discuss your desired layout (master bedroom, en-suite bathroom, dressing room, or home office). Within days, you receive bespoke 3D CAD layout drawings and a fixed-price written quotation with no hidden extras.
            </p>

            <div style="border:1px solid #E2E5DF;border-radius:10px;overflow:hidden;margin-bottom:22px;box-shadow:0 3px 12px rgba(0,0,0,0.04)">
              <img src="images/another-area-loft-conversions-north-west-england-01.jpeg" alt="Survey &amp; Headroom Measurement" style="width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;display:block" loading="lazy">
            </div>

            <div style="background:#FAF9F5;border:1px solid #EDEDE8;border-radius:8px;padding:14px 18px;margin-bottom:20px;display:flex;flex-wrap:wrap;align-items:center;gap:12px;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
              <span>✓ Free 3D CAD layout included</span>
              <span>✓ Guaranteed fixed-price quote</span>
              <span>✓ Zero deposit required</span>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:10px">
              <button type="button" onclick="switchStage(2)" class="btn-secondary" style="display:inline-flex;align-items:center;gap:8px;padding:9px 18px;font-size:13.5px">
                Next: Architectural Plans &rarr;
              </button>
            </div>
          </div>

          <!-- Stage 2 Showcase Panel -->
          <div class="stage-panel" id="panel-2" role="tabpanel" aria-labelledby="tab-2" style="display:none;background:#FFFFFF;border:1px solid #E2E5DF;border-radius:14px;padding:clamp(24px,3.5vw,36px);box-shadow:0 8px 24px -6px rgba(24,34,22,0.06);position:relative;overflow:hidden;transition:opacity .3s ease">
            <div style="position:absolute;top:12px;right:24px;font-family:var(--font-serif);font-size:72px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none">02</div>
            
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:16px;position:relative;z-index:1">
              <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 12px;border-radius:16px">Stage 02 of 08</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#4F6B42">⏱ 1–2 Weeks Prior to Build</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12px;color:#6B6B65">Phase: Technical Drawings</span>
            </div>

            <h3 style="font-family:var(--font-serif);font-size:clamp(24px,2.8vw,32px);line-height:1.2;margin:0 0 14px;color:#1A1A1A;font-weight:400;position:relative;z-index:1">Architectural Plans &amp; Permitted Development Verification</h3>
            
            <p style="font-family:var(--font-sans);font-size:15.5px;color:#4A4A45;line-height:1.75;margin:0 0 20px;position:relative;z-index:1">
              Once you approve the layout, our architectural surveyor drafts comprehensive construction plans. We verify Permitted Development volume allowances (40m³ for terraced, 50m³ for semi-detached/detached) and manage planning applications if your home is Listed or in a Conservation Area.
            </p>

            <div style="border:1px solid #E2E5DF;border-radius:10px;overflow:hidden;margin-bottom:22px;box-shadow:0 3px 12px rgba(0,0,0,0.04)">
              <img src="images/another-area-loft-conversions-north-west-england-03.jpeg" alt="Architectural Plans &amp; Permitted Development" style="width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;display:block" loading="lazy">
            </div>

            <div style="background:#FAF9F5;border:1px solid #EDEDE8;border-radius:8px;padding:14px 18px;margin-bottom:20px;display:flex;flex-wrap:wrap;align-items:center;gap:12px;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
              <span>✓ Complete architectural drawings</span>
              <span>✓ Permitted Development volume check</span>
              <span>✓ Council paperwork managed</span>
            </div>

            <div style="display:flex;justify-content:space-between;gap:12px;margin-top:10px">
              <button type="button" onclick="switchStage(1)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">&larr; Previous</button>
              <button type="button" onclick="switchStage(3)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">Next: Structural Engineering &rarr;</button>
            </div>
          </div>

          <!-- Stage 3 Showcase Panel -->
          <div class="stage-panel" id="panel-3" role="tabpanel" aria-labelledby="tab-3" style="display:none;background:#FFFFFF;border:1px solid #E2E5DF;border-radius:14px;padding:clamp(24px,3.5vw,36px);box-shadow:0 8px 24px -6px rgba(24,34,22,0.06);position:relative;overflow:hidden;transition:opacity .3s ease">
            <div style="position:absolute;top:12px;right:24px;font-family:var(--font-serif);font-size:72px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none">03</div>
            
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:16px;position:relative;z-index:1">
              <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 12px;border-radius:16px">Stage 03 of 08</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#4F6B42">⏱ Pre-Start Phase</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12px;color:#6B6B65">Phase: Engineering &amp; Regs</span>
            </div>

            <h3 style="font-family:var(--font-serif);font-size:clamp(24px,2.8vw,32px);line-height:1.2;margin:0 0 14px;color:#1A1A1A;font-weight:400;position:relative;z-index:1">Structural Engineering &amp; Building Control Submission</h3>
            
            <p style="font-family:var(--font-sans);font-size:15.5px;color:#4A4A45;line-height:1.75;margin:0 0 20px;position:relative;z-index:1">
              A certified structural engineer calculates universal steel beam load bearings (UB/UC), reinforced concrete padstone sizes, and floor trimmer spans. We submit a Full Plans application to Building Control covering structural integrity, fire compartmentation, insulation U-values, and escape routes.
            </p>

            <div style="border:1px solid #E2E5DF;border-radius:10px;overflow:hidden;margin-bottom:22px;box-shadow:0 3px 12px rgba(0,0,0,0.04)">
              <img src="images/another-area-loft-conversions-north-west-england-06.jpeg" alt="Structural Engineering Calculations" style="width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;display:block" loading="lazy">
            </div>

            <div style="background:#FAF9F5;border:1px solid #EDEDE8;border-radius:8px;padding:14px 18px;margin-bottom:20px;display:flex;flex-wrap:wrap;align-items:center;gap:12px;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
              <span>✓ Certified structural engineer pack</span>
              <span>✓ Building Inspector assigned</span>
              <span>✓ Full Building Regulations sign-off</span>
            </div>

            <div style="display:flex;justify-content:space-between;gap:12px;margin-top:10px">
              <button type="button" onclick="switchStage(2)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">&larr; Previous</button>
              <button type="button" onclick="switchStage(4)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">Next: Scaffolding &amp; Steels &rarr;</button>
            </div>
          </div>

          <!-- Stage 4 Showcase Panel -->
          <div class="stage-panel" id="panel-4" role="tabpanel" aria-labelledby="tab-4" style="display:none;background:#FFFFFF;border:1px solid #E2E5DF;border-radius:14px;padding:clamp(24px,3.5vw,36px);box-shadow:0 8px 24px -6px rgba(24,34,22,0.06);position:relative;overflow:hidden;transition:opacity .3s ease">
            <div style="position:absolute;top:12px;right:24px;font-family:var(--font-serif);font-size:72px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none">04</div>
            
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:16px;position:relative;z-index:1">
              <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 12px;border-radius:16px">Stage 04 of 08</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#4F6B42">⏱ On-Site Week 1</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12px;color:#6B6B65">Phase: Structural Build</span>
            </div>

            <h3 style="font-family:var(--font-serif);font-size:clamp(24px,2.8vw,32px);line-height:1.2;margin:0 0 14px;color:#1A1A1A;font-weight:400;position:relative;z-index:1">External Scaffolding, Steels &amp; Structural Floor Joists</h3>
            
            <p style="font-family:var(--font-sans);font-size:15.5px;color:#4A4A45;line-height:1.75;margin:0 0 20px;position:relative;z-index:1">
              Scaffolding is erected externally with hoist access. Heavy structural steel beams are loaded directly into the roof through external openings, protecting your home below from dust and disruption. Steels are seated on heavy-duty padstones, and new suspended floor joists are laid independently above existing ceilings.
            </p>

            <div style="border:1px solid #E2E5DF;border-radius:10px;overflow:hidden;margin-bottom:22px;box-shadow:0 3px 12px rgba(0,0,0,0.04)">
              <img src="images/another-area-loft-conversions-north-west-england-16.jpeg" alt="Structural Steels &amp; Floor Joists" style="width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;display:block" loading="lazy">
            </div>

            <div style="background:#FAF9F5;border:1px solid #EDEDE8;border-radius:8px;padding:14px 18px;margin-bottom:20px;display:flex;flex-wrap:wrap;align-items:center;gap:12px;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
              <span>✓ External hoist access (no downstairs mess)</span>
              <span>✓ Heavy-duty load-bearing padstones</span>
              <span>✓ Independent suspended floor structure</span>
            </div>

            <div style="display:flex;justify-content:space-between;gap:12px;margin-top:10px">
              <button type="button" onclick="switchStage(3)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">&larr; Previous</button>
              <button type="button" onclick="switchStage(5)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">Next: Dormers &amp; Roof Windows &rarr;</button>
            </div>
          </div>

          <!-- Stage 5 Showcase Panel -->
          <div class="stage-panel" id="panel-5" role="tabpanel" aria-labelledby="tab-5" style="display:none;background:#FFFFFF;border:1px solid #E2E5DF;border-radius:14px;padding:clamp(24px,3.5vw,36px);box-shadow:0 8px 24px -6px rgba(24,34,22,0.06);position:relative;overflow:hidden;transition:opacity .3s ease">
            <div style="position:absolute;top:12px;right:24px;font-family:var(--font-serif);font-size:72px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none">05</div>
            
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:16px;position:relative;z-index:1">
              <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 12px;border-radius:16px">Stage 05 of 08</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#4F6B42">⏱ On-Site Week 2</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12px;color:#6B6B65">Phase: Weatherproofing</span>
            </div>

            <h3 style="font-family:var(--font-serif);font-size:clamp(24px,2.8vw,32px);line-height:1.2;margin:0 0 14px;color:#1A1A1A;font-weight:400;position:relative;z-index:1">Roof Alterations, Dormer Framing &amp; Velux Windows</h3>
            
            <p style="font-family:var(--font-sans);font-size:15.5px;color:#4A4A45;line-height:1.75;margin:0 0 20px;position:relative;z-index:1">
              Dormers are framed in structural C24 treated timber, tile-hung to match your home's exterior roofline, and sealed with Firestone EPDM seamless rubber membrane (50-year life expectancy). Velux roof windows are fitted with watertight flashing kits to ensure a 100% weatherproof envelope.
            </p>

            <div style="border:1px solid #E2E5DF;border-radius:10px;overflow:hidden;margin-bottom:22px;box-shadow:0 3px 12px rgba(0,0,0,0.04)">
              <img src="images/another-area-loft-conversions-north-west-england-17.jpeg" alt="Dormer Framing &amp; Weatherproofing" style="width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;display:block" loading="lazy">
            </div>

            <div style="background:#FAF9F5;border:1px solid #EDEDE8;border-radius:8px;padding:14px 18px;margin-bottom:20px;display:flex;flex-wrap:wrap;align-items:center;gap:12px;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
              <span>✓ C24 treated structural timbers</span>
              <span>✓ Firestone EPDM seamless rubber roof</span>
              <span>✓ Certified Velux installation</span>
            </div>

            <div style="display:flex;justify-content:space-between;gap:12px;margin-top:10px">
              <button type="button" onclick="switchStage(4)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">&larr; Previous</button>
              <button type="button" onclick="switchStage(6)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">Next: Bespoke Staircase &rarr;</button>
            </div>
          </div>

          <!-- Stage 6 Showcase Panel -->
          <div class="stage-panel" id="panel-6" role="tabpanel" aria-labelledby="tab-6" style="display:none;background:#FFFFFF;border:1px solid #E2E5DF;border-radius:14px;padding:clamp(24px,3.5vw,36px);box-shadow:0 8px 24px -6px rgba(24,34,22,0.06);position:relative;overflow:hidden;transition:opacity .3s ease">
            <div style="position:absolute;top:12px;right:24px;font-family:var(--font-serif);font-size:72px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none">06</div>
            
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:16px;position:relative;z-index:1">
              <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 12px;border-radius:16px">Stage 06 of 08</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#4F6B42">⏱ On-Site Week 2–3</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12px;color:#6B6B65">Phase: Custom Joinery</span>
            </div>

            <h3 style="font-family:var(--font-serif);font-size:clamp(24px,2.8vw,32px);line-height:1.2;margin:0 0 14px;color:#1A1A1A;font-weight:400;position:relative;z-index:1">Bespoke Handcrafted Staircase Installation</h3>
            
            <p style="font-family:var(--font-sans);font-size:15.5px;color:#4A4A45;line-height:1.75;margin:0 0 20px;position:relative;z-index:1">
              Once structural floor levels are locked in, we trim the stairwell aperture and install your custom-built staircase. The flight is manufactured to seamlessly match your existing newel posts, spindles, and handrails, maintaining the mandatory 2.0m Building Regs headroom clearance.
            </p>

            <div style="border:1px solid #E2E5DF;border-radius:10px;overflow:hidden;margin-bottom:22px;box-shadow:0 3px 12px rgba(0,0,0,0.04)">
              <img src="images/another-area-loft-conversions-north-west-england-19.jpeg" alt="Custom Handcrafted Loft Staircase" style="width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;display:block" loading="lazy">
            </div>

            <div style="background:#FAF9F5;border:1px solid #EDEDE8;border-radius:8px;padding:14px 18px;margin-bottom:20px;display:flex;flex-wrap:wrap;align-items:center;gap:12px;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
              <span>✓ Custom joinery matched to original hallway</span>
              <span>✓ Guaranteed 2.0m Building Regs headroom</span>
              <span>✓ Precision structural integration</span>
            </div>

            <div style="display:flex;justify-content:space-between;gap:12px;margin-top:10px">
              <button type="button" onclick="switchStage(5)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">&larr; Previous</button>
              <button type="button" onclick="switchStage(7)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">Next: Insulation &amp; Plaster &rarr;</button>
            </div>
          </div>

          <!-- Stage 7 Showcase Panel -->
          <div class="stage-panel" id="panel-7" role="tabpanel" aria-labelledby="tab-7" style="display:none;background:#FFFFFF;border:1px solid #E2E5DF;border-radius:14px;padding:clamp(24px,3.5vw,36px);box-shadow:0 8px 24px -6px rgba(24,34,22,0.06);position:relative;overflow:hidden;transition:opacity .3s ease">
            <div style="position:absolute;top:12px;right:24px;font-family:var(--font-serif);font-size:72px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none">07</div>
            
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:16px;position:relative;z-index:1">
              <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 12px;border-radius:16px">Stage 07 of 08</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#4F6B42">⏱ On-Site Week 3–4</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12px;color:#6B6B65">Phase: Interior Trades</span>
            </div>

            <h3 style="font-family:var(--font-serif);font-size:clamp(24px,2.8vw,32px);line-height:1.2;margin:0 0 14px;color:#1A1A1A;font-weight:400;position:relative;z-index:1">Rigid Thermal Insulation, 1st-Fix Trades &amp; Plastering</h3>
            
            <p style="font-family:var(--font-sans);font-size:15.5px;color:#4A4A45;line-height:1.75;margin:0 0 20px;position:relative;z-index:1">
              Foil-backed rigid thermal insulation (Celotex/Kingspan) is fitted throughout roof slopes and dormers to keep your room comfortable in all seasons. First-fix electrics (LED spotlights, smoke alarms) and plumbing are routed. Stud walls are boarded and skimmed with a mirror-smooth two-coat plaster finish.
            </p>

            <div style="border:1px solid #E2E5DF;border-radius:10px;overflow:hidden;margin-bottom:22px;box-shadow:0 3px 12px rgba(0,0,0,0.04)">
              <img src="images/another-area-loft-conversions-north-west-england-20.jpeg" alt="High-Performance Insulation &amp; Plasterwork" style="width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;display:block" loading="lazy">
            </div>

            <div style="background:#FAF9F5;border:1px solid #EDEDE8;border-radius:8px;padding:14px 18px;margin-bottom:20px;display:flex;flex-wrap:wrap;align-items:center;gap:12px;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
              <span>✓ Celotex / Kingspan high-efficiency insulation</span>
              <span>✓ Part P certified electrical installation</span>
              <span>✓ Mirror-smooth plaster skim finish</span>
            </div>

            <div style="display:flex;justify-content:space-between;gap:12px;margin-top:10px">
              <button type="button" onclick="switchStage(6)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">&larr; Previous</button>
              <button type="button" onclick="switchStage(8)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">Next: Handover &amp; Guarantee &rarr;</button>
            </div>
          </div>

          <!-- Stage 8 Showcase Panel -->
          <div class="stage-panel" id="panel-8" role="tabpanel" aria-labelledby="tab-8" style="display:none;background:#FFFFFF;border:1px solid #E2E5DF;border-radius:14px;padding:clamp(24px,3.5vw,36px);box-shadow:0 8px 24px -6px rgba(24,34,22,0.06);position:relative;overflow:hidden;transition:opacity .3s ease">
            <div style="position:absolute;top:12px;right:24px;font-family:var(--font-serif);font-size:72px;font-weight:400;color:#F1F4EE;line-height:1;user-select:none;pointer-events:none">08</div>
            
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:16px;position:relative;z-index:1">
              <span style="font-family:var(--font-sans);font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:4px 12px;border-radius:16px">Stage 08 of 08</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#4F6B42">⏱ Completion &amp; Official Handover</span>
              <span style="color:#D4D4CC;font-size:12px">•</span>
              <span style="font-family:var(--font-sans);font-size:12px;color:#6B6B65">Phase: Final Certification</span>
            </div>

            <h3 style="font-family:var(--font-serif);font-size:clamp(24px,2.8vw,32px);line-height:1.2;margin:0 0 14px;color:#1A1A1A;font-weight:400;position:relative;z-index:1">2nd-Fix Joinery, Final Building Control Sign-Off &amp; 10-Yr Guarantee</h3>
            
            <p style="font-family:var(--font-sans);font-size:15.5px;color:#4A4A45;line-height:1.75;margin:0 0 20px;position:relative;z-index:1">
              We install FD30 fire doors, architraves, skirting boards, electrical sockets, switches, and bathroom sanitaryware. The Building Control officer conducts the final walk-through inspection. Once approved, you receive your official <strong>Building Control Completion Certificate</strong> and our <strong>10-Year Written Structural Guarantee</strong>.
            </p>

            <div style="border:1px solid #E2E5DF;border-radius:10px;overflow:hidden;margin-bottom:22px;box-shadow:0 3px 12px rgba(0,0,0,0.04)">
              <img src="images/another-area-loft-conversions-north-west-england-21.jpeg" alt="Completed Master Bedroom Loft Conversion Handover" style="width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;display:block" loading="lazy">
            </div>

            <div style="background:#FAF9F5;border:1px solid #EDEDE8;border-radius:8px;padding:14px 18px;margin-bottom:20px;display:flex;flex-wrap:wrap;align-items:center;gap:12px;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
              <span>✓ FD30 fire doors &amp; architectural finish</span>
              <span>✓ Official Building Control Completion Certificate</span>
              <span>✓ 10-Year written structural warranty</span>
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-top:10px">
              <button type="button" onclick="switchStage(7)" class="btn-secondary" style="padding:9px 18px;font-size:13.5px">&larr; Previous</button>
              <a href="#booking" data-open-booking class="btn-primary" style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;font-size:14px">
                Book Your Free Survey
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
              </a>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- Interactive Stage Switcher Script -->
  <script>
    let currentStage = 1;

    function navigateStage(delta) {
      let next = currentStage + delta;
      if (next < 1) next = 8;
      if (next > 8) next = 1;
      switchStage(next);
    }

    function switchStage(stageNum) {
      currentStage = stageNum;
      // Update Tab Navigation Buttons
      const navBtns = document.querySelectorAll('.stage-nav-btn');
      navBtns.forEach((btn, index) => {
        const isCurrent = (index + 1) === stageNum;
        btn.setAttribute('aria-selected', isCurrent ? 'true' : 'false');
        if (isCurrent) {
          btn.classList.add('active');
          btn.style.backgroundColor = '#F1F7EE';
          btn.style.border = '1.5px solid #4F6B42';
          const badge = btn.querySelector('span');
          if (badge) {
            badge.style.backgroundColor = '#4F6B42';
            badge.style.color = '#FFFFFF';
            badge.style.border = 'none';
          }
          const arrow = btn.querySelector('span:last-child');
          if (arrow) {
            arrow.style.color = '#4F6B42';
            arrow.style.fontWeight = 'bold';
          }
        } else {
          btn.classList.remove('active');
          btn.style.backgroundColor = '#FFFFFF';
          btn.style.border = '1px solid #E2E5DF';
          const badge = btn.querySelector('span');
          if (badge) {
            badge.style.backgroundColor = '#F1F7EE';
            badge.style.color = '#3E5C32';
            badge.style.border = '1px solid #DFEBD9';
          }
          const arrow = btn.querySelector('span:last-child');
          if (arrow) {
            arrow.style.color = '#A0A09A';
            arrow.style.fontWeight = 'normal';
          }
        }
      });

      // Update Showcase Panels with smooth transition
      const panels = document.querySelectorAll('.stage-panel');
      panels.forEach((panel) => {
        panel.style.display = 'none';
        panel.classList.remove('active');
      });

      const targetPanel = document.getElementById('panel-' + stageNum);
      if (targetPanel) {
        targetPanel.style.display = 'flex';
        targetPanel.style.flexDirection = 'column';
        targetPanel.style.justifyContent = 'space-between';
        targetPanel.style.opacity = '0';
        setTimeout(() => {
          targetPanel.style.opacity = '1';
          targetPanel.classList.add('active');
        }, 30);
      }

      // Update progress indicator
      const progressCircle = document.getElementById('progress-circle');
      if (progressCircle) {
        progressCircle.textContent = stageNum + '/8';
      }

      // Auto-scroll active tab into view on mobile
      const activeBtn = document.getElementById('tab-' + stageNum);
      if (activeBtn && window.innerWidth <= 880) {
        activeBtn.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
      }
    }
  </script>

  <!-- Testimonials Section (Identical to Homepage Design) -->
  <section data-reveal aria-labelledby="test-h" class="section-padding bg-gray border-top border-bottom">
    <div class="container">
      <div style="display:flex;flex-wrap:wrap;gap:20px;align-items:flex-end;justify-content:space-between;margin-bottom:40px">
        <div>
          <span class="section-label">Customer feedback</span>
          <h2 id="test-h" class="heading-h2">What the neighbours said.</h2>
        </div>
        <span style="font-family:var(--font-sans);font-size:12.5px;color:#6B6B65">Verified via Checkatrade &middot; 400+ reviews</span>
      </div>

      <div class="testimonials-grid">
        <figure class="testimonial-card dark wide">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
            <span style="letter-spacing:.16em;font-size:13px;color:#FFFFFF">★★★★★</span>
            <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#DCE6D6">Rear dormer</span>
          </div>
          <blockquote class="testimonial-quote">Two bedrooms and a bathroom out of a loft we used for storing boxes. The number on the quote was the number we paid.</blockquote>
          <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
            <span class="testimonial-avatar">S</span>
            <span style="display:flex;flex-direction:column;line-height:1.35">
              <span style="font-size:14px;font-weight:600;color:#FFFFFF">Sarah</span>
              <span style="font-family:var(--font-sans);font-size:11.5px;color:#DCE6D6">Bolton · Sept 2025</span>
            </span>
          </figcaption>
        </figure>

        <figure class="testimonial-card">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
            <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
            <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#6B6B65">Hip-to-gable</span>
          </div>
          <blockquote class="testimonial-quote">Four weeks start to finish, and they swept up every evening — which mattered with a toddler in the house.</blockquote>
          <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
            <span class="testimonial-avatar">D</span>
            <span style="display:flex;flex-direction:column;line-height:1.35">
              <span style="font-size:14px;font-weight:600;color:#1A1A1A">Daniel</span>
              <span style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65">Chorlton · June 2025</span>
            </span>
          </figcaption>
        </figure>

        <figure class="testimonial-card accent">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
            <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
            <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#6B6B65">Velux</span>
          </div>
          <blockquote class="testimonial-quote">They talked us out of the bigger option because our roof did not need it.</blockquote>
          <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
            <span class="testimonial-avatar">P</span>
            <span style="display:flex;flex-direction:column;line-height:1.35">
              <span style="font-size:14px;font-weight:600;color:#1A1A1A">Priya</span>
              <span style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65">Stockport · Mar 2025</span>
            </span>
          </figcaption>
        </figure>

        <figure class="testimonial-card">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
            <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
            <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#6B6B65">Rear dormer</span>
          </div>
          <blockquote class="testimonial-quote">Building control paperwork was all handled. We never had to chase anybody once.</blockquote>
          <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
            <span class="testimonial-avatar">M</span>
            <span style="display:flex;flex-direction:column;line-height:1.35">
              <span style="font-size:14px;font-weight:600;color:#1A1A1A">Mark</span>
              <span style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65">Preston · Jan 2025</span>
            </span>
          </figcaption>
        </figure>

        <figure class="testimonial-card">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
            <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
            <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#6B6B65">Wrap around</span>
          </div>
          <blockquote class="testimonial-quote">The CAD drawing sold it to my husband. Seeing the staircase landing made the whole thing real.</blockquote>
          <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
            <span class="testimonial-avatar">E</span>
            <span style="display:flex;flex-direction:column;line-height:1.35">
              <span style="font-size:14px;font-weight:600;color:#1A1A1A">Elaine</span>
              <span style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65">Lytham · Nov 2024</span>
            </span>
          </figcaption>
        </figure>

        <figure class="testimonial-card accent">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
            <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
            <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#6B6B65">Roof-lift</span>
          </div>
          <blockquote class="testimonial-quote">Our loft was 2.1m so I assumed it was a no. They dropped the landing ceiling and it works beautifully.</blockquote>
          <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
            <span class="testimonial-avatar">J</span>
            <span style="display:flex;flex-direction:column;line-height:1.35">
              <span style="font-size:14px;font-weight:600;color:#1A1A1A">Joseph</span>
              <span style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65">Bury · Aug 2025</span>
            </span>
          </figcaption>
        </figure>

        <figure class="testimonial-card">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
            <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
            <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#6B6B65">Hip-end dormer</span>
          </div>
          <blockquote class="testimonial-quote">Second conversion we have had done in the family. Straight back to the same team, no hesitation.</blockquote>
          <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
            <span class="testimonial-avatar">N</span>
            <span style="display:flex;flex-direction:column;line-height:1.35">
              <span style="font-size:14px;font-weight:600;color:#1A1A1A">Nadia</span>
              <span style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65">Didsbury · May 2025</span>
            </span>
          </figcaption>
        </figure>

        <figure class="testimonial-card">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
            <span style="letter-spacing:.16em;font-size:13px;color:#6B8E5A">★★★★★</span>
            <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#6B6B65">Velux</span>
          </div>
          <blockquote class="testimonial-quote">Quiet, tidy, and they warned us the day the steels were coming so we could work elsewhere.</blockquote>
          <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
            <span class="testimonial-avatar">T</span>
            <span style="display:flex;flex-direction:column;line-height:1.35">
              <span style="font-size:14px;font-weight:600;color:#1A1A1A">Tom</span>
              <span style="font-family:var(--font-sans);font-size:11.5px;color:#6B6B65">Warrington · Feb 2025</span>
            </span>
          </figcaption>
        </figure>

        <figure class="testimonial-card dark wide">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:14px">
            <span style="letter-spacing:.16em;font-size:13px;color:#FFFFFF">★★★★★</span>
            <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#DCE6D6">Rear dormer</span>
          </div>
          <blockquote class="testimonial-quote">The valuation came back £62,000 higher than before the work. Best money we have spent on the house.</blockquote>
          <figcaption style="display:flex;align-items:center;gap:12px;margin-top:auto;padding-top:6px">
            <span class="testimonial-avatar">R</span>
            <span style="display:flex;flex-direction:column;line-height:1.35">
              <span style="font-size:14px;font-weight:600;color:#FFFFFF">Rachel</span>
              <span style="font-family:var(--font-sans);font-size:11.5px;color:#DCE6D6">Sale · Oct 2024</span>
            </span>
          </figcaption>
        </figure>

        <a href="https://www.checkatrade.com/trades/AnotherLevelLoftConversionsNw" target="_blank" rel="noopener noreferrer" style="border:1px solid #6B8E5A;border-radius:3px;padding:24px 22px 22px;display:flex;flex-direction:column;gap:14px;background:#F1F5EE;color:#1A1A1A;text-decoration:none;transition:background .2s">
          <span style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#4F6B42">Checkatrade verified</span>
          <span style="font-family:var(--font-serif);font-size:clamp(30px,3vw,38px);line-height:1;letter-spacing:-.02em">9.8 / 10</span>
          <span style="font-family:var(--font-sans);font-size:14px;line-height:1.55;color:#4A4A45">Every review left by a customer whose conversion we finished. 400+ reviews and counting.</span>
          <span style="margin-top:auto;padding-top:8px;font-family:var(--font-sans);font-size:14px;font-weight:600;color:#4F6B42;border-bottom:1px solid #6B8E5A;align-self:flex-start;padding-bottom:3px">Read them all &rarr;</span>
        </a>
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
