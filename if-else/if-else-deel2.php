<?php

$minuten = 60;
$uuren = 60 * $minuten;
$dagen = 24 * $uuren;
$weken = 7 * $dagen;
$manden = 31 * $dagen;
$jaren = 365 * $dagen;

$gegevenSeconden    =   221108521; 

$aantalMinuten = floor($gegevenSeconden / $minuten);
$aantalUuren = floor($gegevenSeconden / $uuren);
$aantalDagen = floor($gegevenSeconden / $dagen);
$aantalWeken = floor($gegevenSeconden / $weken);
$aantalManden= floor($gegevenSeconden / $manden);
$aantalJaren = floor($gegevenSeconden / $jaren);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing if else: deel2</title>
	</head>
	<body>
		
		<p>in 221108521 seconden </p>
			<ul>
				<li> minuten: <?= $aantalMinuten ?> </li>
				<li> uuren: <?= $aantalUuren ?></li>
				<li> dagen: <?= $aantalDagen ?></li>
				<li> weken: <?= $aantalWeken?></li>
				<li> manden (31): <?= $aantalManden ?></li>
				<li> jaren (365): <?= $aantalJaren ?></li>
			</ul>


	</body>
</html>