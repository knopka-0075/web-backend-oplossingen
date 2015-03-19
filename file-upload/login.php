<?php

session_start();

$dump = '';


	if (!isset($_COOKIE['login'])) {
	
		$dump .= '<h1>Log in</h1>';
		
		if (isset($_SESSION['loginNotification'])) {
			
			//Wanneer iemand van de log-outpagina komt of wanneer er iemand foutief inlogt, moet een boodschap getoond worden.
			//Wanneer iemand refresht moet deze boodschap verdwijnen. Werk daarom met de session en unset de key wanneer de boodschap wordt getoond.
			$dump .='<p>' . $_SESSION['loginNotification'] . '</p>';
			unset($_SESSION['loginNotification']);	
		}
		
		
		$dump .= '<form action="login-confirm.php" method="post">
			<ul>
				<li>
					<label for="email">Email</label>
					<input type="text" name="email" id="email" />
				</li>
				
				<li>
					<label for="password">Paswoord</label>
					<input type="password" name="password" id="password" />
				</li>
			</ul>
			
			<input type="submit" name="submit" value="log in" />
		</form>
		<p>Nog geen login? <a href="registration.php">Registreer dan hier.</a></p>';
	
	} else {
		
		//Wanneer de cookie al geset is, moet de persoon automatisch naar het dashboard gestuurd worden.
		header('location:dashboard.php');
	}
	
echo $dump;

?>