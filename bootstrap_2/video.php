<?php
$titel = 'Video';
include('bootstrapheader.php');
echo <<<CONTENT
<h1>$titel</h1>
<div class="row">
<div class="col-lg-6">
<h2>Responsive 16:9 YouTube</h2>
<div class="embed-responsive embed-responsive-16by9">
<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/zpOULjyy-n8?rel=0"></iframe>
</div>
<h2>Responsive 4:3 YouTube</h2>
<div class="embed-responsive embed-responsive-4by3">
<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/TQl_Sv3LztQ"></iframe>
</div>
</div>
<div class="col-lg-6">
<h2>Responsive 16:9 Vimeo</h2>
<div class="embed-responsive embed-responsive-16by9">
<iframe src="http://player.vimeo.com/video/22428395"></iframe>
</div>
</div>
</div>
<h2>Non-Responsive 16:9 YouTube</h2>
<div>
<iframe src="http://www.youtube.com/embed/zpOULjyy-n8?rel=0" width="630" height="354"></iframe>
</div>
<h2>Non-Responsive 4:3 YouTube</h2>
<div>
<iframe width="420" height="315"  src="http://www.youtube.com/embed/TQl_Sv3LztQ"></iframe>
</div>
CONTENT;
include('bootstrapfooter.php');
?>

