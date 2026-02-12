<?php
require __DIR__ . '/../app/bootstrap.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
if ($basePath !== '' && str_starts_with($path, $basePath)) {
    $path = substr($path, strlen($basePath));
    if ($path === '') {
        $path = '/';
    }
}

$path = rtrim($path, '/');
if ($path === '') $path = '/';



$isAdmin = ($path === '/admin' || str_starts_with($path, '/admin/'));

$routesWeb = require APP_PATH . '/routes.web.php';
$routesAdmin = require APP_PATH . '/routes.admin.php';

// Pilih view file
if ($isAdmin) {
    $viewFile = $routesAdmin[$path] ?? VIEW_PATH . '/admin/404.php';
} else {
    $viewFile = $routesWeb[$path] ?? VIEW_PATH . '/pages/404.php';
}


// Render Konten Halaman
ob_start();
require $viewFile; // Halaman bisa pakai $conn dari bootstrap
$content = ob_get_clean();

// Render layout 
require $isAdmin
    ? VIEW_PATH . '/layouts/admin.php' 
    : VIEW_PATH . '/layouts/main.php';
?>