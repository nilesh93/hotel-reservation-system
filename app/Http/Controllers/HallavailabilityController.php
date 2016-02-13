<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\HALL;
use Session;


class HallavailabilityController extends Controller
{
    function check_hall_availability(Request $request){

        $inputs = $request->all();

        if(Session::has('hall_selected'))
        {
            $request->session()->forget('hall_selected');

        }



        $event_date = $inputs['event_date'];

        $request->session()->put('event_date',$event_date);


        $hall_status = array();

        $halls = HALL::get();
        $row_count = 0;

        foreach($halls as $hall)
        {
            $row_count = DB::table('HALL_RESERVATION')
                        ->where('hall_id','=',$hall->hall_id)
                        ->where('reserve_date','=',$event_date)
                        ->count();

            if($row_count == 0)
            {
                $hall_status[$hall->hall_id] = "Available";

            }
            else{

                $hall_status[$hall->hall_id] = "Not Available";
            }


        }
        //continue from here;

        return response()->json(['hall_status'=>$hall_status,'hall_ids'=>$halls,'edate'=>$event_date]);


    }


    function book_hall_add(Request $request){

        $inputs = $request->all();

        $hall_id = $inputs['hall_id'];

        $request->session()->put('hall_selected',$hall_id);



        $hall_detail =  DB::table('HALLS')
                        ->join('HALL_RATES','HALL_RATES.hall_id','=','HALLS.hall_id')
                        ->where('HALLS.hall_id','=',$hall_id)
                        ->select('HALLS.hall_id','HALLS.title','HALL_RATES.advance_payment','HALL_RATES.refundable_amount')
                        ->get();


        $advance = DB::table('HALL_RATES')
                    ->where('hall_id','=',$hall_id)
                    ->value('advance_payment');
        $request->session()->put('total_payable',$advance);


        return response()->json(['hall_detail'=>$hall_detail]);


    }

    function cancel_hall_reserv(){

        Session::forget('hall_selected');
        Session::forget('total_payable');
        return redirect('halls');
    }
}
