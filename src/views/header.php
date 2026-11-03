<?php
$pageTitle = $pageTitle ?? 'Mini Store';
$activePage = $activePage ?? '';
$successMessage = flash('success');
$errorMessage = flash('error');
$assetRoot = dirname(__DIR__, 2) . '/public/assets';
$styleVersion = is_file($assetRoot . '/css/style.css') ? (string) filemtime($assetRoot . '/css/style.css') : '1';
$scriptVersion = is_file($assetRoot . '/js/store.js') ? (string) filemtime($assetRoot . '/js/store.js') : '1';
$faviconVersion = is_file($assetRoot . '/img/favicon.svg') ? (string) filemtime($assetRoot . '/img/favicon.svg') : '1';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f5f7">
    <title><?= h($pageTitle) ?> | Mini Store</title>
    <link rel="icon" type="image/svg+xml" href="<?= h(url('assets/img/favicon.svg?v=' . $faviconVersion)) ?>">
    <script>
        (() => {
            try {
                const stored = localStorage.getItem('mini-store-theme');
                const theme = stored === 'dark' || stored === 'light'
                    ? stored
                    : (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                document.documentElement.dataset.theme = theme;
            } catch (_) {
                document.documentElement.dataset.theme = 'light';
            }
        })();
    </script>
    <link rel="stylesheet" href="<?= h(url('assets/css/style.css?v=' . $styleVersion)) ?>">
    <script src="<?= h(url('assets/js/store.js?v=' . $scriptVersion)) ?>" defer></script>
</head>
<body>
<header class="site-header">
    <a class="brand" href="<?= h(url()) ?>" aria-label="Mini Store home"><span class="brand-mark" aria-hidden="true">M</span><span class="brand-name">Mini Store</span></a>
    <nav class="main-nav" id="main-navigation" aria-label="Main navigation">
        <a class="<?= $activePage === 'shop' ? 'active' : '' ?>" href="<?= h(url()) ?>">Shop</a>
        <a class="<?= $activePage === 'about' ? 'active' : '' ?>" href="<?= h(url('about.php')) ?>">About</a>
        <a class="<?= $activePage === 'returns' ? 'active' : '' ?>" href="<?= h(url('returns.php')) ?>">Returns</a>
        <a class="<?= $activePage === 'help' ? 'active' : '' ?>" href="<?= h(url('help.php')) ?>">Help</a>
        <a class="<?= $activePage === 'contact' ? 'active' : '' ?>" href="<?= h(url('contact.php')) ?>">Contact</a>
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
        <button type="submit" aria-label="Search"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"></circle><path d="m16 16 4.5 4.5"></path></svg></button>
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
        <button class="theme-toggle" type="button" aria-label="Switch to dark appearance" title="Switch appearance" aria-pressed="false">
            <svg class="icon icon-sun" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"></path></svg>
            <svg class="icon icon-moon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.2 15.4A8.6 8.6 0 0 1 8.6 3.8 8.7 8.7 0 1 0 20.2 15.4Z"></path></svg>
        </button>
        <a class="cart-link" href="<?= h(url('cart.php')) ?>" aria-label="Cart, <?= cart_count() ?> items">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 4h2l2.2 11.1a2 2 0 0 0 2 1.6h8.4a2 2 0 0 0 1.9-1.4L21 8H6"></path><circle cx="10" cy="20" r="1"></circle><circle cx="18" cy="20" r="1"></circle></svg>
            <span class="cart-label">Cart</span><span data-cart-count><?= cart_count() ?></span>
        </a>
        <button class="menu-toggle" type="button" aria-controls="main-navigation" aria-expanded="false" aria-label="Open navigation"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"></path></svg></button>
    </div>
</header>
<main class="page-shell">
    <?php if ($successMessage): ?><p class="notice notice-success" role="status"><?= h($successMessage) ?></p><?php endif; ?>
    <?php if ($errorMessage): ?><p class="notice notice-error" role="alert"><?= h($errorMessage) ?></p><?php endif; ?>
