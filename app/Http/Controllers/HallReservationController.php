<?php

namespace App\Http\Controllers;

use App\HALL;
use App\HALL_RESERVATION;
/*use Illuminate\Http\Request;*/

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use Session;
use Mail;
use Carbon\Carbon;

class HallReservationController extends Controller
{
    /**
     * store the hall reservation details to the db
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    function HallReservation(){

        $customer_email = Auth::user()->email;

        $customer_id = Customer::where('email',$customer_email)
                        ->value('cus_id');

        $customer_name = Customer::where('email',$customer_email)
                        ->value('name');

        $hall_name = HALL::where('hall_id',session('hall_selected'))
                    ->value('title');

        $event_date = session('event_date');


        $hall_reservation = new HALL_RESERVATION;


        $hall_reservation->reserve_date = session('event_date');
        $hall_reservation->total_amount = session('total_payable');
        $hall_reservation->cus_id = $customer_id;
        $hall_reservation->hall_id = session('hall_selected');

        $hall_reservation->save();

        $res_id = $hall_reservation->hall_reservation_id;

        Session::forget('event_date');
        Session::forget('total_payable');
        Session::forget('hall_selected');


        $data = array('res_id'=>$res_id,'hall_name'=>$hall_name,'event_date'=>$event_date,'name'=>$customer_name);

        Mail::send('emails.HallReservationMail', $data, function ($message) use ($customer_email) {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $message->to($customer_email)->subject('Welcome to Amalya Reach!');
        });


        return redirect('myreserv')->with(['hreserv_status' => 'Reservation has been successfully made']);


    }

    /**
     * get the future reservations that are made by the customer
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function MyFutureReservation(Request $request){

        $inputs = $request::all();

        $customer_id = $inputs['customer_id'];

        $date = Carbon::now();

        $f_reservations = HALL_RESERVATION::where('cus_id','=',$customer_id)
            ->where('reserve_date','>',$date)
            ->join('HALLS','HALLS.hall_id','=','HALL_RESERVATION.hall_id')
            ->get();


        return response()->json(['res_id'=>count($f_reservations), 'data'=>$f_reservations]);


    }

    /**
     * get the past reservations that are made by the customer
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function MyPastReservation(Request $request){

        $inputs = $request::all();

        $customer_id = $inputs['customer_id'];

        $date = Carbon::now();

        $p_reservations = HALL_RESERVATION::where('cus_id','=',$customer_id)
            ->where('reserve_date','<',$date)
            ->join('HALLS','HALLS.hall_id','=','HALL_RESERVATION.hall_id')
            ->get();


        return response()->json(['res_id'=>count($p_reservations), 'data'=>$p_reservations]);


    }

}
