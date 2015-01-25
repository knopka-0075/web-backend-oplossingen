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
		include('include-require.php');
	}

	// View generen
	// Header
	include('view/header.html');
	
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
	
	include('view/' . $bodyString . '-body.html');

	// Footer
	include('view/footer.html');

?>