<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\User;
use App\Http\Controllers\Controller;

class RegisteredUsersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registered Users Controller
    |--------------------------------------------------------------------------
    |
    |This class provides views and functions for registered users to view and
    |edit their details as needed as well as reset their passwords.
    |
    */

    /**
     * Constructor for this class.
     * Contains middleware to restrict the access to this section.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return profile view with Customer's currently existing details
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileView()
    {
        $customer = Customer::where('email', Auth::user()->email)->first();

        return view('auth.profile', compact('customer'));
    }

    /**
     * Get request from profile form and update the fields of the Customer instance.
     * Then redirect to their intended location or '/'
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate(UpdateProfileRequest $request)
    {
        // Retrieve all data in $request to an array
        $data = $request->all();

        // Find and retrieve the appropriate Customer instance
        $customer = Customer::where('email', Auth::user()->email)->first();

        // Update the details
        $customer->name = $data['name'];
        $customer->NIC_passport_num = $data['ID'];
        $customer->telephone_num = $data['telephone'];
        $customer->address_line_1 = $data['address_line1'];
        $customer->address_line_2 = $data['address_line2'];
        $customer->city = $data['city'];
        $customer->province_state = $data['province'];
        $customer->zip_code = $data['zipCode'];
        $customer->country = $data['country'];

        // Save the updated Customer instance
        $customer->save();

        return redirect()->intended('/')->with('success', 'Your details have been updated successfully.');
    }

    /**
     * Return view for the password changing function.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePasswordView()
    {
        return view('auth.changePwd');
    }

    /**
     * Get the new password from the request, encrypt it and store it in
     * the user details.Then redirect the user to '/' with success message.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->all();

        $user = User::where('email', Auth::user()->email)->first();

        $user->password = bcrypt($data['password']);

        $user->save();

        return redirect('/')->with('success', 'You password has been changed successfully.');
    }
}
