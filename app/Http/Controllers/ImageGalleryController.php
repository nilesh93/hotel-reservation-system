<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\imageGallery;
use Input;
use Image;

class ImageGalleryController extends Controller
{


    public function imageGallery(){
        
        $images = imageGallery::all();

        return view('nilesh.imageGalleryAdmin')
                ->with('images',$images);


    }

    public function admin_gallery_upload(Request $request){

        $img_data = Input::get("img_data");
        $json = json_decode($img_data);



        $image_real = Input::file('img');

        $img = Image::make( $image_real->getRealPath());

        $imgpath = "uploads/ImgGal/".date('YmdHis').'.'.$image_real->getClientOriginalExtension();


        $width = ceil($json->width);
        $x =  ceil($json->x);
        $y = ceil($json->y);
        $height = ceil($json->height);

        $img->crop($width,$height ,$x, $y );

        $img->save($imgpath);



        $imgGal = new imageGallery;

        $imgGal->path = $imgpath;

        $imgGal->save();    

    }
}
