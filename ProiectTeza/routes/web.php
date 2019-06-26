<?php

Route::get('/', 'PagesController@index');
Route::get('/contact', 'PagesController@contact');
Route::get('/news', 'PagesController@news');
Route::get('/gallery', 'PagesController@gallery');
Route::get('/rooms', 'PagesController@rooms');
// Route::get('/booking', 'PagesController@booking');



Route::resource('posts','PostsController');
Auth::routes();

Route::resource('bookings','BookingsController');

Route::get('/dashboard', 'DashboardController@index');
