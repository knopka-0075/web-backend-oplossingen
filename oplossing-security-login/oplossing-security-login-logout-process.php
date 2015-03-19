<?php
    
    session_start();

    function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }

    spl_autoload_register( 'my_autoloader' );

    function relocate( $url )
    {
        header('location: ' . $url );
    }

    define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
    define( 'HOST', dirname( BASE_URL ) . '/');

    $db = new PDO('mysql:host=localhost;dbname=oplossing_security_login', 'root', ''); // Connectie maken

    $databaseWrapper    =   new Database( $db );
    
    $user   =   new User( $databaseWrapper );

    $userLoggedOut = $user->logout( );

    if ( $userLoggedOut )
    {
        new Message( "Bedankt en tot de volgende!", "success" );
        relocate( 'oplossing-security-login-login-form.php' );
    }

?>