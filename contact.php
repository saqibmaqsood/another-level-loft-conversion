<?php
$pageTitle = "Contact Another Level Loft Conversions";
$pageDesc = "Speak to a loft conversion surveyor. Free home survey across Preston, Manchester, Lancashire and Cheshire. 0800 0862744.";
$activePage = "contact";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "ContactPage",
    "mainEntity" => [
        "@type" => "LocalBusiness",
        "name" => "Another Level Loft Conversions",
        "telephone" => "0800 0862744",
        "email" => "info@anotherlevelloftconversions.co.uk",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "Old Docks House, 90 Watery Lane",
            "addressLocality" => "Preston",
            "postalCode" => "PR2 1AU",
            "addressCountry" => "GB"
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

  <main>

    <!-- Hero Section -->
    <section aria-labelledby="h1" class="border-bottom" style="background:#FAF9F5;position:relative;overflow:hidden">
      <div class="contact-hero-grid">
        
        <!-- Left: Headline & Direct Contact Assurance -->
        <div style="display:flex;flex-direction:column;gap:18px">
          
          <!-- Embedded Breadcrumb & Badge -->
          <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
            <nav aria-label="Breadcrumb" class="breadcrumb-inline">
              <a href="index.php">Home</a>
              <span class="crumb-sep">/</span>
              <span class="crumb-current" aria-current="page">Contact</span>
            </nav>
            <span style="color:#D4D4CC;font-size:12px">•</span>
            <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 11px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
              <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              Direct Surveyor Contact
            </span>
          </div>

          <h1 id="h1" class="heading-h1" style="font-family:var(--font-serif);font-size:clamp(34px,4.8vw,58px);letter-spacing:-.025em;line-height:1.14;font-weight:400;margin:0;color:#1A1A1A">
            A master surveyor answers, not a call centre.
          </h1>
          
          <p class="lead-text" style="font-family:var(--font-sans);font-size:clamp(16px,1.8vw,17.5px);color:#4A4A45;line-height:1.7;margin:0;max-width:52ch">
            When you call Another Level, you speak directly with experienced surveyors who understand structural steels, ridge heights, and local planning laws. No high-pressure sales brokers &mdash; just honest, expert advice.
          </p>

          <div class="hero-actions-row" style="margin-top:4px">
            <a href="#booking" data-open-booking class="btn-primary hero-btn">
              <span>Book Free Survey</span>
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
            </a>
            <a href="tel:08000862744" class="btn-secondary hero-btn">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <span>Call 0800 0862744</span>
            </a>
          </div>

          <!-- Trust Pill Row -->
          <div style="display:flex;flex-wrap:wrap;gap:14px;margin-top:8px;padding-top:16px;border-top:1px solid #EAEAE4;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
            <span style="display:inline-flex;align-items:center;gap:6px">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              Free Survey &amp; 3D CAD Drawing
            </span>
            <span style="display:inline-flex;align-items:center;gap:6px">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              100% Fixed Written Price
            </span>
            <span style="display:inline-flex;align-items:center;gap:6px">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              £0 Upfront Deposit
            </span>
          </div>
        </div>

        <!-- Right: Direct Phone Lines Dashboard Card -->
        <div class="contact-dial-card">
          
          <div style="padding-bottom:12px;border-bottom:1px solid #EDEDE8;display:flex;align-items:center;justify-content:space-between">
            <div>
              <span style="font-family:var(--font-sans);font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#4F6B42;display:block;margin-bottom:3px">Direct Dial Lines</span>
              <h2 style="font-family:var(--font-serif);font-size:22px;margin:0;color:#1A1A1A;font-weight:400">Speak With Our Surveyors</h2>
            </div>
            <span style="display:inline-flex;align-items:center;gap:5px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:11px;font-weight:700;color:#3E5C32">
              <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A"></span>
              Live
            </span>
          </div>

          <!-- Freephone Line -->
          <a href="tel:08000862744" class="contact-dial-item">
            <div style="display:flex;align-items:center;gap:12px">
              <span style="width:36px;height:36px;border-radius:8px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </span>
              <div>
                <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;color:#6B8E5A;text-transform:uppercase;letter-spacing:.05em;display:block">Toll-Free UK Helpline</span>
                <strong style="font-family:var(--font-sans);font-size:16.5px;color:#1A1A1A;font-weight:700">0800 0862744</strong>
              </div>
            </div>
            <span style="color:#6B8E5A;font-weight:bold;font-size:16px">&rarr;</span>
          </a>

          <!-- Manchester Line -->
          <a href="tel:01614100155" class="contact-dial-item">
            <div style="display:flex;align-items:center;gap:12px">
              <span style="width:36px;height:36px;border-radius:8px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </span>
              <div>
                <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;color:#6B8E5A;text-transform:uppercase;letter-spacing:.05em;display:block">Manchester Regional Desk</span>
                <strong style="font-family:var(--font-sans);font-size:16.5px;color:#1A1A1A;font-weight:700">0161 4100155</strong>
              </div>
            </div>
            <span style="color:#6B8E5A;font-weight:bold;font-size:16px">&rarr;</span>
          </a>

          <!-- Preston Line -->
          <a href="tel:01772393005" class="contact-dial-item">
            <div style="display:flex;align-items:center;gap:12px">
              <span style="width:36px;height:36px;border-radius:8px;background:#F1F7EE;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </span>
              <div>
                <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;color:#6B8E5A;text-transform:uppercase;letter-spacing:.05em;display:block">Lancashire Head Office</span>
                <strong style="font-family:var(--font-sans);font-size:16.5px;color:#1A1A1A;font-weight:700">01772 393005</strong>
              </div>
            </div>
            <span style="color:#6B8E5A;font-weight:bold;font-size:16px">&rarr;</span>
          </a>

        </div>

      </div>
    </section>

    <!-- 4 Ways to Reach Us Section -->
    <section data-reveal aria-label="Ways to reach us" class="section-padding bg-white border-bottom">
      <div class="container">
        
        <div style="max-width:680px;margin-bottom:36px">
          <span class="section-label" style="display:inline-flex;align-items:center;gap:6px">
            <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
            Communication Channels
          </span>
          <h2 class="heading-h2" style="font-family:var(--font-serif);font-size:clamp(26px,3.5vw,38px);margin:8px 0;color:#1A1A1A;font-weight:400">
            Four Simple Ways to Get Started
          </h2>
          <p style="font-family:var(--font-sans);font-size:15px;color:#555550;line-height:1.6;margin:0">
            Choose the method that works best for your schedule. Whether you need a quick feasibility check or a full on-site survey, we're ready.
          </p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px">
          
          <!-- Method 1: Phone -->
          <div class="contact-method-card">
            <div>
              <span style="width:42px;height:42px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;margin-bottom:16px">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </span>
              <h3 style="font-family:var(--font-serif);font-size:20px;margin:0 0 8px;color:#1A1A1A;font-weight:400">Direct Phone Call</h3>
              <p style="font-family:var(--font-sans);font-size:13.5px;color:#555550;line-height:1.6;margin:0 0 16px">
                Instant advice on headroom, planning, and ballpark estimates from our senior team.
              </p>
            </div>
            <a href="tel:08000862744" style="font-family:var(--font-sans);font-size:13.5px;font-weight:700;color:#4F6B42;text-decoration:none;display:inline-flex;align-items:center;gap:6px">
              0800 0862744 &rarr;
            </a>
          </div>

          <!-- Method 2: Email Photos -->
          <div class="contact-method-card">
            <div>
              <span style="width:42px;height:42px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;margin-bottom:16px">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
              </span>
              <h3 style="font-family:var(--font-serif);font-size:20px;margin:0 0 8px;color:#1A1A1A;font-weight:400">Email Photos &amp; Plans</h3>
              <p style="font-family:var(--font-sans);font-size:13.5px;color:#555550;line-height:1.6;margin:0 0 16px">
                Send photos of your loft hatch and roof pitch for a same-day feasibility confirmation.
              </p>
            </div>
            <a href="mailto:info@anotherlevelloftconversions.co.uk" style="font-family:var(--font-sans);font-size:13.5px;font-weight:700;color:#4F6B42;text-decoration:none;display:inline-flex;align-items:center;gap:6px">
              Email Our Team &rarr;
            </a>
          </div>

          <!-- Method 3: Book Online -->
          <div class="contact-method-card">
            <div>
              <span style="width:42px;height:42px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;margin-bottom:16px">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
              </span>
              <h3 style="font-family:var(--font-serif);font-size:20px;margin:0 0 8px;color:#1A1A1A;font-weight:400">Book Free 3D Survey</h3>
              <p style="font-family:var(--font-sans);font-size:13.5px;color:#555550;line-height:1.6;margin:0 0 16px">
                Choose a morning, afternoon, evening, or Saturday appointment in just 90 seconds.
              </p>
            </div>
            <a href="#booking" data-open-booking style="font-family:var(--font-sans);font-size:13.5px;font-weight:700;color:#4F6B42;text-decoration:none;display:inline-flex;align-items:center;gap:6px">
              Select A Slot &rarr;
            </a>
          </div>

          <!-- Method 4: Reviews -->
          <div class="contact-method-card">
            <div>
              <span style="width:42px;height:42px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;margin-bottom:16px">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
              </span>
              <h3 style="font-family:var(--font-serif);font-size:20px;margin:0 0 8px;color:#1A1A1A;font-weight:400">Checkatrade Verified</h3>
              <p style="font-family:var(--font-sans);font-size:13.5px;color:#555550;line-height:1.6;margin:0 0 16px">
                Read 400+ authentic homeowner reviews with an audited 9.8 / 10 customer score.
              </p>
            </div>
            <a href="customer-testimonials.php" style="font-family:var(--font-sans);font-size:13.5px;font-weight:700;color:#4F6B42;text-decoration:none;display:inline-flex;align-items:center;gap:6px">
              View All Reviews &rarr;
            </a>
          </div>

        </div>

      </div>
    </section>

    <!-- Booking Inline Widget Section -->
    <section id="booking" data-reveal aria-labelledby="book-h" class="section-padding bg-light border-bottom">
      <div class="container-narrow">
        <div style="display:flex;flex-wrap:wrap;gap:24px 48px;align-items:flex-end;justify-content:space-between;margin:0 0 36px">
          <div style="max-width:540px">
            <span class="section-label" style="display:inline-flex;align-items:center;gap:6px">
              <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              Free Survey Booking
            </span>
            <h2 id="book-h" class="heading-h2" style="font-family:var(--font-serif);font-size:clamp(28px,3.8vw,42px);margin:10px 0 0;color:#1A1A1A;font-weight:400">
              Pick a slot in about ninety seconds.
            </h2>
          </div>
          <p style="max-width:38ch;font-family:var(--font-sans);font-size:15px;line-height:1.65;color:#4A4A45;margin:0">
            You will receive a written fixed-price proposal and a 3D CAD drawing within a few days of the visit &mdash; 100% free with no deposit required.
          </p>
        </div>
        <?php 
          $widgetHeading = "Book your free survey";
          include 'includes/booking-widget.php'; 
        ?>
      </div>
    </section>

    <!-- Headquarters & Office Hours Section -->
    <section data-reveal aria-labelledby="office-h" class="section-padding bg-white border-bottom">
      <div class="container" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:clamp(32px,4vw,56px);align-items:stretch">
        
        <!-- Office Location Card -->
        <div style="background:#FAF9F5;border:1px solid #E2E5DF;border-radius:12px;padding:32px 28px;display:flex;flex-direction:column;justify-content:space-between;gap:20px;height:100%">
          <div>
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px">
              <span style="width:42px;height:42px;border-radius:8px;background:#FFFFFF;border:1px solid #DFEBD9;display:flex;align-items:center;justify-content:center;color:#4F6B42;flex-shrink:0">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
              </span>
              <div>
                <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;color:#6B8E5A;text-transform:uppercase;letter-spacing:.06em;display:block">Lancashire Headquarters</span>
                <h3 style="font-family:var(--font-serif);font-size:22px;margin:0;color:#1A1A1A;font-weight:400">Old Docks House, Preston</h3>
              </div>
            </div>

            <p style="font-family:var(--font-sans);font-size:14.5px;line-height:1.7;color:#4A4A45;margin:0">
              <strong>Address:</strong> Old Docks House, 90 Watery Lane, Preston PR2 1AU<br>
              <strong>Email:</strong> <a href="mailto:info@anotherlevelloftconversions.co.uk" style="color:#4F6B42;font-weight:600;text-decoration:underline">info@anotherlevelloftconversions.co.uk</a><br>
              <strong>Main Freephone:</strong> 0800 0862744
            </p>
          </div>

          <a href="https://maps.google.com/?q=Old+Docks+House+90+Watery+Lane+Preston+PR2+1AU" target="_blank" rel="noopener noreferrer" class="btn-secondary" style="display:inline-flex;align-items:center;justify-content:center;gap:8px;font-size:14px;padding:12px 18px;margin-top:auto;width:100%">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            Open in Google Maps
          </a>
        </div>

        <!-- Operating Hours Schedule Table -->
        <div style="display:flex;flex-direction:column;justify-content:space-between;height:100%">
          <div>
            <span class="section-label" style="display:inline-flex;align-items:center;gap:6px">
              <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              Availability &amp; Hours
            </span>
            <h2 id="office-h" class="heading-h2" style="font-family:var(--font-serif);font-size:clamp(26px,3.4vw,38px);margin:8px 0 14px;color:#1A1A1A;font-weight:400">
              When Our Team Is Available
            </h2>
            <p style="font-family:var(--font-sans);font-size:15px;line-height:1.65;color:#4A4A45;margin:0 0 20px">
              Our survey team operates across all North West towns during weekdays, evenings, and Saturday mornings to fit around your family schedule.
            </p>
          </div>

          <dl style="margin:0;display:grid;gap:0;background:#FAF9F5;border:1px solid #E2E5DF;border-radius:10px;padding:4px 20px">
            <div style="display:flex;justify-content:space-between;gap:16px;align-items:center;padding:14px 0;border-bottom:1px solid #EDEDE8">
              <dt style="font-family:var(--font-sans);font-size:13.5px;font-weight:700;color:#2C2C2A">Monday &ndash; Friday</dt>
              <dd style="margin:0;font-family:var(--font-sans);font-size:13.5px;font-weight:600;color:#4F6B42">8:00 &ndash; 18:00</dd>
            </div>
            <div style="display:flex;justify-content:space-between;gap:16px;align-items:center;padding:14px 0;border-bottom:1px solid #EDEDE8">
              <dt style="font-family:var(--font-sans);font-size:13.5px;font-weight:700;color:#2C2C2A">Saturday</dt>
              <dd style="margin:0;font-family:var(--font-sans);font-size:13.5px;font-weight:600;color:#4F6B42">9:00 &ndash; 14:00</dd>
            </div>
            <div style="display:flex;justify-content:space-between;gap:16px;align-items:center;padding:14px 0;border-bottom:1px solid #EDEDE8">
              <dt style="font-family:var(--font-sans);font-size:13.5px;font-weight:700;color:#2C2C2A">Sunday</dt>
              <dd style="margin:0;font-family:var(--font-sans);font-size:13.5px;font-weight:600;color:#8A8A82">Closed</dd>
            </div>
            <div style="display:flex;justify-content:space-between;gap:16px;align-items:center;padding:14px 0">
              <dt style="font-family:var(--font-sans);font-size:13.5px;font-weight:700;color:#2C2C2A">Home Survey Visits</dt>
              <dd style="margin:0;font-family:var(--font-sans);font-size:13.5px;font-weight:700;color:#3E5C32">Evenings &amp; Weekends by request</dd>
            </div>
          </dl>
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

  <?php include 'includes/booking-modal.php'; ?>
  <?php include 'includes/footer.php'; ?>
