<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /views/login.php?error=Please log in first");
    exit();
}

require_once '../src/controllers/TaskController.php';

$taskController = new TaskController();
$user_id = $_SESSION['user_id'];

$tasks = $taskController->handleDashboard($user_id);

$pageTitle = "Dashboard - Your Tasks";
$content = '<h5 class="text-center">Dashboard - Your Tasks</h5>';

if (file_exists('../views/task_form.php')) {
    ob_start(); 
    ?>
    <div class="row">
        <div class="col-md-6">
            <?php include('../views/task_form.php'); ?>
        </div>
        <div class="col-md-6">
            <?php
            $content .= ob_get_clean();
            ?>
        </div>
    </div>
    <?php
} else {
    $content .= '<p>Task creation form is missing.</p>';
}

if (file_exists('../views/tasks.php')) {
    ob_start();
    include('../views/tasks.php');
    $content .= ob_get_clean();
} else {
    $content .= '<p>No tasks to display.</p>';
}

include '../views/shared/layout.php'; 

?>
