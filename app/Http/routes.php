<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('Website.Demo');
});


Route::get('/admin', function () {
    return view('Admin.Demo');
});

Route::get('/room_packages', function () {
    return view('Website.test');
});

Route::get('/halls', function () {
    return view('Website.Halls');
});

