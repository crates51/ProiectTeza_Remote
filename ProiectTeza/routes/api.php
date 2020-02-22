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
//======GET======
// Get all the Bookings
Route::get('/bookings', 'BookingsController@get_all')->name('bookings-get-all');
// Get the Bookings from a page
Route::get('/bookings/page/{pageId}', 'BookingsController@by_page')->name('bookings-page');
// Get the Bookings from a date
Route::get('/bookings/date/{date}', 'BookingsController@by_date')->name('bookings-date');
// Get the Bookings for a client
Route::get('/bookings/client/{clientId}', 'BookingsController@by_client')->name('bookings-date');

//======DELETE======
// Delete the bookings of a client
Route::delete('/bookings/client/{clientId}', 'BookingsController@destroyByClient');


//=============================CLIENT/S=============================
//======GET======
// Get all the Clients
Route::get('/clients', 'ClientsController@getAll');
// Get client by Id
Route::get('/client/{clientId}', 'ClientsController@getById');

//======PUT======
// Edit a client by Id
Route::put('/client/{clientId}', 'ClientsController@update');

//======POST======
// Add a client 
Route::post('/client', 'ClientsController@store');

//======DELETE======
// Delete a client by Id
Route::delete('/client/{clientId}', 'ClientsController@destroy');


//=============================ROOM/S=============================
//======GET======
// Gett all the Rooms
Route::get('/rooms', 'RoomsController@getAll');
