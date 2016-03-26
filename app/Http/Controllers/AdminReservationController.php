<?php

namespace App\Http\Controllers;

use App\Customer;
use App\HALL_RESERVATION;
use App\RES_RMTYPE_CNT_RATE;
use App\ROOM_RESERVATION;
use App\ROOM_TYPE;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminReservationController extends Controller
{
    public function pendingReservation(){

        return view('Website.adminPendingReservations');
    }

    public function pendingRoomReservation(){

        $pending_reservation = ROOM_RESERVATION::all();

        return response()->json(['count'=>count($pending_reservation),'data'=>$pending_reservation]);

    }

    public function pendingHallReservation(){

        $pending_hall_reservation = HALL_RESERVATION::all();

        return response()->json(['count'=>count($pending_hall_reservation),'data'=>$pending_hall_reservation]);

    }

    public function getIndividualReservationDetails(Request $request){

        $input = $request->all();

        $reservation_id = $input['reservation_id'];

        $reservation_details = ROOM_RESERVATION::where('room_reservation_id','=',$reservation_id)
                                                ->first();

        $customer_details = Customer::where('cus_id','=',$reservation_details->cus_id)
                                        ->first();

        $room_types = RES_RMTYPE_CNT_RATE::where('room_reservation_id','=',$reservation_id)
                                            ->rightJoin('ROOM_TYPES','RES_RMTYPE_CNT_RATE.room_type_id','=','ROOM_TYPES.room_type_id')
                                            ->select('RES_RMTYPE_CNT_RATE.room_type_id','RES_RMTYPE_CNT_RATE.count','ROOM_TYPES.type_name')
                                            ->get();

        return response()->json(['reservation_details'=>$reservation_details,'customer_details'=>$customer_details,'room_types'=>$room_types]);


    }


    public function checkRoomAvailability(Request $request){

        $input = $request->all();

        $reservation_id = $input['reservation_id'];

        $reservation_details = ROOM_RESERVATION::where('room_reservation_id','=',$reservation_id)
                                            ->first();
        $check_in = $reservation_details->check_in;
        $check_out = $reservation_details->check_out;

        $room_types = ROOM_TYPE::all();



        $room_results = app('App\Http\Controllers\RoomAvailabilityController')->getAvailableRoomTypeCount($check_in,$check_out);
        $room_type_available = $room_results[0];


        return response()->json(["room_type_available"=>$room_type_available,"room_types"=>$room_types]);



    }
}
