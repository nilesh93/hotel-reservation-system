<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\HALL;
use App\Hall_Services;

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



}
