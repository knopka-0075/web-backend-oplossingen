<?php namespace App\Http\Controllers;

use App\Articles;
use Auth;
use Redirect;
use DB;


class CategorieController extends Controller {

	public function __construct(){}


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index( $cat_id )
	{
		$where_id = array();
		$productencategorie = DB::table('productencategorie')->where('categorie_id', $cat_id )->get();
		foreach ($productencategorie as $value) {
			$where_id[] = $value->articles_id;
		}
		$articles = Articles::whereIn( 'id', $where_id )->orderBy('position', 'DESC')->get();
		return view('categorie', compact('articles'));


	}



}
