<?php
require_once 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $task_id = $_GET['id'];
    
    try {
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindParam(':id', $task_id);
        $stmt->execute();
        
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Error deleting task: " . $e->getMessage());
    }
} else {
    // Redirect if no valid ID provided
    header("Location: index.php");
    exit();
}
?>
