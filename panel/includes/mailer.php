<?php
/**
 * Another Level Loft Conversions - Mailer & Email Dispatcher with Native SMTP Support
 */

declare(strict_types=1);

require_once __DIR__ . '/db.php';

/**
 * Socket-level SMTP Email Dispatcher
 */
function sendViaSmtp(
    string $recipientEmail,
    string $recipientName,
    string $subject,
    string $bodyHtml,
    array $smtpConfig
): array {
    $host = trim($smtpConfig['smtp_host'] ?? 'localhost');
    $port = (int)($smtpConfig['smtp_port'] ?? 587);
    $user = trim($smtpConfig['smtp_user'] ?? '');
    $pass = $smtpConfig['smtp_pass'] ?? '';
    $encryption = strtolower(trim($smtpConfig['smtp_secure'] ?? 'tls'));
    $fromEmail = trim($smtpConfig['smtp_from_email'] ?? 'info@anotherlevelloftconversions.co.uk');
    $fromName = trim($smtpConfig['smtp_from_name'] ?? 'Another Level Loft Conversions');

    $timeout = 10;
    $log = [];

    // Prefix for direct SSL connection
    $remote = ($encryption === 'ssl' || $port === 465) ? "ssl://{$host}:{$port}" : "tcp://{$host}:{$port}";

    $socket = @stream_socket_client($remote, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT);
    if (!$socket) {
        return ['success' => false, 'error' => "Cannot connect to SMTP server ({$remote}): {$errstr} ({$errno})", 'log' => $log];
    }

    stream_set_timeout($socket, $timeout);

    $read = function () use ($socket, &$log) {
        $response = '';
        while ($line = fgets($socket, 515)) {
            $response .= $line;
            if (substr($line, 3, 1) === ' ') {
                break;
            }
        }
        $log[] = "S: " . trim($response);
        return $response;
    };

    $write = function (string $cmd) use ($socket, &$log) {
        $log[] = "C: " . trim($cmd);
        fwrite($socket, $cmd . "\r\n");
    };

    $initial = $read();
    if (substr($initial, 0, 3) !== '220') {
        fclose($socket);
        return ['success' => false, 'error' => "Invalid greeting: {$initial}", 'log' => $log];
    }

    // EHLO
    $write("EHLO " . ($_SERVER['SERVER_NAME'] ?? 'localhost'));
    $ehloResp = $read();

    // STARTTLS if TLS encryption requested
    if ($encryption === 'tls' || ($port === 587 && strpos($ehloResp, 'STARTTLS') !== false)) {
        $write("STARTTLS");
        $tlsResp = $read();
        if (substr($tlsResp, 0, 3) === '220') {
            $crypto = @stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT | STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT);
            if (!$crypto) {
                fclose($socket);
                return ['success' => false, 'error' => "STARTTLS handshake failed", 'log' => $log];
            }
            $write("EHLO " . ($_SERVER['SERVER_NAME'] ?? 'localhost'));
            $read();
        }
    }

    // AUTH LOGIN if credentials provided
    if (!empty($user)) {
        $write("AUTH LOGIN");
        $authResp = $read();
        if (substr($authResp, 0, 3) === '334') {
            $write(base64_encode($user));
            $userResp = $read();
            if (substr($userResp, 0, 3) === '334') {
                $write(base64_encode($pass));
                $passResp = $read();
                if (substr($passResp, 0, 3) !== '235') {
                    fclose($socket);
                    return ['success' => false, 'error' => "SMTP Authentication failed: {$passResp}", 'log' => $log];
                }
            } else {
                fclose($socket);
                return ['success' => false, 'error' => "SMTP Username rejected: {$userResp}", 'log' => $log];
            }
        }
    }

    // MAIL FROM
    $write("MAIL FROM: <{$fromEmail}>");
    $fromResp = $read();
    if (substr($fromResp, 0, 3) !== '250') {
        fclose($socket);
        return ['success' => false, 'error' => "MAIL FROM rejected: {$fromResp}", 'log' => $log];
    }

    // RCPT TO
    $write("RCPT TO: <{$recipientEmail}>");
    $rcptResp = $read();
    if (substr($rcptResp, 0, 3) !== '250' && substr($rcptResp, 0, 3) !== '251') {
        fclose($socket);
        return ['success' => false, 'error' => "RCPT TO rejected: {$rcptResp}", 'log' => $log];
    }

    // DATA
    $write("DATA");
    $dataResp = $read();
    if (substr($dataResp, 0, 3) !== '354') {
        fclose($socket);
        return ['success' => false, 'error' => "DATA command rejected: {$dataResp}", 'log' => $log];
    }

    // Build Email MIME Payload
    $encodedSub = "=?UTF-8?B?" . base64_encode($subject) . "?=";
    $encodedFrom = "=?UTF-8?B?" . base64_encode($fromName) . "?=";
    $msgId = "<" . time() . "." . uniqid() . "@" . ($_SERVER['SERVER_NAME'] ?? 'anotherlevelloftconversions.co.uk') . ">";

    $messageData  = "Message-ID: {$msgId}\r\n";
    $messageData .= "Date: " . date('r') . "\r\n";
    $messageData .= "From: {$encodedFrom} <{$fromEmail}>\r\n";
    $messageData .= "To: <{$recipientEmail}>\r\n";
    $messageData .= "Reply-To: {$fromEmail}\r\n";
    $messageData .= "Subject: {$encodedSub}\r\n";
    $messageData .= "MIME-Version: 1.0\r\n";
    $messageData .= "Content-Type: text/html; charset=UTF-8\r\n";
    $messageData .= "X-Mailer: AnotherLevel-SMTP/2026\r\n\r\n";
    $messageData .= $bodyHtml . "\r\n.";

    $write($messageData);
    $sendResp = $read();

    $write("QUIT");
    $read();
    fclose($socket);

    if (substr($sendResp, 0, 3) === '250') {
        return ['success' => true, 'error' => null, 'log' => $log];
    }

    return ['success' => false, 'error' => "Send failed: {$sendResp}", 'log' => $log];
}

/**
 * Dispatch Templated Email via SMTP or PHP mail()
 */
function sendTemplateEmail(string $recipientEmail, string $recipientName, string $templateKey, array $placeholders): bool {
    $db = getDb();
    
    // Fetch template
    $stmt = $db->prepare("SELECT subject, body_html FROM email_templates WHERE template_key = :k LIMIT 1");
    $stmt->execute([':k' => $templateKey]);
    $template = $stmt->fetch();

    if (!$template) {
        error_log("Email template not found: {$templateKey}");
        return false;
    }

    // Replace placeholders
    $subject = $template['subject'];
    $body = $template['body_html'];

    foreach ($placeholders as $key => $val) {
        $subject = str_replace('{{' . $key . '}}', (string)$val, $subject);
        $body = str_replace('{{' . $key . '}}', (string)$val, $body);
    }

    // Get sender & SMTP settings
    $settStmt = $db->query("SELECT key, value FROM settings");
    $settings = $settStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $smtpEnabled = ($settings['smtp_enabled'] ?? '0') === '1';
    $status = 'sent';
    $errorMsg = null;

    if ($smtpEnabled && !empty($settings['smtp_host'])) {
        $smtpRes = sendViaSmtp($recipientEmail, $recipientName, $subject, $body, $settings);
        if ($smtpRes['success']) {
            $status = 'sent';
        } else {
            $status = 'failed';
            $errorMsg = 'SMTP Error: ' . ($smtpRes['error'] ?? 'Unknown failure');
            error_log($errorMsg);
        }
    } else {
        // Fallback to PHP native mail()
        $fromEmail = $settings['smtp_from_email'] ?? 'info@anotherlevelloftconversions.co.uk';
        $fromName = $settings['smtp_from_name'] ?? 'Another Level Loft Conversions';

        $headers = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            "From: =?UTF-8?B?" . base64_encode($fromName) . "?= <{$fromEmail}>",
            "Reply-To: {$fromEmail}",
            'X-Mailer: AnotherLevel-PHP/' . phpversion()
        ];

        try {
            $sent = @mail($recipientEmail, "=?UTF-8?B?" . base64_encode($subject) . "?=", $body, implode("\r\n", $headers));
            if (!$sent) {
                $status = 'failed';
                $errorMsg = 'PHP mail() returned false.';
            }
        } catch (Throwable $e) {
            $status = 'failed';
            $errorMsg = $e->getMessage();
        }
    }

    // Log the email
    try {
        $logStmt = $db->prepare("
            INSERT INTO email_logs (recipient, subject, template_key, status, error_message, sent_at)
            VALUES (:r, :s, :tk, :st, :err, datetime('now'))
        ");
        $logStmt->execute([
            ':r' => $recipientEmail,
            ':s' => $subject,
            ':tk' => $templateKey,
            ':st' => $status,
            ':err' => $errorMsg
        ]);
    } catch (Throwable $e) {
        error_log('Failed to log email: ' . $e->getMessage());
    }

    return $status === 'sent';
}

function sendBookingEmails(array $booking): void {
    $db = getDb();
    $settStmt = $db->query("SELECT key, value FROM settings");
    $settings = $settStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $placeholders = [
        'reference_id' => $booking['reference_id'] ?? 'AL-' . strtoupper(substr(uniqid(), -6)),
        'name' => htmlspecialchars((string)($booking['name'] ?? 'Valued Customer')),
        'phone' => htmlspecialchars((string)($booking['phone'] ?? '')),
        'email' => htmlspecialchars((string)($booking['email'] ?? '')),
        'property_type' => htmlspecialchars((string)($booking['property_type'] ?? 'Loft Conversion')),
        'postcode' => htmlspecialchars((string)($booking['postcode'] ?? '')),
        'address' => htmlspecialchars((string)($booking['address'] ?? '')),
        'loft_height' => htmlspecialchars((string)($booking['loft_height'] ?? 'Not specified')),
        'preferred_date' => htmlspecialchars((string)($booking['preferred_date'] ?? date('Y-m-d'))),
        'preferred_slot' => htmlspecialchars((string)($booking['preferred_slot'] ?? 'Flexible')),
        'source_page' => htmlspecialchars((string)($booking['source_page'] ?? '/')),
        'ip_address' => htmlspecialchars((string)($booking['ip_address'] ?? 'Unknown')),
        'device_type' => htmlspecialchars((string)($booking['device_type'] ?? 'Desktop')),
        'panel_url' => 'http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/panel/bookings.php'
    ];

    // 1. Send confirmation to customer if email provided and enabled
    if (!empty($booking['email']) && filter_var($booking['email'], FILTER_VALIDATE_EMAIL) && ($settings['auto_email_customer'] ?? '1') === '1') {
        sendTemplateEmail($booking['email'], $booking['name'], 'booking_confirmation', $placeholders);
    }

    // 2. Send instant alert to admin
    $adminEmail = $settings['admin_notification_email'] ?? $settings['surveyor_email'] ?? 'info@anotherlevelloftconversions.co.uk';
    if (!empty($adminEmail) && ($settings['auto_email_admin'] ?? '1') === '1') {
        sendTemplateEmail($adminEmail, 'Another Level Admin', 'booking_admin_alert', $placeholders);
    }
}

function sendContactEmails(array $contact): void {
    $db = getDb();
    $settStmt = $db->query("SELECT key, value FROM settings");
    $settings = $settStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $placeholders = [
        'name' => htmlspecialchars((string)($contact['name'] ?? 'Valued Customer')),
        'email' => htmlspecialchars((string)($contact['email'] ?? '')),
        'phone' => htmlspecialchars((string)($contact['phone'] ?? 'None')),
        'subject' => htmlspecialchars((string)($contact['subject'] ?? 'General Inquiry')),
        'message' => nl2br(htmlspecialchars((string)($contact['message'] ?? '')))
    ];

    // Send confirmation to user
    if (!empty($contact['email']) && filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
        sendTemplateEmail($contact['email'], $contact['name'], 'contact_confirmation', $placeholders);
    }
}

// Global helpers
function sendTemplatedEmail(string $templateKey, string $recipientEmail, string $recipientName, array $placeholders): bool {
    return sendTemplateEmail($recipientEmail, $recipientName, $templateKey, $placeholders);
}

function sendRawEmail(string $recipientEmail, string $subject, string $htmlBody, string $recipientName = ''): bool {
    $db = getDb();
    $settStmt = $db->query("SELECT key, value FROM settings");
    $settings = $settStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $smtpEnabled = ($settings['smtp_enabled'] ?? '0') === '1';
    $status = 'sent';
    $errorMsg = null;

    if ($smtpEnabled && !empty($settings['smtp_host'])) {
        $smtpRes = sendViaSmtp($recipientEmail, $recipientName, $subject, $htmlBody, $settings);
        if ($smtpRes['success']) {
            $status = 'sent';
        } else {
            $status = 'failed';
            $errorMsg = 'SMTP Error: ' . ($smtpRes['error'] ?? 'Unknown failure');
        }
    } else {
        $fromEmail = $settings['smtp_from_email'] ?? 'info@anotherlevelloftconversions.co.uk';
        $fromName = $settings['smtp_from_name'] ?? 'Another Level Loft Conversions';

        $headers = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            "From: =?UTF-8?B?" . base64_encode($fromName) . "?= <{$fromEmail}>",
            "Reply-To: {$fromEmail}",
            'X-Mailer: AnotherLevel-PHP/' . phpversion()
        ];

        try {
            $sent = @mail($recipientEmail, "=?UTF-8?B?" . base64_encode($subject) . "?=", $htmlBody, implode("\r\n", $headers));
            if (!$sent) {
                $status = 'failed';
                $errorMsg = 'PHP mail() returned false.';
            }
        } catch (Throwable $e) {
            $status = 'failed';
            $errorMsg = $e->getMessage();
        }
    }

    try {
        $logStmt = $db->prepare("
            INSERT INTO email_logs (recipient, subject, template_key, status, error_message, sent_at)
            VALUES (:r, :s, 'raw_custom', :st, :err, datetime('now'))
        ");
        $logStmt->execute([
            ':r' => $recipientEmail,
            ':s' => $subject,
            ':st' => $status,
            ':err' => $errorMsg
        ]);
    } catch (Throwable $e) {
        error_log('Failed to log raw email: ' . $e->getMessage());
    }

    return $status === 'sent';
}

