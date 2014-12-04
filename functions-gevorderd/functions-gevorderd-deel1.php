<?php
	$md5HashKey = 'd1fa402db91a7a93c4f414b8278ce073';
	$needle1 = '2';
	$needle2 = '8';
	$needle3 = 'a';

	function telNeedler1($haystack, $needle)
	{
		$haystackCount = strlen($haystack);
		$needleAntal = substr_count($haystack, $needle);
		$needleProssent = ($needleAntal / $haystackCount) * 100;

		return $needleProssent;
	}


	function telNeedler2($needle)
	{
		global $md5HashKey;
		$haystack = $md5HashKey;
		$haystackCount = strlen($haystack);
		$needleAntal =substr_count($haystack, $needle);
		$needleProssent = ($needleAntal / $haystackCount) *100;

		return $needleProssent;
	}

	function telNeedler3($needle)
	{
		$haystack = $GLOBALS ['md5HashKey'];
		$haystackCount = strlen($haystack);
		$needleAntal =substr_count($haystack, $needle);
		$needleProssent = ($needleAntal / $haystackCount) *100;

		return $needleProssent;
	}

	$eersteMethode = telNeedler1($md5HashKey, $needle1);
	$twedeMethode = telNeedler2($needle2);
	$derdeMethode = telNeedler3($needle3);


	
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<p>Functie 1: De needle <?= $needle1 ?>  komt <?= $eersteMethode ?>% voor in de hash key '<?= $md5HashKey?>'</p>
		<p>Functie 2: De needle <?= $needle2 ?>  komt <?= $twedeMethode ?>% voor in de hash key '<?= $md5HashKey?>'</p>
		<p>Functie 3: De needle <?= $needle3 ?>  komt <?= $derdeMethode ?>% voor in de hash key '<?= $md5HashKey?>'</p>

	</body>
</html>