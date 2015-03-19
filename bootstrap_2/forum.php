<?php session_start();	
$titel = 'Forum';	
include('bootstrapheader.php');
if (isset($_GET['actie'])){
  $actie = ($_GET['actie']);
	$item = ($_GET['item']);
}
else{
  $actie = '';
	$item = '';
}
$tabel = 'forum_bootstrap';
echo "<h1>Forum</h1>";
if ($actie == ''){
  if (isset($_SESSION['id'])){
    echo "<p><a  class=\"btn btn-primary\" href=\"$_SERVER[PHP_SELF]?actie=invullen\">Verstuur een nieuw bericht</a></p>";
	}
	else {
	  echo "<p>Om een bericht te versturen of te reageren, moet je ingelogd zijn.</p><p><a class=\"btn btn-primary\" href=\"admin.php\">Inloggen</a></p>"; 
	}	
$sql="SELECT voornaam, familienaam, datum, onderwerp, inhoud, forum_bootstrap.id FROM gebruikers_bootstrap INNER JOIN forum_bootstrap ON gebruikers_bootstrap.id = forum_bootstrap.auteur_id ORDER BY onderwerp DESC";
$resultaat = $db->query($sql);	
$vorigonderwerp = '';
while ($regel = $resultaat->fetch_array()){
  $onderwerp = $regel['onderwerp'];
	$id = $regel['id'];
	if ($onderwerp == $vorigonderwerp){
	  $marge = '50';  
	}
  echo "<div style=\"margin-left:".$marge."px\"<p><em>".$regel['voornaam']." ".$regel['familienaam']." - ".$regel['datum']."</em></p>";
	echo "<strong>".strtoupper($onderwerp)."</strong></p><p>".$regel['inhoud']."</p>";
	if (($onderwerp != $vorigonderwerp)AND(isset($_SESSION['id']))){
	  echo "<p><a  class=\"btn btn-primary\" href=\"$_SERVER[PHP_SELF]?actie=invullen&onderwerp=$onderwerp\">Reageer</a></p>";
	}
	echo "</div>";
	if (isset($_SESSION['webmaster'])){
    echo "<p><a href=\"$_SERVER[PHP_SELF]?actie=wissen&item=$id\">Wissen</a></p>";
	}
	echo "<div style=\"margin: 20px 0px; border-bottom: 1px solid blue\"></div>";	
	$vorigonderwerp = $onderwerp;
	$marge = '0';
}
}
if ($actie == 'wissen'){
  $sql="DELETE from forum_bootstrap WHERE id = '$item'";	
  $resultaat = $db->query($sql);
  echo "<script>window.document.location=\"$_SERVER[PHP_SELF]\"</script>";
}
if ($actie == 'invullen'){
  echo "<p><a class=\"btn btn-primary\" href=\"$_SERVER[PHP_SELF]\">Lees berichten</a></p>";
  $datum = date("Y-m-d");
  $sql="SELECT * FROM gebruikers_bootstrap WHERE id = '".$_SESSION['id']."'";
  $resultaat = $db->query($sql);
  if ($regel = $resultaat->fetch_array()){
    $naam = $regel['voornaam']." ".$regel['familienaam'];
  }
  $resultaat->free();		
  if (isset($_POST['verstuur'])){
    $naam = ($_POST['naam']);
	  $onderwerp = ($_POST['onderwerp']);
    $boodschap = ($_POST['boodschap']);
  }
  else {
    if (isset($_GET['onderwerp'])){
	    $onderwerp = $_GET['onderwerp'];
	  } 
	  else {	
      $onderwerp = '';
	  }
	  $boodschap = '';
}	
if (($naam == "")||($onderwerp == "")||($boodschap == "")){
  echo "<form method=\"post\" action=\"$_SERVER[PHP_SELF]?actie=invullen\">";
  echo "<div class=\"form-group\"><div class=\"col-md-6\"><p>Naam: ";
  if ((isset($_POST['verstuur']))AND($naam == "")){
    echo "<span class=\"aandacht\">De naam ontbreekt.</span>";
  }
  echo "<br><input class=\"form-control\" type=\"text\" name=\"naam\" value=\"$naam\"></p></div>";
  echo "<div class=\"col-md-6\"><p>Onderwerp: ";
  if ((isset($_POST['verstuur']))AND($onderwerp == "")){
    echo "<span class=\"aandacht\">Het onderwerp ontbreekt.</span>";
  }
  echo "<br><input class=\"form-control\" type=\"text\" name=\"onderwerp\" value=\"$onderwerp\"></p></div></div><div class=\"form-group\"><div class=\"col-md-12\">Bericht: <br>";
  if ((isset($_POST['verstuur']))AND($boodschap == "")){
    echo "<span class=\"aandacht\">Het bericht ontbreekt.</span>";
  }
  echo <<<FORMULIER
<textarea class="form-control" style="width: 100%; height: 100px" name="boodschap">$boodschap</textarea></div></div>
<div class="form-group"><div class="col-md-5"><br>
<button type="submit" name="verstuur" class="btn btn-primary">Verstuur bericht</button></div></div></form>
FORMULIER;
}
else {
  $auteur_id = $_SESSION['id'];
  $sql="INSERT INTO $tabel (onderwerp, inhoud, datum, auteur_id) 
  VALUES ('$onderwerp', '$boodschap', '$datum', '$auteur_id')";
  $resultaat = $db->query($sql);	
	echo "<script>window.document.location=\"$_SERVER[PHP_SELF]\"</script>";
}
}
include('bootstrapfooter.php');
?>