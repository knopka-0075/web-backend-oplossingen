@extends('layouts.default')

@section('content')
 <!-- start container -->
              <div class="container login">
              

                <div class="col-md-12 col-sm-12 col-xs-12 over">

                  <h1 class="over_h">Contacteer Ons</h1>
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

{!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}

<div class="form-group">
    {!! Form::label('Naam') !!}
    {!! Form::text('name', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Naam')) !!}
</div>

<div class="form-group">
    {!! Form::label('Achternaam') !!}
    {!! Form::text('surname', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Achternaam')) !!}
</div>

<div class="form-group">
    {!! Form::label('E-mail Address') !!}
    {!! Form::text('email', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'E-mail address')) !!}
</div>

<div class="form-group">
    {!! Form::label('Bericht') !!}
    {!! Form::textarea('message', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Bericht')) !!}
</div>

<div class="form-group">
    {!! Form::submit('Contacteer Ons', 
      array('class'=>'btn btn-primary knoppen')) !!}
</div>
{!! Form::close() !!}

</div>

              
              
</div>
<!-- einde container -->





 @endsection         
        
      
