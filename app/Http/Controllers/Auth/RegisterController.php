<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Admin;
use Illuminate\Http\Request;
use App\Notifications\NewCv; 
use App\Notifications\WelcomeUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\Registersuser;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new user as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect user after registration.
     *
     * @var string
     */
    public function FunctiredirectTo()
    {
        return app()->getLocale().'/user';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('auth.register',compact('roles'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data , $table)
    {

        return Validator::make($data, [
            'name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.$table],
            'role_id' => ['required'],
            'gender' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(Request $request)
    {
        $avatar = '';

        $gender =  [
            'Male' => 'ذكر',
            'Female' => 'انثى'   
        ];

        $this->validator($request->all(), 'users')->validate();
        if($request->gender == "Male") {
            $avatar = 'public/avatar/male.png';
        } elseif($request->gender == "Female") {
            $avatar = 'public/avatar/female.png';
        }

          $user = User::create([
            'ar_name' => $request->name,
            'name' => $request->name, 
            'ar_last_name' => $request->last_name,
            'last_name' => $request->last_name, 
            'email' => $request->email,
            'role_id' => $request->role_id,
            'visit_count' => 1,
            'gender' => $request->gender,
            'ar_gender' => $gender[$request->gender],
            'avatar' => $avatar,
            'password' => Hash::make($request->password),            
        ]);
        
        $user->notify(new WelcomeUser());
        
        $admins = Admin::all();
         Notification::send($admins , new NewCv($user));
         Auth::guard('web')->login($user);
         return redirect()->route('web.mycv' , app()->getLocale());
    }
}
