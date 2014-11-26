<?php
	$dieren = array('kat', 'hond', 'hamster', 'papegaai', 'paard');

	$aantalDieren	=	count ( $dieren );

	$zoekDier = 'hond';
	$dierGevonden = in_array($zoekDier, $dieren);

	$zoogdieren = array('leeuw', 'olifant', 'tijger');
	$dierenLijst = array_merge($dieren, $zoogdieren);


	sort($dieren); 
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing arrays basis: deel1</title>
	</head>
	<body>

		<pre><?php var_dump ( $dieren ) ?></pre>
		<p>In de array met dieren zitten er in totaal <?php echo $aantalDieren ?> dieren</p>
		<pre><?php var_dump ( $dierenLijst ) ?></pre>

		<?php if ( $dierGevonden ):  ?>
			<p>Het dier <?php echo $zoekDier ?> is teruggevonden!</p>
		<?php else: ?>
			<p>Het dier <?php echo $zoekDier ?> is niet teruggevonden.</p>
		<?php endif ?>

	</body>
</html>