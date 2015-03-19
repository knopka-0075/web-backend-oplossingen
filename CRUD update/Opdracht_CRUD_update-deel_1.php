<?php
 	$message = false;
 	$deleteConfirm = false;
 	$deleteId = false;
 	$brouwersEdit = false;

 	try
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '' ); 

		if ( isset( $_POST[ 'confirm-delete' ] ) )
		{
			$deleteConfirm	=	true;
			$deleteId		=	$_POST[ 'confirm-delete' ];
		}


		if ( isset( $_POST['confirm-edit'] ) )
		{

			$brouwersEdit	=	query( $db, 'SELECT * FROM brouwers WHERE brouwernr = :brouwernr', array( ':brouwernr' => $_POST[ 'confirm-edit' ] ) );
			
		}

		if ( isset( $_POST[ 'edit' ] ) )
		{
				$updateQuery	=	'UPDATE brouwers
									SET brnaam 			=	:brnaam,
											adres		=	:adres,
											postcode	=	:postcode,
											gemeente	=	:gemeente,
											omzet		=	:omzet
									WHERE brouwernr	= :brouwernr
									LIMIT 1';

			$statement = $db->prepare( $updateQuery );
			
			$statement->bindParam( ":brouwernr",  $_POST[ 'brouwernr' ] );						
			$statement->bindParam( ":brnaam",  $_POST[ 'brnaam' ] );						
			$statement->bindParam( ":adres",  $_POST[ 'adres' ] );						
			$statement->bindParam( ":postcode",  $_POST[ 'postcode' ] );						
			$statement->bindParam( ":gemeente",  $_POST[ 'gemeente' ] );						
			$statement->bindParam( ":omzet",  $_POST[ 'omzet' ] );

			$updateSuccessful	=	$statement->execute();

			if ( $updateSuccessful )
			{
				$message['type']	=	'success';
				$message['text']	=	'Update op de brouwer ' . $_POST[ 'brnaam' ] . ' succesvol uitgevoerd.';
			}
			else
			{
				$message['type']	=	'error';
				$message['text']	=	'Update op de brouwer ' . $_POST[ 'brnaam' ] . ' kon niet uitgevoerd worden. Probeer opnieuw. Bij aanhoudende problemen, contacteer de <a href="mailto:bilgates@microsoft.com">systeembeheerder</a>.';
			}	

		}

		if ( isset( $_POST['delete'] ) )
		{
			$deleteQuery	=	'DELETE FROM brouwers
									WHERE brouwernr = :brouwernr';

			$deleteStatement = $db->prepare( $deleteQuery );

			$deleteStatement->bindParam( ':brouwernr', $_POST['delete'] );

			$isDeleted 	=	$deleteStatement->execute();

			if ( $isDeleted )
			{
				$message['type']	=	'success';
				$message['text']	=	'Brouwer successvol vervederd.';
			}
			else
			{
				$message['type']	=	'error';
				$message['text']	=	'Deze brouwer u niet vervederen.' . $deleteStatement->errorInfo()[2];
			}
		}

		$brouwersQuery	= query($db, 'SELECT * FROM brouwers');

		$brouwersFieldnames	= 	$brouwersQuery[ 'fieldnames' ];
		$brouwers			=	$brouwersQuery[ 'data' ];
	}


	catch ( PDOException $e )
	{
		$message['type']	=	'error';
		$message['text']	=	'De connectie is niet gelukt.';
	}


	function query( $db, $query, $tokens = false )
	{
		$statement = $db->prepare( $query );
		
		if ( $tokens )
		{
			foreach ( $tokens as $token => $tokenValue )
			{
				$statement->bindParam( $token, $tokenValue );
			}
		}

		$statement->execute();

		/*  Veldnamen ophalen*/
		$fieldnames	=	array();

		for ( $fieldNumber = 0; $fieldNumber < $statement->columnCount(); ++$fieldNumber )
		{
			$fieldnames[]	=	$statement->getColumnMeta( $fieldNumber )['name'];
		}

		/*De brouwer-data ophalen*/
		$data	=	array();

		while( $row = $statement->fetch( PDO::FETCH_ASSOC ) )
		{
			$data[]	=	$row;
		}

		$returnArray['fieldnames']	=	$fieldnames;
		$returnArray['data']		=	$data;

		return $returnArray;
	}



	
?>


<!DOCTYPE html>
<html>
	<head>
		<title>CRUD update</title>
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
		</style>
	</head>
<body>

	<?php if ($message):?>
	<div class="modal <?= $message[ "type" ] ?>">
		<?= $message['text'] ?>
		</div>
	<?php endif ?> 

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

	
</body>
</html>