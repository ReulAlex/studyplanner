# Study Planner

Study Planner este o aplicatie web PHP pentru organizarea studiilor. Utilizatorii isi pot crea cont, se pot autentifica si isi pot gestiona taskurile intr-un dashboard simplu, cu deadline-uri, status si prioritati.

## Tehnologii folosite

- PHP
- MySQL
- HTML, CSS, JavaScript
- XAMPP pentru rulare locala

## Cerinte locale

- XAMPP instalat
- Apache si MySQL pornite din XAMPP Control Panel
- PHP 8.x recomandat
- phpMyAdmin sau alt client MySQL
## Instalare locala

1. Cloneaza repository-ul sau copiaza proiectul in `xampp/htdocs`.
2. Deschide folderul proiectului astfel incat aplicatia sa fie disponibila la `http://localhost/Proiect de an/`.
3. Creeaza baza de date `studyplanner_db` in MySQL si tabelele necesare.
4. Creeaza fisierul `app/config/db_config.php`.
5. Completeaza in `app/config/db_config.php` datele locale de conectare la MySQL.
6. Acceseaza `index.html` in browser.

## Configurarea bazei de date

Fisierul local folosit de aplicatie este `app/config/db_config.php`, iar acesta este ignorat de Git. Structura asteptata este:

```php
<?php
return [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'dbname' => 'studyplanner_db',
];
```

## Rulare

- Pagina principala: `index.html`
- Inregistrare: `register.php`
- Logare: `login.php`
- Dashboard dupa autentificare: `dashboard.php`
