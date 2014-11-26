<?php

	$maxGetal = 100;
	$teller = 0;

	$contener = array();
	$product = 1;

	while ( $teller <= $maxGetal) {

		$contener[] = $teller;
		++ $teller;
	}

	$getallenString = join($contener, ', ');
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing conditional statements while</title>
		
	</head>
	<body>
		<p> <?= $getallenString ?> </p>
		
	</body>
</html>