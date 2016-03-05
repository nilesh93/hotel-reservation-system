<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Menu;

class MenuControllerWeb extends Controller
{

   public function menuMain(){
       
       
     $menus = Menu::all();
      
      return view('Website.menu')
         ->with('menus',$menus);
       
   }

 
}
