<?php

	$lettertje = "e";

	$cijfertje = 3;

	$langsteWoord = "zandzeepsodemineralenwatersteenstralen";

	$neweWord = str_replace($lettertje, $cijfertje, $langsteWoord)
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing string extra function deel 1</title>
	</head>
	<body>
		<p> Het woord <?= $langsteWoord ?> waarin alle e's vervangen zijn door 3's heeft als resultaat: <?= $neweWord  ?></p>
	</body>
</html>