<?php

$text = file_get_contents('text-file.txt');

$textChar = array();

$unike = array_unique($textChar);

$textChar = str_split($text);

arsort($textChar);

foreach ($textChar as $key => $value) 
{

}





?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
	<pre><?php var_dump ( $textChar) ?></pre>
		
	</body>
</html>