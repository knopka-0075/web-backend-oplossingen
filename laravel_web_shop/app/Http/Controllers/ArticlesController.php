<?php namespace App\Http\Controllers;

use App\Articles;

class ArticlesController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', [ 'except' => [ 'index', 'show' ] ]);
	}

	public function show($id)
	{
		// Get all the blog posts
		$articl = Articles::find($id);

		return view('articl.view_articl', compact('articl'));
	}

}
