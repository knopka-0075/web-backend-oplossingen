<?php namespace App\Http\Controllers;
	

class DashboardController extends Controller
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
        return view ('/todo/dashboard');
    }
     
}