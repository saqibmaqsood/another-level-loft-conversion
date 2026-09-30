<!-- Accessible Survey Booking Modal Dialog -->
<div class="booking-modal-overlay" role="dialog" aria-modal="true" aria-label="Book your free survey">
  <div class="booking-modal-panel">
    <button type="button" class="booking-modal-close" aria-label="Close booking form">&times;</button>
    <?php 
      $widgetHeading = "Book your free survey";
      include __DIR__ . '/booking-widget.php'; 
    ?>
  </div>
</div>
