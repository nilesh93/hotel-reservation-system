<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Mail;
use Input;
use Illuminate\Encryption;

/**
 * Class PromotionsController
 * @package App\Http\Controllers
 */
class PromotionsController extends Controller
{

    /**
     * Constructor for the PromotionsController class. Checks if a user has sufficient permission
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
     * Returns the promotions view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex (Request $request){
        return view('nipuna.promotions');
    }

    /**
     * Update promotions table.
     *
     * @param Request $request
     */
    public function getUpdatepromotion(Request $request){
        $promotion_name = $request->input('promo_name');
        $promotion_description = $request->input('promo_description');
        $date_from = $request->input('promo_start');
        $date_to = $request->input('promo_end');
        $rate = $request->input('promo_rate');
        $row=$request->input('row');
        DB::table('promotions')->where('promotion_code',$row)->update(array('promotion_name'=> $promotion_name,'promotion_description'=> $promotion_description,'date_from'=> $date_from,'date_to'=> $date_to,'rate'=> $rate));
    }

    /**
     * Returns the promotion details when the row number is passed.
     *
     * @param Request $request
     * @return mixed
     */
    public function getRetrievedetails(Request $request){
        $promotion_code=$request->input('row');
        $result = DB::table('promotions')->where('promotion_code','=',$promotion_code)->get();
        return $result;
    }

    /**
     * Deletes a promotion when the row number is passed.
     *
     * @param Request $request
     */
    public function getDeleterow(Request $request){
        $promotion_code=$request->input('row');
        DB::table('promotions')->where('promotion_code','=',$promotion_code)->delete();
    }

    /**
     * Returns all the records from the promotions table as JSON.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPromotions(Request $request){
        $result = DB::table('promotions')->get();
        return response()->json(['count' => count($result), 'data' => $result]);
    }

    /**
     * Inert a new promotion to the promotions table.
     *
     * @param Request $request
     * @return int
     */
    public function getAddpromotion(Request $request){
        $promotion_name = $request->input('promo_name');
        $promotion_description = $request->input('promo_description');
        $date_from = $request->input('promo_start');
        $date_to = $request->input('promo_end');
        $rate = $request->input('promo_rate');

        DB::table('promotions')->insert(array('promotion_name'=> $promotion_name,'promotion_description'=> $promotion_description,'date_from'=> $date_from,'date_to'=> $date_to,'rate'=> $rate));

        $data = ['promo_name'=>$promotion_name,'promo_desc'=>$promotion_description,'date_from'=>$date_from,'date_to'=>$date_to,'rate'=>$rate];

        $roles = DB::table('users')->lists('email');

        Mail::send('emails.promotionEmail', $data, function ($message) use ($roles) {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $message->to($roles)->subject('New Promotions from Amalya Resorts!!');
        });
    }
}


