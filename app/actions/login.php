<?php
require_once __DIR__ . '/../lib/security.php';
ensure_session_started();

require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../login.php');
}

if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    redirect_to('../../login.php?error=csrf');
}

$email = post_value('email');
$password = (string)($_POST['password'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
    redirect_to('../../login.php?error=invalid');
}

$stmt = $conn->prepare('SELECT id, username, password FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user || !password_verify($password, $user['password'])) {
    redirect_to('../../login.php?error=invalid');
}

session_regenerate_id(true);
$_SESSION['user_id'] = (int)$user['id'];
$_SESSION['username'] = $user['username'];

redirect_to('../../dashboard.php');
