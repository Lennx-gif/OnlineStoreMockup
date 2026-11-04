<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';
require_once dirname(__DIR__) . '/src/catalog.php';

$id = input_int($_GET['id'] ?? null);
$product = $id ? find_product((int) $id) : null;
if (!$product) {
    http_response_code(404);
    $pageTitle = 'Product not found';
    require dirname(__DIR__) . '/src/views/header.php';
    echo '<section class="empty-state"><h1>Product not found</h1><a href="' . h(url()) . '">Back to shop</a></section>';
    require dirname(__DIR__) . '/src/views/footer.php';
    exit;
}
$pageTitle = $product['name'];
require dirname(__DIR__) . '/src/views/header.php';
?>
<nav class="breadcrumbs" aria-label="Breadcrumb">
    <a href="<?= h(url()) ?>">Shop</a><span>/</span>
    <a href="<?= h(url('?' . http_build_query(['category' => $product['category']]))) ?>"><?= h($product['category']) ?></a>
    <span>/</span><span><?= h($product['name']) ?></span>
</nav>
<section class="product-detail">
    <div class="detail-image"><img src="<?= h(product_image_url($product['image'])) ?>" data-image-fallback="<?= h(url('assets/img/product-placeholder.svg')) ?>" alt="<?= h($product['name']) ?>" width="800" height="600" decoding="async"></div>
    <div class="detail-copy">
        <p class="eyebrow"><?= h($product['category']) ?></p>
        <h1><?= h($product['name']) ?></h1>
        <p class="detail-price"><?= h(money($product['price'])) ?></p>
        <p class="detail-description"><?= nl2br(h($product['description'])) ?></p>
        <p class="stock-line <?= (int) $product['stock'] > 0 ? 'in-stock' : 'out-stock' ?>">
            <?= (int) $product['stock'] > 0 ? 'In stock · ' . (int) $product['stock'] . ' available' : 'Currently out of stock' ?>
        </p>
        <form class="detail-add add-cart-form" action="<?= h(url('api/cart_add.php')) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
            <label for="quantity">Quantity</label>
            <input id="quantity" name="quantity" type="number" min="1" max="<?= max(1, (int) $product['stock']) ?>" value="1" required>
            <button class="button button-primary" <?= (int) $product['stock'] < 1 ? 'disabled' : '' ?>>Add to cart</button>
        </form>
        <p class="small-note">✓ Fast Nationwide Delivery · ✓ 30-Day Return Guarantee · ✓ 100% Genuine Quality</p>
    </div>
</section>
<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
