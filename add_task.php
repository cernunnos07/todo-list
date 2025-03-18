<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = trim($_POST['task_name']);
    
    // Basic validation
    if (empty($task_name)) {
        die("Task cannot be empty");
    }
    
    try {
        $stmt = $conn->prepare("INSERT INTO tasks (task_name) VALUES (:task_name)");
        $stmt->bindParam(':task_name', $task_name);
        $stmt->execute();
        
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Error adding task: " . $e->getMessage());
    }
} else {
    // Redirect if accessed directly
    header("Location: index.php");
    exit();
}
?>