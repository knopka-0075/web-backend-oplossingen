<?php

    session_start();

    function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }

    spl_autoload_register( 'my_autoloader' );

    define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
    define( 'HOST', dirname( BASE_URL ) . '/');
    
    $message    =   false;

    if ( Message::hasMessage() )
    {
        $message = Message::getMessage();

        Message::remove();
    }

    var_dump( $_SESSION );

    $generatedPassword  =   false;

    if ( isset( $_SESSION[ 'generatedPassword' ] ) )
    {
        $generatedPassword  =   $_SESSION[ 'generatedPassword' ];
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing Security login</title>
        <style>
            html
            {
                font-family:sans-serif;
            }


            .modal
            {
                margin:5px 0px;
                padding:5px;
                border-radius:5px;
            }
            
            .success
            {
                color:#468847;
                background-color:#dff0d8;
                border:1px solid #d6e9c6;
            }
            
            .error
            {
                color:#b94a48;
                background-color:#f2dede;
                border:1px solid #eed3d7;
            }
            
            .warning
            {
                color:#3a87ad;
                background-color:#d9edf7;
                border:1px solid #bce8f1;
            }

        </style>
    </head>
    <body>

    <?php if ( $message ): ?>
        <div class="modal <?= $message['type'] ?>">
            <?= $message['text'] ?>
        </div>
    <?php endif ?>

    <h1>Registreren</h1>
    <form action="<?= HOST ?>oplossing-security-login-registratie-process.php" method="POST">
        <ul>
            <li>
                <label for="email">e-mail</label>
                <input type="text" id="email" name="email">
            </li>
            <li>
                <label for="password">paswoord</label>
                <input type="<?= ( $generatedPassword ) ? 'text' : 'password' ?>" id="password" name="password" value="<?= ( $generatedPassword ) ? $generatedPassword : '' ?>">
                <input type="submit" name="generatePassword" value="Genereer een paswoord">
            </li>
        </ul>
        <input type="submit" value="Registreer" name="submit">
    </form>


     

    </body>
</html>