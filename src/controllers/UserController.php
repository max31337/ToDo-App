<?php
require_once '../config/database.php';
require_once '../src/models/User.php';

class UserController
{
    private $userModel;

    public function __construct() {
        $db = new Database();
        $conn = $db->getConnection();
        $this->userModel = new User($conn);
    }

    public function getUserDetailsById($user_id) {
        return $this->userModel->getUserDetailsById($user_id);
    }
}
?>