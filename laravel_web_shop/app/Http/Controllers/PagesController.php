<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

	public function over()
	{
		return view('over');
	}

	public function algemene()
	{
		return view('algemene');
	}

	public function payment()
	{
		return view('cart/payment');
	}

}