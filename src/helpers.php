<?php
declare(strict_types=1);

function h(string|int|float|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function url(string $path = ''): string
{
    return '/' . ltrim($path, '/');
}

function redirect(string $path): never
{
    header('Location: ' . url($path), true, 303);
    exit;
}

function csrf_token(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . h(csrf_token()) . '">';
}

function verify_csrf(): void
{
    $submitted = $_POST['csrf_token'] ?? '';
    if (!is_string($submitted) || !hash_equals(csrf_token(), $submitted)) {
        $wantsJson = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json')
            || ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest';
        if ($wantsJson) {
            json_response(['message' => 'The form expired. Refresh the page and try again.'], 403);
        }
        http_response_code(403);
        exit('The form expired or was invalid. Please go back and try again.');
    }
}

function json_response(array $payload, int $status = 200): never
{
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status);
    echo json_encode($payload, JSON_THROW_ON_ERROR);
    exit;
}

function flash(string $key, ?string $message = null): ?string
{
    if ($message !== null) {
        $_SESSION['flash'][$key] = $message;
        return null;
    }

    $value = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return is_string($value) ? $value : null;
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function require_login(): void
{
    if (current_user() === null) {
        flash('error', 'Please sign in to continue.');
        redirect('account/login.php');
    }
}

function require_admin(): void
{
    require_login();
    if (current_user()['role'] !== 'admin') {
        http_response_code(403);
        exit('You do not have permission to view this page.');
    }
}

function cart_count(): int
{
    return array_sum(array_map('intval', $_SESSION['cart'] ?? []));
}

function money(string|int|float $amount): string
{
    return 'KSh ' . number_format((float) $amount, 0);
}

function input_int(mixed $value): int|false
{
    if (!is_string($value) && !is_int($value)) {
        return false;
    }

    $validated = filter_var($value, FILTER_VALIDATE_INT);
    return $validated === false ? false : $validated;
}

function post_string(string $key, int $maxLength = 2000): string
{
    $value = $_POST[$key] ?? '';
    if (!is_string($value)) {
        return '';
    }

    return trim(mb_substr($value, 0, $maxLength));
}

function render_error_page(Throwable $error): void
{
    error_log((string) $error);
    http_response_code(500);
    $detail = APP_DEBUG ? '<pre>' . h($error->getMessage()) . '</pre>' : '';
    echo '<!doctype html><html lang="en"><meta charset="utf-8"><title>Store error</title>'
        . '<body><h1>Something went wrong</h1><p>Please try again shortly.</p>'
        . $detail . '</body></html>';
}
