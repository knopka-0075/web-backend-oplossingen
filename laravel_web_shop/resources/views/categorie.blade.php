@extends('layouts.default')

@section('content')

    <div class="container"> 
      @include('flash::message')
    
    <div class="row gal">
    
    
    <div id="Carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#Carousel" data-slide-to="0" class="active"></li>
        <li data-target="#Carousel" data-slide-to="1"></li>
        <li data-target="#Carousel" data-slide-to="2"></li>
      </ol>

      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="../img/slider-3.jpg" alt="">
          
        </div>

        <div class="item">
          <img src="../img/slider-2.jpg" alt="">
          
        </div>

        <div class="item">
          <img src="../img/slider-6.jpg" alt="">
          
        </div>
      </div>

      <a class="left carousel-control" href="#Carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Vorige</span>
      </a>

      <a class="right carousel-control" href="#Carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Volgende</span>
      </a>
    </div>

    </div>
</div>


 <!-- start container -->
    <div class="container">
    
    <div class="row balk_filter">
        <div class="col-md-12">
          <ul class="menu-filter">
             <li><a href="{{ url('/') }}">All</a> </li> 
            <li><a href="{{ url('cat/4')}}">Beha</a>  </li>
            <li><a href="{{ url('cat/5')}}">Slipers</a>  </li>
            <li><a href="{{ url('cat/6')}}">Pyjamas</a> </li>
            <li><a href="{{ url('cat/7')}}">Combinatie</a> </li>
          </ul>
        </div>
    </div>

      <div class="row"> <!-- portfolio rij 1 -->
        
         @foreach ($articles as $post)
        <div class="col-md-3 col-sm-4 col-xs-6 portfolio-item fpyjamas">
                 
                  <div class="portItem">
                  <a href="{{URL::to('articl/'.$post->id.'')}}">
                    <img src="../{{ $post->picture  }}" alt="image" class="portBeeld img-responsive"/>
                  </a>  
                  </div>

              <div class="portfolio-item-info product_link">
                    <a href="{{URL::to('articl/'.$post->id.'')}}"><h2>{!!$post->title !!}</h2></a>
                    <span class="datum">{{ $post->price  }} €</span> 
              </div>
        </div>

@endforeach
              </div> <!-- portfolio rij 1  stop-->


      
      </div>
  <!-- einde container -->




@endsection



