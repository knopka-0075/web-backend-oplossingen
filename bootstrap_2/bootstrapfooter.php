</div>
<hr><footer>
<span style="float: right"><a style="color: white" href="admin.php">Admin</a></span>
<p>&copy; 2014 Harry Van Bavel &middot; <a href="mailto:info@harryvanbavel.be">info@harryvanbavel.be</a></p>
<div class="form-group">
<div class="col-md-12 text-right" style="margin-top: -40px">
<a href="admin.php"><button class="btn btn-primary" name="inlogen">Inloggen</button></a>
</div></div>
</footer>	
</div>
</div>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="bootstrap-3.2.0/js/bootstrap.min.js"></script>
<script src="bootstrap-3.2.0/js/bootstrap-hover-dropdown.js"></script>
<script src="bootstrap-3.2.0/js/bootstrap-touch-carousel.js"></script>
<script src="fancybox/jquery.fancybox.js"></script>
<script>
$(function() {
  $(".navbar-toggle").click(function() {
		$('#menu').toggle('slide', { direction: 'left' }, 500);	
  });
  var url = window.location.pathname;
  var filename = url.substr(url.lastIndexOf('/') + 1);
	if (filename == 'nieuwsbrief.php'){
	  filename = 'nieuwsbrief.php?id=$id';
	}
  $('.navbar a[href$="' + filename + '"]').parent().addClass("active");
	$("a#registratielink").fancybox({
	  'autoDimensions' : true,
		'helpers' : {overlay : {closeClick: false}},
		'href': '#registratieformulier'}).trigger('click'); 		 	
});
</script>
</body>
</html>
