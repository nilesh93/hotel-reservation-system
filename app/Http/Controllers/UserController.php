<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Requests\CreateNewAdminRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Admin;
use App\Customer;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Users Controller
    |--------------------------------------------------------------------------
    |
    |This controller provides views and feeds data to the admin's control
    |panel's User Management section. It also provides capabilities to
    |add/remove admins and block and unblock users.
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
     * Return the view of the Admin's user control panel.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        return view('Website.userManagement');
    }

    /**
     * Load data into DataTable for Users (Customers).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fillData()
    {
        $customers = Customer::all();

        return response()->json(['data'=>$customers]);
    }

    /**
     * Load data into DataTable for Admins.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fillAdminData()
    {
        $admins = Admin::all();

        $thisAdminEmail = Auth::user()->email;
        $thisAdminID = Admin::where('email', $thisAdminEmail)->first()->emp_id;

        return response()->json(['thisAdmin'=>$thisAdminID, 'data'=>$admins]);
    }

    /**
     * Create a new admin level user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createNewAdmin(CreateNewAdminRequest $request)
    {
        $data = $request->all();

        // Create new User
        User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => "admin"
        ]);

        // Create new Admin entry for the above user
        Admin::create([
            'email' => $data['email'],
            'last_login_ts' => ""
        ]);

        // Send notification mail to the newly created Admin.
        Mail::send('emails.newAdmin', [], function ($message) use ($data) {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $message->to($data['email'])->subject('Welcome to the team!');
        });

        return redirect('admin_users');
    }

    /**
     * Delete an admin user when provided with the admin ID.
     *
     * @param Request $request
     */
    public function deleteAdmin(Request $request)
    {
        $user = User::where('email', Admin::find($request->emp_id)->email);

        // On delete of the user entry associated with the admin, admin will be deleted too
        // (Reason: On delete cascade on foreign key admin->email refers user->email)
        $user->delete();
    }

    /**
     *
     * Set Customer's block_status to 1. (i.e. blocked).
     * @param Request $request
     */
    public function blockCustomer(Request $request)
    {
        $customer = Customer::find($request->cus_id);

        $customer->block_status = "1";

        $customer->save();
    }

    /**
     * Set Customer's block_status to 0. (i.e. unblocked).
     *
     * @param Request $request
     */
    public function unblockCustomer(Request $request)
    {
        $customer = Customer::find($request->cus_id);

        $customer->block_status = "0";

        $customer->save();
    }

    /**
     * Redirect Blocked User to this page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blockNotice()
    {
        return view('Website.blocked');
    }
}
