<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare - Study Planner</title>
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="css/register.css">
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

    <main class="register-section">
        <div class="register-card">
            <div class="register-left">
                <p class="mini-title">Creează cont</p>
                <h1>Înregistrează-te și începe să-ți organizezi studiile.</h1>
                <p class="subtitle">
                    Creează-ți un cont Study Planner pentru a gestiona temele,
                    examenele și progresul tău într-un singur loc.
                </p>
            </div>

            <div class="register-right">
                <form action="php/register.php" method="POST" class="register-form">
                    <label for="username">Nume utilizator</label>
                    <input type="text" id="username" name="username" placeholder="Introdu numele tău" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Introdu emailul" required>


                    <label for="password">Parolă</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Creează o parolă" required>
                        <span class="password-toggle-eye" onclick="togglePassword('password', this)">👁️</span>
                    </div>

                    <button type="submit" class="submit-btn">Înregistrează-te</button>

                    <p class="login-link">
                        Ai deja cont?
                        <a href="login.php">Loghează-te</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="hamburger-menu.js"></script>
<script src="password-view.js"></script>
</html>