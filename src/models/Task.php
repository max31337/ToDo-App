<?php
class Task {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createTask($user_id, $task_name, $task_description, $priority, $due_date) {
        $query = "INSERT INTO tasks (user_id, task_name, task_description, priority, due_date, completed)
                  VALUES (:user_id, :task_name, :task_description, :priority, :due_date, 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':task_name', $task_name);
        $stmt->bindParam(':task_description', $task_description);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':due_date', $due_date);
        return $stmt->execute();
    }

    public function getTasksByUser($user_id) {
        $query = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY due_date ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function markAsCompleted($task_id) {
        $query = "UPDATE tasks SET completed = 1 WHERE id = :task_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':task_id', $task_id);
        return $stmt->execute();
    }

    public function deleteTask($task_id) {
        $query = "DELETE FROM tasks WHERE id = :task_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':task_id', $task_id);
        return $stmt->execute();
    }
}
