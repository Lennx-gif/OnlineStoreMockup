<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';

$filename = $_GET['file'] ?? '';
if (!is_string($filename) || !preg_match('/\A[a-f0-9]{32}\.(jpg|png|webp|svg)\z/D', $filename)) {
    http_response_code(404);
    exit;
}

$path = UPLOAD_DIR . DIRECTORY_SEPARATOR . $filename;
if (!is_file($path)) {
    http_response_code(404);
    exit;
}

$mtime = filemtime($path) ?: time();
$size = filesize($path);
$etag = sprintf('"%x-%x"', $mtime, $size);

$ifNoneMatch = $_SERVER['HTTP_IF_NONE_MATCH'] ?? '';
$ifModifiedSince = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) : false;

if (($ifNoneMatch && trim($ifNoneMatch) === $etag) || ($ifModifiedSince && $ifModifiedSince >= $mtime)) {
    http_response_code(304);
    exit;
}

$types = [
    'jpg' => 'image/jpeg',
    'png' => 'image/png',
    'webp' => 'image/webp',
    'svg' => 'image/svg+xml',
];
$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

header('Content-Type: ' . ($types[$ext] ?? 'application/octet-stream'));
header('X-Content-Type-Options: nosniff');
header('ETag: ' . $etag);
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mtime) . ' GMT');
header('Cache-Control: public, max-age=2592000, immutable');
header('Content-Length: ' . (string) $size);
readfile($path);
