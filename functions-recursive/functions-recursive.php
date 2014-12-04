<?php

	 $startKapitaal = 100000;
	 $renteVoet = 8;
	 $aantalJaar = 10;

	function capital( $startKapitaal, $renteVoet, $aantalJaar  )
	{

		static $teller = 1;
		static $arrayDump = array();

		/*$arrayDump = array( 'startKapitaal' => 100000,
							'aantalJaar' => 10,
	 						'renteVoet' => 8,
	 						'teller' => 1,
	 						'arrayDump' => array()
	 						);*/

		$winst = $startKapitaal * ($renteVoet / 100);

		$totaal = $startKapitaal + $winst;

		$arrayDump[] = 'Na ' . $teller . ' jaar bedraagt het totaal bedrag ' . floor($totaal) . ' en is de winst voor dat jaar ' . floor($winst);

		if ( $teller < $aantalJaar )
		{
			++ $teller;
			capital($totaal, $renteVoet, $aantalJaar);
		}

		return $arrayDump;
	}

	$winstHans = capital($startKapitaal, $renteVoet, $aantalJaar);
?>

<!DOCTYPE html>
<html>
<head>
    
</head>

<body>

	<ul>

	<?php foreach ($winstHans as $value) : ?>
		<li><?php echo $value ?></li>
<?php endforeach?>
    
</ul>

</body>
</html>