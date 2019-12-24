<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth;

class OwnerResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


    public function showResetForm(Request $request , $locale , $token = null)
    {
        app()->setLocale($locale);
        return view('auth.passwords.reset-owner')->with(
            ['locale' => $locale ,'token' => $token, 'email' => $request->email]
        );
    }
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected function redirectTo() {
      return app()->getLocale().'/owners';
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

    protected function guard()
    {
      return Auth::guard('owner');
    }

    protected function broker()
    {
      return Password::broker('owners');
    }
}
