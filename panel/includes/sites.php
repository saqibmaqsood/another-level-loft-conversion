<?php
/**
 * Another Level Loft Conversions - Multi-Site Management Engine
 */

declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

/**
 * Fetch all sites from database
 */
function getAllSites(bool $includeInactive = false): array {
    static $sitesCache = null;
    if ($sitesCache !== null && !$includeInactive) {
        return $sitesCache;
    }

    $db = getDb();
    $sql = "SELECT * FROM sites" . ($includeInactive ? "" : " WHERE is_active = 1") . " ORDER BY id ASC";
    $sites = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    if (!$includeInactive) {
        $sitesCache = $sites;
    }
    return $sites;
}

/**
 * Get a specific site by ID
 */
function getSiteById(int $id): ?array {
    $sites = getAllSites(true);
    foreach ($sites as $s) {
        if ((int)$s['id'] === $id) {
            return $s;
        }
    }
    return null;
}

/**
 * Get a specific site by key
 */
function getSiteByKey(string $key): ?array {
    $sites = getAllSites(true);
    foreach ($sites as $s) {
        if ($s['site_key'] === $key) {
            return $s;
        }
    }
    return null;
}

/**
 * Get active site ID ('all' or integer ID 1, 2, 3...)
 */
function getActiveSiteId(): string|int {
    initSession();

    // Check if query parameter requests a switch via switch_site or site
    $switchParam = $_GET['switch_site'] ?? $_GET['site'] ?? null;
    if ($switchParam !== null) {
        $req = trim((string)$switchParam);
        setActiveSite($req);
        return $_SESSION['active_site_id'] ?? 'all';
    }

    if (isset($_SESSION['active_site_id'])) {
        return $_SESSION['active_site_id'] === 'all' ? 'all' : (int)$_SESSION['active_site_id'];
    }

    // Default to 'all' for an overall combined overview
    $_SESSION['active_site_id'] = 'all';
    return 'all';
}

/**
 * Set active site context
 */
function setActiveSite(string|int $siteId): void {
    initSession();
    $raw = is_string($siteId) ? trim($siteId) : $siteId;
    if ($raw === 'all') {
        $_SESSION['active_site_id'] = 'all';
        @setcookie('al_active_site', 'all', time() + (86400 * 30), '/');
        return;
    }

    // 1. Try lookup by numeric ID
    $site = is_numeric($raw) ? getSiteById((int)$raw) : null;

    // 2. Try lookup by site_key (e.g. 'loft-conversions-north', 'another-level')
    if (!$site && is_string($raw)) {
        $site = getSiteByKey($raw);
    }

    if ($site) {
        $_SESSION['active_site_id'] = (int)$site['id'];
        @setcookie('al_active_site', (string)$site['id'], time() + (86400 * 30), '/');
    } else {
        $_SESSION['active_site_id'] = 'all';
        @setcookie('al_active_site', 'all', time() + (86400 * 30), '/');
    }
}

/**
 * Get active site details ('all' or site array)
 */
function getActiveSite(): array|string {
    $id = getActiveSiteId();
    if ($id === 'all') {
        return 'all';
    }
    return getSiteById((int)$id) ?: 'all';
}

/**
 * Check if the active context is "All Sites Overview"
 */
function isAllSitesMode(): bool {
    return getActiveSiteId() === 'all';
}

/**
 * Render a beautiful, accessible colored badge for a site
 */
function renderSiteBadge(int|string $siteId, bool $isSmall = false): string {
    $site = getSiteById((int)$siteId);
    if (!$site) {
        return '<span class="site-tag" style="background:#F1F5F9;color:#64748B;font-size:10px;padding:2px 6px;border-radius:4px;font-weight:700">AL</span>';
    }

    $color = htmlspecialchars($site['color']);
    $bg = htmlspecialchars($site['badge_bg']);

    if ($isSmall) {
        $short = match((int)$site['id']) {
            1 => 'AL',
            2 => 'North',
            default => 'Site ' . $site['id']
        };
        $fontSize = '10px';
        $padding = '2px 6px';
        $dotSize = '5px';
    } else {
        $short = htmlspecialchars($site['short_name']);
        $fontSize = '11px';
        $padding = '3px 8px';
        $dotSize = '6px';
    }

    return sprintf(
        '<span class="site-tag site-tag-%s" style="background:%s;color:%s;border:1px solid %s33;font-size:%s;padding:%s;border-radius:6px;font-weight:700;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;flex-shrink:0;"><span style="width:%s;height:%s;border-radius:50%%;background:%s;display:inline-block;flex-shrink:0"></span>%s</span>',
        htmlspecialchars($site['site_key']),
        $bg,
        $color,
        $color,
        $fontSize,
        $padding,
        $dotSize,
        $dotSize,
        $color,
        $short
    );
}

/**
 * Generate SQL filter and parameter bindings for queries
 */
function buildSiteFilterSql(string $column = 'site_id', string $operator = 'WHERE'): array {
    $id = getActiveSiteId();
    if ($id === 'all') {
        return [
            'clause' => '',
            'params' => []
        ];
    }

    $prefix = $operator === 'AND' ? ' AND ' : ' WHERE ';
    return [
        'clause' => "{$prefix} ({$column} = ? OR {$column} IS NULL)",
        'params' => [(int)$id]
    ];
}


/**
 * Generate accurate link URL for a page on a specific site (local dev or production)
 */
function getSitePageUrl(int|string|null $siteId, ?string $rawPageUrl): string {
    $siteId = (int)($siteId ?: 1);
    $path = trim((string)$rawPageUrl);
    if ($path === "" || $path === "/" || $path === "home") {
        $path = "index.php";
    }
    $cleanPath = ltrim($path, "/");
    if (!str_ends_with($cleanPath, ".php") && !str_contains($cleanPath, ".")) {
        $cleanPath .= ".php";
    }

    $httpHost = $_SERVER["HTTP_HOST"] ?? "localhost:8000";
    $hostOnly = explode(":", $httpHost)[0];
    
    // Check if running in local development
    $isLocal = in_array($hostOnly, ["localhost", "127.0.0.1", "::1"], true) 
               || str_ends_with($hostOnly, ".test") 
               || str_ends_with($hostOnly, ".local")
               || filter_var($hostOnly, FILTER_VALIDATE_IP) !== false;

    if ($isLocal) {
        $scheme = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") ? "https" : "http";
        
        // Local multi-server port mapping:
        // Site 1: Another Level Loft Conversion -> port 8000
        // Site 2: Loft Conversions North -> port 8001
        // Site 3: -> port 8002
        if ($siteId === 2) {
            return "{$scheme}://{$hostOnly}:8001/{$cleanPath}";
        } elseif ($siteId === 1) {
            return "{$scheme}://{$hostOnly}:8000/{$cleanPath}";
        } else {
            $port = 8000 + ($siteId - 1);
            return "{$scheme}://{$hostOnly}:{$port}/{$cleanPath}";
        }
    }

    // Production environment:
    $site = getSiteById($siteId);
    $domain = !empty($site["domain"]) ? $site["domain"] : "anotherlevelloftconversions.co.uk";
    return "https://{$domain}/{$cleanPath}";
}
