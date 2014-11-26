<?php

	$maxTafel = 10;
	$maxProduct =10;
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing conditional statements while</title>
		
	</head>
	<body>

		<table>

			<?php for($rij = 0; $rij <= $maxTafel; ++$rij): ?>
			<tr>

				<?php for($kolom = 0; $kolom <= $maxProduct; ++$kolom): ?>
				<td><?= $rij * $kolom ?></td>

				<?php endfor ?>
			</tr>
		<?php endfor ?>

		</table>
	</body>
</html>