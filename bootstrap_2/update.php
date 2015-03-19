<?php session_start();
if (isset($_GET['pagina'])){
  $pagina = $_GET['pagina'];
}
if (isset($_GET['tabel'])){
  $updatetabel = $_GET['tabel'];
}
$titel = ucfirst($pagina);		
include('bootstrapheader.php');
if ((isset($_SESSION['webmaster']))OR(isset($_SESSION['assistent']))){
if ($updatetabel == 'content'){
  $updatetabel = 'content_bootstrap';
	if (isset($_SESSION['assistent'])){
	  $updatetabel = '';
	}
} 
if ($updatetabel == 'nieuws'){
  $updatetabel = 'nieuwsbrieven_bootstrap';
} 
if ($pagina != 'nieuw'){
  $sql="SELECT * FROM $updatetabel WHERE onderwerp = '$pagina'";
  $resultaat=mysql_query($sql, $db);
  if ($regel = mysql_fetch_array($resultaat)){
    $onderwerp = $regel['onderwerp'];	
    $inhoud = $regel['inhoud'];
	  $id = $regel['id'];
  }
  mysql_free_result($resultaat);
}
if ($pagina == 'nieuw'){
  $onderwerp = 'nieuw';
}
echo <<<CONTENT
<script>
tinymce.init({
    file_browser_callback : elFinderBrowser,
    selector: "textarea",
		language: "nl",
		height: "300",
    menu : { 
        edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
        insert : {title : 'Insert', items : 'link | image'},
        format : {title : 'Format', items : 'formats | removeformat'},
        table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
        tools  : {title : 'Tools' , items : 'code fullscreen'}
    },
    save_enablewhendirty: true,
    save_onsavecallback: function() {document.getElementById('updateformulier').submit();},
		plugins: ["textcolor", "elfinder", "save", "link", "image", "code", "fullscreen", "table"],
		toolbar: [
        "formats save undo redo | bold italic underline forecolor | bullist numlist | link image | alignleft aligncenter alignright alignjustify | code fullscreen"
    ]
 });
function elFinderBrowser (field_name, url, type, win) {
    tinymce.activeEditor.windowManager.open({
    file: 'tinymce/plugins/elfinder/index.php',
    title: 'Afbeeldingen',
    width: 1000,  
    height: 450,
    resizable: 'yes'
  }, {
    setUrl: function (url) {
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
} 
</script>
<div class="container" style="padding: 0px; width: 90%">
<h1>Update $pagina</h1>
<form id="updateformulier" action="$_SERVER[PHP_SELF]?tabel=$updatetabel&pagina=$pagina" method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
<input type="hidden" name="id" value="$id">
<label for="onderwerp">Onderwerp</label>
<p><input class="form-control" style="width: 50%" type="text" name="onderwerp" value="$onderwerp"></p>
<p><textarea id="editor" name="inhoud">$inhoud</textarea></p>
<button type="submit" class="btn btn-primary" name="opslaan">Opslaan</button>
<button type="submit" class="btn btn-primary" name="verwijderen">Verwijderen</button>
</form>
</div>
<script>
var postForm = function() {
	var inhoud = $('textarea[name="inhoud"]').html($('#editor').code());
}
</script>
CONTENT;
if (isset($_POST['inhoud'])){
$inhoud = mysql_real_escape_string($_POST['inhoud']);
$onderwerp = $_POST['onderwerp'];
$id = $_POST['id'];
$datum = date("Y-m-d");
if ($inhoud == ""){
  echo "<script>window.document.location=\"$_SERVER[PHP_SELF]?tabel=$updatetabel&pagina=$pagina\"</script>";
}  
else {
  if ($pagina == 'nieuw'){
    $sql="INSERT INTO $updatetabel (onderwerp, inhoud, datum) VALUES ('$onderwerp', '$inhoud', '$datum')";
  }
  if ($pagina != 'nieuw'){
    $sql="UPDATE $updatetabel SET onderwerp = '$onderwerp', inhoud = '$inhoud' WHERE id = '$id'";
  }
	$resultaat=mysql_query($sql, $db);
	if ($pagina == 'nieuw'){
	  echo "<script>window.document.location=\"home.php\"</script>";
	}
	elseif ($updatetabel == 'content_bootstrap'){
	  echo "<script>window.document.location=\"$onderwerp.php\"</script>";
	}
	elseif ($updatetabel == 'nieuwsbrieven_bootstrap'){
	  echo "<script>window.document.location=\"nieuwsbrief.php?id=$id\"</script>";
	}
}	
}	
if (isset($_POST['verwijderen'])){
  $id = $_POST['id'];
  $sql="DELETE from $updatetabel WHERE id = '$id'";
	$resultaat=mysql_query($sql, $db);
	echo "<script type=\"text/javascript\">window.document.location=\"home.php\"</script>";
}
}
include('bootstrapfooter.php');
?>
