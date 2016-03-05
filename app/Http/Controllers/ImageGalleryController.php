<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\imageGallery;
use App\HOME_GALLERY;
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


        $img->resize(846, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($imgpath);



        $imgGal = new imageGallery;

        $imgGal->path = $imgpath;

        $imgGal->save();    

    }
    
    public function webimageGallery(){
        
            $images = HOME_GALLERY::all();

        return view('nilesh.webHomeGallery')
            ->with('images',$images);
        
    }
    
    
    public function  admin_webgallery_upload(Request $request){

        $img_data = Input::get("img_data");
        $json = json_decode($img_data);



        $image_real = Input::file('img');

        $img = Image::make( $image_real->getRealPath());

        $imgpath = "uploads/HomeGal/".date('YmdHis').'.'.$image_real->getClientOriginalExtension();


        $width = ceil($json->width);
        $x =  ceil($json->x);
        $y = ceil($json->y);
        $height = ceil($json->height);

        $img->crop($width,$height ,$x, $y );


        $img->resize(2100, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($imgpath);



        $imgGal = new HOME_GALLERY;

        $imgGal->path = $imgpath;

        $imgGal->caption = Input::get('caption');
        $imgGal->caption_desc = Input::get('caption_desc');
        $imgGal->save();    

    }
    
    
    
}
