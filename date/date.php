<?php
	setlocale('LC_ALL','nl_NL');
	$time = mktime( 22, 35, 25, 01, 21, 1904 );
	$datum = strftime("%d %B %Y %T %p " , $time);

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data</title>
	
</head>

<body>

	<p>Zet deze datum 22u 35m 25sec 21 januari 1904 om naar een timestamp <?= $time ?></p>
	<p>Toon deze timestamp daarna in het volgende formaat: <?= $datum ?></p>


	<!--
	Zet deze datum 22u 35m 25sec 21 januari 1904 om naar een timestamp
	Toon deze timestamp daarna in het volgende formaat: 21 January 1904, 10:35:25 pm

	!-->



</body>
</html>