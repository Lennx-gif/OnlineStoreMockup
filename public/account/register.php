<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';

$errors = [];
$name = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = post_string('name', 100);
    $email = strtolower(post_string('email', 190));
    $password = $_POST['password'] ?? '';
    $passwordConfirmation = $_POST['password_confirmation'] ?? '';
    if ($name === '') {
        $errors['name'] = 'Enter your name.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    }
    if (!is_string($password) || strlen($password) < 10) {
        $errors['password'] = 'Use a password with at least 10 characters.';
    }
    if (!is_string($passwordConfirmation) || !is_string($password) || !hash_equals($password, $passwordConfirmation)) {
        $errors['password_confirmation'] = 'The passwords do not match.';
    }
    if (!$errors) {
        $statement = db()->prepare('SELECT id FROM users WHERE email = ?');
        $statement->execute([$email]);
        if ($statement->fetch()) {
            $errors['email'] = 'An account with that email already exists.';
        } else {
            $statement = db()->prepare(
                "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)"
            );
            $statement->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => (int) db()->lastInsertId(),
                'name' => $name,
                'email' => $email,
                'role' => 'customer',
            ];
            flash('success', 'Your account is ready.');
            redirect('account/orders.php');
        }
    }
}
$pageTitle = 'Create account';
require dirname(__DIR__, 2) . '/src/views/header.php';
?>
<section class="auth-layout">
    <div class="auth-story">
        <p class="eyebrow">Shopping made easier</p>
        <h1>Your orders, all in one place.</h1>
        <p class="auth-lead">Create an account to place orders and stay up to date from confirmation to delivery.</p>
        <ul class="auth-benefits">
            <li><span class="auth-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 5h16v14H4zM8 9h8M8 13h5"></path><circle cx="17" cy="15" r="3"></circle></svg></span><span><strong>Track your orders</strong><small>Check each order’s current status from your account.</small></span></li>
            <li><span class="auth-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"></path></svg></span><span><strong>Keep your history</strong><small>Return to previous order details whenever you need them.</small></span></li>
            <li><span class="auth-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m3 7 9-4 9 4v10l-9 4-9-4zM3 7l9 4 9-4M12 11v10"></path></svg></span><span><strong>Shop with confidence</strong><small>Get delivery support and read our returns policy before you buy.</small></span></li>
        </ul>
        <div class="auth-support"><strong>Questions about an order?</strong><span>Browse <a href="<?= h(url('help.php')) ?>">common questions</a> or read our <a href="<?= h(url('returns.php')) ?>">returns policy</a>.</span></div>
    </div>
    <div class="form-card auth-form-card"><p class="eyebrow">Get started</p><h2>Create account</h2><p class="muted">Add your details below. You’ll use your email to sign in.</p>
        <?php if ($errors): ?><div class="form-errors" role="alert"><p>Please correct the following:</p><ul><?php foreach ($errors as $error): ?><li><?= h($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <form method="post" action="<?= h(url('account/register.php')) ?>" class="stacked-form">
            <?= csrf_field() ?>
            <label for="name">Full name</label><input id="name" name="name" autocomplete="name" maxlength="100" value="<?= h($name) ?>" required <?= isset($errors['name']) ? 'aria-invalid="true" aria-describedby="name-error"' : '' ?>>
            <?php if (isset($errors['name'])): ?><small class="field-error" id="name-error"><?= h($errors['name']) ?></small><?php endif; ?>
            <label for="email">Email address</label><input id="email" name="email" type="email" autocomplete="email" maxlength="190" value="<?= h($email) ?>" required <?= isset($errors['email']) ? 'aria-invalid="true" aria-describedby="email-error"' : '' ?>>
            <?php if (isset($errors['email'])): ?><small class="field-error" id="email-error"><?= h($errors['email']) ?></small><?php endif; ?>
            <label for="password">Password</label><input id="password" name="password" type="password" autocomplete="new-password" minlength="10" required <?= isset($errors['password']) ? 'aria-invalid="true" aria-describedby="password-hint password-error"' : 'aria-describedby="password-hint"' ?>>
            <small class="field-hint" id="password-hint">Use at least 10 characters.</small>
            <?php if (isset($errors['password'])): ?><small class="field-error" id="password-error"><?= h($errors['password']) ?></small><?php endif; ?>
            <label for="password_confirmation">Confirm password</label><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="10" required <?= isset($errors['password_confirmation']) ? 'aria-invalid="true" aria-describedby="password-confirmation-error"' : '' ?>>
            <?php if (isset($errors['password_confirmation'])): ?><small class="field-error" id="password-confirmation-error"><?= h($errors['password_confirmation']) ?></small><?php endif; ?>
            <button class="button button-primary button-wide">Create account</button>
        </form>
        <p class="form-footnote">Already have an account? <a href="<?= h(url('account/login.php')) ?>">Log in</a></p>
    </div>
</section>
<?php require dirname(__DIR__, 2) . '/src/views/footer.php'; ?>
