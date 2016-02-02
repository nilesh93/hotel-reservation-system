<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class FacilitiesController extends Controller
{
   public function getIndex (Request $request){
        
        return view('nipuna.facilities');
    } 

    public function getFacilities(Request $request){
    
    $result = DB::table('facilities')->get();
            return response()->json(['count' => count($result), 'data' => $result]);

    }

    public function getAddfacility(Request $request){
    $category = $request->input('category');
    $description = $request->input('description');
    $price = $request->input('price');

    DB::table('facilities')->insert(array('category'=> $category,'description'=> $description,'price'=> $price));
    return 1;


    }

    public function getDeleterow(Request $request){
        $facility_id=$request->input('row');
        DB::table('facilities')->where('facility_id','=',$facility_id)->delete();

    }

     public function getRetrievedetails(Request $request){
        $facility_id=$request->input('row');
        $result = DB::table('facilities')->where('facility_id','=',$facility_id)->get();
        return $result;
    }

    public function getUpdatefacility(Request $request){
        $category = $request->input('category');
        $description = $request->input('description');
        $price = $request->input('price');
        $row=$request->input('row');
        DB::table('facilities')->where('facility_id',$row)->update(array('category'=> $category,'description'=> $description,'price'=> $price));
        return 1;
    }
}
