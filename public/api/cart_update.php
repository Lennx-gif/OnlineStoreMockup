<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';
require_once dirname(__DIR__, 2) . '/src/catalog.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}
verify_csrf();
$submitted = $_POST['quantities'] ?? null;
if (!is_array($submitted)) {
    json_response(['message' => 'Cart quantities are missing.'], 422);
}

$products = cart_products();
$updates = [];
foreach ($submitted as $rawId => $rawQuantity) {
    $id = input_int($rawId);
    $quantity = input_int($rawQuantity);
    if (!$id || !isset($products[$id]) || $quantity === false || $quantity < 0 || $quantity > 99) {
        json_response(['message' => 'One or more quantities are invalid.'], 422);
    }
    if ($quantity > 0 && (!$products[$id]['is_active'] || $quantity > (int) $products[$id]['stock'])) {
        json_response(['message' => 'A requested quantity is no longer available. Review the stock and try again.'], 422);
    }
    $updates[$id] = $quantity;
}

foreach ($updates as $id => $quantity) {
    if ($quantity === 0) {
        unset($_SESSION['cart'][$id]);
    } else {
        $_SESSION['cart'][$id] = $quantity;
    }
}

$subtotal = 0.0;
$items = [];
foreach (cart_products() as $id => $product) {
    $quantity = (int) $product['quantity'];
    $lineTotal = (float) $product['price'] * $quantity;
    $subtotal += $lineTotal;
    $items[$id] = ['quantity' => $quantity, 'line_total' => $lineTotal];
}
json_response([
    'message' => 'Your cart has been updated.',
    'count' => cart_count(),
    'subtotal' => $subtotal,
    'items' => $items,
]);
