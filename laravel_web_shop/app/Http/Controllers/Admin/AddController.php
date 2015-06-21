<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Articles;
use App\Categories;
use App\Size;
use Auth;
use Input;
use Redirect;
use View;
use DB;
use Requests;
use Validator;
use File;
use App\ArticlCategoriesRelation;


class AddController extends AdminController
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		$this->middleware('auth');
	}


    public function index(){
    	
    	$articles = Auth::user()->articles; 

        return view ( 'admin.articles.index', array( 'articles' => $articles ) );
    }

    /*krijgt een nieuwe product*/
    public function getNew() {  

        $categories = Categories::lists('title', 'id');
        $sizes      = Size::lists('size', 'id');

        return View::make('admin.articles.add', compact('categories', 'size'));
    }

    /*nieuwe product te publiceren*/
    public function postNew() {

        /* Tekst Validatie*/
        $rules = array('title' => 'required|min:3');
        $rules = array('content' => 'required|min:3');
        $rules = array('introduction' => 'required|min:3');
        $rules = array('price' => 'required|numeric' );   
         
        $validator = Validator::make(Input::all(), $rules);
         
        if($validator->fails()){
            return Redirect::route('new-articl')->withErrors($validator);
        }

         
        $articl = new Articles(); //Niuwe product maken
        $articl->title = Input::get('title'); //Naam maken
        $articl->content = Input::get('content'); //Content maken
        $articl->introduction = Input::get('introduction'); //Introduction maken
        $articl->price = Input::get('price'); //Prijs maken
        
          /*Afbeelding te laden*/
          if( is_file(Input::file('picture')) ){  //Download het bestand
            $file = array('image' => Input::file('picture')); //Bestand maken
            $rules = array('image' => 'required',); //File Validation
            $validator = Validator::make($file, $rules); //File Validation 
            if (Input::file('picture')->isValid()) { //Als het bestand is gecontroleerd

              $destinationPath = 'images/articl'; //Storage bestand

              $extension = Input::file('picture')->getClientOriginalExtension(); //Haal de oorspronkelijke naam van het geüploade bestand

              $fileName = rand(111,99999).'.'.$extension; //De naam van het nieuwe bestand in nummers van 111 tot 99999

              Input::file('picture')->move($destinationPath, $fileName); //Het gedownloade bestand verplaatsen

              $articl->picture = $destinationPath . '/' . $fileName; //Destination van de file
            }
        
           }


        $articl->user_id = Auth::user()->id;
        $articl->save();
        flash()->success('U heeft een nieuw product toegevoegd.');
         

        $acRelatie = Input::get('category_id');
            if( count($acRelatie) > 0 ){
            $_acRelatie = array();
            foreach ($acRelatie as $key => $value) {
            $_acRelatie[] = array( 'articles_id' => $articl->id, 'categorie_id' => $value );
            }
            if( count($_acRelatie) > 0 ){
        DB::table('productencategorie')->insert($_acRelatie); 
         }
    }
        return Redirect::route('articles');

    }


    /*een taak wissen*/
    public function getDelete(Articles $articl) {    
        if($articl->user_id == Auth::user()->id){
            $articl->delete();
            File::delete($articl->picture);
            flash()->error('U hebt het product verwijderd.');
        }


        return Redirect::route('articles');
    }

    public function getEdit(Articles $articl){

        $categories = Categories::lists('title', 'id');
        $sizes      = Size::lists('size', 'id');
        
        return View::make('admin.articles.edit', array( 'articl' => $articl ), compact('categories', 'size'));

    }

    /*bewerk product*/
    public function postEdit(Articles $articl) {

        /* Tekst Validatie*/
        $rules = array('title' => 'required|min:3');
        $rules = array('content' => 'required|min:3');
        $rules = array('introduction' => 'required|min:3');
        $rules = array('price' => 'required|numeric' );   
         
        $validator = Validator::make(Input::all(), $rules);
         
        if($validator->fails()){
            return Redirect::route('new-articl')->withErrors($validator);
        }

        $input_fileName = Input::get('current_pic'); //intrekking van de oude bestand
      if( is_file(Input::file('picture')) ){ //Het laden van een nieuw bestand
        
        $file = array('image' => Input::file('picture')); //Het laden van een nieuw bestand
        $rules = array('image' => 'required',);  //valideringsbestand 
        $validator = Validator::make($file, $rules); //valideringsbestand
        if (Input::file('picture')->isValid()) {  //Als het bestand is gecontroleerd

          $destinationPath = 'images/articl'; //bestandsopslag

          $extension = Input::file('picture')->getClientOriginalExtension(); //Haal de oorspronkelijke naam van het geüploade bestand

          $fileName = rand(111,99999).'.'.$extension; //De naam van het nieuwe bestand in nummers van 111 tot 99999

          Input::file('picture')->move($destinationPath, $fileName); //Het gedownloade bestand verplaatsen

          $input_fileName = $destinationPath . '/' . $fileName; //Destination van de file
        }
    
         /*delete old foto*/
            $old_foto = Input::get('current_pic'); //Verwijder oude bestanden
            File::delete($old_foto); //Verwijder oude bestanden
       }

        /*bewerk Product */
        DB::table('articles')->where('id',$articl->id)->update(
            [
            'title' => Input::get('title'),
            'content' => Input::get('content'),
            'introduction' => Input::get('introduction'),
            'price' =>Input::get('price'),
            'picture' => $input_fileName,
            ]
            );


        $acRelatie = Input::get('category_id');
        $_acRelatie = array();
        DB::table('productencategorie')->where( 'articles_id', '=', $articl->id )->delete();
        if( count($acRelatie) > 0 ){
            $_acRelatie = array();
        foreach ($acRelatie as $key => $value) {
            $_acRelatie[] = array( 'articles_id' => $articl->id, 'categorie_id' => $value );
        }
        if( count($_acRelatie) > 0 ){
            DB::table('productencategorie')->insert($_acRelatie); 
        }
    }

        flash()->success('Uw gegevens werden gewijzigd.');
        return Redirect::route('articles');
    }







 
     
}









