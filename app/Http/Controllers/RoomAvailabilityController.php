<?php

namespace App\Http\Controllers;

use App\RATE;
use App\RES_RMTYPE_CNT_RATE;
use App\ROOM_TYPE;
use Session;
use DB;
use App\ROOM_RESERVATION;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        try {
            //clears the hall reservation session details if there are any
            Session::forget('hall_selected');
            Session::forget('event_date');
            Session::forget('total_payable');

            //get the details from the form submission and store in variables
            $inputs = $request::all();

            $check_in = $inputs['check_in'];
            $check_out = $inputs['check_out'];
            $adults = $inputs['adults'];
            $kids = $inputs['children'];
            $rooms = $inputs['ono_of_rooms'];

            //put the requested reservation details to the session
            Session::put('check_in', $check_in);
            Session::put('check_out', $check_out);
            Session::put('adults', $adults);
            Session::put('kids', $kids);
            Session::put('rooms', $rooms);

            //clear the session if values already exists
            if (Session::has('room_types')) {

                $room_types = session('room_types');

                foreach ($room_types as $room_type) {

                    Session::forget('room_type_name' . $room_type);
                    Session::forget('no_of_rooms' . $room_type);
                    Session::forget('rate' . $room_type);
                    Session::forget('meal_type' . $room_type);
                    Session::forget('rate_code' . $room_type);
                    Session::forget('total_payable');

                }
                Session::forget('room_types');
            }

            $room_types = ROOM_TYPE::get();

            //an array to keep the count of rooms per room_type that are booked during the requested period
            $booked_room_type_count = array();

            //an array to keep count of rooms in the RES_RMTYPE_CNT_RATE table for the reservations during the period
            //this array is used because for a reservation there can be many rows in the RES_RMTYPE_CNT_RATE table
            $room_type_booked = array();

            //an array to keep the available room count of the room types for the requested period
            $room_type_available = array();


            //initially assign zero to each booked room type count
            foreach ($room_types as $room_type) {
                $booked_room_type_count[$room_type->room_type_id] = 0;

            }

            //query the reservations that are that have check in or check out dates between the requested date period
            $reservations = ROOM_RESERVATION::where('check_in', '<=', $check_out)
                ->where('check_out', '>=', $check_in)
                ->orwhereIn('remarks', ['tendative', 'confirmed'])//change this orwhereIn after you finish booking section
                ->select('room_reservation_id')
                ->distinct()
                ->get();

            //for each reservation within that period get the room types booked and their total room count
            foreach ($reservations as $reservation) {

                foreach ($room_types as $room_type) {
                    $room_type_booked[$room_type->room_type_id] = RES_RMTYPE_CNT_RATE::where('room_reservation_id', '=', $reservation->room_reservation_id)
                        ->where('room_type_id', '=', $room_type->room_type_id)
                        ->select('count')
                        ->get();

                    foreach ($room_type_booked[$room_type->room_type_id] as $room_type_booked_cnt) {
                        //increment the room type count as per the entries in the RES_RMTYPE_CNT_RATE for a reservation
                        $booked_room_type_count[$room_type->room_type_id] += $room_type_booked_cnt->count;

                    }
                }
            }

            $total_rooms_available = 0;
            $available_rooms = 0;

            //room type count will be taken from the rooms table but for now take it from the room_type table
            foreach ($room_types as $room_type) {
                /*$room_type_room_count = DB::table('ROOMS')
                                        ->where('room_type_id','=',1)
                                        ->count();*/

                $available_rooms = $room_type->count - $booked_room_type_count[$room_type->room_type_id];

                //check whether available rooms are negative
                if ($available_rooms >= 0) {

                    $room_type_available[$room_type->room_type_id] = $available_rooms;
                } else {

                    $room_type_available[$room_type->room_type_id] = 0;
                }

                $total_rooms_available += $available_rooms;
            }

            //check the total rooms available with the requested total rooms
            if ($total_rooms_available < $rooms) {
                if ($total_rooms_available < 0) {
                    $total_rooms_available = 0;
                }

                return redirect('room_packages')->with(['rooms_not_available' => 'Sorry requested no of rooms are not available.Only ' . $total_rooms_available . ' room(s) are available']);
            } else {
                return view('Website.Rooms_availability', ['room_type_available' => $room_type_available, "room_types" => $room_types]);
            }
        }catch (\Exception $e)
        {
            abort(406,$e->getMessage());
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

        $meal_type_name = RATE::join('MEAL_TYPES','RATES.meal_type_id','=','MEAL_TYPES.meal_type_id')
                        ->where('RATES.rate_code','=',$rate_code)
                        ->value('meal_type_name');

        //this variable is to identify whether the selected room type already added in the session previously
        $session_have = 0;

        //check whether session has the room type added already
       if(Session::has('room_types')) {

           foreach(session('room_types') as $room_type) {
               if($room_type == $room_type_id) {
                   $session_have = 1;
               }
           }
       }

        //store the total payable amount from the session to a variable
        $total_payable = 0;
        if(Session::has('total_payable')) {
            $total_payable = session('total_payable');
        }

        //if the room type is already in the session update that session by replacing it
        if($session_have== 1) {
            $total_payable = $total_payable - $rate_price * session('no_of_rooms'.$room_type_id) + $rate_price*$no_of_rooms;

            Session::put('no_of_rooms'.$room_type_id,$no_of_rooms);
            Session::put('rate_code'.$room_type_id,$rate_code);
            Session::put('rate'.$room_type_id,$rate_price);
            Session::put('meal_type'.$room_type_id,$meal_type_name);
            Session::put('meal_type'.$room_type_id,$meal_type_name);
            Session::put('total_payable',$total_payable);
        }
        else {
            //if the room type is not available push the selected room type details to the session
            $total_payable += $rate_price * $no_of_rooms;
            Session::push('room_types',$room_type_id);
            Session::put('no_of_rooms'.$room_type_id,$no_of_rooms);
            Session::put('room_type_name'.$room_type_id,$room_type_name);
            Session::put('rate_code'.$room_type_id,$rate_code);
            Session::put('rate'.$room_type_id,$rate_price);
            Session::put('meal_type'.$room_type_id,$meal_type_name);
            Session::put('total_payable',$total_payable);
        }

        //create arrays to store the session details to respond to a ajax request, this was done because without
        // refreshing the pages session values wont updated in the views
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
        Session::forget('room_types');
        Session::forget('room_type_name'.$room_type_id);
        Session::forget('no_of_rooms'.$room_type_id);
        Session::forget('rate'.$room_type_id);
        Session::forget('meal_type'.$room_type_id);
        Session::forget('rate_code'.$room_type_id);

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
}
