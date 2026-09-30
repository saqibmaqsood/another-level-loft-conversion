<?php
if (!isset($widgetHeading)) {
    $widgetHeading = "Book your free survey";
}
?>
<div class="booking-widget-card">
  <div style="display:grid;grid-template-columns:1fr;gap:0">
    <div class="booking-header">
      <div>
        <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:#6B8E5A;margin-bottom:8px">Free survey booking</div>
        <h3 style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(24px,3.4vw,32px);line-height:1.12;margin:0;letter-spacing:-.01em"><?php echo htmlspecialchars($widgetHeading); ?></h3>
      </div>
      <div class="booking-step-label">Step 1 / 3</div>
    </div>

    <div class="booking-progress-track">
      <div class="booking-progress-fill"></div>
    </div>

    <div class="booking-panel-body">
      <!-- Dynamically filled by js/booking.js with initial Step 1 fallback markup -->
      <div>
        <div style="margin-bottom:20px">
          <h4 style="font-family:Newsreader,Georgia,serif;font-size:21px;font-weight:400;color:#1A1A1A;margin:0 0 4px">What kind of property is it?</h4>
          <p style="font-size:14px;line-height:1.5;color:#666660;margin:0">Select your house type to check possible conversion options.</p>
        </div>
        <div class="booking-property-grid">
          <button type="button" class="property-select-btn" data-prop="Terrace" aria-pressed="false">
            <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:44px">
              <svg viewBox="0 0 48 32" width="56" height="38" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true">
                <path d="M4 30V14l10-8 10 8v16M24 30V14l10-8 10 8v16M14 30v-8h10v8"></path>
              </svg>
            </div>
            <div style="font-size:14px;font-weight:600;margin-top:12px">Terrace</div>
            <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:4px">40m³ limit</div>
          </button>
          <button type="button" class="property-select-btn" data-prop="Semi-detached" aria-pressed="false">
            <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:44px">
              <svg viewBox="0 0 48 32" width="56" height="38" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true">
                <path d="M8 30V13l12-9 12 9v17M20 30V13M14 30v-7h12v7"></path>
              </svg>
            </div>
            <div style="font-size:14px;font-weight:600;margin-top:12px">Semi-detached</div>
            <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:4px">Most common</div>
          </button>
          <button type="button" class="property-select-btn" data-prop="Detached" aria-pressed="false">
            <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:44px">
              <svg viewBox="0 0 48 32" width="56" height="38" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true">
                <path d="M8 30V14l16-10 16 10v16zM19 30v-8h10v8"></path>
              </svg>
            </div>
            <div style="font-size:14px;font-weight:600;margin-top:12px">Detached</div>
            <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:4px">50m³ limit</div>
          </button>
          <button type="button" class="property-select-btn" data-prop="Bungalow" aria-pressed="false">
            <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:44px">
              <svg viewBox="0 0 48 32" width="56" height="38" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true">
                <path d="M4 30V18l20-12 20 12v12zM18 30v-7h12v7"></path>
              </svg>
            </div>
            <div style="font-size:14px;font-weight:600;margin-top:12px">Bungalow</div>
            <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:4px">Roof-lift option</div>
          </button>
        </div>
        <div class="form-error"></div>
      </div>
    </div>

    <div class="booking-footer-nav">
      <button type="button" class="btn-nav-back btn-booking-back" disabled>Back</button>
      <button type="button" class="btn-primary btn-booking-next" style="padding:14px 26px;font-size:15px">Continue</button>
    </div>
  </div>
</div>
