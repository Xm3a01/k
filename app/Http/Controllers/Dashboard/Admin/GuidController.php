<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Guid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuidController extends Controller
{
   
    public function index()
    {
        $guid = Guid::latest()->take(1)->first();
        return view('dashboard.admins.users.guid.guid',compact('guid'));
    }
    
    public function update(Request $request, $id)
    {
        $guid = Guid::findOrFail($id);
        
        if($request->has('title') && $request->title != '') {
            $guid->title = $request->title;
        }
        if($request->has('ar_title') && $request->ar_title != '') {
             $guid->ar_title = $request->ar_title;
        }
        if($request->has('guid') && $request->guid != '') {
            $guid->guid = $request->guid;
        }
        if($request->has('ar_guid') && $request->ar_guid != '') {
            $guid->ar_guid = $request->ar_guid;
        }
        
        if($guid->save()){
            \Session::flash('success','تم التعديل بنجاح');
            return redirect()->route('guids.index');
        }
    }
    
}
