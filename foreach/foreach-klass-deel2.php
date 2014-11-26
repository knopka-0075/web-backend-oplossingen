<?php
	$text = file_get_contents('text-file.txt');

	$textUppercase = strtoupper($text);

	$caracterArray = count_chars($textUppercase, 1);

	var_dump($caracterArray);

	$alphabetArray = array();

	for($karakterNunber = 65; $karakterNunber <= 90; ++ $karakterNunber)
	{
		$karakter = chr($karakterNunber);
		if(isset($caracterArray[ $karakterNunber ]))
		{
			$alphabetArray[ $karakter ] = $caracterArray [ $karakterNunber ];
		}
	}

	var_dump($alphabetArray);
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>

		<table>
			<thead>
				<tr>
					<th>karakter</th>
					<th>ASCII - nummer</th>
					<th>Aantal in tekst</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($alphabetArray as $character => $occurense ): ?>
				<tr>
					<td><?= $character  ?></td>
					<td><?= ord($character) ?></td>
					<td><?= $occurense ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		
	</body>
</html>