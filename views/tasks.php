<div>
    <h5 class="text-center">Your Tasks</h5>
    <?php if (empty($tasks)): ?>
        <p class="text-center">No tasks available.</p>
    <?php else: ?>
        <div class="table-responsive d-flex justify-content-center">
            <table class="table table-bordered table-striped table-sm" style="max-width: 100%; width: 80%; margin: 0 auto;">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($task['task_name']); ?></td>
                            <td><?php echo htmlspecialchars($task['task_description']); ?></td>
                            <td><?php echo ucfirst($task['priority']); ?></td>
                            <td><?php echo $task['due_date']; ?></td>
                            <td>
                                <?php if (!$task['completed']): ?>
                                    <a href="?complete_task=<?php echo $task['id']; ?>" class="btn btn-success btn-sm">Mark as Completed</a>
                                <?php else: ?>
                                    <span class="badge badge-success">Completed</span>
                                <?php endif; ?>
                                <a href="?delete_task=<?php echo $task['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
