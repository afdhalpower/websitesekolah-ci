<?php
/**
 * Local dev router for CodeIgniter 4 project (non-standard layout).
 * The repo is served by Apache with docroot ABOVE public/, so uploaded
 * assets live at project-root /assets/ and the front controller at /public/.
 *
 * This router mimics that layout for `php -S`:
 *   - existing real files under /           → serve (covers /assets/... uploads)
 *   - existing real files under /public/    → serve (framework public assets .htaccess ignored)
 *   - everything else                       → route through public/index.php
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$root = __DIR__;

// Strip leading slash for safe joining.
$rel = ltrim($uri, '/');

// 1) Real file at project root (e.g. /assets/upload/image/logo.png)
if ($rel !== '' && is_file($root . '/' . $rel)) {
    return false; // let php -S serve the static file
}

// 2) Real file inside /public (e.g. /favicon.ico)
if ($rel !== '' && is_file($root . '/public/' . $rel)) {
    return false; // docroot-relative; php -S resolves against router's cwd
}

// 3) Static directories that exist as folders (index.html) - direct serve
$possible = [
    $root . '/' . $rel,
    $root . '/public/' . $rel,
];
foreach ($possible as $p) {
    if (is_dir($p) && is_file($p . '/index.html')) {
        return false;
    }
}

// 4) Default: let CodeIgniter handle routing via its front controller.
require $root . '/public/index.php';