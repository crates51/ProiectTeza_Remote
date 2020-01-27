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
Route::get('/bookings', 'BookingsController@get_all')->name('bookings-get-all');
Route::get('/bookings/page/{pageId}', 'BookingsController@page')->name('bookings-page');

//=============================CLIENTS=============================
Route::get('/clients', 'ClientsController@get_all');


// Route::resources('bookings','BookingsController');