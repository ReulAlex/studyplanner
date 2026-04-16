<?php
include '../database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Verificăm dacă utilizatorul există deja
    $checkQuery = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "Utilizatorul există deja!";
    } else {
        // Inserăm noul utilizator în baza de date
        $insertQuery = "INSERT INTO users (username, email, password) 
                        VALUES ('$username', '$email', '$password')";
        
        if ($conn->query($insertQuery) === TRUE) {
            // Autentificare automată după înregistrare
            $user_id = $conn->insert_id;
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "Eroare: " . $conn->error;
        }
    }
}
?>