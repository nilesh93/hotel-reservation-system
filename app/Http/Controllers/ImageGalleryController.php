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
use File;

class ImageGalleryController extends Controller
{

    /*
   |--------------------------------------------------------------------------
   | Image Gallery Controller
   |--------------------------------------------------------------------------
   |
   |This controller provides functions to upload image, according
   |to that upload/delete gallery images and home images.
   |
   */

    /**
     * Constructor for the UserController class. Checks if a user has sufficient permission
     * to access the Admin area.
     *
     */
    public function __construct()
    {
        // Check if User is Authenticated
        $this->middleware('auth', ['except' => ['blockNotice']]);

        // Check if the authenticated user is an admin
        $this->middleware('isAdmin', ['except' => ['blockNotice']]);
    }


    /**
     * return admin image gallery management
     *
     * @return $this
     */

    public function imageGallery(){

        $images = imageGallery::all();

        return view('nilesh.imageGalleryAdmin')
            ->with('images',$images);


    }


    /**
     * upload gallery image via AJAX
     *
     * @param Request $request
     */

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

    /**
     * return Home gallery image management View
     *
     * @return $this
     *
     */

    public function webimageGallery(){

        $images = HOME_GALLERY::all();

        return view('nilesh.webHomeGallery')
            ->with('images',$images);

    }

    /**
     * Home gallery image upload via ajax
     *
     * @param Request $request
     *
     */

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

    /**
     * update Home gallery image captions
     *
     * @param Request $request
     *
     */

    public function admin_homeImage_update(Request $request){

        $imgGal = HOME_GALLERY::find(Input::get("id"));


        $imgGal->caption = Input::get('caption1e');
        $imgGal->caption_desc = Input::get('caption2e');
        $imgGal->save();    


    }

    /**
     *get home gallery details before updating or editing
     *
     * @param Request $request
     * @return mixed
     *
     */

    public function get_homeImage_details(Request $request){


        $imgGal = HOME_GALLERY::find(Input::get("id"));

        return $imgGal;

    }

    /**
     * delete home gallery image
     *
     * @param Request $request
     *
     */
    public function admin_homeImage_del(Request $request){


        $imgGal = HOME_GALLERY::find(Input::get("id"));

        $path = $imgGal->path;

        File::delete($path);

        $imgGal->delete();

    }

    /**
     * delete web gallery image
     *
     * @param Request $request
     *
     */

    public function admin_webImage_del(Request $request){


        $imgGal = imageGallery::find(Input::get("id"));

        $path = $imgGal->path;

        File::delete($path);

        $imgGal->delete();

    }

}
