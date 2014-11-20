<?php

	$getallen            =  array( 1, 2, 3, 4, 5 );

   $getallenProduct     =  array_product( $getallen );

   $arrayLengte         =  count ( $getallen );

   $getallenReverse     =  array_reverse( $getallen );


   $getallenOneven;

   foreach( $getallen as $value )
   {
      if ( $value % 2 != 0 )
      {
         $getallenOneven[]   =   $value;
      }
   }


   $getallenOpgeteld;

   foreach ($getallen as $key => $value)
   {
               if ( isset( $getallenReverse[ $key ] ))
      {
         $getallenOpgeteld[ $key ]  =  $getallenReverse[ $key ] + $value;
      }
   }


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing arrays basis: deel2</title>
	</head>
	<body>


      <p>Array 1</p>

      <ul>
         <?php foreach ($getallen as $key => $value): ?>
            <li>[<?= $key ?>]: <?= $value ?></li>
         <?php endforeach ?>
      </ul>

      <p>Array 2 (reverse)</p>

      <ul>
         <?php foreach ($getallenReverse as $key => $value): ?>
            <li>[<?= $key ?>]: <?= $value ?></li>
         <?php endforeach ?>
      </ul>

      <p>Product van de getallen uit array 1: <?= $getallenProduct ?></p>

      <p>De oneven getallen: </p>
      <ul>
          <?php foreach ($getallenOneven as $key => $value): ?>
            <li>[<?= $key ?>]: <?= $value ?></li>
         <?php endforeach ?>
      </ul>

      <p>De getallen van beide arrays met elkaar opgeteld: </p>
      <ul>
          <?php foreach ($getallenOpgeteld as $key => $value): ?>
            <li>Som van values met key [<?= $key ?>]: <?= $value ?></li>
         <?php endforeach ?>
      </ul>


	</body>
</html>