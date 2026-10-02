/**
 * Another Level Loft Conversions - Global Main JS
 */

document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initMegaMenuHover();
  initBayfordDropdownHover();
  initFaqAccordion();
  initBeforeAfterSlider();
  initStatsCounters();
  initGsapReveals();
  initBookingTriggers();
  initConversionCarousel();
});

/* --------------------------------------------------------------------------
   Bayford Dropdown Smooth Hover Debounce (Prevents vanishing when moving down)
   -------------------------------------------------------------------------- */
function initBayfordDropdownHover() {
  const wrappers = document.querySelectorAll('.nav-dropdown-wrapper.has-bayford');
  if (!wrappers.length) return;

  const closeAll = () => {
    wrappers.forEach(w => {
      w.classList.remove('is-open');
    });
  };

  wrappers.forEach(wrapper => {
    let timer = null;
    const dropdown = wrapper.querySelector('.bayford-dropdown');

    const activate = () => {
      if (timer) {
        clearTimeout(timer);
        timer = null;
      }
      wrappers.forEach(other => {
        if (other !== wrapper) other.classList.remove('is-open');
      });
      wrapper.classList.add('is-open');
    };

    const deactivate = () => {
      timer = setTimeout(() => {
        wrapper.classList.remove('is-open');
      }, 150);
    };

    wrapper.addEventListener('mouseenter', activate);
    wrapper.addEventListener('mouseleave', deactivate);

    if (dropdown) {
      dropdown.addEventListener('mouseenter', activate);
      dropdown.addEventListener('mouseleave', deactivate);
    }
  });

  // Immediately close dropdown when hovering non-dropdown nav items (HOME, GALLERY, CONTACT)
  document.querySelectorAll('.nav-desktop > a.nav-link').forEach(link => {
    link.addEventListener('mouseenter', closeAll);
  });

  // Immediately close when mouse leaves site header
  const header = document.querySelector('.site-header');
  if (header) {
    header.addEventListener('mouseleave', closeAll);
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeAll();
    }
  });
}

/* --------------------------------------------------------------------------
   Mega Menu Hover Interactive Preview
   -------------------------------------------------------------------------- */
function initMegaMenuHover() {
  const megaMenus = document.querySelectorAll('.nav-dropdown-mega');
  if (!megaMenus.length) return;

  megaMenus.forEach(menu => {
    const sideLinks = menu.querySelectorAll('.mega-side-link');
    const panels = menu.querySelectorAll('.mega-preview-panel');
    if (!sideLinks.length || !panels.length) return;

    sideLinks.forEach(link => {
      link.addEventListener('mouseenter', () => {
        const targetId = link.getAttribute('data-target');
        if (!targetId) return;

        sideLinks.forEach(l => l.classList.remove('active'));
        panels.forEach(p => p.classList.remove('active'));

        link.classList.add('active');
        const targetPanel = menu.querySelector(`#${targetId}`) || document.getElementById(targetId);
        if (targetPanel) {
          targetPanel.classList.add('active');
        }
      });
    });
  });
}

/* --------------------------------------------------------------------------
   Mobile Navigation Drawer
   -------------------------------------------------------------------------- */
function initMobileMenu() {
  const burgerBtn = document.querySelector('.burger-btn');
  const mobileDrawer = document.querySelector('.nav-mobile-drawer');

  if (!burgerBtn || !mobileDrawer) return;

  burgerBtn.addEventListener('click', () => {
    const isOpen = mobileDrawer.classList.contains('open');
    if (isOpen) {
      mobileDrawer.classList.remove('open');
      burgerBtn.setAttribute('aria-expanded', 'false');
    } else {
      mobileDrawer.classList.add('open');
      burgerBtn.setAttribute('aria-expanded', 'true');
    }
  });

  // Mobile Accordion functionality (Bayford Lofts Style clean expandable menus)
  const accordionBtns = mobileDrawer.querySelectorAll('.mobile-accordion-btn');
  accordionBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      const group = btn.closest('.mobile-accordion-group');
      if (!group) return;

      const isExpanded = group.classList.contains('open');

      // Close sibling accordions
      accordionBtns.forEach(otherBtn => {
        if (otherBtn !== btn) {
          otherBtn.setAttribute('aria-expanded', 'false');
          const otherGroup = otherBtn.closest('.mobile-accordion-group');
          if (otherGroup) otherGroup.classList.remove('open');
        }
      });

      if (isExpanded) {
        group.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
      } else {
        group.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });

  const links = mobileDrawer.querySelectorAll('a');
  links.forEach(link => {
    link.addEventListener('click', () => {
      mobileDrawer.classList.remove('open');
      burgerBtn.setAttribute('aria-expanded', 'false');
    });
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth >= 1040 && mobileDrawer.classList.contains('open')) {
      mobileDrawer.classList.remove('open');
      burgerBtn.setAttribute('aria-expanded', 'false');
    }
  });
}


/* --------------------------------------------------------------------------
   Booking Modal & Trigger Handlers
   -------------------------------------------------------------------------- */
function initBookingTriggers() {
  document.querySelectorAll('[data-open-booking], a[href="#booking"]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      // Check if button is inside a booking widget form itself (e.g. next/submit)
      if (btn.closest('.booking-widget-card') && !btn.hasAttribute('data-open-booking')) {
        return;
      }
      // If it's a link to #booking on a page that doesn't have an inline #booking form or if requested
      const inlineBooking = document.querySelector('section#booking .booking-widget-card');
      const isHeroBtn = btn.hasAttribute('data-open-booking');

      if (isHeroBtn || !inlineBooking) {
        e.preventDefault();
        const prop = btn.getAttribute('data-property') || '';
        const postcode = btn.getAttribute('data-postcode') || '';
        window.dispatchEvent(new CustomEvent('open-booking', {
          detail: { property: prop, postcode: postcode }
        }));
      }
    });
  });
}

/* --------------------------------------------------------------------------
   FAQ Accordions
   -------------------------------------------------------------------------- */
function initFaqAccordion() {
  const faqItems = document.querySelectorAll('.faq-wrap');
  if (!faqItems.length) return;

  faqItems.forEach((item, index) => {
    const btn = item.querySelector('.faq-btn');
    const ans = item.querySelector('.faq-answer');
    const sign = item.querySelector('.faq-sign');

    if (!btn || !ans) return;

    btn.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');

      // Close all other FAQs in the same container
      const parent = item.parentElement;
      if (parent) {
        parent.querySelectorAll('.faq-wrap').forEach(other => {
          if (other !== item) {
            other.classList.remove('open');
            const otherBtn = other.querySelector('.faq-btn');
            const otherSign = other.querySelector('.faq-sign');
            if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
            if (otherSign) otherSign.textContent = '+';
          }
        });
      }

      if (isOpen) {
        item.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
        if (sign) sign.textContent = '+';
      } else {
        item.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
        if (sign) sign.textContent = '–';
      }
    });
  });
}

/* --------------------------------------------------------------------------
   Before / After Interactive Slider
   -------------------------------------------------------------------------- */
const PROJECTS_DATA = [
  {
    tag: 'Rear dormer · Bolton',
    title: 'Two bedrooms and a bathroom over a 1930s semi.',
    name: 'Bolton semi',
    before: 'images/another-area-loft-conversions-north-west-england-06.jpeg',
    after: 'images/another-area-loft-conversions-north-west-england-01.jpeg',
    facts: [
      { k: 'Property', v: 'Semi-detached' },
      { k: 'On site', v: '4 weeks' },
      { k: 'Floor added', v: '31 m²' },
      { k: 'Guarantee', v: '6 Years' }
    ]
  },
  {
    tag: 'Velux · Chorlton',
    title: 'A home office under the original roof line.',
    name: 'Chorlton terrace',
    before: 'images/another-area-loft-conversions-north-west-england-11.jpeg',
    after: 'images/another-area-loft-conversions-north-west-england-03.jpeg',
    facts: [
      { k: 'Property', v: 'Terrace' },
      { k: 'On site', v: '3 weeks' },
      { k: 'Floor added', v: '18 m²' },
      { k: 'Guarantee', v: '6 Years' }
    ]
  },
  {
    tag: 'Hip-to-gable · Stockport',
    title: 'Squared-off roof, en-suite guest room.',
    name: 'Stockport detached',
    before: 'images/another-area-loft-conversions-north-west-england-12.jpeg',
    after: 'images/another-area-loft-conversions-north-west-england-02.jpeg',
    facts: [
      { k: 'Property', v: 'Detached' },
      { k: 'On site', v: '3.5 weeks' },
      { k: 'Floor added', v: '27 m²' },
      { k: 'Guarantee', v: '6 Years' }
    ]
  },
  {
    tag: 'Wrap around · Sale',
    title: 'Full-width master suite across the roof.',
    name: 'Sale semi',
    before: 'images/another-area-loft-conversions-north-west-england-13.jpeg',
    after: 'images/another-area-loft-conversions-north-west-england-15.jpeg',
    facts: [
      { k: 'Property', v: 'Semi-detached' },
      { k: 'On site', v: '6 weeks' },
      { k: 'Floor added', v: '44 m²' },
      { k: 'Guarantee', v: '6 Years' }
    ]
  }
];

function initBeforeAfterSlider() {
  const slider = document.querySelector('.ba-slider-area');
  if (!slider) return;

  const afterLayer = slider.querySelector('.ba-after-layer');
  const handleLine = slider.querySelector('.ba-handle-line');
  const beforeImg = slider.querySelector('.ba-before-layer img');
  const afterImg = slider.querySelector('.ba-after-layer img');
  const metaContainer = document.querySelector('.ba-meta-container');
  const projectBtns = document.querySelectorAll('.ba-project-btn');

  let split = 50;
  let isDragging = false;

  function updateSplit(pct) {
    split = Math.max(0, Math.min(100, pct));
    if (afterLayer) {
      afterLayer.style.clipPath = `inset(0 0 0 ${split}%)`;
    }
    if (handleLine) {
      handleLine.style.left = `${split}%`;
    }
  }

  function getPercentage(clientX) {
    const rect = slider.getBoundingClientRect();
    if (!rect.width) return 50;
    const x = clientX - rect.left;
    return Math.max(0, Math.min(100, (x / rect.width) * 100));
  }

  function onPointerMove(e) {
    if (!isDragging) return;
    updateSplit(getPercentage(e.clientX));
  }

  function stopDrag() {
    if (isDragging) {
      isDragging = false;
      window.removeEventListener('pointermove', onPointerMove);
      window.removeEventListener('pointerup', stopDrag);
      window.removeEventListener('pointercancel', stopDrag);
    }
  }

  slider.addEventListener('pointerdown', (e) => {
    isDragging = true;
    updateSplit(getPercentage(e.clientX));
    window.addEventListener('pointermove', onPointerMove);
    window.addEventListener('pointerup', stopDrag);
    window.addEventListener('pointercancel', stopDrag);
  });

  // Touch / mouse move on slider directly as well
  slider.addEventListener('pointermove', (e) => {
    if (isDragging) {
      updateSplit(getPercentage(e.clientX));
    }
  });

  // Project Switcher
  projectBtns.forEach((btn, idx) => {
    btn.addEventListener('click', () => {
      projectBtns.forEach(b => {
        b.classList.remove('active');
        const num = b.querySelector('span:first-child');
        if (num) num.style.color = '#9C9C95';
      });
      btn.classList.add('active');
      const activeNum = btn.querySelector('span:first-child');
      if (activeNum) activeNum.style.color = '#4F6B42';

      const data = PROJECTS_DATA[idx];
      if (!data) return;

      if (beforeImg) beforeImg.src = data.before;
      if (afterImg) afterImg.src = data.after;

      if (metaContainer) {
        const tagEl = metaContainer.querySelector('.ba-tag');
        const titleEl = metaContainer.querySelector('.ba-title');
        const dlEl = metaContainer.querySelector('.ba-facts');

        if (tagEl) tagEl.textContent = data.tag;
        if (titleEl) titleEl.textContent = data.title;

        if (dlEl) {
          dlEl.innerHTML = data.facts.map(f => `
            <div class="ba-fact-item" style="display:flex;justify-content:space-between;gap:16px;padding:11px 0;border-top:1px solid #EDEDE8">
              <dt style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#6B6B6B">${f.k}</dt>
              <dd style="margin:0;font-size:14px;font-weight:600;text-align:right">${f.v}</dd>
            </div>
          `).join('');
        }
      }

      updateSplit(50);
    });
  });

  updateSplit(50);
}

/* --------------------------------------------------------------------------
   Stats Number Animation
   -------------------------------------------------------------------------- */
function initStatsCounters() {
  const statsSection = document.querySelector('[data-stats-bar]');
  if (!statsSection) return;

  const countItems = statsSection.querySelectorAll('[data-target-value]');
  if (!countItems.length) return;

  let animated = false;

  const observer = new IntersectionObserver((entries) => {
    if (entries.some(e => e.isIntersecting) && !animated) {
      animated = true;
      observer.disconnect();

      const startTime = performance.now();
      const duration = 1400;

      const tick = (now) => {
        const progress = Math.min(1, (now - startTime) / duration);
        const ease = 1 - Math.pow(1 - progress, 3);

        countItems.forEach(el => {
          const target = parseFloat(el.getAttribute('data-target-value'));
          const decimals = parseInt(el.getAttribute('data-decimals') || '0', 10);
          const suffix = el.getAttribute('data-suffix') || '';
          const current = (target * ease).toFixed(decimals);
          el.textContent = current + (suffix ? ' ' + suffix : '');
        });

        if (progress < 1) {
          requestAnimationFrame(tick);
        }
      };

      requestAnimationFrame(tick);
    }
  }, { threshold: 0.35 });

  observer.observe(statsSection);
}

/* --------------------------------------------------------------------------
   GSAP Reveals
   -------------------------------------------------------------------------- */
function initGsapReveals() {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    // Fallback if GSAP is not loaded: make elements visible
    document.querySelectorAll('[data-reveal]').forEach(el => {
      el.style.opacity = '1';
      el.style.transform = 'none';
    });
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  document.querySelectorAll('[data-reveal]:not([data-revealed])').forEach(sec => {
    sec.setAttribute('data-revealed', '1');
    const firstChild = sec.children[0];
    const targets = firstChild && firstChild.children.length ? Array.from(firstChild.children) : [sec];

    gsap.fromTo(targets, 
      { opacity: 0, y: 26 }, 
      {
        opacity: 1, 
        y: 0, 
        duration: 0.7, 
        ease: 'power2.out', 
        stagger: 0.08,
        clearProps: 'transform',
        scrollTrigger: { 
          trigger: sec, 
          start: 'top 84%', 
          once: true 
        }
      }
    );
  });
}

/* --------------------------------------------------------------------------
   Mobile Conversion Types & Process Carousel Indicators
   -------------------------------------------------------------------------- */
function initConversionCarousel() {
  setupCarouselSync('.conversion-types-grid', '.conversion-carousel-dots .dot', '.conversion-card', '.carousel-prev-btn', '.carousel-next-btn');
  setupCarouselSync('.proc-steps-grid', '.process-carousel-dots .dot', '.proc-step-card', '.proc-prev-btn', '.proc-next-btn', '.proc-current-num');
  setupCarouselSync('.property-overview-grid', null, '.property-overview-card', '.prop-prev-btn', '.prop-next-btn');
  setupCarouselSync('.guar-safeguards-grid', null, '.guar-safeguard-card', '.guar-prev-btn', '.guar-next-btn');
  setupCarouselSync('.guar-showcase-grid', null, '.guar-showcase-card', '.showcase-prev-btn', '.showcase-next-btn');
  setupCarouselSync('.cmp-cards-mobile', null, '.cmp-mobile-card', '.cmp-prev-btn', '.cmp-next-btn');
  setupCarouselSync('.detail-types-grid', null, '.detail-type-card', '.detail-prev-btn', '.detail-next-btn');
  setupCarouselSync('.qa-cards-grid', null, '.dark-qa-card', '.qa-prev-btn', '.qa-next-btn');
  setupCarouselSync('.house-types-grid', null, '.house-type-card', '.prop-prev-btn', '.prop-next-btn');
  setupCarouselSync('.velux-gallery-grid', null, '.velux-gallery-card', '.velux-gal-prev', '.velux-gal-next');
  setupCarouselSync('.type-gallery-grid', null, '.type-gallery-card', '.type-gal-prev', '.type-gal-next');
  setupCarouselSync('.byconv-types-grid', null, '.byconv-type-card', '.byconv-prev-btn', '.byconv-next-btn');
}

function setupCarouselSync(carouselSelector, dotsSelector, cardsSelector, prevBtnSelector, nextBtnSelector, counterSelector) {
  const carousel = document.querySelector(carouselSelector);
  const dots = dotsSelector ? document.querySelectorAll(dotsSelector) : [];
  const counterEl = counterSelector ? document.querySelector(counterSelector) : null;
  if (!carousel) return;

  const cards = carousel.querySelectorAll(cardsSelector);
  if (!cards.length) return;

  const updateActiveIndex = (activeIndex) => {
    if (dots.length) {
      dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === activeIndex);
      });
    }
    if (counterEl) {
      counterEl.textContent = String(activeIndex + 1).padStart(2, '0');
    }
  };

  let ticking = false;
  carousel.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        const scrollLeft = carousel.scrollLeft;
        const cardWidth = cards[0].offsetWidth + 14;
        const activeIndex = Math.min(Math.max(0, Math.round(scrollLeft / cardWidth)), cards.length - 1);
        updateActiveIndex(activeIndex);
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });

  if (dots.length) {
    dots.forEach((dot, i) => {
      dot.addEventListener('click', () => {
        if (cards[i]) {
          cards[i].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
        }
      });
    });
  }

  if (prevBtnSelector) {
    const prevBtn = document.querySelector(prevBtnSelector);
    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        const cardWidth = cards[0].offsetWidth + 16;
        carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
      });
    }
  }

  if (nextBtnSelector) {
    const nextBtn = document.querySelector(nextBtnSelector);
    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        const cardWidth = cards[0].offsetWidth + 16;
        carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
      });
    }
  }
}


