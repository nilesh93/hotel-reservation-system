<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\RoomType;
use App\Customer;
use App\ROOM_RESERVATION;

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


    public function getbookings(Request $request){

        $bookings =  DB::select(DB::raw("SELECT A.*, (Select meal_type_name from HRS.MEAL_TYPES B where B.meal_type_id = A.meal_type_id)  as meal_name
FROM HRS.RATES A
where A.room_type_id = ''"));

        return  $bookings;

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



    public function admin_reserve_room(Request $request){


        if($request->input('cus')== 0){

            $cus = new Customer;

            $cus->name = $request->input('cus_name');
            $cus->NIC_passport_num = $request->input('cus_nic');
            $cus->email = $request->input('cus_email');
            $cus->telephone_num = $request->input('cus_phone');
            $cus->save();

            $cid = $cus->cus_id;



        }else{

            $cid = $request->input('cus');

        }


        $rs = new ROOM_RESERVATION;

        $rs->remarks = $request->input('remarks');
        $rs->check_in = $request->input('checkin');
        $rs->check_out = $request->input('checkout');
        $rs->adults = $request->input('adults');
        $rs->children = $request->input('kids');
        $rs->num_of_rooms = count($request->input('data'));
        $rs->num_of_nights = date_diff(date_create($request->input('checkin')),date_create($request->input('checkout')))->format("%R%a");
        // $rs->num_of_nights = 





    }



    public function dash(){



        $roomWeek = DB::select(DB::raw("select * from HRS.ROOM_RESERVATION A
LEFT JOIN HRS.CUSTOMER B ON A.cus_id =  B.cus_id
WHERE A.status = 'ACCEPTED'
AND A.check_in < DATE_ADD(NOW(),INTERVAL 7 DAY)
AND A.check_in > DATE_SUB(NOW(),INTERVAL 1 DAY)
Order by A.check_in ASC"));

        $hallWeek = DB::select(DB::raw("Select A.*, B.*, (select C.title from HRS.HALLS C where C.hall_id = A.hall_id) as title from HRS.HALL_RESERVATION A
LEFT JOIN HRS.CUSTOMER B ON A.cus_id =  B.cus_id
WHERE A.status = 'ACCEPTED'
AND A.reserve_date < DATE_ADD(NOW(),INTERVAL 7 DAY)
AND A.reserve_date > DATE_SUB(NOW(),INTERVAL 1 DAY)
Order by A.reserve_date ASC;"));

        $checkout = DB::select(DB::raw("select * from HRS.ROOM_RESERVATION A
LEFT JOIN HRS.CUSTOMER B ON A.cus_id =  B.cus_id
WHERE A.status IN ('ACCEPTED','CHECKEDIN')
AND DATE_FORMAT(A.check_out,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')
Order by A.check_out ASC;"));


        $reservationCount =  DB::select(DB::raw("Select count(*) as pending,
(select count(*) from HRS.ROOM_RESERVATION A where A.status NOT IN('PENDING','REJECTED','CANCELLED') AND A.check_in > NOW()) as accepted,
(select count(*) from HRS.HALL_RESERVATION A where A.status NOT IN('PENDING','REJECTED','CANCELLED') AND A.reserve_date > NOW()) as accepted_hall,
(select count(*) from HRS.HALL_RESERVATION A where A.status  = 'PENDING'   AND A.reserve_date > NOW()) as pending_hall
 from HRS.ROOM_RESERVATION A where A.status = 'PENDING' AND A.check_in > NOW()"));


        $roomInfo = DB::select(DB::raw("Select count(room_id) as count,
(select B.type_name from HRS.ROOM_TYPES B where B.room_type_id = A.room_type_id) as type_name
 from HRS.ROOMS A Where A.status = 'AVAILABLE'
Group by A.room_type_id"));


        $roomTypes = RoomType::all();

        return view('nilesh.dash')
            ->with('reservationCount', $reservationCount)
            ->with('roomWeek', $roomWeek)
            ->with('checkout', $checkout)
            ->with('roomInfo', $roomInfo)
            ->with('roomTypes', $roomTypes)
            ->with('hallWeek', $hallWeek);

    }


    public function search_availability(Request $request){

        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        
      $availability =  DB::select(DB::raw("Select B.type_name,
(select count(*) from HRS.ROOMS F where F.status = 'AVAILABLE' AND F.room_type_id = B.room_type_id) as all_rooms,
IFNULL((select SUM(A.count) as booked 
from HRS.RES_RMTYPE_CNT_RATE A
where A.room_reservation_id IN (
 Select  J.room_reservation_id from HRS.ROOM_RESERVATION J 
  Where  '$checkin' between J.check_in AND J.check_out
OR  '$checkout' between J.check_in AND J.check_out) 
AND B.room_type_id = A.room_type_id
group by A.room_type_id),0) as booked
from HRS.ROOM_TYPES B"));


        return $availability;
    }

}
