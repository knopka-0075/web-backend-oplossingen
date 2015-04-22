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

    $artikel	=	new Artikel( $databaseWrapper );

    $artikels = $artikel->get( );

    if ( isset( $_GET[ 'query-content' ] ) )
    {
        $queryValue      =   '%' . $_GET[ 'query-content' ] . '%';
        $artikels   =   $artikel->query( 'artikel', $queryValue );
    }

    if ( isset( $_GET[ 'query-date' ] ) )
    {
        $queryValue      =   $_GET[ 'query-date' ];
        $artikels   =   $artikel->queryDate( $queryValue );
    }

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing file upload</title>
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

			.inline
			{
				display:inline;
			}

			.inline button
			{
				cursor: pointer;
				border:none;
				background:none;
				text-decoration: underline;
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

        </style>
    </head>
    <body>


    <h1>Artikels overzicht</h1>

    
    <a href="<?= BASE_URL ?>">terug naar overzicht</a> | 
    <a href="<?= HOST ?>oplossing-mod-rewrite-blog-artikel-toevoegen-form.php">Voeg een artikel toe</a>
    

    <h2>Zoeken</h2>

    <form action="<?= BASE_URL ?>" method="GET">
            <label for="content">Zoeken in artikels</label>
            <input type="text" name="query-content" id="content">
            <input type="submit">   
    </form>

    <form action="<?= BASE_URL ?>" method="GET">
            <label id="date">Zoeken op datum (yyyy)</label>
            <input type="text" name="query-date" id="date">
            <input type="submit">   
    </form>

    <?php if ( $artikels ): ?>
    	
		<?php foreach ($artikels as $artikel): ?>

			<article>
                            
                <h1><?= $artikel[ 'titel' ] ?></h1>

                <ul>
                    <li>Artikel: <?= $artikel[ 'artikel' ] ?></li>
                    <li>Kernwoorden: <?= $artikel[ 'kernwoorden' ] ?></li>
                    <li>Datum: <?= $artikel[ 'datum' ] ?></li>
                </ul>

            </article>

		<?php endforeach ?>

	<?php else: ?>
		
		<p>Nog geen artikels</p>

    <?php endif ?>

  
    </body>
</html>