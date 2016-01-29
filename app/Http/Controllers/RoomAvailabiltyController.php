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
use Request;
use App\ROOM_RESERVATION;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoomAvailabiltyController extends Controller
{

    /**
     * Redirect a room availability page according to customer requests.
     *
     *
     * @return Website.Rooms_availability view with availability details
     */

    function check_room_availabilty()
    {
        $inputs = Request::all();

        $check_in = $inputs['check_in'];
        $check_out = $inputs['check_out'];


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

}
