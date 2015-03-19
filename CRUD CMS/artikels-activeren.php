<?php

session_start();

$dump = '';

	if (isset($_COOKIE['login'])) {
	
			$mysql_con = mysql_connect('localhost', 'root', '');
		
			//EXTRA VEILIGHEID: controlleren of de cookie-gegevens kloppen
			//Zo vermijd je dat iemand die een cookie met key 'login' aanmaakt, willekeurig kan inloggen.
			//URL: javascript:document.cookie="login=myCookieValue" -> zal inloggen
			//Nadeel: wordt uitgevoerd elke keer de pagina wordt bezocht.
			
			mysql_select_db('artikel_cms', $mysql_con);
		
			//ophalen van de salt in de cms settings tabel
			$saltQuery = mysql_query('SELECT password_salt FROM cms_settings');
			
			$salt = mysql_fetch_array($saltQuery);
			
			$salt = $salt[0];
			
			$cookieExplode = explode(',', $_COOKIE['login']);
			
			$email = mysql_real_escape_string($cookieExplode[0]); // Moet geëscaped worden omdat deze waarde wordt gebruikt om het user_type uit de database op te halen
			$hashedEmail = $cookieExplode[1];
			
			//Controleren of de hash van de email + salt overeenkomen met die uit de cookie
			if (md5($email . $salt) == $hashedEmail) {			
				
				if (isset($_GET['artikel'])) {

					$con = mysql_connect('localhost','root','');
					
					mysql_select_db('artikel_cms', $con);

					$idQuery = mysql_query('SELECT id
								FROM users 
								WHERE email = "'.$email.'"');
								
					$idResult = mysql_fetch_assoc($idQuery);
					
					$userId = $idResult['id'];
					$articleId = mysql_real_escape_string($_GET['artikel']);
					
					$updateQuery = mysql_query('UPDATE artikels 
										INNER JOIN tracking_details
										ON artikels.tracking_details = tracking_details.id
										SET tracking_details.is_active = tracking_details.is_active ^ 1,
											tracking_details.activated_by_user_id = ' . $userId . ',
											tracking_details.activated_on = NOW()
										WHERE artikels.id = ' .$articleId);
										// ^ 1 is een bitwise operator die de value gaat togglen.
					
					if($updateQuery) {
					
						$_SESSION['notification'] = 'Het artikel is succesvol gewijzigd.<br />';
						header('location: artikels-overzicht.php');
					} else {
						
						$_SESSION['notification'] = 'Het artikel kon niet gewijzigd worden. Probeer opnieuw.<br />';
						header('location: artikels-overzicht.php');
					}
					
				} else {
					
					$_SESSION['notification'] = 'Het artikel kon niet gewijzigd worden. Probeer opnieuw.<br />';
					header('location: artikels-overzicht.php');
				}
								
				
			} else { // Automatisch uitloggen (cookie deleten), wanneer de cookie niet geldig is
				
				header('location:logout.php');
			}

		
	} else {
	
		//Wanneer de cookie niet geset is, moet er automatisch doorverwezen worden naar de login-pagina.
		header('location: login.php');
	}
	
echo $dump;

?>