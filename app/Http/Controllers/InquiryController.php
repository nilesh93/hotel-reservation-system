<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Inquiry;
use Illuminate\Support\Facades\Mail;

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
        $this->middleware('auth', ['except' => ['blockNotice']]);

        // Check if the authenticated user is an admin
        $this->middleware('isAdmin', ['except' => ['blockNotice']]);
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


        Mail::send('emails.inquiry', ['inq'=> $inq], function ($message)   {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $message->to("nilesh.jayanandana@yahoo.com")->subject('Amalaya Reach Inquiry');
        });




    }



}
