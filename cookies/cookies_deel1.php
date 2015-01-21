<?php 


	if (isset($_GET['logout'])) {
	
			setcookie('identification','', time() - 360 );
			
			header('location: cookies_deel1.php');

	}

	$loginFile	=	file_get_contents( 'cookies_deel1.txt' );
	$loginExplode	=	explode( ',', $loginFile );

	$message			=	false;
	$isIdentification		=	false;

	if (isset( $_COOKIE['identification'] ) ) 
	{
		if ( isset( $_POST[ 'submit' ] ) )
		{
		
			if ( $_POST[ 'username' ] == $userData[ 0 ] && $_POST[ 'password' ] == $userData[ 1 ] )
				{
					setcookie( 'identification', true, time() +360 );
					header( 'location: ' . $_SERVER[ 'PHP_SELF '] );
				}
			else 
				{
				
					$message = 'Paswoord niet correct. Probeer opnieuw.';
				}
		}
	}

	else

	{
		$message			=	'U bent ingelogd.';
		$isIdentification	=	true;
	}


?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Untitled Document</title>
</head>

<body>

	<?php if ($message): ?>
			<?=	$message ?>
		<?php endif ?>

		<?php if ( !$isIdentification ): ?>
	
    <form action=" $_SERVER['PHP_SELF']" method="POST">

			<ul>
				<li>
					<label for="gebruikersnaam">Gebruikersnaam:</label>
					<input type="text" name="gebruikersnaam" id="gebruikersnaam">
				</li>
				<li>
					<label for="password">Paswoord:</label>
					<input type="password" name="password" id="password">
				</li>
				
			</ul>

			<input type="submit" name="submit" value="Verzend">
			
		</form>

		<?php else: ?>

			<a href="cookies_deel1.php?logout=true">Uitloggen</a>

		<?php endif ?>
		
    
</body>
</html>