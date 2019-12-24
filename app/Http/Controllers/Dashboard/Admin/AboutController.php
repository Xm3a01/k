<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\About;
use App\Whyus;
use App\Employee;
use App\Partener;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
      $all = About::all();
 
       return view('dashboard.admins.profile.about-company' , compact('all'));
    }
     public function indexpartner()
    {
        $about = About::latest()->take(1)->first();
      $parteners = Partener::all();
 
      return  view('dashboard.admins.profile.partnersSuccess' , compact(['parteners','about']));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $about = About::latest()->take(1)->first();
       return view('dashboard.admins.profile.about-company', compact(['about']));
    }
    
     public function createTeam()
    {
        $about = About::latest()->take(1)->first();
        $employees = Employee::all();
        
       return    view('dashboard.admins.profile.team', compact('employees','about'));
    }

    public function createContact()
    {
        $about = About::latest()->take(1)->first();
       return view('dashboard.admins.profile.contactus',compact('about'));
    }

    public function createPartner()
    {
        $about = About::latest()->take(1)->first();
       return view('dashboard.admins.profile.partnersSuccess',compact('about'));
    }

    public function createwhyUs()
    {
        $about = About::latest()->take(1)->first();
       return view('dashboard.admins.profile.whychooseUs',compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $about = new About();
        $partener = new Partener();
        $employee = new Employee();
        $whyus = new Whyus();

        switch ($request->select_one) {
              case 'about_company':
                $this->validate($request, [
                'about' => 'required',
                'ar_about' => 'required',
                'video' => 'required',
                'location' => 'required',
                'location_ar' => 'required',
                'email' => 'required|email',
                'phone' => 'required|max:20',
                ]);
                $about->about = $request->about;
                $about->ar_about = $request->ar_about;
                $about->location = $request->location;
                $about->ar_location = $request->location_ar;
                $about->email = $request->email;
                $about->phone = $request->phone;
                if($request->hasFile('video')){
                $vedio = time().'.'.$request->file('video')->getClientOriginalExtension();
                $about->video = $request->file('video')->storeAs('public/about_video' , $vedio);
                }
                $about->save();\Session::flash('success' , 'تم الحفظ بنجاح');
                return redirect()->route('about.company');
                break;

            case 'partner':
                $this->validate($request, [
                'partner_name' => 'required',
                'partner_logo' => 'required|image',
                ]);
                $partener->about_id = $request->about_id;
                $partener->partner_name = $request->partner_name;
                $partener->partner_logo = $request->partner_logo->store('public/partnerLogo');
                $partener->save();\Session::flash('success' , 'تم الحفظ بنجاح');

                return redirect()->route('about.partner');
                break;

            case 'team':
                $this->validate($request, [
                'employee_name' => 'required',
                'employee_photo' => 'required|image',
                'employee_position' => 'required',
                'ar_employee_name' => 'required',
                ]);
                $employee->about_id = $request->about_id;
                $employee->employee_name = $request->employee_name;
                $employee->ar_employee_name = $request->ar_employee_name;
                if($request->has('employee_photo')){
                $employee->employee_photo = $request->employee_photo->store('public/employee');
                }
                $employee->employee_position = $request->employee_position;
                $employee->save();\Session::flash('success' , 'تم الحفظ بنجاح');
                return redirect()->route('about.team');
                break;

            case 'whyus':
                $this->validate($request, [
                'why_title' => 'required|max:255',
                'why_details' => 'required|max:1024',
                ]);
                $whyus->about_id = $request->about_id;
                $whyus->why_title = $request->why_title;
                $whyus->why_details = $request->why_details;
                $whyus->save();\Session::flash('success' , 'تم الحفظ بنجاح');
                return redirect()->route('admin.dashboard');
                break;
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
        switch ($request->select_one) {
            case 'about_company':
                return view('');
                break;
            case 'partner':
                return view('');            
                break;
            case 'team':
               return view('');
                break;
            case 'whyus':
                return view('');
                break;
            
            default:
                # code...
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('dashboard.admins.profile.about_edit',compact('about'));
    }
    
     public function edit_partner($id)
     {
        $partener = Partener::findOrFail($id);
        
        return  view('dashboard.admins.profile.partener_edit',compact('partener'));
     }
    
    public function edit_team($id)
    {
        $emp = Employee::findOrFail($id);
        
        return  view('dashboard.admins.profile.team_edit',compact('emp'));
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
        
        switch ($request->select_one) {
            case 'about_company':
            
                $about = About::findOrFail($id);
                if($request->has('ar_about')){
                $about->ar_about = $request->ar_about;
                }
                if($request->has('about')){
                $about->about = $request->about;
                }
                if($request->has('video')){
                    \Storage::delelet($about->video);
                  $about->video = $request->video->store('public/about_video');
                }
                if($request->has('location')){
                  $about->location = $request->location;
                }
                if($request->has('ar_location')){
                  $about->ar_location = $request->ar_location;
                }
                if($request->has('email')){
                  $about->email = $request->email;
                }
                if($request->has('phone')){
                  $about->phone = $request->phone;
                }
                $about->save();
                \Session::flash('success' , 'تم التعديل بنجاح');
                 return Redirect()->route('about.company');
                break;

            case 'partner':
                $partener = Partener::findOrFail($id);
                 if($request->has('partner_name')){
                $partener->partner_name = $request->partner_name;
                 }
                if($request->has('partner_logo')){
                \Storage::delete($partener->partner_logo);
                $partener->partner_logo = $request->partner_logo->store('public/partnerLogo');
                }
                
                $partener->save();
                \Session::flash('success' , 'تم التعديل بنجاح' );
                 return Redirect()->route('about.partner');
                break;

            case 'team':
                $employee = Employee::findOrFail($id);

                if($request->has('employee_name')){
                $employee->employee_name = $request->employee_name;
                }
                if($request->has('ar_employee_name')){
                $employee->ar_employee_name = $request->ar_employee_name;
                }
                if($request->has('employee_photo')){
                $employee->employee_photo = $request->employee_photo->store('public/employee');
                }
                if($request->has('employee_position')){
                $employee->employee_position = $request->employee_position;
                }
                $employee->save();
                \Session::flash('success' , 'تم التعديل بنجاح');
                  return Redirect()->route('about.team');
                break;

            case 'whyus':
                $this->validate($request, [
                'why_title' => 'required|max:255',
                'why_details' => 'required|max:1024',
                ]);
                $whyus =    Whyus::findOrFail($id);
                $whyus->why_title = $request->why_title;
                $whyus->why_details = $request->why_details;
                $whyus->save();
                \Session::flash('success' , 'تم التعديل بنجاح');
                 return Redirect()->route('about.whyus');
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     public function destroy(Request $request , $id)
     {
         switch ($request->select) {
            case 'about':
                $about = About::findOrFail($id);
                $about->delete();

               \Session::flash('success', 'تم الحذف بنجاح'); 
                return Redirect()->route('about.company');
                break;
            case 'partner':
                $partener = Partener::findOrFail($id);
                $partener->delete();

               \Session::flash('success', 'تم الحذف بنجاح'); 
               return Redirect()->route('about.partner');          
                break;
            case 'team':
               $emp = Employee::findOrFail($id);
                $emp->delete();

               \Session::flash('success', 'تم الحذف بنجاح'); 
               return Redirect()->route('about.team');
                break;
         }
     }
     
    //  // ؟؟؟؟
    // public function aboutDestroy($id)
    // {
    //     $about = About::findOrFail($id);
    //     $about->delete();

    //     \Session::flash('success', 'تم الحذف بنجاح'); 
    //       return Redirect()->route('about.company');
    // }
    
    //  public function partenerDestroy($id)
    // {
    //     $partener = Partener::findOrFail($id);
    //     $partener->delete();

    //     \Session::flash('success', 'تم الحذف بنجاح');
    //       return Redirect()->route('about.partner');
    // }
}
