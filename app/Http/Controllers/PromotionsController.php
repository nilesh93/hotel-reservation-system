<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class PromotionsController extends Controller
{
 
    
    public function promotions (Request $request){
        
        return view('nipuna.promotions');
        
        
    }
    
}
