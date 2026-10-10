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
    if ($name === '') {
        $errors[] = 'Enter your name.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }
    if (!is_string($password) || strlen($password) < 10) {
        $errors[] = 'Use a password with at least 10 characters.';
    }
    if (!$errors) {
        $statement = db()->prepare('SELECT id FROM users WHERE email = ?');
        $statement->execute([$email]);
        if ($statement->fetch()) {
            $errors[] = 'An account with that email already exists.';
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
    <div class="auth-intro"><p class="eyebrow">Welcome to Mini Store</p><h1>Make room for<br>good ideas.</h1>
        <p>Create an account to check out and keep track of your orders.</p></div>
    <div class="form-card"><h2>Create account</h2><p class="muted">It only takes a minute.</p>
        <?php if ($errors): ?><ul class="form-errors"><?php foreach ($errors as $error): ?><li><?= h($error) ?></li><?php endforeach; ?></ul><?php endif; ?>
        <form method="post" action="<?= h(url('account/register.php')) ?>" class="stacked-form">
            <?= csrf_field() ?>
            <label for="name">Full name</label><input id="name" name="name" autocomplete="name" maxlength="100" value="<?= h($name) ?>" required>
            <label for="email">Email address</label><input id="email" name="email" type="email" autocomplete="email" maxlength="190" value="<?= h($email) ?>" required>
            <label for="password">Password</label><input id="password" name="password" type="password" autocomplete="new-password" minlength="10" required>
            <button class="button button-primary button-wide">Create account</button>
        </form>
        <p class="form-footnote">Already have an account? <a href="<?= h(url('account/login.php')) ?>">Log in</a></p>
    </div>
</section>
<?php require dirname(__DIR__, 2) . '/src/views/footer.php'; ?>
