<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\RoomType;
use App\Customer;

class DashboardController extends Controller
{

    public function dashboard(){

        $customers = Customer::all();
        $types = RoomType::all();
        return view('nilesh.dashboard')
            ->with('roomTypes',$types)
            ->with('customers',$customers);
    }


    public function getEvents(){

        $room_reservations =  DB::select(DB::raw("select a.*, (select b.type_name from ROOM_TYPES b where b.room_type_id = a.type) as room_type, c.* from ROOM_RESERVATION a 
LEFT JOIN CUSTOMER c ON c.cus_id = a.cus_id
where check_in > DATE_SUB(NOW(),INTERVAL 2 YEAR)"));


        return  $room_reservations;




    }


    public function getReservationDates(Request $request){

        $checkin = $request->input("checkin");
        $checkout = $request->input("checkout");
        $rt = $request->input("rt");

        $rooms = DB::select(DB::raw("Select * from HRS.ROOMS C
            where C.room_id not in (SELECT IFNULL(B.room_id,0)
            FROM HRS.ROOM_RESERVATION A
            LEFT JOIN HRS.ROOM_RESERVATION_BLOCK B ON B.room_reservation_id = A.Room_reservation_id
            Where  '$checkin' between A.check_in AND A.check_out
            OR  '$checkout' between A.check_in AND A.check_out
            )
            AND C.room_type_id = '$rt'"));
      
        return response()->json(['count'=>count($rooms), 'data'=>$rooms]);
    }

}
