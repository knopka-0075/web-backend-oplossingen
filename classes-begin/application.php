<?php
	function __autoload( $classenPercente ){
		include 'classes/' . $classenPercente . '.php';
	}

	$procent = 150;
	$vanuit = 100;

	$persent = new Percent ($procent , $vanuit);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style>

	td
	{
		padding:3px;
		border:3px solid #2804ef;
	}

	td:last-child
	{
		text-align:right;
	}

	</style>

</head>
<body>

<table>
	<caption>Hoeveel procent is <?php echo $procent ?> van <?php echo $vanuit ?>?</caption>
	<tr>
		<td>Absoluut</td>
		<td><?php echo $persent->absolute ?></td>
	</tr>
	<tr>
		<td>Relatief</td>
		<td><?php echo $persent->relative ?></td>
	</tr>
	<tr>
		<td>Geheel getal</td>
		<td><?php echo $persent->hundred ?>%</td>
	</tr>
	<tr>
		<td>Nominaal</td>
		<td><?php echo $persent->nominal ?></td>
	</tr>
</table>

</body>
</html>

