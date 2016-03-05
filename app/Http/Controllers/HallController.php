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

    /**
     * Return view for Hall Services
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHallServices()
    {
        return view('nilesh.hallServices');
    }

    /**
     * Provide data to fill the Hall Services DataTable.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHallServiceData()
    {

        $data = Hall_Services::all();

        return response()->json(['count'=> count($data), 'data'=> $data]);
    }

    /**
     * Add a hall service according to the details
     * provided in the Request.
     *
     * @param Request $request
     */
    public function addHallService(Request $request)
    {
        $message = "This Service already exists.";

        $data = $request->all();

        // Checks if any services with this name already exist
        $hallService = Hall_Services::where('name', (trim($request->input('name'))))->first();

        // if no service exists, then create
        if ($hallService == null) {
            Hall_Services::create([
                'name' => $data['name'],
                'rate' => $data['rate']
            ]);
        }

        // if Service exists, say so.
        else {
            abort(403, $message);
        }
    }

    /**
     * Send HallService information to the editHallService modal
     *
     * @param Request $request
     * @return mixed
     */
    public function getHallServiceInfo(Request $request){

        $hallService = Hall_Services::find($request->input('hs_id'));
        return $hallService;
    }

    /**
     * Update Hall Service information
     *
     * @param Request $request
     */
    public function updateHallService(Request $request){

        $message = "This Service already exists.";

        $data = $request->all();

        // Checks if any services with this name already exist
        $hallTest = Hall_Services::where('name', (trim($request->input('name'))))->first();

        // if no service exists, then create
        if ($hallTest == null) {
            $hallService = Hall_Services::find($request->input('hs_id'));

            $hallService->name = $request->input('name');
            $hallService->rate = $request->input('rate');

            $hallService->save();
        }

        // if Service exists, say so.
        else {
            abort(403, $message);
        }
    }

    /**
     * Delete a hall service with a given ID
     *
     * @param Request $request
     */
    public function deleteHallService(Request $request)
    {

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
