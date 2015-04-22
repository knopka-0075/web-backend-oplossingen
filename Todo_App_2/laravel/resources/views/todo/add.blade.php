@extends('app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			<h2>Voeg een TODO-item toe</h2>

			<p><a href="{{ url('/todo/todo') }}">Terug naar mijn TODO's</a></p>

			<ul>
				<li>Wat moet er gedaan worden?</li>
			</ul>


			{!! Form::open() !!}
        		<input type="text" name="name">    
        		<button type="submit">Toevoegen!</button>
    		{!! Form::close() !!}

    		@if (count($errors) > 0)
					<p>Hmm, iets vergeten in te vullen?</p>
			@endif
			
			</div>
		</div>
	</div>
@endsection



