<?php
$pageTitle = "Sites & Platforms Manager";
$activeNav = "sites-manager";
require_once __DIR__ . '/includes/header.php';

$successMsg = '';
$errorMsg = '';

// Handle Add / Edit Site POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCSRF($_POST['csrf_token'] ?? '')) {
        $errorMsg = 'Security validation failed. Please refresh and try again.';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'edit_site') {
            $siteId = (int)($_POST['site_id'] ?? 0);
            $name = trim($_POST['name'] ?? '');
            $shortName = trim($_POST['short_name'] ?? '');
            $domain = trim($_POST['domain'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $color = trim($_POST['color'] ?? '#2D4428');

            // Generate soft badge background from color
            $badgeBg = '#F1F5F9';
            if (preg_match('/^#[a-f0-9]{6}$/i', $color)) {
                $badgeBg = $color . '18'; // 10% opacity
            }

            if (empty($name) || empty($shortName)) {
                $errorMsg = 'Site name and short name are required.';
            } else {
                $stmt = $db->prepare("
                    UPDATE sites 
                    SET name = ?, short_name = ?, domain = ?, phone = ?, email = ?, color = ?, badge_bg = ?
                    WHERE id = ?
                ");
                $stmt->execute([$name, $shortName, $domain, $phone, $email, $color, $badgeBg, $siteId]);
                $successMsg = "Site #{$siteId} ({$name}) updated successfully!";
                $allSitesList = getAllSites(true); // refresh
            }
        } elseif ($action === 'add_site') {
            $name = trim($_POST['name'] ?? '');
            $shortName = trim($_POST['short_name'] ?? '');
            $siteKey = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '-', trim($_POST['site_key'] ?? '')));
            $domain = trim($_POST['domain'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $color = trim($_POST['color'] ?? '#0D9488');

            $badgeBg = '#F0FDFA';
            if (preg_match('/^#[a-f0-9]{6}$/i', $color)) {
                $badgeBg = $color . '18';
            }

            if (empty($name) || empty($shortName) || empty($siteKey)) {
                $errorMsg = 'Site name, short name, and key identifier are required.';
            } else {
                // Check key uniqueness
                $check = $db->prepare("SELECT COUNT(*) FROM sites WHERE site_key = ?");
                $check->execute([$siteKey]);
                if ((int)$check->fetchColumn() > 0) {
                    $errorMsg = "A site with key '{$siteKey}' already exists. Please choose a distinct key.";
                } else {
                    $stmt = $db->prepare("
                        INSERT INTO sites (site_key, name, short_name, color, badge_bg, domain, phone, email, is_active)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)
                    ");
                    $stmt->execute([$siteKey, $name, $shortName, $color, $badgeBg, $domain, $phone, $email]);
                    $successMsg = "New site '{$name}' created successfully!";
                    $allSitesList = getAllSites(true);
                }
            }
        }
    }
}

// Fetch stats per site
$sitesWithStats = [];
$sites = getAllSites(true);
foreach ($sites as $s) {
    $sId = (int)$s['id'];
    $leadCount = (int)$db->query("SELECT COUNT(*) FROM bookings WHERE (site_id = {$sId} OR ({$sId} = 1 AND site_id IS NULL)) AND LOWER(status) != 'spam'")->fetchColumn();
    $newCount = (int)$db->query("SELECT COUNT(*) FROM bookings WHERE (site_id = {$sId} OR ({$sId} = 1 AND site_id IS NULL)) AND LOWER(status) = 'new'")->fetchColumn();
    $contactCount = (int)$db->query("SELECT COUNT(*) FROM contacts WHERE (site_id = {$sId} OR ({$sId} = 1 AND site_id IS NULL)) AND LOWER(status) != 'spam'")->fetchColumn();
    $chatCount = (int)$db->query("SELECT COUNT(*) FROM chat_conversations WHERE (site_id = {$sId} OR ({$sId} = 1 AND site_id IS NULL))")->fetchColumn();

    $s['lead_count'] = $leadCount;
    $s['new_lead_count'] = $newCount;
    $s['contact_count'] = $contactCount;
    $s['chat_count'] = $chatCount;
    $sitesWithStats[] = $s;
}
?>

<div class="panel-header-actions" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px">
  <div>
    <h1 style="font-size:24px;font-weight:800;color:var(--p-text);margin-bottom:4px;display:flex;align-items:center;gap:10px">
      <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--p-primary)"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
      Multi-Site &amp; Platforms Manager
    </h1>
    <p style="font-size:14px;color:var(--p-text-muted)">
      Manage and configure multiple loft conversion platforms connected to this central lead engine.
    </p>
  </div>
  <div>
    <a href="index.php?switch_site=all" class="btn btn-secondary btn-sm" style="display:inline-flex;align-items:center;gap:6px">
      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
      <span>Open Combined Overview</span>
    </a>
  </div>
</div>

<?php if (!empty($successMsg)): ?>
  <div class="flash-alert flash-success" style="margin-bottom:20px;padding:12px 18px;background:#E8F5E9;border:1px solid #C8E6C9;color:#2E7D32;border-radius:10px;font-size:13.5px;font-weight:600">
    ✓ <?php echo htmlspecialchars($successMsg); ?>
  </div>
<?php endif; ?>

<?php if (!empty($errorMsg)): ?>
  <div class="flash-alert flash-error" style="margin-bottom:20px;padding:12px 18px;background:#FFEBEE;border:1px solid #FFCDD2;color:#C62828;border-radius:10px;font-size:13.5px;font-weight:600">
    ✕ <?php echo htmlspecialchars($errorMsg); ?>
  </div>
<?php endif; ?>

<!-- Sites Cards Grid -->
<div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:20px;margin-bottom:32px">
  <?php foreach ($sitesWithStats as $st): ?>
    <div class="panel-card" style="border-top:4px solid <?php echo htmlspecialchars($st['color']); ?>;position:relative;display:flex;flex-direction:column;justify-content:space-between">
      <div>
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:12px">
          <div>
            <span style="font-size:11px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:<?php echo htmlspecialchars($st['color']); ?>">
              Site #<?php echo $st['id']; ?> &bull; Key: <code><?php echo htmlspecialchars($st['site_key']); ?></code>
            </span>
            <h3 style="font-size:18px;font-weight:800;color:var(--p-text);margin:4px 0 2px"><?php echo htmlspecialchars($st['name']); ?></h3>
            <?php 
              $liveUrl = getSitePageUrl($st['id'], '/');
            ?>
            <div style="font-size:12px;color:var(--p-text-muted);display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin:4px 0 2px">
              <span style="font-weight:700;color:var(--p-text)">Active Link:</span>
              <a href="<?php echo htmlspecialchars($liveUrl); ?>" target="_blank" rel="noopener" style="color:var(--p-primary);font-weight:700;text-decoration:underline;display:inline-flex;align-items:center;gap:3px">
                <span><?php echo htmlspecialchars($liveUrl); ?></span>
                <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
              </a>
            </div>
            <?php if (!empty($st['domain'])): ?>
              <div style="font-size:11.5px;color:#94A3B8">
                Production: <code><?php echo htmlspecialchars($st['domain']); ?></code>
              </div>
            <?php endif; ?>
          </div>
          <span style="width:14px;height:14px;border-radius:50%;background:<?php echo htmlspecialchars($st['color']); ?>;display:inline-block;box-shadow:0 0 0 3px <?php echo htmlspecialchars($st['badge_bg']); ?>;flex-shrink:0"></span>
        </div>

        <!-- Micro stats row -->
        <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:8px;background:#F8FAFC;padding:12px 10px;border-radius:10px;margin:16px 0;text-align:center">
          <div>
            <div style="font-size:18px;font-weight:800;color:var(--p-text)"><?php echo $st['lead_count']; ?></div>
            <div style="font-size:10.5px;color:#64748B;text-transform:uppercase;font-weight:600">Surveys</div>
          </div>
          <div>
            <div style="font-size:18px;font-weight:800;color:#16A34A"><?php echo $st['new_lead_count']; ?></div>
            <div style="font-size:10.5px;color:#64748B;text-transform:uppercase;font-weight:600">New</div>
          </div>
          <div>
            <div style="font-size:18px;font-weight:800;color:var(--p-text)"><?php echo $st['contact_count']; ?></div>
            <div style="font-size:10.5px;color:#64748B;text-transform:uppercase;font-weight:600">Queries</div>
          </div>
        </div>

        <div style="font-size:12.5px;color:#64748B;line-height:1.6">
          <?php if (!empty($st['phone'])): ?>
            <div>📞 Phone: <strong style="color:#1E293B"><?php echo htmlspecialchars($st['phone']); ?></strong></div>
          <?php endif; ?>
          <?php if (!empty($st['email'])): ?>
            <div>✉️ Email: <strong style="color:#1E293B"><?php echo htmlspecialchars($st['email']); ?></strong></div>
          <?php endif; ?>
        </div>
      </div>

      <div style="margin-top:20px;padding-top:14px;border-top:1px solid #F1F5F9;display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap">
        <a href="index.php?switch_site=<?php echo $st['id']; ?>" class="btn btn-sm" style="background:<?php echo htmlspecialchars($st['color']); ?>;color:#FFFFFF;border:none;flex:1;text-align:center;justify-content:center">
          <span>Switch Dashboard &rarr;</span>
        </a>
        <a href="<?php echo htmlspecialchars($liveUrl); ?>" target="_blank" rel="noopener" class="btn btn-secondary btn-sm" title="Open Live Site in New Tab">
          <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
          <span>Visit Site</span>
        </a>
        <button type="button" class="btn btn-secondary btn-sm" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($st)); ?>)" title="Edit Site Details">
          <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
          <span>Edit</span>
        </button>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- Add New Site Card -->
  <div class="panel-card" style="border:2px dashed #CBD5E1;background:#FAFAFA;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:32px 20px;cursor:pointer" onclick="openAddModal()">
    <div style="width:48px;height:48px;border-radius:50%;background:#F1F5F9;display:flex;align-items:center;justify-content:center;color:#64748B;margin-bottom:12px">
      <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
    </div>
    <h3 style="font-size:16px;font-weight:700;color:#334155;margin-bottom:4px">Add Another Platform / Site</h3>
    <p style="font-size:12.5px;color:#94A3B8;max-width:240px;line-height:1.4">Connect a 4th or 5th loft conversion platform into this central hub.</p>
    <button type="button" class="btn btn-secondary btn-sm" style="margin-top:14px">
      <span>+ Add New Site</span>
    </button>
  </div>
</div>

<!-- Edit Site Modal -->
<div id="editSiteModal" class="panel-modal-overlay" style="display:none">
  <div class="panel-modal-card" style="max-width:500px">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
      <h3 style="font-size:18px;font-weight:800;color:var(--p-text)" id="editModalHeading">Edit Platform Details</h3>
      <button type="button" class="btn-close-modal" onclick="closeEditModal()">&times;</button>
    </div>

    <form method="POST" action="sites-manager.php">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
      <input type="hidden" name="action" value="edit_site">
      <input type="hidden" name="site_id" id="editSiteId" value="">

      <div style="margin-bottom:14px">
        <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Full Platform Name *</label>
        <input type="text" name="name" id="editSiteName" class="form-control" required style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
        <span style="font-size:11px;color:#94A3B8">e.g. Another Level Loft Conversions, Loft Conversions North, Apex Lofts</span>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px">
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Short Name (Badge Label) *</label>
          <input type="text" name="short_name" id="editSiteShortName" class="form-control" required style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
        </div>
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Brand Theme Color</label>
          <input type="color" name="color" id="editSiteColor" style="width:100%;height:40px;border:1px solid #CBD5E1;border-radius:8px;padding:2px;cursor:pointer">
        </div>
      </div>

      <div style="margin-bottom:14px">
        <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Live Website Domain</label>
        <input type="text" name="domain" id="editSiteDomain" class="form-control" placeholder="e.g. loftconversionsnorth.co.uk" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px">
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Primary Phone</label>
          <input type="text" name="phone" id="editSitePhone" class="form-control" placeholder="0161 4100155" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
        </div>
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Notification Email</label>
          <input type="email" name="email" id="editSiteEmail" class="form-control" placeholder="info@example.co.uk" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px">
        <button type="button" class="btn btn-secondary btn-sm" onclick="closeEditModal()">Cancel</button>
        <button type="submit" class="btn btn-primary btn-sm">Save Platform Details</button>
      </div>
    </form>
  </div>
</div>

<!-- Add Site Modal -->
<div id="addSiteModal" class="panel-modal-overlay" style="display:none">
  <div class="panel-modal-card" style="max-width:500px">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
      <h3 style="font-size:18px;font-weight:800;color:var(--p-text)">Add New Platform / Site</h3>
      <button type="button" class="btn-close-modal" onclick="closeAddModal()">&times;</button>
    </div>

    <form method="POST" action="sites-manager.php">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
      <input type="hidden" name="action" value="add_site">

      <div style="margin-bottom:14px">
        <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Full Platform Name *</label>
        <input type="text" name="name" class="form-control" required placeholder="e.g. Apex Loft Conversions" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px">
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Short Name (Badge) *</label>
          <input type="text" name="short_name" class="form-control" required placeholder="e.g. Apex Lofts" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
        </div>
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Key Identifier *</label>
          <input type="text" name="site_key" class="form-control" required placeholder="e.g. apex-lofts" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
        </div>
      </div>

      <div style="display:grid;grid-template-columns:2fr 1fr;gap:12px;margin-bottom:14px">
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Domain Name</label>
          <input type="text" name="domain" class="form-control" placeholder="apexloftconversions.co.uk" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
        </div>
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Theme Color</label>
          <input type="color" name="color" value="#0D9488" style="width:100%;height:40px;border:1px solid #CBD5E1;border-radius:8px;padding:2px;cursor:pointer">
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px">
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Phone</label>
          <input type="text" name="phone" class="form-control" placeholder="0800 ..." style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
        </div>
        <div>
          <label class="form-label" style="font-weight:700;font-size:12.5px;margin-bottom:4px;display:block">Notification Email</label>
          <input type="email" name="email" class="form-control" placeholder="info@..." style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px">
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px">
        <button type="button" class="btn btn-secondary btn-sm" onclick="closeAddModal()">Cancel</button>
        <button type="submit" class="btn btn-primary btn-sm">Create Platform</button>
      </div>
    </form>
  </div>
</div>

<script>
function openEditModal(st) {
  document.getElementById('editSiteId').value = st.id;
  document.getElementById('editSiteName').value = st.name;
  document.getElementById('editSiteShortName').value = st.short_name;
  document.getElementById('editSiteDomain').value = st.domain || '';
  document.getElementById('editSitePhone').value = st.phone || '';
  document.getElementById('editSiteEmail').value = st.email || '';
  document.getElementById('editSiteColor').value = st.color || '#2D4428';
  document.getElementById('editModalHeading').textContent = 'Edit Platform: ' + st.name;
  document.getElementById('editSiteModal').style.display = 'flex';
}
function closeEditModal() {
  document.getElementById('editSiteModal').style.display = 'none';
}
function openAddModal() {
  document.getElementById('addSiteModal').style.display = 'flex';
}
function closeAddModal() {
  document.getElementById('addSiteModal').style.display = 'none';
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
