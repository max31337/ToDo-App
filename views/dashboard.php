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
ob_start(); 
?> 

<div class="container-fluid">
    <div class="row">
        <!-- Left Column - Tasks -->
        <div class="col-lg-8 col-md-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-tasks me-2"></i>Your Tasks
                    </h5>
                    <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#addTaskModal">
                        <i class="fas fa-plus"></i> Add New Task
                    </button>
                </div>
                <div class="card-body">
                    <?php if (file_exists('../views/tasks.php')) { 
                        include('../views/tasks.php'); 
                    } else { 
                        echo '<div class="alert alert-info">No tasks to display.</div>'; 
                    } ?>
                </div>
            </div>
        </div>

        <!-- Right Column - Analytics -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Task Analytics
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (file_exists('../views/analytics.php')) {
                        include('../views/analytics.php'); 
                    } else {
                        echo '<div class="alert alert-info">Analytics not available.</div>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Task Form Modal -->
<?php if (file_exists('../views/task_form.php')): ?>
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">
                    <i class="fas fa-plus me-2"></i>Add New Task
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include('../views/task_form.php'); ?>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="alert alert-warning position-fixed" style="top: 20px; right: 20px; z-index: 1050;">
    Task creation form is missing.
</div>
<?php endif; ?>

<?php
$content = ob_get_clean();
include '../views/shared/layout.php'; 
?>