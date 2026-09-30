<?php
/**
 * Another Level Loft Conversions - Authentication & Security Middleware
 */

declare(strict_types=1);

require_once __DIR__ . '/db.php';

function initSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        if (!headers_sent()) {
            ini_set('session.cookie_httponly', '1');
            ini_set('session.use_only_cookies', '1');
            ini_set('session.cookie_samesite', 'Lax');
            session_start();
        } else {
            @session_start();
        }
    }
}

function isLoggedIn(): bool {
    initSession();
    return isset($_SESSION['panel_user_id']) && !empty($_SESSION['panel_user_id']);
}

function requireAuth(): void {
    initSession();
    if (!isLoggedIn()) {
        $loginUrl = 'login.php';
        header("Location: {$loginUrl}");
        exit;
    }
}

function getCurrentUser(): ?array {
    initSession();
    if (!isLoggedIn()) {
        return null;
    }

    $db = getDb();
    $stmt = $db->prepare("SELECT id, username, email, full_name, last_login FROM admin_users WHERE id = :id");
    $stmt->execute([':id' => $_SESSION['panel_user_id']]);
    $user = $stmt->fetch();
    return $user ?: null;
}

function loginUser(string $username, string $password): array {
    initSession();

    // Rate limiting / Brute-force check
    $failedKey = 'failed_login_attempts';
    $lockKey = 'login_lockout_until';

    if (isset($_SESSION[$lockKey]) && time() < $_SESSION[$lockKey]) {
        $waitSec = $_SESSION[$lockKey] - time();
        return ['success' => false, 'message' => "Too many failed attempts. Please wait {$waitSec} seconds."];
    }

    $db = getDb();
    $stmt = $db->prepare("SELECT * FROM admin_users WHERE username = :u OR email = :u LIMIT 1");
    $stmt->execute([':u' => trim($username)]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        // Reset failed attempts
        unset($_SESSION[$failedKey], $_SESSION[$lockKey]);
        session_regenerate_id(true);

        $_SESSION['panel_user_id'] = $user['id'];
        $_SESSION['panel_username'] = $user['username'];
        $_SESSION['panel_full_name'] = $user['full_name'];

        // Update last login
        $upd = $db->prepare("UPDATE admin_users SET last_login = CURRENT_TIMESTAMP WHERE id = :id");
        $upd->execute([':id' => $user['id']]);

        return ['success' => true];
    }

    // Increment failed attempts
    $attempts = ($_SESSION[$failedKey] ?? 0) + 1;
    $_SESSION[$failedKey] = $attempts;

    if ($attempts >= 5) {
        $_SESSION[$lockKey] = time() + (5 * 60); // 5 min lockout
        return ['success' => false, 'message' => 'Too many failed login attempts. Locked out for 5 minutes.'];
    }

    return ['success' => false, 'message' => 'Invalid username or password.'];
}

function logoutUser(): void {
    initSession();
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

function getCsrfToken(): string {
    initSession();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrfToken(?string $token): bool {
    initSession();
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

// Global aliases for convenience
function requireLogin(): void { requireAuth(); }
function attemptLogin(string $username, string $password): array {
    $res = loginUser($username, $password);
    return ['success' => $res['success'], 'error' => $res['message'] ?? ''];
}
function validateCSRF(?string $token): bool { return verifyCsrfToken($token); }

