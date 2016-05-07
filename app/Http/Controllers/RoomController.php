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
use App\RoomTypeFurnish;
use App\RoomTypeService;
use App\ROOM_IMAGE;
use App\RATE;
use App\MEAL_TYPE;
use Input;
use Image;
use File;

class RoomController extends Controller
{


    /*
       |--------------------------------------------------------------------------
       | Room Controller
       |--------------------------------------------------------------------------
       |
       |This controller provides functions to manage rooms and room types.
       |
       |
       */


    /**
     * Constructor for the UserController class. Checks if a user has sufficient permission
     * to access the Admin area.
     *
     */
    public function __construct(){
        // Check if User is Authenticated
        $this->middleware('auth', ['except' => ['blockNotice']]);

        // Check if the authenticated user is an admin
        $this->middleware('isAdmin', ['except' => ['blockNotice']]);
    }


    /**
     * main rooms / room types management page for admin
     *
     *
     * @param Request $request
     * @return mixed
     */

    public function rooms(Request $request){

        $meals = MEAL_TYPE::all();
        $rs = RoomService::all();
        $rf = RoomFurnish::all();
        return view('nilesh.rooms')
            ->with('rs',$rs)
            ->with('rf',$rf)
            ->with('meals',$meals);

    }

    /**
     * get room list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getrooms(Request $request){


        $rooms = DB::select(DB::raw("SELECT A.*, 
        (SELECT TYPE_NAME FROM ROOM_TYPES WHERE ROOM_TYPE_ID = A.ROOM_TYPE_ID) as 'type' 
        FROM ROOMS A"));

        return response()->json(['count' => count($rooms), 'data' => $rooms]);

    }

    /**
     * get room type list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getroom_types(Request $request){

        $types = DB::select(DB::raw("SELECT A.*,
        (SELECT COUNT(*) FROM ROOMS WHERE ROOMS.room_type_id = A.room_type_id) as 'count' ,
        IFNULL(TRUNCATE((SELECT C.single_rates FROM `RATES` C WHERE C.room_type_id = A.room_type_id LIMIT 1 ),2),'NOT SET') as rate
        FROM ROOM_TYPES A
        "));

        return response()->json(['count' => count($types), 'data' => $types]);



    }

    /**
     * add room to the system
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function room_add(Request $request){

        $room = new Room;

        $room->room_num = $request->input('rnum');
        $room->room_size = $request->input('rsize');
        $room->sequence_num = $request->input('max');
        $room->room_type_id = $request->input('rtype'); 
        $room->status = $request->input('rstatus'); 
        $room->remarks = $request->input('rremarks');
        $room->save();



    }

    /**
     * add room type to the system
     *
     *
     * @param Request $request
     *
     *
     */
    public function admin_roomtype_add(Request $request){

        $rt = new RoomType;


        $rt->type_name = $request->input('rtname');
        $rt->description = $request->input('rtdes');
        $rt->type_code = $request->input('rtcode');
        //$rt->services_provided = $request->input('wifi').";".$request->input('tv');

        $rt->save(); 


        $data =  json_decode($request->input('data1'));


        foreach($data as $d){
            $rate = new RATE;

            $rate->meal_type_id = $d->meal;
            $rate->room_type_id = $rt->room_type_id;
            $rate->single_rates = $d->rate;
            $rate->save();

        }

        for($i = 0; $i<$request->input('rscount'); $i++){


            if( $request->input("service".$i) > 0){
                $rts = new RoomTypeService;

                $rts->room_type_id = $rt->room_type_id;
                $rts->service_id = $request->input("service".$i);

                $rts->save();

            }

        }


        for($x = 0; $x< $request->input('rfcount'); $x++){

            if( $request->input("furnish".$x) > 0){
                $rtf = new RoomTypeFurnish;

                $rtf->room_type_id = $rt->room_type_id;
                $rtf->furnish_id = $request->input("furnish".$x);

                $rtf->save();

            }

        }



    }

    /**
     * update room type
     *
     * @param Request $request
     *
     */
    public function admin_roomtype_update(Request $request){

        $rt = RoomType::find($request->input('main_id'));


        $rt->type_name = $request->input('rtname');
        $rt->description = $request->input('rtdes');
        $rt->type_code = $request->input('rtcode');
        //$rt->services_provided = $request->input('wifi').";".$request->input('tv');

        $rt->save(); 


        $rate =  RATE::where('room_type_id',$request->input('main_id'))->delete();


        $data =  json_decode($request->input('data1'));


        foreach($data as $d){
            $rate = new RATE;

            $rate->meal_type_id = $d->meal;
            $rate->room_type_id = $rt->room_type_id;
            $rate->single_rates = $d->rate;
            $rate->save();

        }

        RoomTypeService::where('room_type_id',$request->input('main_id'))->delete();

        RoomTypeFurnish::where('room_type_id',$request->input('main_id'))->delete();

        for($i = 100; $i<$request->input('rscount'); $i++){


            if( $request->input("service".$i) > 0){
                $rts = new RoomTypeService;

                $rts->room_type_id = $rt->room_type_id;
                $rts->service_id = $request->input("service".$i);

                $rts->save();

            }

        }


        for($x = 100; $x< $request->input('rfcount'); $x++){

            if( $request->input("furnish".$x) > 0){
                $rtf = new RoomTypeFurnish;

                $rtf->room_type_id = $rt->room_type_id;
                $rtf->furnish_id = $request->input("furnish".$x);

                $rtf->save();

            }

        }



    }

    /**
     * delete room type image and return new updates
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function admin_rt_image_del(Request $request){


        $imgGal = ROOM_IMAGE::find(Input::get("id"));

        $path = $imgGal->path;

        File::delete($path);

        $imgGal->delete(); 


        $images = ROOM_IMAGE::where('room_type_id',Input::get("type_id"))->get();

        return response()->json (['images'=>$images]);

    }

    /**
     * delete room type from the system
     *
     * @param Request $request
     *
     */

    public function delete_room_type(Request $request){

        $rt = RoomType::find($request->input('id'));
        $rt->delete();




    }

    /**
     * autogenerate room number upon entering a room
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function admin_getRoomNum(Request $request){

        $rt = RoomType::find($request->input('id'));

        $type_code = $rt->type_code;
        $max = Room::where('room_type_id',$rt->room_type_id)->max('sequence_num');

        $max++;
        $maxNumberCode = strtoupper($type_code) . str_pad($max,4,"0",STR_PAD_LEFT);

        return response()->json (['code'=>$maxNumberCode, 'max'=> $max]);

    }

    /**
     * delete a room
     *
     * @param Request $request
     *
     */
    public function admin_delete_room(Request $request){

        $room = Room::find($request->input('id'));
        $room->delete();


    }

    /**
     * returns the room service managemnt view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */

    public function roomservices(){


        return view('nilesh.roomservices');

    }

    /**
     * return room services
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function get_room_services(){

        $rs = RoomService::all();
        return response()->json(['count' => count($rs), 'data' => $rs]);


    }

    /**
     * return room furnishing otpions
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */

    public function get_room_furnish(){



        $rf = RoomFurnish::all();
        return response()->json(['count' => count($rf), 'data' => $rf]);


    }

    /**
     * add room service
     *
     * @param Request $request
     *
     */
    public function room_service_add(Request $request){


        $rs = new RoomService;

        $rs->name = $request->input('rsname');
        $rs->rate = $request->input('rsrate');

        $rs->save();

    }

    /**
     * add room furnish option to the system
     *
     * @param Request $request
     *
     *
     */

    public function room_furnish_add(Request $request){


        $rf = new RoomFurnish;

        $rf->name = $request->input('rfname');
        $rf->rate = $request->input('rfrate');

        $rf->save();

    }

    /**
     * get room furnish info for update
     *
     * @param Request $request
     * @return mixed
     *
     */

    public function getRF_info(Request $request){

        $rf = RoomFurnish::find($request->input('id'));
        return $rf;

    }


    /**
     * get room service info for update
     *
     * @param Request $request
     * @return mixed
     *
     */
    public function getRS_info(Request $request){

        $rs = RoomService::find($request->input('id'));
        return $rs;

    }

    /**
     * update room service
     *
     * @param Request $request
     *
     */
    public function updateRS(Request $request){

        $rs = RoomService::find($request->input('rsid'));

        $rs->name = $request->input('rsname');
        $rs->rate = $request->input('rsrate');

        $rs->save();  

    }

    /**
     * update room furnish
     *
     * @param Request $request
     *
     */
    public function updateRF(Request $request){

        $rf = RoomFurnish::find($request->input('rfid'));

        $rf->name = $request->input('rfname');
        $rf->rate = $request->input('rfrate');

        $rf->save();  

    }

    /**
     * delete room furnish
     *
     * @param Request $request
     *
     */

    public function delRF(Request $request){

        $rf = RoomFurnish::find($request->input('id'));
        $rf->delete();

    }

    /**
     * delete room service
     *
     * @param Request $request
     *
     *
     */

    public function delRS(Request $request){

        $rs = RoomService::find($request->input('id'));
        $rs->delete();

    }

    /**
     * upload room type image via AJAX
     *
     * @param Request $request
     *
     */

    public function admin_roomtype_upload(Request $request){



        $img_data = Input::get("img_data");
        $json = json_decode($img_data);

        $image_real = Input::file('img');

        $img = Image::make( $image_real->getRealPath());

        $imgpath = "uploads/RoomTypeImages/".date('YmdHis').'.'.$image_real->getClientOriginalExtension();


        $width = ceil($json->width);
        $x =  ceil($json->x);
        $y = ceil($json->y);
        $height = ceil($json->height);

        $img->crop($width,$height ,$x, $y );


        $img->resize(846, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($imgpath);

        $roomImg = new ROOM_IMAGE;

        $roomImg->path = $imgpath;
        $roomImg->room_type_id = Input::get("imgid");

        $roomImg->save();

    }

    /**
     * edit room tye info
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */

    public function admin_edit_roomtype(Request $request){

        $roomType = RoomType::find($request->input('id'));

        $id = $request->input('id');

        $rate = DB::select(DB::raw("select a.*,
        (select b.meal_type_name from MEAL_TYPES b  where b.meal_type_id = a.meal_type_id) as meal
        from RATES a where a.room_type_id = '$id'"));
        //RATE::where('room_type_id',$request->input('id'))->get();

        $images = ROOM_IMAGE::where('room_type_id',$request->input('id'))->get();

        $rf = RoomTypeFurnish::where('room_type_id',$request->input('id'))->get();
        $rs = RoomTypeService::where('room_type_id',$request->input('id'))->get();




        return response()->json(['info' => $roomType, 'images' => $images ,'rs' => $rs , 'rf' => $rf, 'rate' => $rate]);


    }

    /**
     * validate room number
     * deprecated not in use anymore
     *
     * @param Request $request
     * @return mixed
     *
     *
     */

    public function admin_check_rnum(Request $request){

        $info = Room::where('room_num',$request->input('id'))->count();

        return $info;

    }

    /**
     * get room details for update
     *
     * @param Request $request
     * @return mixed
     *
     */
    public function admin_get_room_update_details(Request $request){

        $room = Room::find($request->input('id'));
        return $room;

    }

    /**
     * save room update details
     *
     * @param Request $request
     */

    public function admin_save_room_update_details(Request $request){

        $room = Room::find($request->input('id'));


        $room->room_num = $request->input('rnum');
        $room->room_size = $request->input('rsize');
        //$room->sequence_num = $request->input('max');
        $room->room_type_id = $request->input('rtype'); 
        $room->status = $request->input('rstatus'); 
        $room->remarks = $request->input('rremarks');
        $room->save();


    }


    public function getRoomBookings(){

        $meals = MEAL_TYPE::all();

        return response()->json(['count' => count($meals), 'data' => $meals]);

    }

    public function bookingAdd(Request $request){

        $meal = new MEAL_TYPE;

        $meal->meal_type_name = $request->input('btname');
        $meal->description = $request->input('desc');

        $meal->save();

    }


    public function getBTinfo(Request $request){

        $meal = MEAL_TYPE::find($request->input('id'));

        return  $meal; 

    }


    public function editBTinfo(Request $request){

        $meal = MEAL_TYPE::find($request->input('id'));


        $meal->meal_type_name = $request->input('btname');
        $meal->description = $request->input('desc');

        $meal->save();

    }

    public function delBT(Request $request){

        $meal = MEAL_TYPE::find($request->input('id'));

        $meal->delete();


    }


    public function get_current_rooms(){

        $rooms =   DB::select(DB::raw("
select A.*, B.*, IFNULL(B.room_id,0) as available, 
(select H.type_name from ROOM_TYPES H  where H.room_type_id = A.room_type_id) as type_name
 from ROOMS A
LEFT JOIN (select * from ROOM_RESERVATION_BLOCK C
where C.room_reservation_id IN (select F.room_reservation_id from ROOM_RESERVATION F
 where F.status IN ('CHECKED IN'))
) B ON B.room_id = A.room_id
"));

        return response()->json(['count' => count($rooms), 'data' => $rooms]);


    }

    public function current_rooms(){

        return view('nilesh.currentRooms');

    }


    public function get_room_current(Request $request){

        $id = $request->input('rid');

        $rooms =   DB::select(DB::raw("Select C.*, D.*, IFNULL(D.status,'AVAILABLE') as st, (Select F.type_name from ROOM_TYPES F where F.room_type_id = C.room_type_id) as type_name, C.remarks as room_remarks, C.status as st1, K.*
from ROOMS C
Left Join (SELECT IFNULL(B.room_id,0) as rid, A.*
FROM ROOM_RESERVATION A
LEFT JOIN ROOM_RESERVATION_BLOCK B ON B.room_reservation_id = A.Room_reservation_id) D on D.rid = C.room_id
LEFT JOIN CUSTOMER K ON K.cus_id = D.cus_id
WHERE C.room_id = '$id'

"));

        return view('nilesh.reservation_info')
            ->with('room',$rooms);

    }

}
