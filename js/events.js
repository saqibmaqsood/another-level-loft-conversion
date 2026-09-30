/**
 * Another Level Loft Conversions - Event & Analytics Click Tracker
 * Tracks call button clicks, chat inquiries, and interaction analytics
 * Automatically syncs with Google Analytics 4 (gtag) and Google Tag Manager (dataLayer)
 */
(function () {
  'use strict';

  // 0. Filter out automated bots / headless testing engines
  if (navigator.webdriver) {
    return;
  }

  // 1. Session & Duration Initialization
  let sessionId = '';
  try {
    sessionId = sessionStorage.getItem('al_session_id');
    if (!sessionId) {
      sessionId = 's_' + Math.random().toString(36).substring(2, 9) + '_' + Date.now().toString(36);
      sessionStorage.setItem('al_session_id', sessionId);
    }
  } catch (e) {
    sessionId = 's_' + Math.random().toString(36).substring(2, 9);
  }

  let sessionStartTime = Date.now();
  try {
    const storedStart = parseInt(sessionStorage.getItem('al_session_start'), 10);
    if (storedStart && !isNaN(storedStart)) {
      sessionStartTime = storedStart;
    } else {
      sessionStorage.setItem('al_session_start', sessionStartTime);
    }
  } catch (e) {}

  function getDurationSeconds() {
    return Math.max(0, Math.round((Date.now() - sessionStartTime) / 1000));
  }

  function trackEvent(eventType, eventLabel) {
    const payload = {
      event_type: eventType,
      event_label: eventLabel || '',
      page_url: window.location.pathname + window.location.search,
      referrer_url: document.referrer || '',
      session_id: sessionId,
      duration_seconds: getDurationSeconds()
    };

    // Google Analytics 4 & GTM Event Dispatch
    try {
      if (typeof window.gtag === 'function') {
        window.gtag('event', eventType, {
          event_category: 'interaction',
          event_label: eventLabel || '',
          page_path: window.location.pathname
        });
      }
      if (window.dataLayer && Array.isArray(window.dataLayer)) {
        window.dataLayer.push({
          event: 'custom_interaction',
          interaction_type: eventType,
          interaction_label: eventLabel || '',
          page_location: window.location.href
        });
      }
    } catch (e) {}

    // Internal Zero-Config Backend Tracker
    const endpoint = 'api/track-event.php';
    try {
      if (navigator.sendBeacon) {
        const blob = new Blob([JSON.stringify(payload)], { type: 'application/json' });
        navigator.sendBeacon(endpoint, blob);
      } else {
        fetch(endpoint, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload),
          keepalive: true
        }).catch(() => {});
      }
    } catch (err) {}
  }

  // Periodic heartbeat to track real time-on-site
  function pingHeartbeat() {
    const dur = getDurationSeconds();
    if (dur >= 5 && !window.location.pathname.includes('/panel')) {
      trackEvent('time_update', `${dur}s active on site`);
    }
  }

  // Ping at 15s, 30s, 60s, 120s, 300s
  [15, 30, 60, 120, 300].forEach(delay => {
    setTimeout(pingHeartbeat, delay * 1000);
  });

  window.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'hidden') {
      pingHeartbeat();
    }
  });

  window.addEventListener('pagehide', pingHeartbeat);

  document.addEventListener('DOMContentLoaded', () => {
    // 1. Automatic Page View Tracking (excluding panel)
    if (!window.location.pathname.includes('/panel')) {
      const pageTitle = (document.title ? document.title.split('—')[0].trim() : window.location.pathname) || 'Home Page';
      trackEvent('page_view', pageTitle);
    }

    // 2. Phone Call Click Tracking
    document.addEventListener('click', (e) => {
      const telLink = e.target.closest('a[href^="tel:"]');
      if (telLink) {
        const telNum = telLink.getAttribute('href').replace('tel:', '');
        const context = telLink.innerText.trim().slice(0, 30) || 'Direct Phone Call';
        trackEvent('call_click', `Phone: ${telNum} (${context})`);
      }

      // 3. Chat Trigger Tracking
      const chatBtn = e.target.closest('[data-chat-trigger], .chat-btn, .btn-chat, .live-chat-launcher');
      if (chatBtn) {
        const label = chatBtn.getAttribute('data-chat-label') || 'Live Chat Widget Opened';
        trackEvent('chat_click', label);
      }

      // 4. Email Click Tracking
      const mailLink = e.target.closest('a[href^="mailto:"]');
      if (mailLink) {
        const email = mailLink.getAttribute('href').replace('mailto:', '');
        trackEvent('email_click', `Email: ${email}`);
      }
    });

    // Expose global track helper for external scripts (e.g. AI chat bot, booking modal)
    window.ALTrack = {
      event: trackEvent,
      trackCall: (num) => trackEvent('call_click', num),
      trackChat: (label) => trackEvent('chat_click', label || 'Chat Initiated'),
      trackLead: (label) => trackEvent('survey_booked', label || 'Survey Booked')
    };
  });
})();
