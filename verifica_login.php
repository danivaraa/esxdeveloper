<?php
session_start();

$servername = "localhost";
$username = "nome_utente";
$password = "password";
$dbname = "miodatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT id, nome_utente, password FROM utenti WHERE nome_utente = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['nome_utente'];
        header("Location: dashboard.php");
    } else {
        echo "Password errata. <a href='login.html'>Riprova</a>";
    }
} else {
    echo "Nome utente non trovato. <a href='login.html'>Riprova</a>";
}

$conn->close();
?>
