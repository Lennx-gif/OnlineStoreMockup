<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}
require_once dirname(__DIR__) . '/src/config.php';
require_once dirname(__DIR__) . '/src/database.php';

$read = static function (string $prompt): string {
    if (function_exists('readline')) {
        $value = readline($prompt);
    } else {
        echo $prompt;
        $value = fgets(STDIN);
    }
    return trim((string) $value);
};

$name = $read('Admin name: ');
$email = strtolower($read('Admin email: '));
$password = $read('Admin password (10+ characters): ');
if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 10) {
    fwrite(STDERR, "Provide a name, valid email, and password of at least 10 characters.\n");
    exit(1);
}
$statement = db()->prepare(
    "INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, 'admin')"
);
$statement->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
echo "Administrator account created.\n";
