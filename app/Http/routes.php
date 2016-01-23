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

Route::get('/promotions',function(){
	return view('nipuna.promotions');
});


Route::get('/admin', function () {
    return view('Admin.Demo');
});

Route::get('/get-customer', function(){
	$result = DB::table('promotions')->get();
	        return response()->json(['count' => count($result), 'data' => $result]);


});
