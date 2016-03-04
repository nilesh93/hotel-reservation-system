<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\HALL;
use App\HALL_IMAGE;
use App\Hall_Services;
use Image;
use Input;

class HallController extends Controller
{

    public function halls(){


        return view('nilesh.halls');

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

}
