<?php
/**
 * Another Level Loft Conversions - Database Handler (Zero-Config SQLite)
 */

declare(strict_types=1);

function getDb(): PDO {
    static $db = null;
    if ($db !== null) {
        return $db;
    }

    $dataDir = dirname(__DIR__, 2) . '/data';
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }

    $dbPath = $dataDir . '/database.sqlite';
    $isNew = !file_exists($dbPath);

    try {
        $db = new PDO('sqlite:' . $dbPath);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->exec('PRAGMA journal_mode = WAL;');
        $db->exec('PRAGMA foreign_keys = ON;');

        if ($isNew || filesize($dbPath) === 0) {
            initDatabaseSchema($db);
        }
        migrateEventsTrackingTable($db);
        migrateChatTable($db);
        migrateMultiSiteTables($db);

        return $db;
    } catch (PDOException $e) {
        error_log('Database connection error: ' . $e->getMessage());
        throw $e;
    }
}

function initDatabaseSchema(PDO $db): void {
    // 1. Admin Users Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS admin_users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password_hash TEXT NOT NULL,
            email TEXT NOT NULL,
            full_name TEXT NOT NULL,
            last_login DATETIME,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // 2. Survey Bookings Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS bookings (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            reference_id TEXT UNIQUE NOT NULL,
            property_type TEXT,
            postcode TEXT,
            address TEXT,
            loft_height TEXT,
            preferred_date TEXT NOT NULL,
            preferred_slot TEXT NOT NULL,
            name TEXT NOT NULL,
            phone TEXT NOT NULL,
            email TEXT,
            status TEXT DEFAULT 'New',
            internal_notes TEXT,
            source_page TEXT,
            ip_address TEXT,
            device_type TEXT,
            browser TEXT,
            location_city TEXT,
            referrer TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        CREATE INDEX IF NOT EXISTS idx_bookings_date_slot ON bookings(preferred_date, preferred_slot);
        CREATE INDEX IF NOT EXISTS idx_bookings_status ON bookings(status);
    ");

    // 3. Contact Form Inquiries Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS contacts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            phone TEXT,
            subject TEXT,
            message TEXT NOT NULL,
            status TEXT DEFAULT 'New',
            source_page TEXT,
            ip_address TEXT,
            device_type TEXT,
            internal_notes TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        CREATE INDEX IF NOT EXISTS idx_contacts_status ON contacts(status);
    ");

    // 4. Call & Live Chat Click Events Tracking Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS events_tracking (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            event_type TEXT NOT NULL, -- 'call_click', 'chat_click', 'page_view', 'survey_booked'
            event_target TEXT,        -- phone number or chat title
            source_page TEXT,
            ip_address TEXT,
            device_type TEXT,
            browser TEXT,
            referrer TEXT,
            traffic_source TEXT DEFAULT 'Direct / Bookmarks',
            duration_seconds INTEGER DEFAULT 0,
            is_bot INTEGER DEFAULT 0,
            session_id TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        CREATE INDEX IF NOT EXISTS idx_events_type ON events_tracking(event_type);
        CREATE INDEX IF NOT EXISTS idx_events_created ON events_tracking(created_at);
        CREATE INDEX IF NOT EXISTS idx_events_bot ON events_tracking(is_bot);
        CREATE INDEX IF NOT EXISTS idx_events_session ON events_tracking(session_id);
    ");

    // 5. Email Templates Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS email_templates (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            template_key TEXT UNIQUE NOT NULL,
            title TEXT NOT NULL,
            subject TEXT NOT NULL,
            body_html TEXT NOT NULL,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // 6. Email Logs Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS email_logs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            recipient TEXT NOT NULL,
            subject TEXT NOT NULL,
            template_key TEXT,
            status TEXT DEFAULT 'sent',
            error_message TEXT,
            sent_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // 7. Settings Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS settings (
            key TEXT PRIMARY KEY,
            value TEXT NOT NULL,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // 8. Chat Conversations Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS chat_conversations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            session_id TEXT NOT NULL,
            user_name TEXT,
            user_phone TEXT,
            user_email TEXT,
            user_postcode TEXT,
            message_count INTEGER DEFAULT 0,
            lead_captured INTEGER DEFAULT 0,
            source_page TEXT,
            transcript TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        CREATE INDEX IF NOT EXISTS idx_chat_session ON chat_conversations(session_id);
        CREATE INDEX IF NOT EXISTS idx_chat_created ON chat_conversations(created_at);
    ");

    // Seed Default Admin User: admin / Admin@1234
    $stmt = $db->prepare("SELECT COUNT(*) FROM admin_users");
    $stmt->execute();
    if ((int)$stmt->fetchColumn() === 0) {
        $defaultPassHash = password_hash('Admin@1234', PASSWORD_BCRYPT);
        $insertUser = $db->prepare("
            INSERT INTO admin_users (username, password_hash, email, full_name)
            VALUES ('admin', :hash, 'info@anotherlevelloftconversions.co.uk', 'Another Level Administrator')
        ");
        $insertUser->execute([':hash' => $defaultPassHash]);
    }

    // Seed Default Settings
    $settings = [
        'company_name' => 'Another Level Loft Conversions',
        'admin_notification_email' => 'info@anotherlevelloftconversions.co.uk',
        'phone_toll_free' => '0800 0862744',
        'phone_manchester' => '0161 4100155',
        'phone_preston' => '01772 393005',
        'auto_email_customer' => '1',
        'auto_email_admin' => '1',
        'smtp_enabled' => '0',
        'smtp_host' => 'smtp.example.com',
        'smtp_port' => '587',
        'smtp_user' => '',
        'smtp_pass' => '',
        'smtp_secure' => 'tls',
        'smtp_from_email' => 'info@anotherlevelloftconversions.co.uk',
        'smtp_from_name' => 'Another Level Loft Conversions',
        'ai_chat_enabled' => '1',
        'openai_model' => 'gpt-4o-mini',
        'openai_api_key' => '',
        'ai_chat_lead_notify' => '1',
        'ai_chat_name' => 'Sarah — Loft Specialist'
    ];

    $insertSetting = $db->prepare("INSERT OR IGNORE INTO settings (key, value) VALUES (:k, :v)");
    foreach ($settings as $k => $v) {
        $insertSetting->execute([':k' => $k, ':v' => $v]);
    }

    // Seed Email Templates
    seedEmailTemplates($db);
}

function migrateChatTable(PDO $db): void {
    try {
        $db->exec("
            CREATE TABLE IF NOT EXISTS chat_conversations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                session_id TEXT NOT NULL,
                user_name TEXT,
                user_phone TEXT,
                user_email TEXT,
                user_postcode TEXT,
                message_count INTEGER DEFAULT 0,
                lead_captured INTEGER DEFAULT 0,
                source_page TEXT,
                transcript TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );
            CREATE INDEX IF NOT EXISTS idx_chat_session ON chat_conversations(session_id);
            CREATE INDEX IF NOT EXISTS idx_chat_created ON chat_conversations(created_at);
        ");

        try { $db->exec("ALTER TABLE chat_conversations ADD COLUMN user_address TEXT;"); } catch (Throwable $e) {}
        try { $db->exec("ALTER TABLE chat_conversations ADD COLUMN area_town TEXT;"); } catch (Throwable $e) {}

        $defaultChatSettings = [
            'ai_chat_enabled' => '1',
            'openai_model' => 'gpt-4o-mini',
            'openai_api_key' => '',
            'ai_chat_lead_notify' => '1',
            'ai_chat_name' => 'Sarah — Loft Specialist'
        ];
        $insert = $db->prepare("INSERT OR IGNORE INTO settings (key, value) VALUES (:k, :v)");
        foreach ($defaultChatSettings as $k => $v) {
            $insert->execute([':k' => $k, ':v' => $v]);
        }
    } catch (Throwable $e) {
        error_log('Failed to migrate chat table: ' . $e->getMessage());
    }
}

function migrateMultiSiteTables(PDO $db): void {
    try {
        // 1. Create sites table
        $db->exec("
            CREATE TABLE IF NOT EXISTS sites (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                site_key TEXT UNIQUE NOT NULL,
                name TEXT NOT NULL,
                short_name TEXT NOT NULL,
                color TEXT NOT NULL,
                badge_bg TEXT NOT NULL,
                domain TEXT,
                phone TEXT,
                email TEXT,
                is_active INTEGER DEFAULT 1,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        // Seed initial 3 sites if empty
        $count = (int)$db->query("SELECT COUNT(*) FROM sites")->fetchColumn();
        if ($count === 0) {
            $stmt = $db->prepare("
                INSERT INTO sites (id, site_key, name, short_name, color, badge_bg, domain, phone, email, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)
            ");
            $stmt->execute([
                1,
                'another-level',
                'Another Level Loft Conversions',
                'Another Level',
                '#2D4428',
                '#EBF2E7',
                'anotherlevelloftconversions.co.uk',
                '0800 0862744',
                'info@anotherlevelloftconversions.co.uk'
            ]);
            $stmt->execute([
                2,
                'loft-conversions-north',
                'Loft Conversions North',
                'Loft North',
                '#1D4ED8',
                '#DBEAFE',
                'loftconversionsnorth.co.uk',
                '0161 4100155',
                'info@loftconversionsnorth.co.uk'
            ]);
            $stmt->execute([
                3,
                'site-3',
                'Site 3 (Pending Name)',
                'Site 3',
                '#7C3AED',
                '#EDE9FE',
                '',
                '',
                ''
            ]);
        }

        // Add site_id to existing tables safely
        $tables = ['bookings', 'contacts', 'chat_conversations', 'events_tracking'];
        foreach ($tables as $tbl) {
            try {
                $cols = $db->query("PRAGMA table_info({$tbl})")->fetchAll(PDO::FETCH_ASSOC);
                $colNames = array_column($cols, 'name');
                if (!in_array('site_id', $colNames, true)) {
                    $db->exec("ALTER TABLE {$tbl} ADD COLUMN site_id INTEGER DEFAULT 1;");
                }
            } catch (Throwable $e) {}
        }
    } catch (Throwable $e) {
        error_log('Failed to migrate multi-site tables: ' . $e->getMessage());
    }
}

function seedEmailTemplates(PDO $db): void {
    $templates = [
        [
            'template_key' => 'booking_confirmation',
            'title' => 'Customer Survey Booking Confirmation',
            'subject' => 'Survey Confirmation — Another Level Loft Conversions [{{reference_id}}]',
            'body_html' => '
<div style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #FAF9F5; border: 1px solid #E4E4DF; border-radius: 8px; overflow: hidden;">
    <div style="background: #2D3B28; padding: 24px 30px; text-align: left;">
        <h1 style="color: #FFFFFF; font-size: 20px; margin: 0; font-weight: 600; letter-spacing: -0.02em;">Another Level Loft Conversions</h1>
        <p style="color: #C2D6BC; font-size: 13px; margin: 4px 0 0;">Survey Appointment Confirmation</p>
    </div>
    <div style="padding: 30px; background: #FFFFFF; color: #2C2C2A; line-height: 1.6; font-size: 15px;">
        <p style="margin-top: 0;">Dear <strong>{{name}}</strong>,</p>
        <p>Thank you for booking a free on-site survey with Another Level Loft Conversions. Your appointment has been reserved in our system.</p>
        
        <div style="background: #F1F7EE; border: 1px solid #DFEBD9; border-radius: 6px; padding: 18px 20px; margin: 24px 0;">
            <h3 style="margin: 0 0 12px; color: #3E5C32; font-size: 15px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Appointment Summary</h3>
            <table style="width: 100%; font-size: 14px; border-collapse: collapse;">
                <tr><td style="padding: 4px 0; color: #6B8E5A; width: 140px; font-weight: 600;">Reference ID:</td><td style="font-weight: 700; color: #1A1A1A;">{{reference_id}}</td></tr>
                <tr><td style="padding: 4px 0; color: #6B8E5A; font-weight: 600;">Date:</td><td style="font-weight: 700; color: #1A1A1A;">{{preferred_date}}</td></tr>
                <tr><td style="padding: 4px 0; color: #6B8E5A; font-weight: 600;">Time Slot:</td><td style="font-weight: 700; color: #1A1A1A;">{{preferred_slot}}</td></tr>
                <tr><td style="padding: 4px 0; color: #6B8E5A; font-weight: 600;">Property Type:</td><td>{{property_type}}</td></tr>
                <tr><td style="padding: 4px 0; color: #6B8E5A; font-weight: 600;">Postcode:</td><td>{{postcode}}</td></tr>
            </table>
        </div>

        <h3 style="color: #1A1A1A; font-size: 16px; margin: 24px 0 8px;">What happens at your survey?</h3>
        <ul style="padding-left: 20px; margin: 0 0 20px; color: #4A4A45; font-size: 14px;">
            <li>Our master surveyor takes laser measurements of ridge height and staircase alignment (approx. 45 mins).</li>
            <li>We discuss your design ideas and layout options.</li>
            <li>Within a few days, you receive a complimentary <strong>3D CAD architectural drawing</strong> and one guaranteed fixed price.</li>
            <li><strong>100% Free, £0 upfront deposit, and no sales pressure.</strong></li>
        </ul>

        <p style="font-size: 14px; color: #6B6B6B;">Need to reschedule? Simply call us toll-free on <strong>0800 0862744</strong> or reply directly to this email.</p>
        <p style="margin-bottom: 0;">Kind regards,<br><strong>The Another Level Survey Team</strong><br><span style="font-size: 12px; color: #8A8A82;">Lancashire, Greater Manchester &amp; Cheshire</span></p>
    </div>
</div>'
        ],
        [
            'template_key' => 'booking_admin_alert',
            'title' => 'Admin New Survey Lead Alert',
            'subject' => '🚨 New Survey Booking: {{name}} — {{postcode}} [{{preferred_date}} {{preferred_slot}}]',
            'body_html' => '
<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #FFFFFF; border: 1px solid #E0E0E0; border-radius: 6px; padding: 24px;">
    <h2 style="color: #2D3B28; margin-top: 0;">New Survey Lead Captured</h2>
    <p>A customer has booked a survey on the website:</p>
    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
        <tr style="background: #F7F7F7;"><td style="padding: 8px; font-weight: bold; width: 140px;">Ref ID:</td><td style="padding: 8px;">{{reference_id}}</td></tr>
        <tr><td style="padding: 8px; font-weight: bold;">Name:</td><td style="padding: 8px; font-weight: bold; color: #1A1A1A;">{{name}}</td></tr>
        <tr style="background: #F7F7F7;"><td style="padding: 8px; font-weight: bold;">Phone:</td><td style="padding: 8px;"><a href="tel:{{phone}}" style="color: #4F6B42; font-weight: bold;">{{phone}}</a></td></tr>
        <tr><td style="padding: 8px; font-weight: bold;">Email:</td><td style="padding: 8px;"><a href="mailto:{{email}}">{{email}}</a></td></tr>
        <tr style="background: #F7F7F7;"><td style="padding: 8px; font-weight: bold;">Date &amp; Slot:</td><td style="padding: 8px; font-weight: bold; color: #3E5C32;">{{preferred_date}} ({{preferred_slot}})</td></tr>
        <tr><td style="padding: 8px; font-weight: bold;">Property / Height:</td><td style="padding: 8px;">{{property_type}} · {{loft_height}}</td></tr>
        <tr style="background: #F7F7F7;"><td style="padding: 8px; font-weight: bold;">Postcode / Addr:</td><td style="padding: 8px;">{{postcode}} {{address}}</td></tr>
        <tr><td style="padding: 8px; font-weight: bold;">Source Page:</td><td style="padding: 8px;">{{source_page}}</td></tr>
        <tr style="background: #F7F7F7;"><td style="padding: 8px; font-weight: bold;">IP / Device:</td><td style="padding: 8px;">{{ip_address}} ({{device_type}})</td></tr>
    </table>
    <div style="margin-top: 20px; text-align: center;">
        <a href="{{panel_url}}" style="background: #4F6B42; color: #FFFFFF; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold;">Open in Admin Panel</a>
    </div>
</div>'
        ],
        [
            'template_key' => 'contact_confirmation',
            'title' => 'Contact Inquiry Confirmation',
            'subject' => 'We have received your message — Another Level Loft Conversions',
            'body_html' => '
<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #FFFFFF; border: 1px solid #E0E0E0; border-radius: 6px; padding: 24px;">
    <h2 style="color: #2D3B28; margin-top: 0;">Thank you for getting in touch</h2>
    <p>Dear <strong>{{name}}</strong>,</p>
    <p>We have received your message regarding: <em>"{{subject}}"</em>.</p>
    <p>A member of our surveying team will review your inquiry and get back to you shortly (usually within a few business hours).</p>
    <div style="background: #F9F9F8; padding: 14px; border-left: 3px solid #4F6B42; margin: 18px 0; font-size: 14px; color: #555;">
        {{message}}
    </div>
    <p>If your inquiry is urgent, you can reach our direct surveyor desk on <strong>0800 0862744</strong>.</p>
    <p>Kind regards,<br><strong>Another Level Loft Conversions</strong></p>
</div>'
        ]
    ];

    $stmt = $db->prepare("
        INSERT OR IGNORE INTO email_templates (template_key, title, subject, body_html)
        VALUES (:key, :title, :subject, :html)
    ");

    foreach ($templates as $t) {
        $stmt->execute([
            ':key' => $t['template_key'],
            ':title' => $t['title'],
            ':subject' => $t['subject'],
            ':html' => $t['body_html']
        ]);
    }
}

// --------------------------------------------------------------------------
// Settings & Client Metadata Helpers
// --------------------------------------------------------------------------

function getSetting(string $key, string $default = ''): string {
    $db = getDb();
    $stmt = $db->prepare("SELECT value FROM settings WHERE key = :k LIMIT 1");
    $stmt->execute([':k' => $key]);
    $val = $stmt->fetchColumn();
    return $val !== false ? (string)$val : $default;
}

function setSetting(string $key, string $value): void {
    $db = getDb();
    $stmt = $db->prepare("
        INSERT INTO settings (key, value, updated_at)
        VALUES (:k, :v, datetime('now'))
        ON CONFLICT(key) DO UPDATE SET value = :v, updated_at = datetime('now')
    ");
    $stmt->execute([':k' => $key, ':v' => $value]);
}

function getClientIP(): string {
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
    }
    return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
}

function getDeviceType(string $userAgent = ''): string {
    if (empty($userAgent)) {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    }
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $userAgent)) {
        return 'Tablet';
    }
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile|iphone|ipod)/i', $userAgent)) {
        return 'Mobile';
    }
    return 'Desktop';
}

function getBrowserName(string $userAgent = ''): string {
    if (empty($userAgent)) {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    }
    if (preg_match('/Edg/i', $userAgent)) return 'Edge';
    if (preg_match('/Chrome/i', $userAgent)) return 'Chrome';
    if (preg_match('/Safari/i', $userAgent)) return 'Safari';
    if (preg_match('/Firefox/i', $userAgent)) return 'Firefox';
    if (preg_match('/MSIE|Trident/i', $userAgent)) return 'Internet Explorer';
    return 'Browser';
}

if (!function_exists('formatPageLocation')) {
    function formatPageLocation(?string $pageUrl): string {
        if (empty($pageUrl) || $pageUrl === '/' || $pageUrl === '/index.php' || $pageUrl === 'index.php') {
            return 'Home';
        }
        $cleaned = strtolower(ltrim(trim($pageUrl), '/'));
        $base = basename($cleaned, '.php');

        // 1. Area pages: "loft-conversions-in-altrincham" -> "Altrincham"
        if (str_starts_with($base, 'loft-conversions-in-')) {
            $area = substr($base, strlen('loft-conversions-in-'));
            $words = str_replace(['-', '_'], ' ', $area);
            return ucwords($words);
        }

        // 2. Conversion types: "velux-conversion" -> "Velux", "wrap-around-conversion" -> "Wrap Around"
        if (str_ends_with($base, '-conversion')) {
            $type = substr($base, 0, -strlen('-conversion'));
            $words = str_replace(['-', '_'], ' ', $type);
            return ucwords($words);
        }

        // 3. Property types: "terrace-property" -> "Terrace", "semi-detached-property" -> "Semi-Detached"
        if (str_ends_with($base, '-property')) {
            $prop = substr($base, 0, -strlen('-property'));
            if ($prop === 'terrace') return 'Terrace';
            if ($prop === 'semi-detached') return 'Semi-Detached';
            if ($prop === 'detached') return 'Detached';
            if ($prop === 'bungalow') return 'Bungalow';
            return ucwords(str_replace(['-', '_'], ' ', $prop));
        }

        // 4. Special cases
        if (str_starts_with($base, 'start-to-finish')) {
            return 'Start to Finish';
        }

        $words = str_replace(['-', '_'], ' ', $base);
        $words = preg_replace('/\bloft conversions in\b/i', '', $words);
        $words = preg_replace('/\bloft conversion\b/i', '', $words);
        $words = trim(preg_replace('/\s+/', ' ', $words));

        return ucwords($words ?: 'General');
    }
}

function migrateEventsTrackingTable(PDO $db): void {
    try {
        $cols = [];
        $stmt = $db->query("PRAGMA table_info(events_tracking)");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cols[] = strtolower($row['name']);
        }

        if (!in_array('duration_seconds', $cols, true)) {
            $db->exec("ALTER TABLE events_tracking ADD COLUMN duration_seconds INTEGER DEFAULT 0");
        }
        if (!in_array('traffic_source', $cols, true)) {
            $db->exec("ALTER TABLE events_tracking ADD COLUMN traffic_source TEXT DEFAULT 'Direct / Bookmarks'");
        }
        if (!in_array('is_bot', $cols, true)) {
            $db->exec("ALTER TABLE events_tracking ADD COLUMN is_bot INTEGER DEFAULT 0");
            $db->exec("CREATE INDEX IF NOT EXISTS idx_events_bot ON events_tracking(is_bot)");
        }
        if (!in_array('session_id', $cols, true)) {
            $db->exec("ALTER TABLE events_tracking ADD COLUMN session_id TEXT");
            $db->exec("CREATE INDEX IF NOT EXISTS idx_events_session ON events_tracking(session_id)");
        }
    } catch (Exception $e) {
        // Table might not exist yet during initial boot
    }
}

function isBotUserAgent(string $userAgent = ''): bool {
    if (empty($userAgent)) {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    }
    if (empty($userAgent)) {
        return false;
    }
    $pattern = '/(bot|crawl|spider|slurp|googlebot|bingbot|yandex|baidu|duckduck|ahrefs|semrush|dotbot|petalbot|bytespider|facebookexternalhit|meta-externalagent|discordbot|slackbot|applebot|twitterbot|headless|phantom|selenium|puppeteer|wget|curl|python-requests|urllib|screaming frog|scanner|lighthouse|uptime|pingdom)/i';
    return (bool)preg_match($pattern, $userAgent);
}

function determineTrafficSource(?string $referrer, ?string $sourcePage = ''): string {
    $ref = strtolower(trim((string)$referrer));
    $page = strtolower(trim((string)$sourcePage));

    if (strpos($page, 'gclid=') !== false || strpos($page, 'utm_medium=cpc') !== false || strpos($page, 'utm_source=google_ads') !== false) {
        return 'Google Ads';
    }
    if (strpos($page, 'utm_source=') !== false) {
        if (preg_match('/utm_source=([a-z0-9_-]+)/i', $page, $m)) {
            return 'Campaign: ' . ucfirst($m[1]);
        }
    }

    if (empty($ref)) {
        return 'Direct / Bookmarks';
    }

    $host = parse_url($ref, PHP_URL_HOST);
    if (!$host) {
        return 'Direct / Bookmarks';
    }
    $host = strtolower($host);

    $currentHost = strtolower($_SERVER['HTTP_HOST'] ?? '');
    if (!empty($currentHost) && strpos($host, $currentHost) !== false) {
        return 'Direct / Internal';
    }
    if (strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false || strpos($host, 'anotherlevelloftconversions') !== false) {
        return 'Direct / Internal';
    }

    if (strpos($host, 'google.') !== false) return 'Google Search';
    if (strpos($host, 'bing.') !== false) return 'Bing Search';
    if (strpos($host, 'yahoo.') !== false) return 'Yahoo Search';
    if (strpos($host, 'duckduckgo.') !== false) return 'DuckDuckGo';
    if (strpos($host, 'facebook.com') !== false || strpos($host, 'fb.me') !== false) return 'Facebook';
    if (strpos($host, 'instagram.com') !== false) return 'Instagram';
    if (strpos($host, 'tiktok.com') !== false) return 'TikTok';
    if (strpos($host, 't.co') !== false || strpos($host, 'twitter.com') !== false || strpos($host, 'x.com') !== false) return 'Twitter / X';
    if (strpos($host, 'pinterest.') !== false) return 'Pinterest';
    if (strpos($host, 'nextdoor.com') !== false) return 'Nextdoor';
    if (strpos($host, 'checkatrade.com') !== false) return 'Checkatrade';
    if (strpos($host, 'bark.com') !== false) return 'Bark.com';
    if (strpos($host, 'mybuilder.com') !== false) return 'MyBuilder';

    return 'Referral: ' . preg_replace('/^www\./', '', $host);
}

function formatDurationSeconds(int $seconds): string {
    if ($seconds <= 0) return '< 10s';
    if ($seconds < 60) return "{$seconds}s";
    $mins = floor($seconds / 60);
    $secs = $seconds % 60;
    if ($mins >= 60) {
        $hours = floor($mins / 60);
        $remMins = $mins % 60;
        return "{$hours}h {$remMins}m";
    }
    return $secs > 0 ? "{$mins}m {$secs}s" : "{$mins}m";
}

function formatTrafficSourceBadge(string $source): string {
    $s = htmlspecialchars($source);
    if (str_contains($source, 'Google Ads')) {
        return '<span class="traffic-source-pill source-ads"><span class="source-dot ads"></span>Google Ads</span>';
    }
    if (str_contains($source, 'Google Search')) {
        return '<span class="traffic-source-pill source-google"><span class="source-dot google"></span>Google Search</span>';
    }
    if (str_contains($source, 'Facebook') || str_contains($source, 'Instagram') || str_contains($source, 'Social') || str_contains($source, 'TikTok') || str_contains($source, 'Twitter')) {
        return '<span class="traffic-source-pill source-social"><span class="source-dot social"></span>' . $s . '</span>';
    }
    if (str_contains($source, 'Direct')) {
        return '<span class="traffic-source-pill source-direct"><span class="source-dot direct"></span>Direct / Organic</span>';
    }
    return '<span class="traffic-source-pill source-referral"><span class="source-dot referral"></span>' . $s . '</span>';
}


