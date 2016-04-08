<?php

namespace App\Http\Controllers;

use App\Customer;
use App\HALL;
use App\HALL_RESERVATION;
use App\HotelInfo;
use App\RES_RMTYPE_CNT_RATE;
use App\ROOM_RESERVATION;
use App\ROOM_TYPE;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmail;

class AdminReservationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Reservation Controller
    |--------------------------------------------------------------------------
    |
    |This controller provides functions to admin regarding reservation.
    |
    */

    /**
     * This function is used to view the pending reservation in order to
     *accept or reject the reservation
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pendingReservation(){

        return view('Website.adminPendingReservations');
    }

    /**
     * This function is used to get the pendingroom reservation details and it
     * returns a json object which is used to display the pending room reservation list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingRoomReservation(){

        $pending_reservation = ROOM_RESERVATION::where('status','=','pending')
                                ->get();

        return response()->json(['count'=>count($pending_reservation),'data'=>$pending_reservation]);

    }

    /**
     *This function is used to get the pendingroom reservation details and it
     * returns a json object which is used to display the pending room reservation list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingHallReservation(){

        $pending_hall_reservation = HALL_RESERVATION::where('status','=','pending')
                                     ->get();
        return response()->json(['count'=>count($pending_hall_reservation),'data'=>$pending_hall_reservation]);

    }

    /**
     * This function is to get the individual room reservation details
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndividualReservationDetails(Request $request){

        $input = $request->all();
        $reservation_id = $input['reservation_id'];

        //calls to a self class function which returns the reservation details,customer details and room details
        $reservation_customer_room = $this->getReservationDetails($reservation_id);

        $reservation_details = $reservation_customer_room['reservation_details'];
        $customer_details = $reservation_customer_room['customer_details'];
        $room_types = $reservation_customer_room['room_types'];

        return response()->json(['reservation_details'=>$reservation_details,'customer_details'=>$customer_details,'room_types'=>$room_types]);
    }

    /**
     * This function check the room availability for admin part
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkRoomAvailability(Request $request){

        $input = $request->all();
        $reservation_id = $input['reservation_id'];

        $reservation_details = ROOM_RESERVATION::where('room_reservation_id','=',$reservation_id)
                                            ->first();
        $check_in = $reservation_details->check_in;
        $check_out = $reservation_details->check_out;
        $room_types = ROOM_TYPE::all();

        //calls to a function which is in the RoomAvailabilityController which return the room availability details.
        $room_results = app('App\Http\Controllers\RoomAvailabilityController')->getAvailableRoomTypeCount($check_in,$check_out,"CHK",$reservation_id);

        $room_type_available = $room_results['room_type_available'];


        return response()->json(["room_type_available"=>$room_type_available,"room_types"=>$room_types]);
    }

    /**
     * This function is used to update the reservation details when the reservation has been accepted.
     *
     * @param Request $request
     * @return string
     */
    public function updateAcceptReservation(Request $request){

        $input = $request->all();

        $reservation_id = $input['reservation_id'];

        $customer_id = ROOM_RESERVATION::where('room_reservation_id','=',$reservation_id)
                                        ->value('cus_id');

        $customer_mail = Customer::where('cus_id','=',$customer_id)
                                    ->value('email');

        ROOM_RESERVATION::where('room_reservation_id','=',$reservation_id)
                            ->update(['status'=>'confirmed']);

        //calls to a self class function to get room reservation details.
        $mail_reservation_details = $this->getReservationDetails($reservation_id);

        //calls to a self class function to send confirmation mail to the customer upon accepting the reservation.
        $this->sendConfirmReservationMail($mail_reservation_details);

        return "ok";


    }

    /**
     * This function used to get the reservation,customer and room type details
     * when a valid reservation id is provided.
     *
     * @param $reservation_id
     * @return array
     */
    public function getReservationDetails($reservation_id)
    {
        $reservation_details = ROOM_RESERVATION::where('room_reservation_id','=',$reservation_id)
                            ->first();

        $customer_details = Customer::where('cus_id','=',$reservation_details->cus_id)
                            ->first();

        $room_types = RES_RMTYPE_CNT_RATE::where('room_reservation_id','=',$reservation_id)
                    ->rightJoin('ROOM_TYPES','RES_RMTYPE_CNT_RATE.room_type_id','=','ROOM_TYPES.room_type_id')
                    ->select('RES_RMTYPE_CNT_RATE.room_type_id','RES_RMTYPE_CNT_RATE.count','ROOM_TYPES.type_name')
                     ->get();

        return ["reservation_details"=>$reservation_details,"customer_details"=>$customer_details,"room_types"=>$room_types];
    }

    /**
     * This function is to send confirmation mail to the customer upon accepting
     * the room reservation.
     *
     * @param $mail_reservation_details
     */
    public function sendConfirmReservationMail($mail_reservation_details)
    {
        $customer_email = $mail_reservation_details['customer_details']['email'];

        $job = (new SendEmail($mail_reservation_details,$customer_email,"confirm_room_reservation_mail"));
        $this->dispatch($job);
        /*//send mail to the customer confirming the reservation details
        Mail::send('emails.RoomReservationMail', ["mail_detail"=>$mail_reservation_details], function ($message) use ($customer_email) {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $message->to($customer_email)->subject('Amalya Reach Reservation Acceptance!');
        });*/
    }

    /**
     * This function is to view the reservation general info view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reservationGeneralInfo()
    {
        $general_info = DB::table('HOTEL_INFO')
                        ->first();
        return view('Website.adminReservationGeneralInfo',['general_info'=>$general_info]);
    }

    /**
     * This function is to update the reservation upon rejecting the reservation.
     *
     * @param Request $request
     * @return string
     */
    public function updateRejectReservation(Request $request)
    {
        $inputs = $request->all();

        $reservation_id = $inputs['room_reservation_id'];
        $reject_reason = $inputs['reason'];

        ROOM_RESERVATION::where('room_reservation_id','=',$reservation_id)
            ->update(['status'=>'rejected']);

        //calls to a self class function to the reservation details when providing the reservation id.
        $mail_reservation_details = $this->getReservationDetails($reservation_id);

        //send reservation rejection mail to the customer upon rejecting the reservation.
        $this->sendRejectReservationMail($mail_reservation_details,$reject_reason);

        return "Success";
    }

    /**
     * This function is to send the room reservation rejection mail to the customer
     *
     * @param $mail_reservation_details
     * @param $reject_reason
     */
    public function sendRejectReservationMail($mail_reservation_details,$reject_reason)
    {
        $customer_email = $mail_reservation_details['customer_details']['email'];

        $mail_reservation_details = ["reservation_details"=>$mail_reservation_details["reservation_details"],"customer_details"=>$mail_reservation_details["customer_details"],
                                        "room_types"=>$mail_reservation_details["room_types"],"reject_reason"=>["value"=>$reject_reason]];

        $job = (new SendEmail($mail_reservation_details,$customer_email,"reject_room_reservation_mail"));
        $this->dispatch($job);

        //send mail to the customer confirming the reservation details
       /* Mail::send('emails.RoomReservationRejectMail', ["mail_detail"=>$mail_reservation_details,"reject_reason"=>$reject_reason],
            function ($message) use ($customer_email) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($customer_email)->subject('Amalya Reach Reservation Rejection');
            });*/
    }

    /**
     * This function is to get the hall reservation details.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndividualHallReservationDetails(Request $request)
    {
            $inputs = $request->all();

            $hall_reservation_id = $inputs['hall_reservation_id'];

            $hall_reservation_customer = $this->getHallReservationDetails($hall_reservation_id);

            $hall_reservation_details = $hall_reservation_customer['hall_reservation_details'];

            $customer_details = $hall_reservation_customer['customer_details'];

            return response()->json(['hall_reservation_details'=>$hall_reservation_details,'customer_details'=>$customer_details]);
    }

    /**
     * This function used to get the hall reservation details when providing the reservation id.
     *
     * @param $hall_reservation_id
     * @return array
     */
    public function getHallReservationDetails($hall_reservation_id)
    {
        $hall_reservation_details = HALL_RESERVATION::where('hall_reservation_id','=',$hall_reservation_id)
                                    ->rightJoin('HALLS','HALL_RESERVATION.hall_id','=','HALLS.hall_id')
                                    ->select('HALL_RESERVATION.hall_reservation_id','HALL_RESERVATION.reserve_date','HALL_RESERVATION.cus_id',
                                            'HALL_RESERVATION.hall_id','HALLS.title','HALL_RESERVATION.created_at','HALL_RESERVATION.time_slot')
                                    ->first();

        $customer_details = Customer::where('cus_id','=',$hall_reservation_details->cus_id)
                            ->first();

        return ["hall_reservation_details"=>$hall_reservation_details,"customer_details"=>$customer_details];
    }

    /**
     * This function checks the hall availability for the admin part.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkHallAvailability(Request $request)
    {
        $inputs = $request->all();

        $hall_reservation_id = $inputs['hall_reservation_id'];

        $hall_reservation_details = HALL_RESERVATION::where('hall_reservation_id','=',$hall_reservation_id)
                                    ->first();

        //define an array to store the availability of the halls
        $hall_status = array();

        $halls = HALL::get();
        $total_halls = 0;

        //for each halls check whether they are already reserved in a reservation
        foreach($halls as $hall) {
            $row_count = HALL_RESERVATION::where('hall_id','=',$hall->hall_id)
                ->where('hall_reservation_id','!=',$hall_reservation_id)
                ->where('reserve_date','=',$hall_reservation_details->reserve_date)
                ->where('time_slot','=',$hall_reservation_details->time_slot)
                ->count();

            //if the row count is zero means that is not reserved
            if($row_count == 0) {
                $total_halls += 1;
                $hall_status[$hall->hall_id] = "Available";
            }
            else{

                $hall_status[$hall->hall_id] = "Not Available";
            }
        }

        return response()->json(['hall_status'=>$hall_status,'halls'=>$halls]);
    }

    /**
     * This function is used to update the hall reservation upon accepting the reservation.
     *
     * @param Request $request
     * @return string
     */
    public function updateHallAcceptReservation(Request $request)
    {
        $input = $request->all();

        $reservation_id = $input['hall_reservation_id'];

        HALL_RESERVATION::where('hall_reservation_id','=',$reservation_id)
                     ->update(['status'=>'confirmed']);

        //calls to a self class function to get the hall reservation details.
        $mail_reservation_details = $this->getHallReservationDetails($reservation_id);

        $this->sendConfirmHallReservationMail($mail_reservation_details);

        return "ok";
    }

    /**
     * This function is used to send confirmation mail to customer upon accepting the hall reservation.
     *
     * @param $data
     */
    public function sendConfirmHallReservationMail($data)
    {
        $customer_email = $data['customer_details']['email'];

        $job = (new SendEmail($data,$customer_email,"confirm_hall_reservation_mail"));
        $this->dispatch($job);
        //send a mail to the customer confirming his reservation details
       /* Mail::send('emails.HallReservationMail',['mail_details'=> $data], function ($message) use ($customer_email) {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $message->to($customer_email)->subject('Welcome to Amalya Reach!');
        });*/
    }

    /**
     * This function is used to update the reservation upon rejecting the reservation.
     *
     * @param Request $request
     * @return string
     */
    public function updateRejectHallReservation(Request $request)
    {
        $inputs = $request->all();

        $reservation_id = $inputs['hall_reservation_id'];

        $reject_reason = $inputs['reason'];

        HALL_RESERVATION::where('hall_reservation_id','=',$reservation_id)
            ->update(['status'=>'rejected']);

        //calls to a self class function to get the hall reservation details.
        $mail_reservation_details = $this->getHallReservationDetails($reservation_id);

        //calls to a self class function to send an email to customer upon rejection.
        $this->sendRejectHallReservationMail($mail_reservation_details,$reject_reason);

        return "ok";
    }

    /**
     * This function is used to send hall rejection mail to customer.
     *
     * @param $mail_reservation_details
     * @param $reject_reason
     */
    public function sendRejectHallReservationMail($mail_reservation_details,$reject_reason)
    {
        $customer_email = $mail_reservation_details['customer_details']['email'];

        $mail_reservation_details = ["hall_reservation_details"=>$mail_reservation_details["hall_reservation_details"],"customer_details"=>$mail_reservation_details["customer_details"],
            "reject_reason"=>["value"=>$reject_reason]];


        $job = (new SendEmail($mail_reservation_details,$customer_email,"reject_hall_reservation_mail"));
        $this->dispatch($job);
        //send mail to the customer confirming the reservation details
        /*Mail::send('emails.HallReservationRejectMail', ["mail_detail"=>$mail_reservation_details,"reject_reason"=>$reject_reason],
            function ($message) use ($customer_email) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($customer_email)->subject('Amalya Reach Reservation Rejection');
            });*/
    }

    public function updateReservationInfo(Request $request)
    {

        $inputs = $request->all();
        $field = $inputs['field'];
        $value = $inputs['value'];

        if($field == 'chk_in') {
            HotelInfo::where('id','=',1)
                ->update(['check_in'=>$value]);

            return response()->json(["result"=>"success"]);

        } elseif($field == 'chk_out') {
            HotelInfo::where('id','=',1)
                ->update(['check_out'=>$value]);

            return response()->json(["result"=>"success"]);
        } elseif($field == 'adults') {
            HotelInfo::where('id','=',1)
                ->update(['no_of_adults'=>$value]);

            return response()->json(["result"=>"success"]);

        } elseif($field == 'kids') {
            HotelInfo::where('id','=',1)
                ->update(['no_of_kids'=>$value]);

            return response()->json(["result"=>"success"]);

        } elseif($field == 'rooms') {
            HotelInfo::where('id','=',1)
                ->update(['selectable_no_of_rooms'=>$value]);

            return response()->json(["result"=>"success"]);

        } elseif($field == 'hall_time1') {

            $value_b = $inputs['value_b'];
            HotelInfo::where('id','=',1)
                ->update(['hall_time_slot_1_from'=>$value,'hall_time_slot_1_to'=>$value_b]);

            return response()->json(["result"=>"success"]);
        } elseif($field == 'hall_time2') {

            $value_b = $inputs['value_b'];
            HotelInfo::where('id','=',1)
                ->update(['hall_time_slot_2_from'=>$value,'hall_time_slot_2_to'=>$value_b]);

            return response()->json(["result"=>"success"]);
        }

    }

}
