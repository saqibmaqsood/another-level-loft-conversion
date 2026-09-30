<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$file = __DIR__ . $uri;

// If a non-directory static asset or explicit file exists directly
if ($uri !== '/' && !is_dir($file) && file_exists($file)) {
    return false;
}

// Panel directory trailing slash normalizer
if ($uri === '/panel' || $uri === '/Panel') {
    $qs = !empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '';
    header('Location: ' . $uri . '/' . $qs);
    return true;
}

// Panel routes (/panel/, /Panel/, /panel/bookings, etc.)
if (preg_match('#^/[pP]anel/(.*)$#', $uri, $matches)) {
    $sub = trim($matches[1], '/');
    if (empty($sub) || $sub === 'index') {
        include __DIR__ . '/panel/index.php';
        return true;
    }
    if (file_exists(__DIR__ . '/panel/' . $sub)) {
        return false;
    }
    if (file_exists(__DIR__ . '/panel/' . $sub . '.php')) {
        include __DIR__ . '/panel/' . $sub . '.php';
        return true;
    }
}

// If clean URL matches a .php file (e.g. /about -> about.php)
if ($uri !== '/' && file_exists($file . '.php')) {
    include $file . '.php';
    return true;
}

// If directory request has index.php
if (is_dir($file) && file_exists($file . '/index.php')) {
    include $file . '/index.php';
    return true;
}

// Default root
if ($uri === '/' || $uri === '') {
    include __DIR__ . '/index.php';
    return true;
}

return false;
