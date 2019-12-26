<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Admin;
use App\File;
use App\Guid;
use App\Exp;
use App\Job;
use App\City;
use App\Role;
use App\User;
use App\About;
use App\Level;
use App\Owner;
use App\Country;
use App\Reference;
use App\Language;
use App\Education;
use App\SubSpecial;
use Illuminate\Http\Request;
use App\Notifications\ApllyJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public $social_status = [
        'Married' => 'متزوج',
        'Single' => 'اعزب',
    ];  
    
    public $religion = [
        'Muslime' => 'مسلم',
        'Christian' => 'مسيحي',
        'Gushin' => 'يهودي',
        'Other' => 'اخرى'
    ];
    public $gender = [
        'Male' => 'ذكر',
        'Female' => 'انثى'
    ];

    public $qualification = [
        'Diploma' => 'دبلوم',
        'Bachelor' => 'بكلاريوس',
        'Master' => 'ماجستير',
        'PH' => 'دكتوراة',
     ];

     public $language = [
        'Arabic' => 'العربيه',
        'English' => 'الانجليزيه',
    ];

    public $language_level = [
        'Beginner' => 'مبتدئي',
        'Intermediate' => 'متوسط',
        'Fluent' => 'طلق اللسان',
        'Mother tounge' => 'اللغه الاساسيه',
    ];


    public function __construct() {
        $this->middleware(['auth:web']);
    }

    public function index()
    {
        $guid = Guid::latest()->take(1)->first();
        $expert = '';
    if(Auth::guard('web')->check()) {
        $user = User::findOrFail(Auth::user()->id);
        $user->load(['exps','educations' , 'languages' , 'files','references']);
        $expert = Exp::where('user_id' , $user->id)->first();
        if(!is_null($expert)) {
        $jobs = Job::where('country_id',$user->country_id)->where('selected',0)->orWhere('role_id', $user->role_id)->orWhere('role_id', $expert->role_id)->orWhere('country_id', $expert->country_id)->get();
        } else {
          $jobs = Job::where('country_id',$user->country_id)->where('selected',0)->orWhere('role_id', $user->role_id)->get();
        }
         
        if($user->visit_count <= 1) {
            $about = About::latest()->take(1)->first();
            $cities = City::all();
            $sub_specials = SubSpecial::all();
            $levels = Level::all();
            $roles = Role::all();
            $countries = Country::all();
           return view('dashboard.users.add_new_cv',compact(['about','user' , 'cities','countries','sub_specials','levels','roles']));
        } else {
            return view('dashboard.users.account_result',compact(['jobs','user','guid']));
        }
    }
    }

    public function myCv()
    {
        if(Auth::guard('web')->check()) {
        $user = User::findOrFail(Auth::user()->id);
        $user->load(['exps','educations.sub_special' , 'languages' , 'files','references','role','city','country','sub_special','level']);
        // dd( $user->educations);
        $expert = Exp::where('user_id', $user->id)->first();
        $education = Education::where('user_id', $user->id)->first();
        $language = Language::where('user_id', $user->id)->first();
        $ref = Reference::where('user_id', $user->id)->first();
        $file = File::where('user_id', $user->id)->first();
        $cities = City::all();
        $sub_specials = SubSpecial::all();
        $levels = Level::all();
        $roles = Role::all();
        $jobs = Job::where('role_id', $user->role_id)->where('selected',0)->orWhere('country_id',$user->country_id)->get();
        $countries = Country::all();
        $count =  $this->pcount('users' ,'User', $user->id);
        $count =  25;
        
        if(!is_null($expert) || !is_null($education) || !is_null($language)) {
        $expcount =  $this->pcount('exps' ,'Exp', $expert->id ?? '');
        $educount =  $this->pcount('education' ,'Education', $education->id ?? '');
        $langcount =  $this->pcount('languages' , 'Language' , $language->id ?? '' );
        // $refcount =  $this->pcount('references' , 'Reference' , $ref->id ?? '' );
        $filecount =  $this->pcount('files' , 'File' , $file->id ?? '' );
        
        //return $count + $expcount;

        if($expcount != null){
           $count =  $count + 30;
        } if(!is_null($educount)) {
            $count =  $count + 15;
        } if($langcount  != null) {
            $count =  $count + 15;
        }
        // if($refcount  != null) {
        //     $count =  $count + 15;
        // } 
        if($filecount  != null) {
            $count =  $count + 15;
        }
        // return $x;
        
        // $count = abs($count + ($expcount ?? '' + $educount ?? '' + $langcount ?? '' ) -  $x);
        }
        if($user->visit_count <= 1) {
           $about = About::latest()->take(1)->first();
            $cities = City::all();
            $sub_specials = SubSpecial::all();
            $levels = Level::all();
            $roles = Role::all();
            $countries = Country::all();
           return view('dashboard.users.add_new_cv',compact(['about','user' , 'cities','countries','sub_specials','levels','roles']));
        } else {
            return view('dashboard.users.my_cv' , compact(['user','result', 'count' , 'cities','countries','sub_specials','levels','roles','expert']));
        }} else {
            return redirect()->route('login' ,app()->getLocale());
        }
    }

    public function store(Request $request)
    {
        switch ($request->select) {
          case 'add_edu':
              $request->validate([
                'user_id' => 'required',
                'qualification' => 'required',
                'grade_date' => 'required',
                'grade' => 'required',
                'ar_university' => 'required',
                'university' => 'required',
                'sub_special_id' => 'required'
            ]);

            $edu = Education::create([
                'user_id' => $request->user_id,
                'grade_date' => $request->grade_date,
                'grade' => $request->grade,
                'ar_university' =>$request->ar_university,
                'university' => $request->university,
                'sub_special_id' => $request->sub_special_id,
                'ar_qualification' => $this->qualification[$request->qualification],
                'qualification' => $request->qualification,
            ]);

            if($edu->save()) {
                if(app()->getLocale() == 'ar') {
                   \Session::flash('success' , 'تم الحفظ بنجاح');
                } else {
                 \Session::flash('success' , ' Data saved successfully');
                }
                return redirect()->route('web.mycv',app()->getLocale());
             }

                break;
                
         case 'lang':
             $request->validate([
                'language' => 'required',
                'language_level' => 'required',
                ]);
        
                $lang =  Language::create([
                    
                    'user_id' => \Auth::user()->id,
                    'language'=>$request->language,
                    'ar_language' => $request->ar_language,
                    'language_level' => $request->language_level,
                    'ar_language_level' => $this->language_level[$request->language_level],
                    
                ]);
                
                
                
                
                if($request->has('language') && $request->language !='') {
                    $lang->language = $request->language;
                    $lang->ar_language = $request->ar_language;
                }
        
                if($request->has('language_level') && $request->language_level !='' ) {
                    $lang->language_level = $request->language_level;
                    $lang->ar_language_level = $this->language_level[$request->language_level];
                }
                
                if($lang->save()){
                if(app()->getLocale() == 'ar') {
                    \Session::flash('success' , 'تم الحفظ بنجاح');
                 } else {
                  \Session::flash('success' , ' Data saved successfully');
                 }
                 return redirect()->route('web.mycv',app()->getLocale());
            }
                    
                break;
                
                case 'attch':
                    $request->validate([
                        'ar_name'=>'required',
                        'name'=> 'required',
                        'attch' => 'required'
                        ]);
                        
                        $file= new File();
                        $file->user_id = $request->user_id;
                        $file->ar_name = $request->ar_name;
                        $file->name = $request->name;
                        if($request->hasFile('attch')){
                        $f = time().'.'.$request->file('attch')->getClientOriginalExtension();
                        $file->attch = $request->file('attch')->storeAs('public/attchment' , $f);
                        }
                        
                        if($file->save()){
                            \Session::flash('success', app()->getLocale() == 'ar' ? 'تمت الاضافه بنجاح':'Add successflly');
                            return redirect()->route('web.mycv',app()->getLocale());
                        }
                    break;
                    
                    case 'ref':
                    $request->validate([
                        'ar_name'=>'required',
                        'name'=> 'required',
                        'phone' => 'required',
                        'email' => 'required|email',
                        
                        ]);
                        
                        $ref= new Reference();
                        $ref->user_id = $request->user_id;
                        $ref->ar_name = $request->ar_name;
                        $ref->name = $request->name;
                        $ref->phone = $request->phone;
                        $ref->email = $request->email;
                        
                        
                        if($ref->save()){
                            \Session::flash('success', app()->getLocale() == 'ar' ? 'تمت الاضافه بنجاح':'Add successflly');
                            return redirect()->route('web.mycv',app()->getLocale());
                        }
                    break;
            
          default:
                $request->validate([
                    'role_id' => 'required',
                    'sub_special_id' => 'required',
                    'level_id' => 'required',
                    'country_id' => 'required',
                    'cert_pdf' => 'required',
                    'start_year' => 'required|int',
                    'start_month' => 'required|int',
                    'end_year' => 'required|int',
                    'end_month' => 'required|int',
                    'company_name' => 'required'
                ]);
    
             $expert = new Exp();
             $expert->user_id = Auth::user()->id;
             if($request->hasFile('cert_pdf')) {
                $f = time().'.'.$request->file('cert_pdf')->getClientOriginalExtension();
                $expert->expert_pdf = $request->file('cert_pdf')->storeAs('public/certificate' , $f);
                // $expert->expert_pdf = $request->cert_pdf->store('public/certificate');
            }
            $expert->expert_year += abs($request->start_year - $request->end_year);
            $expert->expert_month += abs($request->start_month - $request->end_month);

            if($request->has('summary') || $request->has('summary')) {
                $expert->summary = $request->summary;
                $expert->ar_summary = $request->ar_summary;
            }
            if($request->has('start_year')){
                $expert->start_year = $request->start_year;
            }
            if($request->has('company_name')){
                $expert->company_name = $request->company_name;
            }
            if($request->has('start_month')){
                $expert->start_month = $request->start_month;
            }
            if($request->has('end_year')){
                $expert->end_year = $request->end_year;
            }
            if($request->has('end_month')){
                $expert->end_month = $request->end_month;
            }
            
            $expert->country_id = $request->country_id;
            $expert->role_id = $request->role_id;
            $expert->level_id = $request->level_id;
            $expert->sub_special_id = $request->sub_special_id;
            
        if($expert->save()) {
            if(app()->getLocale() == 'ar') {
               \Session::flash('success' , 'تم الحفظ بنجاح');
            } else {
             \Session::flash('success' , ' Data saved successfully');
            }
            return redirect()->route('web.mycv',app()->getLocale());
         }
                break;
        }


    }
   
    public function edit($locale , $id)
    {
        $education = Education::findOrFail($id);
        $sub_specials = SubSpecial::all();

        return view('dashboard.users.education_edit', compact(['education','id','sub_specials']));
    }

    public function exp_edit($id , $locale)
    {
        $id = $locale;
           $expert = Exp::findOrFail($id);
           $cities = City::all();
            $sub_specials = SubSpecial::all();
            $levels = Level::all();
            $roles = Role::all();
            $countries = Country::all();

        return view('dashboard.users.experiense_edit', compact('expert','id' , 'cities','countries','sub_specials','levels','roles'));
    }
    
    public function lang_edit($locale , $id)
    {
        $lang = Language::findOrFail($id);

        return view('dashboard.users.language_edit', compact('lang','id'));
    }
    
    public function attch_edit($locale , $id)
    {
        $attch = File::findOrFail($id);

        return view('dashboard.users.attch_edit', compact('attch','id'));
    }
    
    public function ref_edit($locale , $id)
    {
        $ref = Reference::findOrFail($id);

        return view('dashboard.users.ref_edit', compact('ref','id'));
    }


   
    public function update(Request $request, $locale, $id)
    {

        if($request->has('expert_form')) {
                $request->validate([
                    'role_id' => 'required',
                    'sub_special_id' => 'required',
                    'level_id' => 'required',
                    'country_id' => 'required',
                    'cert_pdf' => 'required',
                    'start_month' => 'required|int',
                    'end_year' => 'required|int',
                    'end_month' => 'required|int',
                    'start_year' => 'required|int'
                ]);
        $expert = Exp::findOrFail($id);
        if($request->hasFile('cert_pdf')) {
             \Storage::delete($expert->expert_pdf);
                $f = time().'.'.$request->file('cert_pdf')->getClientOriginalExtension();
                $expert->expert_pdf = $request->file('cert_pdf')->storeAs('public/certificate' , $f);
            }
        $expert->expert_year += abs($request->start_year - $request->end_year);
        $expert->expert_month += abs($request->start_month - $request->end_month);

        if($request->has('summary') || $request->has('summary')) {
            $expert->summary = $request->summary;
            $expert->ar_summary = $request->ar_summary;
        }
        if($request->has('start_year')){
            $expert->start_year = $request->start_year;
        }
        if($request->has('company_name')){
            $expert->company_name = $request->company_name;
        }
        if($request->has('start_month')){
            $expert->start_month = $request->start_month;
        }
        if($request->has('end_year')){
            $expert->end_year = $request->end_year;
        }
        if($request->has('end_month')){
            $expert->end_month = $request->end_month;
        }

        if($request->has('level_id')) {
            $expert->level_id = $request->level_id;
         }
        

         if($request->has('country_id')){
             $expert->country_id = $request->country_id;
         }
         if($request->has('role_id')){
             $expert->role_id = $request->role_id;
         }
         if($request->has('sub_special_id')){
             $expert->sub_special_id = $request->sub_special_id;
         }
    
         //end experince
    if($expert->save()) {
       if(app()->getLocale() == 'ar') {
          \Session::flash('success' , 'تم الحفظ بنجاح');
       } else {
        \Session::flash('success' , ' Data saved successfully');
       }
    }
}

    

    if($request->select == 'edu_form') {

    $edu = Education::findOrFail($id);

    if($request->has('qualification') && $request->qualification !='') {
        $edu->qualification = $request->qualification;
        $edu->ar_qualification = $this->qualification[$request->qualification];
    } 
    if($request->has('university')) {
        $edu->university = $request->university;
    }

    if($request->has('ar_university')) {
        $edu->ar_university = $request->ar_university;
    }

    if($request->has('grade_date')) {
        $edu->grade_date = $request->grade_date;
    }

    if($request->has('grade')) {
        $edu->grade = $request->grade;
    }
    
        if($request->has('sub_special_id')){
            $edu->sub_special_id = $request->sub_special_id;
        }

    if($edu->save()){
        if(app()->getLocale() == 'ar') {
            \Session::flash('success' , 'تم الحفظ بنجاح');
         } else {
          \Session::flash('success' , ' Data saved successfully');
         }
    }
    }
    
    if($request->select == 'lang') {
        
        $lang = Language::findOrFail($id);
        
        if($request->has('language') && $request->language !='') {
            $lang->language = $request->language;
            $lang->ar_language = $this->language[$request->language];
        }

        if($request->has('language_level') && $request->language_level !='' ) {
            $lang->language_level = $request->language_level;
            $lang->ar_language_level = $this->language_level[$request->language_level];
        }
        
        if($lang->save()){
        if(app()->getLocale() == 'ar') {
            \Session::flash('success' , 'تم الحفظ بنجاح');
         } else {
          \Session::flash('success' , ' Data saved successfully');
         }
    }
        
        
    }


    if($request->select == "attch") {
        $file=  File::findOrFail($id);
        if($request->has('ar_name')) {
        $file->ar_name = $request->ar_name;
        }
        if($request->has('name')) {
        $file->name = $request->name;
        }
        if($request->hasFile('attch')){
        \Storage::delete($file->attch);
         $f = time().'.'.$request->attch->getClientOriginalExtension();
        $file->attch = $request->file('attch')->storeAs('public/attchment' , $f);
        }
        
         if($file->save()){
            \Session::flash('success', app()->getLocale() == 'ar' ? 'تمت التعديل بنجاح':'Edit successflly');
            return redirect()->route('web.mycv',app()->getLocale());
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
        if($request->has('email') && $user->email != $request->email){
        $ref->email = $request->email;
        }
        
         if($ref->save()){
            \Session::flash('success', app()->getLocale() == 'ar' ? 'تمت التعديل بنجاح':'Edit successflly');
            return redirect()->route('web.mycv',app()->getLocale());
        }
        
    }

    if($request->select == "user_edit") {
       $user = User::findOrFail($id);
    

        if($request->has('email') && $user->email != $request->email){
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        if($request->has('password')){
            $request->validate([
                'password' => 'required|min:8|confirmed'
            ]);
            if($request->has('password')) {
                $user->password = Hash::make($request->password);
            }
          }

        if($request->has('phone')) {
            $user->phone = $request->phone;
        }
        if($request->has('avatar')) {
            \Storage::delete($user->avatar);
            $user->avatar = $request->avatar->store('public/avatar');
        }

        if($request->has('gender') && $request->gender !="") {
            $user->gender = $request->gender;
            $user->ar_gender = $this->gender[$request->gender];
        }
        if($request->has('name')) {
            $user->name = $request->name;
            $user->ar_name = $request->ar_name;
        }
        if($request->has('last_name')) {
            $user->last_name = $request->last_name;
            $user->ar_last_name = $request->ar_last_name;
        }
        if($request->has('religion')) {
            $user->religion = $request->religion;
            $user->ar_religion = $this->religion[$request->religion];
        }
        if($request->has('social_status')) {
            $user->social_status = $request->social_status;
            $user->ar_social_status = $this->social_status[$request->social_status];
        }
        //Eduction info
     

        if($request->has('brithDate')) {
            $user->birthdate = $request->brithDate;
        }

        if($request->has('idint_1')) {
            $user->idint_1 = $request->idint_1;
        }

        if($request->has('idint_2')) {
            $user->idint_2 = $request->idint_2;
        }

        if($request->has('new_form')) {
            $user->visit_count +=1;
        }

        if($request->has('city_id')) {
           $user->city_id = $request->city_id;
        }
        if($request->has('birth_country_id')){
            $country = Country::findOrFail($request->birth_country_id);
            $user->ar_brith = $country->ar_name;
            $user->brith = $country->name;
        }
        if($request->has('country_id')){
            $user->country_id = $request->country_id;
        }
        if($request->has('role_id')){
            $user->role_id = $request->role_id;
        }
        if($request->has('sub_special_id')){
            $user->sub_special_id = $request->sub_special_id;
        } 

        if($user->save()) {
            if($user->email_verified_at == null && $user->email != $request->email) {
                \Session::flash('error' ,app()->getLocale() == 'ar' ? 'تم تغير البريد تحتاج التاكد ':' Email changed you must verified It');
            }
               \Session::flash('success' ,app()->getLocale() == 'ar' ? 'تم الحفظ بنجاح':' Data saved successfully');
         }
        }
        return redirect()->route('web.mycv',app()->getLocale());
}

    public function destroy(Request $request , $locale , $id)
    {
        // return $id;
        switch($request->select) {
            case 'attch_delete':
                $file = File::findOrFail($id);
                \Storage::delete($file->attch);
                $file->delete();
                \Session::flash('success' , app()->getLocale() == 'ar' ? 'تم الحذف بنجاح': 'Deleted successfully');
                return redirect()->route('web.mycv' , app()->getLocale());
                break;
             case 'ref':
                 $ref = Reference::findOrFail($id);
                 $ref->delete();
                 \Session::flash('success' , app()->getLocale() == 'ar' ? 'تم الحذف بنجاح': 'Deleted successfully');
                 return redirect()->route('web.mycv' , app()->getLocale());
                 break;
            case 'expert_delete':
                 $expert = Exp::findOrFail($id);
                 \Storage::delete($expert->expert_pdf);
                 $expert->delete();
                 \Session::flash('success' , app()->getLocale() == 'ar' ? 'تم الحذف بنجاح': 'Deleted successfully');
                 return redirect()->route('web.mycv' , app()->getLocale());
                 break;
                 
            case 'lang':
                 $lang = Language::findOrFail($id);
                 $lang->delete();
                 \Session::flash('success' , app()->getLocale() == 'ar' ? 'تم الحذف بنجاح': 'Deleted successfully');
                 return redirect()->route('web.mycv' , app()->getLocale());
                 break;
                 
            case 'edu':
                 $edu = Education::findOrFail($id);
                 $edu->delete();
                 \Session::flash('success' , app()->getLocale() == 'ar' ? 'تم الحذف بنجاح': 'Deleted successfully');
                 return redirect()->route('web.mycv' , app()->getLocale());
                 break;
        }
    }

    public function apply($local , $id)
    {
       $job = Job::findOrFail($id);
        $admins = Admin::all();
        \Notification::send($admins , new ApllyJob(Auth::user() , $job));
        
        \Session::flash('success' , 'Accepted');
        return redirect()->route('users.index' , app()->getLocale());

    }

    //helper 

    public function pcount($table ,$model ,$resource)
    {
        $pos_info =  DB::select(DB::raw('SHOW COLUMNS FROM '.$table));
            $base_columns = count($pos_info);
            $not_null = 0;
            foreach ($pos_info as $col){
                $not_null += app('App\\'.$model)::selectRaw('SUM(CASE WHEN '.$col->Field.' IS NOT NULL THEN 1 ELSE 0 END) AS not_null')->where('id', '=', $resource)->first()->not_null;
            }
            return ($not_null/$base_columns)*100;
    }


    public function pdf( $locale , $id) {

        $user = User::findOrFail($id);
        $expert = Exp::where('user_id', $user->id)->first();
        $user->load(['exps','educations']);

        return view('dashboard.users.pdf' , compact(['user', 'expert']));

    }
    
    public function guid() {
        
        $guid = Guid::latest()->first();
        return view('dashboard.users.guid' , compact('guid'));

    }

}
