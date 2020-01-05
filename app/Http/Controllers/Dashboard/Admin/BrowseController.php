<?php

namespace App\Http\Controllers\Dashboard\Admin;


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
use App\Http\Controllers\Controller;

class BrowseController extends Controller
{
    
    public $status = [
        'Full time' => 'دوام كامل',
        'Par time' => 'دوام جزئي'
         ];
         
    public function index()
    {
        return view('dashboard.admins.Applicants.index');
    }
    
    public function pdf($id) {

        $user = User::findOrFail($id);
        $expert = Exp::where('user_id', $user->id)->first();
        $user->load(['exps','educations' , 'languages' , 'files','references','country','city','special','role']);

        return view('dashboard.users.pdf' , compact(['user', 'expert']));

    }
         
    public function noty($id , $sender_id, $notfy , $job_id)
    {
        if($id != 0) {
           $user = User::findOrFail($id);
        if($job_id !=0) {
           $job = Job::findOrFail($job_id);
        if($job->selected == 0){
           $job->selected = 1;
           $job->save();
        }
        }
        if(!$user->owner_id) {
        $user->owner_id = $sender_id;
        if($user->save()) {
            \Session::flash('success' , 'تمت الموافقه علي الطلب');
           \Auth::user()->unreadnotifications->find($notfy)->markAsRead();
           return back();
        }
        } else {
            \Session::flash('error' , 'المستخدم تم اختياره من قبل  ');
            \Auth::user()->unreadnotifications->find($notfy)->markAsRead();
           return back(); 
        }
    } else {
        $request =  \Auth::user()->unreadnotifications->find($notfy);
        return $this->Add($request , $sender_id);
     }
    }
    
    public function delete($notfy)
    {
        
        // $dd = \Auth::user()->notifications()->delete();
        
        \Auth::user()->notifications()
        ->where('id', $notfy) // and/or ->where('type', $notificationType)
        ->get()
        ->first()
        ->delete();
        \Session::flash('success' , 'تم الحذف بنجاح');
        return back();
    }
    
    public function Add($request , $sender_id) {
        
        
         $job = new Job();
         
            $job->owner_id = $sender_id;
            $job->yearsOfExper = $request->data['yearsOfExper'];
            $job->level = $request->data['level'];
            $job->role_id = $request->data['role_id'];
            $job->country_id = $request->data['country_id'];
            $job->city_id = $request->data['city_id'];
            $job->special_id = $request->data['special_id'];
            $job->sub_special_id = $request->data['sub_special_id'];
            $job->ar_status  = $this->status[$request->data['status']];
            $job->status = $request->data['status'];
            $job->selary = $request->data['selary'];
            $job->ar_description = $request->data['ar_description'];
            $job->description = $request->data['description'];

            if($job->save()) {
                \Session::flash('success', 'تمت الاضافه بنجاح');
                $request->markAsRead();
                return redirect()->route('jobs.index');
            }
    }
    
    
    public function notfyShow($id){
        
     $notfy = \Auth::user()->notifications()
        ->where('id', $id) // and/or ->where('type', $notificationType)
        ->get()
        ->first();
        
      
      return view('dashboard.admins.notifications.show' , compact('notfy'));
    }
    
    public function notfyAll(){
    //  return \Auth::user()->notifications;
      return view('dashboard.admins.notifications.all');
    }
    
    // public function pdf($id) {

    //     $user = User::findOrFail($id);
    //     $expert = Exp::where('user_id', $user->id)->first();
    //     $user->load(['exps','educations']);

    //     return view('dashboard.users.pdf' , compact(['user', 'expert']));

    // }
}
