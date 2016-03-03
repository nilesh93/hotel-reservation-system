<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\Admin;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
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

    //Redirect a successfully registered new user to the start page.
    //Applicable only to 'guest' role.
    protected $redirectPath = '/';

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
        'NIC_passport_num' => $data['ID'],
        'email' => $data['email'],
        'telephone_num' => $data['telephone'],
        'block_status' => "0",
        'address_line_1' => $data['address_line1'],
        'address_line_2' => $data['address_line2'],
        'city' => $data['city'],
        'province_state' => $data['province'],
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
    protected function authenticated()
    {
        if(Auth::check()) {
            if(Auth::user()->role == "admin") {

                // If user is an admin, last_login_ts field in ADMIN table is updated
                Admin::where('email', Auth::user()->email)
                    ->update(['last_login_ts' => Carbon::now()]);

                return redirect()->intended('admin');
            }
            else {
                $user_email = Auth::user()->email;
                $block_status = Customer::where('email', $user_email)->first()->block_status;

                // If user has been blocked, user is redirected to a page announcing so.
                if($block_status == "1") {
                    Auth::logout();
                    return redirect('blocked_user');
                }
                else {
                    return redirect()->intended('/');
                }
            }
        }
    }

    /**
     * Redirect a user who wants to login using Facebook to the Facebook Authentication Page.
     *
     * @return mixed
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain & process user information provided by Facebook for the above user.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function handleProviderCallback()
    {
        // Obtain User information from facebook.
        $userFB = Socialite::driver('facebook')->user();

        // Get User's email and store it in a variable for future reference.
        $email = $userFB->getEmail();

        // Check if this User is new or already registered.
        $user = User::where('email', $email)->first();

        if($user == null) {
            try{
                // Creating a User table entry for this user.
                $user = User::create([
                    'email' => $email,
                    'password' => "",
                    'role' => "guest"
                ]);

                // Create a Customer entry for the above User. Fields left blank will be later on filled by the customer.
                Customer::create([
                    'name' => $userFB->getName(),
                    'NIC_passport_num' => "",
                    'email' => $email,
                    'telephone_num' => "",
                    'block_status' => "0",
                    'address_line_1' => "",
                    'address_line_2' => "",
                    'city' => "",
                    'province_state' => "",
                    'zip_code' => "",
                    'country' => ""
                ]);
            }

            catch(QueryException $e){
                return ("A user account with ".$email." already exists.");
            }

            // Send an email to the newly registered Guest user.
            Mail::send('emails.newUser', [], function ($message) use ($email) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($email)->subject('Welcome to Amalya Reach!');
            });
        }

        // check if the user has been blocked from the site
        $user_email = $user->email;
        $block_status = Customer::where('email', $user_email)->first()->block_status;

        if($block_status == "1"){
            return redirect('blocked_user');
        }
        else{
            // Log in the User
            Auth::login($user);

            // Redirect User to the Homepage if the Login attempt was successful.
            if(Auth::check()){

                // Here, facebook automatically appends #_=_ to the URL as it is empty. This is a security measure.
                // Read more about this at:
                // http://homakov.blogspot.com/2013/03/redirecturi-is-achilles-heel-of-oauth.html
                return redirect()->intended('/');
            }
        }
    }
}
