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
