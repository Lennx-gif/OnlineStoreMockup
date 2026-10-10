<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';
$pageTitle = 'Contact';
require dirname(__DIR__) . '/src/views/header.php';
?>
<article class="prose-page"><p class="eyebrow">Get in touch</p><h1>Contact</h1>
    <p>This is a local learning demo and is not staffed for customer support. For questions about the code, use the project workspace where you are developing it.</p>
    <a href="<?= h(url()) ?>">Back to shop</a></article>
<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
