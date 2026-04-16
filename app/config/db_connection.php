<?php
$configPath = __DIR__ . '/db_config.php';

if (!file_exists($configPath)) {
    die('Lipseste fisierul de configurare a bazei de date. Copiaza app/config/db_config.example.php in app/config/db_config.php si completeaza valorile locale.');
}

$config = require $configPath;

$host = $config['host'] ?? 'localhost';
$user = $config['user'] ?? 'root';
$pass = $config['pass'] ?? '';
$dbname = $config['dbname'] ?? 'studyplanner_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}
?>
