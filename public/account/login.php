<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';

$error = null;
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = strtolower(post_string('email', 190));
    $password = $_POST['password'] ?? '';
    $statement = db()->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = ?');
    $statement->execute([$email]);
    $user = $statement->fetch();
    if ($user && is_string($password) && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => (int) $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];
        flash('success', 'Welcome back, ' . $user['name'] . '.');
        redirect('account/orders.php');
    }
    $error = 'Email or password did not match.';
}
$pageTitle = 'Log in';
require dirname(__DIR__, 2) . '/src/views/header.php';
?>
<section class="auth-layout">
    <div class="auth-story">
        <p class="eyebrow">Your Mini Store account</p>
        <h1>A clearer view of every order.</h1>
        <p class="auth-lead">Sign in to keep your purchases and order progress together in one place.</p>
        <ul class="auth-benefits">
            <li><span class="auth-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 5h16v14H4zM8 9h8M8 13h5"></path><circle cx="17" cy="15" r="3"></circle></svg></span><span><strong>Follow order progress</strong><small>See when an order is pending, processing, shipped, or delivered.</small></span></li>
            <li><span class="auth-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"></path></svg></span><span><strong>Find past purchases</strong><small>Review your order history whenever you need it.</small></span></li>
            <li><span class="auth-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="M3 10h18M7 15h4"></path></svg></span><span><strong>Pay on delivery</strong><small>Place an order and pay when it arrives at your door.</small></span></li>
        </ul>
        <div class="auth-support"><strong>Need help before signing in?</strong><span>Visit our <a href="<?= h(url('help.php')) ?>">Help Center</a> or <a href="<?= h(url('contact.php')) ?>">contact support</a>.</span></div>
    </div>
    <div class="form-card auth-form-card"><p class="eyebrow">Welcome back</p><h2>Log in</h2><p class="muted">Enter the email and password for your account.</p>
        <?php if ($error): ?><p class="notice notice-error" role="alert"><?= h($error) ?></p><?php endif; ?>
        <form method="post" action="<?= h(url('account/login.php')) ?>" class="stacked-form">
            <?= csrf_field() ?>
            <label for="email">Email address</label><input id="email" name="email" type="email" autocomplete="email" value="<?= h($email) ?>" required>
            <label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required>
            <button class="button button-primary button-wide">Log in</button>
        </form>
        <p class="form-footnote">New to Mini Store? <a href="<?= h(url('account/register.php')) ?>">Create an account</a> to track orders and keep your purchase history together.</p>
    </div>
</section>
<?php require dirname(__DIR__, 2) . '/src/views/footer.php'; ?>
