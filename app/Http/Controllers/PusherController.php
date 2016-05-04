<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinkla\Pusher\Facades\Pusher;
/*use LaravelPusher;*/

class PusherController extends Controller
{
    public function bar()
    {
        $messages = '{"name":"Joe","message":"Hello world!"}';

        dd(Pusher::trigger('test_channel', 'my-event', ['message' => 'Test passed']));
    }
}
