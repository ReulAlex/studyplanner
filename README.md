# Study Planner

Study Planner este o aplicatie web PHP + MySQL pentru organizarea studiilor. Aplicatia permite creare de cont, autentificare si administrarea taskurilor intr-un dashboard simplu, cu deadline-uri, status si prioritati.

## Ce face

- creare cont si logare
- adaugare taskuri
- actualizare status taskuri
- stergere taskuri
- afisare progres general
- calendar cu deadline-uri

## Tehnologii

- PHP
- MySQL
- HTML
- CSS
- JavaScript
- XAMPP pentru rulare locala

## Instalare locala

1. Copiaza proiectul in `xampp/htdocs`.
2. Creeaza baza de date `studyplanner_db`.
3. Importa fisierul `database/schema.sql`.
4. Creeaza fisierul `app/config/db_config.php`.
5. Adauga configurarea locala:

```php
<?php
return [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'dbname' => 'studyplanner_db',
];
```

6. Porneste `Apache` si `MySQL` din XAMPP.
7. Acceseaza `http://localhost/Proiect de an/`.

## Structura utila

- `index.html` - pagina principala
- `register.php` - inregistrare
- `login.php` - autentificare
- `dashboard.php` - dashboard utilizator
- `app/actions` - actiuni pentru autentificare si taskuri
- `app/config/db.php` - conexiune baza de date
- `database/schema.sql` - schema bazei de date

## Observatii

- `app/config/db_config.php` este fisier local si nu se urca pe GitHub.
- parola utilizatorului este stocata hash-uit.
- formulararele folosesc protectie CSRF.
