<?php namespace App\Http\Controllers;

use App\Items;
use Auth;
use Input;
use Redirect;
use View;
use Validator;
	

class TodoController extends Controller
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

    	
    	$items = Auth::user()->items; 


        return view ('/todo/todo', array(
        'items' => $items
    ));
    }

    /*получение всех задачь понимание какие из них сделанны какие нет*/

    public function getIndex()
		{
			$name = 'Todo\'s';
			$items= array(
				'all'  => Auth::user()->items(),
				'todo' => Auth::user()->items()->where('done',false)->get(),
				'done' => Auth::user()->items()->where('done',true)->get()
				);
			return View::make('todo.todo')->with(array('name' => $name, 'item' => $items));
		}
	/*изменить на сделаную задачу*/

		public function changeToDone($item)
		{
			if($item->user_id == Auth::user()->id){
			$item->done = true;	
        	$item->save();
    		}
		
			return Redirect::route('todo');
		}

	/*изменить на не сделаную задачу*/
		public function changeToTodo($item)
		{
			if($item->user_id == Auth::user()->id){
			$item->done = false;	
        	$item->save();
    		}
			return Redirect::route('todo');
		}

	/*получить новую задачу*/
	public function getNew() {     
    	return View::make('todo.add');
	}
	/*опубликовать новую задачу*/
	public function postNew() {
	    $rules = array('name' => 'required|min:1|max:200');
	     
	    $validator = Validator::make(Input::all(), $rules);
	     
	    if($validator->fails()){
	        return Redirect::route('new-task')->withErrors($validator);
	    }
	     
	    $item = new Items();
	    $item->name = Input::get('name');
	    $item->user_id = Auth::user()->id;
	    $item->save();
	     
	    return Redirect::route('todo');
	}
	/*удаление задачи*/
	public function getDelete(Items $item) {    
    if($item->user_id == Auth::user()->id){
        $item->delete();
    }
     
    return Redirect::route('todo');
}
     
}