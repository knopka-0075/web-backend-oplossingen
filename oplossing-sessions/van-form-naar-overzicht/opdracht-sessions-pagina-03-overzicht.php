<?php

    session_start();

    if ( isset( $_POST['adres'] ) )
    {
        $_SESSION['adres']['straat']       =   $_POST[ 'straat' ];
        $_SESSION['adres']['nummer']       =   $_POST[ 'nummer' ];
        $_SESSION['adres']['gemeente']    =   $_POST[ 'gemeente' ];
        $_SESSION['adres']['postcode']    =   $_POST[ 'postcode' ];
    }

    if ( isset( $_POST['registratie'] ) )
    {
        $_SESSION['registratie']['email']       =   $_POST[ 'email' ];
        $_SESSION['registratie']['nickname']    =   $_POST[ 'nickname' ];
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
            <li>e-mail: <?= $email ?> | <a href="opdracht-sessions-pagina-01-registratie.php?edit=email">wijzig</a></li>
            <li>nickname: <?= $nickname ?> | <a href="opdracht-sessions-pagina-01-registratie.php?edit=nickname">wijzig</a></li>
        </ul>

		<h2>Adresgegevens</h2>

		<ul>
			<li>straat: <?= $straat ?> | <a href="opdracht-sessions-pagina-02-adres.php?edit=straat">wijzig</a></li>
            <li>nummer: <?= $nummer ?> | <a href="opdracht-sessions-pagina-02-adres.php?edit=nummer">wijzig</a></li>
            <li>gemeente: <?= $gemeente ?> | <a href="opdracht-sessions-pagina-02-adres.php?edit=gemeente">wijzig</a></li>
			<li>postcode: <?= $postcode ?> | <a href="opdracht-sessions-pagina-02-adres.php?edit=postcode">wijzig</a></li>
		</ul>

    </body>
</html>