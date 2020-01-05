<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Exp;
use App\Country;
use App\Role;
use App\User;
use App\Level;
use App\Special;
use App\SubSpecial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiences = Exp::paginate(10);
        $roles = Role::all();
        $users = User::all();
        $levels = Level::all();
        $sub_specials =  SubSpecial::all();
        $specials =  Special::all();
        $experiences->load(['user','role','sub_special','country','level']);
        
        return view('dashboard.admins.users.experience.index' , compact(['experiences','levels','roles','sub_specials','users','specials']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::findOrFail($id);
         $roles = Role::all();
        $users = User::all();
        $levels = Level::all();
        $specials =  Special::all();
        $sub_specials =  SubSpecial::all();
        $countries = Country::all();

        return view('dashboard.admins.users.experience.create' , compact(['experiences','levels','roles','sub_specials','user','countries','specials']));
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
            'user_id' => 'required',
            'role_id' => 'required',
            'special_id' => 'required',
            'country_id' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
            'start_month' => 'required',
            'end_month' => 'required',
            'ar_description' => 'required',
        ]);

        $experience = new Exp();

        $experience->user_id = $request->user_id;
        $experience->expert_year += abs($request->start_year - $request->end_year);
        $experience->expert_month += abs($request->start_month - $request->end_month);
        $experience->company_name = $request->company_name;
        $experience->start_month = $request->start_month;
        $experience->start_year = $request->start_year;
        $experience->end_year = $request->end_year;
        $experience->end_month = $request->end_month;
        $experience->ar_summary = $request->ar_description;
        $experience->level = $request->level;
        $experience->role_id = $request->role_id;
        $experience->country_id = $request->country_id;
        $experience->city_id = $request->city_id;
        $experience->special_id = $request->special_id;
            
        if($request->has('expert_pdf')){
        $experience->expert_pdf = $request->expert_pdf->store('public/expert_cv');
        }

        if($experience->save()) {
            \Session::flash('success','تمت الاضافه بنجاح');
            return Redirect()->route('experiences.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $experience = Exp::findOrFail($id);
        $roles = Role::all();
        $users = User::all();
        $levels = Level::all();
        $sub_specials =  SubSpecial::all();
        $specials =  Special::all();
        $countries = Country::all();

        return view('dashboard.admins.users.experience.edit' , compact(['countries','experience','levels','roles','sub_specials','users','specials']));
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
        $experience = Exp::findOrFail($id);

        if($request->has('comany_name')) {

            $experience->company_name = $request->comany_name;
        }
        if($request->has('start_year') && $request->has('end_year')) {
            $experience->expert_year += abs($request->start_year - $request->end_year);
        }
        if($request->has('start_month') && $request->has('end_month')) {
            $experience->expert_month += abs($request->start_month - $request->end_month);

        }
         if($request->has('start_month')) {
                
            $experience->start_month = $request->start_month;
        }
        if($request->has('start_year')) {

            $experience->start_year = $request->start_year;
        }
        if($request->has('end_year')) {

            $experience->end_year = $request->end_year;
        }
        if($request->has('end_month')) {
            
            $experience->end_month = $request->end_month;
        }
        if($request->has('ar_description')) {

            $experience->ar_summary = $request->ar_description;
        }
        
        if($request->has('level')){
            $experience->level = $request->level;
        }
        
        if($request->has('role_id')){
            $experience->role_id = $request->role_id;
        }
        
        if($request->has('ar_description'))
        $experience->country_id = $request->country_id;
        
        if($request->has('city_id')){
            $experience->city_id = $request->city_id;
        }
        
        if($request->has('special_id')){
            $experience->special_id = $request->special_id;
        }
            
        if($request->has('expert_pdf')){
            \Storage::delete($experience->expert_pdf);
             $experience->expert_pdf = $request->expert_pdf->store('public/expert_cv');
        }

        if($experience->save()) {
            \Session::flash('success','تم التعديل بنجاح');
            return Redirect()->route('experiences.index');
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
        $experience = Exp::findOrFail($id);
        \Storage::url($experience->expert_pdf);
        $experience->delete();

        \Session::flash('success','تم الحذف بنجاح');
        return Redirect()->route('experiences.index');
    }
}
