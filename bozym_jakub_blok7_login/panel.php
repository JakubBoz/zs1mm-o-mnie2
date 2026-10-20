<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
</head>
<body>
    <h1>Witaj, <?php echo $_SESSION['login'] ?></h1>
    <a href="wyloguj.php">Wyloguj się</a>
</body>
</html>