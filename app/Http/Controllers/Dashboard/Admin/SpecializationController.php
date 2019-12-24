<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Role;
use App\Special;
use App\SubSpecial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specials = Special::all();
        $roles = Role::all();
        return view('dashboard.admins.process.special.index', compact(['specials','roles']));
    }

    public function subIndex()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'ar_name' => 'required',
            'name' => 'required',
            'role_id' => 'required'
        ]);

        $special = new Special();
        $special->ar_name = $request->ar_name;
        $special->name = $request->name;
        $special->role_id = $request->role_id;
        if($special->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return Redirect()->route('specials.index');
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
        $special = Special::findOrFail($id);
        $roles = Role::all();
        return view('dashboard.admins.process.special.edit', compact(['special','roles']));
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
            'ar_name' => 'required',
            'name' => 'required',
            'role_id' => 'required'
                ]);
                $special =  Special::findOrFail($id);
                $special->ar_name = $request->ar_name;
                $special->name = $request->name;
                $special->role_id = $request->role_id;
                if($special->save()) {
                    \Session::flash('success', 'تم التعديل بنجاح');
                    return Redirect()->route('specials.index');
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
        $special =  Special::findOrFail($id);
        $special->delete();

        \Session::flash('success', 'تم الحذف بنجاح');
         return Redirect()->route('specials.index');

    }
}
