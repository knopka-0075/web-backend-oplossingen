<?php session_start();
if (isset($_GET['item'])){
	$item = $_GET['item'];
}
else{
	$item = '';
}		
$titel = 'Registratielijst';		
include('bootstrapheader.php');
if (isset($_SESSION['webmaster'])){
$tabel = 'gebruikers_bootstrap';
if (isset($_GET['item'])){
  echo "<a id=\"registratielink\"></a>";
}
echo "<div class=\"row\">";
echo "<div class=\"col-lg-12\"><h1>$titel</h1>";
echo "<p><a href=\"$_SERVER[PHP_SELF]?item=nieuw\">Registratie toevoegen<span class=\"glyphicon glyphicon-pencil\"></span></a></p>";
echo "<div id=\"registratielijst\"><table><th>Gebruikersnaam</th><th>E-mailadres</th><th></th></tr>";
$items = array();
$t = 0;
$sql="SELECT * FROM $tabel ORDER BY gebruikersnaam ASC";
$resultaat = $db->query($sql);
while ($regel = $resultaat->fetch_array()){
  $id = $regel['id'];
  echo "<tr><td>".$regel['gebruikersnaam']."</td><td>".$regel['email']."</td><td><a href=\"$_SERVER[PHP_SELF]?item=$id\"><span class=\"glyphicon glyphicon-pencil\"></span></a></td></tr>";
  $t++;
}
$resultaat->free();

echo "</table></div>";

if (isset($_GET['item'])){
  $item = stripslashes($_GET['item']);
	if ($item == 'nieuw'){
	  $nieuw = true;
	}
	if ($nieuw  == false){
	  $sql="SELECT * FROM $tabel WHERE (id = '".$_GET['item']."')";
    $resultaat = $db->query($sql);
    $regel = $resultaat->fetch_array();	
		$id = $regel['id'];
		$gebruikersnaam = $regel['gebruikersnaam'];
		$gebruikerstype = $regel['gebruikerstype'];
		$email = $regel['email'];	
		$resultaat->free();
	}
	else {
	  $gebruikersnaam = '';
		$gebruikerstype = '';
		$wachtwoord = '';
	  $email = '';
	}
}
echo <<<FORMULIER
<div style="display: none"><div id="registratieformulier"><h1>Registratie</h1>
<form method="post" action="$_SERVER[PHP_SELF]">
<div class="row">
<div class="col-md-6"><p>Email:
<br><input class="form-control" type="text" name="email" value="$email" style="width: 100%"></p></div>
<div class="col-md-6"><p>Gebruikersnaam:
<br><input class="form-control" type="text" name="gebruikersnaam" value="$gebruikersnaam" style="width: 100%"></p></div></div><div class="row">
<div class="col-md-6"><p>Wachtwoord: <br><input class="form-control" type="password" name="wachtwoord" value="" style="width: 100%"></p></div>
<div class="col-md-6"><p>Gebruikerstype: <br><input class="form-control" type="text" name="gebruikerstype" value="$gebruikerstype" style="width: 100%"></p></div></div><div class="row">
<input type="hidden" name="item" value="$item">
<div class="col-md-6"><p><input class="btn btn-primary" type="submit" name="opslaan" value="Opslaan">
FORMULIER;
if ($nieuw == false){
	echo "&nbsp;&nbsp;<input class=\"btn btn-primary\" type=\"submit\" name=\"wissen\" value=\"Wissen\">";
}	
echo "</p></div></div></div></div></form></div></div>";
if ((isset($_POST['opslaan']))||(isset($_POST['wissen']))){
$gebruikersnaam = $db->real_escape_string($_POST['gebruikersnaam']);
$wachtwoord = $db->real_escape_string($_POST['wachtwoord']);
$ww = MD5($wachtwoord);
$gebruikerstype = $db->real_escape_string($_POST['gebruikerstype']);
$email = $db->real_escape_string($_POST['email']);
$item = $_POST['item'];
if ($item == 'nieuw'){
  $nieuw = true;
}
if ((isset($_POST['opslaan']))&&($nieuw == false)){ 
  if ($wachtwoord != ""){
	  $sql="UPDATE $tabel SET 
	    gebruikersnaam = '$gebruikersnaam', gebruikerstype = '$gebruikerstype', wachtwoord = '$ww', email = '$email' WHERE id = '$item'";
	}	
	if ($wachtwoord == ""){
	  $sql="UPDATE $tabel SET 
	    gebruikersnaam = '$gebruikersnaam', gebruikerstype = '$gebruikerstype', email = '$email' WHERE id = '$item'";
	}	
}	 
if (isset($_POST['wissen'])){
  $sql="DELETE from $tabel 
  WHERE id = '$item'"; 
}
if ((isset($_POST['opslaan']))&&($nieuw == true)){
	if (($gebruikersnaam == "")||($email == "")||($wachtwoord == "")){
    echo "<script>window.document.location=\"$_SERVER[PHP_SELF]?item=$item\"</script>";
  }  
	else {	
	  $sql="INSERT INTO $tabel (gebruikersnaam, gebruikerstype, wachtwoord, email) VALUES ('$gebruikersnaam', '$gebruikerstype', '$wachtwoord', '$email')";
  }
}
$db->query($sql);
echo "<script>window.document.location=\"$_SERVER[PHP_SELF]\"</script>";	
}
}
include('bootstrapfooter.php');
?>