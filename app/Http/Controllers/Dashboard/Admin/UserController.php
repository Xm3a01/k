<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\City;
use App\Guid;
use App\Role;
use App\File;
use App\User;
use App\Level;
use App\Country;
use App\Language;
use App\Reference;
use App\Special;
use App\Education;
use App\SubSpecial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::all();
        $cities = City::all();
        $countries = Country::all();
        $sub_specials = SubSpecial::all();
        $specials = Special::all();
        $levels = Level::all();
        $users->load(['role','city','country','sub_special','level']);
        return view('dashboard.admins.users.index',compact(['roles' , 'cities','countries', 'users', 'sub_specials', 'levels','specials']));
    }

    public function index_edu()
    {
        $educations = Education::all();
        $educations->load('sub_special');
        $roles = Role::all();
        $cities = City::all();
        $countries = Country::all();
        $sub_specials = SubSpecial::all();
        $specials = Special::all();
        $levels = Level::all();
        return view('dashboard.admins.users.education.index',compact(['educations','roles' , 'cities','countries', 'sub_specials', 'levels','specials']));
    }


    public function index_lang()
    {
        
        $languages =Language::all();
        $roles = Role::all();
        $cities = City::all();
        $countries = Country::all();
        $sub_specials = SubSpecial::all();
        $levels = Level::all();
        return view('dashboard.admins.users.language.index',compact(['languages','roles' , 'cities','countries', 'sub_specials', 'levels']));
    }
    
    public function index_ref()
    {
        
        $refs =Reference::all();
        $refs->load('user');
        return view('dashboard.admins.users.ref.index',compact('refs'));
    }
    
    public function index_attch()
    {
        
        $files =File::all();
        $files->load('user');
        // return $files;
        return view('dashboard.admins.users.attch.index',compact('files'));
    }

  
    public function create($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admins.users.language.create',compact('user'));
    }
    
    public function createEdu($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $cities = City::all();
        $countries = Country::all();
        $sub_specials = SubSpecial::all();
        $specials = Special::all();
        $levels = Level::all();
        return view('dashboard.admins.users.education.create',compact(['roles' , 'cities','countries', 'user', 'sub_specials', 'levels','specials']));
    }
    
    public function createRef($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admins.users.ref.create',compact('user'));
    }
    
    public function createAttch($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admins.users.attch.create',compact('user'));
    }
   
   
    public function store(Request $request)
    {
        
        
        $qualification = [
            'Diploma' => 'دبلوم',
           'Bachelor' => 'بكلاريوس',
           'Master' => 'ماجستير',
           'PH' => 'دكتوراة',
        ];
        $social_status = [
            'Married' => 'متزوج',
            'Single' => 'اعزب',
        ];  
        
        $religion = [
            'Muslime' => 'مسلم',
            'Christian' => 'مسيحي',
            'Gushin' => 'يهودي',
            'Other' => 'اخرى'
        ];
        
        $gender = [
            'Male' => 'ذكر',
            'Female' => 'انثى',
            ];
        
        if($request->select == "lang") {

            $language = [
                'Arabic' => 'العربيه',
                'English' => 'الانجليزيه',
            ];
    
            $language_level = [
                'Beginner' => 'مبتدئي',
                'Intermediate' => 'متوسط',
                'Mother tounge' => 'اللغه الاساسيه',
            ];

            $lang = new Language();
            $request->validate([
                'user_id'=>'required',
                'language'=>'required',
                'language_level'=>'required',
                ]);
                $lang->user_id = $request->user_id;
                $lang->ar_language = $request->ar_language;
                $lang->ar_language_level = $language_level[$request->language_level];
                $lang->language = $request->language;
                $lang->language_level = $request->language_level;
                if($lang->save()) {
                    \Session::flash('success', 'تمت الاضافه بنجاح');
                    return Redirect()->route('language.index');
                }
        }
        
        if($request->select == "edu") {
        $request->validate([
            'qualification'=>'required',
            'user_id'=>'required',
            'special_id' =>'required',
            ]);
            $education =new Education();
            $education->user_id = $request->user_id;
            $education->qualification = $request->qualification;
            $education->ar_qualification = $qualification[$request->qualification];
            $education->grade_date = $request->grade_date;
            $education->grade = $request->grade;
            $education->ar_university = $request->ar_university;
            $education->ar_university = $request->university;
            $education->university = $request->university;
            $education->special_id = $request->special_id;
            
        if($education->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return Redirect()->route('education.index',app()->getLocale());
        }
        }
        
        if($request->select == 'ref'){
            
             $request->validate([
                 'ar_name' => 'required',
                 'name' => 'required',
                 'email' => 'required',
                 'phone' => 'required'
            ]);
            
            $ref = Reference::create([
                'user_id' => $request->user_id,
                'ar_name' => $request->ar_name,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                ]);
                
            if($ref->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return Redirect()->route('ref.index');
        }
        }
        
        if($request->select == 'attch'){
             $request->validate([
                 'ar_name' => 'required',
                 'name' => 'required',
                 'attch' => 'required',
            ]);
            
            $file = File::create([
                'user_id' => $request->user_id,
                'ar_name' => $request->ar_name,
                'name' => $request->name,
                ]);
                
                if($request->hasFile('attch')){
                    $f = time().'.'.$request->file('attch')->getClientOriginalExtension();
                    $file->attch = $request->file('attch')->storeAs('public/attchment' , $f);
                }
                
            if($file->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return Redirect()->route('attch.index');
        }
        }

        if($request->select_user == 'user') {
         
        $avatar ='';
        $request->validate([
            'ar_name' =>'required',
            'ar_last_name' =>'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'country_id' => 'required',
            'city_id' =>'required',
            'special_id' =>'required',
            'social_status' => 'required',
            'religion'=>'required'
           ]);
           
           if($request->gender == "Male") {
                $avatar = 'public/avatar/male.png';
            } elseif($request->gender == "Female") {
                $avatar = 'public/avatar/female.png';
            }
            $user = new User();
            $user->ar_name = $request->ar_name;
            $user->ar_last_name = $request->ar_last_name;
            $user->name = $request->ar_name;
            $user->last_name = $request->ar_last_name;
            $user->avatar = $avatar;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->ar_religion = $religion[$request->religion];
            $user->religion = $request->religion;
            $user->social_status = $request->social_status;
            $user->ar_social_status = $social_status[$request->social_status];
            $user->idint_1 = $request->idint_1;
            $user->idint_2 = $request->idint_2;
            $user->birthdate = $request->birthdate;
        
            $user->level = $request->level;
            $user->role_id = $request->role_id;
            $user->country_id = $request->country_id;
            $user->city_id = $request->city_id;
            $user->special_id = $request->special_id;

        if($user->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return Redirect()->route('cv.index');
        }
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        $cities = City::all();
        $countries = Country::all();
        $sub_specials = SubSpecial::all();
        $specials = Special::all();
        return view('dashboard.admins.users.edit', compact(['roles' , 'cities','countries', 'user', 'sub_specials','specials']));
    }

    public function edu_edit($id)
    {
        $education = Education::findOrFail($id);
        $roles = Role::all();
        $cities = City::all();
        $countries = Country::all();
        $sub_specials = SubSpecial::all();
        
        $education->load(['user','sub_special']);
        return view('dashboard.admins.users.education.edit', compact(['education','roles' , 'cities','countries', 'user', 'sub_specials']));
    }

    public function lang_edit($id)
    {
        $language = Language::findOrFail($id);
        $roles = Role::all();
        $cities = City::all();
        $countries = Country::all();
        $sub_specials = SubSpecial::all();
        $specials = Special::all();
        
        $language->load('user');
        return view('dashboard.admins.users.language.edit', compact(['language','roles' , 'cities','countries', 'user', 'sub_specials','specials']));
    }
    
    public function ref_edit($id)
    {
        $ref = Reference::findOrFail($id);
        $ref->load('user');
        return view('dashboard.admins.users.ref.edit', compact('ref'));
    }
    
    public function attch_edit($id)
    {
        $file = File::findOrFail($id);
        $file->load('user');
        return view('dashboard.admins.users.attch.edit', compact('file'));
    }
    
    
    public function update(Request $request, $id)
    {
           $language = [
               'Arabic' => 'العربيه',
               'English' => 'الانجليزيه',
           ];
   
           $language_level = [
               'Beginner' => 'مبتدئي',
               'Intermediate' => 'متوسط',
               'Mother tounge' => 'اللغه الاساسيه',
           ];
   
           $qualification = [
              'Diploma' => 'دبلوم',
              'Bachelor' => 'بكلاريوس',
              'Master' => 'ماجستير',
              'PH' => 'دكتوراة',
           ];
           $social_status = [
               'Married' => 'متزوج',
               'Single' => 'اعزب',
           ];  
           
           $religion = [
               'Muslime' => 'مسلم',
               'Christian' => 'مسيحي',
               'Gushin' => 'يهودي',
               'Other' => 'اخرى'
           ];
   
           if($request->select == "lang") {
            $lang = Language::findOrFail($id);
            if($request->has('language')) {
            $lang->ar_language =$language[$request->language];
            $lang->language = $request->language;
            }
            if($request->has('language_level')) {
            $lang->language_level = $request->language_level;
            $lang->ar_language_level = $language_level[$request->language_level];
            }
            if($lang->save()) {
                \Session::flash('success', 'تمت التعديل بنجاح');
                return Redirect()->route('language.index');
            }
        }


        if($request->select == "edu") {
        $education = Education::findOrFail($id);
        if($request->has('qualification')) {
        $education->qualification = $request->qualification;
        $education->ar_qualification = $qualification[$request->qualification];
        }
        if($request->has('grade_date')) {
        $education->grade_date = $request->grade_date;
        }
        if($request->has('grade')) {
        $education->grade = $request->grade;
        }
        if($request->has('university')) {
        $education->ar_university = $request->university;
        $education->university = $request->university;
        }
        
        if($request->has('special_id')) {
            $education->special_id = $request->sub_special;
        }

        if($education->save()) {
            \Session::flash('success', 'تم لتعديل بنجاح');
            return Redirect()->route('education.index');
        }
        }
        
        if($request->select == "ref") {
            
        $ref = Reference::findOrFail($id);
        if($request->has('ar_name')) {
        $ref->ar_name = $request->ar_name;
        }
        if($request->has('name')) {
        $ref->name = $request->name;
        }
        if($request->has('phone')) {
        $ref->phone = $request->phone;
        }
        if($request->has('email')) {
        $ref->email = $request->email;
        }
        
        if($ref->save()){
            \Session::flash('success', 'تم لتعديل بنجاح');
            return Redirect()->route('ref.index');
        }
        }
        
        if($request->select == "attch") {
            
        $file = File::findOrFail($id);
        if($request->has('ar_name')) {
          $file->ar_name = $request->ar_name;
        }
        if($request->has('name')) {
          $file->name = $request->name;
        }
        if($request->hasFile('attch')){
            $f = time().'.'.$request->file('attch')->getClientOriginalExtension();
            $file->attch = $request->file('attch')->storeAs('public/attchment' , $f);
        }
        if($request->has('email')) {
          $file->email = $request->email;
        }
        
        if($file->save()){
            \Session::flash('success', 'تم لتعديل بنجاح');
            return Redirect()->route('attch.index');
        }
        }

        if($request->select_user == "user_edit") {

        $user =  User::findOrFail($id);
        if($request->has('ar_name')) {
        $user->ar_name = $request->ar_name;
        }
        if($request->has('ar_last_name')) {
        $user->ar_last_name = $request->ar_last_name;
        }
        if($request->has('ar_name')) {
        $user->name = $request->ar_name;
        }
        if($request->has('ar_last_name')) {
        $user->last_name = $request->ar_last_name;
        }
        if($request->has('email')) {
        $user->email = $request->email;
        }
        if($request->has('phone')) {
        $user->phone = $request->phone;
        }
        if($request->has('password') && $request->password !='') {
        $user->password = Hash::make($request->password);
        }
        if($request->has('religion')) {
        $user->ar_religion = $religion[$request->religion];
        }
        if($request->has('religion')) {
        $user->religion = $request->religion;
        }
        if($request->has('social_status')) {
        $user->social_status = $request->social_status;
        $user->ar_social_status = $social_status[$request->social_status];
        }
        if($request->has('idint_1')) {
        $user->idint_1 = $request->idint_1;
        }
        if($request->has('idint_2')) {
        $user->idint_2 = $request->idint_2;
        }
        if($request->has('birthdate')) {
        $user->birthdate = $request->birthdate;
        }
        
        if($request->has('level')) {
            $user->level = $request->level;
        }
        if($request->has('role_id')) {
            $user->role_id = $request->role_id;
        }
        if($request->has('birth_country_id')) {
            $country = Country::findOrFail($request->birth_country_id);
            $user->ar_brith = $country->ar_name;
            $user->brith = $country->name;
        }
        if($request->has('country_id')) {
            $user->country_id = $request->country_id;
        }
        if($request->has('city_id')) {
            $user->city_id = $request->city_id;
        }
        if($request->has('special_id')) {
            $user->special_id = $request->special_id;
        }
        if($request->has('sub_special_id')) {
            $user->sub_special_id = $request->sub_special_id;
        }

        if($user->save()) {
            \Session::flash('success', 'تمت التعديل بنجاح');
            return Redirect()->route('cv.index' ,app()->getLocale());
        }
     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->select == "delete"){
            $education = Education::findOrFail($id);
            $education->delete();
            \Session::flash('success' , 'تم الحذف');
            return Redirect()->route('education.index');
        }

        if($request->select == "lang-delete"){
            $language = Language::findOrFail($id);
            $language->delete();
            \Session::flash('success' , 'تم الحذف');
            return Redirect()->route('language.index');
        }
        
        if($request->select == "ref-delete"){
            $ref = Reference::findOrFail($id);
            $ref->delete();
            \Session::flash('success' , 'تم الحذف');
            return Redirect()->route('ref.index');
        }
        
        if($request->select == "attch-delete"){
            $file = File::findOrFail($id);
            \Storage::url($file->attch);
            $file->delete();
            \Session::flash('success' , 'تم الحذف');
            return Redirect()->route('attch.index');
        }

        $user = User::findOrFail($id);
        $user->delete();

        \Session::flash('success', 'تم الحذف  بنجاح');
        return Redirect()->route('cv.index');

    }
    
    public function guid() {
        
        // $guid = Guid::latest()->first();
        // return view('dashboard.users.guid' , compact('guid'));

    }
}
