<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';
require_once dirname(__DIR__) . '/src/catalog.php';
require_login();

$items = cart_products();
if (!$items) {
    flash('error', 'Your cart is empty.');
    redirect('cart.php');
}

$errors = [];
$shippingName = current_user()['name'];
$phone = '';
$address = '';
$city = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $shippingName = post_string('shipping_name', 100);
    $phone = post_string('shipping_phone', 30);
    $address = post_string('shipping_address', 255);
    $city = post_string('shipping_city', 100);
    if ($shippingName === '' || $phone === '' || $address === '' || $city === '') {
        $errors[] = 'Complete all delivery details.';
    }

    if (!$errors) {
        $connection = db();
        $connection->beginTransaction();
        $lockedProducts = [];
        foreach (array_keys($_SESSION['cart']) as $id) {
            $statement = $connection->prepare(
                'SELECT id, name, price, stock FROM products WHERE id = ? AND is_active = 1 FOR UPDATE'
            );
            $statement->execute([(int) $id]);
            $product = $statement->fetch();
            $quantity = (int) ($_SESSION['cart'][$id] ?? 0);
            if (!$product || $quantity < 1 || $quantity > (int) ($product['stock'] ?? 0)) {
                $connection->rollBack();
                flash('error', 'A cart item is no longer available in the requested quantity. Please review your cart.');
                redirect('cart.php');
            }
            $product['quantity'] = $quantity;
            $lockedProducts[] = $product;
        }
        $total = 0.0;
        foreach ($lockedProducts as $product) {
            $total += (float) $product['price'] * $product['quantity'];
        }
        $statement = $connection->prepare(
            'INSERT INTO orders (user_id, total, shipping_name, shipping_phone, shipping_address, shipping_city) '
            . 'VALUES (?, ?, ?, ?, ?, ?)'
        );
        $statement->execute([
            current_user()['id'],
            number_format($total, 2, '.', ''),
            $shippingName,
            $phone,
            $address,
            $city,
        ]);
        $orderId = (int) $connection->lastInsertId();
        $insertItem = $connection->prepare(
            'INSERT INTO order_items (order_id, product_id, product_name, unit_price, quantity) VALUES (?, ?, ?, ?, ?)'
        );
        $reduceStock = $connection->prepare('UPDATE products SET stock = stock - ? WHERE id = ?');
        foreach ($lockedProducts as $product) {
            $insertItem->execute([
                $orderId,
                $product['id'],
                $product['name'],
                $product['price'],
                $product['quantity'],
            ]);
            $reduceStock->execute([$product['quantity'], $product['id']]);
        }
        $connection->commit();
        $_SESSION['cart'] = [];
        flash('success', 'Your order has been placed.');
        redirect('account/orders.php');
    }
}

$subtotal = 0.0;
foreach ($items as $item) {
    $subtotal += (float) $item['price'] * (int) $item['quantity'];
}
$pageTitle = 'Checkout';
require dirname(__DIR__) . '/src/views/header.php';
?>
<div class="page-heading"><p class="eyebrow">Almost there</p><h1>Checkout</h1></div>
<div class="checkout-layout">
    <section class="form-card">
        <h2>Delivery details</h2>
        <p class="muted">This learning version records orders locally; no payment is collected.</p>
        <?php if ($errors): ?><ul class="form-errors"><?php foreach ($errors as $error): ?><li><?= h($error) ?></li><?php endforeach; ?></ul><?php endif; ?>
        <form method="post" action="<?= h(url('checkout.php')) ?>" class="stacked-form">
            <?= csrf_field() ?>
            <label for="shipping_name">Recipient name</label><input id="shipping_name" name="shipping_name" maxlength="100" value="<?= h($shippingName) ?>" required>
            <label for="shipping_phone">Phone</label><input id="shipping_phone" name="shipping_phone" type="tel" maxlength="30" value="<?= h($phone) ?>" autocomplete="tel" required>
            <label for="shipping_address">Street address</label><input id="shipping_address" name="shipping_address" maxlength="255" value="<?= h($address) ?>" autocomplete="street-address" required>
            <label for="shipping_city">Town or city</label><input id="shipping_city" name="shipping_city" maxlength="100" value="<?= h($city) ?>" autocomplete="address-level2" required>
            <button class="button button-primary button-wide">Place learning order</button>
        </form>
    </section>
    <aside class="summary-card checkout-summary"><h2>Order summary</h2>
        <?php foreach ($items as $item): ?>
            <div class="summary-product"><span><?= h($item['name']) ?> <small>× <?= (int) $item['quantity'] ?></small></span>
                <strong><?= h(money((float) $item['price'] * (int) $item['quantity'])) ?></strong></div>
        <?php endforeach; ?>
        <div class="summary-total"><span>Total</span><strong><?= h(money($subtotal)) ?></strong></div>
    </aside>
</div>
<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
