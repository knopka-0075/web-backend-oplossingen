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


?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing mod rewrite: blog</title>
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

            form textarea, form input[type="text"]
			{
				padding:6px;
				width: 50%;
				font-size:16px;
			}

			article
			{
			    padding:16px;
			    margin-bottom: 16px;
			}

			article > h3
			{
			    margin-top:0;
			}

			.non-active
			{
			    background-color:#EEEEEE;
			}

            label
            {
                display:block;
            }

        </style>
    </head>
    <body>

   
    <h1>Artikel toevoegen</h1>

    <form action="<?= HOST ?>process/" method="POST">
    
        <ul>
            <li>
                <label for="titel">Titel</label>
                <input type="text" name="titel" id="titel">
            </li>
            <li>
                <label for="artikel">artikel</label>
                <textarea name="artikel" id="artikel"></textarea>
            </li>
            <li>
                <label for="kernwoorden">kernwoorden</label>
                <input type="text" name="kernwoorden" id="kernwoorden">
            </li>
            <li>
                <label for="datum">datum</label>
                <input type="text" name="datum" id="datum">
            </li>
        </ul>

        <input type="submit">

    </form>

  
    </body>
</html>