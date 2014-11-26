<?php

	$getallenreeks1 = array();
	$aantalGetallen	=	100;

	$getalen = 0;

	while ($getalen <= $aantalGetallen) {
		$getallenreeks1[] = $getalen;
		++$getalen;
	}

	$getalPlats = implode(", ", $getallenreeks1);

	$getalen = 0;
	$getallenreeks2 = array();

	while ($getalen <= $aantalGetallen) {


		if($getalen %3 == 0 && $getalen > 40 && $getalen < 80)
		{
			$getallenreeks2[] = $getalen;
		}

		++$getalen;
	}

	$getalPlats2 = implode(", ", $getallenreeks2);


?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>

		<p>Getallenreeks1: <?= $getalPlats ?></p>

		<p>Getallenreeks2: <?= $getalPlats2 ?></p>
		
	</body>
</html>