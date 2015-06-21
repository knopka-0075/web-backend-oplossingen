@extends('layouts.default')

@section('content')

<div class="container">

	<div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12 over">
    		<h1 class="over_h">Winkelmandje</h1>
   
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12">
            @include('flash::message')

   <table>
   <tr class="product">
    <th class="product_tab_f">PRODUCT NAAM</th>
    <th class="product_tab">PRIJS</th>
    <th class="product_tab"></th>
    <th class="product_tab_l"></th>
   </tr>
    		
    	

@foreach ($articls as $articl)



	 		<tr class="product_in">
			<td class="product_bes_f">{{ $articl->name  }}</td>
			<td class="product_bes">{{ $articl->price  }} €</td>
            
			<td>
			
			</td>
			<td>
				<a href="{!! URL::to('cart/rem') !!}/{{ $articl->rowid  }}">
				<button class="delit_cart"><i class="fa fa-times"></i></button>
				</a>
				
			</td>
			</tr>
    	@endforeach

    	</table>
    	</div>	
    </div>

<div class="row">
    <div class="col-md-9 col-sm-9 col-xs-1"></div>
    <div class="col-md-3 col-sm-3 col-xs-10">
    <hr class="total_hr">
    <p class="total">Totaal</p>	<p class="total_p">{{ Cart::total() }} €</p>
    <a href="{!! URL::to('cart/payment') !!}"><button class="kassa">NAAR DE KASSA</button></a>
    </div>
    <div class="col-md-0 col-sm-0 col-xs-1"></div>
    
    </div>



</div>

<!-- einde container -->
  

@endsection



