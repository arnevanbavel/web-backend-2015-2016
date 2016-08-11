<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::auth();
// Route::get('/todos', 'TodoController@index');
// Route::post('/todo', 'TodoController@store');
// Route::delete('/todo/{todo}', 'TodoController@destroy');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

  Route::get('/', function () {
    if (Auth::check()) {
      return view('home');
    }
    else {
      return view('welcome');
    }
  });
  
  Route::get('/home', function () {
    if (Auth::check()) {
      return view('home');
    }
    else {
      return view('welcome');
    }

  });

  //versie test
  Route::get('/test', 'TodoController@indextest');
  Route::post('/teststore', 'TodoController@storetest');
  Route::get('/testdelete/{todo}', 'TodoController@destroytest');
  Route::get('/testcomplete/{todo}', 'TodoController@completedtest');
});
