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
    <title>GEOANKIETA - OPIS</title>
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
                $baza = 'baza/generator.db'; 
                $db = new SQLite3($baza) or die('Nie mogę otworzyć bazy!'); 

                $results = $db->query(sprintf("SELECT tytul FROM przyklad")); 
                while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                print_r($rows['tytul']);
                };
            ?>
        </p>
        <div style="float: right; ">
            <?php
                echo "<p>Jesteś zalogowany jako <b>".$_SESSION['login'].' </b> &nbsp <a style="text-decoration: none; display: inline-block;
                width: 180px; padding: 5px 10px; margin-right: -40px; font-size: 16px; font-weight: bold; cursor: pointer; text-align: center; outline: none; 
                color: #fff; background-color: #bde247; border: none; border-radius: 15px;" href="logout.php">Wyloguj się!</a> </p>';
            ?>
        </div>
    </div>




    <div class="container">
        <h2>Witaj Drogi Użytkowniku,</h2>
        <hr>
        <p style="font-size: 22px;">

            <?php 

            $baza = './baza/generator.db'; 

            $db = new SQLite3($baza) or die('Nie mogę otworzyć bazy!'); 

            $results = $db->query("SELECT start FROM przyklad"); 

            while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                print_r($rows["start"]);
                
            }; 

            ?>

        </p>
        </br>

        <form id="sampleForm" name="sampleForm" action="etap.php" method="post">
            <input type="hidden" id="licznik" name="licznik" value="" />
        </form>
        <hr>
        <center>
            <a href="#" style="display:inline-block; width:180px; padding:5px 10px; font-size:20px; font-weight:bold; cursor:pointer;
        text-align:center; outline:none; color:#fff; background-color:#bde247; border:none; border-radius: 15px; text-decoration:none;}" onclick="window.location.href='etap.php'; setValue();">Rozpocznij badanie</a>
        </center>
    </div>

    <div class="footer">
        Prawa autorskie | &copy; 2016
    </div>

    <script type="text/javascript">
        function setValue() {
            //id form.id imput.value
            document.sampleForm.licznik.value = 0;
            document.forms["sampleForm"].submit();
        }
    </script>


</body>

</html>