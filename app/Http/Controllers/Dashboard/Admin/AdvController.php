<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Princing;
use App\Adv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdvController extends Controller
{


    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $advs = Adv::all();
        return view('dashboard.admins.ads.index',compact('advs'));
    }
    
    public function price_index()
    {
        $prices = Princing::all();
        return view('dashboard.admins.ads.pricing',compact('prices'));
    }

    public function store(Request $request) 
    {
        switch($request->select){
         case 'adv':
             $this->validate($request, [
              'ar_adv' => 'required|max:255',
              'adv' => 'required',
              'ar_title' => 'required',
              'title' => 'required',
             ]);
    
             $adv = new Adv();
    
             $adv->ar_adv = $request->ar_adv;
             $adv->adv = $request->adv;
             $adv->ar_title = $request->ar_title;
             $adv->title = $request->title;
             if($request->hasFile('img')){
                $img = time().'.'.$request->file('img')->getClientOriginalExtension();
                $adv->img = $request->file('img')->storeAs('public/AdvImage' , $img);
                }
    
             if($adv->save()) {
                 \Session::flash('success', 'Advs  '.$adv->ar_title.' add Successflly');
                 return redirect()->route('advs.index');
             } else {
                \Session::flash('error', 'adv not add Successflly');
                return redirect()->route('advs.index');
             }
             
             break;
         
         case 'price':
            $this->validate($request, [
               'have_one'=>'required',
               'have_tow'=>'required',
               'have_three'=>'required',
               'have_four'=>'required',
               'price'=>'required'
            ]);
           $price = new  Princing();
          
           $price->have_one = $request->have_one;
           $price->have_tow = $request->have_tow;
           $price->have_three = $request->have_three;
           $price->have_four = $request->have_four;
           $price->price = $request->price;
           if($price->save()) {
               \Session::flash('success', 'تم الحفظ بنجاح');
               return redirect()->route('price.index');
           } else {
              \Session::flash('error','not add Successflly');
              return redirect()->route('price.index');
           }
           break;
    }
    }

    public function edit($id)
    {
        $adv = Adv::findOrFail($id);
        return view('dashboard.admins.ads.edit',compact('adv'));
    }
    
    public function price_edit($id)
    {
        $price = Princing::findOrFail($id);
        return view('dashboard.admins.ads.pricing_edit',compact('price'));
    }

    public function update(Request $request , $id) 
    {
        
     switch($request->select){
            
        case 'adv':
           $adv = Adv::findOrFail($id);
          
           if($request->has('ar_adv')){
           $adv->ar_adv = $request->ar_adv;
           }
           if($request->has('adv')){
           $adv->adv = $request->adv;
           }
           if($request->has('ar_title')) {
           $adv->ar_title = $request->ar_title;
           }
           if($request->has('title')){
           $adv->title = $request->title;
           }
           if($request->hasFile('img')){
               \Storge::delete($adv->img);
                $img = time().'.'.$request->file('img')->getClientOriginalExtension();
                $adv->img = $request->file('img')->storeAs('public/AdvImage' , $img);
                }
           if($adv->save()) {
               \Session::flash('success', 'الاعلان ' .$adv->ar_adv.'  تم التعديل بنجاح');
               return redirect()->route('advs.index');
           } else {
              \Session::flash('error', 'adv not add Successflly');
              return redirect()->route('adv.index');
           }
           
           break;
        case 'price':
           $price = Princing::findOrFail($id);
          
           if($request->has('have_one')){
           $price->have_one = $request->have_one;
           }
           if($request->has('have_tow')){
           $price->have_tow = $request->have_tow;
           }
           if($request->has('have_three')) {
           $price->have_three = $request->have_three;
           }
           if($request->has('have_four')){
           $price->have_four = $request->have_four;
           }
           
           if($request->has('price')){
           $price->price = $request->price;
           }
           if($price->save()) {
               \Session::flash('success', ' تم التعديل بنجاح');
               return redirect()->route('price.index');
           } else {
              \Session::flash('error','not add Successflly');
              return redirect()->route('price.index');
           }
           break;
        }
    }

    public function destroy(Request $request , $id) 
    {
        switch($request->select){
        case 'adv':
             $adv = Adv::findOrFail($id);
            $adv->delete();
            \Session::flash('success', 'Admin '.$adv->ar_title.' delete Successflly');
            return redirect()->route('advs.index');
            break;
        case 'price':
            $price = Princing::findOrFail($id);
            $price->delete();
            \Session::flash('success', 'delete Successflly');
            return redirect()->route('price.index');
            break;
            
    }

    
}
}
