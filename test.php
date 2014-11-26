<?php
	
	/*$teller = 0;

	do
	{
		echo ' Hallo Olga ';
		++$teller;
	}
	while ($teller < 3) */


	$array = array(array("sting1", "sting2"),
					array("sting3", "sting4"),
					array("sting5", "sting6"),
					array("sting7", "sting8")
					);
	
	for ($key = 0; $key < count($array) ; ++$key) { 
			var_dump($array [ $key ] );
			$genesteArray = $array [ $key ];

			for ($keyGenest=0; $keyGenest < count($genesteArray) ; ++$keyGenest) { 
				echo $genesteArray [ $keyGenest ];
			}
			echo '-- einde van geneste forloop --';
		}	


?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>

		<?php for ($key=0; $key < count($array) ; ++$key): ?> 
			<ul>
				<?php for ($keyGenest=0; $keyGenest < count($array [ $key ] ) ; ++$keyGenest): ?> 
					<li><?= $array [ $key ] [ $keyGenest ] ?> </li>

					<?php endfor ?>
			
			</ul>
		

			<?php endfor ?>

			
		
		

		
	</body>
</html>