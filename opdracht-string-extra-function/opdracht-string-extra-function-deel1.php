<?php

	$fruit =	"kokosnoot";	
	
	$velkeFruit = $fruit;
	$leterFinden = "o";

	$velkeLeter = strpos($velkeFruit, $leterFinden);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing string extra function deel 1</title>
	</head>
	<body>

		<p>Een leter <?= $leterFinden?> in <?= $fruit ?> voor de eerste keer op plaats <?= $velkeLeter ?>.</p>
	</body>
</html>