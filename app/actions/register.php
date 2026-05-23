<?php
require_once __DIR__ . '/../lib/security.php';
ensure_session_started();

require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../register.php');
}

if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    redirect_to('../../register.php?error=csrf');
}

$username = post_value('username');
$email = strtolower(post_value('email'));
$password = (string) ($_POST['password'] ?? '');
$confirmPassword = (string) ($_POST['confirm_password'] ?? '');

$redirectBase = [
    'username' => $username,
    'email' => $email,
];

if ($username === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_to(build_redirect_url('../../register.php', $redirectBase + ['error' => 'invalid_input']));
}

if (strlen($password) < 8) {
    redirect_to(build_redirect_url('../../register.php', $redirectBase + ['error' => 'weak_password']));
}

if ($password !== $confirmPassword) {
    redirect_to(build_redirect_url('../../register.php', $redirectBase + ['error' => 'password_mismatch']));
}

$stmt = $conn->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
$emailExists = $stmt->num_rows > 0;
$stmt->close();

if ($emailExists) {
    redirect_to(build_redirect_url('../../register.php', $redirectBase + ['error' => 'email_exists']));
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $username, $email, $passwordHash);
$stmt->execute();
$userId = (int) $stmt->insert_id;
$stmt->close();

session_regenerate_id(true);
$_SESSION['user_id'] = $userId;
$_SESSION['username'] = $username;

redirect_to('../../dashboard.php?welcome=registered');
