<?php

    session_start();

    if ( isset( $_POST['submit'] ) )
    {
        $_SESSION['adres']['straat']       =   $_POST[ 'straat' ];
        $_SESSION['adres']['nummer']       =   $_POST[ 'nummer' ];
        $_SESSION['adres']['gemeente']    =   $_POST[ 'gemeente' ];
        $_SESSION['adres']['postcode']    =   $_POST[ 'postcode' ];
    }

    $email      =   ( isset( $_SESSION['registratie']['email'] ) ) ? $_SESSION['registratie']['email'] : '';
    $nickname   =   ( isset( $_SESSION['registratie']['nickname'] ) ) ? $_SESSION['registratie']['nickname'] : '';


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

		<h2>Adresgegevens</h2>

		<ul>
			<li>straat: <?= $straat ?></li>
            <li>nummer: <?= $nummer ?></li>
            <li>gemeente: <?= $gemeente ?></li>
			<li>postcode: <?= $postcode ?></li>
		</ul>

    </body>
</html>