<?php
// login.php
require_once 'includes/db.php';

$error = '';
$success = isset($_GET['success']) ? $_GET['success'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            header("Location: index.php");
            exit();
        } else {
            $error = 'Invalid email or password.';
        }
    }
}

include 'includes/header.php';
?>

<div class="auth-container">
    <div class="auth-header">
        <h2>Welcome Back</h2>
        <p>Sign in to manage your bookings and profile.</p>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST" class="auth-form">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="john@example.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-auth">Sign In</button>
    </form>

    <div class="auth-footer">
        Don't have an account? <a href="signup.php">Create one</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
