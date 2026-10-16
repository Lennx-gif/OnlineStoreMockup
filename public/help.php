<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';

$pageTitle = 'Help & Support';
$activePage = 'help';
require dirname(__DIR__) . '/src/views/header.php';
?>
<div class="page-heading">
    <p class="eyebrow">Customer Support &amp; Knowledge Base</p>
    <h1>How can we help you?</h1>
    <p class="heading-lead">Find fast answers to frequently asked questions about orders, delivery, payments, and returns.</p>
</div>

<div class="help-layout">
    <div class="help-grid">
        <section class="help-card">
            <div class="help-icon">📦</div>
            <h2>Ordering &amp; Tracking</h2>
            <div class="faq-item">
                <h3>How do I place an order?</h3>
                <p>Browse our collection, select your desired items, and click <strong>Add to cart</strong>. When you are ready, go to your cart and proceed to checkout. Enter your delivery contact details and confirm your order.</p>
            </div>
            <div class="faq-item">
                <h3>How can I track my order?</h3>
                <p>If you have an account, visit <a href="<?= h(url('account/orders.php')) ?>">My orders</a> to view real-time status updates (Pending, Processing, Shipped, Delivered). You will also receive phone/SMS confirmation upon dispatch.</p>
            </div>
            <div class="faq-item">
                <h3>Can I modify or cancel my order?</h3>
                <p>Orders in <em>Pending</em> status can be adjusted by contacting our customer service hotline immediately. Once an order enters <em>Shipped</em> status, it is already with the courier.</p>
            </div>
        </section>

        <section class="help-card">
            <div class="help-icon">🚚</div>
            <h2>Shipping &amp; Delivery</h2>
            <div class="faq-item">
                <h3>How fast is delivery?</h3>
                <p>Orders within metropolitan areas are delivered within <strong>24 to 48 hours</strong>. Upcountry and nationwide deliveries typically arrive within 2 to 3 business days.</p>
            </div>
            <div class="faq-item">
                <h3>What are the delivery fees?</h3>
                <p>Standard delivery is complimentary for orders over KSh 5,000. For orders under KSh 5,000, a flat nominal delivery fee applies based on your delivery city entered at checkout.</p>
            </div>
            <div class="faq-item">
                <h3>What happens if I miss my delivery?</h3>
                <p>Our dispatch courier calls ahead prior to delivery. If you are unreachable, a re-delivery attempt is scheduled for the next business day at no additional charge.</p>
            </div>
        </section>

        <section class="help-card">
            <div class="help-icon">💳</div>
            <h2>Payment on Delivery</h2>
            <div class="faq-item">
                <h3>How does Payment on Delivery work?</h3>
                <p>You do not need to pay anything in advance. Inspect your package when our courier arrives at your doorstep, then pay seamlessly via <strong>Cash, Mobile Money (M-Pesa), or Card</strong>.</p>
            </div>
            <div class="faq-item">
                <h3>Are there any hidden fees or surcharges?</h3>
                <p>No. The total displayed on your order invoice at checkout is the exact amount you pay upon delivery. There are no surprise handling fees.</p>
            </div>
        </section>

        <section class="help-card">
            <div class="help-icon">🔄</div>
            <h2>Returns &amp; Warranties</h2>
            <div class="faq-item">
                <h3>What is your return policy?</h3>
                <p>We provide a <strong>30-day return guarantee</strong> on all eligible merchandise. Items must be in their original packaging with all included accessories. Read full details on our <a href="<?= h(url('returns.php')) ?>">Returns &amp; Refunds</a> page.</p>
            </div>
            <div class="faq-item">
                <h3>Are products covered by warranty?</h3>
                <p>All tech peripherals, audio devices, and electronics carry a minimum 1-year manufacturer warranty against hardware defects.</p>
            </div>
        </section>
    </div>

    <aside class="help-contact-banner">
        <div class="banner-content">
            <h3>Still need assistance?</h3>
            <p>Our support team is available Monday through Saturday from 8:00 AM to 6:00 PM to help with any inquiries.</p>
        </div>
        <div class="banner-actions">
            <a href="<?= h(url('contact.php')) ?>" class="button button-primary">Contact Customer Support</a>
        </div>
    </aside>
</div>

<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
