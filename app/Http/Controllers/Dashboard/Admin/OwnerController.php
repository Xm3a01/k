<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\City;
use App\Role;
use App\Owner;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners = Owner::all();
        $owners->load(['countries','roles']);
        return view('dashboard.admins.owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $cities = City::all();
        $countries = Country::all();

        return view('dashboard.admins.owners.addNewOwner', compact(['roles' , 'cities','countries']));
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
            'email' => 'required|email|unique:owners',
            'password' => 'required|min:8',
            'company_email' => 'required',
            'company_name' => 'required',
            'company_name_en' => 'required',
            'phone' => 'required',
            'logo'  =>  'required|image',
            'city' => 'required',
            'role' => 'required',
            'country' => 'required',
            'ar_name' => 'required|max:255',
             'gender' => 'required',
            ]);

            $gender = [
                'Maile' => 'ذكر',
                'Femaile' => 'انثى',
            ];

            $owner = new Owner();

            $owner->email = $request->email;
            $owner->phone = $request->phone;
            $owner->logo = $request->logo->store('public/company_logo');
            $owner->company_email = $request->company_email;
            $owner->company_name = $request->company_name;
            $owner->company_name_en = $request->company_name_en;
            $owner->password = Hash::make($request->password);
            $owner->ar_name = $request->ar_name;
            $owner->name = $request->ar_name;
            $owner->ar_last_name = $request->ar_last_name;
            $owner->last_name = $request->ar_last_name;
            $owner->ar_gender = $gender[$request->gender];
            $owner->gender = $request->gender;
            $owner->ar_description = $request->ar_description;
            
            $experience->role_id = $request->role_id;
            $experience->country_id = $request->country_id;
            $experience->city_id = $request->city_id;
           

            if($owner->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return redirect()->route('companies.index');
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
        $owner = Owner::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        $roles = Role::all();
        $cities = City::all();
        $countries = Country::all();

        return view('dashboard.admins.owners.owner_edit',
                                      compact(['owner','roles' ,
                                           'cities','countries']));
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

            $gender = [
                'Maile' => 'ذكر',
                'Femaile' => 'انثى',
            ];

            $owner =  Owner::findOrFail($id);
            
            if($request->has('email')) {
            $owner->email = $request->email;
            }
            if($request->has('phone')) {
            $owner->phone = $request->phone;
            }
            if($request->has('company_email')) {
            $owner->company_email = $request->company_email;
            }
            if($request->has('company_name')) {
            $owner->company_name = $request->company_name;
            }
            if($request->has('company_name_en')) {
            $owner->company_name_en = $request->company_name_en;
            }
            if($request->has('ar_name')) {
            $owner->ar_name = $request->ar_name;
            $owner->name = $request->ar_name;
            }
            if($request->has('ar_last_name')) {
            $owner->ar_last_name = $request->ar_last_name;
            $owner->last_name = $request->ar_last_name;
            }
            if($request->has('gender')) {
            $owner->ar_gender = $gender[$request->gender];
            $owner->gender = $request->gender;
            }
            if($request->has('ar_description')) {
            $owner->ar_description = $request->ar_description;
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
            
            if($request->has('password') && $request->password != '') {
                $request->validate([
                    'password' => 'min:8'
                    ]);
               $owner->password = Hash::make($request->password);
            }

            if($request->has('logo')) {
                \Storage::delete($owner->logo);
                $owner->logo = $request->logo->store('public/company_logo');
            }

            if($owner->save()) {
            \Session::flash('success', 'تم التعديل بنجاح');
            return redirect()->route('companies.index');
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
        $owner =  Owner::findOrFail($id);
        \Storage::delete($owner->logo);
        $owner->delete();
        
        \Session::flash('success', 'تم الحذف بنجاح');
        return redirect()->route('companies.index');
    }
}
