<?php

/*
|--------------------------------------------------------------------------
|RoomAvailabilityController
|--------------------------------------------------------------------------
|
| This controller handles the  rooms check availability part for
| each room types.
|
*/


namespace App\Http\Controllers;

use App\RES_RMTYPE_CNT_RATE;
use App\ROOM_TYPE;
use App\HALL;
use Session;
use DB;


use App\ROOM_RESERVATION;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoomAvailabiltyController extends Controller
{

    /**
     * Redirect a room availability page according to customer requests.
     *
     * @param $request
     *
     * @return Website.Rooms_availability view with availability details
     */

    function check_room_availabilty(Request $request)
    {

        $inputs = $request::all();


        $check_in = $inputs['check_in'];
        $check_out = $inputs['check_out'];
        $adults = $inputs['adults'];
        $kids = $inputs['children'];
        $rooms = $inputs['ono_of_rooms'];



        Session::put('check_in',$check_in);
        Session::put('check_out',$check_out);
        Session::put('adults',$adults);
        Session::put('kids',$kids);
        Session::put('rooms',$rooms);



        $superior_count =0;
        $deluxe_count =0;
        $luxury_count =0;
        $guest_count =0;


        $reservations = ROOM_RESERVATION::where('check_in', '<=', $check_in)
            ->where('check_out','>=',$check_out)
            ->whereIn('remarks', ['tendative','confirmed'])
            ->select('room_reservation_id')
            ->get();


        foreach($reservations as $reservation)
        {
            $superior = RES_RMTYPE_CNT_RATE::where('room_reservation_id', '=', $reservation->res_id)
                ->where('room_type_id','=',3)
                ->select('count')
                ->get();

            foreach($superior as $sup)
            {
                $superior_count += $sup->count;
            }

            $deluxe = RES_RMTYPE_CNT_RATE::where('room_reservation_id', '=', $reservation->res_id)
                ->where('room_type_id','=',4)
                ->select('count')
                ->get();

            foreach($deluxe as $del)
            {

                $deluxe_count += $del->count;
            }

            $luxury = RES_RMTYPE_CNT_RATE::where('room_reservation_id', '=', $reservation->res_id)
                ->where('room_type_id','=',5)
                ->select('count')
                ->get();

            foreach($luxury as $del)
            {

                $luxury_count += $del->count;
            }

            $guest =  RES_RMTYPE_CNT_RATE::where('room_reservation_id', '=', $reservation->res_id)
                ->where('room_type_id','=',6)
                ->select('count')
                ->get();

            foreach($guest as $gus)
            {

                $guest_count += $gus->count;
            }
        }

        $total_superior = ROOM_TYPE::where('room_type_id','=','3')
                        ->value('count');

        $total_deluxe = ROOM_TYPE::where('room_type_id','=','4')
                        ->value('count');
        $total_luxury = ROOM_TYPE::where('room_type_id','=','5')
                        ->value('count');

        $total_guest = ROOM_TYPE::where('room_type_id','=','6')
                        ->value('count');

        $available_superior = $total_superior - $superior_count;
        $available_deluxe = $total_deluxe - $deluxe_count;
        $available_luxury = $total_luxury - $luxury_count;
        $available_guest = $total_guest - $guest_count;


        $room_types = ROOM_TYPE::get();






        return view('Website.Rooms_availability',['available_superior'=>$available_superior,'available_deluxe'=>$available_deluxe,
                                        'available_luxury'=>$available_luxury,'available_guest'=>$available_guest,"room_types"=>$room_types]);
    }



    /**
     * Add the selected rooms to the session.
     *
     * @param $request
     *
     * @return jason output
     */



    function addSelectedRooms(Request $request)
    {



        $inputs = $request::all();

        $room_type_id = $inputs['room_type_id'];
        $room_type_name = $inputs['room_type_name'];
        $no_of_rooms = $inputs['no_of_rooms'];
        $rate_code = $inputs[$room_type_id.'rate_code'];



        $rate_price = DB::table('RATES')->where('rate_code','=',$rate_code)->value('single_rates');

        $meal_type_name = DB::table('RATES')
                        ->join('MEAL_TYPES','RATES.meal_type_id','=','MEAL_TYPES.meal_type_id')
                        ->where('RATES.rate_code','=',$rate_code)
                        ->value('meal_type_name');



        $have = 0;

        $room_types = array();
        $nrooms = array();
        $rates = array();
        $meal = array();
        $room_type_ids = array();
       if(Session::has('room_types'))
       {

           foreach(session('room_types') as $room_type)
           {
               if($room_type == $room_type_id)
               {
                   $have = 1;
               }
           }

       }



        if($have == 1)
        {
            Session::put('no_of_rooms'.$room_type_id,$no_of_rooms);
            Session::put('rate_code'.$room_type_id,$rate_code);
            Session::put('rate'.$room_type_id,$rate_price);
            Session::put('meal_type'.$room_type_id,$meal_type_name);



        }
        else
        {
            Session::push('room_types',$room_type_id);
            Session::put('no_of_rooms'.$room_type_id,$no_of_rooms);
            Session::put('room_type_name'.$room_type_id,$room_type_name);
            Session::put('rate_code'.$room_type_id,$rate_code);
            Session::put('rate'.$room_type_id,$rate_price);
            Session::put('meal_type'.$room_type_id,$meal_type_name);

        }


        foreach(session('room_types') as $room_type)
        {
            array_push($room_type_ids,$room_type);
            array_push($room_types,session('room_type_name'.$room_type));
            array_push($nrooms,session('no_of_rooms'.$room_type));
            array_push($rates,session('rate'.$room_type));
            array_push($meal,session('meal_type'.$room_type));

        }







        return response()->json(['ids'=>$room_type_ids,'room_types'=>$room_types,'no_of_rooms'=>$nrooms,'rates'=>$rates,'meals'=>$meal]);


    }


    /**
     * delete selected rooms from the session.
     *
     * @param $request
     *
     * @return jason output
     */





    function delSelectedRoom_type(Request $request)
    {


        $inputs = $request::all();

        $room_type_id = $inputs['room_type_id'];

        $nroom_types = array();

        foreach(session('room_types') as $room_type)
        {
            if($room_type != $room_type_id)
            {
                array_push($nroom_types,$room_type);

            }

        }

        Session::forget('room_types');
        Session::forget('room_type_name'.$room_type_id);
        Session::forget('no_of_rooms'.$room_type_id);
        Session::forget('rate'.$room_type_id);
        Session::forget('meal_type'.$room_type_id);
        Session::forget('rate_code'.$room_type_id);


        foreach($nroom_types as $room_type)
        {
            Session::push('room_types',$room_type);

        }



        return response()->json(['okay'=>'ok']);


    }


    /**
     * push session values to arrays.
     *
     * @return jason output
     */




    function loadMyBooking()
    {

        $room_types = array();
        $nrooms = array();
        $rates = array();
        $meal = array();
        $room_type_ids = array();

        if(Session::has('room_types'))
        {

            foreach(session('room_types') as $room_type)
            {
                array_push($room_type_ids,$room_type);
                array_push($room_types,session('room_type_name'.$room_type));
                array_push($nrooms,session('no_of_rooms'.$room_type));
                array_push($rates,session('rate'.$room_type));
                array_push($meal,session('meal_type'.$room_type));

            }



        }


        return response()->json(['ids'=>$room_type_ids,'room_types'=>$room_types,'no_of_rooms'=>$nrooms,'rates'=>$rates,'meals'=>$meal]);


    }

}
