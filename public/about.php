<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';
$pageTitle = 'About';
require dirname(__DIR__) . '/src/views/header.php';
?>
<article class="prose-page"><p class="eyebrow">About the project</p><h1>Small store.<br>Big learning.</h1>
    <p>Mini Store is a learning project for exploring how a web shop works: from a product catalogue and browser interactions to PHP sessions, database transactions, and order management.</p>
    <p>It is a demo, not a commercial store. No real payments are collected.</p><a href="<?= h(url()) ?>">Explore the shop</a></article>
<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
