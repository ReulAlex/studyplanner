<?php
require_once __DIR__ . '/app/lib/security.php';
ensure_session_started();

$error = query_value('error');
$success = query_value('success');
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logare - Study Planner</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/landing.css">
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

    <main class="login-section">
        <div class="login-card">
            <div class="login-left">
                <p class="mini-title">Bine ai revenit</p>
                <h1>Logheaza-te si continua sa iti organizezi studiile.</h1>
                <p class="subtitle">
                    Intra in contul tau Study Planner si gestioneaza temele,
                    examenele si progresul intr-un singur loc.
                </p>
            </div>

            <div class="login-right">
                <form action="app/actions/login.php" method="POST" class="login-form">
                    <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">

                    <?php if ($error === 'invalid'): ?>
                        <p class="message error-message">Datele de autentificare nu sunt corecte.</p>
                    <?php elseif ($error === 'csrf'): ?>
                        <p class="message error-message">Sesiunea a expirat. Incearca din nou.</p>
                    <?php endif; ?>

                    <?php if ($success === 'registered'): ?>
                        <p class="message success-message">Contul a fost creat. Acum te poti loga.</p>
                    <?php endif; ?>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Introdu emailul" required>

                    <label for="password">Parola</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Introdu parola" required>
                        <span class="password-toggle-eye" onclick="togglePassword('password', this)">View</span>
                    </div>

                    <button type="submit" class="submit-btn">Logheaza-te</button>

                    <p class="register-link">
                        Nu ai cont?
                        <a href="register.php">Inregistreaza-te</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="assets/js/hamburger-menu.js"></script>
<script src="assets/js/password-view.js"></script>
</html>
