<?php
	$pigHealth = 5;
	$maximumThrows = 8;

	$spelLoop = array();

	function calculateHit()
	{
		global $pigHealth;
		$dataArray = array();
		$raakkans = rand(0,9);
		$isRaak = ($raakkans <= 3)? true : false;

		if ($isRaak)
		{
			--$pigHealth;
			$dataArray['isHit'] = true;
			$dataArray['string'] = 'Raak! Er zijn nog maar ' . $pigHealth . ' varkens over.';
		}
		else
		{
			$dataArray['isHit'] = false;
			$dataArray['string'] = 'Mis! Nog ' . $pigHealth . ' varkens in het team.';
		}

		return $dataArray;

	}


	function launchAngryBird()
	{
		global $pigHealth;
		global $maximumThrows;
		global $spelLoop;

		if ($maximumThrows != 0 && $pigHealth > 0)
		{
			$hitResul = calculateHit();
			--$maximumThrows;
			$spelLoop[] = $hitResul['string'];
			launchAngryBird();
		}
		else
		{
			if($pigHealth > 0)
			{
				$spelLoop[] = 'Verloren!';
			}
			else
			{
				$spelLoop[] = 'Gewonnen!';
			}
		}
	}

	launchAngryBird( );

	
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<ul>
		<?php foreach ($spelLoop as $resultat): ?>
			<li><?= $resultat ?></li>
		<?php endforeach?>
		</ul>

	</body>
</html>