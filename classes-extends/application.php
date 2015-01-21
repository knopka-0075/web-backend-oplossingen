<?php
	
	function __autoload( $classen )
	{
		require_once( 'classes/' . $classen . '.php' ); 
	}

	//animal
	$kat = new Animal('Lisa', 'female', 100);
	$hond = new Animal('Fila', 'female', 100);

	$hond ->changeHealth(-10);

	$paard = new Animal('Snejok', 'male', 80);

	// lion
	$simba 	= 	new Lion('Simba', 'male', 100, 'Congo lion');
	$scar 	= 	new Lion('Scar', 'female', 100, 'Kenia lion');

	// zebra
	$martin = new Zebra('Martin', 'male', 120, 'Quagga');
	$gloria = new Zebra('Gloria', 'female', 100, 'Selous');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
	<body>
		
		<h2>Animals</h2>

		<p><?php echo $kat->getName() ?> is van het geslacht <?php echo $kat->getGender() ?> en heeft momenteel <?php echo $kat->getHealth() ?> levenspunten</p>

		<p><?php echo $hond->getName() ?> is van het geslacht <?php echo $hond->getGender() ?> en heeft momenteel <?php echo $hond->getHealth() ?> levenspunten</p>

		<p><?php echo $paard->getName() ?> is van het geslacht <?php echo $paard->getGender() ?> en heeft momenteel <?php echo $paard->getHealth() ?> levenspunten</p>

		<h2>Leeuwen</h2>

		<p> De speciale move van Simba (soort: <?php echo $simba->getSpecies() ?>) : <?php echo $simba->doSpecialMove() ?></p>

		<p>De speciale move van Scar (soort: <?php echo $scar->getSpecies()  ?>) : <?php echo $scar->doSpecialMove() ?></p>


	<h2>Zebras</h2>

		<p>De speciale move van Martin (soort: <?php echo $martin->getSpecies() ?>) : <?php echo $martin->doSpecialMove() ?></p>

		<p>De speciale move van Gloria (soort: <?php echo $gloria->getSpecies()  ?>) : <?php echo $gloria->doSpecialMove() ?></p>
	</body>
</html>