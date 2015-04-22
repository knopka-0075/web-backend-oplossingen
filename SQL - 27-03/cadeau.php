<?php

	session_start();

	define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] );

	$db = new PDO('mysql:host=localhost;dbname=forum-06-03', 'root', '');

	$visibleChoice 	=	false;

	//CADEAUS OPHALEN UIT DATABASE OM TE LOOPEN IN FORM
	$queryShowCadeaus 	=	"SELECT cadeaus.cadeau_id, cadeaus.cadeau
								FROM cadeaus";

	$statementShowCadeaus	= $db->prepare($queryShowCadeaus);
	$statementShowCadeaus->execute();

	while ($row = $statementShowCadeaus->fetch(PDO::FETCH_ASSOC))
	{
		$cadeaus[] =	$row;
	}

	//GEBRUIKER_ID OPHALEN UIT DATABASE
	$queryFindUserId 	=	"SELECT gebruiker_id
								FROM gebruikers
								WHERE gebruiker_naam = :gebruikersnaam";

	$statementUserId 	=	$db->prepare($queryFindUserId);
	$statementUserId->bindvalue(':gebruikersnaam', $_SESSION['gebruiker']['gebruikersnaam']);
	$statementUserId->execute();

	while ($row = $statementUserId->fetch(PDO::FETCH_ASSOC))
	{
		$userId	=	$row;
	}

	$_SESSION['gebruiker']['id'] 	=	$userId['gebruiker_id'];
		
	//GEBRUIKER EN GEKOZEN CADEAU OPHALEN UIT DATABASE
	$queryUserCadeau 	=	"SELECT cadeaus.cadeau
								FROM cadeaus
								INNER JOIN cadeaukeuze
									ON cadeaukeuze.cadeau_id = cadeaus.cadeau_id
								INNER JOIN gebruikers
									ON gebruikers.gebruiker_id = cadeaukeuze.gebruiker_id
                                   WHERE gebruikers.gebruiker_id = :gebruiker_id";

    $statementUserCadeau 	=	$db->prepare($queryUserCadeau);

	$statementUserCadeau->bindvalue(':gebruiker_id', $_SESSION['gebruiker']['id']);

	$statementUserCadeau->execute();

	while ($row = $statementUserCadeau->fetch(PDO::FETCH_ASSOC))
	{
		$usercadeau	=	$row;
	}

	if ($_SESSION['gebruiker']['type'] == 'webmaster') {
		//ALLES WEERGEVEN VOOR WEBMASTER
		$queryShowAll 	=	"SELECT cadeaus.cadeau, gebruikers.gebruiker_naam
									FROM cadeaus
									INNER JOIN cadeaukeuze
										ON cadeaukeuze.cadeau_id = cadeaus.cadeau_id
									INNER JOIN gebruikers
										ON gebruikers.gebruiker_id = cadeaukeuze.gebruiker_id";

	    $statementShowAll 	=	$db->prepare($queryShowAll);

		$statementShowAll->execute();

		while ($row = $statementShowAll->fetch(PDO::FETCH_ASSOC))
		{
			$ShowAll[]	=	$row;
		}
	}

	if (empty($usercadeau))
	{
		$_SESSION['gebruiker']['cadeau'] 	=	'';
		$_SESSION['cadeau']['message'] 	=	"U heeft nog geen cadeau gekozen.";
		$visibleChoice 	=	true;

		if (isset($_POST['submit'])) 
		{
			//CADEAUKEUZE INSERTEN IN DATABASE
			$queryInsertCadeau 	=	"INSERT INTO cadeaukeuze (gebruiker_id, cadeau_id)
	  									VALUES (:gebruiker_id, :cadeau_id)";

	  		$statementInsertCadeau 	=	$db->prepare($queryInsertCadeau);
			$statementInsertCadeau->bindvalue(':gebruiker_id', $_SESSION['gebruiker']['id']);
			$statementInsertCadeau->bindvalue(':cadeau_id', $_POST['cadeau']);
			$statementInsertCadeau->execute();
			$visibleChoice 	=	false;
			header('Location: cadeau.php');
		}
	}

	else
	{
		$visibleChoice 	=	false;
		$_SESSION['gebruiker']['cadeau'] 	=	$usercadeau['cadeau'];
		$_SESSION['cadeau']['message'] 	=	"U heeft als cadeau gekozen voor een <span>" . $usercadeau['cadeau'] . "</span>.";

		if (isset($_POST['toggleChoice']))
		{
			$visibleChoice 	=	true;
		}

		elseif (isset($_POST['submit'])) 
		{
			//CADEAUKEUZE UPDATEN IN DATABASE
			$queryUpdateCadeau 	=	"UPDATE cadeaukeuze
										SET cadeau_id = :cadeau_id
										WHERE gebruiker_id = :gebruiker_id";

		 	$statementUpdateCadeau = $db->prepare($queryUpdateCadeau);
			$statementUpdateCadeau->bindvalue(':gebruiker_id', $_SESSION['gebruiker']['id']);
			$statementUpdateCadeau->bindvalue(':cadeau_id', $_POST['cadeau']);
			$statementUpdateCadeau->execute();
			
			$visibleChoice 	=	false;
			header('Location: cadeau.php');
		}
	}
	
	
	//var_dump($_POST);
	//var_dump($_SESSION);
	//var_dump($ShowAll);

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cadeau</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<header>
			<nav>
				<ul>
					<li><a href="login.php">Login</a></li>
					<li><a href="#">Forum</a></li>
				</ul>
			</nav>
		</header>

		<section>

			<h1>Cadeau</h1>
			<p>Dag <?= $_SESSION['gebruiker']['voornaam'] ?>!</p>
			<p><?= $_SESSION['cadeau']['message'] ?></p>

			<form class="cadeau" method="POST" action="<?= BASE_URL ?>">

				<?php if ($visibleChoice == false): ?>

					<input type="submit" name="toggleChoice" value="Keuze veranderen">

				<?php else: ?>

					<h1><label for="cadeau">Kies je cadeau</label></h1>
						<ul>
							<?php foreach ($cadeaus as $cadeau): ?>
								<li><input type="radio" name="cadeau" value="<?= $cadeau['cadeau_id'] ?>"><?= $cadeau['cadeau'] ?></li>
							<?php endforeach ?>
						</ul>

					<input type="submit" name="submit" value="Bevestigen">

				<?php endif ?>
			</form>

			<?php if ($_SESSION['gebruiker']['type'] == 'webmaster'): ?>
				<h1>Overzicht cadeaus</h1>
				<table>
					<tr class="hoofd">
						<td>User</td>
						<td>Gekozen cadeau</td>
					</tr>
					<?php foreach ($ShowAll as $user): ?>
						<tr>
							<td><?= $user['gebruiker_naam'] ?></td>
							<td><?= $user['cadeau'] ?></td>
						</tr>
					<?php endforeach ?>
				</table>
			<?php endif ?>
		</section>

	</body>
</html>