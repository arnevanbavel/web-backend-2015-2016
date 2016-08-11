<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');



Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


Route::get('{post}/comment', ['as' => 'comment', 'uses' => 'CommentController@index']);
Route::post('{post}/post_this_comment', 'CommentController@post_this_comment');
Route::get('{post}/recaptcha', 'CommentController@recaptcha');
Route::get('{post}/reply_comment', 'CommentController@reply_comment');
Route::post('{post}/per_page', ['as' => 'per_page', 'uses' => 'CommentController@per_page']);
Route::post('{post}/comment/update', ['as' => 'comment/update', 'uses' => 'CommentController@update']);


Route::get('data/islogged', function() {
    return Response::json( array('status' => Auth::check()));
});

Route::resource('posts', 'PostsController');
Route::resource('votes', 'VotesController');
Route::resource('commentvotes', 'CommentVotesController');
Route::resource('profile', 'ProfilesController');

Route::get('u/{name}', [
    'as' => 'profile_path',
    'uses' => 'ProfilesController@show'
]);


Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('"^[A-Za-z][A-Za-z0-9]*$"', $value);
});