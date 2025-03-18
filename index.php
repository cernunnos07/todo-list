<?php
require_once 'db.php';

// Fetch all tasks
$stmt = $conn->prepare("SELECT * FROM tasks WHERE is_completed = 0 ORDER BY created_at DESC");
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch completed tasks
$stmt = $conn->prepare("SELECT * FROM tasks WHERE is_completed = 1 ORDER BY created_at DESC");
$stmt->execute();
$completed_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tektur:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h1>Todo List</h1>
        <div class="sidebar-item">New Task</div>
    </div>
    
    <div class="main-content">
        <div class="new-task-section">
            <h2>New Task</h2>
            <form action="add_task.php" method="POST">
                <input type="text" name="task_name" placeholder="Task">
                <button type="submit" class="add-task-btn">Add Task</button>
            </form>
        </div>
        
        <div class="task-lists-section">
            <h2>Task Lists</h2>
            <ul class="task-list">
                <?php foreach ($tasks as $task): ?>
                <li class="task-item">
                    <span class="task-name"><?php echo htmlspecialchars($task['task_name']); ?></span>
                    <div class="task-actions">
                        <a href="complete_task.php?id=<?php echo $task['id']; ?>" class="complete-btn">Complete</a>
                        <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="delete-btn">Delete</a>
                    </div>
                </li>
                <?php endforeach; ?>
                <?php if (count($tasks) === 0): ?>
                <li class="no-tasks">No tasks added yet.</li>
                <?php endif; ?>
            </ul>
        </div>
        
        <div class="completed-tasks-section">
            <h2>Completed Tasks</h2>
            <ul class="task-list">
                <?php foreach ($completed_tasks as $task): ?>
                <li class="task-item completed">
                    <span class="task-name"><?php echo htmlspecialchars($task['task_name']); ?></span>
                    <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="delete-btn">Delete</a>
                </li>
                <?php endforeach; ?>
                <?php if (count($completed_tasks) === 0): ?>
                <li class="no-tasks">No completed tasks yet.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</body>
</html>