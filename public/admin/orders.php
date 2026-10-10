<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';
require_admin();

$allowedStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $id = input_int($_POST['order_id'] ?? null);
    $rawStatus = $_POST['status'] ?? '';
    $status = is_string($rawStatus) ? $rawStatus : '';
    if (!$id || !in_array($status, $allowedStatuses, true)) {
        http_response_code(400);
        exit('Invalid order status.');
    }
    $statement = db()->prepare('UPDATE orders SET status = ? WHERE id = ?');
    $statement->execute([$status, $id]);
    flash('success', 'Order status updated.');
    redirect('admin/orders.php');
}
$orders = db()->query(
    'SELECT o.*, u.name AS customer_name, u.email AS customer_email '
    . 'FROM orders o JOIN users u ON u.id = o.user_id ORDER BY o.created_at DESC'
)->fetchAll();
$orderItems = db()->query(
    'SELECT order_id, product_name, unit_price, quantity FROM order_items ORDER BY order_id, id'
)->fetchAll();
$itemsByOrder = [];
foreach ($orderItems as $item) {
    $itemsByOrder[(int) $item['order_id']][] = $item;
}
$pageTitle = 'Manage orders';
require dirname(__DIR__, 2) . '/src/views/header.php';
?>
<div class="page-heading"><p class="eyebrow">Store management</p><h1>Orders</h1></div>
<?php if (!$orders): ?><div class="empty-state"><h2>No orders yet</h2><p>Customer orders will appear here.</p></div>
<?php else: ?><div class="orders-list admin-orders">
    <?php foreach ($orders as $order): ?>
        <article class="order-card">
            <div class="order-heading"><div><p class="eyebrow">Order #<?= (int) $order['id'] ?> · <?= h(date('M j, Y g:i a', strtotime($order['created_at']))) ?></p>
                <h2><?= h($order['customer_name']) ?> <span class="muted">· <?= h($order['customer_email']) ?></span></h2></div>
                <strong><?= h(money($order['total'])) ?></strong></div>
            <p class="shipping-details"><?= h($order['shipping_name']) ?> · <?= h($order['shipping_phone']) ?><br>
                <?= h($order['shipping_address']) ?>, <?= h($order['shipping_city']) ?></p>
            <?php foreach ($itemsByOrder[(int) $order['id']] ?? [] as $item): ?>
                <div class="order-line"><span><?= h($item['product_name']) ?> <small>× <?= (int) $item['quantity'] ?></small></span>
                    <strong><?= h(money((float) $item['unit_price'] * (int) $item['quantity'])) ?></strong></div>
            <?php endforeach; ?>
            <form method="post" class="status-form">
                <?= csrf_field() ?><input type="hidden" name="order_id" value="<?= (int) $order['id'] ?>">
                <label for="status-<?= (int) $order['id'] ?>">Status</label>
                <select id="status-<?= (int) $order['id'] ?>" name="status">
                    <?php foreach ($allowedStatuses as $status): ?>
                        <option value="<?= h($status) ?>" <?= $order['status'] === $status ? 'selected' : '' ?>><?= h(ucfirst($status)) ?></option>
                    <?php endforeach; ?>
                </select><button class="button button-outline button-small">Update status</button>
            </form>
        </article>
    <?php endforeach; ?>
</div><?php endif; ?>
<?php require dirname(__DIR__, 2) . '/src/views/footer.php'; ?>
