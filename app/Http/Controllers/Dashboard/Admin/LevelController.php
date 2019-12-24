<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();
        return view('dashboard.admins.process.level.index',compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
         'name' => 'required'
        ]);
        
        $level = new Level();
        $level->ar_name = $request->ar_name;
        $level->name = $request->name;

        if($level->save()) {
            \Session::flash('success', 'تمت الاضافه بنجاح');
            return Redirect()->route('levels.index');
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
        $level = Level::findOrFail($id);
        return view('dashboard.admins.process.level.edit',compact('level'));
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
            'name' => 'required'
           ]);
           
           $level = Level::findOrFail($id);
           $level->ar_name = $request->ar_name;
           $level->name = $request->name;
   
           if($level->save()) {
               \Session::flash('success', 'تم التعديل بنجاح');
               return Redirect()->route('levels.index');
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
        $level = Level::findOrFail($id);
        $level->delete();

        \Session::flash('success', 'تم الحذف بنجاح');
         return Redirect()->route('levels.index');

    }
}
