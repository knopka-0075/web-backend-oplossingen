<?php
   
	function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }

    spl_autoload_register( 'my_autoloader' );

    define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
    define( 'HOST', dirname( BASE_URL ) . '/');
   
   $bieren = new Bieren();

   if ( isset( $_GET[ 'method' ] ) )
   {

   		$method 	=	$_GET[ 'method' ];
   		$argument		=	false;

   		if ( isset( $_GET[ 'id' ] ) )
   		{
   			$argument 	=	$_GET[ 'id' ];
   		}

   		$result = $bieren->$method( $argument );

   }
	
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing single point of entry</title>
        <style>


        </style>
    </head>
    <body>

    <ul>
        <li><a href="<?= HOST ?>bieren/overview/1">bieren/overview/1</a></li>
        <li><a href="<?= HOST ?>bieren/insert/">bieren/insert/</a></li>
        <li><a href="<?= HOST ?>bieren/update/1">bieren/update/1</a></li>
        <li><a href="<?= HOST ?>bieren/delete/1">bieren/delete/1</a></li>
    </ul>
    
    <h1>Index.php</h1>
    
    

    <?php 

    	var_dump( $_GET );

    ?>
    </body>
</html>