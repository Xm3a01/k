<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Job;
use App\Level;
use App\City;
use App\Role;
use App\Owner;
use App\Country;
use App\Special;
use App\SubSpecial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        
        $jobs->load(['owner','sub_specials','levels','cities']);

        return view('dashboard.admins.owners.jobs',compact('jobs'));
    }

    public function create($id)
    {
        $owner = "";
        
        if(Owner::findOrfail($id)) {

            $owner = Owner::findOrfail($id);
        } else {
            return "يجب اضافة صاحب عمل";
        }

        $roles = Role::all();
        $specials = Special::all();
        $sub_specials = SubSpecial::all();
        $countries = Country::all();
        $cities = City::all();
        $levels = Level::all();

        return view('dashboard.admins.owners.addNewJob',
            compact(['owner','specials',
                'sub_specials','roles',
                     'countries', 'cities','levels']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required',
            'city' => 'required',
            'role' => 'required',
            'country' => 'required', 
            'special' => 'required',
            'status' => 'required'
            ]);

            $status = [
                'Full time' => 'دوام كامل',
                'Part time' => 'دوام جزئي',
            ];
           
            $job = new Job();
            
            // $owner = Owner::findOrFail($request->owner_id);
            // $job->company_name = $owner->company_name;
            $job->selary = $request->selary;
            $job->owner_id = $request->owner_id;
            $job->yearsOfExper = $request->experinse;
            $job->ar_status = $status[$request->status];
            $job->status = $request->status;
            $job->ar_description = $request->ar_description;
            $job->description = $request->description;
            
            $job->level_id = $request->level_id;
            $job->role_id = $request->role_id;
            $job->country_id = $request->country_id;
            $job->city_id = $request->city_id;
            $job->special_id = $request->special_id;
            $job->sub_special_id = $request->sub_special_id;
        
             if($job->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return redirect()->route('jobs.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::findOrFail($id);

        $roles = Role::all();
        $specials = Special::all();
        $sub_specials = SubSpecial::all();
        $countries = Country::all();
        $cities = City::all();
        $levels = Level::all();

        return view('dashboard.admins.owners.job_edit',
            compact(['job','specials',
                'sub_specials','roles',
                     'countries', 'cities','levels']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $status = [
                'Full time' => 'دوام كامل',
                'Part time' => 'دوام جزئي',
            ];

            $job = Job::findOrFail($id);
            
            if($request->has('level_id')) {
            $job->level_id = $request->level_id;
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

            if($request->has('selary')) {

                $job->selary = $request->selary;
            }
            if($request->has('experinse')) {

                $job->yearsOfExper = $request->experinse;
            }
            if($request->has('status') && $request->status !='') {

                $job->ar_status = $status[$request->status];
                $job->status = $request->status;
            }
            if($request->has('ar_description')) {

                $job->ar_description = $request->ar_description;
            }
             if($request->has('description')) {

                $job->description = $request->description;
            }
        
             if($job->save()) {
            \Session::flash('success', 'تم التعديل بنجاح');
            return redirect()->route('jobs.index');
             }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job =  Job::findOrFail($id);
        $job->delete();
        
        \Session::flash('success', 'تم الحذف بنجاح');
        return redirect()->route('jobs.index');
    }
}
