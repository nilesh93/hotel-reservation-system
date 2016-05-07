<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\REVIEW;

class ReviewController extends Controller
{


    public function  reviews(){

        return view('nilesh.reviews');

    }

    public function getReviews(){

        $reviews = REVIEW::all();

        return response()->json(['count' => count($reviews), 'data' => $reviews]);

    }

    public function publish(Request $request){

        $review = REVIEW::find($request->input('id'));

        $review->status = 'PUBLISHED';

        $review->save();

    }


    public function reject(Request $request){

        $review = REVIEW::find($request->input('id'));

        $review->status = 'REJECTED';

        $review->save();



    }

}
