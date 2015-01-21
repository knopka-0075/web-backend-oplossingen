<?php

    function autoload( $classname )
    {
        include_once( 'classes/' . $classname . '.php' );
    }

    spl_autoload_register('autoload');

    $website    =   new HTMLBuilder( 'header', 'body', 'footer');

?>

