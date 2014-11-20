<?php

	$getallen1 =  array( 1, 2, 3, 4, 5 );

   $product = array_product($getallen1);

   $onevenGetallen = array();


   for($counter = 0; $counter < count($getallen1); ++ $counter)
   {
      $getal = $getallen1[ $counter ];

      if($getal % 2 != 0)
      {
         $onevenGetallen = $getal;
      }
   }

   $getallen2 = array_reverse($getallen1);

   $somArray = array();

   foreach ($getallen1 as $key => $getal) 
   {
      $getal1 = $getal;
      $getal2 = $getallen2 [$key];

      $somArray  = $getal1 + $getal2;
   }
   

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oplossing arrays basis: deel2</title>
	</head>
	<body>

      <p>Het product van alle getallen uit de eerste array is 120</p>

      <h2></h2>
      <pre>
         <?php var_dump($onevenGetallen) ?>
      </pre>
     
     <h2></h2>
       <pre>
         <?php var_dump($somArray) ?>
      </pre>

	</body>
</html>