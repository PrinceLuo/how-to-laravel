<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\verifyEmail;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
//        return User::create([
//                    'name' => $data['name'],
//                    'email' => $data['email'],
//                    'password' => bcrypt($data['password']),
//        ]);

        $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'verifyToken' => Str::random(40),
        ]);
        $thisUser = User::findOrFail($user->id);
        $this->sendEmailToActivate($thisUser);
        return $user;
    }

    /*     * * * * * * * * * *
     * in the tutorial video, tutor would change the function register() 
     * directly, but in this case I prefer Over write it here
     * * * * * * * * * * */

    // copied from Illuminate\Foundation\Auth\RegistersUsers.php
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));



        //$this->guard()->login($user);
//        return $this->registered($request, $user)
//                        ?: redirect($this->redirectPath());
        return redirect(route('verifyEmailfirst')); // sending an Email to activate
    }

    public function verifyEmailfirst() {
        return view('email.verifyEmailfirst');
    }

    public function sendEmailToActivate($thisUser) {
        Mail::to($thisUser->email)->send(new verifyEmail($thisUser));
    }

    public function sendEmailDone($email, $verifyToken) {
        $user = User::where(['email' => $email, 'verifyToken' => $verifyToken])->first();
        if ($user) {
            $user->status = 1;
            $user->verifyToken = null;
            if ($user->save()) {
                return 'Succeed activating the account!';
            } else {
                return 'Fail activate the account!';
            }
        } else {
            return 'This account does not exist!';
        }
    }

}
