<?php

$text = file_get_contents('text-file.txt');

$caracterArray = str_split($text);

$gesorteerdeArray = $caracterArray;

rsort($gesorteerdeArray);

$omgedraaideArray = array_reverse($gesorteerdeArray);


$caracterArray = array();

foreach ($omgedraaideArray as $character) {

	if (!isset($caracterArray [ $character ]))
	{
		$caracterArray [ $character ] = 1;
	}
	else
	{
		++$caracterArray [ $character ];
	}
}

$aantalKarakters = count($caracterArray);





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
				<?php foreach ($caracterArray as $character => $occurense ): ?>
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