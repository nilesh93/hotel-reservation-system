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

 


Route::get('/get-customer', function(){
	$result = DB::table('promotions')->get();
	        return response()->json(['count' => count($result), 'data' => $result]);
});


Route::get('/addpromotion',function() {

    $promotion_name = Input::get('promo_name');
    $promotion_description = Input::get('promo_description');
    $date_from = Input::get('promo_start');
    $date_to = Input::get('promo_end');
    $rate = Input::get('promo_rate');
   
    DB::table('promotions')->insert(array('promotion_name'=> $promotion_name,'promotion_description'=> $promotion_description,'date_from'=> $date_from,'date_to'=> $date_to,'rate'=> $rate));
    return 1;


});