<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Benvenuto, <?php echo $username; ?></h1>
    </header>

    <section class="content">
        <p>Contenuto riservato della dashboard.</p>
    </section>

    <footer>
        <p>&copy; 2023 Il mio sito web. Tutti i diritti riservati.</p>
    </footer>
</body>
</html>

