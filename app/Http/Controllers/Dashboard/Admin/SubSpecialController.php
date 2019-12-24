<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Special;
use App\SubSpecial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubSpecialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_specials = SubSpecial::all();
        $specials = Special::all();
        return view('dashboard.admins.process.sub_special.index', compact(['sub_specials','specials']));
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
            'special_id' => 'required',
            'ar_name' => 'required',
            'name' => 'required'
        ]);
        $sub_special = new SubSpecial();
        $sub_special->ar_name = $request->ar_name;
        $sub_special->name = $request->name;
        $sub_special->special_id = $request->special_id;
        if($sub_special->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return Redirect()->route('subspecials.index');
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
        $sub_special = SubSpecial::findOrFail($id);
        $specials = Special::all();
        return view('dashboard.admins.process.sub_special.edit', compact(['sub_special','specials' ]));
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
            'special_id' => 'required',
            'ar_name' => 'required',
            'name' => 'required'
        ]);
        $sub_special =  SubSpecial::findOrFail($id);;
        $sub_special->ar_name = $request->ar_name;
        $sub_special->name = $request->name;
        $sub_special->special_id = $request->special_id;
        if($sub_special->save()) {
            \Session::flash('success', 'تم التعديل بنجاح');
            return Redirect()->route('subspecials.index');
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
        $sub_special = SubSpecial::findOrFail($id);
        $sub_special->delete();

        \Session::flash('success', 'تم الحذف بنجاح');
         return Redirect()->route('subspecials.index');
    }
}
