<?php
$titel = 'Route'; 
include('bootstrapheader.php');
if (isset($_GET['start'])){
  $startadres = $_GET['start'];
}
else {
  $startadres = 'Oude Galgenstraat 166, Kapellen';
}
if (isset($_GET['vervoer'])){
  $vervoer = $_GET['vervoer'];
  $adres1 = $_GET['adres1'];
	$adres2 = $_GET['adres2'];
}
else {
  $vervoer = 'DRIVING';
	$adres2 = $startadres;
}
if (isset($_POST['route'])){
  $adres1 = $_POST['adres1'];
	$adres2 = $_POST['adres2'];
}
if (isset($_POST['terug'])){
  $adres1 = $_POST['adres2'];
	$adres2 = $_POST['adres1'];
}
/*
$startpositie = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$startadres.'&sensor=false');
$startpositie = json_decode($startpositie);
$lat = $startpositie->results[0]->geometry->location->lat;
$lng = $startpositie->results[0]->geometry->location->lng;
*/
$content = <<<ROUTE
<h1>$titel</h1>
<p id="vervoerlinks">
<a class="btn btn-success" href="$_SERVER[PHP_SELF]?vervoer=DRIVING&amp;adres1=$adres1&amp;adres2=$adres2">Auto</a>&nbsp;
<a class="btn btn-success" href="$_SERVER[PHP_SELF]?vervoer=BICYCLING&amp;adres1=$adres1&amp;adres2=$adres2">Fiets</a>&nbsp;
<a class="btn btn-success" href="$_SERVER[PHP_SELF]?vervoer=WALKING&amp;adres1=$adres1&amp;adres2=$adres2">Te voet</a>&nbsp;
<a class="btn btn-success" href="$_SERVER[PHP_SELF]?vervoer=TRANSIT&amp;adres1=$adres1&amp;adres2=$adres2">Openbaar vervoer</a>
</p>
<form method="post" action="$_SERVER[PHP_SELF]">
<div class="form-group col-md-4" style="padding-left: 0px">
<input class="form-control" type="text" name="adres1" value="$adres1">
</div>
<div class="form-group col-md-4" style="padding-left: 0px">
<input class="form-control" type="text" name="adres2" value="$adres2">
</div>
<div class="form-group col-md-4" style="padding-left: 0px">
<button class="btn btn-primary" type="submit" name="route">Route</button>
<button class="btn btn-primary" type="submit" name="terug">Terug</button>
</div>
</form>
<div id="mapcontainer">
<div id="map"></div>
<div id="mapdirections"></div>
</div>
ROUTE;
echo "$content";
echo <<<ROUTE2
<script src="http://maps.google.se/maps/api/js?sensor=false"></script>
<script>
(function () {
  var rendererOptions = {
  draggable: true
  };
  var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
  var directionsService = new google.maps.DirectionsService();
	createMap = function (start) {
	  var travel = {
			origin : "$adres1",
			destination : "$adres2",
			travelMode : google.maps.DirectionsTravelMode.$vervoer
		},
		mapOptions = {
		  zoom: 10,
			//center : new google.maps.LatLng($lat,$lng),
			center : new google.maps.LatLng(51.3607591,4.4450579),
		  mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);	
		var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
		var marker = new google.maps.Marker({
    //position: new google.maps.LatLng($lat,$lng),
		position: new google.maps.LatLng(51.3607591,4.4450579),
    map: map,
		clickable: true, 
		icon: iconBase + 'info-i_maps.png',
    shadow: iconBase + 'info-i_maps.shadow.png',	
		title: '$startadres'
    });
		
		marker.info = new google.maps.InfoWindow({
    content: '<h1>$startadres</h1>'});
    google.maps.event.addListener(marker, 'click', function() {
    marker.info.open(map, marker);
});
		
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById("mapdirections"));
		directionsService.route(travel, function(result, status) {
		  if (status === google.maps.DirectionsStatus.OK) {
			  directionsDisplay.setDirections(result);
			}
		});	
	};
	window.onload = function() {createMap({coords : false});};
})();
</script>
ROUTE2;
include('bootstrapfooter.php');
?>