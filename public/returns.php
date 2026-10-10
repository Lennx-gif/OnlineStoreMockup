<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';
$pageTitle = 'Returns';
require dirname(__DIR__) . '/src/views/header.php';
?>
<article class="prose-page"><p class="eyebrow">Demo information</p><h1>Delivery &amp; returns</h1>
    <p>This learning project does not dispatch real products. Orders are saved only as a demonstration of the checkout and order-history flow.</p>
    <p>No delivery, refund, or return service is offered.</p><a href="<?= h(url()) ?>">Back to shop</a></article>
<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
