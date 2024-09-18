<?php
    session_start();  
    //jeżeli nie jest zalogowany to wróc do strony logowania
    if (!isset($_SESSION['zalogowany'])) 
    {
        header('Location: logowanie.php');
        exit();//przekierowuje i wstrzymuje reszte kodu
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GEOANKIETA - PODZIĘKOWANIE</title>
    <link rel="stylesheet" type="text/css" href="css/start.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
</head>

<body>
    <div class="header">
        <p class="nag">
            <img class="logo" src="img/logo_1.png" alt="logo" />
            <?php 
                $baza = './baza/generator.db'; 
                $db = new SQLite3($baza) or die('Nie mogę otworzyć bazy!'); 

                $results = $db->query(sprintf("SELECT tytul FROM przyklad")); 
                while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                print_r($rows['tytul']);
                };
            ?>
        </p>
        <div style="float: right;">
            <?php
                echo "<p>Jesteś zalogowany jako <b>".$_SESSION['login'].' </b><br/></br> </p>';
            ?>
        </div>
    </div>




    <div class="container">
        <h2>Dziękujemy za udział w badaniu!</h2>
        <hr>
        <p style="font-size: 22px;">
            <?php 

                $baza = './baza/generator.db'; 

                $db = new SQLite3($baza) or die('Nie mogę otworzyć bazy!'); 

                $results = $db->query("SELECT koniec FROM przyklad"); 

                while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                    print_r($rows["koniec"]);
                }; 

            ?>
        </p>
        <br>
        <hr>
        <center>
            <button class="button" style="width: 220px;" onclick="window.location.href='logout.php' ">Wyloguj się </br> i zakończ badanie</button>
        </center>
    </div>

    <div class="footer">
        Prawa autorskie | &copy; 2016
    </div>

</body>

</html>