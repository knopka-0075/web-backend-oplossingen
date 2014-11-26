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

			<?php while ($tafelsMin <= $tafelsMax) :?>

			<tr>
				<?php $product = 1; ?>
				
				<?php while ($product <= $productMax) :?>

					<td class="<?= ( ($tafelsMin * $product)  % 2 > 0) ? '' : 'groen' ?>">


						<?= $tafelsMin * $product; ?>

					</td>

				<?php ++$product; ?>


				<?php endwhile ?>

				
			</tr>

				<?php ++$tafelsMin; ?>

			<?php endwhile ?>

		</table>


		
	</body>
</html>