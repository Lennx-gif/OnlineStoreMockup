<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';

$errors = [];
$name = current_user()['name'] ?? '';
$email = current_user()['email'] ?? '';
$subject = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = post_string('name', 100);
    $email = post_string('email', 190);
    $subject = post_string('subject', 160);
    $message = post_string('message', 3000);

    if ($name === '') {
        $errors[] = 'Please enter your name.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please provide a valid email address.';
    }
    if ($subject === '') {
        $errors[] = 'Please provide a subject for your inquiry.';
    }
    if (mb_strlen($message) < 10) {
        $errors[] = 'Please write a message with at least 10 characters.';
    }

    if (!$errors) {
        // In a live environment with mailer configured, mail() or an SMTP client is dispatched here.
        flash('success', 'Thank you! Your inquiry has been received. Our support team will get back to you within 24 hours.');
        redirect('contact.php');
    }
}

$pageTitle = 'Contact Us';
require dirname(__DIR__) . '/src/views/header.php';
?>
<div class="page-heading">
    <p class="eyebrow">Customer Care</p>
    <h1>Get in touch with us</h1>
    <p class="heading-lead">Have a question regarding products, an existing order, or partnership inquiries? We are here to assist.</p>
</div>

<div class="contact-layout">
    <div class="contact-info-panel">
        <section class="info-block">
            <h3>Customer Service Hotline</h3>
            <p><strong>+254 (0) 700 123 456</strong><br><span class="muted">Toll-free across mobile networks</span></p>
        </section>

        <section class="info-block">
            <h3>Email Support</h3>
            <p><a href="mailto:support@ministore.co.ke">support@ministore.co.ke</a><br><span class="muted">Average response time: under 3 hours</span></p>
        </section>

        <section class="info-block">
            <h3>Headquarters &amp; Fulfillment Center</h3>
            <p>Mini Store Logistics Hub<br>4th Floor, Tech Innovation Towers<br>Waiyaki Way, Nairobi, Kenya</p>
        </section>

        <section class="info-block">
            <h3>Business Hours</h3>
            <p>Monday – Friday: 8:00 AM – 6:00 PM<br>Saturday: 9:00 AM – 4:00 PM<br><span class="muted">Closed on Sundays and Public Holidays</span></p>
        </section>
    </div>

    <section class="form-card contact-form-card">
        <h2>Send us a message</h2>
        <p class="muted">Fill out the form below and our care team will reply directly to your inbox.</p>
        
        <?php if ($errors): ?>
            <ul class="form-errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= h($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="post" action="<?= h(url('contact.php')) ?>" class="stacked-form">
            <?= csrf_field() ?>
            <label for="contact_name">Your Name</label>
            <input id="contact_name" name="name" maxlength="100" value="<?= h($name) ?>" required>

            <label for="contact_email">Email Address</label>
            <input id="contact_email" name="email" type="email" maxlength="190" value="<?= h($email) ?>" required>

            <label for="contact_subject">Subject</label>
            <input id="contact_subject" name="subject" maxlength="160" value="<?= h($subject) ?>" placeholder="e.g. Inquiry about order delivery, product specs" required>

            <label for="contact_message">Message</label>
            <textarea id="contact_message" name="message" rows="5" maxlength="3000" placeholder="Please describe how we can assist you..." required><?= h($message) ?></textarea>

            <button class="button button-primary button-wide">Send Message</button>
        </form>
    </section>
</div>

<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
