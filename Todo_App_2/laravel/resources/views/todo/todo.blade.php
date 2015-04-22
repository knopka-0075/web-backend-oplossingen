@extends('app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h2>De TODO-app</h2>
			<p>Nog geen todo-items.<a href="{{ url('/todo/add') }}">Voeg item toe.</a></p>
			<div class="row">
					<div class="col-md-8">
						@if($item['all']->count() != 0)
							<h2>Todo's</h2>
							@if($item['todo']->count() > 0)
								@foreach($item['todo'] as $value)
									<div class="row">
										<div class="col-md-1">
											<a href="{{ URL::route('done-task', $value->id) }}">
													<i class="glyphicon glyphicon-ok"></i></a>
										</div>
										<div class="col-md-4">
											<p>		
												{{ $value->name }}
											</p>
										</div>
											<div class="col-md-1" >
												<a href="{{ URL::route('delete-task', $value->id) }}">
													<i class="glyphicon glyphicon-remove"></i>
												</a>
											</div>
									</div>
								@endforeach
						@else
							<h3>Allright, all done!</h3>
						@endif
						
						
						
						<h2>Done</h2>
							@if($item['done']->count() > 0)
								@foreach($item['done'] as $value)
									<div class="row">
										<div class="col-md-1">
											<a href="{{ URL::route('nodone-task', $value->id) }}">
													<i class="glyphicon glyphicon-ok"></i></a>
										</div>
										<div class="col-md-4">
											<p>		
												{{$value->name}}
											</p>
										</div>
											<div class="col-md-1" >
												<a href="{{ URL::route('delete-task', $value->id) }}">
													<i class="glyphicon glyphicon-remove"></i>
												</a>
											</div>
									</div>
								@endforeach
							@else
								<h3>Damn, werk aan de winkel...</h3>
							@endif
						@endif
					</div>
			</div>
		</div>
	</div>
</div>
@endsection