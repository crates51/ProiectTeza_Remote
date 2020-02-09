<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//=============================BOOKINGS=============================

// Route::middleware('auth:api', 'throttle:60,1')->group(function () {
// });
// Gett all the Bookings
Route::get('/bookings', 'BookingsController@get_all')->name('bookings-get-all');
// Gett the Bookings from a page
Route::get('/bookings/page/{pageId}', 'BookingsController@page')->name('bookings-page');
// Gett the Bookings from a date
Route::get('/bookings/date/{date}', 'BookingsController@date')->name('bookings-date');

//=============================CLIENTS=============================
Route::get('/clients', 'ClientsController@get_all');


// Route::resources('bookings','BookingsController');