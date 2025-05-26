<form method="POST" id="addTaskForm" class="container">
    <div class="mb-3">
        <label for="task_name" class="form-label">Task Name:</label>
        <input type="text" name="task_name" id="task_name" class="form-control" placeholder="Enter task name" required>
    </div>
    <div class="mb-3">
        <label for="task_description" class="form-label">Description:</label>
        <textarea name="task_description" id="task_description" class="form-control" rows="3" placeholder="Enter task description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="priority" class="form-label">Priority:</label>
        <select name="priority" id="priority" class="form-control" required>
            <option value="">Select Priority</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="due_date" class="form-label">Due Date:</label>
        <input type="date" name="due_date" id="due_date" class="form-control" required>
    </div>
    <div class="modal-footer px-0 pb-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="create_task" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Task
        </button>
    </div>
</form>

<?php
include '../views/shared/minimal_layout.php'; 
?>

<script>
    $('#addTaskModal').on('hidden.bs.modal', function () {
        $('#addTaskForm')[0].reset();
    });
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('due_date').setAttribute('min', today);
    });
</script>
