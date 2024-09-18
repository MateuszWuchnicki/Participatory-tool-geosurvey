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
    <title>GEOANKIETA - ETAP</title>

    <link rel="stylesheet" type="text/css" href="css/mapa.css">

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
    <!--   <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' /> -->
    <!-- to musi wylecieć bo nakłada się na style leafleta -->

    <script src="libs/leaflet-src.js"></script>
    <link rel="stylesheet" href="libs/leaflet.css" />

    <script src="src/Leaflet.draw.js"></script>
    <link rel="stylesheet" href="dist/leaflet.draw.css" />

    <script src="src/Toolbar.js"></script>
    <script src="src/Tooltip.js"></script>

    <script src="src/ext/GeometryUtil.js"></script>
    <script src="src/ext/LatLngUtil.js"></script>
    <script src="src/ext/LineUtil.Intersect.js"></script>
    <script src="src/ext/Polygon.Intersect.js"></script>
    <script src="src/ext/Polyline.Intersect.js"></script>
    <script src="src/ext/TouchEvents.js"></script>

    <script src="src/draw/DrawToolbar.js"></script>
    <script src="src/draw/handler/Draw.Feature.js"></script>
    <script src="src/draw/handler/Draw.SimpleShape.js"></script>
    <script src="src/draw/handler/Draw.Polyline.js"></script>
    <script src="src/draw/handler/Draw.Circle.js"></script>
    <script src="src/draw/handler/Draw.Marker.js"></script>
    <script src="src/draw/handler/Draw.Polygon.js"></script>
    <script src="src/draw/handler/Draw.Rectangle.js"></script>


    <script src="src/edit/EditToolbar.js"></script>
    <script src="src/edit/handler/EditToolbar.Edit.js"></script>
    <script src="src/edit/handler/EditToolbar.Delete.js"></script>

    <script src="src/Control.Draw.js"></script>

    <script src="src/edit/handler/Edit.Poly.js"></script>
    <script src="src/edit/handler/Edit.SimpleShape.js"></script>
    <script src="src/edit/handler/Edit.Circle.js"></script>
    <script src="src/edit/handler/Edit.Rectangle.js"></script>
    <script src="src/edit/handler/Edit.Marker.js"></script>
    <script src="src/Leaflet-WFST.alpha.js"></script> <!-- biblioteka odpowiedzialna za WFS-T - nowsza wersja -->
    <!-- <script src="src/Leaflet-WFST.src.js"></script>  biblioteka odpowiedzialna za WFS-T  -->
    <script src="src/leaflet.geometryutil.js"></script> <!-- biblioteka jest konieczna do działania Leaflet-WFST -->

</head>

<body>
    <?php 
            $baza = './baza/generator.db'; 
            $db = new SQLite3($baza) or die('Nie mogę otworzyć bazy!'); 
        ?>

    <script type="text/javascript">
        <?php echo 'var licznik = '.json_encode($_POST['licznik']).';';?>
    </script>


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
        <div style="float: right; ">
            <?php
                echo "<p>Jesteś zalogowany jako <b>".$_SESSION['login'].' </b> &nbsp <a style="text-decoration: none; display: inline-block;
                width: 180px; padding: 5px 10px; margin-right: -40px; font-size: 16px; font-weight: bold; cursor: pointer; text-align: center; outline: none; 
                color: #fff; background-color: #bde247; border: none; border-radius: 15px;" href="logout.php">Wyloguj się!</a> </p>';
            ?>
        </div>
    </div>


    <div class="container">

        <div class="left-sidebar">
            <?php 
                $stan_licznika = $_POST['licznik'];
            ?>
            <h3>ETAP <?php echo 1+($stan_licznika)/2; ?></h3>
            <hr>
            <p class="question"><b>Pytanie <?php echo $stan_licznika+1; ?>:</b>
                <?php 
                    $stan_licznika = $_POST['licznik'];
                    $numer_pytania = 'pytanie'.($stan_licznika+1);
                    

                    $results = $db->query(sprintf("SELECT $numer_pytania FROM przyklad")); 
                    while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                    print_r($rows[$numer_pytania]);
                    };
                ?>
            </p>

            <button class="button1" onclick="drawPoint(); qid=<?php echo $stan_licznika+1; ?>">
                <img src="<?php
                    $stan_licznika = $_POST['licznik'];
                    $numer_punktu = 'punkt'.($stan_licznika+1);

                    $results = $db->query("SELECT $numer_punktu FROM przyklad"); 
                    while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                    print_r($rows[$numer_punktu]);
                    };
                    ?>" /> </br> Dodaj punkt </button>
            <br><br>
            <hr>

            <p class="question"><b>Pytanie <?php echo $stan_licznika+2; ?>:</b>
                <?php 
                    $stan_licznika = $_POST['licznik'];
                    $numer_pytania = 'pytanie'.($stan_licznika+2);  


                    $results = $db->query("SELECT $numer_pytania FROM przyklad"); 
                    while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                    print_r($rows[$numer_pytania]);
                    };
                ?>
            </p>
            <button class="button1" onclick="drawPoint(); qid= <?php echo $stan_licznika+2; ?>">
                <img src="<?php 
                    $stan_licznika = $_POST['licznik'];
                    $numer_punktu = 'punkt'.($stan_licznika+2);

                    $results = $db->query("SELECT $numer_punktu FROM przyklad"); 
                    while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                    print_r($rows[$numer_punktu]);
                    };
                    ?>" /> </br>Dodaj punkt</button>
            <br><br>
            <hr>

            <p class="question"> Jeśli zakończyłeś odpowiadania na wszystkie pytania kliknij przycisk <em><b>Przejdź dalej.</b></em></p>
            <br>

            <form id="sampleForm" name="sampleForm" action="etap.php" method="post">
                <input type="hidden" id="licznik" name="licznik" value="" />
            </form>

            <button class="button" onclick="window.location.href='index.php'">Powrót</button>
            <button class="button" onclick="przejscieDalej();">Przejdź dalej</button>
        </div>

        <div class="main">
            <div id="mapka">
                <div id="map" class="map"></div>
            </div>
        </div>


    </div>



    <div class="footer">
        Prawa autorskie | &copy; 2016
    </div>



    <!-- Poniższy kod php ma za zadnie uzyskanie dostępu do zmiennych sesyjnych -->
    <script type="text/javascript">
        <?php echo 'var uid = '.json_encode($_SESSION['login']).';';?>
        <?php echo 'var licznik = '.json_encode($_POST['licznik']).';';?>

        <?php
        $stan_licznika = $_POST['licznik'];
            
        $numer_punktu = 'punkt'.($stan_licznika+1);
        $results = $db->query("SELECT $numer_punktu FROM przyklad"); 
        while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
        print_r('var ikona1 = "'.$rows[$numer_punktu].'"; ');
        };

        
        $numer_punktu = 'punkt'.($stan_licznika+2);
        $results = $db->query("SELECT $numer_punktu FROM przyklad"); 
        while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
        print_r('var ikona2 = "'.$rows[$numer_punktu].'"; ');
        };

    ?>
    </script>

    <script type="text/javascript">
        var licznik = parseInt(licznik);
        licznik += 2;
        ilosc = <?php $results = $db->query("SELECT ilosc FROM przyklad"); while($rows = $results->fetchArray(SQLITE3_ASSOC)) { print_r($rows["ilosc"]);}; ?>;
        var ilosc = parseInt(ilosc);



        //fukncja onclick do przycisku dalej
        function setValue() {
            //id form.id imput.value
            document.sampleForm.center.value = mymap.getCenter();;
            document.sampleForm.zoom.value = mymap.getZoom();;
            document.forms["sampleForm"].submit();
        }



        function przejscieDalej() {
            if (licznik < ilosc) {
                document.sampleForm.licznik.value = licznik;
                document.forms["sampleForm"].submit();
            } else {
                location.href = 'koniec.php';
            }
        }
        document.onkeydown = przejscieDalej;
    </script>

    <script>
        <?php 
    $stan_licznika = $_POST['licznik'];
?>

        var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            osm = L.tileLayer(osmUrl, {
                maxZoom: 18,
                attribution: osmAttrib
            });
        map = new L.Map('map', {
            center: new L.<?php 
                    $results = $db->query("SELECT center FROM przyklad"); 

                    while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                    print_r($rows["center"]);
                    };
                ?>,
            zoom: <?php 
                    $results = $db->query("SELECT zoom FROM przyklad"); 

                    while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                    print_r($rows["zoom"]);
                    };
                ?>
        });




        //definicja ikony
        ikona_pytanie<?php echo $stan_licznika+1; ?> = L.icon({
            iconUrl: ikona1
        });
        ikona_pytanie<?php echo $stan_licznika+2; ?> = L.icon({
            iconUrl: ikona2
        });



        var pytanie<?php echo $stan_licznika+1; ?>_punkty = new L.WFST({
                url: 'http://167.114.239.68/geoserver/ows',
                typeNS: "ppgis",
                typeName: "punkty_ppgis_p<?php echo $stan_licznika+1; ?>g",
                crs: L.CRS.EPSG4326,
                geometryField: "the_geom",
                filter: new L.Filter.EQ().append('id_uzytkownika', uid)
            }).addTo(map)
            .once('load', function() {
                this.eachLayer(function(layer) {
                    layer.setIcon(ikona_pytanie<?php echo $stan_licznika+1; ?>)
                }); //TI musi byc w once('load') bo musi zaczekać aż elementy się załadują!
            })
            .on('click', function(event) {
                L.popup()
                    .setLatLng(event.latlng)
                    .setContent('Nazwa: ' + event.layer.feature.properties.nazwa)
                    .openOn(map);
            })
            .on('save:success', function(event) {
                this.eachLayer(function(layer) {
                    layer.setIcon(ikona_pytanie<?php echo $stan_licznika+1; ?>)
                });
            });

        var pytanie<?php echo $stan_licznika+2; ?>_punkty = new L.WFST({
                url: 'http://167.114.239.68/geoserver/ows',
                typeNS: "ppgis",
                typeName: "punkty_ppgis_p<?php echo $stan_licznika+2; ?>g",
                crs: L.CRS.EPSG4326,
                geometryField: "the_geom",
                filter: new L.Filter.EQ().append('id_uzytkownika', uid)
            }).addTo(map)
            .once('load', function() {
                this.eachLayer(function(layer) {
                    layer.setIcon(ikona_pytanie<?php echo $stan_licznika+2; ?>)
                }); //TI musi byc w once('load') bo musi zaczekać aż elementy się załadują!
            })
            .on('click', function(event) {
                L.popup()
                    .setLatLng(event.latlng)
                    .setContent('Nazwa: ' + event.layer.feature.properties.nazwa)
                    .openOn(map);
            })
            .on('save:success', function(event) {
                this.eachLayer(function(layer) {
                    layer.setIcon(ikona_pytanie<?php echo $stan_licznika+2; ?>)
                });
            });



        //obsługa dodawania punktów do bazy przez WFST
        map.on('draw:created', function(event) {
            var layer = event.layer;
            var type = event.layerType;
            if (qid == <?php echo $stan_licznika+1; ?> && type === 'marker') {
                save_layer = "pytanie<?php echo $stan_licznika+1; ?>_punkty";
                var formularz = L.popup(); //nowy popup jest tworzony niezależnie do obiektu na jego współrzędnych
                var content = '<input type="button" id="okBtn" value="Zapisz obiekt" onclick="saveData(' + save_layer + ')"> </input>' +
                    '<input type="button" id="okBtn" value="Anuluj" onclick="window.history.go()"/>';
                formularz.setContent(content);
                formularz.setLatLng(layer.getLatLng());
                formularz.openOn(map);
                layer.feature = {
                    properties: {}
                }; //inicjacja  miejsca na wpisanie atrybutów
                pytanie<?php echo $stan_licznika+1; ?>_punkty.addLayer(layer);
            } else if (qid == <?php echo $stan_licznika+2; ?> && type === 'marker') {
                save_layer = "pytanie<?php echo $stan_licznika+2; ?>_punkty";
                var formularz = L.popup(); //nowy popup jest tworzony niezależnie do obiektu na jego współrzędnych
                var content = '<input type="button" id="okBtn" value="Zapisz obiekt" onclick="saveData(' + save_layer + ')"> </input>' +
                    '<input type="button" id="okBtn" value="Anuluj" onclick="window.history.go()"/>';
                formularz.setContent(content);
                formularz.setLatLng(layer.getLatLng());
                formularz.openOn(map);
                layer.feature = {
                    properties: {}
                }; //inicjacja  miejsca na wpisanie atrybutów
                pytanie<?php echo $stan_licznika+2; ?>_punkty.addLayer(layer);
            };
        });





        L.control.scale().addTo(map);
        L.control.layers({
            'Mapa podkładowa OpenStreetMap': <?php 
                    $results = $db->query("SELECT mapa FROM przyklad"); 

                    while($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                    print_r($rows["mapa"]);
                    };
                ?>.addTo(map),
        }, {
            'Pokaż punkty z Pytania <?php echo $stan_licznika+1; ?>': pytanie<?php echo $stan_licznika+1; ?>_punkty,
            /*'Pokaż obszary z Pytania 1':pytanie1_poligony,*/ 'Pokaż punkty z Pytania <?php echo $stan_licznika+2; ?>': pytanie<?php echo $stan_licznika+2; ?>_punkty,
            /*'Pokaż obszary z Pytania 2':pytanie2_poligony*/
        }, {
            position: 'topright',
            collapsed: true
        }).addTo(map);






        //Poniższe funkcje zastępują standardowe przyciski z toolbara Leaflet.draw - można do niech dodać też standardowe opcje - póki co puste
        function drawPoint() {
            var pointDrawer = new L.Draw.Marker(map);
            pointDrawer.enable();
        }
        //funkcja zapisu danych - pobiera dane z formularza, dokleja do ostatnio dodanego obiektu (najwyższe id) i zapisuje
        function saveData(save_layer) {
            var form1 = $('#nazwa').val(); //jquery bierze wartość z formularza
            var form2 = $('#text1').val(); //jquery bierze wartość z formularza
            var form3 = $('#text2').val(); //jquery bierze wartość z formularza
            var drawings = save_layer.getLayers(); //wfst to warstwa z obiektami
            //ponizej dipisanie wartości do ostatniego dodanego obiektu
            drawings[drawings.length - 1].feature.properties.nazwa = form1;
            drawings[drawings.length - 1].feature.properties.text1 = form2;
            drawings[drawings.length - 1].feature.properties.text2 = form3;
            drawings[drawings.length - 1].feature.properties.id_uzytkownika = uid; //identyfikator zalogowanego użytkownika
            drawings[drawings.length - 1].feature.properties.id_pytania = qid; //identyfikator pytania
            drawings[drawings.length - 1].feature.properties.czas = aktualnyCzas(); //czas modyfikacji
            save_layer.save(); //zapis dopiero tutaj po wypełnieniu formularza
            map.closePopup();
            //location.reload();//dirty hack bo nie wiem jak wymusić zmianę stylu obecnie jeśli nie ma być save...
        }

        //Poniżej zdefiniowana funkcja zwraca sformatowaną aktualną datę i czas -->

        function aktualnyCzas() {
            var currentdate = new Date();
            var czas = currentdate.getDate() + "/" +
                (currentdate.getMonth() + 1) + "/" +
                currentdate.getFullYear() + " @ " +
                currentdate.getHours() + ":" +
                currentdate.getMinutes() + ":" +
                currentdate.getSeconds();
            return czas;
        }
    </script>

    </script>


</body>

</html>