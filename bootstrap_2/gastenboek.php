<?php session_start();	
if (isset($_GET['actie'])){
  $actie = $_GET['actie'];
	$item = $_GET['item'];
}
else{
  $actie = '';
	$item = '';
}
$titel = 'Gastenboek';	
include('bootstrapheader.php');
$tabel = 'gastenboek_bootstrap';
echo "<h1>Gastenboek</h1>";
if ($actie == ''){
echo "<p><a  class=\"btn btn-primary\" href=\"$_SERVER[PHP_SELF]?actie=invullen\">Teken gastenboek</a></p>";
$sql="SELECT * FROM $tabel ORDER BY id DESC";
$resultaat=mysql_query($sql, $db);
while ($regel = mysql_fetch_array($resultaat)){
  $id = $regel['id'];
	$naam = $regel['naam'];
	$email = $regel['email'];
  $boodschap = $regel['boodschap'];
	$datum = $regel['datum'];
	$datum = substr($datum,8,2)."-".substr($datum,5,2)."-".substr($datum,0,4);
	$controle = $regel['controle']; 
  if ($controle == 'ok'){	
    echo "<div style=\"background: rgb(240, 240, 240); padding: 10px 30px; margin-bottom: 15px; border-radius: 10px; box-shadow: 4px 4px 4px rgb(200,200,200)\">
		<em>$naam - <a href=\"mailto: $email\">$email</a> - $datum</em><br>$boodschap<br>";
		if (isset($_SESSION['webmaster'])){
		  echo "<a href=\"$_SERVER[PHP_SELF]?actie=verbergen&item=$id\">Verbergen</a> ";
			echo "<a href=\"$_SERVER[PHP_SELF]?actie=wissen&item=$id\">Wissen</a>";
		}
		echo "</div>";	
	}
	else {
	  if (isset($_SESSION['webmaster'])){
	    echo "<div style=\"padding: 10px; margin-bottom: 15px; background: orange; border-radius: 10px; box-shadow: 4px 4px 4px rgb(200,200,200)\"\">
			<em>$naam - <a href=\"mailto: $email\">$email</a> - $datum</em><br />$boodschap<br>";
		  echo "<a href=\"$_SERVER[PHP_SELF]?actie=tonen&item=$id\">Tonen</a> ";
			echo "<a href=\"$_SERVER[PHP_SELF]?actie=wissen&item=$id\">Wissen</a></div>";
		}	
	}
}
}
if (($actie != '')AND($actie != 'invullen')){	
  if ($actie == 'tonen'){
    $sql="UPDATE $tabel SET controle = 'ok' WHERE id = '$item'";
	}
	if ($actie == 'verbergen'){
	  $sql="UPDATE $tabel SET controle = '' WHERE id = '$item'";
	}		
  if ($actie == 'wissen'){
    $sql="DELETE from $tabel WHERE id = '$item'";
	}	
  $resultaat=mysql_query($sql, $db);
  echo "<script type=\"text/javascript\">window.document.location=\"$_SERVER[PHP_SELF]\"</script>";
}
if ($actie == 'invullen'){
echo "<p><a class=\"btn btn-primary\" href=\"$_SERVER[PHP_SELF]\">Lees gastenboek</a></p>";
$datum = date("Y-m-d");
$robot = true;
if (isset($_POST['verstuur'])){
  $naam = $_POST['naam'];
	$email = $_POST['email'];
  $boodschap = $_POST['boodschap'];
	if (md5($_POST['norobot']) == $_SESSION['randomnr2']){
	  $robot = false;
	}
}
else {
  $naam = '';
  $email = '';
	$boodschap = '';
}	
$tekenreeks = '#[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})#';
$geldigadres =(preg_match($tekenreeks,$email));
if (($naam == "")||($email == "")||($boodschap == "")||($geldigadres == false)||($robot == true)){
echo "<form method=\"post\" action=\"$_SERVER[PHP_SELF]?actie=invullen\">";
echo "<div class=\"row\"><div class=\"col-md-5\"><p>Naam: ";
if ((isset($_POST['verstuur']))AND($naam == "")){
  echo "<span class=\"aandacht\">De naam ontbreekt.</span>";
}
echo "<br><input class=\"form-control\" type=\"text\" name=\"naam\" value=\"$naam\"></p></div>";
echo "<div class=\"col-md-5\"><p>E-mail: ";
if ((isset($_POST['verstuur']))AND($email == "")){
  echo "<span class=\"aandacht\">Het e-mailadres ontbreekt.</span>";
}
if (($email != "")&&($geldigadres == false)){
  echo "<span class=\"aandacht\">Het e-mailadres is ongeldig.</span>";
}	
echo "<br><input class=\"form-control\" type=\"text\" name=\"email\" value=\"$email\"></p></div></div><div class=\"row\"><div class=\"col-md-10\">Bericht: <br>";
if ((isset($_POST['verstuur']))AND($boodschap == "")){
  echo "<span class=\"aandacht\">Het bericht ontbreekt.</span>";
}
echo <<<FORMULIER
<textarea class="form-control" style="width: 100%; height: 100px" name="boodschap">$boodschap</textarea></div></div>
<div class="row"><div class="col-md-3">
<p style="margin-top: 10px"><img src="captcha.php"></p>
<p>Typ de tekens hierboven over: <input class="form-control" type="text" name="norobot"></p>
<p><input class="btn btn-primary" type="submit" name="verstuur" value="Teken gastenboek" /></p></div></div></form>
FORMULIER;
}
elseif ((strtolower(substr($email, -9)) == 'yahoo.com')OR
       (strtolower(substr($email, -7)) == 'aol.com')OR
			 (strtolower(substr($email, -7)) == 'mail.ru')){}
else {
  $sql="INSERT INTO $tabel (naam, email, datum, boodschap) 
  VALUES ('$naam', '$email', '$datum', '$boodschap')";
  mysql_query($sql, $db);	
	
	$bericht = <<<BOODSCHAP
  <!DOCTYPE html>
  <head><title>Gastenboek</title>
  <style type="text/css">body {font: 12px verdana} h1 {font: bold 14px verdana}</style>
  </head><body><h1>Gastenboek</h1>
	<p>Er is een nieuw bericht in het gastenboek.</p>
  <p>Naam: $naam</p>
  <p>E-mail: <a href="mailto:$email">$email</a></p>
  <p>Bericht: <br />$boodschap</p></body></html>
BOODSCHAP;
	$headers = "MIME-Version: 1.0\r\n";
  $headers.= "Content-Type: text/html; charset=iso-8859-1\r\n";
  $headers.= "Reply-To: Harry Van Bavel <info@harryvanbavel.be>\r\n"; 
  $headers.= "Return-Path: Harry Van Bavel <info@harryvanbavel.be>\r\n";
  $headers.= "From: Harry Van Bavel <info@harryvanbavel.be>\r\n";
  $headers.= "X-Priority: 3\r\n";
  $headers.= "X-Mailer: PHP". phpversion() ."\r\n";
  mail('harryvanbavel@hotmail.com', 'Bericht in het gastenboek', $bericht, $headers);
	echo "<script>window.document.location=\"$_SERVER[PHP_SELF]\"</script>";
}
}
include('bootstrapfooter.php');
?>