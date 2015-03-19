<?php
    
    session_start();

    var_dump( $_POST );

    function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }

    spl_autoload_register( 'my_autoloader' );

    // http://stackoverflow.com/questions/4356289/php-random-string-generator
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function relocate( $url )
    {
        header('location: ' . $url );
    }


    define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
    
    // Generate password
    if ( isset( $_POST[ 'generatePassword' ] ) )
    {
        $generatedPassword  = generateRandomString(  );
        
        $_SESSION['generatedPassword']  =   $generatedPassword;

        relocate( 'oplossing-security-login-registratie-form.php' );
    }

    // Registreer
    if ( isset( $_POST[ 'submit' ] ) )
    {
        $email      =   $_POST[ 'email' ];
        $password   =   $_POST[ 'password' ];

        if ( $email !== '' && $password !== '' )
        {

            $db = new PDO('mysql:host=localhost;dbname=oplossing_security_login', 'root', ''); // Connectie maken

            $databaseWrapper    =   new Database( $db );
            
            $user   =   new User( $databaseWrapper );

            $user = $user->register( $email, $password );

            if ( $user )
            {
                unset( $_SESSION[ 'generatedPassword' ] );
                relocate( 'oplossing-security-login-dashboard.php' );
            }
            else
            {
                $error  =   new Message( "Er ging iets mis tijdens het registreren, probeer opnieuw", "error" );
                relocate( 'oplossing-security-login-registratie-form.php' );
            }
        }
        else
        {
            $error  =   new Message( "Vul een e-mailadres of een paswoord in", "error" );
            relocate( 'oplossing-security-login-registratie-form.php' );
        }
    }


?>