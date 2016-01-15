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
Route::group(['prefix'=>'management'], function() {
	Route::group(['prefix' => 'books'], function () {
		Route::get('/', [
				"as" => "books.home",
				"uses" => "BooksController@index"
		]);
		Route::get('/new', [
				"as" => "books.new",
				"middleware" => "web",
				"uses" => "BooksController@create"
		]);
		Route::post('/save_new', [
				"as" => "books.save_new",
				"middleware" => "web",
				"uses" => "BooksController@store"
		]);
	});

	Route::group(['prefix'=>'genres'], function() {
		Route::get('/', [
			"as"=>"genres.home",
			"uses"=> "GenresController@index"
		]);
	});
});
Route::any('/',[
	"as"=>"catalog.index",
	"uses"=>"CatalogController@index"
]);

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
	//
});
