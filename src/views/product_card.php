<article class="product-card">
    <a class="product-image" href="<?= h(url('product.php?id=' . (int) $product['id'])) ?>">
        <img src="<?= h(product_image_url($product['image'])) ?>" alt="" loading="lazy">
        <?php if ((int) $product['stock'] < 1): ?><span class="stock-badge">Sold out</span><?php endif; ?>
    </a>
    <div class="product-card-body">
        <p class="eyebrow"><?= h($product['category']) ?></p>
        <a class="product-name" href="<?= h(url('product.php?id=' . (int) $product['id'])) ?>"><?= h($product['name']) ?></a>
        <div class="product-card-bottom">
            <strong><?= h(money($product['price'])) ?></strong>
            <form class="add-cart-form" action="<?= h(url('api/cart_add.php')) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                <input type="hidden" name="quantity" value="1">
                <button class="button button-dark button-small" <?= (int) $product['stock'] < 1 ? 'disabled' : '' ?>>
                    <?= (int) $product['stock'] < 1 ? 'Out of stock' : 'Add to cart' ?>
                </button>
            </form>
        </div>
    </div>
</article>
