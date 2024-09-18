<?php 

$baza = 'baza/generator.db'; 

$db = new SQLite3($baza) or die('Nie mogę otworzyć bazy!'); 

//// Debugowanie - wyświetlenie dostępnych danych
//var_dump($_POST);

$tytul = isset($_POST['tytul']) ? SQLite3::escapeString(trim($_POST['tytul'])) : '';
$start = isset($_POST['start']) ? SQLite3::escapeString(trim($_POST['start'])) : '';
$koniec = isset($_POST['koniec']) ? SQLite3::escapeString(trim($_POST['koniec'])) : '';
$ilosc = isset($_POST['ilosc']) ? SQLite3::escapeString(trim($_POST['ilosc'])) : '';
$pytanie1 = isset($_POST['pytanie1']) ? SQLite3::escapeString(trim($_POST['pytanie1'])) : '';
$pytanie2 = isset($_POST['pytanie2']) ? SQLite3::escapeString(trim($_POST['pytanie2'])) : '';
$pytanie3 = isset($_POST['pytanie3']) ? SQLite3::escapeString(trim($_POST['pytanie3'])) : '';
$pytanie4 = isset($_POST['pytanie4']) ? SQLite3::escapeString(trim($_POST['pytanie4'])) : '';
$pytanie5 = isset($_POST['pytanie5']) ? SQLite3::escapeString(trim($_POST['pytanie5'])) : '';
$pytanie6 = isset($_POST['pytanie6']) ? SQLite3::escapeString(trim($_POST['pytanie6'])) : '';
$punkt1 = isset($_POST['punkt1']) ? SQLite3::escapeString(trim($_POST['punkt1'])) : '';
$punkt2 = isset($_POST['punkt2']) ? SQLite3::escapeString(trim($_POST['punkt2'])) : '';
$punkt3 = isset($_POST['punkt3']) ? SQLite3::escapeString(trim($_POST['punkt3'])) : '';
$punkt4 = isset($_POST['punkt4']) ? SQLite3::escapeString(trim($_POST['punkt4'])) : '';
$punkt5 = isset($_POST['punkt5']) ? SQLite3::escapeString(trim($_POST['punkt5'])) : '';
$punkt6 = isset($_POST['punkt6']) ? SQLite3::escapeString(trim($_POST['punkt6'])) : '';
$mapa = isset($_POST['mapa']) ? SQLite3::escapeString(trim($_POST['mapa'])) : '';
$center = isset($_POST['center']) ? SQLite3::escapeString(trim($_POST['center'])) : '';
$zoom = isset($_POST['zoom']) ? SQLite3::escapeString(trim($_POST['zoom'])) : '';

// Sprawdzenie, czy wszystkie wymagane dane są dostępne
if($tytul && $start && $mapa && $center && $zoom) { 
    $query = sprintf(
        "INSERT INTO przyklad (tytul, start, koniec, ilosc, pytanie1, pytanie2, pytanie3, pytanie4, pytanie5, pytanie6, punkt1, punkt2, punkt3, punkt4, punkt5, punkt6, mapa, center, zoom) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
        $tytul, $start, $koniec, $ilosc, $pytanie1, $pytanie2, $pytanie3, $pytanie4, $pytanie5, $pytanie6, $punkt1, $punkt2, $punkt3, $punkt4, $punkt5, $punkt6, $mapa, $center, $zoom
    );

    $results = $db->query($query);
    
    if ($results) {
        echo "<p style='font-size: 25px; font-weight: bold;'>Dane zostały zapisane do bazy!</p>
        <p style='font-size: 20px;'>Przejdź do Geoankiety - Panel logowania&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='logowanie.php' style='text-decoration: none; color: #FF451B;'>Link</a></p>";
    } else {
        echo "Dane nie zostały zapisane do bazy";
    }
} else {
    echo "Brak wymaganych danych.";
}

$db->close(); 

?>