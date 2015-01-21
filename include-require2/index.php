<?php

	$controller	=	'artikelsOverzicht';

	if ( isset( $_GET['page'] )  )
	{
		switch( $_GET['page'] )
		{
			case 'contact':
				$controller	=	'contact';
				break;
		}
	}

	if ( $controller === 'artikelsOverzicht' )
	{
		include('artikelsArray.php');
	}

	// View generen
	// Header
	include('views/header.html');
	
	// Body
	$bodyString	=	"artikels_overzicht";

	switch( $controller )
	{
		case 'contact':
			$bodyString	=	'contact';
			break;
		default:
		 	$bodyString	=	"artikels_overzicht";
	}
	
	include('views/' . $bodyString . '-body.html');

	// Footer
	include('views/footer.html');

?>