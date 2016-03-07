<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\HALL;
use App\HALL_IMAGE;
use App\Hall_Services;
use App\HALL_SERVICE_JOIN;
use App\HALL_RATE;
use Image;
use Input;
use File;


class HallController extends Controller
{

    public function halls(){


        $hs = Hall_Services::all();
        return view('nilesh.halls')
            ->with('hs',$hs);

    }


    public function admin_get_halls(Request $request){

        $halls = Hall::all();

        return response()->json(['count'=> count($halls), 'data'=> $halls]);

    }

    public function admin_hall_add(Request $request){

        $hall = new Hall;

        $hall->hall_num    = $request->input('hnum');
        $hall->title       = $request->input('htitle');
        $hall->hall_size    = $request->input('hsize');
        $hall->remarks     = $request->input('hremarks');
        $hall->capacity_from       = $request->input('hfrom');    
        $hall->capacity_to     = $request->input('hto');
        $hall->save();
        
        
        $hr = new HALL_RATE;
        
        $hr->rate = $request->input('hrate');
        $hr->advance_payment = $request->input('advance');
        $hr->refundable_amount = $request->input('refund');
        $hr->hall_id = $hall->hall_id;
        
        
        $hr->save();
        
        
           for($i = 0; $i<$request->input('hscount'); $i++){


            if( $request->input("service".$i) > 0){
                $rts = new HALL_SERVICE_JOIN;

                $rts->hall_id = $hall->hall_id;
                $rts->service_id = $request->input("service".$i);

                $rts->save();

            }

        }


    }
    
    public function admin_update_hall(Request $request){
        
        $hall = Hall::find(Input::get('id'));

        $hall->hall_num    = $request->input('hnum');
        $hall->title       = $request->input('htitle');
        $hall->hall_size    = $request->input('hsize');
        $hall->remarks     = $request->input('hremarks');
        $hall->capacity_from       = $request->input('hfrom');    
        $hall->capacity_to     = $request->input('hto');
        $hall->save();
        
        
        
        $rate = HALL_RATE::where('hall_id',Input::get('id'))->delete();
        
        
        $hr = new HALL_RATE;
        
        $hr->rate = $request->input('hrate');
        $hr->advance_payment = $request->input('advance');
        $hr->refundable_amount = $request->input('refund');
        $hr->hall_id = $hall->hall_id;
        
        
        $hr->save();
        
        
        $hs = HALL_SERVICE_JOIN::where('hall_id',Input::get('id'))->delete();
        
           for($i = 100; $i<$request->input('hscount'); $i++){


            if( $request->input("service".$i) > 0){
                $rts = new HALL_SERVICE_JOIN;

                $rts->hall_id = $hall->hall_id;
                $rts->service_id = $request->input("service".$i);

                $rts->save();

            }

        }
        
        
    }
    public function admin_edit_hall(Request $request){
        
        $hall = Hall::find($request->input('id'));
        $hs   = HALL_SERVICE_JOIN::where('hall_id',$request->input('id'))->get(); 
        $images = HALL_IMAGE::where('hall_id',$request->input('id'))->get();
        $hr = HALL_RATE::where('hall_id',$request->input('id'))->first();
        
        return response()->json(['hall'=>$hall, 'hs'=> $hs, 'images'=> $images, 'hr'=>$hr]);
        
    }
    
    public function admin_delete_hall(Request $request){
        
        $hall = Hall::find($request->input('id'));
        
        $hall->delete();
        
        
        
    }

    public function getHallServices(){
        return view('nilesh.hallServices');
    }

    public function getHallServiceData(){

        $data = Hall_Services::all();

        return response()->json(['count'=> count($data), 'data'=> $data]);

    }

    public function addHallService(Request $request){

        $data = $request->all();

        Hall_Services::create([
            'name' => $data['name'],
            'rate' => $data['rate']
        ]);
    }

    public function deleteHallService(Request $request){

        $service = Hall_Services::find($request->input('id'));

        $service->delete();
    }

    public function admin_hall_upload(Request $request){
        
        
        
        $img_data = Input::get("img_data");
        $json = json_decode($img_data);

        $image_real = Input::file('img');

        $img = Image::make( $image_real->getRealPath());

        $imgpath = "uploads/hallImg/".date('YmdHis').'.'.$image_real->getClientOriginalExtension();


        $width = ceil($json->width);
        $x =  ceil($json->x);
        $y = ceil($json->y);
        $height = ceil($json->height);

        $img->crop($width,$height ,$x, $y );


        $img->resize(846, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($imgpath);

        $hallImg = new HALL_IMAGE;

        $hallImg->path = $imgpath;
        $hallImg->hall_id = Input::get("imgid");

        $hallImg->save();
        
        
        
    }
    
    
    public function admin_hall_image_del(Request $request){
        
        $hi = HALL_IMAGE::find(Input::get('id'));
        
        $path = $hi->path;
        
        File::delete($path);
        
        $hi->delete();
        
        
        $images = HALL_IMAGE::where('hall_id',$request->input('type_id'))->get();
        
        return response()->json([ 'images'=> $images]);
        
    }

}
