<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\Admin;
use Carbon\Carbon;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'ID'=>'required|size:10',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'telephone'=> 'required|max:15',
            'address_line1'=>'required',
            'address_line2'=>'required',
            'city'=>'required',
            'province'=>'required',
            'zipCode'=>'required',
            'country'=>'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => "guest"
        ]);

        Customer::create([
        'name' => $data['name'],
        'NIC/passport_num' => $data['ID'],
        'email' => $data['email'],
        'telephone_num' => $data['telephone'],
        'block_status' => "0",
        'address_line_1' => $data['address_line1'],
        'address_line_2' => $data['address_line2'],
        'city' => $data['city'],
        'provicnce/state' => $data['province'],
        'zip_code' => $data['zipCode'],
        'country' => $data['country']
    ]);

        // Send an email to the newly registered Guest user.
        Mail::send('emails.newUser', [], function ($message) use ($data) {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $message->to($data['email'])->subject('Welcome to Amalya Reach!');
        });

        return $user;
    }

    /**
     * Redirect a logged in user to the appropriate start page depending on the role.
     * @link https://laracasts.com/discuss/channels/laravel/how-best-to-redirect-admins-from-users-after-login-authentication
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function authenticated(/*$user*/)
    {
        if(Auth::check()){
            if(Auth::user()->role == "admin") {

                // If user is an admin, last_login_ts field in ADMIN table is updated
                Admin::where('email', Auth::user()->email)
                    ->update(['last_login_ts' => Carbon::now()]);

                return redirect('/admin');
            }
            return redirect('/');
        }
    }

    /**
     * Redirect a successfully registered new user to the start page.
     * Applicable only to 'guest' role.
     *
     * @var string
     */
    protected $redirectPath = '/';
}
