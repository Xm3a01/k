<?php

namespace App\Http\Controllers\Auth;

use App\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OwnerLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:owner')->except('ownerLogout');
    }


    protected function guard()
    {
        return \Auth::guard('owner');
    }

    public function showLoginForm()
    {
        return view('auth.owner_login');
    }

    public function redirectTo() {
        return redirect()->route('owners.index' ,app()->getLocale() );
    }

    public function ownerLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $data =[
            'email' => $request->email,
            'password' => $request->password
        ];

        $owner = Owner::where('email','=',$data['email'])->first();
        if(Auth::guard('owner')->attempt($data , $request->remember)) {
            $owner->visit_count +=1;
            $owner->save();
            return \redirect()->intended(route('owners.index', app()->getLocale()));
        } else {
            \Session::flash('error' , 'Email Or Password not currect');
            return \redirect()->back()->withInput($request->only('email' , 'remember'));
        }
    }

    public function ownerLogout()
    {
        Auth::guard('owner')->logout();

        return  redirect()->route('owners.index' , app()->getLocale());
    }
}



