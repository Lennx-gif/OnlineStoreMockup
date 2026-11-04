<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';
require_once dirname(__DIR__) . '/src/catalog.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = (string) ($_POST['action'] ?? '');
    $id = input_int($_POST['product_id'] ?? null);
    if ($action === 'remove' && $id) {
        unset($_SESSION['cart'][$id]);
        flash('success', 'Item removed from your cart.');
    } elseif ($action === 'update' && isset($_POST['quantities']) && is_array($_POST['quantities'])) {
        $products = cart_products();
        $updates = [];
        $invalidQuantity = false;
        foreach ($_POST['quantities'] as $productId => $rawQuantity) {
            $productId = input_int($productId);
            $quantity = input_int($rawQuantity);
            if (!$productId || !isset($products[$productId]) || $quantity === false || $quantity < 0 || $quantity > 99) {
                $invalidQuantity = true;
                break;
            }
            if ($quantity > 0 && (
                !$products[$productId]['is_active']
                || $quantity > (int) $products[$productId]['stock']
            )) {
                $invalidQuantity = true;
                break;
            }
            $updates[$productId] = $quantity;
        }
        if ($invalidQuantity) {
            flash('error', 'One or more requested quantities are no longer available.');
        } else {
            foreach ($updates as $productId => $quantity) {
                if ($quantity === 0) {
                    unset($_SESSION['cart'][$productId]);
                } else {
                    $_SESSION['cart'][$productId] = $quantity;
                }
            }
            flash('success', 'Your cart has been updated.');
        }
    }
    redirect('cart.php');
}

$items = cart_products();
$subtotal = 0.0;
foreach ($items as $item) {
    $subtotal += (float) $item['price'] * (int) $item['quantity'];
}
$pageTitle = 'Your cart';
require dirname(__DIR__) . '/src/views/header.php';
?>
<div class="page-heading"><p class="eyebrow">Your selection</p><h1>Your cart</h1></div>
<?php if ($items): ?>
    <div class="cart-layout">
        <form action="<?= h(url('cart.php')) ?>" method="post" class="cart-items">
            <?= csrf_field() ?><input type="hidden" name="action" value="update">
            <?php foreach ($items as $id => $item): ?>
                <article class="cart-item" data-product-id="<?= $id ?>">
                    <a class="cart-thumb" href="<?= h(url('product.php?id=' . $id)) ?>">
                        <img src="<?= h(product_image_url($item['image'])) ?>" data-image-fallback="<?= h(url('assets/img/product-placeholder.svg')) ?>" alt="">
                    </a>
                    <div class="cart-item-copy">
                        <p class="eyebrow"><?= h($item['category']) ?></p>
                            <?php if ($item['is_active']): ?>
                                <a class="product-name" href="<?= h(url('product.php?id=' . $id)) ?>"><?= h($item['name']) ?></a>
                            <?php else: ?>
                                <span class="product-name"><?= h($item['name']) ?></span><span class="out-stock small-note">No longer available; remove this item.</span>
                            <?php endif; ?>
                            <span class="muted"><?= h(money($item['price'])) ?> each</span>
                    </div>
                    <label class="quantity-label" for="quantity-<?= $id ?>">Qty</label>
                    <input id="quantity-<?= $id ?>" class="quantity-input" type="number"
                               name="quantities[<?= $id ?>]" min="0" max="<?= min(99, (int) $item['stock']) ?>"
                               value="<?= (int) $item['quantity'] ?>" <?= !$item['is_active'] ? 'disabled' : '' ?>>
                        <strong class="line-total"><?= h(money((float) $item['price'] * (int) $item['quantity'])) ?></strong>
                    <button class="remove-button" type="submit" form="remove-<?= $id ?>" aria-label="Remove <?= h($item['name']) ?>">Remove</button>
                </article>
            <?php endforeach; ?>
            <div class="cart-form-actions"><button class="button button-outline">Update cart</button></div>
        </form>
        <?php foreach ($items as $id => $item): ?>
            <form id="remove-<?= $id ?>" action="<?= h(url('cart.php')) ?>" method="post" class="visually-hidden">
                <?= csrf_field() ?><input type="hidden" name="action" value="remove">
                <input type="hidden" name="product_id" value="<?= $id ?>">
            </form>
        <?php endforeach; ?>
        <aside class="summary-card">
            <h2>Order summary</h2>
            <div class="summary-row"><span>Subtotal</span><strong data-cart-subtotal><?= h(money($subtotal)) ?></strong></div>
            <div class="summary-row"><span>Delivery</span><span>Calculated at checkout</span></div>
            <div class="summary-total"><span>Total</span><strong><?= h(money($subtotal)) ?></strong></div>
            <a class="button button-primary button-wide" href="<?= h(url('checkout.php')) ?>">Continue to checkout</a>
            <a class="continue-link" href="<?= h(url()) ?>">Continue shopping</a>
        </aside>
    </div>
<?php else: ?>
    <section class="empty-state"><div class="empty-bag" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 4h2l2.2 11.1a2 2 0 0 0 2 1.6h8.4a2 2 0 0 0 1.9-1.4L21 8H6"></path><circle cx="10" cy="20" r="1"></circle><circle cx="18" cy="20" r="1"></circle></svg></div><h2>Your cart is empty</h2>
        <p>Find something useful for work, study, or everyday life.</p><a class="button button-primary" href="<?= h(url()) ?>">Explore products</a></section>
<?php endif; ?>
<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
