<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';

$filename = $_GET['file'] ?? '';
if (!is_string($filename) || !preg_match('/\A[a-f0-9]{32}\.(jpg|png|webp)\z/D', $filename)) {
    http_response_code(404);
    exit;
}
$path = UPLOAD_DIR . DIRECTORY_SEPARATOR . $filename;
if (!is_file($path)) {
    http_response_code(404);
    exit;
}
$types = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp'];
header('Content-Type: ' . $types[pathinfo($filename, PATHINFO_EXTENSION)]);
header('X-Content-Type-Options: nosniff');
header('Cache-Control: public, max-age=86400');
header('Content-Length: ' . (string) filesize($path));
readfile($path);
