<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
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
use App\Classes\ReservationRoom;
use App\Classes\ReservationTask;
use Vinkla\Pusher\Facades\Pusher;
use App\Notifications;

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
            $no_of_guests = session('adults') + session('kids');

            //formt the number of nights
            $no_of_nights = $interval->format('%d%') + config('constants.ADD_ONE_NIGHT');

            //call the saveReservationDetails function to save the reservation details to the database
            $res_id = $this->saveReservationDetails(session('check_in'),session('check_out'),$no_of_nights,$customer_id);

            //insert the the details to the RES_RMTYPE_CNT_RATE table
            foreach (session('room_types') as $room_type) {

                DB::table('RES_RMTYPE_CNT_RATE')->insert(['room_reservation_id' => $res_id,'room_type_id' => $room_type,'rate_code' => session('rate_code' . $room_type),
                                                            'count' => session('no_of_rooms' . $room_type)]);
            }

            //create an array with reservation details in ordr to send to the mail view
            $data = array('res_id' => $res_id, 'check_in' => session('check_in'), 'check_out' => session('check_out'), 'nights' => $no_of_nights,
                'no_of_rooms' => session('rooms'), 'guests' => $no_of_guests, 'name' => $customer_name);


            //observer design pattern is used here, but this is design pattern is no use full
                /*$sub =  new ReservationRoom();
                $sub->attach(new ReservationTask());
                $sub->clearSession();*/


            //clear session
            $this->clearRoomSession("Full");

            //call the mailfunction send an email
            $this->sendInitialMail($data,$customer_email);

            //send an pusher notification to the admin

            //remove the magic values

            $newNotification = new Notifications();

            $newNotification->notification = "New Reservation";
            $newNotification->body = "Room Reservation has been made";
            $newNotification->readStatus = '0';
            $newNotification->save();

             Pusher::trigger('notifications', 'Reservation', ['message' => 'New Room Reservation has been made']);

            return redirect('myreserv')->with(['reserv_status' => 'Room_Reservation']);

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
        $this->clearRoomSession("Full");

        //clears the canPay session attribute which is used as an indicator to enter to the payment page
        Session::forget('CanPay');


        return redirect('room_packages');
    }

    /**
     *This function is used to clear the room reservation session.
     *
     * There are no output parameters in this function
     */
    public function clearRoomSession($type)
    {
            if(session('room_types')) {
                //since the details are stored in the db clear the session values
                foreach (session('room_types') as $room_type) {
                    Session::forget(['room_type_name' . $room_type,'no_of_rooms' . $room_type,'rate' . $room_type,'meal_type' . $room_type]);
                    Session::forget(['rate_code' . $room_type,'total_payable']);
                    Session::forget('fblogin_payment');

                    //clear promotion values
                    Session::forget('promo_code');
                    Session::forget('promo_rate');
                }
                if($type =="Full") {
                    //clear the requested details
                    Session::forget(['room_types', 'check_in', 'check_out', 'adults', 'kids', 'rooms', 'total_payable', 'CanPay']);
                    Session::forget('fblogin_payment');
                         //clear promotion values
                    Session::forget('promo_code');
                    Session::forget('promo_rate');
                }
            }


    }

    public function sendInitialMail($data,$customer_email)
    {

        $job = (new SendEmail($data,$customer_email,"initial_reservation_mail"));
        $this->dispatch($job);

        //send mail to the customer confirming the reservation details
        /*Mail::send('emails.InitialRoomReservationMail', $data, function ($message) use ($customer_email) {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $message->to($customer_email)->subject('Welcome to Amalya Reach!');
        });*/
    }

    public function saveReservationDetails($check_in,$check_out,$no_of_nights,$customer_id)
    {

        //predefined check in and check out times
        $arr_dep_time = DB::table('HOTEL_INFO')
                        ->select('check_in','check_out')
                        ->first();

        $check_in_time = $arr_dep_time->check_in;
        $check_out_time =$arr_dep_time->check_out;

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
        $reservation->num_of_nights =$no_of_nights ;
        $reservation->total_amount = session('total_payable');
        $reservation->cus_id = $customer_id;
        $reservation->status = config('constants.RES_PENDING');

        if(Session::has('promo_code'))
        {

            $reservation->promo_code = session('promo_code');
        }

        $reservation->save();

        //get the last added reservation id
        $res_id = $reservation->room_reservation_id;

        return $res_id;

    }
}
