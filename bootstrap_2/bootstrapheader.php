<?php
echo <<<HEADER
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Harry Van Bavel - $titel</title>
<link href="bootstrap-3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap-3.2.0/css/bootstrap-touch-carousel.css" rel="stylesheet">
<link href="bootstrap-3.2.0/css/bootstrap-modal-carousel.min.css" rel="stylesheet">
<link href="bootstrap-3.2.0/css/typeahead.css" rel="stylesheet">
<link href="fancybox/jquery.fancybox.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="tinymce/tinymce.min.js"></script>
<script src="bootstrap-3.2.0/js/typeahead.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="bootstrapstijlblad.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div id="carousel1" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
<li data-target="#carousel1" data-slide-to="0" class="active"></li>
<li data-target="#carousel1" data-slide-to="1"></li>
<li data-target="#carousel1" data-slide-to="2"></li>
<li data-target="#carousel1" data-slide-to="3"></li>
<li data-target="#carousel1" data-slide-to="4"></li>
</ol>
<div class="carousel-inner">
<div class="item active"><img src="afbeeldingen/engeland1.jpg" alt="Foto 1">
</div>
<div class="item"><img src="afbeeldingen/engeland2.jpg" alt="Foto 2"></div>
<div class="item"><img src="afbeeldingen/engeland3.jpg" alt="Foto 3"></div>			
<div class="item"><img src="afbeeldingen/engeland4.jpg" alt="Foto 4"></div>
<div class="item"><img src="afbeeldingen/engeland5.jpg" alt="Foto 5"></div>		
</div>
<a class="left carousel-control" href="#carousel1" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
<a class="right carousel-control" href="#carousel1" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<div class="navbar" role="navigation">
<div class="navbar-header">
<button type="button" class="navbar-toggle">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="home.php">Harry Van Bavel</a>
</div>
<div id="menu" class="navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="home.php">Home</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">FAQ <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li><a href="faq.php">FAQ</a></li>
<li><a href="faq.htm">FAQ2</a></li>
</ul></li>
<li><a href="bootstrap.php">Bootstrap</a></li>
<li><a href="video.php">Video</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Fotogalerij <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li><a href="fotogalerij1.php">Fotogalerij 1</a></li>
<li><a href="fotogalerij2.php">Fotogalerij 2</a></li>
<li><a href="fotogalerij3.php">Fotogalerij 3</a></li>
<li><a href="fotogalerij4.php">Fotogalerij 4</a></li>
</ul></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Contact <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li><a href="contactgegevens.php">Contactgegevens</a></li>
<li><a href="contactformulier.php">Contactformulier</a></li>
<li><a href="route.php">Route</a></li>
</ul></li>
<li><a href="forum.php">Forum</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Nieuwsbrief <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
HEADER;
include('databaseverbinding.php');
$sql="SELECT * FROM nieuwsbrieven_bootstrap ORDER BY datum DESC";
  $resultaat=mysql_query($sql, $db);
  while ($regel = mysql_fetch_array($resultaat)){
    $onderwerp = ucfirst($regel['onderwerp']);	
	  $id = $regel['id'];
		echo "<li><a href=\"nieuwsbrief.php?id=$id\">$onderwerp</a></li>";
  }
mysql_free_result($resultaat);
echo "</ul>
</li>

</ul>
</div>
</div>
<div class=\"container\" id=\"contentcontainer\"><div class=\"container\">";
?>