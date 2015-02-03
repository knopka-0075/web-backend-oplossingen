<?php

	session_start();

	if ( isset( $_POST['submit'] ) )
	{
		$_SESSION['registratie']['email']		=	$_POST[ 'email' ];
		$_SESSION['registratie']['nickname']	=	$_POST[ 'nickname' ];
	}

	$email		=	( isset( $_SESSION['registratie']['email'] ) ) ? $_SESSION['registratie']['email'] : '';
	$nickname	=	( isset( $_SESSION['registratie']['nickname'] ) ) ? $_SESSION['registratie']['nickname'] : '';

	
	$straat		=	 ( isset( $_SESSION['adres']['straat'] ) ) ? $_SESSION['adres']['straat'] : '';
    $nummer     =   ( isset( $_SESSION['adres']['nummer'] ) ) ? $_SESSION['adres']['nummer'] : '';
    $gemeente   =   ( isset( $_SESSION['adres']['gemeente'] ) ) ? $_SESSION['adres']['gemeente'] : '';
	$postcode	=	( isset( $_SESSION['adres']['postcode'] ) ) ? $_SESSION['adres']['postcode'] : '';
	

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht sessions pagina 02 - adres</title>
    </head>
    <body>
	
		<h1>Opdracht sessions pagina 02 - adres</h1>

		<h2>Registratiegegevens</h2>

		<ul>
			<li>e-mail: <?= $email ?></li>
			<li>nickname: <?= $nickname ?></li>
		</ul>

         <form action="opdracht-sessions-pagina-03-overzicht.php" method="POST">
            <ul>
                <li>
                    <label for="straat">straat</label>
                    <input type="text" id="straat" name="straat" value="<?= $straat ?>">
                </li>
                <li>
                    <label for="nummer">nummer</label>
                    <input type="number" id="nummer" name="nummer" value="<?= $nummer ?>">
                </li>
                <li>
                    <label for="gemeente">gemeente</label>
                    <input type="text" id="gemeente" name="gemeente" value="<?= $gemeente ?>">
                </li>
                <li>
                    <label for="postcode">postcode</label>
                    <input type="text" id="postcode" name="postcode" value="<?= $postcode ?>">
                </li>
            </ul>
            <input type="submit" name="submit" value="Volgende">
        </form>


    </body>
</html>