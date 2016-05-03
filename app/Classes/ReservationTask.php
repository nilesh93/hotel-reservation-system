<?php

namespace App\Classes;

use Illuminate\Support\Facades\Mail;
use Session;

    class ReservationTask extends Observer
    {
        function clearSession()
        {

            if(session('room_types')) {
                //since the details are stored in the db clear the session values
                foreach (session('room_types') as $room_type) {
                    Session::forget(['room_type_name' . $room_type,'no_of_rooms' . $room_type,'rate' . $room_type,'meal_type' . $room_type]);
                    Session::forget(['rate_code' . $room_type,'total_payable']);
                }

                //clear the requested details
                Session::forget(['room_types','check_in','check_out','adults','kids','rooms','total_payable','CanPay']);

            }



        }
    }
