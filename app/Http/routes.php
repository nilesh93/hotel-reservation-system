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

/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', 'PagesController@HomePage');
Route::get('/home', 'PagesController@HomePage');
Route::get('admin', 'DashboardController@dash');
Route::get('/contact', 'PagesController@contactView');
Route::get('/gallery', function () {

    $images = App\imageGallery::all();

    return view('Website.webGallery')
        ->with('images',$images);
});

Route::get('/contact',function(){
    return view('Website.contact');
});

/*
|--------------------------------------------------------------------------
| Rish Routes
|--------------------------------------------------------------------------
|
|
*/



//rooms
Route::get('loadBooking', 'RoomAvailabilityController@loadMyBooking');
Route::get('room_packages', 'PagesController@roomsView');
Route::get('cancel_reserv', 'RoomReservationController@cancelCurrentReservation');
Route::get('select_room_add', 'RoomAvailabilityController@addSelectedRooms');
Route::get('room_reservation', 'RoomReservationController@roomReservation');
Route::post('room_availability', 'RoomAvailabilityController@checkRoomAvailability');
Route::get('my_past_room_reservations', 'RoomReservationController@myPastReservation');
Route::get('delete_selected_room_type', 'RoomAvailabilityController@delSelectedRoom_type');
Route::get('my_future_room_reservations', 'RoomReservationController@myFutureReservation');
Route::get('promo_code_validate', 'RoomAvailabilityController@promotionValidate');


//halls
Route::get('halls', 'PagesController@hallsView');
Route::get('book_hall_add', 'HallAvailabilityController@addHallsToReserve');
Route::get('hall_availability', 'HallAvailabilityController@checkHallAvailability');
Route::get('cancel_hall_reserv', 'HallReservationController@deleteAddedHallReservation');
Route::get('hall_reserve_final', 'HallReservationController@hallReservation');
Route::get('my_past_hall_reservations', 'HallReservationController@myPastReservation');
Route::get('my_future_hall_reservations', 'HallReservationController@myFutureReservation');


//reservation
Route::get('myreserv', ['middleware' => 'auth', 'uses' =>'PagesController@myReserve']);

//payment
Route::get('payment', ['middleware' => 'auth', 'uses' =>'PagesController@makePayment']);

//webmaster views
Route::get('hall_view', 'WebMasterViewController@hallViewLoad');
Route::get('room_view','WebMasterViewController@roomViewLoad');

//admin
Route::get('admin_pending_reservation', 'AdminReservationController@pendingReservation');
Route::get('admin_get_pending_room_reservations', 'AdminReservationController@pendingRoomReservation');
Route::get('admin_get_pending_hall_reservations', 'AdminReservationController@pendingHallReservation');
Route::get('admin_individual_reservation', 'AdminReservationController@getIndividualReservationDetails');
Route::get('admin_check_room','AdminReservationController@checkRoomAvailability');
Route::get('admin_accept_update_reservation', 'AdminReservationController@updateAcceptReservation');
Route::get('admin_reservation_general', 'AdminReservationController@reservationGeneralInfo');
Route::get('admin_reject_room_reservation', 'AdminReservationController@updateRejectReservation');
Route::get('admin_individual_hall_reservation', 'AdminReservationController@getIndividualHallReservationDetails');
Route::get('admin_check_hall', 'AdminReservationController@checkHallAvailability');
Route::get('admin_accept_hall_update_reservation', 'AdminReservationController@updateHallAcceptReservation');
Route::get('admin_reject_hall_reservation', 'AdminReservationController@updateRejectHallReservation');
Route::get('admin_edit_reservation_info', 'AdminReservationController@updateReservationInfo');




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

//room management routes
Route::get('admin_rooms', 'RoomController@rooms');
Route::get('admin_getrooms', 'RoomController@getrooms');
Route::get('admin_getRoomNum','RoomController@admin_getRoomNum');
Route::get('admin_delete_room', 'RoomController@admin_delete_room');
Route::get('admin_check_rnum', 'RoomController@admin_check_rnum');
Route::get('admin_get_room_update_details', 'RoomController@admin_get_room_update_details');
Route::get('admin_save_room_update_details', 'RoomController@admin_save_room_update_details');


//room type manageent routes
Route::get('admin_getroom_types', 'RoomController@getroom_types');
Route::get('admin_room_add', 'RoomController@room_add');
Route::get('admin_roomtype_add','RoomController@admin_roomtype_add');
Route::get('admin_delete_room_type','RoomController@delete_room_type');
Route::get('admin_rt_image_del', 'RoomController@admin_rt_image_del');
Route::get('admin_getRoomNum','RoomController@admin_getRoomNum');
Route::get('admin_delete_room', 'RoomController@admin_delete_room');
Route::post('admin_roomtype_upload', 'RoomController@admin_roomtype_upload');
Route::get('admin_edit_roomtype', 'RoomController@admin_edit_roomtype');
Route::get('admin_roomtype_update', 'RoomController@admin_roomtype_update');
Route::get('admin_check_rnum', 'RoomController@admin_check_rnum');



//room services management
Route::get('admin_room_services', 'RoomController@roomservices');
Route::get('admin_get_room_services', 'RoomController@get_room_services');
Route::get('admin_room_service_add', 'RoomController@room_service_add');
Route::get('admin_getRS_info', 'RoomController@getRS_info');
Route::get('admin_updateRS','RoomController@updateRS');
Route::get('admin_delRS','RoomController@delRS');

//room furnish management
Route::get('admin_get_room_furnish', 'RoomController@get_room_furnish');
Route::get('admin_room_furnish_add', 'RoomController@room_furnish_add');
Route::get('admin_getRF_info', 'RoomController@getRF_info');
Route::get('admin_updateRF','RoomController@updateRF');
Route::get('admin_delRF','RoomController@delRF');


Route::get('admin_get_room_booking','RoomController@getRoomBookings');
Route::get('admin_booking_type_add','RoomController@bookingAdd');
Route::get('admin_getBT_info','RoomController@getBTinfo');
Route::get('admin_editBT_info','RoomController@editBTinfo');
Route::get('admin_delBT','RoomController@delBT');


Route::get('admin_reviews','ReviewController@reviews');
Route::get('admin_get_reviews','ReviewController@getReviews');
Route::get('admin_publish_review','ReviewController@publish');
Route::get('admin_reject_review','ReviewController@reject');




//Image gallery management
Route::get('admin_imageGallery','ImageGalleryController@imageGallery');
Route::get('admin_webImage_del','ImageGalleryController@admin_webImage_del');
Route::post('admin_gallery_upload','ImageGalleryController@admin_gallery_upload');


//Image home gallery management
Route::get('admin_webGallery','ImageGalleryController@webimageGallery');
Route::post('admin_web_gallery_upload','ImageGalleryController@admin_webgallery_upload');
Route::get('admin_homeImage_update','ImageGalleryController@admin_homeImage_update');
Route::get('get_homeImage_details','ImageGalleryController@get_homeImage_details');
Route::get('admin_homeImage_del','ImageGalleryController@admin_homeImage_del');




//hall management
Route::get('admin_halls','HallController@halls');
Route::get('admin_get_halls','HallController@admin_get_halls');
Route::get('admin_hall_add','HallController@admin_hall_add');
Route::get('admin_edit_hall','HallController@admin_edit_hall');
Route::get('admin_update_hall','HallController@admin_update_hall');
Route::get('admin_hall_image_del','HallController@admin_hall_image_del');
Route::get('admin_delete_hall','HallController@admin_delete_hall');
Route::post('admin_hall_upload','HallController@admin_hall_upload');

//inquiry managemnt
Route::get('saveinquiry','InquiryController@saveinquiry');
Route::get('menu','MenuControllerWeb@menuMain');


//review management
Route::get('submit_review','PagesController@submit_review');
Route::get('abc','PusherController@bar');



Route::get('getReservationDate','DashboardController@getReservationDates');


Route::get('convert', 'CurrencyController@converter'); 


Route::get('admin_dashboard', 'DashboardController@dashboard'); 
Route::get('getEvents', 'DashboardController@getEvents'); 
Route::get('getHallEvents', 'DashboardController@getHallEvents'); 
Route::get('admin_reserve_room', 'DashboardController@admin_reserve_room'); 
Route::get('admin_getbookings', 'DashboardController@getbookings');


Route::get('getHallEventInfo', 'DashboardController@getHallEventInfo'); 

Route::get('admin_dash', 'DashboardController@dash');
Route::get('admin_search_availability', 'DashboardController@search_availability');



 
Route::get('admin_current_rooms', 'RoomController@current_rooms'); 
Route::get('admin_getcurrent_rooms', 'RoomController@get_current_rooms'); 
Route::get('admin_get_room_current', 'RoomController@get_room_current'); 

 


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

// View, Create, Delete Admin level users & Block Customers routes
Route::get('admin_users', 'UserController@Users');
Route::get('fill_data', 'UserController@fillData');
Route::get('block_customer', 'UserController@blockCustomer');
Route::get('unblock_customer', 'UserController@unblockCustomer');
Route::get('fill_data_admin', 'UserController@fillAdminData');
Route::post('new_admin', 'UserController@createNewAdmin');
Route::get('delete_admin','UserController@deleteAdmin');

// Facebook Login Routes
Route::get('login/fb', 'Auth\AuthController@redirectToProvider');
Route::get('login/fb/callback', 'Auth\AuthController@handleProviderCallback');

// Authenticated guest user's profile routes
Route::get('profile', 'RegisteredUsersController@profileView');
Route::post('profile', 'RegisteredUsersController@profileUpdate');

// Authenticated guest user's change password routes
Route::get('change_password', 'RegisteredUsersController@changePasswordView');
Route::post('change_password', 'RegisteredUsersController@changePassword');

// User Blocked Notice route
Route::get('blocked_user', 'UserController@blockNotice');

// Hall Services routes (Controller is from Nilesh, View has been created in ./Resources/nilesh)
Route::get('hallServices', 'HallController@getHallServices');
Route::get('getHallServices', 'HallController@getHallServiceData');
Route::get('getHallServiceInfo', 'HallController@getHallServiceInfo');
Route::get('editHallService', 'HallController@updateHallService');
Route::get('addHallService', 'HallController@addHallService');
Route::get('deleteHallService', 'HallController@deleteHallService');

// Backup and Restore routes
Route::get('get_backup', 'BackupController@getView');
Route::get('get_backupData', 'BackupController@getBackupData');
Route::get('make_backup', 'BackupController@makeBackup');
Route::get('downloadDataDump/{serial_num}', 'BackupController@downloadBackup');
Route::get('restore/{serial_num}', 'BackupController@restoreView');
Route::post('restore/auth', 'BackupController@restoreDatabase');

// About Us page routes
Route::get('about_us', 'AboutUsPageController@viewPage');

// Edit About Us page routes
Route::get('admin_about_us', 'AboutUsPageController@viewAdminPage');
Route::post('admin_about_us_edit', 'AboutUsPageController@editContent');

// Notifications read status update
Route::get('setReadStatus', 'BackupController@setStatus');

// Inaccessible views testing route
Route::get('/test', function(){
    return view('errors.modelNotFound');
});


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

//All the requests from admin_promotions URI will be handled in PromotionsController.
Route::controller('admin_promotions','PromotionsController');

//All the requests from admin_menus URI will be handled in MenusController.
Route::controller('admin_menus','MenusController');

//All the requests from admin_facilities URI will be handled in FacilitiesController.
Route::controller('admin_facilities','FacilitiesController');

//Search functions for bookings search.
Route::get('admin_search_bookings','SearchController@bookings_search');
Route::get('admin_search_bookings_get','SearchController@bookings_search_get');
Route::get('admin_bookings_search','SearchController@bookings_search_index');

//Search functions for rooms search.
Route::get('admin_rooms_search','SearchController@rooms_search_index');
Route::get('admin_room_search_past','SearchController@rooms_search_past');
Route::get('admin_room_search_current','SearchController@rooms_search_current');
Route::get('admin_room_search_future','SearchController@rooms_search_future');

//Search functions for customers search
Route::get('admin_search/customers','SearchController@customers_search');
Route::get('admin_customers_search','SearchController@customers_search_index');

//Test email
Route::get('testmail',function(){

    Mail::send('emails.newAdmin', [], function ($message)  {
        $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

        $message->to('hash.crackhead@gmail.com')->subject('Welcome to the team!');
    });
});

route::post('upload',function(){
    if(Input::hasFile('file')) {
        //upload an image to the /img/tmp directory and return the filepath.

        $file = Input::file('file');
        $fname = Input::get('fname').".".$file->getClientOriginalExtension();
        $tmpFilePath = '/img/tmp/';
        $destFilePath = 'img/tmp/';

        $tmpFileName = $fname ;
        $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
        $path = $destFilePath . $fname;
        return response()->json(array('path'=> $path), 200);
    } else {
        return response()->json(false, 200);
    }

});
/*
|
|
|--------------------------------------------------------------------------
| End Nipuna Routes
|--------------------------------------------------------------------------
*/

