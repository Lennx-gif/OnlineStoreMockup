<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';

$pageTitle = 'About Us';
require dirname(__DIR__) . '/src/views/header.php';
?>
<article class="prose-page policy-page">
    <p class="eyebrow">Our Mission &amp; Craft</p>
    <h1>Thoughtful Tools.<br>Better Everyday Living.</h1>
    <p class="heading-lead">Mini Store was created on a simple belief: everyday products should be beautifully engineered, reliable, and accessible without friction.</p>

    <section class="policy-section">
        <h2>Curated For Daily Focus</h2>
        <p>Whether it is a compact mechanical keyboard that makes long workdays effortless, studio-grade noise-cancelling audio that helps you enter deep focus, or artisan single-origin coffee to start your morning right, every single product in our catalog has been thoughtfully hand-tested by our team.</p>
    </section>

    <section class="policy-section">
        <h2>Our Three Core Pillars</h2>
        <div class="pillars-grid">
            <div class="pillar-card">
                <h3>1. Genuine Quality First</h3>
                <p>We work directly with certified manufacturers and verified artisan suppliers to ensure 100% authentic, warrantied merchandise.</p>
            </div>
            <div class="pillar-card">
                <h3>2. Seamless Commerce</h3>
                <p>Transparent pricing, lightning-fast lightweight pages, and convenient Payment on Delivery — so you inspect your items before paying.</p>
            </div>
            <div class="pillar-card">
                <h3>3. Responsible Delivery</h3>
                <p>All orders are packed in reinforced, recyclable cardboard packaging to reduce environmental footprint while guaranteeing safe arrival.</p>
            </div>
        </div>
    </section>

    <div class="policy-nav-back">
        <a href="<?= h(url()) ?>" class="button button-primary">Explore the Collection</a>
        <a href="<?= h(url('help.php')) ?>" class="button button-outline">Help &amp; Support</a>
    </div>
</article>

<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
