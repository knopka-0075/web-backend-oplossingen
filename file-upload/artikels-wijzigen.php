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
				
				if (isset($_GET['artikel'])) {
				
					//TOP NAVIGATIE
					$dump .= 'Ingelogd als ' . $email . ' | <a href="logout.php">uitloggen</a><br />';
					$dump .= '<a href="dashboard.php">Terug naar overzicht</a><br />';
				
					$con = mysql_connect('localhost','root','');
					
					mysql_select_db('file_upload', $con);
					
					$artikelId = mysql_real_escape_string($_GET['artikel']);

					$artikelQuery = mysql_query('SELECT *
													FROM artikels 
													WHERE artikels.id = '.$artikelId);
								
					$artikelResult = mysql_fetch_assoc($artikelQuery);
					
					$dump .= '<br /><a href="artikels-overzicht.php">Terug naar overzicht van artikels</a><br />';
					
					$dump .= '<h1>Artikel wijzigen</h1>';
					
					if (isset($_SESSION['notification'])) {
							$dump .= $_SESSION['notification'];
							unset($_SESSION['notification']);
						}
					
					
					
					$dump .= '<form action="artikels-wijzigen-confirm.php" method="post">
								<ul>';
					
					foreach ($artikelResult as $key => $value) {
						;
						
							if ($key != 'artikel' && $key != 'id' && $key != 'tracking_details') {
							
								$dump .= '<li>';
								$dump .= '<label for="' . $key . '">' . $key . '</label>
										<input type="text" name="' . $key . '" id="' . $key . '" value="' . $value . '" />';
								$dump .= '</li>';
								
							} elseif ($key == 'artikel') {
							
								$dump .= '<li>';
								$dump .= '<label for="' . $key . '">' . $key . '</label>
											<textarea name="' . $key . '" id="' . $key . '">' . $value . '</textarea>';
								$dump .= '</li>';
								
							} elseif ($key == 'id') {
							
								$dump .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />';
							}
							
					
					}
					
					$dump .= '</ul>
							<input type="submit" name="submit" value="wijzigen" />
							</form>';
					
					
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