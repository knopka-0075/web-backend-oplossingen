<?php

    session_start();

    function relocate( $url )
    {
        header('location: ' . $url );
    }

    function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }

    spl_autoload_register( 'my_autoloader' );

    define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
    define( 'HOST', dirname( BASE_URL ) . '/');
   
    $db = new PDO('mysql:host=localhost;dbname=oplossing_mod_rewrite_blog', 'root', ''); // Connectie maken

    $databaseWrapper    =   new Database( $db );

    $titel          =   $_POST['titel'];
    $artikelTekst   =   $_POST['artikel'];
    $kernwoorden    =   $_POST['kernwoorden'];
    $datum          =   $_POST['datum'];

    $artikel = new Artikel( $databaseWrapper );

    $artikelToegevoegd = $artikel->add( $titel, $artikelTekst, $kernwoorden, $datum );

    var_dump( HOST );

    //relocate( HOST );

?>