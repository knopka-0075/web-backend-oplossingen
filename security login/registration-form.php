<?php

	session_start();

	function __autoload( $classname )
	{
		require_once($classname . '.php');
	}

	$message = Message::getMessage();
	$email = '';
	$password = '';


	if ( isset( $_SESSION[ 'registration' ] ) )
	{
		$email		=	 $_SESSION['registration']['email'];
		$nickname	=	 $_SESSION['registration']['password'];
	}


?>

<!doctype html>
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
        <title>security login</title>
    </head>
    <body>
		
		<h1>Security login</h1>

		<?php if ($message):?>
			<div class="modal <?php echo $message[ "type" ] ?>">
				<?php echo $message['text'] ?>
			</div>
		<?php endif ?> 

		<form action="" method="post">
			<ul>
				<li>
					<label for="email">E-mail</label>
					<input type="text" name="email" id="email" value="<?= $email ?>">
				</li>
				
				<li>
					<label for="password">Paswoord</label>
					<input type="<?= ( $password != '' ) ? 'text' : 'password' ?>" name="password" id="password" value="<?= $password ?>">
					
					<input type="submit" name="generate-password" value="genereer een paswoord">
				</li>
			
				<li>
					<input type="submit" name="submit" value="registreer">
				</li>
			</ul>
		</form>

    </body>
</html>