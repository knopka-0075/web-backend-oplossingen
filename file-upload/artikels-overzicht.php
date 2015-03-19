<?php

session_start();

$dump = '<!DOCTYPE html>
<html>
<head>

<style>
	ul {
		margin:20px 0;
	}

	.non-active {
		background-color:lightgrey;
	}
</style>

</head>
	<body>';

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
				
				//TOP NAVIGATIE
				$dump .= 'Ingelogd als ' . $email . ' | <a href="logout.php">uitloggen</a><br />';
				$dump .= '<a href="dashboard.php">Terug naar overzicht</a><br />';
				
				$articleQuery = mysql_query('SELECT artikels.*, 
													tracking_details.is_active,
													tracking_details.is_archived
												FROM artikels 
												INNER JOIN tracking_details
												ON artikels.tracking_details = tracking_details.id
												WHERE tracking_details.is_archived = 0');
	
				// OVERZICHT VAN ALLE ARTIKELS
				$dump .= '<h1>Overzicht van alle artikels</h1>';
				
					if (isset($_SESSION['notification'])) {
							$dump .= $_SESSION['notification'];
							unset($_SESSION['notification']);
						}
				
				$dump .= '<a href="artikels-toevoegen-form.php">Voeg een artikel toe</a><br />
						<ul>';
				
				while ($row = mysql_fetch_assoc($articleQuery)) {
				
					
				
					//tracking_details en bijhorende informatie niet laten zien
					unset($row['tracking_details']);
				
					$dump .= '<li>
								<ul ' . (($row['is_active'] == 0)?'class="non-active"':'') . '>';
					
					foreach($row as $key => $value) {
						
						if ($key != 'id' && $key != 'is_active' && $key != 'is_archived') {
							$dump .= '<li>' . $key . ': ' . $value . '</li>';
						}
					}
					
					$dump .= '<li>
								<a href="artikels-wijzigen.php?artikel=' . $row['id'] . '">artikel wijzigen</a> | 
								<a href="artikels-activeren.php?artikel=' . $row['id'] . '">artikel ' . (($row['is_active'] == 0)?'':'de') . 'activeren</a> | 
								<a href="artikels-verwijderen.php?artikel=' . $row['id'] . '">artikel verwijderen</a>
							</li>';
					
					$dump .= '</ul>
						</li>';
				}
				
				$dump .= '</ul>';
								
				
			} else { // Automatisch uitloggen (cookie deleten), wanneer de cookie niet geldig is
				
				header('location:logout.php');
			}

		
	} else {
	
		//Wanneer de cookie niet geset is, moet er automatisch doorverwezen worden naar de login-pagina.
		header('location: login.php');
	}

$dump .='</body>
	</html>';
	
echo $dump;

?>