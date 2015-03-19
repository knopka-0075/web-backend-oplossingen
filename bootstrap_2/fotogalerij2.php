<?php
$titel = 'Fotogalerij';
include('bootstrapheader.php');
if (!isset($_GET['album'])){
$h1 = 'Fotogalerij';
echo <<<GALERIJ
<script>
$(document).ready(function($) {
	albums = "https://picasaweb.google.com/data/feed/base/user/111649056822543210831?alt=json&kind=album&hl=nl&access=public&imgmax=150";
	$.getJSON(albums, function(data) {
	var albumreeks = [];
  var entry = data.feed.entry;
  for (var i = 0; i < entry.length; i++) {
	  var urlthumb = entry[i].media\$group.media\$content[0].url+'?imgmax=150';
    albumreeks.push('<a href="$_SERVER[PHP_SELF]?album=' + entry[i].id.\$t + '"><div><img src="'+ urlthumb + '"><p>' + entry[i].title.\$t + '</p></div></a>'); 
  }
   $('#picasabox').html(albumreeks);
  });	
});
</script>
GALERIJ;
}
if ((isset($_GET['album']))AND(!isset($_GET['foto']))){
$album = $_GET['album'];
$album = str_replace('entry', 'feed', $album);
$h1 = "<a href=\"$_SERVER[PHP_SELF]\">Alle albums</a>";
echo <<<ALBUM
<script>
$(document).ready(function($) {
  album = "$album&kind=photo&hl=nl";
  $.getJSON(album, function(data) {
	  var albumtitel = data.feed.title.\$t;
		var entry = data.feed.entry;
		var aantal = entry.length;
    var fotoreeks = [];		
		for (var i = 0; i < entry.length; i++) {
      var foto = {
			  'urlthumb': entry[i].media\$group.media\$content[0].url+'?imgmax=150',
        'urlfoto' : entry[i].media\$group.media\$content[0].url+'?imgmax=800',
      };
			var crop = '/s150-c/';
			foto.urlthumb = foto.urlthumb.replace(/\/([^\/]*)$/,crop+'$1');
			fotoreeks.push('<a href="$_SERVER[PHP_SELF]?album=$album&foto=' + i + '"><img src=" '+ foto.urlthumb + '"></a>');
		}
		$('#picasabox').html('<h2>' + albumtitel + '</h2><p style="text-align: center">' + aantal + ' foto\'s</p>');
	  $('#picasabox').append(fotoreeks);
	});
});
</script>
ALBUM;
}
if ((isset($_GET['album']))AND(isset($_GET['foto']))){
$album = $_GET['album'];
$albumid = $album;
$album = str_replace('entry', 'feed', $album);
$foto = $_GET['foto'];
$h1 = "<a href=\"$_SERVER[PHP_SELF]\">Alle albums</a>";
echo <<<CAROUSEL
<script>
$(document).ready(function($) {
  album = "$album&kind=photo&hl=nl";
  $.getJSON(album, function(data) {
	  var albumtitel = data.feed.title.\$t;
		var entry = data.feed.entry;
		var aantal = entry.length;
    var fotoreeks = [];		
		var html = '';		
		html += '<div id="carousel2" class="carousel slide carousel-fit" data-ride="carousel">';
    html += '<div class="carousel-inner">';
		for (var i = 0; i < entry.length; i++) {
      var foto = {
			  'urlthumb': entry[i].media\$group.media\$content[0].url+'?imgmax=150',
        'urlfoto' : entry[i].media\$group.media\$content[0].url+'?imgmax=800',
      };
			var crop = '/s150-c/';
			foto.urlthumb = foto.urlthumb.replace(/\/([^\/]*)$/,crop+'$1');
			fotoreeks.push('<a href="$_SERVER[PHP_SELF]?album=$album&foto=' + i + '"><img src=" '+ foto.urlthumb + '"></a>');
			if (i == $foto){
			  html += '<div class="item active"><img class="img-responsive" src="' + foto.urlfoto + '"></div>';
			}
			else {
			  html += '<div class="item"><img class="img-responsive" src="' + foto.urlfoto + '"></div>';
			}	
		}
    html += '</div>';
		html += '<a class="left carousel-control" href="#carousel2" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>';
		html += '<a class="right carousel-control" href="#carousel2" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>';
		html += '</div>';
		$('#galerij .modal-title').html(albumtitel);	
		$('#galerij .modal-body').html(html);
		$('#galerij').modal();
		$('#picasabox').html('<h2>' + albumtitel + '</h2><p style="text-align: center">' + aantal + ' foto\'s</p>');
	  $('#picasabox').append(fotoreeks);
	});
});
</script>
CAROUSEL;
}
echo <<<PAGINA
<h1 style="text-align: center">$h1</h1>
<div id="picasabox"></div>
<div class="modal fade" id="galerij" tabindex="-1" role="dialog" aria-labelledby="galerijlabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Sluiten</span></button>
<h2 class="modal-title"></h2>
</div>
<div class="modal-body">               
</div>
</div>
</div>
</div>
<div style="clear:both"></div></div>
PAGINA;
include('bootstrapfooter.php');
?>