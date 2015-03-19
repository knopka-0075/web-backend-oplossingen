<?php
$titel = 'Fotogalerij';
include('bootstrapheader.php');
$hoofdmap = 'fotoalbum';
$thumbnails = "thumbs";
$mapnummering = 4;
if (isset($_GET['fotomap'])){
  $hoofdmap = $_GET['fotomap']; 
}
if (isset($_GET['map'])){
$map = ($_GET['map']).'/'.$thumbnails;
$mapgroot = substr($map, 0, -(strlen($thumbnails)+1));
$maptitel = ucfirst(substr(($mapgroot), strlen($hoofdmap)+$mapnummering));
$bestanden = array();
$b = 0;
$overzicht = opendir($map);
while ($bestand = readdir($overzicht)) {
	if (strtolower(substr($bestand, -3)) == 'jpg'){
    $bestanden[$b] = $bestand;
		$b++;
	}	
}
closedir($overzicht);
sort($bestanden);
$h1 = "<a href=\"$_SERVER[PHP_SELF]\">Alle albums</a>";
}
else {
  $h1 = 'Fotogalerij';
}
echo "<div id=\"albumcontent\"><h1>$h1</h1>";
$galerij = "";
$bestanden = array();
$ids = array();
$b = 0;
$teller = 0;
$overzicht = opendir($hoofdmap);
while ($bestand = readdir($overzicht)) {
	if (($bestand != '.')AND($bestand != '..')){
    $bestanden[$b] = $bestand;		
		$map = "$hoofdmap/$bestanden[$b]";
	  $thumbnailsmap = "$map/thumbs";
	  $b++;			
	}	
}
closedir($overzicht);
sort($bestanden);
reset($bestanden);
$fotoblokken = array();
for ($t = 0; $t < sizeof($bestanden); $t ++){
  $map = "$hoofdmap/$bestanden[$t]";
	$thumbnailsmap = "$map/thumbs";	
	$titel = ucfirst(substr(($map), strlen($hoofdmap)+$mapnummering));
	$bestanden2 = array();
  $b = 0;
  $overzicht = opendir($map);
  while ($bestand = readdir($overzicht)) {
	  if (strtolower(substr($bestand, -3)) == 'jpg'){
      $bestanden2[$b] = $bestand;				
		  $b++;
		}	
  }
  closedir($overzicht);
  $aantal = sizeof($bestanden2) - 1;
  $nummer = mt_rand(0, $aantal);
	$foto = "$map/$bestanden2[$nummer]";
  list($breedte, $hoogte) = getimagesize("$foto");
  if ($breedte > $hoogte){
    $class = 'horizontaal';   
  }
  else {
    $class = 'verticaal';
  }
	$fotoreeks[$t]['src'] = "$map/$bestanden2[$nummer]";
	$fotoreeks[$t]['class'] = $class; 
	$foto = "$map/$bestanden2[$nummer]";
	$fotoblokken[$t] = "<a title=\"$titel\" href=\"$_SERVER[PHP_SELF]?map=$map\"><div class=\"fotoblok\" id=\"fotoblok$t\"><div class=\"crop\">";
	$fotoblokken[$t].= "<img src=\"".$fotoreeks[$t]['src']."\" class=\"".$fotoreeks[$t]['class']."\" alt=\"$titel\"></div>";
	$fotoblokken[$t].= "<p>$titel</p>";
	$fotoblokken[$t].="</div></a>";
}
if (!isset($_GET['map'])){
	echo "<div id=\"galerijcontainer\">";
  for ($t = 0; $t < sizeof($fotoblokken); $t ++){
    echo "".$fotoblokken[$t]."";
  }
  echo "</div>"; 
}
if (isset($_GET['map'])){
$map = ($_GET['map']).'/thumbs';
$map = str_replace('//', '/', $map);
$mapgroot = str_replace('/thumbs', '', $map);
$maptitel = ucfirst(substr(($mapgroot), strlen($hoofdmap)+$mapnummering));
echo "<h2>$maptitel</h2>";
echo "<div id=\"albumcontainer\">";
$bestanden = array();
$t = 0;
$overzicht = opendir($map);
  while ($bestand = readdir($overzicht)) {
	  if ((strtolower(substr($bestand, -3)) == 'jpg')AND($t < 50)){
		  list($breedte, $hoogte) = getimagesize("$map/$bestand");
      if ($breedte > $hoogte){
        $class = 'horizontaal';   
      }
      else {
        $class = 'verticaal';
      }
	    $bestanden[$t]['src'] = "$map/$bestand";
			$bestanden[$t]['groot'] = "$mapgroot/$bestand";
	    $bestanden[$t]['class'] = $class; 
		  $t++;
		}	
  }
closedir($overzicht);
sort($bestanden);
for ($t = 0; $t < sizeof($bestanden); $t ++){
  $titel = ucfirst(substr(($mapgroot), strlen($hoofdmap)+1));
	echo "<a rel=\"album\" href=\"".$bestanden[$t]['groot']."\" title=\"$maptitel\">";
	echo "<div class=\"crop\"><img alt=\"\" src=\"".$bestanden[$t]['src']."\" class=\"".$bestanden[$t]['class']."\"></div></a>"; 
}
echo "<div style=\"clear: both\"></div></div>";
echo <<<ALBUM
<script>
$(function() {
	  $("a[rel=album]").fancybox({
		  'helpers':       {title : {type : 'inside'}},	
	    'openEffect':    'elastic',
		  'closeEffect':   'elastic',
			'fitToView':     'true',
      'autoSize':      'true',
			'beforeShow': function() {
        this.title = (this.title ? '' + this.title + ' - ' : '') + (this.index + 1) + ' / ' + this.group.length + '';
      }
	});
});
</script>
ALBUM;
}
echo "<div style=\"clear: both\"></div></div>";
include('bootstrapfooter.php');
?>