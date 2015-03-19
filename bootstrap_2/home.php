<?php session_start();
$titel = 'Home';
include('bootstrapheader.php');
$tabel = 'content_bootstrap';
$sql="SELECT * FROM $tabel WHERE onderwerp = 'home'";
$resultaat=mysql_query($sql, $db);
if ($regel = mysql_fetch_array($resultaat)){	
  echo "".$regel['inhoud']."";
}
mysql_free_result($resultaat);
if (isset($_SESSION['webmaster'])){
  echo "<p><a class=\"btn btn-primary\" href=\"update.php?tabel=content&pagina=home\">Update home</a></p>";
}
include('bootstrapfooter.php');
?>

