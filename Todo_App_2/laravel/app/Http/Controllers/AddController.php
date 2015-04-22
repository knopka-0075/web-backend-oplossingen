<?php namespace App\Http\Controllers;

use App\Items;
use Auth;
use Input;
use Redirect;
use View;
use Validator;


class AddController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

   public function index(){
        return view ('/todo/add');
    }
     
     
}