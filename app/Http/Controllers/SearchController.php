<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use DateTime;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
 /**
     * Constructor for the SearchController class. Checks if a user has sufficient permission
     * to access the Admin area.
     *
     */
 public function __construct()
 {
  // Check if User is Authenticated
  $this->middleware('auth', ['except' => ['blockNotice']]);

  // Check if the authenticated user is an admin
  $this->middleware('isAdmin', ['except' => ['blockNotice']]);
 }
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function index()
 {
  //
 }

 /**
     * Returns the bookings search view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
 public function bookings_search_index(){
  return view('nipuna.searchbooking');
 }

 /**
     * Returns all the room reservations as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
 public function bookings_search(Request $request){


  $checkin = $request->input('checkin');
  $nic = $request->input('nic');
  $resid = $request->input('resid');
  $name = $request->input('name');

  $result = DB::select(DB::raw("
Select A.*,B.*,K.*,A.room_reservation_id as res
FROM HRS.ROOM_RESERVATION A
LEFT JOIN HRS.ROOM_RESERVATION_BLOCK B ON B.room_reservation_id = A.Room_reservation_id
LEFT JOIN HRS.CUSTOMER K ON K.cus_id = A.cus_id
WHERE K.name LIKE '$name' OR K.NIC_passport_num LIKE '$nic' OR A.room_reservation_id LIKE '$resid' OR DATE_FORMAT(A.check_in,'%Y-%m-%d') LIKE '$checkin' "));

  return response()->json(['count' => count($result), 'data' => $result]);
 }


 public function bookings_search_get(Request $request){



  $id = $request->input('id');


  $result = DB::select(DB::raw("
Select A.*,B.*,K.*,A.room_reservation_id as res
FROM HRS.ROOM_RESERVATION A
LEFT JOIN HRS.ROOM_RESERVATION_BLOCK B ON B.room_reservation_id = A.Room_reservation_id
LEFT JOIN HRS.CUSTOMER K ON K.cus_id = A.cus_id
WHERE A.room_reservation_id = '$id'"));


  $roomInfo = DB::select(DB::raw("SELECT A.*, (select B.type_name from HRS.ROOM_TYPES B where B.room_type_id = A.room_type_id) as type_name,
(select C.meal_type_name from HRS.MEAL_TYPES C where C.meal_type_id = F.meal_type_id) as meal
FROM HRS.RES_RMTYPE_CNT_RATE A
Left JOIN HRS.RATES F ON F.rate_code = A.rate_code
WHERE A.room_reservation_id = '$id'"));

  
  $roomblocks = DB::select(DB::raw("SELECT A.* ,
(Select B.room_num from HRS.ROOMS B where B.room_id = A.room_id) as room_num,
(Select (select C.type_name from HRS.ROOM_TYPES C where C.room_type_id = B.room_type_id) from HRS.ROOMS B where B.room_id = A.room_id) as type_name
FROM HRS.ROOM_RESERVATION_BLOCK A
where A.room_reservation_id = '$id'

"));
  
  
  return view('nilesh.reservation_info')
   ->with('room',$result)
   ->with('roomblocks',$roomblocks)
   ->with('roomInfo',$roomInfo);

 }


 /**
     * Returns the room search view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
 public function rooms_search_index(){

  $rooms = DB::select(DB::raw("select A.*,(select B.type_name from HRS.ROOM_TYPES B where B.room_type_id = A.room_type_id) as type_name from HRS.ROOMS A"));
  return view('nipuna.searchroom')
   ->with('rooms', $rooms);
 }

 /**
     * Returns all the available rooms as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
 public function rooms_search_past(Request $request){

  $id = $request->input('rid');
  $result = DB::select(DB::raw("Select A.*,B.*,K.*
        FROM HRS.ROOM_RESERVATION A
        LEFT JOIN HRS.ROOM_RESERVATION_BLOCK B ON B.room_reservation_id = A.Room_reservation_id
        LEFT JOIN HRS.CUSTOMER K ON K.cus_id = A.cus_id
        WHERE A.check_out < NOW()
        And B.room_id = '$id'"));
  return response()->json(['count' => count($result), 'data' => $result]);
 }

 public function rooms_search_current(Request $request){

  $id = $request->input('rid');
  $result = DB::select(DB::raw("Select A.*,B.*,K.*
        FROM HRS.ROOM_RESERVATION A
        LEFT JOIN HRS.ROOM_RESERVATION_BLOCK B ON B.room_reservation_id = A.Room_reservation_id
        LEFT JOIN HRS.CUSTOMER K ON K.cus_id = A.cus_id
        WHERE A.check_out > NOW()
        AND A.check_in < NOW()
        And B.room_id = '$id'"));

  return  view('nipuna.reservation_current')
   ->with('result',$result);


 }

 public function rooms_search_future(Request $request){

  $id = $request->input('rid');
  $result = DB::select(DB::raw("Select A.*,B.*,K.*
        FROM HRS.ROOM_RESERVATION A
        LEFT JOIN HRS.ROOM_RESERVATION_BLOCK B ON B.room_reservation_id = A.Room_reservation_id
        LEFT JOIN HRS.CUSTOMER K ON K.cus_id = A.cus_id
        WHERE  A.check_in > NOW()
        And B.room_id = '$id'"));
  return response()->json(['count' => count($result), 'data' => $result]);

 }
 /**
     * Returns the search customer view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
 public function customers_search_index(){
  return view('nipuna.searchcustomer');
 }

 /**
     * Returns all the customers as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
 public function customers_search(){
  $result = DB::table('customer')->get();
  return response()->json(['count' => count($result), 'data' => $result]);
 }

 public function roomlogspast(){
  $today = new DateTime();
  $result = DB::table('room_reservation')->where('check_in','<',$today)->get();
  return response()->json(['count' => count($result), 'data' => $result]);
 }

 public function roomlogsfuture(){
  $today = new DateTime();
  $result = DB::table('room_reservation')->where('check_in','>',$today)->get();
  return response()->json(['count' => count($result), 'data' => $result]);
 }
}
