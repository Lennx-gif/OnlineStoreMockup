<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';
require_admin();

$productCount = (int) db()->query('SELECT COUNT(*) FROM products WHERE is_active = 1')->fetchColumn();
$orderCount = (int) db()->query('SELECT COUNT(*) FROM orders')->fetchColumn();
$recentOrders = db()->query(
    'SELECT o.id, o.total, o.status, o.created_at, u.name AS customer_name '
    . 'FROM orders o JOIN users u ON u.id = o.user_id ORDER BY o.created_at DESC LIMIT 6'
)->fetchAll();
$pageTitle = 'Admin';
require dirname(__DIR__, 2) . '/src/views/header.php';
?>
<div class="page-heading admin-heading"><div><p class="eyebrow">Store management</p><h1>Admin dashboard</h1></div>
    <div class="admin-links"><a class="button button-outline" href="<?= h(url('admin/products.php')) ?>">Manage products</a>
        <a class="button button-primary" href="<?= h(url('admin/product_form.php')) ?>">Add product</a></div>
</div>
<div class="metric-grid"><article class="metric-card"><span>Active products</span><strong><?= $productCount ?></strong><small>Available in the shop</small></article>
    <article class="metric-card"><span>Orders placed</span><strong><?= $orderCount ?></strong><small>All customer orders</small></article></div>
<section class="admin-section"><div class="section-heading"><div><p class="eyebrow">Latest activity</p><h2>Recent orders</h2></div>
    <a href="<?= h(url('admin/orders.php')) ?>">View all orders →</a></div>
    <?php if ($recentOrders): ?>
        <div class="table-wrap"><table><thead><tr><th>Order</th><th>Customer</th><th>Date</th><th>Total</th><th>Status</th></tr></thead><tbody>
        <?php foreach ($recentOrders as $order): ?><tr>
            <td><a href="<?= h(url('admin/orders.php')) ?>">#<?= (int) $order['id'] ?></a></td>
            <td><?= h($order['customer_name']) ?></td><td><?= h(date('M j, Y', strtotime($order['created_at']))) ?></td>
            <td><?= h(money($order['total'])) ?></td><td><span class="status status-<?= h($order['status']) ?>"><?= h(ucfirst($order['status'])) ?></span></td>
        </tr><?php endforeach; ?>
        </tbody></table></div>
    <?php else: ?><p class="empty-inline">Orders will appear here after a customer checks out.</p><?php endif; ?>
</section>
<?php require dirname(__DIR__, 2) . '/src/views/footer.php'; ?>
