<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class PromotionsController extends Controller
{
 
    
    public function getIndex (){
        
        return view('nipuna.promotions');
        
        
    }

    public function getPromotions (Request $request){

   	
	$result = DB::table('promotions')->get();
	return response()->json(['count' => count($result), 'data' => $result]);


	}

	public function getAddpromotion (request $request){

		// $customer_tel=$request->input('customer_id');
	    $promotion_name = $request->input('promo_name');
	    $promotion_description = $request->input('promo_description');
	    $date_from = $request->input('promo_start');
	    $date_to = $request->input('promo_end');
	    $rate = $request->input('promo_rate');
	   
	    DB::table('promotions')->insert(array('promotion_name'=> $promotion_name,'promotion_description'=> $promotion_description,'date_from'=> $date_from,'date_to'=> $date_to,'rate'=> $rate));
	    return 1;

	}
}


