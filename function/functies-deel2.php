<?php

	$htlmValideren = '<html><head><title>Dit is een test</title></head><body>Tekst</body></html>';
	$arrayAfdrukken = array('Cola' => 'Zero',
								'Melk' => 'Half-vol');

	function arrayAfdrukken($array)
	{
		$dataArray = array();

		end($GLOBALS);
		$arrayAfdrukken = key($GLOBALS);


		foreach ($array as $key => $value) 
		{
			$dataArray[] = $naamArray . '[' . $key . '] heeft waarde ' . $value;
		}

		return $dataArray;

	}

	$resultat  = arrayAfdrukken($arrayAfdrukken);



	function HtmlValideren($html)
	{

        $isValid    =   false;

		$openingTag =   '<html>';
        $closingTag =   '</html>';

        $firstPos = strpos($html, $openingTag);
        $lastPos = strpos($html, $closingTag);

        $expectedLastClosingPosition = strlen($html) - strlen($closingTag);

        if($firstPos === 0 && $lastPos == $expectedLastClosingPosition )
        {
        	$isValid = true;
        }

        return $isValid;

	}

	$validHtml = HtmlValideren ($htmlString);
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>

		<ul>
			<?php foreach ($resultat as $value) : ?>
			<li><?= $value ?></li>
			<?php endforeach?>
		</ul>

		<p>De string <code> <?= htmlentities($validHtml)?> </code> is <?=$validHtml ? 'wel' : 'niet'?> geldig.</p>
	</body>
</html>