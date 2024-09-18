<?php 


$baza = './baza/test.db'; 

$db = new SQLite3($baza) or die('Nie mogę otworzyć bazy!'); 

/* odbieramy dane z formularza */ 
	$plec = SQLite3::escapeString(trim($_POST['plec'])); 
	$wiek = SQLite3::escapeString(trim($_POST['wiek'])); 
	$miejsce = SQLite3::escapeString(trim($_POST['miejsce'])); 
	$wyksztalcenie = SQLite3::escapeString(trim($_POST['wyksztalcenie'])); 
 

/* zapisujemy dane do bazy */ 
	if($plec and $wiek and $miejsce and $wyksztalcenie) { 

		$results = $db->query(sprintf("INSERT INTO przyklad VALUES (NULL, '$plec', '$wiek', '$miejsce', '$wyksztalcenie')"))
		or die(SQLite3::escapeString($db));
		}
   
	var_dump($results);

	

/* powiadomienie o zapisie danych do bazy */ 
	if ($results) {
		echo "Dane zostały zapisane do bazy";			
	}
	else {
		echo "Dane nie zostały zapisane do bazy";

		}


$db->close(); 
?>