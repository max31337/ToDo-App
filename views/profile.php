<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once '../src/controllers/UserController.php';

$userController = new UserController();
$userDetails = $userController->getUserDetailsById($_SESSION['user_id']);

$content = '
<h2>Profile</h2>
<p>User Details:</p>
    <ul>
        <li><strong>Name:</strong> ' . htmlspecialchars($userDetails['name']) . '</li>
        <li><strong>Email:</strong> ' . htmlspecialchars($userDetails['email']) . '</li>
    </ul>
';

include('../views/shared/layout.php');
?>