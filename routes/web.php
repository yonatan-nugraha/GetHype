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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

//admin
Route::group(['prefix' => 'admin'], function () {
	Route::get('', 'AdminController@index');
	Route::get('events', 'EventController@index');
    Route::get('events/create', 'EventController@create');
    Route::get('events/{event}/edit', 'EventController@edit');
});

//accounts
Route::group(['prefix' => 'account'], function () {
	Route::get('settings', 'AccountController@edit');
	Route::patch('updateProfile', 'AccountController@updateProfile');
	Route::patch('updatePassword', 'AccountController@updatePassword');
});

//events
Route::group(['prefix' => 'events'], function () {
	Route::post('', 'EventController@store');
	Route::get('search', 'EventController@search');
	Route::get('{event}', 'EventController@show');
	Route::delete('{event}', 'EventController@destroy');
	Route::patch('{event}', 'EventController@update');
	Route::patch('{event}/updateStatus', 'EventController@updateStatus');
	Route::patch('{event}/bookTicket', 'EventController@bookTicket');
});

//tickets and orders
Route::group(['prefix' => 'tickets'], function () {
	Route::get('', 'TicketController@index');
	Route::get('{order}', 'TicketController@show');
});

//checkout
Route::group(['prefix' => 'checkout'], function () {
	Route::get('', 'CheckoutController@index');
	Route::post('pay', 'CheckoutController@pay');
	Route::get('success', 'CheckoutController@success');
	Route::get('failed', 'CheckoutController@failed');
	Route::get('bypass', 'CheckoutController@bypass');
});

//notification
Route::group(['prefix' => 'notification'], function () {
	Route::post('payment', 'NotificationController@payment');
});

