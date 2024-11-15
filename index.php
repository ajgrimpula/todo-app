<?php
/* Displays tasks and allows user interactions like adding, completing, and deleting tasks. */
require 'todo.php';

// Handle form submission for adding a new task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $name = $_POST['name'];
    $priority = $_POST['priority'] ?? 1;
    if (!empty($name)) {
        addTask($name, $priority);
    }
}

// Handle URL actions for deleting or completing a task
if (isset($_GET['delete'])) {
    deleteTask($_GET['delete']);
} elseif (isset($_GET['complete'])) {
    completeTask($_GET['complete']);
}

// Determine sorting parameters from URL
$sortColumn = $_GET['sort'] ?? 'priority';
$sortOrder = $_GET['order'] ?? 'DESC';
$tasks = getTasks($sortColumn, $sortOrder);
list($totalTasks, $completedTasks) = getTaskCounts();

// Toggle sort order for the next click
function getSortOrder($currentOrder) {
    return $currentOrder === 'ASC' ? 'DESC' : 'ASC';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>To-Do List</h1>

    <!-- Task Form -->
    <form method="POST">
        <input type="text" name="name" placeholder="Enter task name" required>
        <select name="priority">
            <option value="3">High</option>
            <option value="2">Medium</option>
            <option value="1">Low</option>
        </select>
        <button type="submit" name="add_task">Add Task</button>
    </form>

    <!-- Display Total and Completed Task Counts -->
    <p>Total Tasks: <?= $totalTasks ?> | Completed Tasks: <?= $completedTasks ?></p>

    <!-- Task Table -->
    <table>
        <thead>
            <tr>
                <th><a href="?sort=name&order=<?= getSortOrder($sortOrder) ?>">Task Name</a></th>
                <th><a href="?sort=priority&order=<?= getSortOrder($sortOrder) ?>">Priority</a></th>
                <th><a href="?sort=completed&order=<?= getSortOrder($sortOrder) ?>">Status</a></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($tasks): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['name']) ?></td>
                        <td>
                            <?php
                            switch ($task['priority']) {
                                case 3: echo "High"; break;
                                case 2: echo "Medium"; break;
                                case 1: echo "Low"; break;
                            }
                            ?>
                        </td>
                        <td><?= $task['completed'] ? "Completed" : "Pending" ?></td>
                        <td>
                            <a href="?complete=<?= $task['id'] ?>">Complete</a> |
                            <a href="?delete=<?= $task['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">No tasks available.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>