<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();
$db = getDB();
require_once __DIR__ . '/includes/mailer.php';
require_once __DIR__ . '/includes/sites.php';

// Multi-Site Setup
$isAllSites = isAllSitesMode();
$activeSite = getActiveSite();
$siteFilter = buildSiteFilterSql('site_id', 'AND');

// Handle Status updates or replies
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action'])) {
    if (!validateCSRF($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash_msg'] = 'Security validation failed.';
        $_SESSION['flash_type'] = 'error';
    } else {
        $contactId = (int)($_POST['contact_id'] ?? 0);
        
        if ($_POST['action'] === 'update_status' && $contactId > 0) {
            $newStatus = trim($_POST['status'] ?? 'new');
            $stmt = $db->prepare("UPDATE contacts SET status = ? WHERE id = ?");
            $stmt->execute([$newStatus, $contactId]);
            $_SESSION['flash_msg'] = "Contact inquiry #{$contactId} marked as " . ucfirst($newStatus);
            $_SESSION['flash_type'] = 'success';
        } elseif ($_POST['action'] === 'send_reply' && $contactId > 0) {
            $toEmail = trim($_POST['to_email'] ?? '');
            $subject = trim($_POST['subject'] ?? 'RE: Your Inquiry');
            $replyMsg = trim($_POST['reply_message'] ?? '');

            if (!empty($toEmail) && !empty($replyMsg)) {
                $sendRes = sendRawEmail($toEmail, $subject, nl2br(htmlspecialchars((string)$replyMsg)));
                if ($sendRes) {
                    $stmt = $db->prepare("UPDATE contacts SET status = 'replied' WHERE id = ?");
                    $stmt->execute([$contactId]);
                    $_SESSION['flash_msg'] = "Reply sent successfully to {$toEmail}.";
                    $_SESSION['flash_type'] = 'success';
                } else {
                    $_SESSION['flash_msg'] = "Failed to dispatch email reply.";
                    $_SESSION['flash_type'] = 'error';
                }
            }
        } elseif ($_POST['action'] === 'delete_contact' && $contactId > 0) {
            $stmt = $db->prepare("DELETE FROM contacts WHERE id = ?");
            $stmt->execute([$contactId]);
            $_SESSION['flash_msg'] = "Contact inquiry #{$contactId} was permanently deleted.";
            $_SESSION['flash_type'] = 'success';
            header("Location: contacts.php");
            exit;
        } elseif ($_POST['action'] === 'mark_spam' && $contactId > 0) {
            $stmt = $db->prepare("UPDATE contacts SET status = 'spam' WHERE id = ?");
            $stmt->execute([$contactId]);
            $_SESSION['flash_msg'] = "Message #{$contactId} marked as Spam / Fake and hidden from active views.";
            $_SESSION['flash_type'] = 'info';
            header("Location: contacts.php");
            exit;
        } elseif ($_POST['action'] === 'restore_contact' && $contactId > 0) {
            $stmt = $db->prepare("UPDATE contacts SET status = 'New' WHERE id = ?");
            $stmt->execute([$contactId]);
            $_SESSION['flash_msg'] = "Message #{$contactId} restored to active list.";
            $_SESSION['flash_type'] = 'success';
            header("Location: contacts.php");
            exit;
        }
        header("Location: contacts.php");
        exit;
    }
}

// Filters & Search
$statusFilter = trim($_GET['status'] ?? 'all');
$spamStmt = $db->prepare("SELECT COUNT(*) FROM contacts WHERE LOWER(status) = 'spam' " . $siteFilter['clause']);
$spamStmt->execute($siteFilter['params']);
$spamContactCount = (int)$spamStmt->fetchColumn();

$cSql = "SELECT * FROM contacts WHERE 1=1 " . $siteFilter['clause'];
$cParams = $siteFilter['params'];

if ($statusFilter === 'all') {
    $cSql .= " AND LOWER(status) != 'spam'";
} elseif ($statusFilter === 'spam') {
    $cSql .= " AND LOWER(status) = 'spam'";
} else {
    $cSql .= " AND LOWER(status) = LOWER(?)";
    $cParams[] = $statusFilter;
}
$cSql .= " ORDER BY id DESC";

$stmt = $db->prepare($cSql);
$stmt->execute($cParams);
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = "Contact Form Inquiries";
$activeNav = "contacts";
require_once __DIR__ . '/includes/header.php';
?>

<div class="panel-card" style="margin-bottom:24px;padding:16px 20px">
  
  <!-- Platform Quick Filter Strip -->
  <div class="site-tabs-bar" style="display:flex;align-items:center;gap:8px;overflow-x:auto;padding-bottom:12px;margin-bottom:14px;border-bottom:1px solid #EDF2F7">
    <span style="font-size:12px;font-weight:700;color:#718096;text-transform:uppercase;margin-right:4px">Platform:</span>
    <a href="?switch_site=all&status=<?php echo urlencode($statusFilter); ?>" class="site-tab-pill <?php echo $isAllSites ? 'active' : ''; ?>" style="text-decoration:none;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:6px;border:1px solid <?php echo $isAllSites ? '#1A202C' : '#E2E8F0'; ?>;background:<?php echo $isAllSites ? '#1A202C' : '#FFFFFF'; ?>;color:<?php echo $isAllSites ? '#FFFFFF' : '#4A5568'; ?>">
      <span>🌐 All Sites Combined</span>
    </a>
    <?php foreach (getAllSites() as $st): $isActiveSt = (!$isAllSites && $activeSite && $activeSite['id'] == $st['id']); ?>
      <a href="?switch_site=<?php echo $st['id']; ?>&status=<?php echo urlencode($statusFilter); ?>" class="site-tab-pill <?php echo $isActiveSt ? 'active' : ''; ?>" style="text-decoration:none;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:6px;border:1px solid <?php echo $isActiveSt ? $st['color'] : '#E2E8F0'; ?>;background:<?php echo $isActiveSt ? $st['color'] : '#FFFFFF'; ?>;color:<?php echo $isActiveSt ? '#FFFFFF' : '#4A5568'; ?>">
        <span style="width:8px;height:8px;border-radius:50%;background:<?php echo $isActiveSt ? '#FFFFFF' : $st['color']; ?>;display:inline-block"></span>
        <span><?php echo htmlspecialchars($st['name']); ?></span>
      </a>
    <?php endforeach; ?>
  </div>

  <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px">
    <div>
      <h2 class="panel-card-title" style="margin:0 0 4px">General Inquiries &amp; Messages</h2>
      <p class="panel-card-sub" style="margin:0">Messages submitted via direct contact forms and general email inquiries</p>
    </div>
    
    <!-- Filter Pills -->
    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">
      <div class="date-range-pills">
        <a href="contacts.php?status=all" class="range-pill <?php echo $statusFilter === 'all' ? 'active' : ''; ?>">All Active</a>
        <a href="contacts.php?status=new" class="range-pill <?php echo $statusFilter === 'new' ? 'active' : ''; ?>">New</a>
        <a href="contacts.php?status=replied" class="range-pill <?php echo $statusFilter === 'replied' ? 'active' : ''; ?>">Replied</a>
        <a href="contacts.php?status=spam" class="range-pill <?php echo $statusFilter === 'spam' ? 'active' : ''; ?>" style="<?php echo $statusFilter === 'spam' ? 'color:#991B1B;' : ''; ?>">
          🚫 Spam / Fake (<?php echo $spamContactCount; ?>)
        </a>
      </div>
      <span class="badge badge-new" style="font-weight:700"><?php echo count($contacts); ?> Listed</span>
    </div>
  </div>
</div>

<div class="panel-card" style="padding:0;overflow:hidden">
  <div class="table-responsive">
    <table class="panel-table contacts-table">
      <thead>
        <tr>
          <th>Sender</th>
          <th>Site</th>
          <th>Contact Info</th>
          <th>Subject / Message</th>
          <th>Status</th>
          <th>Source / IP</th>
          <th style="text-align:right">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($contacts)): ?>
          <tr>
            <td colspan="7" style="text-align:center;padding:40px;color:#A0AEC0">
              No messages found for this filter.
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($contacts as $c): ?>
            <tr>
              <td>
                <strong><?php echo htmlspecialchars($c['name']); ?></strong>
                <div style="font-size:11.5px;color:#A0AEC0">
                  <?php echo date('d M Y, H:i', strtotime($c['created_at'])); ?>
                </div>
              </td>
              <td>
                <?php echo renderSiteBadge($c['site_id'] ?? 1); ?>
              </td>
              <td>
                <?php if (!empty($c['phone'])): ?>
                  <div><a href="tel:<?php echo htmlspecialchars($c['phone']); ?>" style="color:#4F6B42;font-weight:600"><?php echo htmlspecialchars($c['phone']); ?></a></div>
                <?php endif; ?>
                <?php if (!empty($c['email'])): ?>
                  <div style="font-size:12px"><a href="mailto:<?php echo htmlspecialchars($c['email']); ?>" style="color:#718096"><?php echo htmlspecialchars($c['email']); ?></a></div>
                <?php endif; ?>
              </td>
              <td style="max-width:320px">
                <div style="font-weight:600;color:#2D3748"><?php echo htmlspecialchars($c['subject'] ?: 'Inquiry'); ?></div>
                <div style="font-size:12.5px;color:#718096;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                  <?php echo htmlspecialchars($c['message']); ?>
                </div>
              </td>
              <td>
                <?php if (strtolower($c['status'] ?? '') === 'spam'): ?>
                  <span class="badge" style="background:#FEE2E2;color:#991B1B;border:1px solid #FCA5A5;font-weight:700">
                    🚫 Spam / Fake
                  </span>
                <?php else: ?>
                  <span class="badge badge-<?php echo htmlspecialchars($c['status']); ?>">
                    <?php echo ucfirst($c['status']); ?>
                  </span>
                <?php endif; ?>
              </td>
              <td>
                <?php 
                  $cPage = $c['source_page'] ?? $c['page_url'] ?? 'contact.php';
                  $cLink = getSitePageUrl($c['site_id'] ?? 1, (string)$cPage);
                  $cCleanName = formatPageLocation((string)$cPage);
                ?>
                <a href="<?php echo htmlspecialchars($cLink); ?>" target="_blank" class="source-pill" title="Click to open <?php echo htmlspecialchars($cCleanName); ?> in a new tab">
                  <span><?php echo htmlspecialchars($cCleanName); ?></span>
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="opacity:0.55;flex-shrink:0"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                </a>
                <div style="font-family:'IBM Plex Mono',monospace;font-size:10.5px;color:#A0AEC0;margin-top:2px">
                  <?php echo htmlspecialchars((string)($c['ip_address'] ?? 'N/A')); ?>
                </div>
              </td>
              <td style="text-align:right;white-space:nowrap">
                <div style="display:inline-flex;align-items:center;gap:6px">
                  <button type="button" class="btn btn-secondary btn-sm" onclick="viewContactDetails(<?php echo htmlspecialchars(json_encode($c)); ?>)">
                    View &amp; Reply
                  </button>

                  <?php if (strtolower($c['status'] ?? '') === 'spam'): ?>
                    <form method="POST" action="contacts.php" style="display:inline">
                      <input type="hidden" name="action" value="restore_contact">
                      <input type="hidden" name="contact_id" value="<?php echo $c['id']; ?>">
                      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
                      <button type="submit" class="btn btn-sm btn-outline" style="color:#15803D;border-color:#86EFAC;padding:5px 8px" title="Restore to active messages">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                      </button>
                    </form>
                  <?php else: ?>
                    <form method="POST" action="contacts.php" class="js-confirm-form"
                          data-confirm-title="Mark Inquiry as Spam / Fake?"
                          data-confirm-message="Mark inquiry #<?php echo $c['id']; ?> from <?php echo htmlspecialchars(addslashes($c['name'])); ?> as Spam/Fake? It will be hidden from your active list."
                          data-confirm-btn="Yes, Mark as Spam"
                          data-confirm-type="warning"
                          style="display:inline">
                      <input type="hidden" name="action" value="mark_spam">
                      <input type="hidden" name="contact_id" value="<?php echo $c['id']; ?>">
                      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
                      <button type="submit" class="btn btn-sm btn-outline" style="color:#C2410C;border-color:#FED7AA;padding:5px 8px" title="Mark as Spam / Fake (Hide)">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                      </button>
                    </form>
                  <?php endif; ?>

                  <form method="POST" action="contacts.php" class="js-confirm-form"
                        data-confirm-title="Delete Inquiry Message?"
                        data-confirm-message="Permanently delete message from <?php echo htmlspecialchars(addslashes($c['name'])); ?>? This action cannot be undone."
                        data-confirm-btn="Yes, Delete"
                        data-confirm-type="danger"
                        style="display:inline">
                    <input type="hidden" name="action" value="delete_contact">
                    <input type="hidden" name="contact_id" value="<?php echo $c['id']; ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
                    <button type="submit" class="btn btn-sm btn-outline" style="color:#DC2626;border-color:#FECACA;padding:5px 8px" title="Delete permanently">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal: View Message & Quick Reply -->
<div class="panel-modal-overlay" id="contactModal" style="display:none">
  <div class="panel-modal-card" style="max-width:550px">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #E2E8F0">
      <h3 style="font-family:'Newsreader',Georgia,serif;font-size:22px;margin:0;color:#1A1A1A" id="cModalTitle">Contact Message</h3>
      <button type="button" class="btn-close-modal" onclick="closeModal('contactModal')">&times;</button>
    </div>

    <div id="cModalBody" style="display:grid;gap:14px;font-size:13.5px;margin-bottom:20px">
      <!-- Injected via JS -->
    </div>

    <!-- Quick Reply Form -->
    <form method="POST" action="contacts.php" id="replyForm" style="border-top:1px solid #E2E8F0;padding-top:16px">
      <input type="hidden" name="action" value="send_reply">
      <input type="hidden" name="contact_id" id="replyContactId" value="">
      <input type="hidden" name="to_email" id="replyToEmail" value="">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">

      <div style="margin-bottom:10px">
        <label class="form-label" style="font-size:12px">Reply Subject</label>
        <input type="text" name="subject" id="replySubject" class="form-input" style="height:38px;font-size:13px" value="RE: Another Level Loft Conversions Inquiry">
      </div>

      <div style="margin-bottom:14px">
        <label class="form-label" style="font-size:12px">Email Response Message</label>
        <textarea name="reply_message" class="form-input" style="height:90px;font-size:13px;resize:vertical" placeholder="Type your response to the customer..." required></textarea>
      </div>

      <div style="display:flex;justify-content:space-between;align-items:center">
        <button type="button" class="btn btn-secondary btn-sm" onclick="markAsReplied()">Mark as Replied Only</button>
        <div style="display:flex;gap:8px">
          <button type="button" class="btn btn-secondary btn-sm" onclick="closeModal('contactModal')">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Send Email Reply</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function viewContactDetails(c) {
  const modal = document.getElementById('contactModal');
  const body = document.getElementById('cModalBody');
  document.getElementById('replyContactId').value = c.id;
  document.getElementById('replyToEmail').value = c.email || '';

  body.innerHTML = `
    <div style="background:#F8FAFC;padding:12px;border-radius:6px;border:1px solid #E2E8F0">
      <div><strong>From:</strong> ${c.name}</div>
      <div><strong>Phone:</strong> <a href="tel:${c.phone}" style="color:#4F6B42;font-weight:700">${c.phone || 'N/A'}</a></div>
      <div><strong>Email:</strong> <a href="mailto:${c.email}" style="color:#4F6B42">${c.email || 'N/A'}</a></div>
      <div><strong>Received:</strong> ${c.created_at}</div>
    </div>
    <div>
      <div style="font-weight:700;color:#2D3748;margin-bottom:4px">Subject: ${c.subject || 'Inquiry'}</div>
      <div style="background:#FFFFFF;border:1px solid #E2E8F0;padding:12px;border-radius:6px;line-height:1.6;color:#1A202C">
        ${c.message.replace(/\\n/g, '<br>')}
      </div>
    </div>
    <div style="font-size:12px;color:#718096">
      <strong>Source Page:</strong> <code>${c.page_url || '/'}</code> &bull; <strong>IP:</strong> <code>${c.ip_address || 'N/A'}</code>
    </div>
  `;

  modal.style.display = 'flex';
}

function markAsReplied() {
  const cId = document.getElementById('replyContactId').value;
  if (!cId) return;
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = 'contacts.php';
  form.innerHTML = `
    <input type="hidden" name="action" value="update_status">
    <input type="hidden" name="contact_id" value="${cId}">
    <input type="hidden" name="status" value="replied">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
  `;
  document.body.appendChild(form);
  form.submit();
}

function closeModal(id) {
  document.getElementById(id).style.display = 'none';
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
