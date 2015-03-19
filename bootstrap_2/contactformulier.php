<?php
$titel = 'Contactformulier';
include('bootstrapheader.php');
if (isset($_POST['verstuur'])){
  $adres = $_POST['adres'];	
  $naam = $_POST['naam'];
	$email = $_POST['email'];
  $bericht = $_POST['bericht'];
	$tekenreeks = '#[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})#';
  $geldigadres =(preg_match($tekenreeks,$email));
	
}
else {
	$naam = "";
	$email = "";
	$bericht = "";
}
if (($naam == "")||($email == "")||($bericht == "")||($geldigadres == false)){
echo <<<FORMULIER
<div class="row" style="margin-top: 20px">
<div class="col-md-6 col-md-offset-3">
<div class="well well-sm">
<form class="form-horizontal" action="contactformulier.php" method="post">
<input type="hidden" name="adres" value="harryvanbavel@hotmail.com">
<input type="hidden" name="mailonderwerp" value="Contactformulier van Harry Van Bavel">
<fieldset>
<legend class="text-center">Contacteer ons</legend>
<div class="form-group">
<label class="col-md-3 control-label" for="naam">Naam</label>
<div class="col-md-9">
<input id="naam" name="naam" type="text" placeholder="Uw naam" class="form-control" value="$naam" required aria-required="true">
</div>
</div>
<div class="form-group">
<label class="col-md-3 control-label" for="email">E-mail</label>
<div class="col-md-9">
<input id="email" name="email" type="email" placeholder="Uw e-mailadres" class="form-control" value="$email" required aria-required="true">
</div>
</div>
<div class="form-group">
<label class="col-md-3 control-label" for="message">Bericht</label>
<div class="col-md-9">
<textarea class="form-control" id="bericht" name="bericht" placeholder="Typ hier uw bericht ..." rows="5" required aria-required="true">$bericht</textarea>
</div>
</div>
<div class="form-group">
<div class="col-md-12 text-right">
<button type="submit" name="verstuur" class="btn btn-primary">Verstuur</button>
</div>
</div>
</fieldset>
</form>
</div>
</div>
</div>
FORMULIER;
}
else {
echo "<h2>Het bericht werd met succes verstuurd.</h2>";
$antwoord = <<<ANTWOORD
  <!DOCTYPE html">
  <html><head><title>$mailonderwerp</title>
	<meta charset="ISO-8859-1">
  <style type="text/css">body {font: 12px verdana}</style>
  </head><body><p>Dag $naam </p>
  <p>Dit is een automatisch antwoord van www.harryvanbavel.be.<br>
  Bedankt voor het invullen van het formulier.
  Ik probeer je vraag zo snel mogelijk te beantwoorden.</p>
  <p>Met vriendelijke groet<br />Harry Van Bavel</body></html>
ANTWOORD;

$bericht = str_replace("\n", "<br />", $bericht);
$boodschap = <<<BOODSCHAP
  <!DOCTYPE html">
  <html><head><title>$mailonderwerp</title>
	<meta charset="ISO-8859-1">
  <style type="text/css">body {font: 12px verdana} h1 {font: bold 14px verdana}</style>
  </head><body><h1>Reactie op webformulier</h1>
  <p>Naam: $naam</p>
  <p>E-mail: <a href="mailto:$email">$email</a></p>
  <p>Bericht: <br />$bericht</p></body></html>
BOODSCHAP;
$headers = "MIME-Version: 1.0\r\n";
$headers.= "Content-Type: text/html; charset=iso-8859-1\r\n";
$headers.= "Reply-To: Harry Van Bavel <info@harryvanbavel.be>\r\n"; 
$headers.= "Return-Path: Harry Van Bavel <info@harryvanbavel.be>\r\n";
$headers.= "From: Harry Van Bavel <info@harryvanbavel.be>\r\n";
$headers.= "X-Priority: 3\r\n";
$headers.= "X-Mailer: PHP". phpversion() ."\r\n";
mail($adres, $mailonderwerp, $boodschap, $headers);
mail($email, $mailonderwerp, $antwoord, $headers);
}
include('bootstrapfooter.php');
?>

