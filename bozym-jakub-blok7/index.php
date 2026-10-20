<?php
$psy = [
    ['imie' => 'Reksio', 'wiek' => 3,  'rozmiar' => 'duzy'],
    ['imie' => 'Pusia',  'wiek' => 11, 'rozmiar' => 'maly'],
    ['imie' => 'Bary',   'wiek' => 7,  'rozmiar' => 'duzy'],
    ['imie' => 'Kropka', 'wiek' => 1,  'rozmiar' => 'maly'],
    ['imie' => 'Szarik', 'wiek' => 12, 'rozmiar' => 'duzy'],
    ['imie' => 'Fafik',  'wiek' => 5,  'rozmiar' => 'duzy'],
];

$blad = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie    = isset($_POST['imie'])    ? $_POST['imie']    : '';
    $wiek    = isset($_POST['wiek'])    ? $_POST['wiek']    : '';
    $rozmiar = isset($_POST['rozmiar']) ? $_POST['rozmiar'] : '';

    if ($imie === '') {
        $blad = 'Podaj imię psa.';
    } elseif (!ctype_digit($wiek) || (int) $wiek <= 0 || (int) $wiek > 20) {  /* Błąd 4: brakowało $wiek > 20 */
        $blad = 'Wiek to liczba całkowita od 0 do 20.';
    } elseif ($rozmiar !== 'maly' && $rozmiar !== 'duzy') {
        $blad = 'Wybierz rozmiar z listy.';
    } else {
    $psy[] = ['imie' => $imie, 'wiek' => (int) $wiek, 'rozmiar' => $rozmiar];
    } /* Błąd 8:  Brakowało else */
}

if (isset($_GET['rozmiar']) != '') {  //Błąd 7: Brakowało isset przed $_GET['rozmiar']
    $wybrane = [];
    foreach ($psy as $pies) {
        if ($pies['rozmiar'] === $_GET['rozmiar']) { /* Błąd 6: było === 'mały', gdy powinno być $_GET['rozmiar'] */
            $wybrane[] = $pies;
        }
    }
} else {
    $wybrane = $psy;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Schronisko Łapka</title>
    <link rel="stylesheet" href="styl.css">   <!-- Błąd 2: style zamiast styl -->
</head>
<body>
    <header>
        <h1>Schronisko Łapka</h1>
    </header>
    <nav>
        <a href="index.php">Wszystkie</a>
        <a href="index.php?rozmiar=maly">Małe</a>
        <a href="index.php?rozmiar=duzy">Duże</a>  <!--Błąd 3: herf  -->
    </nav>
    <main>
        <table>
            <thead>
                <tr><th>Imię</th><th>Wiek</th><th>Rozmiar</th></tr>
            </thead>
            <tbody>
<?php foreach ($wybrane as $pies): ?>
                <tr<?php if ($pies['wiek'] >= 10) echo ' class="senior"'; ?>>
                    <td><?php echo $pies['imie']; ?></td>
                    <td><?php echo $pies['wiek']; ?></td>
                    <td><?php echo $pies['rozmiar'] === 'maly' ? 'mały' : 'duży'; ?></td>
                </tr>
<?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr><td colspan="3">Psów w tabeli: <?php echo count($wybrane); ?></td></tr>
            </tfoot>
        </table>
    </main>
    <aside>
        <h2>Przyjmij psa do schroniska</h2>
<?php if ($blad !== ''): ?>
        <p class="blad"><?php echo $blad; ?></p>
<?php endif; ?>
        <form method="post">
            <label>Imię <input type="text" name="imie"></label>
            <label>Wiek <input type="number" name="wiek"></label>  <!--Błąd 5: w name="" było lata zamiast wiek  -->
            <label>Rozmiar
                <select name="rozmiar">
                    <option value="maly">mały</option>
                    <option value="duzy">duży</option>
                </select>
            </label>
            <button type="submit">Dodaj</button>
        </form>
    </aside>
    <footer>
        <p>Stronę wykonał: nazwisko_imie</p>
    </footer>
</body>
</html>
