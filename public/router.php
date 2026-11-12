<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';

// Redirect /swagger ke /swagger/ agar relative path aset tetap benar
if ($path === '/swagger') {
    header('Location: /swagger/');
    exit;
}

// Layani file statis di dalam public/ (termasuk index.html di dalam subdirektori seperti /swagger/)
$file = __DIR__ . $path;

if ($path !== '/') {
    if (is_file($file)) {
        return false;
    }
    if (is_dir($file) && is_file(rtrim($file, '/') . '/index.html')) {
        header('Content-Type: text/html; charset=utf-8');
        readfile(rtrim($file, '/') . '/index.html');
        exit;
    }
}

require __DIR__ . '/index.php';

