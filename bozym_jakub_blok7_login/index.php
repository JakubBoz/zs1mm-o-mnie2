<?php
session_start();

$db = mysqli_connect("db.peciak.xyz", 'uczen', "d4552s7339", "logowanie");
$blad = "";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $haslo = isset($_POST['password']) ? $_POST['password'] : "";
    
    if ($login === "" && $haslo === ""){
        $blad = "Login i hasło nie może być puste";
    }
    if ($blad === ""){
        $sql = "SELECT * FROM uzytkownicy WHERE login = '$login' AND haslo = '$haslo'";

        $wynik = mysqli_query($db, $sql);
        $wiersz = mysqli_fetch_assoc($wynik);
    
        if ($wiersz){
            // użytkownik instnieje i jest zalogowany

            $_SESSION["login"] = $wiersz["login"];
            header("Location: panel.php");
        } else {
            $blad = "Zły login lub hasło";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body { 
            font-family: sans-serif; 
            margin: 2rem; 
        }
        form { 
            display: inline-block; 
        }
        label { 
            display: block; 
            margin-bottom: 0.5rem; 
        }
        .blad { 
            background: #f5d4d4; 
            padding: 0,5rem; 
            display: inline-block; 
        }
    </style>
</head>
<body>
<?php if ($blad !== ""): ?>
    <p class="blad"><?=$blad ?></p>
<?php endif; ?>
    <form method="post">
        <label>
            Login:
            <input type="text" name="login" required>
        </label>
        <label>
            Hasło:
            <input type="password" name="password" required>
        </label>
        <button type="submit">Zaloguj</button>
    </form>
</body>
</html>