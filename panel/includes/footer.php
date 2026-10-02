    </main>
    
    <footer class="panel-footer">
      <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;font-size:13px;color:#718096">
        <div>&copy; <?php echo date('Y'); ?> <strong>Another Level Loft Conversions Ltd</strong> &bull; Leads Engine v2.0</div>
        <div style="display:flex;align-items:center;gap:16px">
          <span>Preston &bull; Manchester &bull; Lancashire &bull; Cheshire</span>
          <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#A0AEC0">PHP <?php echo phpversion(); ?> / SQLite</span>
        </div>
      </div>
    </footer>
  </div>
</div>

<!-- Native Mobile App Bottom Dock (Pinned to Screen Bottom) -->
<nav class="mobile-app-dock" id="mobileAppDock" aria-label="Mobile Application Navigation">
  <a href="index.php" class="dock-tab <?php echo ($activeNav ?? '') === 'dashboard' ? 'active' : ''; ?>">
    <div class="dock-icon-box">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
    </div>
    <span class="dock-title">Home</span>
  </a>

  <a href="bookings.php" class="dock-tab <?php echo ($activeNav ?? '') === 'bookings' ? 'active' : ''; ?>">
    <div class="dock-icon-box" style="position:relative">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect><path d="M9 14l2 2 4-4"></path></svg>
      <?php if (!empty($newBookingsCount) && $newBookingsCount > 0): ?>
        <span class="dock-badge-pulse"><?php echo $newBookingsCount; ?></span>
      <?php endif; ?>
    </div>
    <span class="dock-title">Surveys</span>
  </a>

  <a href="contacts.php" class="dock-tab <?php echo ($activeNav ?? '') === 'contacts' ? 'active' : ''; ?>">
    <div class="dock-icon-box" style="position:relative">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
      <?php if (!empty($newContactsCount) && $newContactsCount > 0): ?>
        <span class="dock-badge-pulse" style="background:#4A5568"><?php echo $newContactsCount; ?></span>
      <?php endif; ?>
    </div>
    <span class="dock-title">Queries</span>
  </a>

  <a href="calendar.php" class="dock-tab <?php echo ($activeNav ?? '') === 'calendar' ? 'active' : ''; ?>">
    <div class="dock-icon-box">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
    </div>
    <span class="dock-title">Calendar</span>
  </a>

  <button type="button" class="dock-tab" id="dockMenuToggle" aria-label="Open Full Menu">
    <div class="dock-icon-box">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </div>
    <span class="dock-title">More</span>
  </button>
</nav>

<!-- Universal Confirmation Modal Dialog -->
<div id="panelConfirmModal" class="panel-confirm-overlay" aria-hidden="true" role="dialog" aria-modal="true" style="display: none;">
  <div class="panel-confirm-backdrop" id="panelConfirmBackdrop"></div>
  <div class="panel-confirm-dialog" id="panelConfirmDialog">
    <button type="button" class="panel-confirm-close" id="panelConfirmClose" aria-label="Close dialog">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
    
    <div class="panel-confirm-content">
      <div class="panel-confirm-icon-wrap danger" id="panelConfirmIcon">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
      </div>
      
      <h3 class="panel-confirm-title" id="panelConfirmTitle">Delete Permanently?</h3>
      <p class="panel-confirm-message" id="panelConfirmMessage">Are you sure you want to proceed? This cannot be undone.</p>

      <div class="panel-confirm-alert-tag" id="panelConfirmTag" style="display:none">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
        <span>Action cannot be undone</span>
      </div>
    </div>

    <div class="panel-confirm-footer">
      <button type="button" class="panel-confirm-btn-cancel" id="panelConfirmCancel">Cancel</button>
      <button type="button" class="panel-confirm-btn-action danger" id="panelConfirmAction">Yes, Delete</button>
    </div>
  </div>
</div>

<!-- Mobile Menu & Global JS Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('panelSidebar');
  const backdrop = document.getElementById('sidebarBackdrop');
  const toggleBtn = document.getElementById('mobileMenuToggle');
  const dockMenuBtn = document.getElementById('dockMenuToggle');
  const closeBtn = document.getElementById('sidebarCloseBtn');

  function openSidebar() {
    if (sidebar) sidebar.classList.add('open');
    if (backdrop) backdrop.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeSidebar() {
    if (sidebar) sidebar.classList.remove('open');
    if (backdrop) backdrop.classList.remove('open');
    document.body.style.overflow = '';
  }

  if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
  if (dockMenuBtn) dockMenuBtn.addEventListener('click', openSidebar);
  if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
  if (backdrop) backdrop.addEventListener('click', closeSidebar);

  // Desktop Sidebar Mode Toggle (Normal 260px vs Compact 68px Icon Rail)
  const sidebarModeToggle = document.getElementById('sidebarModeToggle');
  const sidebarFooterToggle = document.getElementById('sidebarFooterToggle');

  function updateSidebarToggleUI(isCompact) {
    if (sidebarModeToggle) {
      const iconToCompact = sidebarModeToggle.querySelector('.icon-to-compact');
      const iconToNormal = sidebarModeToggle.querySelector('.icon-to-normal');
      if (iconToCompact && iconToNormal) {
        iconToCompact.style.display = isCompact ? 'none' : 'block';
        iconToNormal.style.display = isCompact ? 'block' : 'none';
      }
      sidebarModeToggle.setAttribute('title', isCompact ? 'Expand to Full Sidebar' : 'Collapse to Compact Icons');
    }
    if (sidebarFooterToggle) {
      const iconToCompact = sidebarFooterToggle.querySelector('.icon-to-compact');
      const iconToNormal = sidebarFooterToggle.querySelector('.icon-to-normal');
      if (iconToCompact && iconToNormal) {
        iconToCompact.style.display = isCompact ? 'none' : 'block';
        iconToNormal.style.display = isCompact ? 'block' : 'none';
      }
      const span = sidebarFooterToggle.querySelector('span');
      if (span) {
        span.textContent = isCompact ? 'Expand Sidebar' : 'Compact Sidebar';
      }
      sidebarFooterToggle.setAttribute('title', isCompact ? 'Expand to Full Sidebar' : 'Collapse to Compact Icons');
    }
  }

  const isCompactInit = document.documentElement.classList.contains('sidebar-compact') || document.body.classList.contains('sidebar-compact');
  updateSidebarToggleUI(isCompactInit);

  function toggleSidebarMode() {
    const isCompact = document.documentElement.classList.toggle('sidebar-compact');
    document.body.classList.toggle('sidebar-compact', isCompact);
    try {
      localStorage.setItem('al_panel_sidebar_mode', isCompact ? 'compact' : 'normal');
    } catch (e) {}
    updateSidebarToggleUI(isCompact);
  }

  if (sidebarModeToggle) sidebarModeToggle.addEventListener('click', toggleSidebarMode);
  if (sidebarFooterToggle) sidebarFooterToggle.addEventListener('click', toggleSidebarMode);

  // Multi-Site Switcher Dropdown Toggle (Topbar)
  const siteToggleBtn = document.getElementById('siteSwitcherToggle');
  const siteMenu = document.getElementById('siteSwitcherMenu');
  const siteWrap = document.getElementById('siteSwitcherWrap');

  if (siteToggleBtn && siteMenu) {
    siteToggleBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = siteMenu.classList.toggle('is-open');
      siteToggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    document.addEventListener('click', (e) => {
      if (siteWrap && !siteWrap.contains(e.target)) {
        siteMenu.classList.remove('is-open');
        siteToggleBtn.setAttribute('aria-expanded', 'false');
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && siteMenu.classList.contains('is-open')) {
        siteMenu.classList.remove('is-open');
        siteToggleBtn.setAttribute('aria-expanded', 'false');
      }
    });
  }



  // Auto hide flash message after 5 seconds
  const flash = document.querySelector('.flash-alert');
  if (flash) {
    setTimeout(() => {
      flash.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      flash.style.opacity = '0';
      flash.style.transform = 'translateY(-8px)';
      setTimeout(() => flash.remove(), 500);
    }, 5000);
  }

  // Auto-upgrade legacy forms that use inline onsubmit="return confirm(...)"
  document.querySelectorAll('form[onsubmit*="confirm("]').forEach(form => {
    const onsubmitAttr = form.getAttribute('onsubmit') || '';
    const match = onsubmitAttr.match(/confirm\(\s*['"](.*?)['"]\s*\)/s);
    if (match && match[1]) {
      const msg = match[1].replace(/\\'/g, "'").replace(/\\"/g, '"');
      form.removeAttribute('onsubmit');
      form.classList.add('js-confirm-form');
      form.dataset.confirmMessage = msg;
      
      const lower = msg.toLowerCase();
      if (lower.includes('delete') || lower.includes('permanently')) {
        form.dataset.confirmType = 'danger';
        form.dataset.confirmTitle = 'Delete Permanently?';
        form.dataset.confirmBtn = 'Yes, Delete';
      } else if (lower.includes('spam') || lower.includes('fake')) {
        form.dataset.confirmType = 'warning';
        form.dataset.confirmTitle = 'Mark as Spam / Fake?';
        form.dataset.confirmBtn = 'Yes, Mark as Spam';
      } else {
        form.dataset.confirmType = 'primary';
        form.dataset.confirmTitle = 'Confirm Action';
        form.dataset.confirmBtn = 'Confirm';
      }
    }
  });
});

// Universal Modern Confirmation Modal Function
window.panelConfirm = function(options) {
  const modal = document.getElementById('panelConfirmModal');
  if (!modal) {
    if (confirm(options.message || 'Are you sure you want to proceed?')) {
      if (typeof options.onConfirm === 'function') options.onConfirm();
    }
    return;
  }

  const titleEl = document.getElementById('panelConfirmTitle');
  const msgEl = document.getElementById('panelConfirmMessage');
  const actionBtn = document.getElementById('panelConfirmAction');
  const cancelBtn = document.getElementById('panelConfirmCancel');
  const iconEl = document.getElementById('panelConfirmIcon');
  const tagEl = document.getElementById('panelConfirmTag');

  const type = options.type || options.confirmBtnType || 'danger';
  const title = options.title || (type === 'danger' ? 'Delete Permanently?' : (type === 'warning' ? 'Confirm Action' : 'Are you sure?'));
  const message = options.message || 'Are you sure you want to proceed?';
  const btnText = options.confirmBtnText || (type === 'danger' ? 'Yes, Delete' : (type === 'warning' ? 'Confirm' : 'Proceed'));
  const isPermanent = options.isPermanent !== undefined ? options.isPermanent : (type === 'danger' || message.toLowerCase().includes('cannot be undone'));

  titleEl.textContent = title;
  msgEl.textContent = message;
  actionBtn.textContent = btnText;

  // Render Icon
  iconEl.className = 'panel-confirm-icon-wrap ' + type;
  if (type === 'danger') {
    iconEl.innerHTML = '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>';
  } else if (type === 'warning') {
    iconEl.innerHTML = '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>';
  } else {
    iconEl.innerHTML = '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
  }

  // Button Theme
  actionBtn.className = 'panel-confirm-btn-action ' + type;

  // Warning Tag
  if (tagEl) {
    tagEl.style.display = isPermanent ? 'inline-flex' : 'none';
  }

  // Display Modal
  modal.style.display = 'flex';
  modal.offsetHeight; // Force reflow
  modal.classList.add('is-visible');
  modal.setAttribute('aria-hidden', 'false');

  function cleanup() {
    modal.classList.remove('is-visible');
    modal.setAttribute('aria-hidden', 'true');
    setTimeout(() => {
      if (!modal.classList.contains('is-visible')) {
        modal.style.display = 'none';
      }
    }, 240);
    document.removeEventListener('keydown', handleKeydown);
  }

  function handleConfirm() {
    cleanup();
    if (typeof options.onConfirm === 'function') {
      options.onConfirm();
    }
  }

  function handleCancel() {
    cleanup();
    if (typeof options.onCancel === 'function') {
      options.onCancel();
    }
  }

  function handleKeydown(e) {
    if (e.key === 'Escape') {
      handleCancel();
    } else if (e.key === 'Enter') {
      e.preventDefault();
      handleConfirm();
    }
  }

  actionBtn.onclick = handleConfirm;
  cancelBtn.onclick = handleCancel;
  document.getElementById('panelConfirmClose').onclick = handleCancel;
  document.getElementById('panelConfirmBackdrop').onclick = handleCancel;
  document.addEventListener('keydown', handleKeydown);

  // Focus cancel button for safety
  setTimeout(() => cancelBtn.focus(), 60);
};

// Global Form Submit Interception for .js-confirm-form & [data-confirm]
document.addEventListener('submit', function(e) {
  const form = e.target;
  if (!form || form.dataset.confirmApproved === 'true') {
    return;
  }

  const confirmMsg = form.dataset.confirmMessage || form.dataset.confirm || form.getAttribute('data-confirm');
  const confirmTitle = form.dataset.confirmTitle || form.getAttribute('data-confirm-title');

  if (confirmMsg || confirmTitle || form.classList.contains('js-confirm-form')) {
    e.preventDefault();
    e.stopPropagation();

    window.panelConfirm({
      title: confirmTitle || (form.dataset.confirmType === 'warning' ? 'Confirm Action' : 'Permanently Delete?'),
      message: confirmMsg || 'Are you sure you want to proceed?',
      confirmBtnText: form.dataset.confirmBtn || (form.dataset.confirmType === 'warning' ? 'Confirm' : 'Yes, Delete'),
      type: form.dataset.confirmType || 'danger',
      onConfirm: function() {
        form.dataset.confirmApproved = 'true';
        HTMLFormElement.prototype.submit.call(form);
      }
    });
    return false;
  }
}, true);
</script>
</body>
</html>
