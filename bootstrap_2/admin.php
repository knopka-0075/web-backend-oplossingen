<?php session_start();
$titel = 'Admin';
include('bootstrapheader.php');
$login = false;
if (isset($_SESSION['id'])){
  $login = true;
}
if ($login == false){
$tabel = 'gebruikers_bootstrap';
if (isset($_POST['verstuur'])){
  $gebruikersnaam = $db->real_escape_string($_POST['gebruikersnaam']);
  $wachtwoord = $db->real_escape_string($_POST['wachtwoord']);
}
else {
  $gebruikersnaam = '';
	$wachtwoord = '';
}	
$webmaster = '';
$assistent = '';
$gebruikerstype = '';
$ww = MD5($wachtwoord);
if (($gebruikersnaam != '')AND($wachtwoord != '')){
$sql="SELECT * FROM $tabel WHERE gebruikersnaam = '$gebruikersnaam' AND wachtwoord = '$ww'";
$resultaat = $db->query($sql);
if ($regel = $resultaat->fetch_array()){
	$gebruikerstype = $regel['gebruikerstype'];
	if (($gebruikersnaam == $regel['gebruikersnaam'])AND($ww == $regel['wachtwoord'])){
	  $_SESSION['voornaam'] = $regel['voornaam'];
		$_SESSION['familienaam'] = $regel['familienaam'];
		$_SESSION['email'] = $regel['email'];
		$_SESSION['id'] = $regel['id'];
	if ($gebruikerstype == 'webmaster'){	  
	  $_SESSION['webmaster'] = $gebruikersnaam;	
	}	
	if ($gebruikerstype == 'assistent'){	
	  $_SESSION['assistent'] = $gebruikersnaam;			
	}
	if ($gebruikerstype == 'klant'){	
	  $_SESSION['klant'] = $gebruikersnaam;		
	}
	$login = true;
	}
$resultaat->free();		
}
}
if (($gebruikersnaam == "")||($wachtwoord == "")||($login == false)){
echo <<<LOGIN
<h1>Je bent niet ingelogd.</h1>
<div class="row" style="margin-top: 20px">
<div class="col-md-6 col-md-offset-3">
<div class="well well-sm">
<form class="form-horizontal" name="login" method="post" action="$_SERVER[PHP_SELF]"><fieldset>
<legend class="text-center">Admin</legend>
<div class="form-group">
<label class="col-md-3 control-label" for="gebruikersnaam">Gebruikersnaam</label>
<div class="col-md-9">
<input class="form-control" type="text" name="gebruikersnaam" value="$gebruikersnaam">
</div></div>
<div class="form-group">
<label class="col-md-3 control-label" for="wachtwoord">Wachtwoord</label>
<div class="col-md-9">
<input class="form-control" type="password" name="wachtwoord" value="$wachtwoord">
</div></div>
<div class="form-group">
<div class="col-md-12 text-right">
<button class="btn btn-primary" type="submit" name="verstuur">Inloggen</button></div></div></fieldset>
LOGIN;
if (isset($_POST['verstuur'])){
	echo "<div style=\"color:red\">De inloggegevens zijn fout.</div>";	
}
echo "</form></div><p><a href=\"registratie.php?item=nieuw\">Nieuwe gebruiker</a></p></div></div>";
}
}
if ($login == true){
  if (isset($_SESSION['webmaster'])){ 
	  echo "<h1>Je bent ingelogd als webmaster.</h1>";
    echo "<a class=\"btn btn-primary\" title=\"Nieuwe pagina\" href=\"update.php?tabel=content_bootstrap&pagina=nieuw\">Nieuwe pagina</a>"; 
  }
	if (isset($_SESSION['assistent'])){ 
	  echo "<h1>Je bent ingelogd als assistent.</h1>";
	}
	if (isset($_SESSION['webmaster'])OR(isset($_SESSION['assistent']))){ 	
    echo "<a class=\"btn btn-primary\" style=\"margin-left: 20px\" title=\"Nieuwe brief\" href=\"update.php?tabel=nieuwsbrieven_bootstrap&pagina=nieuw\">Nieuwe brief</a>";
  }
	echo "<a class=\"btn btn-primary\" style=\"margin-left: 20px\" title=\"Profiel wijzigen\" href=\"registratie.php?item=".$_SESSION['id']."\">Profiel wijzigen</a>";
  echo "<a class=\"btn btn-primary\" style=\"margin-left: 20px\" title=\"Logout\" href=\"$_SERVER[PHP_SELF]?actie=logout\">Logout</a>";
}
if (isset($_GET['actie'])){
  $actie = $_GET['actie'];
}
if ($actie == 'logout'){
  session_unset();
  session_destroy();
	echo "<script>window.document.location=\"$_SERVER[PHP_SELF]\"</script>";
}	
include('bootstrapfooter.php');
?>
