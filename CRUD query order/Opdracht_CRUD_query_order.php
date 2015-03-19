<?php

$message = false;

try{

	$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '' );

	$orderColumn = 'bieren.biernr';
	$order = 'ASC';

	if (isset($_GET['orderBy']))
	{
		$orderArray = explode('-', $_GET['orderBy']);
		$orderColumn = $orderArray[0];

		$order = $orderArray[1]; 
	} 

	$orderQuery = 'ORDER BY ' . $orderColumn . ' ' . $order;

	if(isset($_GET['orderBy']))
	{
		$order = ($orderArray[1] != 'DESC') ? 'DESC' : 'ASC';
	}

	$query	=	'SELECT bieren.biernr,
							bieren.naam,
							brouwers.brnaam,
							soorten.soort,
							bieren.alcohol 
						FROM bieren 
							INNER JOIN brouwers
							ON bieren.brouwernr	= brouwers.brouwernr
							INNER JOIN soorten
							ON bieren.soortnr = soorten.soortnr '
							. $orderQuery;

	$bierenQuery = query($db, $query);


	$bierenNames = $bierenQuery['fieldnames'];
	$bierenCleanNames = processNames($bierenNames);
	$bieren = $bierenQuery['data'];
}

catch (PDOException $e)
{
	$message['type'] = 'error';
	$message['tekst'] = 'niet gelukt';
}

function query($db, $query, $tokens = false)
{
	$statement = $db->prepare($query);

	if($tokens)
	{
		foreach ($tokens as $token => $tokenValue)
		{
			$statement->bindParam($token, $tokenValue);
		}
	}

	$statement->execute();
	$fieldnames = array();

	for($fieldNumber = 0; $fieldNumber < $statement->columnCount(); ++$fieldNumber)
	{
		$fieldnames[] = $statement->getColumnMeta($fieldNumber) ['name'];
	}

	$data = array();

	while ($row = $statement->fetch(PDO::FETCH_ASSOC) ) 
	{
		$data[] = $row;
	}

	$returnArray['fieldnames'] = $fieldnames;
	$returnArray['data'] = $data;

	return $returnArray;

}

function processNames($array)
{
	$cleanFieldnames = array();

	foreach ($array as $value) 
	{
		switch ($value) {
			case 'biernr':
				$name	=	"Biernummer (PK)";
				break;
			case 'naam':
				$name	=	"Bier";
				break;
			case 'brnaam':
				$name	=	"Brouwer";
				break;
			case 'soort':
				$name	=	"Soort";
				break;
			case 'alcohol':
				$name	=	"Alcoholpercentage";
				break;
			
			default:
				$name = $value;
		}
		$cleanFieldnames[ ] = $name;
	}
	return $cleanFieldnames;
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht CRUD query order</title>
		<style>
			.modal
			{
				padding			:	6px;
				border-radius	:	3px;
			}

			.success
			{
				background-color:lightgreen;
			}

			.error
			{
				background-color:red;
			}

			.even
			{
				background-color:lightgrey;
			}

			.delete-button
			{
				background-color	:	transparent;
				border				:	none;
				padding				:	0px;
				cursor				:	pointer;
			}

			.confirm-delete
			{
				background-color	:	red;
				color				: 	white;
			}

			.order a
			{
				padding-right:20px;
			}

			.ascending a
			{
				background:	no-repeat url('icon-asc.png') right ;
			}

			.descending a
			{
				background:	no-repeat url('icon-desc.png') right;
			}

			.selected
			{
				background-color	:	lightgreen;
			}
		</style>
	</head>
<body>

	<?php if ( $message ): ?>
		<div class="modal <?= $message[ "type" ] ?>">
			<?= $message['text'] ?>
		</div>
	<?php endif ?>	


<!-- иконки удалить изменить -->


<?php if ($brouwersEdit): ?>
	<div>

	<form action="<?= $_SERVER[ 'PHP_SELF' ] ?>" method="POST">
				<ul>
					<?php foreach ($brouwersEdit['data'][0] as $fieldname => $value): ?>
						
						<?php if ( $fieldname != "brouwernr" ): ?>
							<li>
								<label for="<?= $fieldname ?>"><?= $fieldname ?></label>
								<input type="text" id="<?= $fieldname ?>" name="<?= $fieldname ?>" value="<?= $value ?>">
							</li>
						<?php endif ?>
						
					<?php endforeach ?>
				</ul>
				<input type="hidden" value="<?= $brouwersEdit['data'][0]['brouwernr'] ?>" name="brouwernr">
				<input type="submit" name="edit" value="Wijzigen">
			</form>

</div>
<?php endif ?>


<?php if ( $deleteConfirm ): ?>
		<div>
			Bent u zeker dat u deze record wilt verwijderen?
			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

				<button type="submit" name="delete" value="<?= $deleteId ?>">
					Absoluut zeker!
				</button>

				<button type="submit">
					Ongedaan maken
				</button>

			</form>
		</div>
	<?php endif ?>
	
	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		<table>
			
			<thead>
				<tr>
					<?php foreach ($brouwersFieldnames as $fieldname): ?>
						<th><?= $fieldname ?></th>
					<?php endforeach ?>
					<th></th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($brouwers as $key => $brouwer): ?>
					<tr class="<?= ( ($key+1)%2 == 0 ) ? 'even' : ''  ?> <?= ( $brouwer['brouwernr'] === $deleteId ) ? 'confirm-delete' : ''  ?>">
						<?php foreach ($brouwer as $value): ?>
							<td><?= $value ?></td>
						<?php endforeach ?>
						<td>
							
							<button type="submit" name="confirm-delete" value="<?= $brouwer['brouwernr'] ?>" class="delete-button">
								<img src="icon-delete.png" alt="Delete button">
							</button>
						</td>
						<td>
							<button type="submit" name="confirm-edit" value="<?= $brouwer['brouwernr'] ?>" class="delete-button">
								<img src="icon-edit.png" alt="Edit button">
							</button>
						</td>
					</tr>
				<?php endforeach ?>
				
			</tbody>

		</table>
	</form>


<!-- иконки удалить изменить -->


	

	<table>
		
		<thead>
			<tr>
				<?php foreach ($bierenCleanNames as $key => $cleanName): ?>
					<th class="order <?= ( $order == 'ASC' && $orderColumn == $bierenNames[ $key ] ) ? 'descending' : 'ascending' ?> <?= ( $orderColumn == $bierenNames[ $key ] ) ? 'selected' : '' ?>"><a href="<?= $_SERVER['PHP_SELF'] ?>?orderBy=<?= $bierenNames[ $key ] ?>-<?= $order ?>"><?= $cleanName ?></a></th>
				<?php endforeach ?>
				<th></th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($bieren as $key => $brouwer): ?>
				<tr class="<?= ( ($key + 1) % 2 == 0 ) ? 'even' : '' ?>">
					<?php foreach ($brouwer as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
			
		</tbody>

	</table>

</body>
</html>