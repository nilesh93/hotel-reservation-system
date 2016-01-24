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
        
        
        $rooms = DB::select(DB::raw("SELECT A.*, (SELECT TYPE_NAME FROM ROOM_TYPES WHERE ROOM_TYPE_ID = A.ROOM_TYPE_ID) FROM ROOMS A"));
        
        return response()->json(['count' => count($rooms), 'data' => $rooms]);

    }
    
    public function getroom_types(Request $request){
        
        $types = DB::select(DB::raw("SELECT A.*, (SELECT COUNT(*) FROM ROOMS WHERE ROOMS.room_type_id = A.room_type_id)as 'Count' FROM ROOM_TYPES A
 "));
        
        return response()->json(['count' => count($types), 'data' => $types]);

        
        
    }
   
    
     
    
    
    
    
    
    
}
