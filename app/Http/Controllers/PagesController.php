<?php

namespace App\Http\Controllers;

use App\Classes\ReservationRoom;
use App\Classes\ReservationTask;
use App\HotelInfo;
use Illuminate\Support\Facades\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\HALL;
use App\ROOM_TYPE;
use Session;
use App\imageGallery;
use App\FACILITY;
use App\HOME_GALLERY;
use Auth;
use App\Customer;
use App\REVIEW;
use Input;

class PagesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Pages Controller
    |--------------------------------------------------------------------------
    |
    |This controller provides views to the users and also do some
    |of the session management tasks.
    |
    */

    /**
     * This function response the home page view and also it clears the session details of
     * reservations if there are any.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function HomePage()
    {
       $this->clearSession();

       $images = HOME_GALLERY::all();
        $facilities = FACILITY::all();

        return view('Website.Demo')
            ->with('images',$images)
            ->with('facilities',$facilities);
    }

    /**
     * This function submits and saves a user review to the database.
     *
     * @param Request $request
     * @return void
     */
    public function submit_review(Request $request)
    {
        $review = new REVIEW;
        $review->name = Input::get('name');
        $review->review = Input::get('review');
        $review->save();
    }

    /**
     * This function directs to the admin page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView()
    {
        return view('Admin.Demo');
    }

    /**
     * This function directs to the contact view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactView()
    {
        return view('Website.contact');
    }

    /**
     * This function provides the view of the halls page with hall details
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hallsView()
    {

        $this->clearSession();

        $halls = HALL::get();
        $time_slot1_from = HotelInfo::value('hall_time_slot_1_from');
        $time_slot1_to = HotelInfo::value('hall_time_slot_1_to');

        $time_slot1 = "" .$time_slot1_from . " - " .$time_slot1_to;

        $time_slot2_from = HotelInfo::value('hall_time_slot_2_from');
        $time_slot2_to = HotelInfo::value('hall_time_slot_2_to');

        $time_slot2 = "" .$time_slot2_from . " - " .$time_slot2_to;


        return view('Website.Halls',["halls"=>$halls,"time_slot1"=>$time_slot1,"time_slot2"=>$time_slot2]);
    }

    /**
     * This function provides the view of the rooms page with details
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roomsView()
    {
        //this calls the clear session function in order to clear the session
        $this->clearSession();


        $room_types = ROOM_TYPE::get();
        $total_rooms_have = config('constants.CHK_ZERO');
        $total_rooms=HotelInfo::value('selectable_no_of_rooms');
        $kids_can = HotelInfo::value('no_of_kids');
        $adults_can = HotelInfo::value('no_of_adults');

        foreach($room_types as $room_type)
        {


            $total_rooms_have += DB::table('ROOMS')
                                ->where('room_type_id','=',$room_type->room_type_id)
                                 ->count();
        }



        //check if the room count exceed the available rooms
       if($total_rooms > $total_rooms_have)
        {
            $total_rooms = $total_rooms_have;
        }

        return view('Website.Room_Packages',["room_types"=>$room_types,'total_rooms'=>$total_rooms,'kids_can'=>$kids_can,
            'adults_can'=>$adults_can]);
    }

    /**
     * This function provides the view of the payment view if certain conditions
     * are met.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makePayment(Request $request)
    {
        if((Request::has('CanPay') && Session::has('CanPay') || Session::has('fblogin_payment'))) {


            if(Auth::user()->role == 'admin')
            {
                return redirect('/')->with(['noAccess'=>'Access denied']);
            }

            $customer_email = Auth::user()->email;
            $nic_passport = Customer::where('email', $customer_email)
                ->value('NIC_passport_num');

            if(empty($nic_passport))
            {
                //this is added in order to check facebook logged is users and redirect them after registration
                Session::put(['fblogin_payment'=>'reached']);

                return redirect('profile');
            }


            if(Session::has('promo_code'))
            {
                $total_promo = session('total_payable')*(config('constants.ONE_VALUE')-session('promo_rate'));
                Session::put(['total_payable'=>$total_promo]);

            }

            //convert LKR to USD before redirect to pay pal account
            $total = $this->convert(session('total_payable'));

            if(Session::has('promo_code'))
            {

            }

            Session::put(['pay_pal_total_payable'=>$total]);

            return view('Website.Payment');
        }
        else {

            abort(401);
        }
    }

    /**
     * This functions provides the view of the My Reservation page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myReserve()
    {
        $this->clearSession();
        return view('Website.MyReservation');
    }

    public function convert($total)
    {

        $httpAdapter = new \Ivory\HttpAdapter\FileGetContentsHttpAdapter();
        $yahooProvider = new \Swap\Provider\YahooFinanceProvider($httpAdapter);


        // Create Swap with the provider
        $swap = new \Swap\Swap($yahooProvider);

        $rate = $swap->quote('LKR/USD')->getValue();

        return $rate*$total;

    }

    public function clearSession()
    {
        //clears the room reservation session details if there are any.
        if(Session::has('room_types')) {
            $room_types = session('room_types');

            foreach ($room_types as $room_type) {

                Session::forget('room_type_name' . $room_type);
                Session::forget('no_of_rooms' . $room_type);
                Session::forget('rate' . $room_type);
                Session::forget('meal_type' . $room_type);
                Session::forget('rate_code' . $room_type);
                Session::forget('total_payable');
            }
        }

        Session::forget('room_types');
        Session::forget('check_in');
        Session::forget('check_out');
        Session::forget('adults');
        Session::forget('kids');
        Session::forget('rooms');
        Session::forget('room_types');

        //clears the hall reservation session details if there are any
        Session::forget('hall_selected');
        Session::forget('event_date');
        Session::forget('total_payable');

        //Clear the indicator to access the payment page
        Session::forget('CanPay');

        //Clear the fblogin attribute
        Session::forget('fblogin_payment');

        //clear promotion values
        Session::forget('promo_code');
        Session::forget('promo_rate');

    }
}
