<?php

namespace App\Http\Controllers;

use App\Classes\ReservationRoom;
use App\Classes\ReservationTask;
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
        $halls = HALL::get();

        return view('Website.Halls',["halls"=>$halls]);
    }

    /**
     * This function provides the view of the rooms page with details
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roomsView()
    {
        $room_types = ROOM_TYPE::get();
        $total_rooms=0;
        $kids_can = 20;
        $adults_can = 30;

        foreach($room_types as $room_type)
        {
            $total_rooms += $room_type->count;
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
        if(Request::has('CanPay') && Session::has('CanPay')) {
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
        return view('Website.MyReservation');
    }
}
