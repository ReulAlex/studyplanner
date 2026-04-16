<?php
session_start();
include '../database/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $deadline = $_POST['deadline'] ?? null;
    $status = $_POST['status'] ?? 'de_facut';
    $priority = $_POST['priority'] ?? 'medie';

    $allowedStatus = ['de_facut', 'in_progres', 'finalizat'];
    $allowedPriority = ['mica', 'medie', 'mare'];

    if (!in_array($status, $allowedStatus, true)) {
        $status = 'de_facut';
    }

    if (!in_array($priority, $allowedPriority, true)) {
        $priority = 'medie';
    }

    if ($deadline === '') {
        $deadline = null;
    }

    if ($title !== '') {
        $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, deadline, status, priority) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $title, $description, $deadline, $status, $priority);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: ../dashboard.php");
exit();
?>