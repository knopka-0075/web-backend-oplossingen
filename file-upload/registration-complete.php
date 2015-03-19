<?php

session_start();

$dump = '';

	if (!isset($_COOKIE['login'])) {

		$mysql_con = mysql_connect('localhost', 'root', '');
		
		if ($mysql_con) {
			
			mysql_select_db('file_upload', $mysql_con);
			
			// Controlleren of de gebruiker al bestaat in de database
			$registrationEmail = mysql_real_escape_string($_SESSION['registration']['email']);
			
			$emailExistsQuery = mysql_query('SELECT * 
												FROM users
												WHERE email = "' . $registrationEmail . '"');
			
			if (!(mysql_num_rows($emailExistsQuery) > 0)) {
				
				$queryColumns = array();
				$queryColumnValues = array();
				
				foreach ($_SESSION['registration'] as $key => $value) {
				
					 $queryColumns[] = mysql_real_escape_string($key);
					 $queryColumnValues[] = '"' . mysql_real_escape_string($value) . '"';
				}
				
				$queryColumns = implode(',',$queryColumns);
				$queryColumnValues = implode(',',$queryColumnValues);
				
				// Eerst trackting details aanmaken voor het aanmaken van deze user
				$addTrackingDetails = mysql_query('INSERT INTO tracking_details 
													SET created_on = NOW(),
													is_active = 1,
													activated_on = NOW()');
				
				// De PK ophalen van van de tracking record die juist is aangemaakt
				$trackingDetailsId = mysql_insert_id();
				
				// De gebruiker toevoegen
				// user_type staat standaard op 2 (dit is een gewone gebruiker)
				// Superadmin = 0, admin = 1, deze kunnen alleen aangemaakt worden door een admin en superadmin 
				$addUser = mysql_query('INSERT INTO users (' . $queryColumns . ',
															user_type,
															tracking_details,
															last_login)
										VALUES (' . $queryColumnValues . ',
												2,
												' . $trackingDetailsId . ',
												NOW())');
				
				// De PK ophalen van de gebruiker die is toegevoegd
				$userId = mysql_insert_id();
				
				// De tracking_details record updaten met de PK van de gebruiker
				// Limit staat op 1 om fouten te voorkomen (update maximum ייn record)
				$updateTrackingDetails = mysql_query('UPDATE tracking_details 
													SET created_by_user_id = '.  $userId . ',
														activated_by_user_id = '.  $userId . '
													WHERE tracking_details.id = ' . $trackingDetailsId);
				
				if ($addUser) {
				
					mysql_select_db('file_upload', $mysql_con);
				
					//ophalen van de salt in de cms settings
					$passwordSalt = mysql_query('SELECT password_salt FROM cms_settings');
					
					$passwordSalt = mysql_fetch_array($passwordSalt);
					
					$passwordSalt = $passwordSalt[0];
		
					$hashedEmail = md5($_SESSION['registration']['email'] . $passwordSalt);
				
					setcookie('login', $_SESSION['registration']['email'] . ',' . $hashedEmail , time() + 60*60*24*30);
				
					$_SESSION['loginNotification'] = 'U bent succesvol ingeschreven en ingelogd.';
					header('location: dashboard.php');
				
				} else {
					
					$_SESSION['registrationNotification'] = 'Er ging iets mis tijdens het registreren. Probeer opnieuw.';
					header('location:registration.php');
				}
				
			} else {
				
				// Zeggen dat een e-mailadres al bestaat in de database mag in feite niet, omdat je zo mensen met kwade bedoelingen
				// meer informatie geeft. Dit gaat echter ten koste van de gebruiksvriendelijkheid. Je moet dus zelf afwegen of je
				// dit toont bij de registratie of niet.
				$_SESSION['registrationNotification'] = 'Dit e-mailadres bestaat reeds in onze database. Probeer opnieuw.';
				header('location:registration.php');
			};
			
			
	
		} else {
		
			$dump .= die('Could not connect: ' . mysql_error());
		}
	
	} else {
		
		//Wanneer de cookie al geset is, mag de persoon rechtstreeks naar het dashboard geredirect worden
		header('location: dashboard.php');
	}
	
echo $dump;

?>