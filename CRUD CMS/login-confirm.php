<?php

session_start();

$dump = '';

	if (!isset($_COOKIE['login'])) {
	
		$mysql_con = mysql_connect('localhost', 'root', '');
		
		mysql_select_db('artikel_cms', $mysql_con);
		
		//Zet de post-variabelen in een aparte variabele en zorg ervoor dat deze veilig zijn (mysql_real_escape_string())
		$emailPost = mysql_real_escape_string($_POST['email']);
		$passwordPost = mysql_real_escape_string($_POST['password']);

		//Ophalen van de gegevens van de user op basis van het e-mailadres
		$userDataQuery = mysql_query('SELECT * 
									FROM users 
									WHERE email = "' . $emailPost . '"');
	
		$userData = mysql_fetch_assoc($userDataQuery);	
		
		if ($userData) {
			
			//ophalen van de salt in de cms settings
			$passwordSalt = mysql_query('SELECT password_salt FROM cms_settings');
			
			$passwordSalt = mysql_fetch_array($passwordSalt);
			
			$passwordSalt = $passwordSalt[0];
			
			$hashedEmail = md5($emailPost . $passwordSalt);
			$hashedPassword = md5($passwordPost . $passwordSalt);
			
			if ($hashedPassword == $userData['password']) {
			
				mysql_query('UPDATE users
									SET last_login = NOW()
									WHERE email = "' . $emailPost . '"');
				
				setcookie('login', $emailPost . ',' . $hashedEmail , time() + 60*60*24*30);
				$_SESSION['loginNotification'] = 'U bent ingelogd.';
				header('location:dashboard.php');
				
			} else {
				
				//Wanneer het paswoord verkeerd is moet er een foutboodschap getoond worden op het login-formulier.
				$_SESSION['loginNotification'] = 'Het e-mail en/of paswoord zijn niet correct. Probeer opnieuw.';
				header('location:login.php');
			}
			
		} else {
			
			// Wanneer er geen user met dat e-mailadres wordt teruggevonden, heeft de gebruiker een fout e-mailadres ingevuld.
			// Meld dit dmv de sessie.
			
			$_SESSION['loginNotification'] = 'Het e-mail en/of paswoord zijn niet correct. Probeer opnieuw.';
			header('location:login.php');
		}
	
	} else {
		
		//Wanneer de cookie al geset is, moet de persoon automatisch naar het dashboard gestuurd worden.
		header('location:dashboard.php');
	}
	
echo $dump;

?>