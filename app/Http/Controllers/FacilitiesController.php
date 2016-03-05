<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

/**
 * Class FacilitiesController
 * @package App\Http\Controllers
 */
class FacilitiesController extends Controller
{

    /**
     * Constructor for the FacilitiesController class. Checks if a user has sufficient permission
     * to access the Admin area.
     *
     */
    public function __construct()
    {
        // Check if User is Authenticated
        $this->middleware('auth', ['except' => ['blockNotice']]);

        // Check if the authenticated user is an admin
        $this->middleware('isAdmin', ['except' => ['blockNotice']]);
    }
    /**
     * Returns the facilities view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex (Request $request){

        return view('nipuna.facilities');
    }

    /**
     * Returns all the records in the facilities table as a JSON response.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFacilities(Request $request){
        $result = DB::table('facilities')->get();
        return response()->json(['count' => count($result), 'data' => $result]);
    }

    /**
     * Insert a new facility to facilities table.
     *
     * @param Request $request
     * @return int
     */
    public function getAddfacility(Request $request){
        $category = $request->input('category');
        $description = $request->input('description');
        $price = $request->input('price');
        DB::table('facilities')->insert(array('category'=> $category,'description'=> $description,'price'=> $price));
        return 1;
    }

    /**
     * Deletes a facility when the row number is passed.
     *
     * @param Request $request
     */
    public function getDeleterow(Request $request){
        $facility_id=$request->input('row');
        DB::table('facilities')->where('facility_id','=',$facility_id)->delete();

    }

    /**
     * Returns details about a facility when its row number is passed.
     *
     * @param Request $request
     * @return mixed
     */
    public function getRetrievedetails(Request $request){
        $facility_id=$request->input('row');
        $result = DB::table('facilities')->where('facility_id','=',$facility_id)->get();
        return $result;
    }

    /**
     * Update a facility.
     *
     * @param Request $request
     * @return int
     */
    public function getUpdatefacility(Request $request){
        $category = $request->input('category');
        $description = $request->input('description');
        $price = $request->input('price');
        $row=$request->input('row');
        DB::table('facilities')->where('facility_id',$row)->update(array('category'=> $category,'description'=> $description,'price'=> $price));
        return 1;
    }
}
