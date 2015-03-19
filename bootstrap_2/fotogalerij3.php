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
if (isset($_GET['album'])){
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
			fotoreeks.push('<a title="' + albumtitel + '" rel="album" href="' + foto.urlfoto + '"><img src=" '+ foto.urlthumb + '"></a>');
		}
		$('#picasabox').html('<h2>' + albumtitel + '</h2><p style="text-align: center">' + aantal + ' foto\'s</p>');
	  $('#picasabox').append(fotoreeks);
	  $("a[rel=album]").fancybox({
		  'helpers':       {title : {type : 'inside'}},	
	    'openEffect':    'elastic',
		  'closeEffect':   'elastic',
			'fitToView':     'true',
      'autoSize':      'true',
			'beforeShow': function() {
        this.title = (this.title ? '' + this.title + ' - ' : '') + (this.index + 1) + ' / ' + this.group.length + '';
      },
      'afterLoad'  : function () {
		    if ($(window).width() < 1000) {	
          $.extend(this, {
            aspectRatio : false,
            type    : 'html',
            width   : '100%',
            height  : '100%',
            content : '<div class="fancybox-image" style="background-image:url(' + this.href + '); background-size: cover; background-position:50% 50%;background-repeat:no-repeat;height:100%;width:100%;" /></div>'      
          });
				}
		  }
		});
  });
});

</script>
ALBUM;
}
echo <<<PAGINA
<h1 style="text-align: center">$h1</h1>
<div id="picasabox"></div>
<div style="clear:both"></div></div>
PAGINA;
include('bootstrapfooter.php');
?>