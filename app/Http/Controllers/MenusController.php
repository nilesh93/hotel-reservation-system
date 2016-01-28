<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class MenusController extends Controller
{
    public function getIndex (Request $request){
        
        return view('nipuna.menus');
        
        
    }

}
