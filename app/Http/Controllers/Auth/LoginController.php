<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo() {
        return redirect()->route('web.mycv' ,app()->getLocale() );
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('guest')->except(['userLogout']);
        
    }

    protected function guard()
    {
        return \Auth::guard('web');
    }
    
    public function login(Request $request)
    {  
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $data =[
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::guard('web')->attempt($data , $request->remember)) {
            $user = User::findOrFail(Auth::user()->id);
            $user->save();
            return \redirect()->intended(route('web.mycv',app()->getLocale()));
        } else {
            \Session::flash('error' , 'البريد او كلمة المرور غير صحيحه');
            return \redirect()->back()->withInput($request->only('email' , 'remember'));
        }
    }

    public function userLogout()
    {
        Auth::guard('web')->logout();

        return  redirect(app()->getLocale().'/login');
    }
}
