<?php

	define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
    

	$formRegEx	=	'';
	$formText	=	'';

	$replaceString	=	'<span class="match">#</span>';

	$matchedString	=	false;

	if ( isset( $_POST[ 'submit' ] ) )
	{
		$formRegEx	=	$_POST[ 'regex' ];
		$formText	=	$_POST[ 'text' ];

		$formattedRegEx	=	'/' . $formRegEx . '/';

		$matchedString	=	preg_replace( $formattedRegEx,  $replaceString, $formText );

	}

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mod rewrite begin</title>
        <style>

			label
			{
				display:block;
			}

			.match
			{
				color:red;
				font-weight:bold;
			}

        </style>
    </head>
    <body>

    	<h1>RegEx tester</h1>
        
		<form action="<?= BASE_URL  ?>" method="POST">
			
			<ul>
				<li>
					<label for="regex">Regular expression</label>
					<input type="text" name="regex" id="regex" value="<?= $formRegEx ?>">
				</li>
				<li>
					<label for="text">Te doorzoeken tekst</label>
					<textarea name="text" id="text"><?= $formText ?></textarea>
				</li>
			</ul>

			<input type="submit" name="submit">

		</form>

		<?php if ( $matchedString ): ?>
			
			<p><?= $matchedString ?></p>

		<?php endif ?>

		<ul>
			<li>
				<p>Match alle letters tussen a en d, en u en z (hoofdletters inclusief)</p>
				<p>String: Memory can change the shape of a room; it can change the color of a car. And memories can be distorted. They're just an interpretation, they're not a record, and they're irrelevant if you have the facts.</p>
				<p>regex: [a-du-zA-DU-Z]</p>
				<p>Resultaat: Memor<span class="match">#</span> <span class="match">#</span><span class="match">#</span>n <span class="match">#</span>h<span class="match">#</span>nge the sh<span class="match">#</span>pe of <span class="match">#</span> room; it <span class="match">#</span><span class="match">#</span>n <span class="match">#</span>h<span class="match">#</span>nge the <span class="match">#</span>olor of <span class="match">#</span> <span class="match">#</span><span class="match">#</span>r. <span class="match">#</span>n<span class="match">#</span> memories <span class="match">#</span><span class="match">#</span>n <span class="match">#</span>e <span class="match">#</span>istorte<span class="match">#</span>. The<span class="match">#</span>'re j<span class="match">#</span>st <span class="match">#</span>n interpret<span class="match">#</span>tion, the<span class="match">#</span>'re not <span class="match">#</span> re<span class="match">#</span>or<span class="match">#</span>, <span class="match">#</span>n<span class="match">#</span> the<span class="match">#</span>'re irrele<span class="match">#</span><span class="match">#</span>nt if <span class="match">#</span>o<span class="match">#</span> h<span class="match">#</span><span class="match">#</span>e the f<span class="match">#</span><span class="match">#</span>ts.</p>
			</li>

			<li>
				<p>Match zowel colour als color</p>
				<p>String: Zowel colour als color zijn correct Engels</p>
				<p>regex: colou?r</p>
				<p>Resultaat: Zowel <span class="match">#</span> als <span class="match">#</span> zijn correct Engels</p>
			</li>

			<li>
				<p>Match enkel de getallen die een 1 als duizendtal hebben.</p>
				<p>String: 1020 1050 9784 1560 0231 1546 8745</p>
				<p>regex: 1\d{3}</p>
				<p>Resultaat: <span class="match">#</span> <span class="match">#</span> 9784 <span class="match">#</span> 0231 <span class="match">#</span> 8745</p>
			</li>

			<li>
				<p>Match alle data zodat er enkel een reeks "en" overblijft.</p>
				<p>String: 24/07/1978 en 24-07-1978 en 24.07.1978</p>
				<p>regex: (\d{1,2}[\/\.\-]){2}\d{4}</p>
				<p>Resultaat: <span class="match">#</span> en <span class="match">#</span> en <span class="match">#</span></p>
			</li>
		</ul>

    </body>
</html>