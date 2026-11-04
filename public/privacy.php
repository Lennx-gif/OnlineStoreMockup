<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';

$pageTitle = 'Privacy Policy';
require dirname(__DIR__) . '/src/views/header.php';
?>
<article class="prose-page policy-page">
    <p class="eyebrow">Legal &amp; Trust</p>
    <h1>Privacy Policy</h1>
    <p class="muted">Effective Date: October 16, 2026 · Last Updated: October 2026</p>

    <section class="policy-section">
        <h2>1. Overview &amp; Commitment</h2>
        <p>Mini Store ("we", "our", or "us") is dedicated to protecting your privacy and personal data. This Privacy Policy outlines our transparent practices regarding the collection, storage, use, and disclosure of information when you access our online store and services.</p>
    </section>

    <section class="policy-section">
        <h2>2. Information We Collect</h2>
        <p>To provide high-quality retail experiences and ensure smooth order delivery, we collect the following categories of information:</p>
        <ul>
            <li><strong>Account Information:</strong> When you register an account, we record your full name, email address, and a cryptographically secured one-way password hash.</li>
            <li><strong>Delivery &amp; Order Details:</strong> When you place an order, we collect recipient name, contact phone number, street address, and delivery city for dispatch fulfillment.</li>
            <li><strong>Technical &amp; Session Logs:</strong> When you browse our store, we automatically process standard HTTP headers, session cookies for cart persistence, and security verification tokens (CSRF) to protect against unauthorized submissions.</li>
        </ul>
    </section>

    <section class="policy-section">
        <h2>3. How We Use Your Information</h2>
        <p>We process your data strictly for legitimate commerce and customer service purposes:</p>
        <ul>
            <li>Fulfilling, processing, and delivering orders you place.</li>
            <li>Sending critical order confirmations and delivery status notifications.</li>
            <li>Responding promptly to customer service inquiries submitted through our support desk.</li>
            <li>Protecting the store and users against fraudulent orders, automated attacks, and security vulnerabilities.</li>
        </ul>
    </section>

    <section class="policy-section">
        <h2>4. Data Protection &amp; Security Standards</h2>
        <p>We implement defense-in-depth security measures to protect your personal information:</p>
        <ul>
            <li><strong>Password Security:</strong> Passwords are never stored in plain text. They are hashed using modern industry algorithms (Argon2 / Bcrypt with unique salts).</li>
            <li><strong>Database Prepared Statements:</strong> All database queries utilize PDO parameterized prepared statements, preventing SQL injection vulnerabilities.</li>
            <li><strong>Secure Cookie Flags:</strong> Cookies are served with <code>HttpOnly</code>, <code>SameSite=Lax</code>, and <code>Secure</code> flags to prevent cross-site scripting (XSS) and session hijacking.</li>
            <li><strong>CSRF Protection:</strong> All transactional and account actions require cryptographically randomized CSRF tokens.</li>
        </ul>
    </section>

    <section class="policy-section">
        <h2>5. Sharing With Third Parties</h2>
        <p>We do not sell, rent, or trade your personal data. We only share necessary delivery contact details (recipient name, address, and phone number) with licensed logistics courier partners solely to execute physical package delivery.</p>
    </section>

    <section class="policy-section">
        <h2>6. Your Privacy Rights</h2>
        <p>You have the right to inspect, update, or request the deletion of your account and personal data at any time. You can view your past orders directly in <a href="<?= h(url('account/orders.php')) ?>">My orders</a> or contact our Data Protection Officer at <a href="mailto:privacy@ministore.co.ke">privacy@ministore.co.ke</a>.</p>
    </section>

    <div class="policy-nav-back">
        <a href="<?= h(url()) ?>" class="button button-outline">Return to Shop</a>
    </div>
</article>

<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
