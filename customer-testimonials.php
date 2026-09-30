<?php
$pageTitle = "Customer Testimonials & Reviews — Northwest Loft Conversions | Another Level";
$pageDesc = "Read authentic reviews from homeowners across Preston, Manchester, Lancashire and Cheshire. 9.8/10 rating, polite tradesmen, clean builds.";
$activePage = "testimonials";
$ogImage = "images/another-area-loft-conversions-north-west-england-01.jpeg";

$schemaJson = json_encode([
    "@context" => "https://schema.org",
    "@type" => "CollectionPage",
    "name" => "Customer Testimonials — Another Level Loft Conversions",
    "description" => "Verified reviews and feedback from homeowners across the North West who converted their lofts with Another Level Loft Conversions.",
    "aggregateRating" => [
        "@type" => "AggregateRating",
        "ratingValue" => "9.8",
        "bestRating" => "10",
        "ratingCount" => "128"
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$testimonials = [
    [
        "quote" => "We would like to thank you and your team for the excellent loft conversion recently carried out at our home. Your staff were very polite and we felt they respected our home from start to finish. The whole process ran very smoothly as you assured us it would. Thank you once again.",
        "author" => "Mr & Mrs Roberts",
        "location" => "Church Lane, Leyland",
        "type" => "Rear Dormer Conversion",
        "tag" => "Family Bedroom & En-suite",
        "img" => "images/another-area-loft-conversions-north-west-england-01.jpeg"
    ],
    [
        "quote" => "Can we just say once again how impressed we were with the works carried out and the team who completed it. Everything was done to the highest standard and the communication was second to none.",
        "author" => "G. & H. Miller",
        "location" => "Kendal, Cumbria",
        "type" => "Velux Rooflight Conversion",
        "tag" => "Home Studio Space",
        "img" => "images/another-area-loft-conversions-north-west-england-03.jpeg"
    ],
    [
        "quote" => "I wanted to drop you a letter to say thanks for the brilliant room you have converted and for giving me very much needed ideas for my loft, they were very well appreciated. The staircase looks like it was built with the original house.",
        "author" => "Mrs Jennifer Clarke",
        "location" => "Preston, Lancashire",
        "type" => "Hip-to-Gable Conversion",
        "tag" => "1930s Semi Transformation",
        "img" => "images/another-area-loft-conversions-north-west-england-02.jpeg"
    ],
    [
        "quote" => "Thank you very much for the excellent bedrooms you have given us. We will send you some pictures once we have decorated. We would like to mention that we are extremely satisfied with all the work carried out, but we were particularly impressed with the respect you gave us and our home, and for making sure that all was clean and tidy before you left each day, as you knew I was worried about that!",
        "author" => "Mark & Claire P.",
        "location" => "Garstang, Lancashire",
        "type" => "Double Bedroom & Bathroom Dormer",
        "tag" => "Two-Bedroom Dormer",
        "img" => "images/another-area-loft-conversions-north-west-england-04.jpeg"
    ],
    [
        "quote" => "It was an absolute pleasure working with you and your team. We put our trust in you and your company and it paid off. The work done in our loft conversion is to a very high standard and we are so pleased with the final room. I have passed your details onto a friend in Rossendale who is wanting a loft conversion.",
        "author" => "Dr & Mrs Bennett",
        "location" => "Cheadle, Stockport",
        "type" => "Wrap-Around Conversion",
        "tag" => "Master Suite",
        "img" => "images/another-area-loft-conversions-north-west-england-05.jpeg"
    ],
    [
        "quote" => "We are writing to express our gratitude for the conversion you recently completed at our home. Everything was completed to a high standard and on time as promised and the level of communication you demonstrated was excellent. We are so very pleased with the finished bedroom and we will certainly be recommending you in the future.",
        "author" => "Stephen & Lisa T.",
        "location" => "Blackpool, Lancashire",
        "type" => "Rear Dormer Conversion",
        "tag" => "Coastal Semi Dormer",
        "img" => "images/another-area-loft-conversions-north-west-england-15.jpeg"
    ],
    [
        "quote" => "Many thanks for our new room, we are very impressed with Another Level Loft Conversions and with everyone who has been involved. The team were friendly, hardworking and finished ahead of schedule.",
        "author" => "Mr Keith Bradley",
        "location" => "Cherry Tree Close, Chorley",
        "type" => "Hip-End Dormer Conversion",
        "tag" => "Guest Bedroom",
        "img" => "images/another-area-loft-conversions-north-west-england-18.jpeg"
    ],
    [
        "quote" => "I want to say a big thank you for our loft conversion. We are both extremely pleased with all the work that has been done. We will have no hesitation in recommending you to our friends. Thanks again.",
        "author" => "Nigel & Angela W.",
        "location" => "Auburn Road, Manchester",
        "type" => "Rear Dormer Conversion",
        "tag" => "Victorian Terrace Dormer",
        "img" => "images/another-area-loft-conversions-north-west-england-22.jpeg"
    ],
    [
        "quote" => "We couldn’t be any happier with our finished bedrooms, thank you so much for all you’ve done. Please feel free to contact us for any recommendations. The children love their new rooms!",
        "author" => "The Davies Family",
        "location" => "Burnside Road, Blackpool",
        "type" => "Full Loft Conversion",
        "tag" => "Twin Kids Bedrooms",
        "img" => "images/another-area-loft-conversions-north-west-england-23.jpeg"
    ],
    [
        "quote" => "We just wanted to write to you to tell you we are amazed at how quick and efficient the loft conversion has been carried out. We have already recommended you to a neighbour who came round to look at the finish.",
        "author" => "Peter & Joan M.",
        "location" => "Bury, Greater Manchester",
        "type" => "Velux Conversion",
        "tag" => "Quiet Home Office",
        "img" => "images/another-area-loft-conversions-north-west-england-11.jpeg"
    ]
];

include 'includes/header.php';
?>

<main>

  <!-- Hero Section & Live Verified Scorecard -->
  <section class="testimonials-hero-section">
    <div class="testimonials-hero-grid">
      
      <!-- Left: Headline & Core Guarantees -->
      <div style="display:flex;flex-direction:column;gap:18px">
        
        <!-- Embedded Breadcrumb & Live Score Badge -->
        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px">
          <nav aria-label="Breadcrumb" class="breadcrumb-inline">
            <a href="index.php">Home</a>
            <span class="crumb-sep">/</span>
            <a href="about.php">About</a>
            <span class="crumb-sep">/</span>
            <span class="crumb-current" aria-current="page">Testimonials</span>
          </nav>
          <span style="color:#D4D4CC;font-size:12px">•</span>
          <span style="font-family:var(--font-sans);display:inline-flex;align-items:center;gap:6px;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 11px;border-radius:14px;color:#3E5C32;font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase">
            <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
            Verified 9.8 / 10 Score
          </span>
        </div>

        <h1 class="heading-h1" style="font-family:var(--font-serif);font-size:clamp(34px,4.8vw,56px);letter-spacing:-.025em;line-height:1.14;font-weight:400;margin:0;color:#1A1A1A">
          Real reviews from real North West homeowners.
        </h1>
        
        <p class="lead-text" style="font-family:var(--font-sans);font-size:clamp(16px,1.8vw,17.5px);color:#4A4A45;line-height:1.7;margin:0;max-width:54ch">
          Every review below is from a real customer whose conversion we designed, built, and handed over across Lancashire, Greater Manchester, and Cheshire. We take pride in polite craftsmen, spotless daily clean-ups, transparent fixed pricing, and £0 upfront deposit.
        </p>

        <div class="hero-actions-row" style="margin-top:4px">
          <a href="#booking" data-open-booking class="btn-primary hero-btn">
            <span>Book Free Survey</span>
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
          </a>
          <a href="#reviews-grid" class="btn-secondary hero-btn">Read Reviews Below</a>
        </div>

        <!-- Quick Trust Pill Row -->
        <div style="display:flex;flex-wrap:wrap;gap:14px;margin-top:8px;padding-top:16px;border-top:1px solid #EAEAE4;font-family:var(--font-sans);font-size:13px;color:#3E5C32;font-weight:600">
          <span style="display:inline-flex;align-items:center;gap:6px">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            400+ Completed Lofts
          </span>
          <span style="display:inline-flex;align-items:center;gap:6px">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            100% Fixed Price Quotes
          </span>
          <span style="display:inline-flex;align-items:center;gap:6px">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="#4F6B42" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            £0 Upfront Deposit
          </span>
        </div>
      </div>

      <!-- Right: Checkatrade Verified Live Reputation Scorecard -->
      <div class="testimonials-scorecard">
        
        <!-- Scorecard Header -->
        <div class="testimonials-score-header">
          <div>
            <span class="testimonials-score-badge">
              <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
              Verified Reputation
            </span>
            <h2 style="font-family:var(--font-serif);font-size:22px;margin:0;color:#1A1A1A;font-weight:400">Checkatrade Certified</h2>
          </div>
          <div style="text-align:right">
            <span class="testimonials-score-num">9.8<span>/10</span></span>
            <span style="color:#E29B27;font-size:14px;letter-spacing:.08em;display:block;margin-top:2px">★★★★★</span>
          </div>
        </div>

        <!-- 4 Metric Breakdown Bars -->
        <div class="testimonials-breakdown-grid">
          
          <div class="testimonials-metric-row">
            <div class="testimonials-metric-info">
              <span>🧹 Tidiness &amp; Dust Protection</span>
              <span class="testimonials-metric-val">10 / 10</span>
            </div>
            <div class="testimonials-metric-bar">
              <div class="testimonials-metric-fill" style="width:100%"></div>
            </div>
          </div>

          <div class="testimonials-metric-row">
            <div class="testimonials-metric-info">
              <span>⏱ Reliability &amp; Timekeeping</span>
              <span class="testimonials-metric-val">9.9 / 10</span>
            </div>
            <div class="testimonials-metric-bar">
              <div class="testimonials-metric-fill" style="width:99%"></div>
            </div>
          </div>

          <div class="testimonials-metric-row">
            <div class="testimonials-metric-info">
              <span>🔨 Workmanship &amp; Build Quality</span>
              <span class="testimonials-metric-val">9.8 / 10</span>
            </div>
            <div class="testimonials-metric-bar">
              <div class="testimonials-metric-fill" style="width:98%"></div>
            </div>
          </div>

          <div class="testimonials-metric-row">
            <div class="testimonials-metric-info">
              <span>💷 Quote Accuracy (£0 Hidden Extras)</span>
              <span class="testimonials-metric-val">9.9 / 10</span>
            </div>
            <div class="testimonials-metric-bar">
              <div class="testimonials-metric-fill" style="width:99%"></div>
            </div>
          </div>

        </div>

        <!-- Featured Customer Snippet -->
        <div class="testimonials-featured-quote">
          &ldquo;Your staff were polite and we felt they respected our home from start to finish. The whole process ran smoothly.&rdquo;
          <span class="testimonials-featured-author">&mdash; Mr &amp; Mrs Roberts, Leyland (Rear Dormer)</span>
        </div>

        <!-- Checkatrade Link Button -->
        <a href="https://www.checkatrade.com/trades/AnotherLevelLoftConversionsNw" target="_blank" rel="noopener noreferrer" class="testimonials-checkatrade-btn">
          <span>Read all 400+ Checkatrade reviews</span>
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>

      </div>

    </div>
  </section>

  <!-- Interactive Filter & Testimonials Grid -->
  <section class="section-padding bg-white border-bottom">
    <div class="container">
      
      <!-- Filter Bar -->
      <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;margin-bottom:36px">
        <div>
          <span class="section-label" style="display:inline-flex;align-items:center;gap:6px">
            <span style="width:6px;height:6px;border-radius:50%;background:#6B8E5A;display:inline-block"></span>
            Homeowner Testimonials
          </span>
          <h2 class="heading-h2" style="font-family:var(--font-serif);font-size:clamp(26px,3.5vw,38px);margin:8px 0;color:#1A1A1A;font-weight:400">
            Verified Experiences from Across the North West
          </h2>
        </div>

        <!-- Filter Pill Controls -->
        <div style="display:flex;flex-wrap:wrap;gap:8px;font-family:var(--font-sans);font-size:13px" role="tablist" aria-label="Filter reviews by conversion type">
          <button type="button" onclick="filterReviews('all', this)" class="review-filter-btn active" style="background:#4F6B42;color:#FFFFFF;border:1px solid #4F6B42;padding:6px 14px;border-radius:20px;cursor:pointer;font-weight:600;transition:all .2s">All (10)</button>
          <button type="button" onclick="filterReviews('Rear Dormer', this)" class="review-filter-btn" style="background:#FAF9F5;color:#4A4A45;border:1px solid #E2E5DF;padding:6px 14px;border-radius:20px;cursor:pointer;font-weight:500;transition:all .2s">Dormers</button>
          <button type="button" onclick="filterReviews('Hip-to-Gable', this)" class="review-filter-btn" style="background:#FAF9F5;color:#4A4A45;border:1px solid #E2E5DF;padding:6px 14px;border-radius:20px;cursor:pointer;font-weight:500;transition:all .2s">Hip-to-Gable</button>
          <button type="button" onclick="filterReviews('Velux', this)" class="review-filter-btn" style="background:#FAF9F5;color:#4A4A45;border:1px solid #E2E5DF;padding:6px 14px;border-radius:20px;cursor:pointer;font-weight:500;transition:all .2s">Velux</button>
          <button type="button" onclick="filterReviews('Wrap-Around', this)" class="review-filter-btn" style="background:#FAF9F5;color:#4A4A45;border:1px solid #E2E5DF;padding:6px 14px;border-radius:20px;cursor:pointer;font-weight:500;transition:all .2s">Wrap-Around</button>
        </div>
      </div>

      <!-- Testimonial Cards Grid -->
      <div id="reviews-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:24px">
        <?php foreach ($testimonials as $item): ?>
          <article class="review-card" data-category="<?php echo htmlspecialchars($item['type']); ?>" style="background:#FFFFFF;border:1px solid #E2E5DF;border-radius:12px;overflow:hidden;display:flex;flex-direction:column;justify-content:space-between;box-shadow:0 3px 12px rgba(0,0,0,0.03);transition:border-color .2s ease,box-shadow .2s ease" onmouseover="this.style.borderColor='#A9C699';this.style.boxShadow='0 8px 24px -4px rgba(24,34,22,0.08)'" onmouseout="this.style.borderColor='#E2E5DF';this.style.boxShadow='0 3px 12px rgba(0,0,0,0.03)'">
            
            <!-- Card Top (Photo + Badges) -->
            <div>
              <div style="position:relative;overflow:hidden;aspect-ratio:16/10">
                <img src="<?php echo $item['img']; ?>" alt="<?php echo htmlspecialchars($item['tag']); ?>" style="width:100%;height:100%;object-fit:cover;display:block" loading="lazy">
                <span style="position:absolute;top:10px;left:10px;background:rgba(26,36,24,0.85);color:#FFFFFF;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:10.5px;font-weight:700;letter-spacing:.04em;text-transform:uppercase">
                  <?php echo htmlspecialchars($item['type']); ?>
                </span>
                <span style="position:absolute;top:10px;right:10px;background:rgba(255,255,255,0.92);color:#2A2A28;backdrop-filter:blur(4px);padding:3px 9px;border-radius:12px;font-family:var(--font-sans);font-size:11px;font-weight:600">
                  📍 <?php echo htmlspecialchars($item['location']); ?>
                </span>
              </div>

              <!-- Card Quote Body -->
              <div style="padding:20px 20px 0">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px">
                  <span style="color:#E29B27;font-size:14px;letter-spacing:.08em">★★★★★</span>
                  <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:2px 8px;border-radius:10px">
                    <?php echo htmlspecialchars($item['tag']); ?>
                  </span>
                </div>
                <p style="font-family:var(--font-serif);font-size:16.5px;color:#2A2A26;line-height:1.6;margin:0 0 16px;font-style:italic">
                  &ldquo;<?php echo htmlspecialchars($item['quote']); ?>&rdquo;
                </p>
              </div>
            </div>

            <!-- Card Bottom (Author & Verification) -->
            <div style="padding:14px 20px 18px">
              <div style="padding-top:12px;border-top:1px solid #EDEDE8;display:flex;align-items:center;justify-content:space-between">
                <div>
                  <strong style="font-family:var(--font-sans);font-size:14px;color:#1A1A1A;display:block;font-weight:700">
                    <?php echo htmlspecialchars($item['author']); ?>
                  </strong>
                  <span style="font-family:var(--font-sans);font-size:11.5px;color:#6B8E5A;font-weight:600">
                    Verified Homeowner
                  </span>
                </div>
                <span style="font-family:var(--font-sans);font-size:11px;font-weight:700;color:#3E5C32;background:#F1F7EE;border:1px solid #DFEBD9;padding:3px 8px;border-radius:8px">
                  10-Yr Guarantee ✓
                </span>
              </div>
            </div>

          </article>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- Interactive Filter Script -->
  <script>
    function filterReviews(category, btn) {
      // Update Button Styles
      document.querySelectorAll('.review-filter-btn').forEach(b => {
        b.classList.remove('active');
        b.style.backgroundColor = '#FAF9F5';
        b.style.color = '#4A4A45';
        b.style.borderColor = '#E2E5DF';
        b.style.fontWeight = '500';
      });
      btn.classList.add('active');
      btn.style.backgroundColor = '#4F6B42';
      btn.style.color = '#FFFFFF';
      btn.style.borderColor = '#4F6B42';
      btn.style.fontWeight = '600';

      // Filter Cards
      const cards = document.querySelectorAll('.review-card');
      cards.forEach(card => {
        const cat = card.getAttribute('data-category') || '';
        if (category === 'all' || cat.toLowerCase().includes(category.toLowerCase())) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }
  </script>

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
