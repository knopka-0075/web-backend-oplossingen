<?php session_start();
if (isset($_GET['id'])){
  $briefid = $_GET['id'];
}
$titel = "Nieuwsbrieven";	
include('bootstrapheader.php');
$tabel = 'nieuwsbrieven_bootstrap';
$sql="SELECT * FROM $tabel WHERE id = '$briefid'";
$resultaat=mysql_query($sql, $db);
if ($regel = mysql_fetch_array($resultaat)){
  $onderwerp = $regel['onderwerp'];	
  $inhoud = $regel['inhoud'];
	$datum = $regel['datum'];
	$id = $regel['id'];
	echo "<h1>".ucfirst($onderwerp)."</h1>$inhoud";
}
mysql_free_result($resultaat);
if ((isset($_SESSION['webmaster']))OR(isset($_SESSION['assistent']))){
  echo "<p><a class=\"btn btn-primary\" href=\"update.php?tabel=nieuws&pagina=$onderwerp\">Update $onderwerp</a></p>";
}
include('bootstrapfooter.php');
?>
