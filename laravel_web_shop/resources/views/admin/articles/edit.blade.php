@extends('admin.layouts.default')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			<h2>Edit Product: {{ $articl->title }} </h2>

			<a href="{{ url('/admin/articles') }}"><button class="subarticles">Product</button></a>


    		@if (count($errors) > 0)
					<p>Hmm, iets vergeten in te vullen?</p>
			@endif


			{!! Form::open(array('method'=>'POST', 'files'=>true)) !!}
                <div class="form-group bestel">
				<label for="Title">Title</label>
        		<input type="text" name="title" class="form-control" value="{{ $articl->title }}">
                </div>

                <div class="form-group bestel">
        		<label for="Image">Image</label>
        		<input type="hidden" name="current_pic" value="{{ $articl->picture }}">
        		<input type="file" name="picture">
                </div>

                <div class="form-group bestel">
        		<label for="Introduction">Introduction</label> 
        		<input type="text" name="introduction" class="form-control" value="{{ $articl->introduction }}"> 
                </div>

                <div class="form-group bestel">
        		<label for="Content">Content</label> 
        		<textarea name="content" class="form-control">{{ $articl->content }}</textarea>
                </div>

                <div class="form-group bestel"> 
        		<label for="Price">Price</label> 	
        		<input type="text" name="price" class="form-control" value="{{ $articl->price }}">
                </div>

                <div class="form-group bestel">
                {!! Form::label('category_id', 'Categorie:') !!}
                {!! Form::select('category_id[]', $categories, null, ['id' => 'category_id', 'class' => 'form-control', 'multiple']) !!}
                </div>

                <script>
                    $("#category_id").prop("selectedIndex", -1);
                    $('#category_id').select2({
                      placeholder: 'Kies een categorie',
                      allowClear: true
                    });
                </script>


        		<button type="submit" class="subarticles">Edit</button>
    		{!! Form::close() !!}
			
			</div>
		</div>
	</div>
@endsection



