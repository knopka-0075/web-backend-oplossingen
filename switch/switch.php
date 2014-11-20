<?php

	$getal = 5;

	switch ($getal) {
		case '1':
			$dag = 'mandag';
			break;

		case '2':
			$dag = 'dinsdag';
			break;

		case '3':
			$dag = 'woensdag';
			break;

		case '4':
			$dag = 'donderdag';
			break;

		case '5':
			$dag = 'vrijdag';
			break;

		case '6':
			$dag = 'zaterdag';
			break;

		case '7':
			$dag = 'zondag';
			break;

		default:
			$dag = 'onbekende dag';
			break;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing switch</title>
	</head>
	<body>
		<p>De dag die overeenkomt met het getal <?= $getal ?> is: <?= $dag ?></p>
	</body>
</html>