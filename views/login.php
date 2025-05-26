<?php
session_start();
$error_message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

$pageTitle = 'Login - Todo App';
$excludeHeaderFooter = true;

ob_start();
?>
<div class="login-page d-flex align-items-center justify-content-center vh-100">
    <div class="text-center p-4 border rounded shadow-lg">
        <h1>Login to Your Account</h1>

        <?php if (!empty($error_message)): ?>
            <p class="text-danger"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="../src/controllers/AuthController.php?action=login" class="form-group">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" placeholder="Email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>

<?php
$content = ob_get_clean();

include '../views/shared/layout.php';
?>