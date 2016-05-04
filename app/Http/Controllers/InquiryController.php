<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Inquiry;
use Illuminate\Support\Facades\Mail;
use App\Notifications;
use App\User;
use Vinkla\Pusher\Facades\Pusher;

class InquiryController extends Controller
{
    /*
       |--------------------------------------------------------------------------
       | Inquiry Controller
       |--------------------------------------------------------------------------
       |
       |This controller provides functions to save customer inquiries,
       |send emails etc.
       |
       */

    /**
     * Constructor for the UserController class. Checks if a user has sufficient permission
     * to access the Admin area.
     *
     */
    public function __construct()
    {
        // Check if User is Authenticated
        $this->middleware('auth', ['except' => ['saveinquiry']]);

        // Check if the authenticated user is an admin
        $this->middleware('isAdmin', ['except' => ['saveinquiry']]);
    }



    /**
     * save a customer inwuiry and send an email to admin email which is hardcoded
     *
     * @param Request $request
     */
    public function saveinquiry(Request $request){


        $inq = new Inquiry;

        $inq->name = $request->input('fullname');
        $inq->company = $request->input('company');
        $inq->email = $request->input('email');
        $inq->message = $request->input('message');
        $inq->status = '1';

        $inq->save();

        // save notification to DB and to pusher
        $newNotification = new Notifications();
        $newNotification->notification = "New Customer Inquiry!";
        $newNotification->body = 'New Customer Inquiry has been made.';
        $newNotification->readStatus = '0';
        $newNotification->save();

        Pusher::trigger('notifications', 'new_backup_notification', ['message' => 'New Customer Inquiry has been made.']);

        // get admin's email

        $email = User::where('role', 'admin')->first()->email;


        Mail::send('emails.inquiry', ['inq'=> $inq], function ($message) use($email)  {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            //$message->to("vishandanura@hotmail.com")->subject('Amalaya Reach Inquiry');
            $message->to($email)->subject('Amalaya Reach Inquiry');
        });
    }

    public function getPage() {
        return view('Website.cusInq');
    }

    public function getData(){

        $data = Inquiry::all();

        return response()->json(['count'=> count($data), 'data'=> $data]);
    }
}
