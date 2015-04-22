<?php
	$regular = '';
	$string = '';
	$result = false;

	if(isset($_POST['submit']))
	{
		$regular = $_POST['regular'];
		$search = $_POST['string'];
		$replase = '#';

		$result = preg_replace('/' . $regular . '/', $replase, $search);
	}

?>
<!DOCTYPE html>
<html>
<head>
</head>
	<body>
		<form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
			<p> <label for="regular">Regular expression</label></p>
			<p> <input type="text" name="regular" id="regular" value="<?= $regular ?>"> </p>
			<p> <label for="string">Srting</label></p>
			<p> <input type="text" name="string" name="string" id="string" value="<? $search?>"></p>
			<input type="submit" name="submit">
		</form>
		
		<?php if ($result):?>
		<p><?= $result ?></p>
	<?php endif?>

	<h4>Match alle letters tussen a en d, en u en z (hoofdletters inclusief)</h4>
	<p>String: Memory can change the shape of a room; it can change the color of a car. And memories can be distorted. They're just an interpretation, they're not a record, and they're irrelevant if you have the facts.</p>

	<p>[a-du-zA-DU-Z]</p>

	<h4>Match zowel colour als color</h4>
	<p>String: Zowel colour als color zijn correct Engels.</p>

	<p>colou?r</p>
	<p>colo[u]?r</p>

	<h4>Match enkel de getallen die een 1 als duizendtal hebben.</h4>
	<p>String: 1020 1050 9784 1560 0231 1546 8745</p>

	<p>1\d\d\d</p>

	<h4>Match alle data zodat er enkel een reeks "en" overblijft.</h4>
	<p>String: 24/07/1978 en 24-07-1978 en 24.07.1978<p>

	<p>(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d</p>
	<p>[0-9]{2}[\/\-\.][0-9]{2}[\/\-\.][0-9]{4}</p>		

	</body>
</html>