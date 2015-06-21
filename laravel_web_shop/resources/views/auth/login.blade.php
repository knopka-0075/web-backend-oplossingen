@extends('layouts.default')

@section('content')
 <!-- start container -->
					    <div class="container login">
					    
					    <div class="form">
			
				
				
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif


					   
					 
					      <div class="navcontainer">
							<ul class="navlijst">
								<li class="{{ (Request::is('auth/login') ? 'active' : '') }}">
									<a href="{!! URL::to('auth/login') !!}">Inloggen</a></li>
					        	<li class="{{ (Request::is('auth/register') ? 'active' : '') }}">
					        		<a href="{!! URL::to('auth/register') !!}">Registreren</a></li>
							</ul>
						</div> 
					      
					   <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

					  <div class="form-group">
					    <label class="control-label login">E-Mail Address</label>
					    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address">
					  </div>
					  <div class="form-group">
					    <label class="control-label login">Password</label>
					    <input type="password" class="form-control" name="password" placeholder="Password">
					  </div>

					  <div class="form-group">
									<label>
										<input type="checkbox" name="remember" class="login"> Remember Me
									</label>
						</div>


					<div class="form-group">
								<button type="submit" class="btn btn-primary knoppen">Login</button>

							<!--		<a class="btn btn-link forgot" href="{{ url('/password/email') }}">Forgot Your Password?</a>-->
						</div> 


					</form>
					      
					</div> <!-- /form -->
					    
					    
					      </div>
						<!-- einde container -->





					
				
			

@endsection
