<?php

	session_start();

	define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] );

	$db = new PDO('mysql:host=localhost;dbname=forum-06-03', 'root', '');

	$voornaam 		=	'';
	$achternaam 	=	'';
	$email 			=	'';
	$gebruikersnaam =	'';
	$wachtwoord 	=	'';

	if (isset($_POST['registreer']))
	{
		$voornaam 		=	$_POST['voornaam'];
		$achternaam 	=	$_POST['achternaam'];
		$email 			=	$_POST['email'];
		$gebruikersnaam =	$_POST['gebruikersnaam'];
		$wachtwoord 	=	$_POST['wachtwoord'];

		$_SESSION['gebruiker']['voornaam']			=	$voornaam;
		$_SESSION['gebruiker']['achternaam']		=	$achternaam;
		$_SESSION['gebruiker']['gebruikersnaam']	=	$gebruikersnaam;

		$queryRegistreer = "INSERT INTO gebruikers
										   (gebruiker_voornaam, 
											gebruiker_achternaam, 
											gebruiker_email, 
											gebruiker_naam, 
											gebruiker_wachtwoord)
								VALUES (:voornaam, 
										:achternaam, 
										:email, 
										:gebruikersnaam, 
										MD5(:wachtwoord))";

		$statementRegistreer = $db->prepare($queryRegistreer);

		$statementRegistreer->bindValue(':voornaam', $voornaam);
		$statementRegistreer->bindValue(':achternaam', $achternaam);
		$statementRegistreer->bindValue(':email', $email);
		$statementRegistreer->bindValue(':gebruikersnaam', $gebruikersnaam);
		$statementRegistreer->bindValue(':wachtwoord', $wachtwoord);

		$statementRegistreer->execute();

		//Eindboodschap
		$lastId = $db->lastInsertId();

		if (isset ($lastId)) {
			$message = "Welkom " . $voornaam . "! U bent met succes geregistreerd op onze website. Veel plezier op het forum.";
		}
		else {
			$message = "Er ging iets mis bij het registreren. Probeer opnieuw of neem contact op met de <a href='mailto:demolink@mail.be'>webmaster</a>.";
		}
	}

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registreer</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<header>
			<nav>
				<ul>
					<li><a href="login.php">Login</a></li>
					<li><a href="#">Forum</a></li>
					<li><a href="<?php session_destroy(); ?>">Logout</a></li>
				</ul>
			</nav>
		</header>

		<section>
			
		<h1>Registreer</h1>

			<?php if (isset($_POST['registreer'])): ?>
				<?= $message ?>
			

			<?php else: ?>
				<form method="post" action="<?= BASE_URL?>">
					<label for="voornaam">Voornaam</label>
					<input type="text" name="voornaam" id="voornaam">

					<label for="achternaam">Achternaam</label>
					<input type="text" name="achternaam" id="achternaam">

					<label for="email">E-mail</label>
					<input type="text" name="email" id="email">

					<label for="gebruikersnaam">Gebruikersnaam</label>
					<input type="text" name="gebruikersnaam" id="gebruikersnaam">

					<label for="wachtwoord">Wachtwoord</label>
					<input type="password" name="wachtwoord" id="wachtwoord">

					<input type="submit" name="registreer" value="Registreer">
				</form>

				<form method="POST" action="<?= BASE_URL ?>">
					<button name="loginToggle">Heb je al een login? Log je dan hier in.</button>
				</form>
			<?php endif ?>

		</section>

	</body>
</html>