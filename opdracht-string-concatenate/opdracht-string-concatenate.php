<?php

	$naam =	"Olga";	
	$voornaam =	"Povitukhina";

	$volledigeNaam 			=	$naam . " " . $voornaam;
	$volledigeNaamLengte	=	strlen($volledigeNaam);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing string concatenate</title>
	</head>
	<body>

		<p><?php echo $volledigeNaam ?></p>
		<p><?php echo $volledigeNaamLengte ?></p>
	</body>
</html>