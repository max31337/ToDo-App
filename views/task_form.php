<form method="POST" class="mx-auto" style="max-width: 500px; padding: 8px; border: 1px solid #ccc; border-radius: 10px;">
    <h5 class="text-center" style="font-size: 16px; margin-bottom: 15px;">Add New Task</h5>    

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="task_name" style="font-size: 14px;">Task Name:</label>
                <input type="text" name="task_name" class="form-control" placeholder="Task Name" required style="height: 30px; font-size: 14px;">
            </div>
        </div>
    </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="task_description" style="font-size: 14px;">Description:</label>
                <textarea name="task_description" class="form-control" placeholder="Description" required style="height: 60px; font-size: 14px;"></textarea>
            </div>
        </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="priority" style="font-size: 14px;">Priority:</label>
                <select name="priority" class="form-control" required style="height: 30px; font-size: 14px;">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="due_date" style="font-size: 14px;">Due Date:</label>
                <input type="date" name="due_date" class="form-control" required style="height: 30px; font-size: 14px;">
            </div>
        </div>
    </div>

    <button type="submit" name="create_task" class="btn btn-primary btn-block" style="height: 35px; font-size: 14px;">Add Task</button>
</form>
