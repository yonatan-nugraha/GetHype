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
Route::get('', 'HomeController@index');
Route::get('home', 'HomeController@index');

//statics
Route::get('services', 'HomeController@services');
Route::get('contact-us', 'HomeController@contactUs');
Route::get('about-us', 'HomeController@aboutUs');
Route::get('help', 'HomeController@help');
Route::get('emails', 'HomeController@email');

//auth socialite
Route::group(['prefix' => 'auth'], function () {
	Route::get('{provider}/redirect', 'Auth\LoginController@redirectToProvider');
	Route::get('{provider}/callback', 'Auth\LoginController@handleProviderCallback');
});

//users
Route::group(['prefix' => 'users'], function () {
	Route::patch('{user}', 'AdminController@updateUser');
	Route::patch('{user}/update-status-user', 'AdminController@updateStatusUser');
	Route::get('get-email-list', 'AdminController@getEmailList');
});

//admin
Route::group(['prefix' => 'admin'], function () {
	Route::get('', 'AdminController@index');
	Route::get('statistic', 'AdminController@showMonthlyStatistic');

	//users
	Route::get('users', 'AdminController@showUserList');
	Route::get('users/{user}/edit', 'AdminController@editUser');

	//events
	Route::get('events', 'AdminController@showEventList');
    Route::get('events/create', 'AdminController@createEvent');
    Route::get('events/{event}/edit', 'AdminController@editEvent');

    //collections
    Route::get('collections', 'AdminController@showCollectionList');
    Route::get('collections/create', 'AdminController@createCollection');
    Route::get('collections/{collection}/edit', 'AdminController@editCollection');

    //journals
    Route::get('journals', 'AdminController@showJournalList');
    Route::get('journals/create', 'AdminController@createJournal');
    Route::get('journals/{journal}/edit', 'AdminController@editJournal');

    //orders
    Route::get('orders', 'AdminController@showOrderList');

    //banners
	Route::get('banners', 'AdminController@showBannerList');
	Route::get('banners/create', 'AdminController@createBanner');
	Route::get('banners/{banner}/edit', 'AdminController@editBanner');
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
	//create & update events for admin
	Route::post('', 'AdminController@storeEvent');
	Route::patch('{event}', 'AdminController@updateEvent');
	Route::patch('{event}/update-status-event', 'AdminController@updateStatusEvent');
	Route::post('{event}/update-user-event', 'AdminController@updateUserEvent');

	//book ticket
	Route::post('{event}/book-ticket', 'EventController@bookTicket');

	//bookmark
	Route::post('{event}/add-bookmark', 'EventController@addBookmark');
	Route::delete('{event}/remove-bookmark', 'EventController@removeBookmark');

	//search events
	Route::get('search', 'EventController@search');

	//event detail
	Route::get('{event}', 'EventController@showDetail');
});

//collections
Route::group(['prefix' => 'collections'], function () {
	Route::get('add-event', 'AdminController@addEventCollection');
	Route::post('', 'AdminController@storeCollection');
	Route::patch('{collection}', 'AdminController@updateCollection');
	Route::patch('{collection}/update-status-collection', 'AdminController@updateStatusCollection');

	Route::get('{collection}', 'EventController@showCollectionDetail');
});

//journals
Route::group(['prefix' => 'journals'], function () {
	Route::get('', 'JournalController@showList');
	Route::get('{journal}', 'JournalController@showDetail');

	Route::post('', 'AdminController@storeJournal');
	Route::patch('{journal}', 'AdminController@updateJournal');
	Route::patch('{journal}/update-status-journal', 'AdminController@updateStatusJournal');
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

	Route::get('{event}/register', 'MyEventController@showRegister');
	Route::post('{event}/register', 'MyEventController@register');
});

//tickets and orders
Route::group(['prefix' => 'tickets'], function () {
	Route::get('', 'TicketController@index');
	Route::get('{order}/invoice', 'TicketController@invoice');
	Route::get('{order}/ticket', 'TicketController@ticket');
});

//checkout
Route::group(['prefix' => 'checkout'], function () {
	Route::get('', 'CheckoutController@index');
	Route::post('pay', 'CheckoutController@pay');
	Route::post('proceed', 'CheckoutController@proceed');
	Route::get('success', 'CheckoutController@success');
	Route::get('failed', 'CheckoutController@failed');
	Route::get('bypass', 'CheckoutController@bypass');
});

//notification
Route::group(['prefix' => 'notification'], function () {
	Route::post('payment', 'NotificationController@payment');
});

//subscribers
Route::group(['prefix' => 'subscribers'], function () {
	Route::post('subscribe', 'SubscriberController@subscribe');
	Route::get('unsubscribe/{subscriber}', 'SubscriberController@unsubscribe');
});

//orders
Route::group(['prefix' => 'orders'], function () {
	Route::get('', 'OrderController@index');
});

//messages
Route::group(['prefix' => 'messages'], function () {
	Route::post('', 'MessageController@store');
});

//banners
Route::group(['prefix' => 'banners'], function () {
	Route::post('', 'AdminController@storeBanner');
	Route::patch('{banner}', 'AdminController@updateBanner');
	Route::patch('{banner}/update-status-banner', 'AdminController@updateStatusBanner');
});
