<?php

namespace App\Http\Controllers\Browse;


use App\Exp;
use App\Job;
use App\News;
use App\City;
use App\Adv;
use App\Role;
use App\User;
use App\About;
use App\Admin;
use App\Owner;
use App\Country;
use App\Special;
use App\Partener;
use App\SubSpecial;
use Illuminate\Http\Request;
use App\Notifications\CvRequest;
use App\Notifications\ContactNotification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class BrowseController extends Controller
{
    public function home_page()
    {
        $countries = Country::all();
        $sub_specials = SubSpecial::all();
        $owners = Owner::all();
        $roles = Role::latest()->take(8)->get();
        $countries->load('cities');
        $jobs = Job::latest()->take(6)->get();
        $specials = Special::all();
        $cities = City::all();
        $jobs->load('owner','special','sub_special');
        $partner = Partener::all();
        $advs = Adv::latest()->get();
        $news = News::all();

        return view('pages.home',compact(['countries','sub_specials','owners','roles','jobs','specials' , 'cities' , 'partner','advs','news']));
    }

    public function jobSingle($locale , $id)
    {
        $job = Job::findOrFail($id);
        $about = About::latest()->take(1)->first();
        return view('pages.jobsingle' , compact('job' , 'id' ,'about'));

    }

    public function contact()
    {
        $about = About::latest()->take(1)->first(); 

        return view('pages.contact',compact('about'));
    }

    public function search(Request $request)
    {
        if(app()->getLocale() == 'ar') {
            $city = City::where('ar_name',$request->country)->first();
            $country = Country::where('ar_name',$request->country)->first();
            $sub_special = SubSpecial::where('ar_name',$request->special)->first();
        } else {
            $city = City::where('name',$request->country)->first();
            $city = Country::where('name',$request->country)->first();
            $city = SubSpecial::where('name',$request->special)->first();
        }

        
        $jobs = Job::where('city_id' , $city->id ?? '' )->where('selected' ,0)
          ->where('sub_special_id' , $sub_special->id ?? '')->get();

        $Ijobs = Job::where('country_id' , $country->id ?? '' )
           ->where('sub_special_id' , $sub_special->id ?? '')->where('selected' ,0)->get();


            $all = Job::all();
            // return $all;
            $Ijobs->load('owner');
            $jobs->load('owner');
            $one = $request->country;
            $tow = $request->special;
            
            
            
             return view(app()->getLocale() == 'en' ? 'pages.searchjob' : 'pages.ar_searchjob' ,compact(['Ijobs','jobs' , 'one' , 'tow' , 'all']));
        
    }
    
    public function contactSend(Request $request) {
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'email' =>'required',
            'message' => 'required',
            'subject' => 'required'
            ]);
            
            Notification::route('mail', 'Gw_sd@yahoo.co.uk')  //Gw_sd@yahoo.co.uk
             ->notify(new ContactNotification($request));
             
             \Session::flash('success',app()->getLocale() == 'ar' ? 'شكرا لك للتواصل معنا' : 'Thank you for cancat with us');
             return redirect()->route('web.contact' , app()->getLocale());
    } 

    public function category()
    {
        $roles = Role::all();
        $roles->load('specials');
        return view('pages.categories' ,compact('roles'));
    }

    public function byFull()
    {
        $jobs = Job::where('ar_status' , 'دوام كامل')->orWhere('status' , 'Full time')->get();
        $jobs->load('owner');
        return view('pages.byStatus' , compact('jobs'));
    }

    public function byPart()
    {
        $jobs = Job::where('ar_status' , 'دوام جزئ')->orWhere('status' , 'Part time')->get();
        $jobs->load('owner');
        return view('pages.byStatus' , compact('jobs'));
    }

    public function allJob()
    {
        $jobs = Job::where('selected',0)->get();
        $advs = Adv::latest()->get();
        return view('pages.jobs' , compact(['jobs','advs']));
    }
    
    public function showAbout()
    {
        
        $about = About::latest()->first();
        $about->load('employees');
        return view('pages.about' , compact('about'));
    }
    
    public function by_role($locale , $id) {
        $role = Role::findOrFail($id);
        $jobs = Job::where('role_id', $role->id)->where('selected',0)->get();
        
        return view('pages.by_role',compact(['jobs','id']));
    }
    
    
    public function download (Request $request , $id)
    {
      
     if(\Auth::user()->id == $id) {
         
         return \Storage::download($request->f);
     } 
     else {
         \Session::flash('error' , app()->getLocale() == 'ar' ? 'ليس لديك صلاحيه كافيه':'Access deny');
         return back();
     }
  }
    

}
