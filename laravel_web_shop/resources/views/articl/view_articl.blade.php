@extends('layouts.default')

@section('content')
<!-- start container -->
<div class="container">

	<div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12 over">
    		<h1 class="over_h">{{ $articl->title }} </h1>
   
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-4 col-sm-12 col-xs-12">
    		<img src="../{{ $articl->picture  }}" alt="image"  class="portBeeld img-responsive product_view"/>
    	</div>	

		<div class="col-md-6 col-sm-12 col-xs-12">
			<p class="prijs_text">{!! $articl->content() !!}</p>
			<p class="prijs">{{ $articl->price }} €</p>
            <a href="{!! URL::to('cart/add') !!}/{{ $articl->id  }}"><button class="winkelmandje">In Winkelmandje</button></a>
		</div>

    </div>

</div>

<!-- einde container -->

@endsection
