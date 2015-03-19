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
			
				//POPULATE SELECT MET OPTIONS GEVULD MET NUMERIEKE WAARDEN
				function populateSelect($start, $stop) {

					$start1 = $start;
					$stop1 = $stop;

					if (!(($start - $stop) < 0)) {
					
						$start1 = $stop;
						$stop1 = $start;
					}

					$dump = array();
					
					for ($i = $start1; $i <= $stop1; $i++) {
					
						$dump[] = '<option value="' . (($i<10)?'0':'') . $i . '">' . (($i<10)?'0':'') . $i . '</option>';
						//TOEVOEGING: zorg ervoor dat het aantal nullen wordt toegevoegd op basis van de lengte van het grootste getal.
					}
					
					if (!(($start - $stop) < 0)) {
					
						$dump = array_reverse($dump);
					}
					
					$dump = implode('',$dump);
					
					return $dump;

				}
			
				// Achterhalen welk user_type & id de gebruiker is
				$userTypeQuery = mysql_query('SELECT users.user_type 
												FROM users
												WHERE email="' . $email . '"');
								
				$userTypeResult = mysql_fetch_assoc($userTypeQuery);				
				
				//TOP NAVIGATIE
				$dump .= 'Ingelogd als ' . $email . ' | <a href="logout.php">uitloggen</a><br />';
				$dump .= '<a href="dashboard.php">Terug naar overzicht</a><br />';
				
				//ARTIKEL TOEVOEGEN FORM
				$dump .= '<h1>Voeg een artikel toe</h1>';
		
				if (isset($_SESSION['notification'])) {
					$dump .= $_SESSION['notification'];
					unset($_SESSION['notification']);
				}
				
				$dump .= '<form action="artikels-toevoegen-confirmation.php" method="post">
					<ul>	
						<li>
							<label for="titel">Titel</label>
							<input type="text" name="titel" id="titel" />
						</li>	
						<li>
							<label for="artikel">Artikel</label>
							<textarea name="artikel" id="artikel"></textarea>
						</li>	
						<li>
							<label for="kernwoorden">Kernwoorden</label>
							<input type="text" name="kernwoorden" id="kernwoorden" />
						</li>
						<li>
							d: <select name="dag">' . populateSelect(1,31) . '</select>
							
							m: <select name="maand">' . populateSelect(1,12) . '</select>
							
							j: <select name="jaar">' . populateSelect(2012,2001) . '</select>
						</li>
					</ul>
					
					<input type="submit" name="submit" value="verzenden" />
					</form>';
								
				
			} else { // Automatisch uitloggen (cookie deleten), wanneer de cookie niet geldig is
				
				header('location:logout.php');
			}

		
	} else {
	
		//Wanneer de cookie niet geset is, moet er automatisch doorverwezen worden naar de login-pagina.
		header('location: login.php');
	}
	
echo $dump;

?>