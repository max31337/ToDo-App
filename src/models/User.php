<?php
class User {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function sanitizeEmail($email) {
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : false;
    }


    private function sanitizeName($name) {
        return htmlspecialchars(strip_tags($name));
    }

    private function isPasswordStrong($password) {
        return strlen($password) >= 8 && preg_match('/[A-Z]/', $password);
    }

    public function register($name, $email, $password) {
        $email = $this->sanitizeEmail($email);
        $name = $this->sanitizeName($name);

        if (!$email) {
            return ['success' => false, 'error' => 'Invalid email format'];
        }

        if (!$this->isPasswordStrong($password)) {
            return ['success' => false, 'error' => 'Password is too weak'];
        }

        if ($this->emailExists($email)) {
            return ['success' => false, 'error' => 'Email already exists'];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO " . $this->table . " (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);

        try {
            $stmt->execute();
            return ['success' => true];
        } catch (PDOException $e) {
            error_log("Registration failed: " . $e->getMessage());
            return ['success' => false, 'error' => 'Registration failed due to a server error'];
        }
    }

    public function login($email, $password) {
        $email = $this->sanitizeEmail($email);
        if (!$email) {
            return false;
        }

        $query = "SELECT id, password FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);

        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Optionally regenerate session ID here: session_regenerate_id(true);
                return $user['id'];
            }

            // Optional: delay to slow brute-force
            sleep(1);
        } catch (PDOException $e) {
            // Log the error if needed
        }

        return false;
    }

    public function getUserDetailsById($user_id) {
        $query = "SELECT id, name, email FROM " . $this->table . " WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function emailExists($email): bool {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }


    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
}
?>
