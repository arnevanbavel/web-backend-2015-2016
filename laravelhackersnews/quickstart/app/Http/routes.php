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

Route::get('/', 'HomeController@index');

Route::auth();

Route::resource('artikels', 'ArtikelsController');
Route::resource('votes', 'VotesController');
Route::resource('comment', 'CommentController');

Route::get('delete/{id}', 'ArtikelsController@confirmdestroy');
Route::get('/artikeldelete/{id}', 'ArtikelsController@destroy');

Route::get('commentdelete/{id}', 'CommentController@confirmdestroy');
Route::get('/commentdeletetrue/{id}', 'CommentController@destroy');
Route::get('/commentdeleteartikel/{id}', 'CommentController@destroy2');

Route::get('/home', 'HomeController@index');
Route::get('comment/edit/{id}', 'CommentController@edit');
Route::post('vote/up/{id}', 'VotesController@voteup');
Route::post('vote/down/{id}', 'VotesController@votedown');

Route::get('u/{name}', ['as' => 'profile_path', 'uses' => 'ProfilesController@show']);
