<?php

namespace App\Http\Controllers\Dashboard\Owner;

use App\Exp;
use App\Job;
use App\City;
use App\Role;
use App\User;
use App\Admin;
use App\Level;
use App\Owner;
use App\Country;
use App\Special;
use App\Princing;
use App\SubSpecial;
use Illuminate\Http\Request;
use App\Notifications\CvRequest; 
use App\Notifications\JobAccept; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OwnerController extends Controller
{

    public $status = [
        'Full time' => 'دوام كامل',
        'Par time' => 'دوام جزئي'
    ];

    public $gender = [
        'Male' => 'ذكر',
        'Female' => 'انثى'
    ];
    
    public function __construct()
    {
        
        $this->middleware(['auth:owner'])->except('jobOwner');
    }
    
    public function index()
    {
        $users = User::where('owner_id', Auth::user()->id)->latest()->take(4)->get();
        $jobs = Job::where('owner_id', Auth::user()->id)->latest()->take(4)->get();
        $sub_specials = SubSpecial::all();
        $specials = Special::all();
        $countries = Country::all();
        $cities = City::all();
        $roles = Role::all();
        if(Auth::user()->visit_count <= 1 && Auth::user()->company_name == '') {
            return view('dashboard.owners.addcompany' , compact(['roles'  , 'countries' , 'cities']));
        } else {
            $jobs->load('owner');
            return view('dashboard.owners.ownerdashboard' , compact(['users' , 'jobs' , 'sub_specials' , 'countries' , 'cities','specials']));
        }
    }

    public function jobOwner()
    {
        $cities = City::all();
        $roles = Role::all();
        $countries = Country::all();
        $users = User::all();
        $sub_specials = SubSpecial::all();
        $specials = Special::all();
        $prices = Princing::latest()->take(2)->get();
        return view('pages.jobowner',compact(['countries' , 'roles','cities','users','sub_specials','specials','prices']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specials = Special::all();
        $sub_specials = SubSpecial::all();
        $countries = Country::all();
        $cities = City::all();
        $roles = Role::all();
        $levels = Level::all();
        $specials = Special::all();

        return view('dashboard.owners.addNewJob',
        compact(['levels','specials' , 'roles' , 'sub_specials' , 'countries' , 'cities']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate ([
            'experinse' => 'required',
            'level' => 'required',
            'role_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'status' => 'required',
            'special_id' => 'required',
            
        ]);
            
            $admins = Admin::all();
            $sender = Auth::user();
            Notification::send($admins , new JobAccept($request , $sender));
    
            \Session::flash('success' , 'تم ارسال طلبك بنجاح وسوف يتم الرد عليك');
            return redirect()->route('owners.index' , app()->getLocale());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function setting($locale , $id)
    {
        $owner = Owner::findOrFail($id);
        $sub_specials = SubSpecial::all();
        $countries = Country::all();
        $cities = City::all();
        $roles = Role::all();
        $levels = Level::all();
        $specials = Special::all();
        $owner->load('jobs');

        return view('dashboard.owners.edit_job', 
         compact(['owner','levels','specials' , 'roles' , 'sub_specials' , 'countries' , 'cities','id']));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale , $id)
    {
        $owner = Owner::findOrFail($id);
        $sub_specials = SubSpecial::all();
        $countries = Country::all();
        $cities = City::all();
        $roles = Role::all();
        $levels = Level::all();
        $specials = Special::all();
        $owner->load('jobs');

        return view('dashboard.owners.edit_owner' , 
         compact(['owner','levels','specials' , 'roles' , 'sub_specials' , 'countries' , 'cities', 'id']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $local ,  $id)
    {
    //    return $request->ar_last_name;
        
        switch ($request->select) {
            case 'account':
               $owner =  Owner::findOrFail($id);

                if($request->has('name')) {
                    $owner->name = $request->name;
                }
                if($request->has('ar_name')) {
                    $owner->ar_name = $request->ar_name;
                }
                if($request->has('last_name')) {
                    $owner->last_name = $request->last_name;
                }
                if($request->has('ar_last_name')) {
                    $owner->ar_last_name = $request->ar_last_name;
                }
                if($request->has('email') && $owner->email != $request->email) {
                    $owner->email = $request->email;
                    $owner->email_verified_at = null;
                }
                if($request->has('gender')) {
                    $owner->ar_gender = $this->gender[$request->gender];
                    $owner->gender = $request->gender;
                }
                if($request->has('password') && $request->password != '') {
                    $request->validate([
                        'password' => 'confirmed|min:8'
                    ]);

                    $owner->password = \Hash::make($request->password);
                
                }

                if($owner->save()) {
                    if($owner->verified_at == null) {
                         \Session::flash('error' ,app()->getLocale() == 'ar' ? 'تم تغير البريد تحتاج التاكد ':' Email changed you must verified It');
                    }
                    \Session::flash('success' , 'Data saved successfully');
                    return redirect()->route('owners.index' , app()->getLocale());
                    }
                break;
            case 'company':
           
                $owner = Owner::findOrFail($id);
        
                if($request->has('company_name')) {
                    $owner->company_name = $request->company_name;
                }
        
                if($request->has('company_email')) {
                    $owner->company_email = $request->company_email;
                }
        
                if($request->has('role_id')) {
                    $owner->role_id = $request->role_id;
                }
        
                if($request->has('country_id')) {
                    $owner->country_id = $request->country_id;
                }
        
                if($request->has('city_id')) {
                    $owner->city_id = $request->city_id;
                }
        
                if($request->has('company_logo')) {
                    \Storage::delete($owner->logo);
                    $owner->logo = $request->company_logo->store('public/company_logo');
                }
        
                if($request->has('ar_description')) {
                    $owner->ar_description = $request->ar_description;
                }
        
                if($request->has('description')) {
                    $owner->description = $request->description;
                }
        
                if($owner->save()) {
                \Session::flash('success' , 'Data saved successfully');
                return redirect()->route('owners.index' , app()->getLocale());
                }
                break;

            case 'job':
                $job = Job::findOrFail($id);
                $job->yearsOfExper = $request->experinse;
                if($request->has('level')) {
                    $job->level = $request->level;
                }

                if($request->has('role_id')) {
                    $job->role_id = $request->role_id;
                }

                if($request->has('country_id')) {
                    $job->country_id = $request->country_id;
                }

                if($request->has('city_id')) {
                    $job->city_id = $request->city_id;
                }

                if($request->has('special_id')) {
                    $job->special_id = $request->special_id;
                }

                if($request->has('sub_special_id')) {
                    $job->sub_special_id = $request->sub_special_id;
                }
                if($request->has('status')) {
                $job->ar_status  = $this->status[$request->status];
                $job->status = $request->status;
                }
                if($request->has('selary')) {
                $job->selary = $request->selary;
                }
                $job->ar_description = $request->ar_description;
                $job->description = $request->description;

                if($job->save()) {
                    \Session::flash('success' ,(app()->getLocale() == 'ar') ? 'تمت الاضافه بنجاح' : 'Data add successfully');
                    return redirect()->route('owners.index' , app()->getLocale());
                }
                break;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request , $local , $id)
    {
        switch ($request->select) {
            case 'delete_job':
                $job = Job::findOrFail($id);
                $job->delete();
                return back();
                
                break;
            
            default:
                # code...
                break;
        }

    }

    public function notify( $local , $id )
    {   
        $user = User::findOrfail($id);
        $admins = Admin::all();
        $sender = Auth::user();
        Notification::send($admins , new CvRequest($user , $sender));

        \Session::flash('success' , 'تم ارسال طلبك بنجاح وسوف يتم الرد عليك');
        return redirect()->route('owners.index' , app()->getLocale());
    }

    public function cvSearch(Request $request)
    {
        if($request->place !='' && $request->special !=''){
        $user = null;
        if(app()->getLocale() == 'ar') {
            $country = country::where('ar_name',$request->place)->first();
            $special = Special::where('ar_name',$request->special)->first();

            $users = User::where('special_id',$special->id)
                ->where('country_id',$country->id)->get();

            $orUsers = Exp::where('special_id',$special->id)
                     ->where('country_id',$country->id)->get();
                     
            $orUsers->load('user');      
            $users->load('exps','educations');
            return view('pages.ar_cvrequest', compact(['users','orUsers']));
        } else {
            $country = country::where('name',$request->place)->first();
            $sub_special = SubSpecial::where('name',$request->special)->first();

            $users = User::where('special_id',$special->id)
                ->where('country_id',$country->id)->get();

            $orUsers = Exp::where('special_id',$special->id)
                     ->where('country_id',$country->id)->get();
            $orUsers->load('user');      
            $users->load('exps','educations');
            return view('pages.cvrequest', compact(['users','orUsers']));
        }
        } else {
            \Session::flash('error','Fied is empty');
            return back();
        }
    }
    
    public function endCv($locale , $id)
    {
       $user = User::findOrFail($id);
       $user->owner_id = null;
       $user->save();
       
       return back();
    }
    
    
}
