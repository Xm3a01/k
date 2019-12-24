<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $roles = Role::all();
       return view('dashboard.admins.process.role.roleTable', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admins.process.role.addNewRole');
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
          'name' => 'required|max:255',
          'ar_name' => 'required|max:255'
        ]);

        $role = new Role();

        $role->ar_name = $request->ar_name;
        $role->name = $request->name;

        if($role->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return Redirect()->route('roles.index');
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
        $role = Role::findOrFail($id);

        return view('dashboard.admins.process.role.role_edit',compact('role'));
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
        $request->validate([
            'name' => 'required|max:255',
            'ar_name' => 'required|max:255'
          ]);
  
          $role =  Role::findOrFail($id);
  
          $role->ar_name = $request->ar_name;
          $role->name = $request->name;
  
          if($role->save()) {
              \Session::flash('success', 'تم التعديل بنجاح');
              return Redirect()->route('roles.index');
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
        $role = Role::findOrFail($id);
        $role->delete();

        \Session::flash('success', 'تم الحذف بنجاح');
          return Redirect()->route('roles.index');
    }
}
