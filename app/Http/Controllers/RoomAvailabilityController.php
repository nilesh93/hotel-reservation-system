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
use Session;
use DB;


use App\ROOM_RESERVATION;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoomAvailabilityController extends Controller
{

    /**
     * Redirect a room availability page according to customer requests.
     *
     * @param $request
     *
     * @return Website.Rooms_availability view with availability details
     */

    function check_room_availability(Request $request)
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


        //clear the session

        if(Session::has('room_types'))
        {
            $room_types =  session('room_types');

            foreach($room_types as $room_type)
            {

                Session::forget('room_type_name'.$room_type);
                Session::forget('no_of_rooms'.$room_type);
                Session::forget('rate'.$room_type);
                Session::forget('meal_type'.$room_type);
                Session::forget('rate_code'.$room_type);
                Session::forget('total_payable');

            }

            Session::forget('room_types');


        }


        $room_types = ROOM_TYPE::get();



        //an array to keep the count of rooms per room_type that are booked during the requested period
        $room_type_count = array();

        //an array to keep count of rooms in the RES_RMTYPE_CNT_RATE table for the reservations during the period
        //this array is used because for a reservation there can be many rows in the RES_RMTYPE_CNT_RATE table
        $room_type_booked = array();

        //an array to keep the available room count for the requested period
        $room_type_available = array();




        //initially assign zero to each room type count

        foreach($room_types as $room_type)
        {
           $room_type_count[$room_type->room_type_id] = 0;

        }



        $reservations = ROOM_RESERVATION::where('check_in', '<=', $check_out)
            ->where('check_out','>=',$check_in)
            ->orwhereIn('remarks', ['tendative','confirmed'])//change this orwhereIn after you finish booking section
            ->select('room_reservation_id')
            ->get();



        foreach($reservations as $reservation)
        {

            foreach($room_types as $room_type)
            {
                $room_type_booked[$room_type->room_type_id] = RES_RMTYPE_CNT_RATE::where('room_reservation_id', '=', $reservation->room_reservation_id)
                                                                                    ->where('room_type_id','=',$room_type->room_type_id)
                                                                                    ->select('count')
                                                                                    ->get();

                foreach($room_type_booked[$room_type->room_type_id] as $room_type_booked_cnt)
                {
                    //increment the room type count as per the entries in the RES_RMTYPE_CNT_RATE for a reservation
                    $room_type_count[$room_type->room_type_id] += $room_type_booked_cnt->count;

                }


            }

        }

        $total_rooms_available = 0;
        $available_rooms = 0;


        //room type count will be taken from the rooms table but for now take it from the room_type table
        foreach($room_types as $room_type)
        {

           $available_rooms = $room_type->count - $room_type_count[$room_type->room_type_id];


            //check whether available rooms are negative
            if($available_rooms >=0)
            {
                $room_type_available[$room_type->room_type_id] = $available_rooms;

            }
            else{

                $room_type_available[$room_type->room_type_id] = 0;
            }


            $total_rooms_available += $available_rooms;
        }




        if($total_rooms_available <  $rooms )
        {

            return redirect('room_packages')->with(['rooms_not_available'=>'Sorry requested no of rooms are not available.Only ' . $total_rooms_available . ' room(s) are available']);
        }

        else
        {
            return view('Website.Rooms_availability',['room_type_available'=>$room_type_available,"room_types"=>$room_types]);


        }





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

        $total_payable = 0;

        if(Session::has('total_payable'))
        {
            $total_payable = session('total_payable');
        }



        if($have == 1)
        {
            $total_payable = $total_payable - $rate_price * session('no_of_rooms'.$room_type_id) + $rate_price*$no_of_rooms;

            Session::put('no_of_rooms'.$room_type_id,$no_of_rooms);
            Session::put('rate_code'.$room_type_id,$rate_code);
            Session::put('rate'.$room_type_id,$rate_price);
            Session::put('meal_type'.$room_type_id,$meal_type_name);
            Session::put('meal_type'.$room_type_id,$meal_type_name);
            Session::put('total_payable',$total_payable);




        }
        else
        {
            $total_payable += $rate_price * $no_of_rooms;
            Session::push('room_types',$room_type_id);
            Session::put('no_of_rooms'.$room_type_id,$no_of_rooms);
            Session::put('room_type_name'.$room_type_id,$room_type_name);
            Session::put('rate_code'.$room_type_id,$rate_code);
            Session::put('rate'.$room_type_id,$rate_price);
            Session::put('meal_type'.$room_type_id,$meal_type_name);
            Session::put('total_payable',$total_payable);



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


        $rate_price = session('rate'.$room_type_id);

        Session::put('total_payable',session('total_payable') - $rate_price*session('no_of_rooms'.$room_type_id));





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

    function cancel_reserve(){



        $room_types =  session('room_types');

        foreach($room_types as $room_type)
        {

            Session::forget('room_type_name'.$room_type);
            Session::forget('no_of_rooms'.$room_type);
            Session::forget('rate'.$room_type);
            Session::forget('meal_type'.$room_type);
            Session::forget('rate_code'.$room_type);
            Session::forget('total_payable');

        }

        Session::forget('room_types');


        return redirect('room_packages');

    }




}
