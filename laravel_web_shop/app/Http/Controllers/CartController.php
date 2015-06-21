<?php namespace App\Http\Controllers;

use App\Articles;
use Auth;
use Input;
use Redirect;
use View;
use DB;
use Requests;
use Validator;
use Cart;

class CartController  extends Controller 
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

        $articl = Auth::user()->articl;
        $content = Cart::content();

        return View::make('cart.cart', array( 'articls' => $content ));
      
    }

    public function addItem($id){

        // Get all the blog posts
        $articl = Articles::find($id);

        Cart::add( $articl->id, $articl->title, 1,  $articl->price );

        $articl->user_id = Auth::user()->id;

        flash()->success('U heeft een product toegevoegd.');

        return redirect('cart/');
    }

     public function remItem($rowId){
    
       Cart::remove($rowId);

       flash()->error('U hebt het product verwijderd.');

       return redirect('cart/');
    }

  
     
}