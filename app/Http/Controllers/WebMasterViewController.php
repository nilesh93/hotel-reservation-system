<?php

namespace App\Http\Controllers;

use App\HALL_IMAGE;
use App\Hall_Services;
use App\Http\Requests;
use App\RATE;
use App\ROOM_IMAGE;
use App\RoomTypeFurnish;
use App\RoomTypeService;
use Request;
use App\Http\Controllers\Controller;
use DB;

class WebMasterViewController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Web Master View Controller
   |--------------------------------------------------------------------------
   |
   |This controller provides the function to laod the contents in the master page
   |using ajax calls.
   |
   */

    /**
     *This function is used to load the hall modal contents.This function response to
     *a ajax call.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function hallViewLoad(Request $request)
    {
        $inputs = $request::all();
        $hall_id = $inputs['hall_id'];



        $himage1 = HALL_IMAGE::where('hall_id','=',$hall_id)
            ->select('path')
            ->first();

        $himages = HALL_IMAGE::where('hall_id','=',$hall_id)
            ->where('path','!=',$himage1->path)
            ->select('path')
            ->get();

        $advance = DB::table('HALL_RATES')
            ->where('hall_id','=',$hall_id)
            ->select('advance_payment')
            ->first();


        $refundable = DB::table('HALL_RATES')
            ->where('hall_id','=',$hall_id)
            ->select('refundable_amount')
            ->first();


        $services = Hall_Services::where('rate','=',0)
            ->select('name','rate')
            ->get();

        $aservices = Hall_Services::where('rate','>',0)
            ->select('name','rate')
            ->get();

        return response()->json(['himage1'=>$himage1->path,'himages'=>$himages,'advance'=>$advance->advance_payment,'refundable'=>$refundable->refundable_amount,
                                 'services'=>$services,'aservices'=>$aservices]);
    }

    /**
     * This function is used to load the room modal contents.This function response to
     *a ajax call.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function roomViewLoad(Request $request)
    {
        $inputs = $request::all();
        $room_id = $inputs['room_id'];

        $image1 = ROOM_IMAGE::where('room_type_id','=',$room_id)
            ->first();



        if(!empty($image1)){
            $images = ROOM_IMAGE::where('room_type_id','=',$room_id)
                ->where('path','!=',$image1->path)
                ->select('path')
                ->get();
            $path = $image1->path;
        }else{


            $images = array();
            $path = null;
        }

        $room_furnishes = RoomTypeFurnish::where('room_type_id','=',$room_id)
            ->join('ROOM_FURNISHING','ROOM_TYPE_FURNISH.furnish_id','=','ROOM_FURNISHING.rf_id')
            ->select('name')
            ->get();

        $room_services =  RoomTypeService::where('room_type_id','=',$room_id)
            ->join('ROOM_SERVICES','ROOM_TYPE_SERVICE.service_id','=','ROOM_SERVICES.rs_id')
            ->select('name')
            ->get();

        $room_rates = RATE::join('MEAL_TYPES','RATES.meal_type_id','=','MEAL_TYPES.meal_type_id')
            ->where('RATES.room_type_id','=',$room_id)
            ->select('MEAL_TYPES.meal_type_name','RATES.rate_code','RATES.single_rates')
            ->get();

        $arr_dep_time = DB::table('HOTEL_INFO')
            ->select('check_in','check_out')
            ->first();



        if(!empty( $arr_dep_time)){
            
            $checkin = $arr_dep_time->check_in;
            $checkout = $arr_dep_time->check_out;
            
        }else{
             $checkin = null;
             $checkout = null;
            
        }
            


        return response()->json(['rimage1'=>$path,'rimages'=>$images,'room_furnishes'=>$room_furnishes,
                                 'room_services'=>$room_services,'room_rates'=>$room_rates,'check_in'=>$checkin,
                                 'check_out'=>$checkout]);

    }
}
