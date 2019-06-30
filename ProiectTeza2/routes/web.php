<?php

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});
// Redirects you to the main page

Route::get('/', 'PagesController@index');

// Redirects the user to the booking main page

Route::get('/bookings', 'BookingsController@index');

// Redirects the user to the specific booking page

Route::get('/bookings/{id}/show', 'BookingsController@show')->name('bookings-show');

Route::get('/bookings/{id}/destroy', 'BookingsController@destroy')->name('bookings-destroy');

Route::get('/generalInfo/{name}/{totalRooms}/store', 'generalinfoController@store')->name('generalInfo-store');


// When Changing the status of the client from the main page buttons

// Route::get('/bookings/{booking}/{client}', 'BookingsController@update')->name('bookings.update');


Route::get('/bookings/{id}/update/{status}', 'BookingsController@updateSpecific')->name('bookings-updateSpecific');

// Rooms page

Route::get('/rooms', 'RoomsController@index')->name('home');

//Others

Route::resources([
    'bookings' => 'BookingsController',
    'rooms' => 'RoomsController'
]);

// Route::resource([
	// 'bookings','BookingsController');
// Route::resource('rooms','RoomsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/home', 'PagesController@index');

// Route::get('search', function() {
    // $query = 'vlad'; // <-- Change the query for testing.
// 
    // $articles = App\User::search($query)->get();
// 
    // return $articles;
// });

// For sending mail
 // Route::get('laravel-send-email', 'OrderController@sendEMail');
// Route::get('/send/email', 'HomeController@mail');
