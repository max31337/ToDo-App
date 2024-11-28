<?php
$pageTitle = 'Welcome - Todo App';
$excludeHeaderFooter = true; 

ob_start();
?>

<div class="landing-page d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h2 class="">Welcome to the Todo App</h2>
        <p>Manage your tasks and to-do lists easily.</p>
        <a href="../views/login.php"><button class="btn btn-primary m-2">Login</button></a>
        <a href="../views/register.php"><button class="btn btn-secondary m-2">Register</button></a>
    </div>
</div>

<?php
$content = ob_get_clean();

include '../views/shared/layout.php';
