<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditAboutUsRequest;
use Illuminate\Support\Facades\Input;
use App\AboutUs;
use Illuminate\Support\Facades\Cache;

class AboutUsPageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AboutUsPage Controller
    |--------------------------------------------------------------------------
    |
    |This Controller provides views and data for the about us page and the functions
    |to change about us page as needed.
    |
    */

    /**
     * Constructor for the AboutUsPageController class. Checks if a user has sufficient permission
     * to access the Admin area.
     *
     */
    public function __construct()
    {
        // Check if User is Authenticated
        $this->middleware('auth', ['except' => ['viewPage']]);

        // Check if the authenticated user is an admin
        $this->middleware('isAdmin', ['except' => ['viewPage']]);
    }


    /**
     * Returns About Us view for everyone
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewPage()
    {
        $aboutUsID = AboutUs::max('id');

        if ($aboutUsID == null) {
            $description = "Site is still under construction.";
        }
        else {
            $description = AboutUs::find($aboutUsID)->description;
        }

        return view('Website.aboutUs', compact('description'));
    }


    /**
     * Serves the edit About Us page and functions to the admin
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewAdminPage()
    {
        $aboutUsID = AboutUs::max('id');

        if ($aboutUsID == null) {
            $description = "Site is still under construction.";
        }
        else {
            $description = AboutUs::find($aboutUsID)->description;
        }

        return view('Website.adminViewAboutUs', compact('description'));
    }


    /**
     * Changes the content in About Us page as required
     * and returns to the admin's about us edit page.
     *
     * @param EditAboutUsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editContent(EditAboutUsRequest $request)
    {
        $img = $request->file('bannerImg');

        if ($img != null || $img != '') {
            $upload_path = public_path()."/FrontEnd/img/about_us/";

            // for more on Laravel upload handling: http://clivern.com/how-to-create-file-upload-with-laravel/
            $img->move($upload_path, 'about_us2.jpg');

            // File Cache is cleared and rebuilt
            // Reason: Sometimes, even though the file has been changed, webpage displays the old file
            // even if it doesn't exist anymore. That nonexistant image comes from the file cache which is
            // used by Laravel to speedup web page loading speeds.
            Cache::flush();
        }

        if ($request->paragraph != null || $request->paragraph != '') {

            $content = $request->paragraph;
            $current_description = AboutUs::find(AboutUs::max('id'));

            if($current_description == null) {
                $about_us = new AboutUs();
                $about_us->description = $content;
                $about_us->save();
            }
            else {
                $about_us = $current_description;
                $about_us->description = $content;
                $about_us->save();
            }
        }

        return redirect('admin_about_us')->with('status', 'About Us page was successfully updated.');
    }
}
