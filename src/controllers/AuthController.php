<?php
require_once __DIR__ . '/../../config/database.php';  
require_once __DIR__ . '/../../src/models/User.php';  

class AuthController
{
    private $conn;
    private $userModel;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->userModel = new User($this->conn);
    }

    public function handleRequest() {
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
            header(header: "Location: ../../views/dashboard.php"); 
        } else {
            header("Location: /views/login.php?error=Invalid email or password");
            exit();
        }
    }

    public function register($name, $email, $password) {
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            exit();
        }

        if ($stmt->rowCount() > 0) {
            header("Location: ../../views/register.php?error=Email already exists");
            exit();
        }

        $result = $this->userModel->register($name, $email, $password);

        if ($result) {
            session_start();
            $_SESSION['user_id'] = $this->conn->lastInsertId();
    
            header("Location: ../../views/dashboard.php");
            exit();
        }

        header("Location: ../../views/register.php?error=Registration failed");
        exit();
    }
}

if (isset($_GET['action'])) {
    $authController = new AuthController();
    $authController->handleRequest();
}
?>
