<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//home
Route::get('/home', 'HomeController@index');

//admin
Route::group(['prefix' => 'admin'], function () {
	Route::get('', 'AdminController@index');
	Route::get('events', 'EventController@index');
    Route::get('events/create', 'EventController@create');
});

//event
Route::group(['prefix' => 'events'], function () {
	Route::post('', 'EventController@store');
	Route::get('{event}', 'EventController@show');
	Route::delete('{event}', 'EventController@destroy');
});
