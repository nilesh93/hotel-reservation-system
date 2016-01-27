<?php

namespace App\Http\Controllers;

use App\HALL;
use App\ROOM_TYPE;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    //
     public function halls(){


         return view('Website.Halls');
     }

    public function rooms(){


        return view('Website.Room_Packages');
    }

    public function available_rooms(){



        return view('Website.Rooms_availability');
    }
}
