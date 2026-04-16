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
2. Deschide folderul proiectului astfel incat aplicatia sa fie disponibila la o adresa de forma `http://localhost/Proiect de an/`.
3. Creeaza baza de date `studyplanner_db` in MySQL.
4. Importa fisierul `database/studyplanner_db.sql`.
5. Copiaza `app/config/db_config.example.php` in `app/config/db_config.php`.
6. Completeaza in `app/config/db_config.php` datele tale locale de conectare la MySQL.
7. Acceseaza `index.html` in browser.

## Configurarea bazei de date

Fisierul versionat in GitHub este `app/config/db_config.example.php`.

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

## Ce contine SQL-ul inclus

Fisierul SQL include schema minima necesara pentru aplicatie:

- tabelul `users`
- tabelul `tasks`
- cheile primare si relatia dintre taskuri si utilizatori

## Rulare

- Pagina principala: `index.html`
- Inregistrare: `register.php`
- Logare: `login.php`
- Dashboard dupa autentificare: `dashboard.php`
