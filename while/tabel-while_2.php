<?php

	$maxRijen = 10;
	$rijenTeller = 0;

	$maxKolimmen = 10;
	$kolommenTeller = 0;

	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing conditional statements while</title>
		
	</head>
	<body>

		<table>

			<?php while ($rijenTeller < $maxRijen): ?> 

				<?php $kolommenTeller = 0?>

			<tr>
				<?php while ($kolommenTeller < $maxKolimmen): ?> 

				<td><?= $rijenTeller * $kolommenTeller ?> </td>

				<?php ++$kolommenTeller ?>
				<?php endwhile ?>

			</tr>

			<?php ++$rijenTeller ?>

		<?php endwhile ?>

		</table>
	</body>
</html>