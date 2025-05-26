<?php
session_start();
$error_message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

$pageTitle = 'Register - Todo App';
$excludeHeaderFooter = true;

ob_start();
?>
<div class="register-page d-flex align-items-center justify-content-center vh-100">
    <div class="text-center p-4 border rounded shadow-lg">
        <h1>Create Your Account</h1>

        <?php if (!empty($error_message)): ?>
            <p class="text-danger"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="../src/controllers/AuthController.php?action=register" class="form-group">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" placeholder="Your Name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" placeholder="Email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</div>

<?php
$content = ob_get_clean();

include '../views/shared/layout.php';
?>