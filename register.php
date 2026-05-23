<?php
require_once __DIR__ . '/app/lib/security.php';
ensure_session_started();

$error = query_value('error');
$email = query_value('email');
$username = query_value('username');
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inregistrare - Study Planner</title>
    <link rel="stylesheet" href="assets/css/landing.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="assets/css/password.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Jost:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo">Study <span>Planner</span></div>
        <button class="hamburger-menu js-menu-toggle-btn" aria-label="Open mobile menu" aria-expanded="false">
            <span class="hamburger-menu__line"></span>
            <span class="hamburger-menu__line"></span>
            <span class="hamburger-menu__line"></span>
        </button>
        <nav class="nav" id="main-nav">
            <button class="nav-close-btn" aria-label="Inchide meniul">&times;</button>
            <ul>
                <li><a href="index.html#hero">Acasa</a></li>
                <li><a href="index.html#features">Caracteristici</a></li>
                <li><a href="index.html#results">Rezultate</a></li>
                <li><a href="index.html#testimonials">Recenzii</a></li>
                <li><a href="index.html#site-footer">Contact</a></li>
            </ul>
            <div class="nav-btn">
                <a class="btn-login" href="login.php">Logheaza-te</a>
                <a class="btn-signup" href="register.php">Inregistreaza-te</a>
            </div>
        </nav>
    </header>

    <main class="register-section">
        <div class="register-card">
            <div class="register-left">
                <p class="mini-title">Creeaza cont</p>
                <h1>Inregistreaza-te si incepe sa iti organizezi studiile.</h1>
                <p class="subtitle">
                    Creeaza-ti un cont Study Planner pentru a gestiona temele,
                    examenele si progresul tau intr-un singur loc.
                </p>
            </div>

            <div class="register-right">
                <form action="app/actions/register.php" method="POST" class="register-form">
                    <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">

                    <?php if ($error === 'invalid_input'): ?>
                        <p class="message error-message">Completeaza un nume si un email valid.</p>
                    <?php elseif ($error === 'weak_password'): ?>
                        <p class="message error-message">Parola trebuie sa aiba cel putin 8 caractere.</p>
                    <?php elseif ($error === 'password_mismatch'): ?>
                        <p class="message error-message">Parolele nu coincid.</p>
                    <?php elseif ($error === 'email_exists'): ?>
                        <p class="message error-message">Exista deja un cont cu acest email.</p>
                    <?php elseif ($error === 'csrf'): ?>
                        <p class="message error-message">Sesiunea a expirat. Incearca din nou.</p>
                    <?php endif; ?>

                    <label for="username">Nume utilizator</label>
                    <input type="text" id="username" name="username" placeholder="Introdu numele tau" value="<?php echo e($username); ?>" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Introdu emailul" value="<?php echo e($email); ?>" required>

                    <label for="password">Parola</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Creeaza o parola" required>
                        <span class="password-toggle-eye" onclick="togglePassword('password', this)">View</span>
                    </div>

                    <label for="confirm_password">Confirma parola</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeta parola" required>
                        <span class="password-toggle-eye" onclick="togglePassword('confirm_password', this)">View</span>
                    </div>

                    <button type="submit" class="submit-btn">Creeaza contul</button>

                    <p class="login-link">
                        Ai deja cont?
                        <a href="login.php">Logheaza-te</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="assets/js/hamburger-menu.js"></script>
<script src="assets/js/password-view.js"></script>
</html>
