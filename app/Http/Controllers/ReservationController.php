<?php

namespace App\Http\Controllers;

use App\ROOM_RESERVATION;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\RES_RMTYPE_CNT_RATE;
use DateTime;
use DB;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    function RoomReservation(Request $request){

        $customer_email = Auth::user()->email;

        $customer_id = Customer::where('email',$customer_email)
                        ->value('cus_id');

        $reservation = new ROOM_RESERVATION;



        $datetime1 = new DateTime(session('check_in'));
        $datetime2 = new DateTime(session('check_out'));
        $interval = $datetime1->diff($datetime2);



        $reservation->check_in = session('check_in');
        $reservation->check_out = session('check_out');
        $reservation->adults = session('adults');
        $reservation->children = session('kids');
        $reservation->num_of_rooms = session('rooms');
        $reservation->num_of_nights = $interval->format('%d%')+1;
        $reservation->total_amount = session('total_payable');
        $reservation->cus_id = $customer_id;

        $reservation->save();

        $res_id = $reservation->room_reservation_id;





        foreach( session('room_types') as $room_type)
        {



            DB::table('RES_RMTYPE_CNT_RATE')->insert(
                [   'room_reservation_id' => $res_id,
                    'room_type_id' =>  $room_type,
                    'rate_code' => session('rate_code'.$room_type),
                    'count' => session('no_of_rooms'.$room_type)


                ]
            );




        }



        foreach(session('room_types') as $room_type)
        {

            Session::forget('room_type_name'.$room_type);
            Session::forget('no_of_rooms'.$room_type);
            Session::forget('rate'.$room_type);
            Session::forget('meal_type'.$room_type);
            Session::forget('rate_code'.$room_type);
            Session::forget('total_payable');

        }

        Session::forget('room_types');
        Session::forget('check_in');
        Session::forget('check_out');
        Session::forget('adults');
        Session::forget('kids');
        Session::forget('rooms');
        Session::forget('total_payable');




        return redirect('room_packages')->with(['reserv_status' => 'Reservation has been successfully made']);




    }
}
