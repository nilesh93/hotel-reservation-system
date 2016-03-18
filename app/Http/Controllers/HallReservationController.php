<?php

namespace App\Http\Controllers;

use App\HALL;
use App\HALL_RESERVATION;
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
    /*
    |--------------------------------------------------------------------------
    | Hall Reservation Controller
    |--------------------------------------------------------------------------
    |
    |This controller provides functions to store the hall reservation details
    |to the db and also provides functions to cancel reservation.
    |
    */

    /**
     * This function is to store the reservation details to db.
     * After storing the details this function redirects to the My Reservation view.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hallReservation()
    {
        try {
            //set the timezone
            date_default_timezone_set("Asia/Colombo");

            $customer_email = Auth::user()->email;

            $customer_id = Customer::where('email', $customer_email)
                ->value('cus_id');

            $customer_name = Customer::where('email', $customer_email)
                ->value('name');

            $hall_name = HALL::where('hall_id', session('hall_selected'))
                ->value('title');

            $event_date = session('event_date');

            //create instance of the HALL_RESERVATION model
            $hall_reservation = new HALL_RESERVATION;

            $hall_reservation->reserve_date = session('event_date');
            $hall_reservation->total_amount = session('total_payable');
            $hall_reservation->cus_id = $customer_id;
            $hall_reservation->hall_id = session('hall_selected');

            $hall_reservation->save();

            //retrieve the reservation id of the last saved reservation
            $res_id = $hall_reservation->hall_reservation_id;

            //delete the reservation details since already stored in the db
            Session::forget('event_date');
            Session::forget('total_payable');
            Session::forget('hall_selected');
            Session::forget('CanPay');

            //create an array in order to send the mail view with reservation details
            $data = array('res_id' => $res_id, 'hall_name' => $hall_name, 'event_date' => $event_date, 'name' => $customer_name);

            //send a mail to the customer confirming his reservation details
            Mail::send('emails.HallReservationMail', $data, function ($message) use ($customer_email) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($customer_email)->subject('Welcome to Amalya Reach!');
            });

            return redirect('myreserv')->with(['hreserv_status' => 'Reservation has been successfully made']);
        } catch(\Exception $e){

                abort(406,$e->getMessage());
        }


    }

    /**
     * This function cancels the currently added hall reservation to the session.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteAddedHallReservation()
    {
        //clear the session in order to cancel added reservation details
        Session::forget('hall_selected');
        Session::forget('total_payable');
        Session::forget('CanPay');

        return redirect('halls');
    }

    /**
     * This function provides the future reservations that are made
     * by the customer.It responds to a ajax call from the
     * view My Reservation
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myFutureReservation(Request $request)
    {
        $inputs = $request::all();
        $customer_id = $inputs['customer_id'];

        $date = Carbon::now();

        $future_reservations = HALL_RESERVATION::where('cus_id', '=', $customer_id)
            ->where('reserve_date', '>', $date)
            ->join('HALLS', 'HALLS.hall_id', '=', 'HALL_RESERVATION.hall_id')
            ->select('HALL_RESERVATION.created_at','HALL_RESERVATION.hall_reservation_id','HALL_RESERVATION.reserve_date','HALL_RESERVATION.total_amount','HALLS.title')
            ->get();

        return response()->json(['res_id' => count($future_reservations), 'data' => $future_reservations]);
    }

    /**
     * This function provide the past reservation that are made by the customer.
     * It responds to a ajax call from the view My Reservations
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myPastReservation(Request $request)
    {
        $inputs = $request::all();
        $customer_id = $inputs['customer_id'];

        $date = Carbon::now();

        $past_reservations = HALL_RESERVATION::where('cus_id', '=', $customer_id)
            ->where('reserve_date', '<', $date)
            ->join('HALLS', 'HALLS.hall_id', '=', 'HALL_RESERVATION.hall_id')
            ->get();

        return response()->json(['res_id' => count($past_reservations), 'data' => $past_reservations]);
    }
}