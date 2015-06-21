@extends('admin.layouts.default')

{{-- Content --}}
@section('main')

<div class="page-header">
    <h3>Articles</h3>
		 </div>
    

    <div class="col-md-12 col-sm-12 col-xs-12">
   
	<a href="{{ url('/admin/articles/add') }}" ><button class="articles">New Product</button></a>
	@include('flash::message')


    <table class="catalog_table"><tr class="catalog_product"><th>Titel</th><th>Image</th><th>Introduction</th><th>Content</th><th>Price</th><th></th><th></th></tr>

			@foreach ($articles as $articl)

    		<tr class="catalog_product">

    		

			<td class="title">{{ $articl->title  }}</td>
			<td class="image_url"><img src="../{{ $articl->picture  }}" alt="image" width="100" /></td>
			<td class="introduction">{{ $articl->introduction  }}</td>
			<td class="content">{{ $articl->content  }}</td>
			<td class="price">{{ $articl->price  }} €</td>
			<td>
				<a href="{{ URL::route('edit-articl', $articl->id) }}">
				<button class="delit"><i class="fa fa-pencil"></i></button>
			</a>
			</td>
			<td>
				<a href="javascript:deleteArticle('{{ URL::route('delete-articl', $articl->id) }}');">
				<button class="delit"><i class="fa fa-times"></i></button>
				</a>
				
			</td>
												
			</tr>
    	@endforeach

	</table>
    
<script>
function deleteArticle(url){
	if( confirm("Are you sure that you want to delete this product?") ){
		window.location.href = url;
	}

}
</script>

    
    </div>

@endsection


   