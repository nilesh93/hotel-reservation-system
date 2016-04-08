<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinkla\Pusher\Facades\Pusher;
//use Pusher;
//use LaravelPusher;

class PusherController extends Controller
{
  
    
    public function bar(){
        
     
    $messages = '{"name":"Joe","message":"Hello world!"}';

   $a =  Pusher::trigger('test_channel', 'my_event', ['message' => $messages]);
      
          
    }
 
    
}
