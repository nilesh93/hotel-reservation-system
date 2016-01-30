<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class PromotionsController extends Controller
{
 

    public function getIndex (Request $request){
        
        return view('nipuna.promotions');
        
        
    }

    public function getUpdatepromotion(Request $request){
        $promotion_name = $request->input('promo_name');
        $promotion_description = $request->input('promo_description');
        $date_from = $request->input('promo_start');
        $date_to = $request->input('promo_end');
        $rate = $request->input('promo_rate');
        $row=$request->input('row');
        DB::table('promotions')->where('promotion_code',$row)->update(array('promotion_name'=> $promotion_name,'promotion_description'=> $promotion_description,'date_from'=> $date_from,'date_to'=> $date_to,'rate'=> $rate));
    }

    public function getRetrievedetails(Request $request){
        $promotion_code=$request->input('row');
        $result = DB::table('promotions')->where('promotion_code','=',$promotion_code)->get();
        return $result;
    }

    public function getDeleterow(Request $request){
        $promotion_code=$request->input('row');
        DB::table('promotions')->where('promotion_code','=',$promotion_code)->delete();

    }

    public function getPromotions(Request $request){
    
	$result = DB::table('promotions')->get();
	        return response()->json(['count' => count($result), 'data' => $result]);

	}

	public function getAddpromotion(Request $request){
    $promotion_name = $request->input('promo_name');
    $promotion_description = $request->input('promo_description');
    $date_from = $request->input('promo_start');
    $date_to = $request->input('promo_end');
    $rate = $request->input('promo_rate');

    DB::table('promotions')->insert(array('promotion_name'=> $promotion_name,'promotion_description'=> $promotion_description,'date_from'=> $date_from,'date_to'=> $date_to,'rate'=> $rate));
    return 1;


    }

}


