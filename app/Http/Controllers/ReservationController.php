<?php

namespace App\Http\Controllers;

use App\ROOM_RESERVATION;
/*use Illuminate\Http\Request;*///i made a change


use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\RES_RMTYPE_CNT_RATE;
use DateTime;
use DB;
use Illuminate\Support\Facades\Session;
use Mail;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * store the room reservation details to db
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function RoomReservation(Request $request){

        $customer_email = Auth::user()->email;

        $customer_id = Customer::where('email',$customer_email)
                        ->value('cus_id');

        $customer_name = Customer::where('email',$customer_email)
                        ->value('name');

        $datetime1 = new DateTime(session('check_in'));
        $datetime2 = new DateTime(session('check_out'));
        $interval = $datetime1->diff($datetime2);

        $check_in = session('check_in');
        $check_out = session('check_out');
        $no_of_rooms = session('rooms');
        $no_of_guests = session('adults') + session('kids');
        $no_of_nights = $interval->format('%d%')+1;

       


        $reservation = new ROOM_RESERVATION;



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




        $data = array('res_id'=>$res_id,'check_in'=>$check_in,'check_out'=>$check_out,'nights'=> $no_of_nights,
            'no_of_rooms'=>$no_of_rooms,'guests'=>$no_of_guests,'name'=>$customer_name);

        Mail::send('emails.RoomReservationMail', $data, function ($message) use ($customer_email) {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $message->to($customer_email)->subject('Welcome to Amalya Reach!');
        });




        return redirect('myreserv')->with(['reserv_status' => 'Room_Reservation']);




    }

    /**
     * get the future room reservation of the customer
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function MyFutureReservation(Request $request){

        $inputs = $request::all();

        $customer_id = $inputs['customer_id'];

        $date = Carbon::now();

        $f_reservations = ROOM_RESERVATION::where('cus_id','=',$customer_id)
                            ->where('check_in','>',$date)
                            ->get();

        return response()->json(['res_id' => count($f_reservations), 'data' => $f_reservations]);



    }

    /**
     * get the past room reservations of the customer
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function MyPastReservation(Request $request){

        $inputs = $request::all();

        $customer_id = $inputs['customer_id'];

        $date = Carbon::now();

        $f_reservations = ROOM_RESERVATION::where('cus_id','=',$customer_id)
            ->where('check_out','<',$date)
            ->get();

        return response()->json(['res_id' => count($f_reservations), 'data' => $f_reservations]);


    }
}
