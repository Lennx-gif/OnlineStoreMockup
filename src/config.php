<?php
declare(strict_types=1);

function load_local_environment(): void
{
    $path = dirname(__DIR__) . '/.env';
    if (!is_file($path)) {
        return;
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim(trim($value), "\"'");
        if (preg_match('/\A[A-Z_][A-Z0-9_]*\z/', $key) && getenv($key) === false) {
            putenv($key . '=' . $value);
        }
    }
}

load_local_environment();

define('APP_DEBUG', filter_var(getenv('APP_DEBUG') ?: '0', FILTER_VALIDATE_BOOL));
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'online_store');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('UPLOAD_DIR', dirname(__DIR__) . '/storage/uploads');
