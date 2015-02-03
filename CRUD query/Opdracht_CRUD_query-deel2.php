<?php

$message = false;

$selectBrouwers = false;

try{

	$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '' );

	$querySelect = 'SELECT brouwernr,brnaam 
						FROM brouwers';

	$statement = $db->prepare($querySelect);

	$statement->execute( );

	$brouwers = array();

	while ( $row = $statement->fetch( PDO::FETCH_ASSOC) ) 
	{
		$brouwers[] = $row;
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

	else
		{
			$querySelect	=	'SELECT bieren.naam
										FROM bieren';

			$bierenStatement = $db->prepare( $querySelect );
		}

		$bierenStatement->execute();

		/* kolomnamen van het bierenresultaat ophalen */
		$bierenHeader	=	array();
		$bierenHeader[]	=	'Aantal';

		for ($columnNumber = 0; $columnNumber  < $bierenStatement->columnCount( );  ++$columnNumber) 
		{ 
			$bierenHeader[] = $bierenStatement->getColumnMeta( $columnNumber )['name'];
		}

		/* bieren in een leesbare array plaatsen */
		$bieren	=	array();

		while( $row = $bierenStatement->fetch( PDO::FETCH_ASSOC ) )
		{
			$bieren[ ]	=	$row[ 'naam' ];
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
    <title>CRUD_query-deel_2</title>
</head>
<body>

	<?php if ( $message ): ?>
		<div "modal <?= $message[ "type" ] ?>">
			<?= $message['text'] ?>
		</div>
	<?php endif ?>

	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
		<label>Select een bier</label>
		
		<select name="brouwernr">
			<?php foreach ($brouwers as $key => $brouwer): ?>
				<option value="<?= $brouwer['brouwernr'] ?>" <?= ( $selectBrouwers === $brouwer['brouwernr'] ) ? 'selected' : '' ?>><?= $brouwer['brnaam'] ?></option>
			<?php endforeach ?>
		</select>
		<input type="submit" value="Zoek">
	</form>
	

	<table>
		
		

		<thead>
			<tr>
				<?php foreach ($bierenHeader as $columnName): ?>
					<th><?= $columnName ?></th>
				<?php endforeach ?>
			</tr>
		</thead>

		<tbody>
		
			<?php foreach ($bieren as $key => $biernaam): ?>
				<tr "<?= ( ( $key + 1) %2 == 0 ) ? 'even' : '' ?>">
					<td><?= ( $key + 1 ) ?></td>
					<td><?= $biernaam ?></td>
				</tr>
			<?php endforeach ?>

		</tbody>

	</table>

		
</body>
</html>