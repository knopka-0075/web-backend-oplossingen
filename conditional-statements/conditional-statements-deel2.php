<?php
	
	$getal 	= 	1; 
	$dag 	=	'dag';
          
    if ( $getal == 1 ) 
    { 
        $dag = 'maandag'; 
    } 
      
    if ( $getal == 2 ) 
    { 
        $dag = 'dinsdag'; 
    } 
      
    if ( $getal == 3 ) 
    { 
        $dag = 'woensdag'; 
    } 
      
    if ( $getal == 4 ) 
    { 
        $dag = 'donderdag'; 
    } 
      
    if ( $getal == 5 ) 
    { 
        $dag = 'vrijdag'; 
    } 
      
    if ( $getal == 6 ) 
    { 
        $dag = 'zaterdag'; 
    } 
      
    if ( $getal == 7 ) 
    { 
        $dag = 'zondag'; 
    } 

    $dag = strtoupper($dag);
    $leterA  =   strrpos( $dag, 'A' );
    $dag  =   substr_replace( $dag, 'a', $leterA , 1 );
	
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Oplossing conditional statements: deel2</title>
    </head>
    <body>
        <p>De dag <?php echo $getal ?> is: <?php echo $dag ?></p>
    </body>
</html>