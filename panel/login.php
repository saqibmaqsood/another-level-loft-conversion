<?php
require_once __DIR__ . '/includes/auth.php';

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';
$username = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $csrf = $_POST['csrf_token'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!validateCSRF($csrf)) {
        $error = 'Security session expired. Please refresh and try again.';
    } elseif (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        $loginRes = attemptLogin($username, $password);
        if ($loginRes['success']) {
            header('Location: index.php');
            exit;
        } else {
            $error = $loginRes['error'];
        }
    }
}

$csrfToken = getCSRFToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login &mdash; Another Level Leads Engine</title>
  <meta name="robots" content="noindex, nofollow">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500&family=Manrope:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="css/panel.css?v=<?php echo time(); ?>">
  <style>
    body.login-body {
      background: linear-gradient(135deg, #10161A 0%, #1A2228 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      color: #FFFFFF;
      font-family: 'Manrope', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    .login-container {
      width: 100%;
      max-width: 440px;
    }
    .login-card {
      background: #FFFFFF;
      color: #1A1A1A;
      border-radius: 12px;
      padding: 36px 32px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.3);
      border: 1px solid rgba(255,255,255,0.1);
    }
    .login-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 24px;
    }
    .login-brand-icon {
      width: 44px;
      height: 44px;
      border-radius: 8px;
      background: #4F6B42;
      color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 18px;
      letter-spacing: -0.5px;
    }
    .login-title {
      font-family: 'Newsreader', Georgia, serif;
      font-size: 26px;
      font-weight: 400;
      margin: 0;
      color: #1A1A1A;
      line-height: 1.2;
    }
    .login-subtitle {
      font-size: 13.5px;
      color: #718096;
      margin: 4px 0 0;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #2D3748;
    }
    .form-input {
      width: 100%;
      height: 46px;
      padding: 10px 14px;
      border: 1px solid #E2E8F0;
      border-radius: 6px;
      font-size: 15px;
      font-family: inherit;
      color: #1A202C;
      background: #F8FAFC;
      transition: all 0.2s ease;
      box-sizing: border-box;
    }
    .form-input:focus {
      outline: none;
      border-color: #4F6B42;
      background: #FFFFFF;
      box-shadow: 0 0 0 3px rgba(79, 107, 66, 0.15);
    }
    .btn-login {
      width: 100%;
      height: 48px;
      background: #4F6B42;
      color: #FFFFFF;
      border: none;
      border-radius: 6px;
      font-size: 15px;
      font-weight: 700;
      font-family: inherit;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.2s ease;
      margin-top: 24px;
    }
    .btn-login:hover {
      background: #3E5434;
      box-shadow: 0 4px 12px rgba(79, 107, 66, 0.3);
    }
    .login-error {
      background: #FFF5F5;
      border: 1px solid #FEB2B2;
      color: #C53030;
      padding: 12px 14px;
      border-radius: 6px;
      font-size: 13.5px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .credentials-hint {
      margin-top: 20px;
      padding: 12px 14px;
      background: #F0FFF4;
      border: 1px solid #C6F6D5;
      border-radius: 6px;
      font-size: 12px;
      color: #22543D;
      line-height: 1.5;
    }
  </style>
</head>
<body class="login-body">

<div class="login-container">
  <div class="login-card">
    <div class="login-brand">
      <div class="login-brand-icon">AL</div>
      <div>
        <h1 class="login-title">Another Level</h1>
        <p class="login-subtitle">Leads &amp; Booking Management</p>
      </div>
    </div>

    <?php if (!empty($error)): ?>
      <div class="login-error">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        <span><?php echo htmlspecialchars($error); ?></span>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" autocomplete="on">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

      <div class="form-group">
        <label class="form-label" for="username">Username or Email</label>
        <input 
          type="text" 
          id="username" 
          name="username" 
          class="form-input" 
          value="<?php echo htmlspecialchars($username); ?>" 
          placeholder="admin" 
          required 
          autofocus 
          autocomplete="username"
        >
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          class="form-input" 
          placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" 
          required 
          autocomplete="current-password"
        >
      </div>

      <button type="submit" class="btn-login">
        <span>Log In to Dashboard</span>
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
      </button>
    </form>

    <div class="credentials-hint">
      <strong>Initial Access:</strong> Username: <code>admin</code> | Password: <code>Admin@1234</code><br>
      <span style="color:#718096;font-size:11px">You can change your password anytime inside Settings.</span>
    </div>
  </div>

  <div style="text-align:center;margin-top:20px;font-size:12.5px;color:#A0AEC0">
    <a href="../index.php" style="color:#CBD5E0;text-decoration:none">&larr; Return to Main Website</a>
  </div>
</div>

</body>
</html>
