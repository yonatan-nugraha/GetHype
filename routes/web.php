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

Route::get('/activate/{user}', 'Auth\RegisterController@activate');

//home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

//statics
Route::get('/services', 'HomeController@service');

//admin
Route::group(['prefix' => 'admin'], function () {
	Route::get('', 'AdminController@index');
	Route::get('events', 'EventController@showList')->middleware('auth');
    Route::get('events/create', 'EventController@create')->middleware('auth');
    Route::get('events/{event}/edit', 'EventController@edit')->middleware('auth');
});

//accounts
Route::group(['prefix' => 'account'], function () {
	Route::get('settings', 'AccountController@index');
	Route::patch('update-profile', 'AccountController@updateProfile');
	Route::patch('update-password', 'AccountController@updatePassword');
	Route::post('update-picture', 'AccountController@updatePicture');
});

//events
Route::group(['prefix' => 'events'], function () {
	//create, update events for admin
	Route::post('', 'EventController@store')->middleware('auth');
	Route::patch('{event}', 'EventController@update')->middleware('auth');
	Route::patch('{event}/update-status', 'EventController@updateStatus')->middleware('auth');

	//book ticket
	Route::patch('{event}/book-ticket', 'EventController@bookTicket')->middleware('auth');

	//bookmark
	Route::post('add-bookmark', 'EventController@addBookmark')->middleware('auth');
	Route::delete('{event}/remove-bookmark', 'EventController@removeBookmark')->middleware('auth');

	//search events
	Route::get('search', 'EventController@search');

	//event detail
	Route::get('{event}', 'EventController@showDetail');
});

//my events
Route::group(['prefix' => 'myevents'], function () {
	Route::get('', 'MyEventController@showList');
	Route::get('{event}/statistic', 'MyEventController@showDetail');

	Route::get('{event}/statistic/event', 'MyEventController@showEventViewStatistic');
	Route::get('{event}/statistic/event/gender', 'MyEventController@showEventViewStatisticByGender');
	Route::get('{event}/statistic/event/age', 'MyEventController@showEventViewStatisticByAge');

	Route::get('{event}/statistic/ticket', 'MyEventController@showTicketStatistic');

	Route::get('{event}/order-details', 'MyEventController@showOrderDetails');
	Route::get('{event}/ticket-sales', 'MyEventController@showTicketSales');
});

//tickets and orders
Route::group(['prefix' => 'tickets'], function () {
	Route::get('', 'TicketController@index');
	Route::get('{order}', 'TicketController@show');
	Route::get('{order}/invoice', 'TicketController@invoice');
	Route::get('{order}/ticket', 'TicketController@ticket');
});

//checkout
Route::group(['prefix' => 'checkout'], function () {
	Route::get('', 'CheckoutController@index');
	Route::post('pay', 'CheckoutController@pay');
	Route::get('success', 'CheckoutController@success');
	Route::get('failed', 'CheckoutController@failed');
	Route::get('bypass', 'CheckoutController@bypass');
	Route::get('email', 'CheckoutController@sendEmail');
});

//notification
Route::group(['prefix' => 'notification'], function () {
	Route::post('payment', 'NotificationController@payment');
});

