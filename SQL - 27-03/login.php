<?php

	session_start();

	define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] );

	$db = new PDO('mysql:host=localhost;dbname=forum-06-03', 'root', '');

	$voornaam		=	'';
	$achternaam		=	'';
	$gebruikersnaam	=	'';
	$gebruikerstype	=	'';
	$email			=	'';
	$wachtwoord		=	'';

	$empty			=	false;

	if (isset($_POST['login']))
	{
		$gebruikersnaam =	$_POST['gebruikersnaam'];
		$wachtwoord 	=	$_POST['wachtwoord'];

		$queryLogin = "SELECT 	gebruiker_id, gebruiker_voornaam, gebruiker_achternaam, gebruiker_naam, gebruiker_type
						FROM 	gebruikers 
						WHERE 	gebruikers.gebruiker_naam = :gebruikersnaam
						AND 	gebruikers.gebruiker_wachtwoord = MD5(:wachtwoord)";

		$statementLogin = $db->prepare($queryLogin);

		$statementLogin->bindValue(':gebruikersnaam', $gebruikersnaam);
		$statementLogin->bindValue(':wachtwoord', $wachtwoord);

		$statementLogin->execute();

		$gebruikers	=	array();

		while ($row = $statementLogin->fetch(PDO::FETCH_ASSOC))
		{
			$gebruikers	=	$row;
		}

		if (empty($gebruikers)) 
		{
			$empty = true;
		}

		else
		{
			$_SESSION['gebruiker']['voornaam']			=	$gebruikers['gebruiker_voornaam'];
			$_SESSION['gebruiker']['achternaam']		=	$gebruikers['gebruiker_achternaam'];
			$_SESSION['gebruiker']['gebruikersnaam']	=	$gebruikers['gebruiker_naam'];
			$_SESSION['gebruiker']['type']				=	$gebruikers['gebruiker_type'];
		}
	}

	if (isset($_POST['registreer']))
	{
		$voornaam		=	$_POST['voornaam'];
		$achternaam		=	$_POST['achternaam'];
		$email			=	$_POST['email'];
		$gebruikersnaam	=	$_POST['gebruikersnaam'];
		$wachtwoord		=	$_POST['wachtwoord'];
		$type			=	$_POST['type'];

		$queryRegistreer = "INSERT INTO gebruikers
											(gebruiker_voornaam, 
											gebruiker_achternaam, 
											gebruiker_email, 
											gebruiker_naam, 
											gebruiker_wachtwoord,
											gebruiker_type)
								VALUES	(:voornaam, 
										:achternaam, 
										:email, 
										:gebruikersnaam, 
										MD5(:wachtwoord),
										:type)";

		$statementRegistreer = $db->prepare($queryRegistreer);

		$statementRegistreer->bindValue(':voornaam', $voornaam);
		$statementRegistreer->bindValue(':achternaam', $achternaam);
		$statementRegistreer->bindValue(':email', $email);
		$statementRegistreer->bindValue(':gebruikersnaam', $gebruikersnaam);
		$statementRegistreer->bindValue(':wachtwoord', $wachtwoord);
		$statementRegistreer->bindValue(':type', $type);

		$statementRegistreer->execute();

		$_SESSION['gebruiker']['voornaam']			=	$voornaam;
		$_SESSION['gebruiker']['achternaam']		=	$achternaam;
		$_SESSION['gebruiker']['gebruikersnaam']	=	$gebruikersnaam;
		$_SESSION['gebruiker']['type']				=	$type;

		$lastId = $db->lastInsertId();

		if (isset ($lastId)) {
			$message = "Welkom " . $voornaam . "! U bent met succes geregistreerd op onze website. Veel plezier op het forum.";
		}
		else {
			$message = "Er ging iets mis. Probeer opnieuw of neem contact op met de <a href='mailto:demolink@mail.be'>webmaster</a>.";
		}
	}

	if (isset($_SESSION['gebruiker'])) 
	{
		$voornaam		=	$_SESSION['gebruiker']['voornaam'];
		$achternaam		=	$_SESSION['gebruiker']['achternaam'];
		$gebruikersnaam	=	$_SESSION['gebruiker']['gebruikersnaam'];
		$gebruikerstype	=	$_SESSION['gebruiker']['type'];

		if ($gebruikerstype == 'webmaster')
		{
			$queryAdmin = "SELECT	gebruiker_voornaam, gebruiker_achternaam, gebruiker_naam, gebruiker_type, gebruiker_email
							FROM	gebruikers";

			$statementAdmin = $db->prepare($queryAdmin);

			$statementAdmin->execute();

			$alleGebruikers = array();

			while ( $row = $statementAdmin->fetch( PDO::FETCH_ASSOC ) )
				{
					$alleGebruikers[]	=	$row;
				}
		}
	}

	$lastId = $db->lastInsertId();

	if (isset ($lastId))
	{
		$message = "Welkom " . $voornaam . "! U bent met succes ingelogd op onze website. Veel plezier op het forum.";
	}
	
	else
	{
		$message = "Er ging iets mis. Probeer opnieuw of neem contact op met de <a href='mailto:demolink@mail.be'>webmaster</a>.";
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header('location: ' . "login.php");
	}

	//var_dump($_SESSION);

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<header>
			<nav>
				<ul>
					<li><a href="<?= BASE_URL ?>">Login</a></li>
					<li><a href="#">Forum</a></li>
				</ul>
			</nav>
		</header>

		<section>
			<?php if (!isset($_SESSION['gebruiker'])): ?>

				
				<?php if (isset($_POST['registerToggle'])): ?>
					<!-- REGISTREERSCHERM -->

					<h1>Registreer</h1>

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

						<input type="hidden" name="type" id="type" value="gebruiker">

						<input type="submit" name="registreer" value="Registreer">
					</form>

					<form method="POST" action="<?= BASE_URL ?>">
						<button class="toggle" name="loginToggle">Heb je al een login? Log je dan hier in.</button>
					</form>

				<?php else: ?>
					<!-- DEFAULT - LOGINSCHERM -->

					<h1>Login</h1>

					<?php if ( isset($_POST['login']) && $empty == true): ?>
						<!-- FOUTMELDING BIJ FOUTE COMBINATIE WACHTWOORD GEBRUIKERSNAAM -->
						<p class="foutmelding">De combinatie van uw gebruikersnaam en wachtwoord klopt niet, probeer opnieuw:</p>
					<?php endif ?>

					<form class="login" method="post" action="<?= BASE_URL?>">
						<label for="gebruikersnaam">Gebruikersnaam</label>
						<input type="text" name="gebruikersnaam" id="gebruikersnaam">
							
						<label for="wachtwoord">Wachtwoord</label>
						<input type="password" name="wachtwoord" id="wachtwoord">

						<input type="submit" name="login" value="Inloggen">
					</form>

					<form method="POST" action="<?= BASE_URL ?>">
						<button class="toggle" name="registerToggle">Heb je nog geen login? Registreer dan hier.</button>
					</form>

			<?php endif ?>

			<?php elseif ($gebruikerstype == 'gebruiker'): ?>
				<!-- WELKOM GEBRUIKER -->
				<h1>Welkom</h1>
				<p class="welcome"><?= $message ?></p>
			
			
			<?php elseif ($gebruikerstype == 'webmaster'): ?>
				<!-- WELKOM ADMIN -->
				<h1>Admin</h1>
				<p class="welcome">Welkom webmaster!</p>

				<table>
					<thead>
						<tr>
							<td>Aantal</td>
							<?php foreach ($alleGebruikers[0] as $key => $persoon): ?>
								<td><?= $key ?></td>
							<?php endforeach ?>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($alleGebruikers as $key => $persoon): ?>
							<tr class="<?php if (($key+1)%2 != 0): ?>odd<?php endif ?>">
								<td><?= ($key + 1) ?></td>

								<?php foreach ($persoon as $detail): ?>
									<td><?= $detail ?></td>
								<?php endforeach ?>
							</tr>
						<?php endforeach ?>
					</tbody>

				</table>
			<?php endif ?>

			<?php if (isset($_SESSION['gebruiker'])): ?>
				<form method="post" action="<?= BASE_URL?>">
				<button name="logout">Log Out</button>
			</form>
			<?php endif ?>

			<p>Kies je <a href="cadeau.php">eindejaarscadeau</a>!</p>

		</section>

	</body>
</html>