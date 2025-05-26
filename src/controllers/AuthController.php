<?php
require_once __DIR__ . '/../../config/database.php';  
require_once __DIR__ . '/../../src/models/User.php';  

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $db = new Database();
        $conn = $db->getConnection();
        $this->userModel = new User($conn);
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
            if ($_GET['action'] === 'register') {
                $this->register($_POST['name'], $_POST['email'], $_POST['password']);
            } elseif ($_GET['action'] === 'login') {
                $this->login($_POST['email'], $_POST['password']);
            }
        }
    }

    public function login($email, $password)
    {
        $user_id = $this->userModel->login($email, $password);

        if ($user_id) {
            session_start();
            $_SESSION['user_id'] = $user_id;
            header("Location: ../../views/dashboard.php");
        } else {
            header("Location: /views/login.php?error=Invalid email or password");
        }
        exit();
    }

    public function register($name, $email, $password) {
        $result = $this->userModel->register($name, $email, $password);

        if ($result['success']) {
            session_start();
            $_SESSION['user_id'] = $this->userModel->getLastInsertId();
            header("Location: ../../views/dashboard.php");
        } else {
            $error = urlencode($result['error']);
            header("Location: ../../views/register.php?error=$error");
        }
        exit();
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: ../public/index.php");
        exit();
    }
}

if (isset($_GET['action'])) {
    $authController = new AuthController();
    $authController->handleRequest();
}
