<?php
	session_start();

	$email		=	'';
	$password	=	'';

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$connection 	=	 new PDO( 'mysql:host=localhost;dbname=phpoefening029', 'root', '' );
	
	if ( User::validate( $connection ) )
	{
		header('location: dashboard.php');
	}
	else
	{
		$message	=	Message::getMessage();

		if ( isset( $_SESSION[ 'login' ] ) )
		{
			$email		=	$_SESSION[ 'login' ][ 'email' ];
			$password	=	$_SESSION[ 'login' ][ 'password' ];
		}
	}
?>

<!DOCTYPE html>
	<html>
	<head>
		<style>
			.modal
			{
				margin:5px 0px;
				padding:5px;
				border-radius:5px;
			}
			
			.success
			{
				color:#468847;
				background-color:#dff0d8;
				border:1px solid #d6e9c6;
			}
			
			.error
			{
				color:#b94a48;
				background-color:#f2dede;
				border:1px solid #eed3d7;
			}
			
			.error p
			{
				font-style:italic;
			}
			
			.warning
			{
				color:#3a87ad;
				background-color:#d9edf7;
				border:1px solid #bce8f1;
			}

		</style>
		
	</head>
	<body>
		
		<h1>Inloggen</h1>

		<?php if ( $message ): ?>
			<div class="modal <?php echo $message['type'] ?>">
				<?php echo $message['text'] ?>
			</div>
		<?php endif ?>

		<form action="login-confirm.php" method="post">
			<ul>
				<li>
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="<?= $email ?>">
				</li>
				
				<li>
					<label for="password">Paswoord</label>
					<input type="password" name="password" id="password" value="<?= $password ?>">
				</li>
			</ul>
			
			<input type="submit" name="submit" value="log in">
		</form>
		
		<p>Nog geen login? <a href="registration-form.php">Registreer dan hier.</a></p>
		
		<p>Opm: het paswoord van alle gebruikers is "test"</p>
	</body>
</html>