<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Job;
use App\City;
use App\Role;
use App\User;
use App\Admin;
use App\Owner;
use App\Country;
use App\Special;
use App\SubSpecial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    

    public function index()
    {
        $admins = Admin::all();
        $users = User::all();
        $owners = Owner::all();
        $jobs = Job::all();

        return  view('dashboard.admins.firstpage',compact(['admins','users','owners' , 'jobs']));
    }
    
    public function Admin_index()
    {
        $admins = Admin::all();
        return view('dashboard.admins.index',compact('admins'));
    }

    public function store(Request $request) 
    {
        // return $request;
        
         $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required|unique:admins',
          'phone' => 'required|max:20',
         ]);

         $admin = new Admin();

         $admin->name = $request->name;
         $admin->email = $request->email;

         if($request->has('password')) {
            $admin->password = Hash::make($request->password);
            }

         $admin->phone = $request->phone;

         if($admin->save()) {
             \Session::flash('success', 'Admin  '.$admin->name.'   add Successflly');
             return redirect()->route('admins.index');
         } else {
            \Session::flash('error', 'Admin not add Successflly');
            return redirect()->route('admins.index');
         }
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('dashboard.admins.edit',compact('admin'));
    }

    public function update(Request $request , $id) 
    {
  
           $admin = Admin::findOrFail($id);
           
           if($request->has('name')){
           $admin->name = $request->name;
           }
           if($request->has('email')){
           $admin->email = $request->email;
           }
           if($request->has('password')) {
           $admin->password = Hash::make($request->password);
           }
           if($request->has('phone')){
           $admin->phone = $request->phone;
           }
           if($admin->save()) {
               \Session::flash('success', 'Admin ' .$admin->name.'  add Successflly');
               return redirect()->route('admins.index');
           } else {
              \Session::flash('error', 'Admin not add Successflly');
              return redirect()->route('admins.index');
           }
    }

    public function destroy($id) 
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        \Session::flash('success', 'Admin '.$admin->name.' delete Successflly');
        return redirect()->route('admins.index');
    }

    
}
