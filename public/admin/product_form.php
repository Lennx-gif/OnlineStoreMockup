<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';
require_once dirname(__DIR__, 2) . '/src/catalog.php';
require_admin();

$requestedId = input_int($_GET['id'] ?? null);
$id = $requestedId === false ? null : $requestedId;
$product = $id ? find_product($id, true) : null;
if ($id && !$product) {
    http_response_code(404);
    exit('Product not found.');
}
$values = $product ?? [
    'name' => '', 'description' => '', 'price' => '', 'stock' => 0,
    'category' => '', 'image' => null, 'is_active' => 1,
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = post_string('name', 160);
    $description = post_string('description', 5000);
    $rawPrice = $_POST['price'] ?? null;
    $price = (is_string($rawPrice) || is_int($rawPrice) || is_float($rawPrice))
        ? filter_var($rawPrice, FILTER_VALIDATE_FLOAT)
        : false;
    $stock = input_int($_POST['stock'] ?? null);
    $category = post_string('category', 80);
    $isActive = isset($_POST['is_active']) ? 1 : 0;
    $values = [
        'name' => $name,
        'description' => $description,
        'price' => $price === false ? '' : $price,
        'stock' => $stock === false ? '' : $stock,
        'category' => $category,
        'image' => $product['image'] ?? null,
        'is_active' => $isActive,
    ];
    if ($name === '') { $errors[] = 'Enter a product name.'; }
    if ($description === '') { $errors[] = 'Enter a product description.'; }
    if ($price === false || $price <= 0 || $price > 99999999) { $errors[] = 'Enter a valid price greater than zero.'; }
    if ($stock === false || $stock < 0 || $stock > 1000000) { $errors[] = 'Enter a valid stock quantity.'; }
    if ($category === '') { $errors[] = 'Enter a category.'; }

    $uploadedName = null;
    $upload = $_FILES['image'] ?? null;
    if (is_array($upload) && isset($upload['error']) && $upload['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($upload['error'] !== UPLOAD_ERR_OK || !isset($upload['size'], $upload['tmp_name']) || $upload['size'] > 3 * 1024 * 1024) {
            $errors[] = 'Choose an image smaller than 3 MB.';
        } elseif (is_uploaded_file($upload['tmp_name'])) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($upload['tmp_name']);
            $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
            $imageInfo = getimagesize($upload['tmp_name']);
            if (!isset($extensions[$mime]) || !$imageInfo || $imageInfo['mime'] !== $mime) {
                $errors[] = 'Use a valid JPEG, PNG, or WebP image.';
            } else {
                $uploadedName = bin2hex(random_bytes(16)) . '.' . $extensions[$mime];
            }
        } else {
            $errors[] = 'The image upload could not be verified.';
        }
    }

    if (!$errors) {
        if ($uploadedName !== null) {
            if (!is_dir(UPLOAD_DIR) && !mkdir(UPLOAD_DIR, 0750, true) && !is_dir(UPLOAD_DIR)) {
                throw new RuntimeException('Unable to create the private image directory.');
            }
            if (!move_uploaded_file($upload['tmp_name'], UPLOAD_DIR . '/' . $uploadedName)) {
                throw new RuntimeException('Unable to save the uploaded image.');
            }
        }
        $image = $uploadedName ?? ($product['image'] ?? null);
        if ($id) {
            $statement = db()->prepare(
                'UPDATE products SET name = ?, description = ?, price = ?, stock = ?, category = ?, image = ?, is_active = ? WHERE id = ?'
            );
            $statement->execute([$name, $description, $price, $stock, $category, $image, $isActive, $id]);
        } else {
            $statement = db()->prepare(
                'INSERT INTO products (name, description, price, stock, category, image, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)'
            );
            $statement->execute([$name, $description, $price, $stock, $category, $image, $isActive]);
        }
        flash('success', $id ? 'Product updated.' : 'Product added.');
        redirect('admin/products.php');
    }
}
$pageTitle = $id ? 'Edit product' : 'Add product';
require dirname(__DIR__, 2) . '/src/views/header.php';
?>
<div class="page-heading"><p class="eyebrow">Store management</p><h1><?= $id ? 'Edit product' : 'Add a product' ?></h1></div>
<section class="form-card admin-form-card">
    <?php if ($errors): ?><ul class="form-errors"><?php foreach ($errors as $error): ?><li><?= h($error) ?></li><?php endforeach; ?></ul><?php endif; ?>
    <form method="post" enctype="multipart/form-data" class="stacked-form">
        <?= csrf_field() ?>
        <label for="name">Product name</label><input id="name" name="name" maxlength="160" value="<?= h($values['name']) ?>" required>
        <label for="description">Description</label><textarea id="description" name="description" rows="5" maxlength="5000" required><?= h($values['description']) ?></textarea>
        <div class="form-row">
            <div><label for="price">Price (KSh)</label><input id="price" name="price" type="number" min="0.01" step="0.01" value="<?= h($values['price']) ?>" required></div>
            <div><label for="stock">Stock</label><input id="stock" name="stock" type="number" min="0" step="1" value="<?= h($values['stock']) ?>" required></div>
        </div>
        <label for="category">Category</label><input id="category" name="category" maxlength="80" value="<?= h($values['category']) ?>" required>
        <label for="image">Product image <span class="muted">(JPEG, PNG or WebP; max 3 MB)</span></label>
        <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp" data-image-upload>
        <small class="field-hint" data-upload-status role="status">Choose a JPEG, PNG, or WebP image up to 3 MB.</small>
        <?php if ($values['image']): ?><img class="admin-image-preview" data-image-fallback="<?= h(url('assets/img/product-placeholder.svg')) ?>" src="<?= h(product_image_url($values['image'])) ?>" alt="Current product image" data-upload-preview><?php else: ?><img class="admin-image-preview" data-image-fallback="<?= h(url('assets/img/product-placeholder.svg')) ?>" src="<?= h(url('assets/img/product-placeholder.svg')) ?>" alt="Selected product image preview" data-upload-preview hidden><?php endif; ?>
        <label class="checkbox-label"><input type="checkbox" name="is_active" value="1" <?= $values['is_active'] ? 'checked' : '' ?>> Show this product in the shop</label>
        <div class="form-actions"><button class="button button-primary"><?= $id ? 'Save changes' : 'Add product' ?></button>
            <a class="button button-light" href="<?= h(url('admin/products.php')) ?>">Cancel</a></div>
    </form>
</section>
<?php require dirname(__DIR__, 2) . '/src/views/footer.php'; ?>
