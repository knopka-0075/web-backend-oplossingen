<?php 

	$gebruikersnaam = 'olga';
	$password = '1234567890';
	$message	=	'Gelieve in te loggen';

	if(isset($_POST['submit']))
	{
		if($_POST['gebruikersnaam'] == $gebruikersnaam && $_POST['password'] == $password )
		{
			$message = 'Welkome';
		}
		else
		{
			$message = 'Verkeerde login of password';
		}
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Untitled Document</title>
</head>

<body>
	
    <form action="post.php" method="POST">

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
			<p><?php echo $message ?></p>
		</form>
		
    
</body>
</html>