<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Room;
use App\RoomType;
 


class RoomController extends Controller
{
  
    
    
    public function rooms(Request $request){
        
        
        return view('nilesh.rooms');
        
    }

    public function getrooms(Request $request){
        
        
        $rooms = DB::select(DB::raw("SELECT A.*, (SELECT TYPE_NAME FROM ROOM_TYPES WHERE ROOM_TYPE_ID = A.ROOM_TYPE_ID) as 'type' FROM ROOMS A"));
        
        return response()->json(['count' => count($rooms), 'data' => $rooms]);

    }
    
    public function getroom_types(Request $request){
        
        $types = DB::select(DB::raw("SELECT A.*, (SELECT COUNT(*) FROM ROOMS WHERE ROOMS.room_type_id = A.room_type_id) as 'count' FROM ROOM_TYPES A
 "));
        
        return response()->json(['count' => count($types), 'data' => $types]);

        
        
    }
    
    
    public function room_add(Request $request){
        
       $room = new Room;
        
       $room->room_num = $request->input('rnum');
       $room->room_size = $request->input('rsize');
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
            
        $rt->save();    
        
        
    }
     
    
    
    
    
    
    
}
