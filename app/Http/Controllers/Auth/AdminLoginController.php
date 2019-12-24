<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{

    // use AuthenticatesUsers;

    public function __construct()
    {
        if(Auth::guard('owner')->check()) {
            return \redirect()->route('owners.index' ,app()->getLocale());
        } else { 
        $this->middleware('guest:admin')->except('logout');
        }
    }

    protected function guard()
    {
        return \Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

        public function redirectTo() {

            return redirect()->route('admin.dashboard' , app()->getLocale());
        } 
    

    public function adminLogin(Request $request)
    {  
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $data =[
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::guard('admin')->attempt($data , $request->remember)) {
            return \redirect()->route('admin.dashboard');
        } else {
            \Session::flash('error' , 'البريد او كلمة المرور غير صحيحه');
            return \redirect()->back()->withInput($request->only('email' , 'remember'));
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return  redirect('admins/login');
    }
}


