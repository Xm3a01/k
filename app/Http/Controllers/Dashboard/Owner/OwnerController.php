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
        $countries = Country::all();
        $cities = City::all();
        $roles = Role::all();

        if(Auth::user()->visit_count == 1 && Auth::user()->company_name == '') {
            return view('dashboard.owners.addcompany' , compact(['roles'  , 'countries' , 'cities']));
        } else {
            $jobs->load('owner');
            return view('dashboard.owners.ownerdashboard' , compact(['users' , 'jobs' , 'sub_specials' , 'countries' , 'cities']));
        }
    }

    public function jobOwner()
    {
        $cities = City::all();
        $roles = Role::all();
        $countries = Country::all();
        $users = User::all();
        $sub_specials = SubSpecial::all();
        return view('pages.jobowner',compact(['countries' , 'roles','cities','users','sub_specials']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_specials = SubSpecial::all();
        $countries = Country::all();
        $cities = City::all();
        $roles = Role::all();
        $levels = Level::all();
        $specials = Special::all();

        return view('dashboard.owners.addNewJob' , 
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
            'role' => 'required',
            'country' => 'required',
            'city' => 'required',
            'status' => 'required',
            'special' => 'required'
            
        ]);
            
            $admins = Admin::all();
            $sender = Auth::user();
            Notification::send($admins , new JobAccept($request , $sender));
    
            \Session::flash('success' , 'تم ارسال طلبك بنجاح وسوف يتم الرد عليك');
            return redirect()->route('owners.index' , app()->getLocale());

            $job = new Job();

            $job->owner_id = Auth::user()->id;
            $job->yearsOfExper = $request->experinse;
            $level = Level::where('ar_name', $request->level)->orWhere('name' , $request->level)->first();
            if($level) {
                $job->ar_level = $level->ar_name;
                $job->level = $level->name;
            } else {
                $job->ar_level = $request->level;
                $job->level = $request->level;
            }

            $role = Role::where('ar_name', $request->role)->orWhere('name' , $request->role)->first();
            if($role) {
                $job->ar_role = $role->ar_name;
                $job->role = $role->name;
            } else {
                $job->ar_role = $request->role;
                $job->role = $request->role;
            }

            $country = Country::where('ar_name', $request->country)->orWhere('name' , $request->country)->first();
            if($country) {
                $job->ar_country = $country->ar_name;
                $job->country = $country->name;
            } else {
                $job->ar_country = $request->country;
                $job->country = $request->country;
            }

            $city = City::where('ar_name', $request->city)->orWhere('name' , $request->city)->first();
            if($city) {
                $job->ar_city = $city->ar_name;
                $job->city = $city->name;
            } else {
                $job->ar_city = $request->city;
                $job->city = $request->city;
            }

            $special = Special::where('ar_name', $request->special)->orWhere('name' , $request->special)->first();
            if($special) {
                $job->ar_special = $special->ar_name;
                $job->special = $special->name;
            } else {
                $job->ar_special = $request->special;
                $job->special = $request->special;
            }

            $sub_special = SubSpecial::where('ar_name', $request->sub_special)->orWhere('name' , $request->sub_special)->first();
            if($sub_special) {
                $job->ar_sub_special = $sub_special->ar_name;
                $job->sub_special = $sub_special->name;
            } else {
                $job->ar_sub_special= $request->sub_special;
                $job->sub_special = $request->sub_special;
            }

            $job->ar_status  = $this->status[$request->status];
            $job->status = $request->status;
            $job->selary = $request->selary;
            $job->ar_description = $request->ar_description;
            $job->description = $request->description;

            if($job->save()) {
                \Session::flash('success' ,(app()->getLocale() == 'ar') ? 'تمت الاضافه بنجاح' : 'Data add successfully');
                return redirect()->route('owners.index' , app()->getLocale());
            }

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
        
                if($request->has('role')) {
                    $role = Role::where('ar_name', $request->role)->orWhere('name' , $request->role)->first();
                    if($role) {
                        $owner->ar_role = $role->ar_name;
                        $owner->role = $role->name;
                    } else {
                        $owner->ar_role = $request->role;
                        $owner->role = $request->role;
                    }
                }
        
                if($request->has('country')) {
                    $country = Country::where('ar_name', $request->country)->orWhere('name' , $request->country)->first();
                    if($country) {
                        $owner->ar_country = $country->ar_name;
                        $owner->country = $country->name;
                    } else {
                        $owner->ar_country = $request->country;
                        $owner->country = $request->country;
                    }
                }
        
                if($request->has('city')) {
                    $city = City::where('ar_name', $request->city)->orWhere('name' , $request->city)->first();
                    if($city) {
                        $owner->ar_city = $city->ar_name;
                        $owner->city = $city->name;
                    } else {
                        $owner->ar_city = $request->city;
                        $owner->city = $request->city;
                    }
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
                $level = Level::where('ar_name', $request->level)->orWhere('name' , $request->level)->first();
                if($level) {
                    $job->ar_level = $level->ar_name;
                    $job->level = $level->name;
                } else {
                    $job->ar_level = $request->level;
                    $job->level = $request->level;
                }

                $role = Role::where('ar_name', $request->role)->orWhere('name' , $request->role)->first();
                if($role) {
                    $job->ar_role = $role->ar_name;
                    $job->role = $role->name;
                } else {
                    $job->ar_role = $request->role;
                    $job->role = $request->role;
                }

                $country = Country::where('ar_name', $request->country)->orWhere('name' , $request->country)->first();
                if($country) {
                    $job->ar_country = $country->ar_name;
                    $job->country = $country->name;
                } else {
                    $job->ar_country = $request->country;
                    $job->country = $request->country;
                }

                $city = City::where('ar_name', $request->city)->orWhere('name' , $request->city)->first();
                if($city) {
                    $job->ar_city = $city->ar_name;
                    $job->city = $city->name;
                } else {
                    $job->ar_city = $request->city;
                    $job->city = $request->city;
                }

                $special = Special::where('ar_name', $request->special)->orWhere('name' , $request->special)->first();
                if($special) {
                    $job->ar_special = $special->ar_name;
                    $job->special = $special->name;
                } else {
                    $job->ar_special = $request->special;
                    $job->special = $request->special;
                }

                $sub_special = SubSpecial::where('ar_name', $request->sub_special)->orWhere('name' , $request->sub_special)->first();
                if($sub_special) {
                    $job->ar_sub_special = $sub_special->ar_name;
                    $job->sub_special = $sub_special->name;
                } else {
                    $job->ar_sub_special= $request->sub_special;
                    $job->sub_special = $request->sub_special;
                }

                $job->ar_status  = $this->status[$request->status];
                $job->status = $request->status;
                $job->selary = $request->selary;
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
            $users = User::where('ar_country',$request->place)
                 ->where('ar_sub_special',$request->special)->get();

            $orUsers = Exp::where('ar_country' , $request->place)
                 ->where('ar_sub_special' , $request->special) ->get();
            $orUsers->load('user');      
            $users->load('exps','educations');
            return view('pages.ar_cvrequest', compact(['users','orUsers']));
        } else {
            $users = User::where('sub_special', $request->special)
                ->where('country',$request->place)->get();

            $orUsers = Exp::where('country' , $request->place)
                ->where('sub_special' , $request->special) ->get();
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
