<?php

session_start();

$dump = '';

$email = FALSE;
$generatedPassword = FALSE;

function generatePassword($numeric = TRUE, 
							$alphanumeric = FALSE, 
							$alphanumericUppercase = FALSE, 
							$specialChars = FALSE, 
							$length) {
	
	$passwordDump = ''; //Hierin komen alle willekeurige karakters van het paswoord te staan.
	
	$passwordCharacters = array(); //Hierin komen alle toegelaten arrays met karakters te staan.
	
	if ($numeric) {
		$passwordCharacters['numeric'] = array(0,1,2,3,4,5,6,7,8,9);
	}	
	
	if ($alphanumeric) {
		$passwordCharacters['alphanumericString'] = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	}	
	
	if ($alphanumericUppercase) {
		$passwordCharacters['alphanumericUppercaseString'] = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	}	
	
	if ($specialChars) {
		$passwordCharacters['specialChars'] = array('+','-','*','/','$','%','@','#','_');
	}
	
	$characterCount = 0;
	
	while ($characterCount < $length) {
	
		$arrayCount = 0; //Dient om de array in $passwordCharacters te kunnen overlopen. Wordt per keer de whilelus doorlopen wordt, weer op 0 gezet.
	
		foreach ($passwordCharacters as $value) { //Overloopt alle values (= array met alle toegestande karakters) in de array $passwordCharacters
		
			if ($characterCount < $length) { // Er mag een karakter toegevoegd worden aan de passwordDump zolang characterCount kleiner is dan de opgegeven lengte
			
				$randomCharacter = rand(0,(count($value)-1)); //Selecteert een willekeurige value uit de array met karakters. Het grootste random getal mag maximum zo groot zijn als de count van de array met karakters - 1 (nulwaarde van count() is altijd gelijk aan 1!)
				
				$passwordDump .= $value[$randomCharacter]; //Het willekeurige getal dat maximum zo groot is als het laatste karakter in de array moet toegevoegd worden aan de passwordDump
				
				$characterCount++; //Tel ééntje op bij de characterCount die bijhoudt hoeveel karakters er al gebruikt zijn
			}
			
			$arrayCount++; //Tel eentje op zodat de volgende array met karakters geselecteerd kan worden.
		}
	}
	
	$passwordDump = str_shuffle($passwordDump); //Zet alle karakters van een string in willekeurige volgorde. Garandeert optimale willekeurigheid.
	
	return $passwordDump; //Geef het gegenereerde paswoord terug aan de oproeper (caller) van de functie.
}

function hashPassword($password) {

	$mysql_con = mysql_connect('localhost', 'root');
	
	if ($mysql_con) {
	
		mysql_select_db('artikel_cms', $mysql_con);
		
		//ophalen van de salt in de cms settings
		$passwordSalt = mysql_query('SELECT password_salt FROM cms_settings');
		
		$passwordSalt = mysql_fetch_array($passwordSalt);
		
		$passwordSalt = $passwordSalt[0];
		
		//Concateneer het paswoord met de salt
		$password = $password . $passwordSalt;
		
		//Encodeer het nieuw gevormde paswoord via de md5 encryptie
		$password = md5($password);
		
		return $password;
		
	} else {
	
		$dump .= die('Could not connect: ' . mysql_error());
	}

}

if (isset($_POST['generate-password'])) {

	//Wanneer iemand op genereer paswoord heeft gedrukt moeten de reeds ingevulde waarden onthouden blijven (email)
	if ($_POST['email']) {
		$email = $_POST['email'];
	}
	
	//Er moet ook een paswoord gegenereerd worden.
	$generatedPassword = generatePassword(TRUE, TRUE, TRUE, TRUE, 14);
}

if (isset($_POST['submit'])) {
	
	foreach ($_POST as $key => $value) {
	
		switch ($key) {
			case 'submit': 
				// Wanneer de key submit is, moet er niets gebeuren (dit is de key van de submit-knop)
				break;
			case 'password':
				// Wanneer de key het paswoord is, moet deze eerst gehashed worden alvorens deze verder te gebruiken.
				// Dit is het veiligst omdat het paswoord dan op geen enkel moment blootgesteld staat
				$_SESSION['registration'][$key] = hashPassword(mysql_real_escape_string($value));
				break;
			default:
				//Wanneer de key niet gelijk is aan password of submit, mag deze zo in de sessie geplaatst worden (bv. bij e-mail)
				$_SESSION['registration'][$key] = mysql_real_escape_string($value);	
			}
			
	}
	
	header('location: registration-complete.php');
}	
	
	//Registratieveld
	$dump .= '<h1>Registreer online</h1>';
		
		if (isset($_SESSION['registrationNotification'])) {
			
			//Wanneer iemand van de log-outpagina komt of wanneer er iemand foutief inlogt, moet een boodschap getoond worden.
			//Wanneer iemand refresht moet deze boodschap verdwijnen. Werk daarom met de session en unset de key wanneer de boodschap wordt getoond.
			$dump .='<p>' . $_SESSION['registrationNotification'] . '</p>';
			unset($_SESSION['registrationNotification']);	
		}
	
	$dump .= '<form action="registration.php" method="post">
		<ul>
			<li>
				<label for="email">Email</label>
				<input type="text" name="email" id="email" ' . (($email)?'value="' . $email . '"':'') . '/>
			</li>
			
			<li>
				<label for="password">Paswoord</label>
				<input type="' . (($generatedPassword)?'text':'password') . '" name="password" id="password" ' . (($generatedPassword)?'value="' . $generatedPassword . '"':'') . '/>
				<input type="submit" name="generate-password" value="genereer een paswoord" />
			</li>
		
			<li>
				<input type="submit" name="submit" value="registreer" />
			</li>
		</ul>
	</form>';
	
echo $dump;

?>