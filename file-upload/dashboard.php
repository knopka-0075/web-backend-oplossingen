<?php

session_start();

$dump = '';

	if (isset($_COOKIE['login'])) {
	
			$mysql_con = mysql_connect('localhost', 'root', '');
		
			//EXTRA VEILIGHEID: controlleren of de cookie-gegevens kloppen
			//Zo vermijd je dat iemand die een cookie met key 'login' aanmaakt, willekeurig kan inloggen.
			//URL: javascript:document.cookie="login=myCookieValue" -> zal inloggen
			//Nadeel: wordt uitgevoerd elke keer de pagina wordt bezocht.
			
			mysql_select_db('file_upload', $mysql_con);
		
			//ophalen van de salt in de cms settings tabel
			$saltQuery = mysql_query('SELECT password_salt FROM cms_settings');
			
			$salt = mysql_fetch_array($saltQuery);
			
			$salt = $salt[0];
			
			$cookieExplode = explode(',', $_COOKIE['login']);
			
			$email = mysql_real_escape_string($cookieExplode[0]); // Moet geëscaped worden omdat deze waarde wordt gebruikt om het user_type uit de database op te halen
			$hashedEmail = $cookieExplode[1];
			
			//Controleren of de hash van de email + salt overeenkomen met die uit de cookie
			if (md5($email . $salt) == $hashedEmail) {
			
				// Achterhalen welk user_type de gebruiker is
				$userTypeQuery = mysql_query('SELECT users.user_type 
								FROM users
								WHERE email="' . $email . '"');
								
				$userTypeResult = mysql_fetch_assoc($userTypeQuery);

				if (isset($_SESSION['loginNotification'])) {
					
					//Wanneer iemand van de log-outpagina komt of wanneer er iemand foutief inlogt, moet een boodschap getoond worden.
					//Wanneer iemand refresht moet deze boodschap verdwijnen. Werk daarom met de session en unset de key wanneer de boodschap wordt getoond.
					$dump .='<p>' . $_SESSION['loginNotification'] . '</p>';
					unset($_SESSION['loginNotification']);	
				}
				
				$dump .= 'Ingelogd als ' . $email . ' | <a href="logout.php">uitloggen</a>';
				
				$dump .= '<ul>';
				$dump .= '<li><a href="artikels-overzicht.php">Artikels</a></li>';
				$dump .= '<li><a href="gegevens-wijzigen-form.php">Gegevens wijzigen</a></li>';
				
				if ($userTypeResult['user_type'] == 0 || $userTypeResult['user_type'] == 1) {
				
					$dump .= '<li><a href="gegevens-wijzigen-form.php">Overzicht van gebruikers</a></li>';
				
				}
				$dump .= '</ul>';
				
				
				
				
			} else { // Automatisch uitloggen (cookie deleten), wanneer de cookie niet geldig is
				
				header('location:logout.php');
			}

		
	} else {
	
		//Wanneer de cookie niet geset is, moet er automatisch doorverwezen worden naar de login-pagina.
		header('location: phpoefening030-login.php');
	}
	
echo $dump;

?>