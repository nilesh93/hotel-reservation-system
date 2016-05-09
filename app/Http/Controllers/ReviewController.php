<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\REVIEW;

class ReviewController extends Controller
{


    /**
     * view reviews
     * @return mixed
     */
    public function  reviews(){

        return view('nilesh.reviews');

    }

    /**
     * get reviews to the admin side
     * @return mixed
     */
    public function getReviews(){

        $reviews = REVIEW::all();

        return response()->json(['count' => count($reviews), 'data' => $reviews]);

    }

    /**
     * publish reviews
     * @param Request $request
     */
    public function publish(Request $request){

        $review = REVIEW::find($request->input('id'));

        $review->status = 'PUBLISHED';

        $review->save();

    }


    /**
     * reject reviews
     * @param Request $request
     */
    public function reject(Request $request){

        $review = REVIEW::find($request->input('id'));

        $review->status = 'REJECTED';

        $review->save();



    }

}
