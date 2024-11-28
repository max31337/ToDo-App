<?php
require_once '../config/database.php';
require_once '../src/models/Task.php';

class TaskController
{
    private $conn;
    private $taskModel;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->taskModel = new Task($this->conn);
    }

    public function handleDashboard($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_task'])) {
            $this->createTask(
                $user_id,
                $_POST['task_name'],
                $_POST['task_description'],
                $_POST['priority'],
                $_POST['due_date']
            );
            header("Location: dashboard.php");
            exit();
        }

        if (isset($_GET['complete_task'])) {
            $this->completeTask($_GET['complete_task']);
            header("Location: dashboard.php");
            exit();
        }

        if (isset($_GET['delete_task'])) {
            $this->deleteTask($_GET['delete_task']);
            header("Location: dashboard.php");
            exit();
        }

        return $this->getTasks($user_id);
    }

    private function getTasks($user_id)
    {
        return $this->taskModel->getTasksByUser($user_id);
    }

    private function createTask($user_id, $task_name, $task_description, $priority, $due_date)
    {
        return $this->taskModel->createTask($user_id, $task_name, $task_description, $priority, $due_date);
    }

    private function completeTask($task_id)
    {
        return $this->taskModel->markAsCompleted($task_id);
    }

    private function deleteTask($task_id)
    {
        return $this->taskModel->deleteTask($task_id);
    }
}
?>
