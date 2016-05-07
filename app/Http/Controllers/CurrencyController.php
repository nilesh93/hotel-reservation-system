<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class CurrencyController extends Controller
{

    public function converter(Request $request){


        $httpAdapter = new \Ivory\HttpAdapter\FileGetContentsHttpAdapter();
        $yahooProvider = new \Swap\Provider\YahooFinanceProvider($httpAdapter);

        // Create Swap with the provider
        $swap = new \Swap\Swap($yahooProvider);
        //usd to lkr
        if(Input::get('cur')=='LKR'){

            $rate = $swap->quote('USD/LKR');

        }else{

            $rate = $swap->quote('LKR/USD');
        }

        return  $rate;



    }
}
