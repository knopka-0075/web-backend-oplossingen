<?php

$message = false;

try{

	$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '' );

	$querySelect = 'SELECT *
						FROM bieren 
						INNER JOIN brouwers
						ON bieren.brouwernr = brouwers.brouwernr
						WHERE bieren.naam LIKE "Du%"
						AND brouwers.brnaam LIKE "%a%"';

	$statement = $db->prepare($querySelect);

	$statement->execute( );

	$bieren = array();

	while ( $row = $statement->fetch( PDO::FETCH_ASSOC) ) 
	{
		$bieren[] = $row;
	}

	$namen = array();
	$namen[] = 'Biernr';

	foreach ($bieren[0] as $key => $bier) 
	{
		$namen[ ] = $key;
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

<?php if ( $message ): ?>
		<div>
			<?= $message['text'] ?>
		</div>
	<?php endif ?>

	<table>
		
		<thead>
			<tr>
				<?php foreach ($namen as $namen): ?>
					<th><?= $namen ?></th>
				<?php endforeach ?>
			</tr>
		</thead>

		<tbody>
		
			<?php foreach ($bieren as $key => $bier): ?>
				<tr>
					<td><?= ($key + 1) ?></td>
					<?php foreach ($bier as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
			
		</tbody>

	</table>


		
</body>
</html>