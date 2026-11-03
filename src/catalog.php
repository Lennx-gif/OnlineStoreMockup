<?php
declare(strict_types=1);

function find_product(int $id, bool $includeInactive = false): ?array
{
    $sql = 'SELECT * FROM products WHERE id = ?';
    if (!$includeInactive) {
        $sql .= ' AND is_active = 1';
    }

    $statement = db()->prepare($sql);
    $statement->execute([$id]);
    $product = $statement->fetch();
    return $product ?: null;
}

function cart_products(): array
{
    $cart = $_SESSION['cart'] ?? [];
    $ids = array_values(array_filter(array_map('intval', array_keys($cart))));
    if ($ids === []) {
        return [];
    }

    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $statement = db()->prepare(
        "SELECT id, name, price, stock, image, category, is_active FROM products "
        . "WHERE id IN ($placeholders)"
    );
    $statement->execute($ids);
    $products = [];
    foreach ($statement->fetchAll() as $product) {
        $product['quantity'] = (int) ($cart[$product['id']] ?? 0);
        $products[(int) $product['id']] = $product;
    }

    return $products;
}

function product_image_url(?string $filename): string
{
    if ($filename === null || !preg_match('/\A[a-f0-9]{32}\.(jpg|png|webp|svg)\z/D', $filename)) {
        return url('assets/img/product-placeholder.svg');
    }

    $imagePath = UPLOAD_DIR . DIRECTORY_SEPARATOR . $filename;
    if (!is_file($imagePath)) {
        return url('assets/img/product-placeholder.svg');
    }

    $imageVersion = filemtime($imagePath) ?: 0;
    return url('image.php?file=' . rawurlencode($filename) . '&v=' . $imageVersion);
}
