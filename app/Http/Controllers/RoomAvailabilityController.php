<?php

namespace App\Http\Controllers;

use App\RATE;
use App\RES_RMTYPE_CNT_RATE;
use App\ROOM_TYPE;
use Carbon\Carbon;
use Session;
use DB;
use App\ROOM_RESERVATION;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\ReservationRoom;
use App\HotelInfo;

class RoomAvailabilityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Room Availability Controller
    |--------------------------------------------------------------------------
    |
    |This controller provides functions to check the available rooms within a
    |given date period and other functions that are related to room
    |reservation.
    |
    */

    /**
     * Redirect a room availability page according to customer requests.
     *
     * @param $request
     *
     * @return Website.Rooms_availability view with availability details
     */

    function checkRoomAvailability(Request $request)
    {
        //predefined variables for the room reservation form
        $total_rooms_have = config('constants.CHK_ZERO');
        $total_rooms=HotelInfo::value('selectable_no_of_rooms');
        $kids_can = HotelInfo::value('no_of_kids');
        $adults_can = HotelInfo::value('no_of_adults');
        $room_types = ROOM_TYPE::get();


        foreach($room_types as $room_type)
        {


            $total_rooms_have += DB::table('ROOMS')
                ->where('room_type_id','=',$room_type->room_type_id)
                ->count();
        }


        //check if the room count exceed the available rooms
        if($total_rooms > $total_rooms_have)
        {
            $total_rooms = $total_rooms_have;
        }

        //clears the hall reservation session details if there are any
        Session::forget(['hall_selected','event_date','total_payable']);

        //get the details from the form submission and store in variables
        $inputs = $request::all();

        $check_in = $inputs['check_in'];
        $check_out = $inputs['check_out'];
        $adults = $inputs['adults'];
        $kids = $inputs['children'];

        //requested number of rooms
        $rooms = $inputs['ono_of_rooms'];

        //put the requested reservation details to the session
        Session::put(['check_in'=>$check_in,'check_out'=>$check_out,'adults'=>$adults,'kids'=>$kids,'rooms'=>$rooms]);

        //clear the session if values already exists
        if (Session::has('room_types')) {

            $room_types = session('room_types');

            foreach ($room_types as $room_type) {

                Session::forget(['room_type_name' . $room_type,'no_of_rooms' . $room_type,'rate' . $room_type]);
                Session::forget(['meal_type' . $room_type,'rate_code' . $room_type,'total_payable']);
            }

            Session::forget('room_types');
        }

        $room_types = ROOM_TYPE::get();

        $room_results = $this->getAvailableRoomTypeCount($check_in,$check_out,"NEW",null);

        $total_rooms_available = $room_results['total_rooms_available'];

        $room_type_available = $room_results['room_type_available'];



        foreach($room_types as $room_type)
        {
            $total_rooms += $room_type->count;
        }

        //check the total rooms available with the requested total rooms
        if ($total_rooms_available < $rooms) {
            if ($total_rooms_available < config('constants.CHK_ZERO')) {
                $total_rooms_available = config('constants.CHK_ZERO');
            }

            return redirect('room_packages')->with(['rooms_not_available' => 'Sorry requested no of rooms are not available.Only ' . $total_rooms_available . ' room(s) are available']);
        } else {
            return view('Website.Rooms_availability', ['room_type_available' => $room_type_available, "room_types" => $room_types,
                    'total_rooms'=>$total_rooms,'kids_can'=>$kids_can,'adults_can'=>$adults_can]);
        }

    }

    /**
     * This function rooms selected for the reservation to the session.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addSelectedRooms(Request $request)
    {
        $inputs = $request::all();

        //get the selected rooms details and store it to variables
        $room_type_id = $inputs['room_type_id'];
        $room_type_name = $inputs['room_type_name'];
        $no_of_rooms = $inputs['no_of_rooms'];
        $rate_code = $inputs[$room_type_id.'rate_code'];

        $rate_price = RATE::where('rate_code','=',$rate_code)->value('single_rates');

        //get the early rate if the selected room is already in the session
        $early_rate_price = 0;


        $meal_type_name = RATE::join('MEAL_TYPES','RATES.meal_type_id','=','MEAL_TYPES.meal_type_id')
            ->where('RATES.rate_code','=',$rate_code)
            ->value('meal_type_name');

        //this variable is to identify whether the selected room type already added in the session previously
        $session_have = config('constants.CHK_ZERO');



        //check whether session has the room type added already
        if(Session::has('room_types')) {

            foreach(session('room_types') as $room_type) {
                if($room_type == $room_type_id) {
                    $session_have = config('constants.SESSION_HAVE');
                    $early_rate_price = RATE::where('rate_code','=',session('rate_code'.$room_type_id))->value('single_rates');

                }
            }
        }

        //store the total payable amount from the session to a variable
        $total_payable = config('constants.CHK_ZERO');
        if(Session::has('total_payable')) {
            $total_payable = session('total_payable');
        }

        //if the room type is already in the session update that session by replacing it
        if($session_have== config('constants.SESSION_HAVE')) {
            $total_payable = $total_payable - $early_rate_price * session('no_of_rooms'.$room_type_id) + $rate_price*$no_of_rooms;

            Session::put(['no_of_rooms'.$room_type_id=>$no_of_rooms,'rate_code'.$room_type_id=>$rate_code,'rate'.$room_type_id=>$rate_price]);
            Session::put(['meal_type'.$room_type_id=>$meal_type_name,'meal_type'.$room_type_id=>$meal_type_name,'total_payable'=>$total_payable]);

        }
        else {
            //if the room type is not available push the selected room type details to the session
            $total_payable += $rate_price * $no_of_rooms;
            Session::push('room_types',$room_type_id);
            Session::put(['no_of_rooms'.$room_type_id=>$no_of_rooms,'room_type_name'.$room_type_id=>$room_type_name,'rate_code'.$room_type_id=>$rate_code]);
            Session::put(['rate'.$room_type_id=>$rate_price,'meal_type'.$room_type_id=>$meal_type_name,'total_payable'=>$total_payable]);
        }

        //create arrays to store the session details to respond to a ajax request, this was done because without
        // refreshing the pages session values wont be updated in the views
        $room_types = array();
        $number_rooms = array();
        $rates = array();
        $meal = array();
        $room_type_ids = array();

        //push the values to the array
        foreach(session('room_types') as $room_type) {
            array_push($room_type_ids,$room_type);
            array_push($room_types,session('room_type_name'.$room_type));
            array_push($number_rooms,session('no_of_rooms'.$room_type));
            array_push($rates,session('rate'.$room_type));
            array_push($meal,session('meal_type'.$room_type));

        }

        return response()->json(['ids'=>$room_type_ids,'room_types'=>$room_types,'no_of_rooms'=>$number_rooms,'rates'=>$rates,'meals'=>$meal]);
    }

    /**
     * This function delete a selected room type if customer chooses.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delSelectedRoom_type(Request $request)
    {
        $inputs = $request::all();
        $room_type_id = $inputs['room_type_id'];

        $rate_price = session('rate'.$room_type_id);

        //deduct the deleted room type amount from the total payable amount
        Session::put('total_payable',session('total_payable') - $rate_price*session('no_of_rooms'.$room_type_id));

        $room_types = array();

        //add the room types to the array except the deleted room type
        foreach(session('room_types') as $room_type) {

            if($room_type != $room_type_id) {
                array_push($room_types,$room_type);
            }

        }

        //delete the room type details from the session
        Session::forget(['room_types','room_type_name'.$room_type_id,'no_of_rooms'.$room_type_id,'rate'.$room_type_id,'meal_type'.$room_type_id,'rate_code'.$room_type_id]);

        //add the updated room type list to the session
        foreach($room_types as $room_type) {
            Session::push('room_types',$room_type);
        }

        return response()->json(['task'=>'success']);
    }

    /**
     * This function add the session values to arrays in order to respond to ajax calls
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadMyBooking()
    {
        $room_types = array();
        $number_rooms = array();
        $rates = array();
        $meal = array();
        $room_type_ids = array();

        if(Session::has('room_types')) {

            foreach(session('room_types') as $room_type) {
                array_push($room_type_ids,$room_type);
                array_push($room_types,session('room_type_name'.$room_type));
                array_push($number_rooms,session('no_of_rooms'.$room_type));
                array_push($rates,session('rate'.$room_type));
                array_push($meal,session('meal_type'.$room_type));
            }
        }

        return response()->json(['ids'=>$room_type_ids,'room_types'=>$room_types,'no_of_rooms'=>$number_rooms,'rates'=>$rates,'meals'=>$meal]);
    }

    /**
     * This function is used to get the booked roomtype count for a period
     *
     * @param $check_in
     * @param $check_out
     * @return array
     */
    public function getBookedRoomTypeCount($check_in,$check_out,$reason,$res_id){

        $room_types = ROOM_TYPE::get();

        //an array to keep the count of rooms per room_type that are booked during the requested period
        $booked_room_type_count = array();


        //initially assign zero to each booked room type count
        foreach ($room_types as $room_type) {
            $booked_room_type_count[$room_type->room_type_id] = config('constants.CHK_ZERO');

        }


        if($reason == "NEW") {
            //query the reservations that are that have check in or check out dates between the requested date period
            $reservations = ROOM_RESERVATION::where('check_in', '<=', $check_out)
                ->where('check_out', '>=', $check_in)
                ->orwhereIn('remarks', ['tendative', 'confirmed'])//change this orwhereIn after you finish booking section
                ->select('room_reservation_id')
                ->distinct()
                ->get();
        }else{

            $reservations = ROOM_RESERVATION::where('check_in', '<=', $check_out)
                ->where('check_out', '>=', $check_in)
                ->where('room_reservation_id','!=',$res_id)
                ->orwhereIn('remarks', ['tendative', 'confirmed'])//change this orwhereIn after you finish booking section
                ->select('room_reservation_id')
                ->distinct()
                ->get();


        }

        //for each reservation within that period get the room types booked and their total room count
        foreach ($reservations as $reservation) {

            foreach ($room_types as $room_type) {
                $room_type_booked = RES_RMTYPE_CNT_RATE::where('room_reservation_id', '=', $reservation->room_reservation_id)
                    ->where('room_type_id', '=', $room_type->room_type_id)
                    ->value('count');

                //increment the room type count as per the entries in the RES_RMTYPE_CNT_RATE for a reservation
                $booked_room_type_count[$room_type->room_type_id] += $room_type_booked;
            }
        }

        return  $booked_room_type_count;
    }

    public function getAvailableRoomTypeCount($check_in,$check_out,$reason,$res_id){


        //an array to keep the count of rooms per room_type that are booked during the requested period
        $booked_room_type_count = $this->getBookedRoomTypeCount($check_in,$check_out,$reason,$res_id);

        //an array to keep the available room count of the room types for the requested period
        $room_type_available = array();

        //to give an error message to the customer if the requested number of rooms are g
        $total_rooms_available = config('constants.CHK_ZERO');

        $room_types = ROOM_TYPE::get();

        //room type count will be taken from the rooms table but for now take it from the room_type table
        foreach ($room_types as $room_type) {
            $room_type_room_count =DB::table('ROOMS')
                ->where('room_type_id','=',$room_type->room_type_id)
                ->count();

            $available_rooms = $room_type_room_count - $booked_room_type_count[$room_type->room_type_id];

            //check whether available rooms are negative
            if ($available_rooms >= config('constants.CHK_ZERO')) {

                $room_type_available[$room_type->room_type_id] = $available_rooms;
            } else {

                $room_type_available[$room_type->room_type_id] = config('constants.CHK_ZERO');
            }
            $total_rooms_available += $available_rooms;
        }

        return ["room_type_available"=>$room_type_available,"total_rooms_available"=>$total_rooms_available];

    }

    public function promotionValidate(Request $request)
    {
        $inputs = $request::all();

        $promotion_code = $inputs['promo_code'];

        $today = Carbon::now();

        $promo_details = DB::table('PROMOTIONS')
                            ->where('promotion_code','=',$promotion_code)
                            ->select('date_from','date_to','rate')
                            ->first();

        if(empty($promo_details))
        {
            return response()->json(['message_type'=>'error','message'=>'Promotion code is invalid']);
        }
        else{


            $date_from = $promo_details->date_from;
            $date_to = $promo_details->date_to;

            if($today < $date_from || $today > $date_to)
            {
                return response()->json(['message_type'=>'expired','message'=>'Sorry promotion code has been expired']);
            }

        }



        Session::put(['promo_code'=>$promotion_code,'promo_rate'=>$promo_details->rate]);



        return response()->json(['message_type'=>'success','message'=>"Success"]);


    }




}
