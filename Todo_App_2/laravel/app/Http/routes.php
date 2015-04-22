<?php namespace App\Http\Controllers;

use App\Items;
use Route;

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

/*Route::get('/', 'WelcomeController@index'); */

/*путь к индексу*/
Route::get('/', 'HomeController@index');

/*путь к дому*/
Route::get('home', 'HomeController@index');

/*путь к дашборд*/
Route::get('/todo/dashboard', [
        'as'    => 'dashboard',
        'uses'  => 'DashboardController@index'
]);

/*путь к тоду*/
Route::get('/todo/todo', [
        'as'    => 'todo',
        'uses'  => 'TodoController@index'
]);

/*путь к добавить задание*/
Route::get('/todo/add', [
        'as'    => 'add',
        'uses'  => 'addController@index'
]);

/*путь к входу в систему*/
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',

]);

/*путь к получению заданий из базы данных*/
Route::get('/todo/todo','TodoController@getIndex');

/*путь к сделанным заданиям*/
Route::get('/todo/done/{item}', [
	'as' => 'done-task', 'uses' => 'TodoController@changeToDone'
	]);

/*путь к не сделанным заданиям*/
Route::get('/todo/nodone/{item}', [
	'as' => 'nodone-task', 'uses' => 'TodoController@changeToTodo'
	]);

/*путь к получению нового задания*/
Route::get('/todo/add', [
    'as' => 'new-task', 'uses' => 'TodoController@getNew'
]);
 
/*путь к добавлению нового задания*/ 
Route::post('/todo/add', [
    'uses' => 'TodoController@postNew'
]);

/*путь к дому*/
Route::bind('item', function($value, $route){
    return Items::where('id', $value)->first();
});

/*путь к удалению задания*/
Route::get('/todo/delete/{item}', [
    'as' => 'delete-task', 'uses' => 'TodoController@getDelete'
]);



