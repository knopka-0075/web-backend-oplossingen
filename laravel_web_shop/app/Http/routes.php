<?php
use App\Articles;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

/*Paginas*/
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('over', 'PagesController@over');
Route::get('algemene', 'PagesController@algemene');
Route::get('cart/payment', 'PagesController@payment');
Route::get('cat/{id}', 'CategorieController@index');

/*Contact*/
Route::get('contact', 
  ['as' => 'contact', 'uses' => 'AboutController@create']);
Route::post('contact', 
  ['as' => 'contact_store', 'uses' => 'AboutController@store']);

/*Cart*/
Route::pattern('id', '[0-9]+');
Route::get('cart', 'CartController@index');
Route::get('cart/add/{id}', 'CartController@addItem');
Route::get('cart/rem/{rowId}', 'CartController@remItem');

/*Product pagina*/
Route::get('articl/{id}', 'ArticlesController@show');

/*User*/
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*Admin*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function() {
    Route::pattern('id', '[0-9]+');
    Route::pattern('id2', '[0-9]+');

    /*Admin Dashboard*/
    Route::get('dashboard', 'DashboardController@index');

    /*Product*/
    Route::get('articles', [
        'as'    => 'articles',
        'uses'  => 'AddController@index'
    ]);

    Route::get('articles/add', [
    'as' => 'new-articl', 'uses' => 'AddController@getNew'
    ]);
 
    Route::post('articles/add', [
    'uses' => 'AddController@postNew'
    ]);

    Route::bind('articl', function($value, $route){
    return Articles::where('id', $value)->first();
    });

    /*путь к удалению задания*/
    Route::get('articles/delete/{articl}', [
        'as' => 'delete-articl', 'uses' => 'AddController@getDelete'
    ]);


     Route::get('articles/edit/{articl}', [
        'as' => 'edit-articl', 'uses' => 'AddController@getEdit'
    ]);

      Route::post('articles/edit/{articl}', [
        'as' => 'edit-articl', 'uses' => 'AddController@postEdit'
    ]);


    
});
