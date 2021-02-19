<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function index($locale)
    {
        \Session::put('locale', $locale);
        return redirect()->back();
    }
}
