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
    <div class="auth-intro"><p class="eyebrow">Good to see you again</p><h1>Your next<br>great find awaits.</h1>
        <p>Sign in to continue to checkout and view your orders.</p></div>
    <div class="form-card"><h2>Log in</h2><p class="muted">Enter your account details below.</p>
        <?php if ($error): ?><p class="notice notice-error" role="alert"><?= h($error) ?></p><?php endif; ?>
        <form method="post" action="<?= h(url('account/login.php')) ?>" class="stacked-form">
            <?= csrf_field() ?>
            <label for="email">Email address</label><input id="email" name="email" type="email" autocomplete="email" value="<?= h($email) ?>" required>
            <label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required>
            <button class="button button-primary button-wide">Log in</button>
        </form>
        <p class="form-footnote">New to Mini Store? <a href="<?= h(url('account/register.php')) ?>">Create an account</a></p>
    </div>
</section>
<?php require dirname(__DIR__, 2) . '/src/views/footer.php'; ?>
