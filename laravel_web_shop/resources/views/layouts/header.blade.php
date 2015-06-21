<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KRIStyle</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/webshop.css') }}" rel="stylesheet">
	<link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">


	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<div class="container">

      <div class="row">
        <div class="col-xs-12 heder_log">
            <ul class="menu_log">
                @if (Auth::guest())
                    <li><a href="#"><i class="fa fa-shopping-cart fa-lg"></i><span class="badge"></span></a></li>
                    
                    <li class="{{ (Request::is('auth/register') ? 'active' : '') }}"><a
                                href="{!! URL::to('auth/register') !!}">Register</a></li>
                    <li class="{{ (Request::is('auth/login') ? 'active' : '') }}"><a href="{!! URL::to('auth/login') !!}"><i
                                class="fa fa-sign-in"></i> Login</a></li>
                @else

                @if(Auth::check())

                            <li>
                                <a href="{!! URL::to('auth/logout') !!}"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>

                            <li><a href="{!! URL::to('cart') !!}"><i class="fa fa-shopping-cart fa-lg"></i><span class="badge">{{ Cart::count() }}</span></a></li>
                            
                                @if(Auth::user()->admin==1)
                                    <li>
                                        <a href="{!! URL::to('admin/dashboard') !!}"><i class="fa fa-tachometer"></i> Dashboard</a>
                                    </li>
                                @endif


                    <li class="dropdown">
                        <a href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                        
                            @endif
                         
                    </li>
                @endif
            </ul>
        </div>
      </div>
      
      <div class="row">
      <div class="col-md-10">
        <div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
            <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="{{ url('/') }}">KRIStyle</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('cat/1')}}">Vrouw</a>
                </li>
                <li><a href="{{ url('cat/2')}}">Man</a>
                </li>
                <li><a href="{{ url('cat/3')}}">Actie</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>


<div class="col-md-2 hidden-xs hidden-sm" >
<form method="get" action="/search" target="_blank">
<input name="q" class="search" id="form-query" value="" placeholder="search">
<button type="button" class="b_search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
</form>
</div>
      </div>
    </div>
    <!-- einde container -->