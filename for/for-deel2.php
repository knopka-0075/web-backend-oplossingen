<?php

	$tafelsMin	=	0;
	$tafelsMax	=	9;
	$productMax = 	10; 
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>

		<style>

		body{
			text-align: center;
		}

		.groen {
			background-color: green;
		}

		</style>

	</head>
	<body>

		<table>

			<?php for ($tafelsMin = 0; $tafelsMin <= $tafelsMax; ++$tafelsMin) :?>

			<tr>
				
				<?php for ($product = 1; $product <= $productMax; ++$product) :?>

					<td class="<?= ( ($tafelsMin * $product)  % 2 > 0) ? 'groen' : '' ?>">


						<?= $tafelsMin * $product; ?>

					</td>



				<?php endfor ?>

				
			</tr>


			<?php endfor ?>

		</table>


		
	</body>
</html>