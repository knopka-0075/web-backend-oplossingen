@extends('layouts.default')

@section('content')

<!-- start container -->
    <div class="container">
    
      <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 over">
    <h1 class="over_h">Betalings Formulier</h1><hr class="onder_betal"><br>
   
    </div>
    </div>
    
    
    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <p class="bezorg_text">BESTELLING GEGEVENS</p>
    </div>
    
    <div class="col-md-12 col-sm-12 col-xs-12">
    <form>
   <div class="form-group bestel">
    <label for="exampleInputNaam1">Naam</label>
    <input type="naam" class="form-control" id="exampleInputNaam1" placeholder="Naam">
  </div>
  <div class="form-group bestel">
    <label for="exampleInputAchternaam1">Achternaam</label>
    <input type="achternaam" class="form-control" id="exampleInputAchternaam1" placeholder="Achternaam">
  </div>
  <div class="form-group bestel">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  <div class="form-group bestel">
    <label for="exampleInputGsm1">GSM</label>
    <input type="gsm" class="form-control" id="exampleInputGsm1" placeholder="GSM">
  </div>
  <div class="form-group bestel">
    <label for="exampleInputAddress1">Address van levering</label>
    <input type="address" class="form-control" id="exampleInputAddress1" placeholder="Address">
  </div>

    </div>
    </div>
    
    
     <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <p class="bezorg_text">BEZORGING</p>
    </div>
    
    
    <div class="col-md-2 col-sm-2 col-xs-1"></div>
    <div class="col-md-4 col-sm-4 col-xs-5">
    <input type="radio" name="bezorg" class="bezorg_radio" value="Koerier" id="bezorg_1" /><label for="koerier">Koerier</label>
    <p class="bezorg_del">Bezorging binnen tussen 1-3 dagen.</p>
    </div>
    
    <div class="col-md-4 col-sm-4 col-xs-5">
   	<p>€ 7.00</p>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-1"></div>
    </div>
    
    <div class="row">
    <div class="col-md-2 col-sm-2 col-xs-1"></div>
    <div class="col-md-4 col-sm-4 col-xs-5">
    <input type="radio" name="bezorg" class="bezorg_radio" value="winkel" id="bezorg_2" checked /><label for="afhalen">Afhalen in de winkel</label>
    <p class="bezorg_del">Binnen 5 werkdagen ophalen in de winkel.</p>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-5">
    <p>Gratis</p>
    </div>
    
    <div class="col-md-2 col-sm-2 col-xs-1"></div>
    
    </div>
    
     
    
    </form>
    
     <div class="form-group bestel">
      <a href="#"><button type="submit" class="knoppen_bestel">Bestellen</button></a>
    </div>
    
      </div>
	<!-- einde container -->

  

@endsection



