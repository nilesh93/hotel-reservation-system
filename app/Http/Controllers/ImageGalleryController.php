<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\imageGallery;
use Input;

class ImageGalleryController extends Controller
{
 
  
    public function imageGallery(){
        
        return view('nilesh.imageGalleryAdmin');
        
        
    }
    
    public function admin_gallery_upload(Request $request){
       
       print_r($_FILES);
        
       //var_dump($request->file());
      $destinationPath = 'uploads'; // upload path
      //$extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
      //$fileName = rand(11111,99999).'.'.$extension; // renameing image
      //Input::file('image')->move($destinationPath, $fileName);
        
        
    }
}
