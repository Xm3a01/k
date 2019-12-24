<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\RegistersUsers;

class OwnerRegisterController extends Controller
{

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('auth.owner_register',compact('roles'));
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:owner');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data ,$table)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.$table],
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

        $this->validator($request->all(), 'owners')->validate();


        if($request->gender == "Male") {
            $avatar = 'public/avatar/male.png';
        } elseif($request->gender == "Female") {
            $avatar = 'public/avatar/female.png';
        }


        $owner = Owner::create([
            'ar_name' => $request->name,
            'name' =>  $request->name,
            'ar_last_name' => $request->last_name,
            'last_name' =>  $request->last_name,
            'email' => $request->email,
            'visit_count' => 1,
            'gender' => $request->gender,
            'ar_gender' => $gender[$request->gender],
            'avatar' => $avatar,
            'password' => Hash::make($request->password),            
        ]);
            
            Auth::guard('owner')->login($owner);
            return redirect()->route('owners.index' , app()->getLocale());
    }
}
