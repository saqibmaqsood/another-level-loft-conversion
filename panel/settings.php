<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();
$db = getDB();
$currentUser = getCurrentUser();

// Handle Settings or Password Updates
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action'])) {
    if (!validateCSRF($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash_msg'] = 'Security validation failed.';
        $_SESSION['flash_type'] = 'error';
    } else {
        if ($_POST['action'] === 'update_profile_password') {
            $currentPass = $_POST['current_password'] ?? '';
            $newPass     = $_POST['new_password'] ?? '';
            $confirmPass = $_POST['confirm_password'] ?? '';

            // Verify current password
            $userStmt = $db->prepare("SELECT password_hash FROM admin_users WHERE id = ?");
            $userStmt->execute([$currentUser['id']]);
            $hash = $userStmt->fetchColumn();

            if (!password_verify($currentPass, $hash)) {
                $_SESSION['flash_msg'] = 'Current password entered is incorrect.';
                $_SESSION['flash_type'] = 'error';
            } elseif (strlen($newPass) < 6) {
                $_SESSION['flash_msg'] = 'New password must be at least 6 characters long.';
                $_SESSION['flash_type'] = 'error';
            } elseif ($newPass !== $confirmPass) {
                $_SESSION['flash_msg'] = 'New password and confirmation do not match.';
                $_SESSION['flash_type'] = 'error';
            } else {
                $newHash = password_hash($newPass, PASSWORD_DEFAULT);
                $upStmt = $db->prepare("UPDATE admin_users SET password_hash = ? WHERE id = ?");
                $upStmt->execute([$newHash, $currentUser['id']]);
                $_SESSION['flash_msg'] = 'Your password has been changed successfully.';
                $_SESSION['flash_type'] = 'success';
            }
        } elseif ($_POST['action'] === 'save_notifications') {
            $surveyorEmail = trim($_POST['surveyor_email'] ?? '');
            $companyPhone  = trim($_POST['company_phone'] ?? '');

            if (!empty($surveyorEmail)) {
                setSetting('surveyor_email', $surveyorEmail);
            }
            if (!empty($companyPhone)) {
                setSetting('company_phone', $companyPhone);
            }

            $_SESSION['flash_msg'] = 'Notification settings saved successfully.';
            $_SESSION['flash_type'] = 'success';
        } elseif ($_POST['action'] === 'save_analytics') {
            $gaId  = trim($_POST['ga_measurement_id'] ?? '');
            $gtmId = trim($_POST['gtm_container_id'] ?? '');

            setSetting('ga_measurement_id', $gaId);
            setSetting('gtm_container_id', $gtmId);

            $_SESSION['flash_msg'] = 'Google Analytics & GTM settings saved successfully.';
            $_SESSION['flash_type'] = 'success';
        } elseif ($_POST['action'] === 'save_ai_chat') {
            setSetting('ai_chat_enabled', isset($_POST['ai_chat_enabled']) ? '1' : '0');
            setSetting('ai_chat_lead_notify', isset($_POST['ai_chat_lead_notify']) ? '1' : '0');
            setSetting('openai_model', trim($_POST['openai_model'] ?? 'gpt-4o-mini'));
            setSetting('ai_chat_name', trim($_POST['ai_chat_name'] ?? 'Sarah — Loft Specialist'));
            if (isset($_POST['openai_api_key'])) {
                setSetting('openai_api_key', trim($_POST['openai_api_key']));
            }

            $_SESSION['flash_msg'] = 'AI Live Chat settings updated successfully.';
            $_SESSION['flash_type'] = 'success';
        } elseif ($_POST['action'] === 'save_smtp') {
            setSetting('smtp_enabled', isset($_POST['smtp_enabled']) ? '1' : '0');
            setSetting('smtp_host', trim($_POST['smtp_host'] ?? ''));
            setSetting('smtp_port', trim($_POST['smtp_port'] ?? '587'));
            setSetting('smtp_secure', trim($_POST['smtp_secure'] ?? 'tls'));
            setSetting('smtp_user', trim($_POST['smtp_user'] ?? ''));
            if (!empty($_POST['smtp_pass'])) {
                setSetting('smtp_pass', $_POST['smtp_pass']);
            }
            setSetting('smtp_from_email', trim($_POST['smtp_from_email'] ?? ''));
            setSetting('smtp_from_name', trim($_POST['smtp_from_name'] ?? ''));

            $_SESSION['flash_msg'] = 'SMTP Mail Server configuration saved successfully.';
            $_SESSION['flash_type'] = 'success';
        } elseif ($_POST['action'] === 'test_smtp') {
            require_once __DIR__ . '/includes/mailer.php';
            $testTo = trim($_POST['test_smtp_recipient'] ?? '');
            if (!empty($testTo) && filter_var($testTo, FILTER_VALIDATE_EMAIL)) {
                $smtpConfig = [
                    'smtp_host' => trim($_POST['smtp_host'] ?? getSetting('smtp_host', '')),
                    'smtp_port' => trim($_POST['smtp_port'] ?? getSetting('smtp_port', '587')),
                    'smtp_secure' => trim($_POST['smtp_secure'] ?? getSetting('smtp_secure', 'tls')),
                    'smtp_user' => trim($_POST['smtp_user'] ?? getSetting('smtp_user', '')),
                    'smtp_pass' => !empty($_POST['smtp_pass']) ? $_POST['smtp_pass'] : getSetting('smtp_pass', ''),
                    'smtp_from_email' => trim($_POST['smtp_from_email'] ?? getSetting('smtp_from_email', 'info@anotherlevelloftconversions.co.uk')),
                    'smtp_from_name' => trim($_POST['smtp_from_name'] ?? getSetting('smtp_from_name', 'Another Level Loft Conversions'))
                ];

                $testHtml = "
                <div style='font-family:Arial,sans-serif;max-width:550px;padding:24px;border:1px solid #e2e8f0;border-radius:8px;'>
                  <h2 style='color:#4F6B42;margin-top:0;'>SMTP Connection Test Successful</h2>
                  <p>Your custom SMTP mail server configuration is active and working properly.</p>
                  <p style='font-size:13px;color:#718096;'>Dispatched from: <strong>Another Level Panel</strong> at " . date('Y-m-d H:i:s') . "</p>
                </div>";

                $res = sendViaSmtp($testTo, 'Admin Test', 'SMTP Test Connection Successful - Another Level', $testHtml, $smtpConfig);
                if ($res['success']) {
                    $_SESSION['flash_msg'] = "SMTP test email sent successfully to {$testTo}!";
                    $_SESSION['flash_type'] = 'success';
                } else {
                    $_SESSION['flash_msg'] = "SMTP Test Failed: " . ($res['error'] ?? 'Unknown socket error');
                    $_SESSION['flash_type'] = 'error';
                }
            } else {
                $_SESSION['flash_msg'] = 'Please enter a valid recipient email for the test connection.';
                $_SESSION['flash_type'] = 'error';
            }
        }
        header("Location: settings.php");
        exit;
    }
}

$currentSurveyorEmail = getSetting('surveyor_email', 'info@anotherlevelloftconversions.co.uk');
$currentCompanyPhone  = getSetting('company_phone', '0800 0862744');
$gaId                 = getSetting('ga_measurement_id', '');
$gtmId                = getSetting('gtm_container_id', '');

$smtpEnabled          = getSetting('smtp_enabled', '0') === '1';
$smtpHost             = getSetting('smtp_host', '');
$smtpPort             = getSetting('smtp_port', '587');
$smtpSecure           = getSetting('smtp_secure', 'tls');
$smtpUser             = getSetting('smtp_user', '');
$smtpPass             = getSetting('smtp_pass', '');
$smtpFromEmail        = getSetting('smtp_from_email', 'info@anotherlevelloftconversions.co.uk');
$smtpFromName         = getSetting('smtp_from_name', 'Another Level Loft Conversions');

$aiChatEnabled        = getSetting('ai_chat_enabled', '1') === '1';
$aiChatLeadNotify     = getSetting('ai_chat_lead_notify', '1') === '1';
$openaiApiKey         = getSetting('openai_api_key', '');
$openaiModel          = getSetting('openai_model', 'gpt-4o-mini');
$aiChatName           = getSetting('ai_chat_name', 'Sarah — Loft Specialist');

$pageTitle = "System Settings & Configuration";
$activeNav = "settings";
require_once __DIR__ . '/includes/header.php';
?>

<div class="panel-grid-2-1" style="display:grid;grid-template-columns:1.2fr 1fr;gap:24px">
  
  <!-- Left: Settings Forms -->
  <div style="display:grid;gap:24px">

    <!-- AI Live Chat & OpenAI Assistant Card -->
    <div class="panel-card">
      <div class="panel-card-header" style="display:flex;justify-content:space-between;align-items:flex-start">
        <div>
          <h2 class="panel-card-title">AI Live Chat &amp; OpenAI Assistant</h2>
          <p class="panel-card-sub">24/7 intelligent homeowner assistant with automated lead capture into Bookings</p>
        </div>
        <div>
          <?php if ($aiChatEnabled && !empty($openaiApiKey)): ?>
            <span class="badge badge-won">OpenAI Active (<?php echo htmlspecialchars($openaiModel); ?>)</span>
          <?php elseif ($aiChatEnabled): ?>
            <span class="badge badge-won">Active (Knowledge Base Mode)</span>
          <?php else: ?>
            <span class="badge badge-lost">Disabled</span>
          <?php endif; ?>
        </div>
      </div>

      <form method="POST" action="settings.php" style="display:grid;gap:16px">
        <input type="hidden" name="action" value="save_ai_chat">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">

        <div style="display:flex;align-items:center;gap:10px;padding:12px 14px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px">
          <input type="checkbox" name="ai_chat_enabled" id="ai_chat_enabled" value="1" <?php echo $aiChatEnabled ? 'checked' : ''; ?> style="width:18px;height:18px;accent-color:#4F6B42;cursor:pointer">
          <label for="ai_chat_enabled" style="font-size:14px;font-weight:600;color:#1A202C;cursor:pointer">Enable AI Live Chat across website</label>
        </div>

        <div style="display:grid;grid-template-columns:1.3fr 1fr;gap:12px">
          <div>
            <label class="form-label">Assistant Persona Name</label>
            <input type="text" name="ai_chat_name" class="form-input" value="<?php echo htmlspecialchars($aiChatName); ?>" placeholder="Sarah — Loft Specialist" required>
            <div style="font-size:12px;color:#718096;margin-top:4px">Displayed in chat header and greetings.</div>
          </div>
          <div>
            <label class="form-label">OpenAI Model</label>
            <select name="openai_model" class="form-input">
              <option value="gpt-4o-mini" <?php echo $openaiModel === 'gpt-4o-mini' ? 'selected' : ''; ?>>gpt-4o-mini (Recommended)</option>
              <option value="gpt-4o" <?php echo $openaiModel === 'gpt-4o' ? 'selected' : ''; ?>>gpt-4o (Most Intelligent)</option>
              <option value="gpt-3.5-turbo" <?php echo $openaiModel === 'gpt-3.5-turbo' ? 'selected' : ''; ?>>gpt-3.5-turbo</option>
            </select>
          </div>
        </div>

        <div>
          <label class="form-label">OpenAI API Key (Optional)</label>
          <input type="password" name="openai_api_key" class="form-input" placeholder="sk-proj-..." value="<?php echo htmlspecialchars($openaiApiKey); ?>" autocomplete="new-password">
          <div style="font-size:12px;color:#718096;margin-top:4px">
            Leave empty to use the built-in <strong>North West Loft Knowledge Base</strong> (answers costs, timelines, permitted development, and areas covered automatically).
          </div>
        </div>

        <div style="display:flex;align-items:center;gap:10px;padding:10px 12px;background:#F0FDF4;border:1px solid #DCFCE7;border-radius:6px">
          <input type="checkbox" name="ai_chat_lead_notify" id="ai_chat_lead_notify" value="1" <?php echo $aiChatLeadNotify ? 'checked' : ''; ?> style="width:16px;height:16px;accent-color:#4F6B42;cursor:pointer">
          <label for="ai_chat_lead_notify" style="font-size:13px;color:#166534;cursor:pointer">
            Automatically email Surveyor when a visitor provides their phone number or postcode in chat
          </label>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:4px">
          <span style="font-size:12px;color:#718096">Desktop: Floating launcher | Mobile: Sticky footer dock</span>
          <button type="submit" class="btn btn-primary">Save Live Chat Settings</button>
        </div>
      </form>
    </div>
    
    <!-- Google Analytics & Tag Manager Card -->
    <div class="panel-card">
      <div class="panel-card-header" style="display:flex;justify-content:space-between;align-items:flex-start">
        <div>
          <h2 class="panel-card-title">Google Analytics &amp; Tag Manager</h2>
          <p class="panel-card-sub">Track every user interaction, call button click, chat trigger, and lead booking</p>
        </div>
        <div>
          <?php if (!empty($gaId) || !empty($gtmId)): ?>
            <span class="badge badge-won">Active &amp; Tracking</span>
          <?php else: ?>
            <span class="badge badge-quote">Not Configured</span>
          <?php endif; ?>
        </div>
      </div>

      <form method="POST" action="settings.php" style="display:grid;gap:16px">
        <input type="hidden" name="action" value="save_analytics">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">

        <div>
          <label class="form-label">GA4 Measurement ID</label>
          <input type="text" name="ga_measurement_id" class="form-input" placeholder="e.g. G-XXXXXXXXXX" value="<?php echo htmlspecialchars($gaId); ?>">
          <div style="font-size:12px;color:#718096;margin-top:4px">Automatically injects Google Analytics 4 tracking script into all frontend pages.</div>
        </div>

        <div>
          <label class="form-label">Google Tag Manager (GTM) Container ID</label>
          <input type="text" name="gtm_container_id" class="form-input" placeholder="e.g. GTM-XXXXXXX" value="<?php echo htmlspecialchars($gtmId); ?>">
          <div style="font-size:12px;color:#718096;margin-top:4px">Injects GTM container head script and noscript fallback.</div>
        </div>

        <div style="display:flex;justify-content:flex-end">
          <button type="submit" class="btn btn-primary">Save Analytics Settings</button>
        </div>
      </form>
    </div>

    <!-- SMTP Mail Server Configuration Card -->
    <div class="panel-card">
      <div class="panel-card-header" style="display:flex;justify-content:space-between;align-items:flex-start">
        <div>
          <h2 class="panel-card-title">SMTP Mail Server Configuration</h2>
          <p class="panel-card-sub">Send automated booking confirmations and marketing campaigns via custom SMTP</p>
        </div>
        <div>
          <?php if ($smtpEnabled): ?>
            <span class="badge badge-won">SMTP Active</span>
          <?php else: ?>
            <span class="badge badge-quote">PHP Mail Fallback</span>
          <?php endif; ?>
        </div>
      </div>

      <form method="POST" action="settings.php" style="display:grid;gap:16px">
        <input type="hidden" name="action" value="save_smtp">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">

        <div style="display:flex;align-items:center;gap:10px;padding:12px 14px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px">
          <input type="checkbox" name="smtp_enabled" id="smtp_enabled" value="1" <?php echo $smtpEnabled ? 'checked' : ''; ?> style="width:18px;height:18px;accent-color:#4F6B42;cursor:pointer">
          <label for="smtp_enabled" style="font-size:14px;font-weight:600;color:#1A202C;cursor:pointer">Enable Custom SMTP Server (Recommended for high deliverability)</label>
        </div>

        <div style="display:grid;grid-template-columns:2fr 1fr 1fr;gap:12px">
          <div>
            <label class="form-label">SMTP Host *</label>
            <input type="text" name="smtp_host" class="form-input" placeholder="smtp.gmail.com / mail.domain.com" value="<?php echo htmlspecialchars($smtpHost); ?>">
          </div>
          <div>
            <label class="form-label">Port *</label>
            <input type="text" name="smtp_port" class="form-input" placeholder="587 / 465" value="<?php echo htmlspecialchars($smtpPort); ?>">
          </div>
          <div>
            <label class="form-label">Encryption</label>
            <select name="smtp_secure" class="form-input">
              <option value="tls" <?php echo $smtpSecure === 'tls' ? 'selected' : ''; ?>>TLS (587)</option>
              <option value="ssl" <?php echo $smtpSecure === 'ssl' ? 'selected' : ''; ?>>SSL (465)</option>
              <option value="none" <?php echo $smtpSecure === 'none' ? 'selected' : ''; ?>>None (25)</option>
            </select>
          </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
          <div>
            <label class="form-label">SMTP Username / Email</label>
            <input type="text" name="smtp_user" class="form-input" placeholder="user@domain.com" value="<?php echo htmlspecialchars($smtpUser); ?>">
          </div>
          <div>
            <label class="form-label">SMTP Password</label>
            <input type="password" name="smtp_pass" class="form-input" placeholder="<?php echo !empty($smtpPass) ? '•••••••• (Saved)' : 'Enter SMTP password'; ?>">
          </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
          <div>
            <label class="form-label">Sender 'From' Email</label>
            <input type="email" name="smtp_from_email" class="form-input" value="<?php echo htmlspecialchars($smtpFromEmail); ?>">
          </div>
          <div>
            <label class="form-label">Sender 'From' Name</label>
            <input type="text" name="smtp_from_name" class="form-input" value="<?php echo htmlspecialchars($smtpFromName); ?>">
          </div>
        </div>

        <div style="display:flex;justify-content:flex-end">
          <button type="submit" class="btn btn-primary">Save SMTP Settings</button>
        </div>
      </form>

      <!-- Test SMTP Connection -->
      <div style="margin-top:20px;padding-top:16px;border-top:1px dashed #CBD5E0">
        <h4 style="font-size:13.5px;font-weight:700;color:#2D3748;margin:0 0 8px">Test SMTP Connection</h4>
        <form method="POST" action="settings.php" style="display:flex;gap:10px;align-items:center">
          <input type="hidden" name="action" value="test_smtp">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">
          <input type="email" name="test_smtp_recipient" class="form-input" style="flex:1" placeholder="Enter your email to receive test message" required>
          <button type="submit" class="btn btn-secondary" style="white-space:nowrap">Test Connection</button>
        </form>
      </div>
    </div>

    <!-- Notification & Lead Alerts Settings -->
    <div class="panel-card">
      <div class="panel-card-header">
        <h2 class="panel-card-title">Surveyor Alerts &amp; Company Info</h2>
        <p class="panel-card-sub">Where instant booking alerts and homeowner inquiries are delivered</p>
      </div>

      <form method="POST" action="settings.php" style="display:grid;gap:16px">
        <input type="hidden" name="action" value="save_notifications">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">

        <div>
          <label class="form-label">Surveyor Alert Email Address *</label>
          <input type="email" name="surveyor_email" class="form-input" value="<?php echo htmlspecialchars($currentSurveyorEmail); ?>" required>
          <div style="font-size:12px;color:#718096;margin-top:4px">Instant lead alert with address &amp; full property specs will be sent to this email.</div>
        </div>

        <div>
          <label class="form-label">Main Business Phone *</label>
          <input type="text" name="company_phone" class="form-input" value="<?php echo htmlspecialchars($currentCompanyPhone); ?>" required>
        </div>

        <div style="display:flex;justify-content:flex-end">
          <button type="submit" class="btn btn-primary">Save Company Info</button>
        </div>
      </form>
    </div>

    <!-- Admin Password Update -->
    <div class="panel-card">
      <div class="panel-card-header">
        <h2 class="panel-card-title">Update Admin Password</h2>
        <p class="panel-card-sub">Change your panel authentication password</p>
      </div>

      <form method="POST" action="settings.php" style="display:grid;gap:14px">
        <input type="hidden" name="action" value="update_profile_password">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCSRFToken()); ?>">

        <div>
          <label class="form-label">Current Password *</label>
          <input type="password" name="current_password" class="form-input" required>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
          <div>
            <label class="form-label">New Password *</label>
            <input type="password" name="new_password" class="form-input" required>
          </div>
          <div>
            <label class="form-label">Confirm New Password *</label>
            <input type="password" name="confirm_password" class="form-input" required>
          </div>
        </div>

        <div style="display:flex;justify-content:flex-end">
          <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
      </form>
    </div>

  </div>

  <!-- Right: System Diagnostics & Information -->
  <div>
    <div class="panel-card">
      <div class="panel-card-header">
        <h3 class="panel-card-title">System &amp; Database Health</h3>
      </div>

      <div style="display:grid;gap:12px;font-size:13.5px">
        <div style="display:flex;justify-content:space-between;padding-bottom:8px;border-bottom:1px solid #E2E8F0">
          <span style="color:#718096">Database Engine</span>
          <strong style="color:#4F6B42">SQLite 3 (Zero-Config)</strong>
        </div>

        <div style="display:flex;justify-content:space-between;padding-bottom:8px;border-bottom:1px solid #E2E8F0">
          <span style="color:#718096">Database Path</span>
          <code>data/database.sqlite</code>
        </div>

        <div style="display:flex;justify-content:space-between;padding-bottom:8px;border-bottom:1px solid #E2E8F0">
          <span style="color:#718096">Database Security</span>
          <span class="badge badge-won">Protected (.htaccess 403)</span>
        </div>

        <div style="display:flex;justify-content:space-between;padding-bottom:8px;border-bottom:1px solid #E2E8F0">
          <span style="color:#718096">PHP Version</span>
          <span class="mono-badge"><?php echo phpversion(); ?></span>
        </div>

        <div style="display:flex;justify-content:space-between;padding-bottom:8px;border-bottom:1px solid #E2E8F0">
          <span style="color:#718096">CSRF Protection</span>
          <span class="badge badge-won">Active (HMAC Token)</span>
        </div>

        <div style="display:flex;justify-content:space-between;padding-bottom:8px;border-bottom:1px solid #E2E8F0">
          <span style="color:#718096">Brute Force Lockout</span>
          <span class="badge badge-won">Active (5 Attempts / 15m)</span>
        </div>

        <div style="display:flex;justify-content:space-between;padding-bottom:8px">
          <span style="color:#718096">Active Session User</span>
          <strong><?php echo htmlspecialchars($currentUser['username'] ?? 'admin'); ?></strong>
        </div>
      </div>
    </div>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
