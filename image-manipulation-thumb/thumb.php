<?php

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	var_dump( $_POST );
	var_dump( $_FILES );

	if ( isset( $_POST[ 'submit' ] ) )
	{

		$image 	=	new Image( $_FILES['image']['name'], 
								$_FILES['image']['type'], 
								$_FILES['image']['tmp_name'], 
								$_FILES['image']['error'],
								$_FILES['image']['size'] );

		$isType = 	$image->validateType( array( "image/jpeg", 
										"image/png", 
										"image/gif" ) );

		$isSize	=	$image->validateSize( 5000000 );

		$hasError	=	$image->validateError( );

		if ( $isType && $isSize && !$hasError )
		{
			$isUploaded = $image->upload( 'img/' );

			if ( $isUploaded )
			{
				$hasThumbnail	=	$image->createThumbnail( 100, 100 );

				if ( $hasThumbnail )
				{
					$data['src']	=	$image->getThumbnailFilename();
				}
			}
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
		<img src="img/thumbs/<?= $data['src'] ?>" alt="Verkleinde afbeelding">

	</body>
</html>