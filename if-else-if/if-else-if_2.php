<?php

$getal = 22;
$kliensteGetal = 0;
$grotsteGetal = 10;
$ongeldig	=	false;

if ($getal >= 0 && $getal < 10)
{
	$kliensteGetal = 0;
	$grotsteGetal = 10;
}

if ($getal >= 10 && $getal < 20)
{
	$kliensteGetal = 10;
	$grotsteGetal = 20;
}

elseif ($getal >= 20 && $getal < 30)
{
	$kliensteGetal = 20;
	$grotsteGetal = 30;
}

else
{
	$ongeldig = true;
}

if(!$ongeldig)
{
	$tekst = 'Het getal ' . $getal .' ligt tussen' . $kliensteGetal . ' en ' . $grotsteGetal .'.';
}

else
{
	$tekst =  'Het getal ' . $getal . ' ligt niet tussen de opgegeven waarde.';
}

$omgekeerdeTekst	=	strrev($tekst);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing if else if</title>
	</head>
	<body>

		<?php if ( !$ongeldig ): ?>
			<p><?= $kliensteGetal ?> & <?= $grotsteGetal ?>.</p>
		<?php else: ?>
			<p>Het getal <?= $getal ?> ligt niet tussen de opgegeven waarde</p>
		<?php endif ?>

		<p><?php echo $omgekeerdeTekst ?></p>
	</body>
</html>
