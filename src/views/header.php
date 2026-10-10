<?php
$pageTitle = $pageTitle ?? 'Mini Store';
$activePage = $activePage ?? '';
$successMessage = flash('success');
$errorMessage = flash('error');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">
    <title><?= h($pageTitle) ?> · Mini Store</title>
    <link rel="stylesheet" href="<?= h(url('assets/css/style.css')) ?>">
    <script src="<?= h(url('assets/js/store.js')) ?>" defer></script>
</head>
<body>
<header class="site-header">
    <a class="brand" href="<?= h(url()) ?>"><span>Mini</span>Store</a>
    <nav class="main-nav" aria-label="Main navigation">
        <a class="<?= $activePage === 'shop' ? 'active' : '' ?>" href="<?= h(url()) ?>">Shop</a>
        <?php if (current_user()): ?>
            <a class="<?= $activePage === 'orders' ? 'active' : '' ?>" href="<?= h(url('account/orders.php')) ?>">My orders</a>
            <?php if (current_user()['role'] === 'admin'): ?>
                <a href="<?= h(url('admin/index.php')) ?>">Admin</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>
    <form class="header-search" action="<?= h(url()) ?>" method="get" role="search">
        <label class="visually-hidden" for="header-search">Search products</label>
        <input id="header-search" name="q" type="search" placeholder="Search products">
        <button aria-label="Search">⌕</button>
    </form>
    <div class="header-actions">
        <?php if (current_user()): ?>
            <span class="welcome">Hi, <?= h(current_user()['name']) ?></span>
            <form action="<?= h(url('account/logout.php')) ?>" method="post" class="inline-form">
                <?= csrf_field() ?>
                <button class="text-button">Log out</button>
            </form>
        <?php else: ?>
            <a href="<?= h(url('account/login.php')) ?>">Login</a>
        <?php endif; ?>
        <a class="cart-link" href="<?= h(url('cart.php')) ?>" aria-label="Cart, <?= cart_count() ?> items">
            Cart <span data-cart-count><?= cart_count() ?></span>
        </a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-label="Open navigation">☰</button>
    </div>
</header>
<main class="page-shell">
    <?php if ($successMessage): ?><p class="notice notice-success" role="status"><?= h($successMessage) ?></p><?php endif; ?>
    <?php if ($errorMessage): ?><p class="notice notice-error" role="alert"><?= h($errorMessage) ?></p><?php endif; ?>
