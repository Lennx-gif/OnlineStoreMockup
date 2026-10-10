<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';
require_once dirname(__DIR__, 2) . '/src/catalog.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}
verify_csrf();
$id = input_int($_POST['product_id'] ?? null);
$quantity = input_int($_POST['quantity'] ?? 1);
$product = $id && $quantity ? find_product((int) $id) : null;
$message = '';
$status = 200;

if (!$product || (int) $product['stock'] < 1) {
    $message = 'This product is not available.';
    $status = 422;
} elseif ($quantity < 1 || $quantity > 99) {
    $message = 'Choose a quantity between 1 and 99.';
    $status = 422;
} else {
    $currentQuantity = (int) ($_SESSION['cart'][$product['id']] ?? 0);
    if ($currentQuantity + $quantity > (int) $product['stock']) {
        $message = 'There is not enough stock for that quantity.';
        $status = 422;
    } else {
        $_SESSION['cart'][$product['id']] = $currentQuantity + $quantity;
        $message = $product['name'] . ' added to your cart.';
    }
}

$wantsJson = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json')
    || ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest';
if ($wantsJson) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status);
    echo json_encode(['message' => $message, 'count' => cart_count()], JSON_THROW_ON_ERROR);
    exit;
}
flash($status === 200 ? 'success' : 'error', $message);
redirect($status === 200 ? 'cart.php' : '');
