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

Route::get('/room_packages','PagesController@rooms');

Route::post('/room_packages/room_availability','RoomAvailabiltyController@check_room_availabilty');

Route::get('/room_packages/room_availability','PagesController@room_availabilty');

Route::get('/halls','PagesController@halls');

Route::get('/halls','PagesController@halls');




Route::get('admin_rooms', 'RoomController@rooms');

Route::get('admin_getrooms', 'RoomController@getrooms');
Route::get('admin_getroom_types', 'RoomController@getroom_types');

Route::get('admin_promotions','PromotionsController@promotions');

 

Route::get('/get-customer', function() {
    $result = DB::table('promotions')->get();

    return response()->json(['count' => count($result), 'data' => $result]);

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