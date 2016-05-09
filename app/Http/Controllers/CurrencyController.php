<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class CurrencyController extends Controller
{

    /**
     * returns currency converted rate
     * @param Request $request
     * @return null|\Swap\Model\Rate
     */
    public function converter(Request $request){


        $httpAdapter = new \Ivory\HttpAdapter\FileGetContentsHttpAdapter();
        $yahooProvider = new \Swap\Provider\YahooFinanceProvider($httpAdapter);

        $swap = new \Swap\Swap($yahooProvider);


        //simple if else statement to get reates from LKR to USD
        if(Input::get('cur')=='LKR'){
            $rate = $swap->quote('USD/LKR');
        }else{
            $rate = $swap->quote('LKR/USD');
        }

        return  $rate;



    }
}
