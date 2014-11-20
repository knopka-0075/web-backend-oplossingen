<?php

$getal = 1445;
$kliensteGetal = floor($getal / 10) * 10;
$grotsteGetal = $kliensteGetal +10;
$ongeldig	=	false;


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
