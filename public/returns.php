<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';

$pageTitle = 'Returns & Refunds Policy';
$activePage = 'returns';
require dirname(__DIR__) . '/src/views/header.php';
?>
<article class="prose-page policy-page">
    <p class="eyebrow">Customer Satisfaction</p>
    <h1>Delivery, Returns &amp; Refunds</h1>
    <p class="heading-lead">We want you to love everything you buy from Mini Store. If you are not completely satisfied, our flexible 30-day guarantee is here to help.</p>

    <section class="policy-section">
        <h2>30-Day Money-Back Guarantee</h2>
        <p>You may return any eligible non-perishable product within <strong>30 days of delivery</strong> for a full refund or exchange. We believe in our products and want you to shop with complete peace of mind.</p>
    </section>

    <section class="policy-section">
        <h2>Return Eligibility Conditions</h2>
        <p>To qualify for a full refund or replacement under our return policy, items must satisfy the following criteria:</p>
        <ul>
            <li>The item must be in its original, unaltered condition with no signs of physical abuse or liquid damage.</li>
            <li>All original manufacturer packaging, user manuals, warranty cards, and bundled accessories must be returned intact.</li>
            <li>For hygiene and health safety standards, opened food or consumable grocery packages cannot be returned unless they arrived damaged or past their expiry date.</li>
        </ul>
    </section>

    <section class="policy-section">
        <h2>Simple 4-Step Return Process</h2>
        <ol class="steps-list">
            <li><strong>Initiate Return:</strong> Contact our care team via <a href="<?= h(url('contact.php')) ?>">Contact Support</a> or telephone, citing your Order Number and the item you wish to return.</li>
            <li><strong>Courier Collection:</strong> Our dispatch partner will schedule a convenient pickup from your original delivery address within 48 hours.</li>
            <li><strong>Quality Verification:</strong> Upon receipt at our fulfillment center, our inspection team verifies the item within 24 hours.</li>
            <li><strong>Instant Refund:</strong> Once approved, refunds are credited back to your original payment channel (M-Pesa, bank transfer, or card) within <strong>3 business days</strong>.</li>
        </ol>
    </section>

    <section class="policy-section">
        <h2>Damaged or Defective Items</h2>
        <p>In the unlikely event that an item arrives damaged or malfunctions within the warranty period, we will dispatch an immediate replacement at zero additional shipping cost. Please notify us within 48 hours of delivery.</p>
    </section>

    <div class="policy-nav-back">
        <a href="<?= h(url()) ?>" class="button button-outline">Continue Shopping</a>
        <a href="<?= h(url('contact.php')) ?>" class="button button-primary">Initiate a Return</a>
    </div>
</article>

<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
