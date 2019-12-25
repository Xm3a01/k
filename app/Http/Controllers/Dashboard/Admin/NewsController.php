<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $news = News::all();
       return view('dashboard.admins.news.index',compact('news'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'ar_title' => 'required',
            'title' => 'required',
            'ar_contant' => 'required',
            'contant' => 'required',
            'photo' => 'required|image',
        ]);

        $filename = time().'.'.$request->file('photo')->getClientOriginalExtension();
        $news = new  News();

        $news->ar_title = $request->ar_title;
        $news->title = $request->title;
        $news->ar_contant = $request->ar_contant;
        $news->contant = $request->contant;
        $news->photo = $request->file('photo')->storeAs('public/news' , $filename);

        if($news->save()) {
            \Session::flash('success','تم الحفظ بنجاح');
            return \redirect()->route('news.index');
        }


    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('dashboard.admins.news.edit',compact('news'));
    }

    public function update(Request $request, $id)
    {

        
        $news = News::findOrFail($id);

        if($request->has('ar_title')) {
            $news->ar_title = $request->ar_title;
        }
        if($request->has('title')) {
            $news->title = $request->title;
        }
        if($request->has('ar_contant')) {
            $news->ar_contant = $request->ar_contant;
        }
        if($request->has('contant')) {
            $news->contant = $request->contant;
        }
        if($request->hasFile('photo')) {
            \Storage::delete($news->photo);
            $filename = time().'.'.$request->file('photo')->getClientOriginalExtension();
            $news->photo = $request->file('photo')->storeAs('public/news' , $filename);
        }

        if($news->save()) {
            \Session::flash('success','تم التعديل بنجاح');
            return \redirect()->route('news.index');
        }
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        \Storage::delete($news->photo);
        $news->delete();

        \Session::flash('success','تم التعديل بنجاح');
        return \redirect()->route('news.index');

    }
}
