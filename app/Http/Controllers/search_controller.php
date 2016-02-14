<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class search_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function bookings_search_index(){
        return view('nipuna.searchbooking');
    }

    public function bookings_search(){
        $result = DB::table('room_reservation')->get();
            return response()->json(['count' => count($result), 'data' => $result]);
    }


    public function rooms_search_index(){
         return view('nipuna.searchroom');
    }

    public function rooms_search(){
        $result = DB::table('rooms')->get();
            return response()->json(['count' => count($result), 'data' => $result]);
    }

    public function customers_search_index(){
        return view('nipuna.searchcustomer');
    }

    public function customers_search(){
        $result = DB::table('customer')->get();
            return response()->json(['count' => count($result), 'data' => $result]);
    }
}
