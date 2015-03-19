<?php session_start();
$titel = 'Faq';
include('bootstrapheader.php');
$t = 0;
$content = '';
if (isset($_GET['rubriek'])){
  $rubriek = $_GET['rubriek'];
}
else {
  $rubriek = '';
}
if ($rubriek == ''){
  $sql="SELECT * FROM faq_bootstrap ORDER BY id";
}
if ($rubriek != ''){
  $sql="SELECT * FROM faq_bootstrap WHERE rubriek = '$rubriek' ORDER BY id";
}
$resultaat = $db->query($sql);	
$vragenlijst = array();
while ($regel = $resultaat->fetch_array()){
  $vragenlijst[$t]['vraag'] = $regel['vraag'];
	$vragenlijst[$t]['antwoord'] = $regel['antwoord'];
	$t ++;
}
$resultaat->free();
?>
<h1>Faq</h1>
<div class="panel-group" id="accordion" style="margin-top: 20px">
<?php
for ($i=0; $i < sizeof($vragenlijst); $i++){
?>
  <div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title">
  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo "$i"; ?>">
  <?php echo "".$vragenlijst[$i]['vraag']."";?>
	</a></h4></div>
	<div id="collapse<?php echo "$i"; ?>" class="panel-collapse collapse"><div class="panel-body"><p>
	<?php echo "".$vragenlijst[$i]['antwoord']."";?>
	</p></div></div></div>
<?php
}
?>
</div>
<?php
include('bootstrapfooter.php');
?>

