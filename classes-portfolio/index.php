<?php

	function __autoload($className)
	{
		include_once ('classes/' . $className . '.php'); 
	}

	//spl_autoload_register('autoload');
	//

	$body 	= (isset( $_GET['page'] ) ? $_GET['page'] : 'index') . '.partial.php';
	
	$page	=	new HTMLbuilder('header.php', $body, 'footer.php');


?>