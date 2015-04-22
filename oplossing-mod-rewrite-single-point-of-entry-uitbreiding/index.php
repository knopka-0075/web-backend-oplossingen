<?php
	
	define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
	define( 'HOST', dirname( BASE_URL ) . '/');

	function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }

    spl_autoload_register( 'my_autoloader' );

    $rawHookArrayCopy = false; // voor demonstratiedoeleinden

	if ( isset ( $_GET['hook'] ) )
	{
		// Haal de trailing / weg als die er eventueel zou zijn
		$rawHookString 	=	trim( $_GET['hook'], '/' );

		// Voer een explode uit op basis an de delimiter /
		$rawHookArray	=	explode('/', $rawHookString);

		$rawHookArrayCopy = $rawHookArray;

		// De controller staat altijd op de 0de key
		$controller = $rawHookArray[ 0 ];
		array_shift( $rawHookArray ); // verwijder deze controller uit de array

		// Haal de method uit de array
		// deze staat op de 0de key aangezien we de controller bovenstaand verwijderd hebben 
		$method = $rawHookArray[0];
		array_shift( $rawHookArray ); // verwijder deze method uit de array

		// Maak een instantie aan van de controller
		$controllerInstance = new $controller(  );

		// Voer de methode uit en geef de argumenten (= overblijvende array) mee
		$controllerInstance->$method( $rawHookArray );
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Oplossing mod_rewrite single point of entry: uitbreiding</title>
</head>
<body>

	<h1>index.php</h1>

    <ul>
        <li><a href="<?= HOST ?>bieren/overview/1">bieren/overview/1</a></li>
        <li><a href="<?= HOST ?>bieren/overview/1">bieren/overview/dit/is/een/test/</a></li>
        <li><a href="<?= HOST ?>bieren/insert/">bieren/insert/</a></li>
        <li><a href="<?= HOST ?>bieren/update/1">bieren/update/1</a></li>
        <li><a href="<?= HOST ?>bieren/delete/1">bieren/delete/1</a></li>
    </ul>

	<h1>var_dump van $_GET</h1>

	<?php var_dump( $_GET ) ?>

	<?php if ( $rawHookArrayCopy ): ?>
	
	<h1>var_dump van hook na explode</h1>
	
	<?php var_dump( $rawHookArrayCopy ) ?>

	<?php endif ?>


</body>
</html>