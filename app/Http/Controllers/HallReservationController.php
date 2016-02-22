<?php

namespace App\Http\Controllers;

use App\HALL_RESERVATION;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use Session;

class HallReservationController extends Controller
{
    function HallReservation(){

        $customer_email = Auth::user()->email;

        $customer_id = Customer::where('email',$customer_email)
        ->value('cus_id');

        $hall_reservation = new HALL_RESERVATION;

        $hall_reservation->reserve_date = session('event_date');
        $hall_reservation->total_amount = session('total_payable');
        $hall_reservation->cus_id = $customer_id;
        $hall_reservation->hall_id = session('hall_selected');

        $hall_reservation->save();


        Session::forget('event_date');
        Session::forget('total_payable');
        Session::forget('hall_selected');

        return redirect('halls')->with(['hreserv_status' => 'Reservation has been successfully made']);




    }


}
