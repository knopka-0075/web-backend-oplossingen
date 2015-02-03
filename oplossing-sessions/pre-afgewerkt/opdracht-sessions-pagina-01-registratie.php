<?php

	session_start();

	$email		=	( isset( $_SESSION['registratie']['email'] ) ) ? $_SESSION['registratie']['email'] : '';
	$nickname	=	( isset( $_SESSION['registratie']['nickname'] ) ) ? $_SESSION['registratie']['nickname'] : '';

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht sessions pagina 01 - registratie</title>
    </head>
    <body>
		
		<h1>Opdracht sessions pagina 01 - registratie</h1>

         <form action="opdracht-sessions-pagina-02-adres.php" method="POST">
            <ul>
                <li>
                    <label for="email">e-mail</label>
                    <input type="text" name="email" id="email" value="<?= $email ?>">
                </li>
                <li>
                    <label for="nickname">nickname</label>
                    <input type="text" name="nickname" id="nickname" value="<?= $nickname ?>">
                </li>
            </ul>
            <input type="submit" name="submit" value="Volgende">
        </form>

    </body>
</html>