<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $id = input_int($_POST['product_id'] ?? null);
    if (!$id) {
        http_response_code(400);
        exit('Invalid product.');
    }
    $statement = db()->prepare('UPDATE products SET is_active = 0 WHERE id = ?');
    $statement->execute([$id]);
    flash('success', 'Product removed from the shop.');
    redirect('admin/products.php');
}
$products = db()->query(
    'SELECT id, name, price, stock, category, is_active FROM products ORDER BY is_active DESC, name'
)->fetchAll();
$pageTitle = 'Manage products';
require dirname(__DIR__, 2) . '/src/views/header.php';
?>
<div class="page-heading admin-heading"><div><p class="eyebrow">Store management</p><h1>Products</h1></div>
    <a class="button button-primary" href="<?= h(url('admin/product_form.php')) ?>">Add product</a></div>
<div class="table-wrap admin-table"><table><thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Stock</th><th>Visibility</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($products as $product): ?><tr>
    <td><strong><?= h($product['name']) ?></strong></td><td><?= h($product['category']) ?></td>
    <td><?= h(money($product['price'])) ?></td><td><?= (int) $product['stock'] ?></td>
    <td><?= $product['is_active'] ? 'Active' : 'Hidden' ?></td>
    <td class="table-actions"><a href="<?= h(url('admin/product_form.php?id=' . (int) $product['id'])) ?>">Edit</a>
        <?php if ($product['is_active']): ?><form method="post" action="<?= h(url('admin/products.php')) ?>" data-confirm="Remove this product from the shop?">
            <?= csrf_field() ?><input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
            <button class="text-button danger-text">Remove</button></form><?php endif; ?></td>
</tr><?php endforeach; ?>
</tbody></table></div>
<?php require dirname(__DIR__, 2) . '/src/views/footer.php'; ?>
