<?php
session_start();
include '../database/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $task_id = (int)($_POST['task_id'] ?? 0);
    $new_status = $_POST['new_status'] ?? 'de_facut';

    $allowedStatus = ['de_facut', 'in_progres', 'finalizat'];
    if (!in_array($new_status, $allowedStatus, true)) {
        $new_status = 'de_facut';
    }

    if ($task_id > 0) {
        $stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("sii", $new_status, $task_id, $user_id);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: ../dashboard.php");
exit();
?>