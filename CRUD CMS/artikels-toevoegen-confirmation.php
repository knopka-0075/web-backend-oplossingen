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
				
				if (isset($_POST['submit'])) {

					$con = mysql_connect('localhost','root','');
					
					mysql_select_db('artikel_cms', $con);

					$_POST['datum'] = mysql_real_escape_string($_POST['jaar'])  . '-' . mysql_real_escape_string($_POST['maand']) . '-' . mysql_real_escape_string($_POST['dag']);

					//Door de post-variabelen die je niet meer nodig hebt te unsetten, zorg je ervoor dat je geen if-lussen meer moet integreren in je foreach
					unset($_POST['dag'], $_POST['maand'],$_POST['jaar'], $_POST['submit']);
					
					// Zet de keys van de post-variabel in aparte array
					// Dit is nodig om deze gemakkelijk in een update-query te verwerken.
					$columnArray = array();
					$valueArray = array();
					
					foreach ($_POST as $key => $value) {
						$columnArray[] = mysql_real_escape_string($key);
						$valueArray[] = '"' . mysql_real_escape_string($value) . '"';
					}
					
					// Om te weten wat het resultaat is van deze query, kan je hem altijd eens echoën.
					//echo ('INSERT INTO phpoefening028.artikels (' . implode(',',$columnArray) . ') VALUES (' . implode(',',$valueArray) . ')');
					
					// Eerst het userID ophalen van de gebruiker
					
					// Achterhalen welk user_type & id de gebruiker is
					$userIdQuery = mysql_query('SELECT users.id
													FROM users
													WHERE email="' . $email . '"');
					
					$userIdResult = mysql_fetch_assoc($userIdQuery);
					
					
					// Dan trackting details aanmaken voor het aanmaken van deze user
					$addTrackingDetails = mysql_query('INSERT INTO tracking_details 
														SET created_on = NOW(),
														created_by_user_id = ' . $userIdResult['id'] .',
														is_active = 1,
														activated_by_user_id = ' . $userIdResult['id'] . ',
														activated_on = NOW()');								
					
					// De PK ophalen van van de tracking record die juist is aangemaakt
					$trackingDetailsId = mysql_insert_id();
					
					$artikelQuery = mysql_query('INSERT INTO artikel_cms.artikels (' . implode(',',$columnArray) . ', tracking_details) 
												VALUES (' . implode(',',$valueArray) . ',' . $trackingDetailsId . ')');
					
					if ($artikelQuery) {
					
						$_SESSION['notification'] = 'Het artikel werd succesvol toegevoegd.<br />';
						header('location: artikels-overzicht.php');
					} else {
						
						$_SESSION['notification'] = 'Het artikel kon niet toegevoegd worden. Probeer opnieuw.<br />';
						header('location: artikels-toevoegen-form.php');
					}

					
				} else {
					
					$_SESSION['notification'] = 'Het artikel kon niet toegevoegd worden. Probeer opnieuw.<br />';
					header('location: artikels-toevoegen-form.php');
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