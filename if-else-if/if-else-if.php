<?php

$getal = 145;
$kliensteGetal = 0;
$grotsteGetal = 0;
$ongeldig	=	false;

if ($getal >= 0 && $getal < 10)
{
	$kliensteGetal = 0;
	$grotsteGetal = 10;
}

elseif ($getal >= 10 && $getal < 20)
{
	$kliensteGetal = 10;
	$grotsteGetal = 20;
}

elseif ($getal >= 20 && $getal < 30)
{
	$kliensteGetal = 20;
	$grotsteGetal = 30;
}

elseif ($getal >= 30 && $getal < 40)
{
	$kliensteGetal = 30;
	$grotsteGetal = 40;
}

elseif ($getal >= 40 && $getal < 50)
{
	$kliensteGetal = 40;
	$grotsteGetal = 50;
}

else
{
	$kliensteGetal = false;
	$grotsteGetal = false;
}

if(!$ongeldig)
{
	$tekst = 'Het getal ' . $getal .' ligt tussen' . $kliensteGetal . ' en ' . $grotsteGetal . '.';
}

else
{
	$tekst = 'Het getal ' . $getal . ' ligt niet tussen de opgegeven waarde.';
}

$omgekeerdeTekst	=	strrev($tekst);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing if else if</title>
	</head>
	<body>
		<?php if ($kliensteGetal !== false): ?>

		<p> Het getal <?= $getal?> ligt tussen <?= $kliensteGetal ?> en <?= $grotsteGetal ?> </p>

		<?php else: ?>

		<p> Het getal <?= $getal ?> is niet geldig </p>

		<?php endif ?>

		<p><?php echo $omgekeerdeTekst ?></p>
	</body>
</html>
