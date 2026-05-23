<?php
require_once __DIR__ . '/app/lib/security.php';
ensure_session_started();

require_once __DIR__ . '/app/config/db.php';

if (!isset($_SESSION['user_id'])) {
    redirect_to('login.php');
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];

$stmt = $conn->prepare(
    'SELECT id, title, description, deadline, status, priority, created_at
     FROM tasks
     WHERE user_id = ?
     ORDER BY CASE WHEN deadline IS NULL THEN 1 ELSE 0 END, deadline ASC, created_at DESC'
);
$stmt->bind_param('i', $userId);
$stmt->execute();
$resultTasks = $stmt->get_result();

$tasks = [];
while ($row = $resultTasks->fetch_assoc()) {
    $tasks[] = $row;
}
$stmt->close();

totalTasks = count($tasks);