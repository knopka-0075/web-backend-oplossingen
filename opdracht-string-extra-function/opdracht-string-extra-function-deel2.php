<?php

	$fruit =	"ananas";	
	
	$velkeFruit = $fruit;
	$leterFinden = "a";

	$velkeLeter = strrpos($velkeFruit, $leterFinden);

	$hoftLeter = strtoupper($fruit);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing string extra function deel 1</title>
	</head>
	<body>

		<p>Een leter <?= $leterFinden?> in <?= $fruit ?> voor de eerste keer op plaats <?= $velkeLeter ?>.</p>
		<p><?= $hoftLeter ?> </p>
	</body>
</html>