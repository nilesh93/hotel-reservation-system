<?php

use App\ROOM_TYPE;
use App\HALL;
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
    $room_types = ROOM_TYPE::get();
    //inorder to load the halls navigation bar list
    $halls = HALL::get();
    return view('Website.Demo',["room_types"=>$room_types,"halls"=>$halls]);
});

Route::get('admin', function () {
    return view('Admin.Demo');
});             

Route::get('/admin', function () {
    return view('Admin.Demo');
});

Route::get('/contact',function(){
    
    return view('Website.contact');
    
    
});


Route::get('/LOL',function(){
    
 
    return view('webmaster');
});

/*
|--------------------------------------------------------------------------
| Rish Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/room_packages','PagesController@rooms');

Route::post('/room_packages/room_availability','RoomAvailabiltyController@check_room_availabilty');

Route::get('/room_packages/room_availability','PagesController@room_availabilty');

Route::get('/halls','PagesController@halls');




/*
|
|
|--------------------------------------------------------------------------
| End Rish Routes
|--------------------------------------------------------------------------
*/






/*
|--------------------------------------------------------------------------
| Nilesh Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('admin_rooms', 'RoomController@rooms');
Route::get('admin_getrooms', 'RoomController@getrooms');
Route::get('admin_getroom_types', 'RoomController@getroom_types');
Route::get('admin_room_add', 'RoomController@room_add');
Route::get('admin_roomtype_add','RoomController@admin_roomtype_add');
Route::get('admin_delete_room_type','RoomController@delete_room_type');
Route::get('admin_getRoomNum','RoomController@admin_getRoomNum');
Route::get('admin_delete_room', 'RoomController@admin_delete_room'); 


Route::get('admin_halls','HallController@halls');
Route::get('admin_get_halls','HallController@admin_get_halls');
Route::get('admin_hall_add','HallController@admin_hall_add');
Route::get('admin_delete_hall','HallController@admin_delete_hall');


Route::get('saveinquiry','InquiryController@saveinquiry');


/*
|
|
|--------------------------------------------------------------------------
| End Nilesh Routes
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Vishan Routes
|--------------------------------------------------------------------------
|
|
*/

// Register & Login routes
Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes
Route::get('password/email', 'Auth\PasswordController@getEmail');

Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');

Route::post('password/reset', 'Auth\PasswordController@postReset');

/*
|
|
|--------------------------------------------------------------------------
| End Vishan Routes
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Nipuna Routes
|--------------------------------------------------------------------------
|
|
*/


Route::controller('admin_promotions','PromotionsController');
Route::controller('admin_menus','MenusController');
Route::controller('admin_facilities','FacilitiesController');
Route::get('admin_search/bookings','nipuna_controller@bookings_search');
Route::get('admin_bookings_search','nipuna_controller@bookings_search_index');

Route::get('admin_rooms_search','nipuna_controller@rooms_search_index');
Route::get('admin_search/rooms','nipuna_controller@rooms_search');

/*
|
|
|--------------------------------------------------------------------------
| End Nipuna Routes
|--------------------------------------------------------------------------
*/

