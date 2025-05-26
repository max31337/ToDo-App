<?php
$totalTasks = count($tasks);
$completedTasks = count(array_filter($tasks, fn($t) => $t['completed']));
$pendingTasks = $totalTasks - $completedTasks;

// Priority counts
$priorityCounts = ['low' => 0, 'medium' => 0, 'high' => 0];
foreach ($tasks as $task) {
    $priority = strtolower($task['priority']);
    if (isset($priorityCounts[$priority])) {
        $priorityCounts[$priority]++;
    }
}
?>
<div class="row mb-4">
    <div class="col-md-6">
        <canvas id="completionChart"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="priorityChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
const completed = <?php echo $completedTasks; ?>;
const pending = <?php echo $pendingTasks; ?>;
const priorities = <?php echo json_encode(array_values($priorityCounts)); ?>;
const priorityLabels = <?php echo json_encode(array_map('ucfirst', array_keys($priorityCounts))); ?>;

// Completion Chart (Pie)
new Chart(document.getElementById('completionChart'), {
    type: 'pie',
    data: {
        labels: ['Completed', 'Pending'],
        datasets: [{
            label: 'Tasks',
            data: [completed, pending],
            backgroundColor: ['#28a745', '#ffc107'],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            },
            title: {
                display: false
            }
        }
    }
});

// Priority Chart (Bar)
new Chart(document.getElementById('priorityChart'), {
    type: 'bar',
    data: {
        labels: priorityLabels,
        datasets: [{
            label: 'Number of Tasks',
            data: priorities,
            backgroundColor: ['#007bff', '#17a2b8', '#dc3545'],
            borderColor: ['#0056b3', '#138496', '#a71d2a'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>