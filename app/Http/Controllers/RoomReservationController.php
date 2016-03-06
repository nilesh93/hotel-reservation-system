<?php

namespace App\Http\Controllers;

use App\ROOM_RESERVATION;
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

class RoomReservationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Room Reservation Controller
    |--------------------------------------------------------------------------
    |
    |This controller provides functions to store the room reservation details
    |to the db and also provides functions to cancel added reservation
    |to the session.
    |
    */

    /**
     * This function store the room reservation details to db and clears the session
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function roomReservation(Request $request)
    {
        try {
            //set the timezone
            date_default_timezone_set("Asia/Colombo");

            //get the customer details currently logged in
            $customer_email = Auth::user()->email;
            $customer_id = Customer::where('email', $customer_email)
                ->value('cus_id');
            $customer_name = Customer::where('email', $customer_email)
                ->value('name');

            //convert the dates to date time insatance and get the difference
            $datetime1 = new DateTime(session('check_in'));
            $datetime2 = new DateTime(session('check_out'));
            $interval = $datetime1->diff($datetime2);

            //get the requested reservation details from the session
            $check_in = session('check_in');
            $check_out = session('check_out');
            $no_of_rooms = session('rooms');
            $no_of_guests = session('adults') + session('kids');
            $no_of_nights = $interval->format('%d%') + 1;

            //predefined check in and check out times
            $check_in_time = "14:00:00";
            $check_out_time = "12:00:00";

            //create a carbon timestamp instance merging the dates and time
            $check_in_datetime = Carbon::createFromTimestamp(strtotime($check_in . $check_in_time));
            $check_out_datetime = Carbon::createFromTimestamp(strtotime($check_out . $check_out_time));

            //creates a instance of the ROOM_RESERVATION model
            $reservation = new ROOM_RESERVATION;

            //store the details
            $reservation->check_in = $check_in_datetime;
            $reservation->check_out = $check_out_datetime;
            $reservation->adults = session('adults');
            $reservation->children = session('kids');
            $reservation->num_of_rooms = session('rooms');
            $reservation->num_of_nights = $interval->format('%d%') + 1;
            $reservation->total_amount = session('total_payable');
            $reservation->cus_id = $customer_id;

            $reservation->save();

            //get the last added reservation id
            $res_id = $reservation->room_reservation_id;

            //insert the the details to the RES_RMTYPE_CNT_RATE table
            foreach (session('room_types') as $room_type) {

                DB::table('RES_RMTYPE_CNT_RATE')->insert(
                    ['room_reservation_id' => $res_id,
                        'room_type_id' => $room_type,
                        'rate_code' => session('rate_code' . $room_type),
                        'count' => session('no_of_rooms' . $room_type)


                    ]
                );

            }

            //since the details are stored in the db clear the session values
            foreach (session('room_types') as $room_type) {
                Session::forget('room_type_name' . $room_type);
                Session::forget('no_of_rooms' . $room_type);
                Session::forget('rate' . $room_type);
                Session::forget('meal_type' . $room_type);
                Session::forget('rate_code' . $room_type);
                Session::forget('total_payable');
            }

            //clear the requested details
            Session::forget('room_types');
            Session::forget('check_in');
            Session::forget('check_out');
            Session::forget('adults');
            Session::forget('kids');
            Session::forget('rooms');
            Session::forget('total_payable');
            Session::forget('CanPay');

            //create an array with reservation details in ordr to send to the mail view
            $data = array('res_id' => $res_id, 'check_in' => $check_in, 'check_out' => $check_out, 'nights' => $no_of_nights,
                'no_of_rooms' => $no_of_rooms, 'guests' => $no_of_guests, 'name' => $customer_name);

            //send mail to the customer confirming the reservation details
            Mail::send('emails.RoomReservationMail', $data, function ($message) use ($customer_email) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($customer_email)->subject('Welcome to Amalya Reach!');
            });

            return redirect('myreserv')->with(['reserv_status' => 'Room_Reservation']);
        }catch (\Exception $e){
            abort(406,$e->getMessage());
        }
    }

    /**
     * This function provides the details of future room reservation of the customer.
     * This responds to a ajax call
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myFutureReservation(Request $request)
    {
        $inputs = $request::all();
        $customer_id = $inputs['customer_id'];

        $date = Carbon::now();

        $future_reservations = ROOM_RESERVATION::where('cus_id','=',$customer_id)
                            ->where('check_in','>',$date)
                            ->get();

        return response()->json(['res_id' => count($future_reservations), 'data' => $future_reservations]);
    }

    /**
     * This function provide the details of past reservation of the customer.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myPastReservation(Request $request)
    {
        $inputs = $request::all();
        $customer_id = $inputs['customer_id'];

        $date = Carbon::now();

        $past_reservations = ROOM_RESERVATION::where('cus_id','=',$customer_id)
            ->where('check_out','<',$date)
            ->get();

        return response()->json(['res_id' => count($past_reservations), 'data' => $past_reservations]);
    }

    /**
     * This function cancels the current room reservation process and redirect to
     * the room packages view.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function cancelCurrentReservation(Request $request)
    {
        //Clears the current session room reservation values
        if(Session::has('room_types')) {
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
        Session::forget('CanPay');

        return redirect('room_packages');
    }
}
