<?php
	
	$namen  = array("Olga", "Leonie", "Floor", "Glen");

	function goeiemorgen ($naam)
	{
		$begroeting  = "Goeiemorgen " . $naam . "! Hoe gaat het?";

		return $begroeting;
	} 

	function goedeavond ($naam)
	{
		$begroeting  = "Goedeavond " . $naam . "! Hoe gaat het?";

		return $begroeting;
	} 

	/*foreach ($namen as $naam) 
	{
		var_dump( begroet ($naam));
	}

	$begroeting1 = begroet($namen[0]);
	$begroeting2 = begroet($namen[0]);*/

	
	var_dump(goeiemorgen ($namen[0]));
	var_dump(goedeavond ($namen[0]));

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		
	</body>
</html>