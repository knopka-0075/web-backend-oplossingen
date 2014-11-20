<?php

$jaar = 1991;
$schrikkeljaar 	= 	false;

if ((($jaar % 4 == 0 ) && ( $jaar % 100 != 0 )) || ( $jaar % 400 == 0 ))
	//4 делиться (==)		100 не делиться	(!=)	400 делиться (==)
{
	$schrikkeljaar = true;
}
 else {
 	$schrikkeljaar = false;
 
 }


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing if else: deel1</title>
	</head>
	<body>
		<p>Het jaar <?= $jaar ?> is <?= ($schrikkeljaar) ? "een" : "geen"  ?> schrikkeljaar </p>
	</body>
</html>