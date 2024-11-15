<?php
/* Contains the backend logic for adding, deleting, and completing tasks. */
require 'database.php';

$db = getDBConnection();

// Function to add a task
function addTask($name, $priority) {
    global $db;
    $stmt = $db->prepare("INSERT INTO tasks (name, priority) VALUES (?, ?)");
    return $stmt->execute([$name, $priority]);
}

// Function to delete a task
function deleteTask($id) {
    global $db;
    $stmt = $db->prepare("DELETE FROM tasks WHERE id = ?");
    return $stmt->execute([$id]);
}

// Function to mark a task as completed
function completeTask($id) {
    global $db;
    $stmt = $db->prepare("UPDATE tasks SET completed = 1 WHERE id = ?");
    return $stmt->execute([$id]);
}

// Function to fetch all tasks with sorting
function getTasks($sortColumn = 'priority', $sortOrder = 'DESC') {
    global $db;
    $validColumns = ['name', 'priority', 'completed'];
    if (!in_array($sortColumn, $validColumns)) {
        $sortColumn = 'priority';
    }
    $sortOrder = strtoupper($sortOrder) === 'ASC' ? 'ASC' : 'DESC';

    $query = "SELECT * FROM tasks ORDER BY $sortColumn $sortOrder, name ASC";
    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

// Get total and completed task counts
function getTaskCounts() {
    $tasks = getTasks();
    $totalTasks = count($tasks);
    $completedTasks = count(array_filter($tasks, fn($task) => $task['completed'] == 1));
    return [$totalTasks, $completedTasks];
}
?>