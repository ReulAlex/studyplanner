<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logare - Study Planner</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="css/password.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Jost:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo">Study <span>Planner</span></div>
        <button
            class="hamburger-menu js-menu-toggle-btn"
            aria-label="Open mobile menu"
            aria-expanded="false"
        >
            <span class="hamburger-menu__line"></span>
            <span class="hamburger-menu__line"></span>
            <span class="hamburger-menu__line"></span>
        </button>
        <nav class="nav" id="main-nav">
            <button class="nav-close-btn" aria-label="Închide meniul">&times;</button>
            <ul>
                <li><a href="index.html#hero">Tablou de bord</a></li>
                <li><a href="index.html#features">Caracteristici</a></li>
                <li><a href="index.html#results">Rezultate</a></li>
                <li><a href="index.html#testimonials">Recenzii</a></li>
                <li><a href="index.html#site-footer">Contacte</a></li>
            </ul>
            <div class="nav-btn">
                <a class="btn-login" href="login.php">Loghează-te</a>
                <a class="btn-signup" href="register.php">Înregistrează-te</a>
            </div>
        </nav>
    </header>

    <main class="login-section">
        <div class="login-card">
            <div class="login-left">
                <p class="mini-title">Bine ai revenit</p>
                <h1>Loghează-te și continuă să-ți organizezi studiile.</h1>
                <p class="subtitle">
                    Intră în contul tău Study Planner și gestionează temele,
                    examenele și progresul tău într-un singur loc.
                </p>
            </div>

            <div class="login-right">
                <form action="php/login.php" method="POST" class="login-form">
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'email'): ?>
                        <p class="message error-message">Email inexistent!</p>
                    <?php endif; ?>

                    <?php if (isset($_GET['error']) && $_GET['error'] == 'parola'): ?>
                        <p class="message error-message">Parolă greșită!</p>
                    <?php endif; ?>

                    <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                        <p class="message success-message">Înregistrare reușită! Acum te poți loga.</p>
                    <?php endif; ?>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Introdu emailul" required>


                    <label for="password">Parolă</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Introdu parola" required>
                        <span class="password-toggle-eye" onclick="togglePassword('password', this)">👁️</span>
                    </div>

                    <button type="submit" class="submit-btn">Loghează-te</button>

                    <p class="register-link">
                        Nu ai cont?
                        <a href="register.php">Înregistrează-te</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="hamburger-menu.js"></script>
<script src="password-view.js"></script>
</html>