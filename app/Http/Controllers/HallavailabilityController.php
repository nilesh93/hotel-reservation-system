<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\HALL;
use Session;

class HallAvailabilityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Hall Availability Controller
    |--------------------------------------------------------------------------
    |
    |This controller provides functions to check halls availability, according
    |to that add halls for to reserve.
    |
    */

    /**
     * This function check the hall availability according to the requested date.
     * This response to  a ajax call from the view.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function checkHallAvailability(Request $request)
    {
        //delete the session if already a hall is added for a reservation
        if(Session::has('hall_selected'))
        {
            $request->session()->forget('hall_selected');

        }

        $inputs = $request->all();
        $event_date = $inputs['event_date'];

        $request->session()->put('event_date',$event_date);

        //define an array to store the availability of the halls
        $hall_status = array();

        $halls = HALL::get();
        //$row_count = 0;

        //for each halls check whether they are already reserved in a reservation
        foreach($halls as $hall) {
            $row_count = DB::table('HALL_RESERVATION')
                        ->where('hall_id','=',$hall->hall_id)
                        ->where('reserve_date','=',$event_date)
                        ->count();

            //if the row count is zero means that is not reserved
            if($row_count == 0) {
                $hall_status[$hall->hall_id] = "Available";
            }
            else{

                $hall_status[$hall->hall_id] = "Not Available";
            }
        }

        return response()->json(['hall_status'=>$hall_status,'hall_ids'=>$halls,'edate'=>$event_date]);
    }

    /**
     * This function add the user selected halls to reserve.
     * Also this function response with the details of the selected hall.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function addHallsToReserve(Request $request)
    {
        //this is used as a indicator to access the payment page
        $request->session()->put('CanPay','Can');

        $inputs = $request->all();
        $hall_id = $inputs['hall_id'];
        $request->session()->put('hall_selected',$hall_id);

        //retrieve the hall details from the table
        $hall_detail =  DB::table('HALLS')
                        ->join('HALL_RATES','HALL_RATES.hall_id','=','HALLS.hall_id')
                        ->where('HALLS.hall_id','=',$hall_id)
                        ->select('HALLS.hall_id','HALLS.title','HALL_RATES.advance_payment','HALL_RATES.refundable_amount')
                        ->get();

        //retrieve the advance payment of the halls in order to add to the session
        $advance = DB::table('HALL_RATES')
                    ->where('hall_id','=',$hall_id)
                    ->value('advance_payment');
        $request->session()->put('total_payable',$advance);

        return response()->json(['hall_detail'=>$hall_detail]);
    }
}
