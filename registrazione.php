<?php
$servername = "localhost";
$username = "nome_utente";
$password = "password";
$dbname = "miodatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO utenti (nome_utente, email, password) VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registrazione avvenuta con successo.";
} else {
    echo "Errore durante la registrazione: " . $conn->error;
}

$conn->close();
?>