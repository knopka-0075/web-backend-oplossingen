<?php session_start();
include('bootstrapheader.php');
if (isset($_GET['actie'])){
	$actie = $db->real_escape_string($_GET['actie']);
}
else{
	$actie = '';
}
if (isset($_SESSION['webmaster'])){
  echo "<h1>Overzicht geschenken</h1><div id=\"registratielijst\" style=\"margin-bottom: 20px\"><table><tr><th>Naam</th><th>Geschenk</th></tr>";
  $sql="SELECT voornaam, familienaam, product_naam FROM gebruikers_bootstrap INNER JOIN besteling_bootstrap ON gebruikers_bootstrap.gebruikers_id = besteling_bootstrap.gebruikers_id INNER JOIN producten_bootstrap on besteling_bootstrap.product_id = producten_bootstrap.product_id";
  $resultaat = $db->query($sql);	
  while ($regel = $resultaat->fetch_array()){
	  $naam = "".$regel['voornaam']." ".$regel['familienaam'];
		echo "<tr>";
		echo "<td>$naam</td>";
	  echo "<td>".ucfirst($regel['product_naam'])."</td></tr>";	
	}	
	echo "</table></div>";	
  $resultaat->free();
}
if (isset($_SESSION['id'])){
$personeel_id = $db->real_escape_string($_SESSION['id']);
	$sql="SELECT besteling_id, voornaam, familienaam, product_naam FROM gebruikers_bootstrap INNER JOIN besteling_bootstrap ON gebruikers_bootstrap.gebruikers_id = besteling_bootstrap.gebruikers_id INNER JOIN producten_bootstrap on besteling_bootstrap.product_id = producten_bootstrap.product_id WHERE gebruikers_bootstrap.gebruikers_id = besteling_bootstrap.gebruikers_id";
  $resultaat = $db->query($sql);	
	echo "<h1>Uw geschenk</h1><h2>";
	$t = 0;
  if ($regel = $resultaat->fetch_array()){
		$_SESSION['geschenk'] = $regel['besteling_id'];
    echo "<p>".ucfirst($regel['voornaam'])." ".ucfirst($regel['familienaam'])." - ".$regel['product_naam']."</p>";
		$t ++;
	}
	$resultaat->free();	
	echo "</h2>";
	if (isset($_SESSION['geschenk'])){
	  echo "<p><a href=\"$_SERVER[PHP_SELF]?actie=kiezen\" class=\"btn btn-primary\">Wijzig uw keuze</a></p>";
  }
	else {
	  echo "<p><a href=\"$_SERVER[PHP_SELF]?actie=kiezen\" class=\"btn btn-primary\">Maak uw keuze</a>";
	}
}	
$producten = array();
$t = 0;
$sql="SELECT * FROM producten_bootstrap";
  $resultaat = $db->query($sql);	
  while ($regel = $resultaat->fetch_array()){
    $producten[$t] = $regel['product_naam'];
		$t ++;		
	}
$resultaat->free();	

if (isset($_POST['verstuur'])){
  $voornaam = $_POST['voornaam'];	
  $familienaam = $_POST['familienaam'];
	$email = $_POST['email'];
	$product = $_POST['product_naam'];
	$p = $producten[$product];

	$sql="SELECT * FROM producten_bootstrap";
  $resultaat = $db->query($sql);	
  while ($regel = $resultaat->fetch_array()){
	  if ($p == $regel[product_naam]){
	    $product_id = $regel[product_id];
		}
  }
	if (!isset($_SESSION['geschenk'])){	
    $db->query("INSERT INTO besteling_bootstrap (gebruikers_id, product_id) VALUES ('$gebruikers_id', '$product_id')");	
	}
	if (isset($_SESSION['geschenk'])){	
    $db->query("UPDATE besteling_bootstrap SET gebruikers_id = '$gebruikers_id', product_id = '$product_id' WHERE besteling_id = '".$_SESSION['geschenk']."'");
	}	
	echo "<script>window.document.location=\"$_SERVER[PHP_SELF]\"</script>";
}
 
if ($actie == 'kiezen'){
?>
<form name="reservatie" id="reservatie" method="post" action="<?php echo "".$_SERVER[PHP_SELF].""; ?>">
<h1>Keuze geschenk</h1>
  <fieldset> 
    <legend>Persoonsgegevens</legend> 
    <div> 
        <label>Voornaam
        <input class="form-control" id="voornaam" name="voornaam" type="text" placeholder="Voornaam" value="<?php echo "".$_SESSION['voornaam']."";?>" required autofocus> 
		</label>
    </div>
    <div> 
        <label>Familienaam
        <input class="form-control" id="familienaam" name="familienaam" type="text" placeholder="Familienaam" value="<?php echo "".$_SESSION['familienaam']."";?>" required autofocus> 
		</label>
    </div>
		<div> 
        <label>E-mailadres
        <input class="form-control" id="email" name="email" type="text" placeholder="E-mail" value="<?php echo "".$_SESSION['email']."";?>" required autofocus> 
		</label>
    </div>
  </fieldset>
  <fieldset> 
    <legend>Geschenk</legend> 
      <div class="product">
			<?php for ($i = 0; $i < sizeof($producten); $i++){?>	
          <input id="<?php echo "".$producten[$i]."";?>" name="product" type="radio" required value="<?php echo "$i";?>"> 
          <label for="<?php echo "".$producten[$i]."";?>"><?php echo "".ucfirst($producten[$i])."";?></label> 
			<?php }?>		
     </div>
  </fieldset>
	
<p><button type="submit" name="verstuur" class="btn btn-primary">Verstuur keuze</button></p>
</form>
<script>document.reservatie.product['<?php echo $product ?>'].checked = true;</script>
<?php } 
include('bootstrapfooter.php');
?>	
