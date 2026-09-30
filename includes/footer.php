<?php
$footerTypes = [
    ['label' => 'All conversion types', 'href' => 'conversion-types.php'],
    ['label' => 'Velux', 'href' => 'velux-conversion.php'],
    ['label' => 'Rear Dormer', 'href' => 'rear-dormer-conversion.php'],
    ['label' => 'Hip-to-Gable', 'href' => 'hip-to-gable-conversion.php'],
    ['label' => 'Hip-End Dormer', 'href' => 'hip-end-dormer-conversion.php'],
    ['label' => 'Wrap Around', 'href' => 'wrap-around-conversion.php'],
    ['label' => 'Roof-Lift', 'href' => 'roof-lift-conversion.php']
];

$footerProperties = [
    ['label' => 'All property types', 'href' => 'property-types.php'],
    ['label' => 'Terrace', 'href' => 'terrace-property.php'],
    ['label' => 'Semi-detached', 'href' => 'semi-detached-property.php'],
    ['label' => 'Detached', 'href' => 'detached-property.php'],
    ['label' => 'Bungalow', 'href' => 'bungalow-property.php']
];

$footerAreas = [
    ['label' => 'Bolton', 'href' => 'loft-conversions-in-bolton.php'],
    ['label' => 'Manchester', 'href' => 'loft-conversions-in-manchester.php'],
    ['label' => 'Preston', 'href' => 'loft-conversions-in-preston.php'],
    ['label' => 'Stockport', 'href' => 'loft-conversions-in-stockport.php'],
    ['label' => 'Warrington', 'href' => 'loft-conversions-in-warrington.php'],
    ['label' => 'All 41 areas', 'href' => 'index.php#areas']
];

$badges = ['VELUX Certified', 'Gas Safe', 'NIC EIC', 'Checkatrade'];
?>

  <footer class="site-footer">
    <div class="footer-grid">
      <div class="footer-col">
        <span class="footer-brand">
          <span class="brand-icon" style="width:26px;height:26px"></span>
          <span class="footer-brand-title">Another Level</span>
        </span>
        <p style="margin:0;font-size:14px;line-height:1.7">Old Docks House, 90 Watery Lane, Preston PR2 1AU</p>
        <a href="tel:08000862744" class="footer-phone-main">0800 0862744</a>
        <a href="tel:01614100155" class="footer-phone-sub">Manchester 0161 4100155</a>
        <a href="tel:01772393005" class="footer-phone-sub">Preston 01772 393005</a>
      </div>

      <nav aria-label="Conversion types" class="footer-nav">
        <span class="footer-nav-title">Conversions</span>
        <?php foreach ($footerTypes as $l): ?>
          <a href="<?php echo $l['href']; ?>"><?php echo $l['label']; ?></a>
        <?php endforeach; ?>
      </nav>

      <nav aria-label="Property types" class="footer-nav">
        <span class="footer-nav-title">Property types</span>
        <?php foreach ($footerProperties as $l): ?>
          <a href="<?php echo $l['href']; ?>"><?php echo $l['label']; ?></a>
        <?php endforeach; ?>
      </nav>

      <nav aria-label="Company info" class="footer-nav">
        <span class="footer-nav-title">About &amp; Process</span>
        <a href="about.php">About Us</a>
        <a href="start-to-finish-how-your-loft-is-built.php">How We Build (Process)</a>
        <a href="our-guarantee.php">Our 6-Year Guarantee</a>
        <a href="customer-testimonials.php">Customer Reviews</a>
        <a href="gallery.php">Before &amp; After Gallery</a>
        <a href="contact.php">Contact Us</a>
      </nav>

      <div class="footer-col">
        <span class="footer-nav-title">Accreditations</span>
        <div class="footer-accreditation-logos">
          <div class="footer-logo-wrap" title="Checkatrade Proud Member">
            <img src="images/checkatrade-proud-member.png" alt="Checkatrade Proud Member" class="footer-accred-img" loading="lazy">
          </div>
          <div class="footer-logo-wrap" title="NICEIC Approved Contractor">
            <img src="images/logo-niceic.jpg" alt="NICEIC Approved Contractor" class="footer-accred-img" loading="lazy">
          </div>
          <div class="footer-logo-wrap velux-card" title="VELUX Certified">
            <img src="images/logo-velux.jpg" alt="VELUX Certified" class="footer-accred-img" loading="lazy">
          </div>
          <div class="footer-logo-wrap gas-safe-card" title="Gas Safe Register">
            <img src="images/logo-gas-safe.jpg" alt="Gas Safe Register" class="footer-accred-img" loading="lazy">
          </div>
        </div>
        <div class="social-links" style="margin-top:16px">
          <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="social-btn">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="social-btn">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <span>&copy; <?php echo date('Y'); ?> Another Level Loft Conversions (NW) Ltd</span>
      <div class="footer-bottom-links">
        <a href="terms-conditions.php">Terms &amp; Conditions</a>
        <a href="our-guarantee.php">Guarantee</a>
        <a href="privacy-cookies-policy.php">Privacy &amp; Cookies</a>
        <a href="panel/" target="_blank" rel="noopener" style="opacity:0.75">&bull; Operations Panel</a>
      </div>
    </div>

    <div class="mobile-bar-spacer"></div>
  </footer>

  <!-- Fixed Mobile Sticky Dock -->
  <div class="mobile-sticky-dock">
    <div class="mobile-sticky-dock-inner">
      <a href="tel:08000862744" class="dock-btn dock-call" aria-label="Call 0800 0862744">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
        <span>Call</span>
      </a>

      <a href="javascript:void(0)" onclick="openAIChat(event)" class="dock-btn dock-chat" aria-label="Live Chat">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg>
        <span>Live Chat</span>
      </a>

      <a href="#booking" data-open-booking class="dock-btn dock-book" aria-label="Book Free Survey">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19a2 2 0 002 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
        <span>Book Free Survey</span>
      </a>
    </div>
  </div>

</div><!-- End page-wrapper -->

<?php include_once __DIR__ . '/chat-widget.php'; ?>

</body>
</html>
