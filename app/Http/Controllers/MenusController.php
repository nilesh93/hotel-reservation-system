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
