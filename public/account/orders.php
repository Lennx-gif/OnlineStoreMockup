<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';
require_login();

$statement = db()->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC, id DESC');
$statement->execute([current_user()['id']]);
$orders = $statement->fetchAll();
$itemStatement = db()->prepare(
    'SELECT product_name, unit_price, quantity FROM order_items WHERE order_id = ? ORDER BY id'
);
$pageTitle = 'My orders';
$activePage = 'orders';
require dirname(__DIR__, 2) . '/src/views/header.php';
?>
<div class="page-heading"><p class="eyebrow">Your account</p><h1>My orders</h1></div>
<?php if (!$orders): ?>
    <section class="empty-state"><h2>No orders yet</h2><p>When you place an order, it will show up here.</p>
        <a class="button button-primary" href="<?= h(url()) ?>">Browse the shop</a></section>
<?php else: ?>
    <div class="orders-list">
        <?php foreach ($orders as $order): ?>
            <article class="order-card">
                <div class="order-heading"><div><p class="eyebrow">Order #<?= (int) $order['id'] ?></p>
                    <h2><?= h(date('F j, Y', strtotime($order['created_at']))) ?></h2></div>
                    <span class="status status-<?= h($order['status']) ?>"><?= h(ucfirst($order['status'])) ?></span></div>
                <?php $itemStatement->execute([$order['id']]); foreach ($itemStatement->fetchAll() as $item): ?>
                    <div class="order-line"><span><?= h($item['product_name']) ?> <small>× <?= (int) $item['quantity'] ?></small></span>
                        <strong><?= h(money((float) $item['unit_price'] * (int) $item['quantity'])) ?></strong></div>
                <?php endforeach; ?>
                <div class="summary-total"><span>Order total</span><strong><?= h(money($order['total'])) ?></strong></div>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php require dirname(__DIR__, 2) . '/src/views/footer.php'; ?>
