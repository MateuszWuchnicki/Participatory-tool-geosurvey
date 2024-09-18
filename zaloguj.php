<?php

	session_start();
	//jezeli nie jest ustawiony login i haslo w globalnej tablicy POST to wróć do logowania
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: logowanie.php');
		exit(); //zakończ wykonywanie dalszego kodu
	}


	require_once "connect.php";
	$polaczenie = new SQLite3('user.db');
	
	
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8"); //encja html (znaki nie będą częścią htmla)
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

		
		$result = $polaczenie->query(sprintf("SELECT * FROM users WHERE login='%s' AND password='%s'",SQLite3::escapeString($login),SQLite3::escapeString($haslo)));
		//$result = $polaczenie->query("SELECT * FROM users ");
		$rowss = array();

		while ($row = $result->fetchArray()) {
  		  $rowss[] = $row;
		}


			if(!empty($rowss))
			{
				$_SESSION['zalogowany'] = true; //flaga - że jesteśmy zalogowani
				
				$wiersz = $result->fetchArray(SQLITE3_ASSOC);


		
				$_SESSION['id'] = $wiersz['id']; //- może posłużyć do zapisywania zmian w bazie
				$_SESSION['login'] = $wiersz['login'];
				$_SESSION['ilosc'] = $wiersz['ilosc'];
				$_SESSION['licznik'] = 0;

				//$_SESSION['dane'] = $wiersz['dane'];
			
				unset($_SESSION['blad']); //usuń zmienną z sesji (jeśli wszystko wyżej się zgadza)
				$result->finalize();
				header('Location: index.php'); //pamięta że jesteśmy już zalogowani
				
			} else {
				$_SESSION['blad'] = '<span style="color:red"; >Nieprawidłowy login lub hasło! </br>Spróbuj ponownie.</span>';
				header('Location: logowanie.php'); //wraca do logowania bo zle login/haslo
			}
			
		$polaczenie->close();
	// }
	
?>