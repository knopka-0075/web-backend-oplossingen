<?php session_start();
$titel = 'Registratie';		
include('bootstrapheader.php');
$tabel = 'gebruikers_bootstrap';
if (isset($_GET['item'])){
  echo "<a id=\"registratielink\"></a>";
}
if (isset($_GET['actie'])){
  $actie = $_GET['actie'];
}
else {
  $actie = '';
}
echo "<div class=\"row\">";
echo "<div class=\"col-lg-12\"><h1>$titel</h1>";
if (isset($_SESSION['id'])){
  if ($actie != 'wissen'){
    echo "<p><a href=\"$_SERVER[PHP_SELF]?item=".$_SESSION['id']."\">Profiel wijzigen<span class=\"glyphicon glyphicon-pencil\"></span></a></p>";
  }
  if ($actie == 'wissen'){
    echo "<h2>Je profiel is gewist.</h2>";
		session_unset();
    session_destroy();
  }
}
else {
echo "<p><a href=\"$_SERVER[PHP_SELF]?item=nieuw\">Registreren<span class=\"glyphicon glyphicon-pencil\"></span></a></p>";
}
if (isset($_GET['item'])){
  $item = $db->real_escape_string($_GET['item']);
	if ($item == 'nieuw'){
	  $nieuw = true;
	}
  else {
	  $item = $db->real_escape_string($_GET['item']); 
	}
	if (($nieuw  == false)AND(isset($_SESSION['id']))){
	  $sql="SELECT * FROM $tabel WHERE id = $item";
    $resultaat = $db->query($sql);
    $regel = $resultaat->fetch_array();	
		$id = $regel['id'];
		$voornaam = $regel['voornaam'];	
		$familienaam = $regel['familienaam'];	
		$gebruikersnaam = $regel['gebruikersnaam'];
		$email = $regel['email'];	
		$resultaat->free();
	}
}
echo <<<FORMULIER
<div style="display: none"><div id="registratieformulier"><h1>Registratie</h1>
<form method="post" action="$_SERVER[PHP_SELF]">
<div class="row">
<div class="col-md-6"><p>Voornaam: <br><input class="form-control" type="text" name="voornaam" value="$voornaam" style="width: 100%"></p></div>
<div class="col-md-6"><p>Familienaam: <br><input class="form-control" type="text" name="familienaam" value="$familienaam" style="width: 100%"></p></div></div>
<div class="row">
<div class="col-md-6"><p>Email:
<br><input class="form-control" type="text" name="email" value="$email" style="width: 100%"></p></div>
<div class="col-md-6"><p>Gebruikersnaam:
<br><input class="form-control" type="text" name="gebruikersnaam" value="$gebruikersnaam" style="width: 100%"></p></div></div>
<div class="row">
<div class="col-md-6"><p>Wachtwoord: <br><input class="form-control" type="password" name="wachtwoord" value="" style="width: 100%"></p></div></div>
<div class="row">
<input type="hidden" name="item" value="$item">
<div class="col-md-6"><p><input class="btn btn-primary" type="submit" name="opslaan" value="Opslaan">
FORMULIER;
if (($nieuw == false)AND(isset($_SESSION['id']))){
	echo "&nbsp;&nbsp;<input class=\"btn btn-primary\" type=\"submit\" name=\"wissen\" value=\"Wissen\">";
}	
echo "</p></div></div></div></div></form></div></div>";
if ((isset($_POST['opslaan']))||(isset($_POST['wissen']))){
$voornaam = $db->real_escape_string($_POST['voornaam']);
$familienaam = $db->real_escape_string($_POST['familienaam']);
$gebruikersnaam = $db->real_escape_string($_POST['gebruikersnaam']);
$wachtwoord = $db->real_escape_string($_POST['wachtwoord']);
$ww = MD5($wachtwoord);
$email = $db->real_escape_string($_POST['email']);
$item = $db->real_escape_string($_POST['item']);
if ($item == 'nieuw'){
  $nieuw = true;
}
if ((isset($_POST['opslaan']))&&($nieuw == false)){ 
  if ($wachtwoord != ""){
	  $sql="UPDATE $tabel SET 
	    voornaam = '$voornaam', familienaam = '$familienaam', gebruikersnaam = '$gebruikersnaam', wachtwoord = '$ww', email = '$email' WHERE id = '$item'";
	}	
	if ($wachtwoord == ""){
	  $sql="UPDATE $tabel SET 
	    voornaam = '$voornaam', familienaam = '$familienaam', gebruikersnaam = '$gebruikersnaam', email = '$email' WHERE id = '$item'";
	}	
}	 
if ((isset($_POST['opslaan']))&&($nieuw == true)){
	if (($gebruikersnaam == "")||($email == "")||($wachtwoord == "")){
    echo "<script>window.document.location=\"$_SERVER[PHP_SELF]?item=$item\"</script>";
  }  
	else {	
	  $sql="INSERT INTO $tabel (voornaam, familienaam, gebruikersnaam, wachtwoord, email) VALUES ('$voornaam', '$familienaam', '$gebruikersnaam', '$ww', '$email')";
  }
}
if (isset($_POST['wissen'])){
  $sql="DELETE from $tabel 
  WHERE id = '$item'"; 
	$actie = 'wissen';
}
$db->query($sql);
echo "<script>window.document.location=\"$_SERVER[PHP_SELF]?actie=$actie\"</script>";	
}
include('bootstrapfooter.php');
?>