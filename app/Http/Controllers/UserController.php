<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Admin;

class UserController extends Controller
{
    /**
     * Return the view of the admin control panel with data
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $admins = Admin::all();
        return view('Website.userManagement', compact('admins'));
    }

    /**
     * Create a new admin level user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createNewAdmin(Request $request){
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

        return redirect('/admin_users');
    }

    /**
     * Delete an admin user when provided with the admin ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteAdmin($id){

        $user = User::where('email', Admin::find($id)->email);

        // On delete of the user entry associated with the admin, admin will be deleted too
        // (Reason: On delete cascade on foreign key admin->email refers user->email)
        $user->delete();

        return redirect('/admin_users');
    }

}
