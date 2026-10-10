<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';
$pageTitle = 'Privacy';
require dirname(__DIR__) . '/src/views/header.php';
?>
<article class="prose-page"><p class="eyebrow">Demo information</p><h1>Privacy</h1>
    <p>This local learning app stores account details, delivery details, and orders in its configured database to demonstrate store features. Do not enter real or sensitive personal information.</p>
    <p>Before any public deployment, replace this notice with a complete privacy policy and implement the legal, consent, retention, and data-protection measures that apply to your service.</p>
    <a href="<?= h(url()) ?>">Back to shop</a></article>
<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
