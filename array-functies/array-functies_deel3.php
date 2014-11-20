<?php

	$cefers = array(8, 7, 8, 7, 3, 2, 1, 2, 4);

	$unike = array_unique($cefers);

	arsort($unike);
	foreach ($unike as $key => $value) {
		echo $value . " ";
	}




?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing arrays basis: deel1</title>
	</head>
	<body>

	</body>
</html>