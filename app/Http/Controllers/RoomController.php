<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Room;
use App\RoomType;
use App\RoomService;
use App\RoomFurnish;


class RoomController extends Controller
{



    public function rooms(Request $request){

        return view('nilesh.rooms');

    }

    public function getrooms(Request $request){


        $rooms = DB::select(DB::raw("SELECT A.*, 
        (SELECT TYPE_NAME FROM ROOM_TYPES WHERE ROOM_TYPE_ID = A.ROOM_TYPE_ID) as 'type' 
        FROM ROOMS A"));

        return response()->json(['count' => count($rooms), 'data' => $rooms]);

    }

    public function getroom_types(Request $request){

        $types = DB::select(DB::raw("SELECT A.*, 
        (SELECT COUNT(*) FROM ROOMS WHERE ROOMS.room_type_id = A.room_type_id) as 'count' 
        FROM ROOM_TYPES A
        "));

        return response()->json(['count' => count($types), 'data' => $types]);



    }


    public function room_add(Request $request){

        $room = new Room;

        $room->room_num = $request->input('rnum');
        $room->room_size = $request->input('rsize');
        $room->sequence_num = $request->input('max');
        $room->room_type_id = $request->input('rtype'); 
        $room->status = $request->input('rstatus'); 
        $room->remarks = $request->input('rremarks');
        $room->save();

        return view('nilesh.rooms');

    }

    public function admin_roomtype_add(Request $request){

        $rt = new RoomType;


        $rt->type_name = $request->input('rtname');
        $rt->description = $request->input('rtdes');
        $rt->type_code = $request->input('rtcode');
        $rt->services_provided = $request->input('wifi').";".$request->input('tv');

        $rt->save();    


    }


    public function delete_room_type(Request $request){

        $rt = RoomType::find($request->input('id'));
        $rt->delete();




    }


    public function admin_getRoomNum(Request $request){

        $rt = RoomType::find($request->input('id'));

        $type_code = $rt->type_code;
        $max = Room::where('room_type_id',$rt)->max('sequence_num');
        $max++;
        $maxNumberCode = strtoupper($type_code) . str_pad($max,4,"0",STR_PAD_LEFT);

        return response()->json (['code'=>$maxNumberCode, 'max'=> $max]);

    }

    public function admin_delete_room(Request $request){

        $room = Room::find($request->input('id'));
        $room->delete();


    }


    public function roomservices(){


        return view('Nilesh.roomservices');

    }

    public function get_room_services(){

        $rs = RoomService::all();
        return response()->json(['count' => count($rs), 'data' => $rs]);


    }
    public function get_room_furnish(){



        $rf = RoomFurnish::all();
        return response()->json(['count' => count($rf), 'data' => $rf]);


    }


    public function room_service_add(Request $request){


        $rs = new RoomService;

        $rs->name = $request->input('rsname');
        $rs->rate = $request->input('rsrate');

        $rs->save();

    }

    public function room_furnish_add(Request $request){


        $rf = new RoomFurnish;

        $rf->name = $request->input('rfname');
        $rf->rate = $request->input('rfrate');

        $rf->save();

    }

    public function getRF_info(Request $request){

        $rf = RoomFurnish::find($request->input('id'));
        return $rf;

    }



    public function getRS_info(Request $request){

        $rs = RoomService::find($request->input('id'));
        return $rs;

    }

    public function updateRS(Request $request){

        $rs = RoomService::find($request->input('rsid'));

        $rs->name = $request->input('rsname');
        $rs->rate = $request->input('rsrate');

        $rs->save();  

    }
    public function updateRF(Request $request){

        $rf = RoomFurnish::find($request->input('rfid'));

        $rf->name = $request->input('rfname');
        $rf->rate = $request->input('rfrate');

        $rf->save();  

    }

    public function delRF(Request $request){

        $rf = RoomFurnish::find($request->input('id'));
        $rf->delete();

    }

    public function delRS(Request $request){

        $rs = RoomService::find($request->input('id'));
        $rs->delete();

    }


}
