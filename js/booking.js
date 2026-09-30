/**
 * Another Level Loft Conversions - Interactive Booking System & Modal
 * Real-time availability sync, live slot locking, and API integration
 */

// Shared cache for active booked slots across all widget instances
window.ALBookedSlots = window.ALBookedSlots || [];
window.ALBookedSlotsFetched = false;

async function fetchBookedSlots(force = false) {
  if (window.ALBookedSlotsFetched && !force) {
    return window.ALBookedSlots;
  }
  try {
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), 3000);
    const res = await fetch('api/get-booked-slots.php', { signal: controller.signal });
    clearTimeout(timeoutId);
    if (res.ok) {
      const data = await res.json();
      if (data.success && Array.isArray(data.booked_slots)) {
        window.ALBookedSlots = data.booked_slots;
        window.ALBookedSlotsFetched = true;
      }
    }
  } catch (err) {
    console.warn('[Booking] Could not fetch booked slots:', err);
  }
  return window.ALBookedSlots;
}

// Pre-fetch slots on script load in background
fetchBookedSlots();

class BookingWidget {
  constructor(element, options = {}) {
    this.container = element;
    this.options = options;
    this.year = 2026;
    this.month = 9; // September (1-indexed)
    this.isSubmitting = false;

    this.state = {
      step: 1,
      property: options.prefillProperty || '',
      postcode: (options.prefillPostcode || window.ALDefaultPostcode || '').trim(),
      postcodeStatus: null,
      postcodeInfo: null,
      postcodeError: null,
      address: '',
      height: '',
      notSure: false,
      day: null,
      slot: '',
      name: '',
      phone: '',
      email: '',
      errors: {},
      done: false
    };

    this.postcodeDebounceTimer = null;

    if (this.state.property || this.state.postcode) {
      this.state.step = 2;
    }

    this.init();
  }

  init() {
    this.render();
    this.bindEvents();
    if (this.state.postcode && this.state.postcode.length >= 5) {
      this.verifyPostcodeImmediate(this.state.postcode);
    }
    fetchBookedSlots().then(() => {
      if (this.state.step === 3) {
        this.render();
      }
    }).catch(() => {});
  }

  setState(updates) {
    this.state = { ...this.state, ...updates };
    this.render();
  }

  renderPostcodeBadge() {
    const s = this.state;
    if (s.postcodeStatus === 'checking') {
      return `<span style="display:inline-flex;align-items:center;gap:4px;font-size:11.5px;color:#4B5563">
        <span style="display:inline-block;width:9px;height:9px;border:2px solid #9CA3AF;border-top-color:#3B82F6;border-radius:50%;animation:al-spin 0.8s linear infinite"></span>
        <span>Checking...</span>
      </span>`;
    }
    if (s.postcodeStatus === 'valid') {
      const town = s.postcodeInfo?.town || s.postcodeInfo?.county || 'UK Area';
      return `<span style="display:inline-flex;align-items:center;gap:4px;font-size:11.5px;font-weight:600;color:#15803D;background:#F0FDF4;padding:1px 7px;border-radius:4px;border:1px solid #BBF7D0">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <span>Verified: ${town}</span>
      </span>`;
    }
    if (s.postcodeStatus === 'invalid') {
      const shortErr = s.postcodeError && s.postcodeError.length > 25 ? 'Unrecognised code' : (s.postcodeError || 'Invalid code');
      return `<span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;color:#B91C1C;background:#FEF2F2;padding:1px 6px;border-radius:4px;border:1px solid #FECACA" title="${s.postcodeError || ''}">
        <span>⚠️ ${shortErr}</span>
      </span>`;
    }
    return `<span style="font-size:11px;color:#718096;font-weight:500">UK Coverage Check</span>`;
  }

  handlePostcodeVerify(rawPostcode) {
    clearTimeout(this.postcodeDebounceTimer);
    const clean = (rawPostcode || '').replace(/[^A-Za-z0-9]/g, '');
    
    if (clean.length < 5) {
      this.state.postcodeStatus = null;
      this.state.postcodeInfo = null;
      this.state.postcodeError = null;
      this.updateBadgeOnly();
      return;
    }

    this.state.postcodeStatus = 'checking';
    this.updateBadgeOnly();

    this.postcodeDebounceTimer = setTimeout(() => {
      this.verifyPostcodeImmediate(rawPostcode);
    }, 450);
  }

  async verifyPostcodeImmediate(rawPostcode) {
    const clean = (rawPostcode || '').replace(/[^A-Za-z0-9]/g, '');
    if (clean.length < 5) {
      this.state.postcodeStatus = null;
      this.updateBadgeOnly();
      return false;
    }

    try {
      const res = await fetch(`api/verify-postcode.php?postcode=${encodeURIComponent(rawPostcode)}`);
      const data = await res.json();
      if (data && data.success) {
        this.state.postcodeStatus = 'valid';
        this.state.postcode = data.postcode || this.state.postcode;
        this.state.postcodeInfo = {
          town: data.town || '',
          county: data.county || '',
          district: data.district || '',
          region: data.region || ''
        };
        this.state.postcodeError = null;
        this.updateBadgeOnly();

        // Update input field text to normalized format (e.g. PR1 2AB) without re-rendering everything
        const input = this.container.querySelector('.input-postcode');
        if (input && data.postcode && input.value.replace(/\s+/g, '').toUpperCase() === clean.toUpperCase()) {
          input.value = data.postcode;
        }
        return true;
      } else {
        this.state.postcodeStatus = 'invalid';
        this.state.postcodeInfo = null;
        this.state.postcodeError = data?.error || 'Unrecognised UK postcode. Please check.';
        this.updateBadgeOnly();
        return false;
      }
    } catch (e) {
      // In case of local network issue, if regex passes allow it
      this.state.postcodeStatus = 'valid';
      this.state.postcodeInfo = { town: 'UK Postcode' };
      this.state.postcodeError = null;
      this.updateBadgeOnly();
      return true;
    }
  }

  updateBadgeOnly() {
    const badgeContainer = this.container.querySelector('#postcodeVerifyBadge');
    if (badgeContainer) {
      badgeContainer.innerHTML = this.renderPostcodeBadge();
    }
  }

  getDateString(day) {
    if (!day) return '';
    const m = String(this.month).padStart(2, '0');
    const d = String(day).padStart(2, '0');
    return `${this.year}-${m}-${d}`;
  }

  isSlotBooked(day, slotName) {
    if (!day || !slotName) return false;
    const dateStr = this.getDateString(day);
    return window.ALBookedSlots.some((b) => {
      return b.date === dateStr && b.slot.toLowerCase() === slotName.toLowerCase();
    });
  }

  isDayFullyBooked(day) {
    if (!day) return false;
    const slots = ['Morning', 'Afternoon', 'Evening'];
    return slots.every((s) => this.isSlotBooked(day, s));
  }

  validate() {
    const s = this.state;
    const errors = {};

    if (s.step === 1) {
      if (!s.property) errors.property = 'Pick a property type to continue.';
    } else if (s.step === 2) {
      const cleanPostcode = (s.postcode || '').replace(/[^A-Za-z0-9]/g, '');
      if (!s.postcode.trim() || cleanPostcode.length < 5) {
        errors.step2 = 'Enter a valid UK postcode (e.g. PR1 2AB, BL1 4QR).';
      } else if (s.postcodeStatus === 'invalid') {
        errors.step2 = s.postcodeError || 'This postcode was not found in the UK National database.';
      } else if (!s.address || !s.address.trim()) {
        errors.step2 = 'Please enter your house number & street address to proceed.';
      } else if (!s.notSure && !s.height.trim()) {
        errors.step2 = 'Add a rough loft height, or tick "I\u2019m not sure".';
      }
    } else if (s.step === 3) {
      if (!s.day || !s.slot) {
        errors.step3 = 'Choose an available survey date and time slot.';
      } else if (this.isSlotBooked(s.day, s.slot)) {
        errors.step3 = 'The chosen slot is already booked. Please pick another.';
      } else if (!s.name.trim() || !s.phone.trim()) {
        errors.step3 = 'Full name and phone number are required to confirm.';
      } else if (s.email && !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(s.email)) {
        errors.step3 = 'That email address looks incomplete.';
      }
    }

    return errors;
  }

  async submitBooking() {
    const s = this.state;
    this.isSubmitting = true;
    this.render();

    const payload = {
      property_type: s.property,
      postcode: s.postcode,
      address: s.address,
      loft_height: s.height,
      not_sure_height: s.notSure ? 1 : 0,
      preferred_date: this.getDateString(s.day),
      preferred_slot: s.slot,
      name: s.name,
      phone: s.phone,
      email: s.email,
      page_url: window.location.pathname + window.location.search,
      referrer_url: document.referrer || ''
    };

    try {
      const res = await fetch('api/submit-booking.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });

      const data = await res.json();

      if (res.ok && data.success) {
        // Add to booked list so UI remains blocked
        window.ALBookedSlots.push({
          date: payload.preferred_date,
          slot: payload.preferred_slot
        });

        // Trigger Google Analytics & GTM Conversion Event
        try {
          if (typeof window.gtag === 'function') {
            window.gtag('event', 'generate_lead', {
              event_category: 'conversion',
              event_label: `Survey Booking: ${payload.property_type} (${payload.postcode})`,
              value: 1
            });
          }
          if (window.dataLayer && Array.isArray(window.dataLayer)) {
            window.dataLayer.push({
              event: 'survey_booked',
              property_type: payload.property_type,
              postcode: payload.postcode,
              booking_date: payload.preferred_date
            });
          }
          if (window.ALTrack && typeof window.ALTrack.trackLead === 'function') {
            window.ALTrack.trackLead(`Survey Booking: ${payload.property_type} (${payload.postcode})`);
          }
        } catch (e) {}

        this.isSubmitting = false;
        this.setState({ done: true, errors: {} });
      } else {
        // Collision or server error
        await fetchBookedSlots(true);
        this.isSubmitting = false;
        this.setState({
          errors: {
            step3: data.error || 'This slot is no longer available. Please choose another date or slot.'
          }
        });
      }
    } catch (err) {
      this.isSubmitting = false;
      this.setState({
        errors: {
          step3: 'A connection error occurred. Please call 0800 0862744 or try again.'
        }
      });
    }
  }

  async next() {
    if (this.state.step === 2) {
      const clean = (this.state.postcode || '').replace(/[^A-Za-z0-9]/g, '');
      if (clean.length >= 5 && this.state.postcodeStatus !== 'valid') {
        const ok = await this.verifyPostcodeImmediate(this.state.postcode);
        if (!ok) {
          this.setState({
            errors: { step2: this.state.postcodeError || 'Please enter a valid UK postcode.' }
          });
          return;
        }
      }
    }

    const errors = this.validate();
    if (Object.keys(errors).length > 0) {
      this.setState({ errors });
      return;
    }

    if (this.state.step === 3) {
      await this.submitBooking();
      return;
    }

    this.setState({ step: this.state.step + 1, errors: {} });
  }

  back() {
    if (this.state.step > 1) {
      this.setState({ step: this.state.step - 1, errors: {} });
    }
  }

  reset() {
    this.setState({
      step: 1,
      property: '',
      postcode: '',
      postcodeStatus: null,
      postcodeInfo: null,
      postcodeError: null,
      address: '',
      height: '',
      notSure: false,
      day: null,
      slot: '',
      name: '',
      phone: '',
      email: '',
      errors: {},
      done: false
    });
  }

  render() {
    const s = this.state;
    const progress = s.done ? '100%' : `${Math.round((s.step / 3) * 100)}%`;
    const stepLabel = s.done ? 'Booked' : `Step ${s.step} / 3`;

    // 1. Update Progress & Step Labels
    const progressFill = this.container.querySelector('.booking-progress-fill');
    if (progressFill) progressFill.style.width = progress;

    const stepLabelEl = this.container.querySelector('.booking-step-label');
    if (stepLabelEl) stepLabelEl.textContent = stepLabel;

    // 2. Panel Content
    const panel = this.container.querySelector('.booking-panel-body');
    if (!panel) return;

    if (s.done) {
      panel.innerHTML = `
        <div style="padding:16px 0 8px;max-width:52ch">
          <div style="width:56px;height:56px;border-radius:50%;background:#4F6B42;margin:0 0 22px;display:flex;align-items:center;justify-content:center">
            <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M4 12.5l5 5L20 6.5"></path>
            </svg>
          </div>
          <h4 style="font-family:Newsreader,Georgia,serif;font-weight:400;font-size:clamp(24px,3.4vw,30px);line-height:1.15;margin:0 0 12px">Your survey is booked!</h4>
          <p style="font-size:16px;line-height:1.6;color:#1A1A1A;margin:0 0 6px">
            ${s.day ? `${s.day} September 2026 &bull; <strong>${s.slot}</strong> slot &bull; ${s.postcode || 'Your property'}` : 'Details confirmed'}
          </p>
          <p style="font-size:14px;line-height:1.65;color:#6B6B6B;margin:0;max-width:44ch">
            A confirmation email has been dispatched. Our team will call ${s.phone || 'you'} within one working day to confirm entry details. Your free 3D CAD design follows within a few days of the visit.
          </p>
          <button type="button" class="btn-booking-reset" style="margin-top:26px;background:none;border:none;border-bottom:1px solid #4F6B42;color:#4F6B42;font-size:14px;font-weight:600;padding:0 0 3px;cursor:pointer">Book another survey</button>
        </div>
      `;

      const navEl = this.container.querySelector('.booking-footer-nav');
      if (navEl) navEl.style.display = 'none';

      const resetBtn = panel.querySelector('.btn-booking-reset');
      if (resetBtn) resetBtn.addEventListener('click', () => this.reset());
      return;
    }

    const navEl = this.container.querySelector('.booking-footer-nav');
    if (navEl) navEl.style.display = 'flex';

    if (s.step === 1) {
      panel.innerHTML = `
        <div>
          <div style="margin-bottom:20px">
            <h4 style="font-family:Newsreader,Georgia,serif;font-size:21px;font-weight:400;color:#1A1A1A;margin:0 0 4px">What kind of property is it?</h4>
            <p style="font-size:14px;line-height:1.5;color:#666660;margin:0">Select your house type to check possible conversion options.</p>
          </div>
          <div class="booking-property-grid">
            <button type="button" class="property-select-btn ${s.property === 'Terrace' ? 'active' : ''}" data-prop="Terrace" aria-pressed="${s.property === 'Terrace'}">
              <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:44px">
                <svg viewBox="0 0 48 32" width="56" height="38" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true">
                  <path d="M4 30V14l10-8 10 8v16M24 30V14l10-8 10 8v16M14 30v-8h10v8"></path>
                </svg>
              </div>
              <div style="font-size:14px;font-weight:600;margin-top:12px">Terrace</div>
              <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:4px">40m³ limit</div>
            </button>
            <button type="button" class="property-select-btn ${s.property === 'Semi-detached' ? 'active' : ''}" data-prop="Semi-detached" aria-pressed="${s.property === 'Semi-detached'}">
              <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:44px">
                <svg viewBox="0 0 48 32" width="56" height="38" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true">
                  <path d="M8 30V13l12-9 12 9v17M20 30V13M14 30v-7h12v7"></path>
                </svg>
              </div>
              <div style="font-size:14px;font-weight:600;margin-top:12px">Semi-detached</div>
              <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:4px">Most common</div>
            </button>
            <button type="button" class="property-select-btn ${s.property === 'Detached' ? 'active' : ''}" data-prop="Detached" aria-pressed="${s.property === 'Detached'}">
              <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:44px">
                <svg viewBox="0 0 48 32" width="56" height="38" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true">
                  <path d="M8 30V14l16-10 16 10v16zM19 30v-8h10v8"></path>
                </svg>
              </div>
              <div style="font-size:14px;font-weight:600;margin-top:12px">Detached</div>
              <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:4px">50m³ limit</div>
            </button>
            <button type="button" class="property-select-btn ${s.property === 'Bungalow' ? 'active' : ''}" data-prop="Bungalow" aria-pressed="${s.property === 'Bungalow'}">
              <div style="display:flex;align-items:flex-end;justify-content:flex-start;height:44px">
                <svg viewBox="0 0 48 32" width="56" height="38" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true">
                  <path d="M4 30V18l20-12 20 12v12zM18 30v-7h12v7"></path>
                </svg>
              </div>
              <div style="font-size:14px;font-weight:600;margin-top:12px">Bungalow</div>
              <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B;margin-top:4px">Roof-lift option</div>
            </button>
          </div>
          <div class="form-error">${s.errors.property || ''}</div>
        </div>
      `;
    } else if (s.step === 2) {
      panel.innerHTML = `
        <div>
          <p style="font-size:15px;line-height:1.6;color:#6B6B6B;margin:0 0 22px;max-width:52ch">Where are we surveying, and roughly how tall is the loft? We cover Preston, Manchester, Lancashire and Cheshire.</p>
          <div class="booking-step2-grid">
            <!-- Row 1, Col 1: Postcode -->
            <label class="booking-step2-item-postcode" style="display:block">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:8px;min-height:22px">
                <span style="font-size:13px;font-weight:600;letter-spacing:.02em">Postcode *</span>
                <span id="postcodeVerifyBadge" style="display:inline-flex;align-items:center">${this.renderPostcodeBadge()}</span>
              </div>
              <input type="text" class="form-input-base input-postcode" value="${s.postcode}" placeholder="e.g. PR1 2AB or BL1 4QR" autocomplete="postal-code" />
            </label>

            <!-- Row 1, Col 2: Loft height -->
            <label class="booking-step2-item-height" style="display:block">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:8px;min-height:22px">
                <span style="font-size:13px;font-weight:600;letter-spacing:.02em">Loft height</span>
                <span style="font-size:11px;color:#718096;font-weight:500">Approximate</span>
              </div>
              <input type="text" class="form-input-base input-height" value="${s.height}" ${s.notSure ? 'disabled' : ''} placeholder="e.g. 2.4m" />
            </label>

            <!-- Row 2, Col 1: House number & street address -->
            <label class="booking-step2-item-address" style="display:block">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:8px;min-height:22px">
                <span style="font-size:13px;font-weight:600;letter-spacing:.02em">House number &amp; street address *</span>
              </div>
              <input type="text" class="form-input-base input-address" value="${s.address}" placeholder="e.g. 14 Victoria Road" autocomplete="street-address" required />
            </label>

            <!-- Row 2, Col 2: I'm not sure (Amny Samny with House number) -->
            <div class="booking-step2-item-notsure">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:8px;min-height:22px">
                <span style="font-size:12.5px;font-weight:600;letter-spacing:.01em;color:#555555">Measure floor to ridge beam (2.2m min)</span>
              </div>
              <button type="button" class="not-sure-btn ${s.notSure ? 'active' : ''}" aria-pressed="${s.notSure}">
                <span class="not-sure-check"></span>
                <span style="font-size:14px;font-weight:500;text-align:left">I'm not sure &mdash; measure it on the survey</span>
              </button>
            </div>
          </div>
          <div class="form-error">${s.errors.step2 || ''}</div>
        </div>
      `;
    } else if (s.step === 3) {
      // Days generator for Sept 2026 (Starts Tuesday, 30 days)
      let daysHtml = '<div style="border:none;background:none;padding:10px 0"></div>'; // Blank for Monday Sept 1st
      for (let d = 1; d <= 30; d++) {
        const dow = d % 7;
        const isSunday = dow === 6;
        const isPast = d < 3;
        const isFull = this.isDayFullyBooked(d);
        const disabled = isSunday || isPast || isFull;
        const active = s.day === d;

        daysHtml += `
          <button 
            type="button" 
            class="calendar-day-btn ${active ? 'active' : ''} ${isFull ? 'fully-booked' : ''}" 
            data-day="${d}" 
            ${disabled ? 'disabled' : ''} 
            title="${isFull ? 'All slots booked for this day' : `September ${d}`}"
            aria-label="September ${d}"
          >
            ${d}
          </button>
        `;
      }

      // Slot Buttons Rendering with Locked Availability
      const slots = [
        { name: 'Morning', time: '08:30 – 12:00' },
        { name: 'Afternoon', time: '12:00 – 16:30' },
        { name: 'Evening', time: '17:00 – 19:00' }
      ];

      let slotsHtml = '';
      slots.forEach((slotInfo) => {
        const isBooked = s.day ? this.isSlotBooked(s.day, slotInfo.name) : false;
        const isActive = s.slot === slotInfo.name && !isBooked;

        if (isBooked) {
          slotsHtml += `
            <button type="button" class="slot-btn already-booked" disabled aria-disabled="true" title="This slot is already booked by another homeowner">
              <div>
                <span style="font-size:14px;font-weight:600;display:block">${slotInfo.name}</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#8C8C85">${slotInfo.time}</span>
              </div>
              <span class="slot-booked-badge">
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                Already Booked
              </span>
            </button>
          `;
        } else {
          slotsHtml += `
            <button type="button" class="slot-btn ${isActive ? 'active' : ''}" data-slot="${slotInfo.name}" aria-pressed="${isActive}">
              <span style="font-size:14px;font-weight:600">${slotInfo.name}</span>
              <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B">${slotInfo.time}</span>
            </button>
          `;
        }
      });

      panel.innerHTML = `
        <div>
          <p style="font-size:15px;line-height:1.6;color:#6B6B6B;margin:0 0 22px;max-width:52ch">Pick an available date and time slot, and tell us who our surveyor should ask for.</p>
          <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:28px;align-items:start">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
                <span style="font-size:15px;font-weight:600">September 2026</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B6B6B">Mon &ndash; Sat</span>
              </div>
              <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:4px;font-family:'IBM Plex Mono',monospace;font-size:10px;color:#6B6B6B;margin-bottom:6px;text-align:center">
                <div>M</div><div>T</div><div>W</div><div>T</div><div>F</div><div>S</div><div>S</div>
              </div>
              <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:4px">
                ${daysHtml}
              </div>
            </div>
            <div>
              <div style="font-size:15px;font-weight:600;margin-bottom:14px">Preferred time ${s.day ? `(Sept ${s.day})` : ''}</div>
              <div style="display:grid;gap:8px">
                ${slotsHtml}
              </div>
              <p style="font-size:13px;line-height:1.6;color:#6B6B6B;margin:14px 0 0">Surveys take about 45 minutes. Locked slots update in real time.</p>
            </div>
          </div>
          <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:28px;padding-top:26px;border-top:1px solid #EDEDE8">
            <label style="display:block">
              <span style="display:block;font-size:13px;font-weight:600;margin-bottom:8px">Full name *</span>
              <input type="text" class="form-input-base input-name" value="${s.name}" placeholder="e.g. David Smith" autocomplete="name" required />
            </label>
            <label style="display:block">
              <span style="display:block;font-size:13px;font-weight:600;margin-bottom:8px">Phone number *</span>
              <input type="tel" class="form-input-base input-phone" value="${s.phone}" placeholder="e.g. 07700 900077" autocomplete="tel" required />
            </label>
            <label style="display:block">
              <span style="display:block;font-size:13px;font-weight:600;margin-bottom:8px">Email <span style="font-weight:400;color:#6B6B6B">(for instant CAD plans)</span></span>
              <input type="email" class="form-input-base input-email" value="${s.email}" placeholder="e.g. david@example.co.uk" autocomplete="email" />
            </label>
          </div>
          <div class="form-error" style="margin-top:14px">${s.errors.step3 || ''}</div>
          <p style="font-size:12px;line-height:1.6;color:#6B6B6B;margin:10px 0 0;max-width:60ch">By booking you agree to us using these details to arrange your survey. 100% free, no obligation, fixed written price.</p>
        </div>
      `;
    }

    // Update Back & Next Buttons
    const backBtn = this.container.querySelector('.btn-booking-back');
    if (backBtn) {
      backBtn.disabled = s.step === 1 || this.isSubmitting;
    }

    const nextBtn = this.container.querySelector('.btn-booking-next');
    if (nextBtn) {
      if (this.isSubmitting) {
        nextBtn.disabled = true;
        nextBtn.innerHTML = `
          <span style="display:inline-flex;align-items:center;gap:8px">
            <span class="spinner-sm" style="display:inline-block;width:14px;height:14px;border:2px solid #FFF;border-top-color:transparent;border-radius:50%;animation:spin 0.8s linear infinite"></span>
            <span>Securing your slot...</span>
          </span>
        `;
      } else {
        nextBtn.disabled = false;
        nextBtn.textContent = s.step === 3 ? 'Confirm & Book Free Survey' : 'Continue';
      }
    }
  }

  bindEvents() {
    this.container.addEventListener('click', (e) => {
      // Step 1: Property
      const propBtn = e.target.closest('.property-select-btn');
      if (propBtn) {
        const prop = propBtn.getAttribute('data-prop');
        this.setState({ property: prop, errors: {} });
        return;
      }

      // Step 2: Not sure
      const notSureBtn = e.target.closest('.not-sure-btn');
      if (notSureBtn) {
        this.setState({ notSure: !this.state.notSure, errors: {} });
        return;
      }

      // Step 3: Day
      const dayBtn = e.target.closest('.calendar-day-btn:not(:disabled)');
      if (dayBtn) {
        const day = parseInt(dayBtn.getAttribute('data-day'), 10);
        // Clear slot if the previously chosen slot is booked on the new day
        let newSlot = this.state.slot;
        if (newSlot && this.isSlotBooked(day, newSlot)) {
          newSlot = '';
        }
        this.setState({ day, slot: newSlot, errors: {} });
        return;
      }

      // Step 3: Slot (only if not disabled / booked)
      const slotBtn = e.target.closest('.slot-btn:not(:disabled):not(.already-booked)');
      if (slotBtn) {
        const slot = slotBtn.getAttribute('data-slot');
        this.setState({ slot, errors: {} });
        return;
      }

      // Navigation Buttons
      if (e.target.closest('.btn-booking-next')) {
        this.next();
      } else if (e.target.closest('.btn-booking-back')) {
        this.back();
      }
    });

    this.container.addEventListener('input', (e) => {
      if (e.target.classList.contains('input-postcode')) {
        this.state.postcode = e.target.value;
        this.handlePostcodeVerify(e.target.value);
      } else if (e.target.classList.contains('input-address')) {
        this.state.address = e.target.value;
      } else if (e.target.classList.contains('input-height')) {
        this.state.height = e.target.value;
      } else if (e.target.classList.contains('input-name')) {
        this.state.name = e.target.value;
      } else if (e.target.classList.contains('input-phone')) {
        this.state.phone = e.target.value;
      } else if (e.target.classList.contains('input-email')) {
        this.state.email = e.target.value;
      }
    });

    this.container.addEventListener('blur', (e) => {
      if (e.target.classList.contains('input-postcode')) {
        const val = e.target.value;
        const clean = (val || '').replace(/[^A-Za-z0-9]/g, '');
        if (clean.length >= 5) {
          this.verifyPostcodeImmediate(val);
        }
      }
    }, true);
  }
}

/* --------------------------------------------------------------------------
   Modal Controller
   -------------------------------------------------------------------------- */
class BookingModalController {
  constructor() {
    this.overlay = document.querySelector('.booking-modal-overlay');
    if (!this.overlay) return;

    this.panel = this.overlay.querySelector('.booking-modal-panel');
    this.closeBtn = this.overlay.querySelector('.booking-modal-close');
    this.widgetContainer = this.overlay.querySelector('.booking-widget-card');

    this.widget = null;
    if (this.widgetContainer) {
      this.widget = new BookingWidget(this.widgetContainer);
    }
    this.init();
  }

  init() {
    // 1. Open triggers (click delegation)
    document.addEventListener('click', (e) => {
      const trigger = e.target.closest('[data-open-booking], a[href="#booking"], .dock-book, .btn-open-booking');
      if (trigger) {
        // If trigger is inside the booking widget form itself (e.g. step buttons), ignore
        if (trigger.closest('.booking-widget-card') && !trigger.hasAttribute('data-open-booking')) {
          return;
        }

        const inlineBooking = document.querySelector('section#booking .booking-widget-card');
        const wantsModal = trigger.hasAttribute('data-open-booking') || trigger.classList.contains('dock-book');

        if (wantsModal || !inlineBooking) {
          e.preventDefault();
          const prop = trigger.getAttribute('data-property') || '';
          const postcode = trigger.getAttribute('data-postcode') || '';
          this.open({ prefillProperty: prop, prefillPostcode: postcode });
        }
      }
    });

    // 2. Custom window event
    window.addEventListener('open-booking', (e) => {
      const detail = (e && e.detail) ? e.detail : {};
      this.open({
        prefillProperty: detail.property || '',
        prefillPostcode: detail.postcode || ''
      });
    });

    // 3. Close on overlay backdrop click
    this.overlay.addEventListener('click', (e) => {
      if (e.target === this.overlay) {
        this.close();
      }
    });

    // 4. Close button
    if (this.closeBtn) {
      this.closeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        this.close();
      });
    }

    // 5. Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && (this.overlay.classList.contains('open') || this.overlay.classList.contains('is-open'))) {
        this.close();
      }
    });
  }

  open(options = {}) {
    if (!this.overlay) return;

    // Immediately open modal & show UI
    this.overlay.classList.add('open');
    this.overlay.classList.add('is-open');
    document.body.style.overflow = 'hidden';

    // Refresh slots in background
    fetchBookedSlots();

    if (this.widgetContainer) {
      if (!this.widget) {
        this.widget = new BookingWidget(this.widgetContainer, options);
      } else {
        this.widget.options = options;
        if (options.prefillProperty || options.prefillPostcode) {
          this.widget.setState({
            step: 2,
            property: options.prefillProperty || this.widget.state.property || '',
            postcode: options.prefillPostcode || this.widget.state.postcode || '',
            postcodeStatus: options.prefillPostcode ? 'valid' : null,
            postcodeInfo: options.prefillPostcode ? { town: options.prefillLocation || '' } : null,
            errors: {}
          });
        }
      }
    }
  }

  close() {
    if (!this.overlay) return;
    this.overlay.classList.remove('open');
    this.overlay.classList.remove('is-open');
    document.body.style.overflow = '';
  }
}

/* --------------------------------------------------------------------------
   Front Hero Postcode Verifier (Location & Property Hero Forms)
   -------------------------------------------------------------------------- */
function initFrontHeroPostcodeVerifier() {
  const configs = [
    { inputId: 'cityHeroPostcode', btnId: 'cityHeroContinue', errId: 'cityHeroError', propSelector: '.property-opt-btn' },
    { inputId: 'heroPostcode', btnId: 'heroContinue', errId: 'heroError', propSelector: '.property-opt-btn, .property-select-btn' }
  ];

  configs.forEach(cfg => {
    const pcInput = document.getElementById(cfg.inputId);
    const continueBtn = document.getElementById(cfg.btnId);
    const errBox = document.getElementById(cfg.errId);
    if (!pcInput || !continueBtn) return;

    // Convert or ensure flex header with badge container in label
    const label = pcInput.closest('label');
    let badgeEl = label ? label.querySelector('.hero-postcode-badge') : null;
    if (label && !badgeEl) {
      const existingHeader = label.querySelector('span, div');
      const flexHeader = document.createElement('div');
      flexHeader.style.cssText = 'display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:8px;min-height:22px;';

      const titleSpan = document.createElement('span');
      titleSpan.style.cssText = 'font-size:13px;font-weight:600;letter-spacing:.02em;color:#1A1A1A;';
      titleSpan.textContent = 'Postcode *';

      badgeEl = document.createElement('span');
      badgeEl.className = 'hero-postcode-badge';
      badgeEl.style.cssText = 'font-size:11.5px;font-weight:500;color:#718096;display:inline-flex;align-items:center;';
      badgeEl.textContent = 'UK Coverage Check';

      flexHeader.appendChild(titleSpan);
      flexHeader.appendChild(badgeEl);

      if (existingHeader) {
        label.replaceChild(flexHeader, existingHeader);
      } else {
        label.insertBefore(flexHeader, pcInput);
      }
    }

    let isVerified = false;
    let verifiedCode = '';
    let verifiedTown = '';
    let isVerifying = false;
    let debounceTimer = null;

    function renderFrontBadge(state, text) {
      if (!badgeEl) return;
      if (state === 'checking') {
        badgeEl.innerHTML = `<span style="color:#4B5563;display:inline-flex;align-items:center;gap:4px">
          <span style="display:inline-block;width:9px;height:9px;border:2px solid #9CA3AF;border-top-color:#3B82F6;border-radius:50%;animation:al-spin 0.8s linear infinite"></span>
          <span>Checking...</span>
        </span>`;
        pcInput.style.borderColor = '#93C5FD';
      } else if (state === 'valid') {
        badgeEl.innerHTML = `<span style="color:#15803D;background:#F0FDF4;padding:1px 7px;border-radius:4px;border:1px solid #BBF7D0;display:inline-flex;align-items:center;gap:4px">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
          <span>Verified: ${text || 'UK Area'}</span>
        </span>`;
        pcInput.style.borderColor = '#6B8E5A';
        if (errBox) errBox.textContent = '';
      } else if (state === 'invalid') {
        badgeEl.innerHTML = `<span style="color:#B91C1C;background:#FEF2F2;padding:1px 6px;border-radius:4px;border:1px solid #FECACA">
          <span>⚠️ ${text || 'Unrecognised code'}</span>
        </span>`;
        pcInput.style.borderColor = '#DC2626';
      } else {
        badgeEl.innerHTML = `<span style="color:#718096;font-size:11px;font-weight:500">UK Coverage Check</span>`;
        pcInput.style.borderColor = '#DCDCD6';
      }
    }

    async function checkPostcode(raw) {
      const clean = (raw || '').replace(/[^A-Za-z0-9]/g, '');
      if (clean.length < 5) {
        isVerified = false;
        verifiedCode = '';
        verifiedTown = '';
        renderFrontBadge('idle');
        return false;
      }

      isVerifying = true;
      renderFrontBadge('checking');
      try {
        const res = await fetch(`api/verify-postcode.php?postcode=${encodeURIComponent(raw)}`);
        const data = await res.json();
        isVerifying = false;

        if (data && data.success) {
          isVerified = true;
          verifiedCode = data.postcode || raw.trim().toUpperCase();
          verifiedTown = data.town || data.county || 'UK Area';
          pcInput.value = verifiedCode;
          renderFrontBadge('valid', verifiedTown);
          if (errBox) errBox.textContent = '';
          return true;
        } else {
          isVerified = false;
          verifiedCode = '';
          verifiedTown = '';
          const msg = data?.error || 'Postcode not found in UK National database.';
          renderFrontBadge('invalid', 'Invalid UK code');
          if (errBox) errBox.textContent = '⚠️ ' + msg;
          return false;
        }
      } catch (err) {
        isVerifying = false;
        isVerified = true;
        verifiedCode = raw.trim().toUpperCase();
        verifiedTown = 'UK Area';
        renderFrontBadge('valid', 'UK Area');
        return true;
      }
    }

    pcInput.addEventListener('input', (e) => {
      isVerified = false;
      clearTimeout(debounceTimer);
      const val = e.target.value;
      const clean = val.replace(/[^A-Za-z0-9]/g, '');
      if (clean.length < 5) {
        renderFrontBadge('idle');
        if (errBox) errBox.textContent = '';
        return;
      }
      renderFrontBadge('checking');
      debounceTimer = setTimeout(() => {
        checkPostcode(val);
      }, 400);
    });

    pcInput.addEventListener('blur', () => {
      const val = pcInput.value;
      const clean = val.replace(/[^A-Za-z0-9]/g, '');
      if (clean.length >= 5 && !isVerified) {
        checkPostcode(val);
      }
    });

    function getSelectedProperty() {
      const allBtns = document.querySelectorAll(cfg.propSelector);
      for (const b of allBtns) {
        const bg = b.style.backgroundColor || b.style.background || '';
        const border = b.style.borderColor || '';
        if (b.classList.contains('active') || border.includes('107, 142, 90') || bg.includes('241, 245, 238') || b.getAttribute('aria-pressed') === 'true') {
          return b.getAttribute('data-property') || b.getAttribute('data-prop') || '';
        }
      }
      return '';
    }

    // Capture phase click listener on Continue button to enforce verification on front
    continueBtn.addEventListener('click', async (e) => {
      e.stopImmediatePropagation();
      e.preventDefault();

      const selectedProp = getSelectedProperty();
      if (!selectedProp) {
        if (errBox) errBox.textContent = 'Pick your property type to continue.';
        return;
      }

      const rawVal = pcInput.value.trim();
      const clean = rawVal.replace(/[^A-Za-z0-9]/g, '');
      if (clean.length < 5) {
        if (errBox) errBox.textContent = 'Enter a valid UK postcode so we can check coverage.';
        pcInput.focus();
        pcInput.style.borderColor = '#DC2626';
        return;
      }

      // If not yet verified, verify right now on front
      if (!isVerified || verifiedCode.replace(/\s+/g, '').toUpperCase() !== clean.toUpperCase()) {
        const origHtml = continueBtn.innerHTML;
        continueBtn.innerHTML = `
          <span style="display:inline-flex;align-items:center;justify-content:center;gap:8px">
            <span style="display:inline-block;width:12px;height:12px;border:2px solid #FFFFFF;border-top-color:transparent;border-radius:50%;animation:al-spin 0.8s linear infinite"></span>
            <span>Verifying Postcode...</span>
          </span>
        `;
        continueBtn.disabled = true;

        const ok = await checkPostcode(rawVal);
        continueBtn.innerHTML = origHtml;
        continueBtn.disabled = false;

        if (!ok) {
          pcInput.focus();
          pcInput.style.borderColor = '#DC2626';
          return;
        }
      }

      // Verified! Open modal smoothly
      if (errBox) errBox.textContent = '';
      window.dispatchEvent(new CustomEvent('open-booking', {
        detail: {
          property: selectedProp,
          postcode: verifiedCode || rawVal,
          location: verifiedTown || ''
        }
      }));
    }, true);
  });
}

// Auto-initialize inline widgets, modal, and front hero verifier on DOM ready
document.addEventListener('DOMContentLoaded', () => {
  // 1. Inline Widgets
  document.querySelectorAll('.booking-widget-card:not(.booking-modal-panel .booking-widget-card)').forEach((card) => {
    new BookingWidget(card);
  });

  // 2. Modal Controller
  window.ALBookingModal = new BookingModalController();

  // 3. Front Hero Postcode Verifier
  initFrontHeroPostcodeVerifier();
});

