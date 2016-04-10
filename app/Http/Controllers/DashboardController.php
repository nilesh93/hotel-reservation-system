<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
     
    public function dashboard(){
        
        
        return view('nilesh.dashboard');
    }
    
    
    public function getEvents(){
        
       $room_reservations =  DB::select(DB::raw("select a.*, (select b.type_name from ROOM_TYPES b where b.room_type_id = a.type) as room_type, c.* from ROOM_RESERVATION a 
LEFT JOIN CUSTOMER c ON c.cus_id = a.cus_id
where check_in > DATE_SUB(NOW(),INTERVAL 2 YEAR)"));
        
        
        return  $room_reservations;
        
        
        
        
    }
    
    
}
