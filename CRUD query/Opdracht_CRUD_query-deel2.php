<?php

$message = false;

$selectBrouwers = false;

try{

	$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '' );

	$querySelect = 'SELECT brouwernr,brnaam 
						FROM brouwers';

	$statement = $db->prepare($querySelect);

	$statement->execute( );

	$brouwer = array();

	while ( $row = $statement->fetch( PDO::FETCH_ASSOC) ) 
	{
		$brouwer[] = $row;
	}

	if( isset( $_GET['brouwernr'] ) )
	{
		$selectBrouwers	=	$_GET[ 'brouwernr' ];

			$querySelect	=	'SELECT bieren.naam
										FROM bieren 
										WHERE bieren.brouwernr = :brouwernr';

			$bierenStatement = $db->prepare( $querySelect );

			$bierenStatement->bindParam( ':brouwernr', $_GET[ 'brouwernr' ] );

	}

}
	
catch (PDOException $e)
{
	$message['type'] = 'error';
	$message['tekst'] = 'niet gelukt';
}



?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD_query-deel_1</title>
</head>
<body>

	<select name="brouwernr">
			<?php foreach ($brouwers as $key => $brouwer): ?>
				<option value="<?= $brouwer['brouwernr'] ?>" <?= ( $geselecteerdeBrouwer === $brouwer['brouwernr'] ) ? 'selected' : '' ?>><?= $brouwer['brnaam'] ?></option>
			<?php endforeach ?>
		</select>


		
</body>
</html>