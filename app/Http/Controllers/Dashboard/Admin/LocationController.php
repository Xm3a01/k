<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\City;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::paginate(20);
        return view('dashboard.admins.process.location.countryIndex', compact(['countries']));
    }

    public function cityIndex()
    {
        $cities = City::paginate(20);
        return view('dashboard.admins.process.location.cityIndex', compact(['cities']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admins.process.location.addNewCountry');
    }

    public function cityCreate()
    {
        $countries = Country::all();
        return view('dashboard.admins.process.location.addNewCity', compact('countries'));
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
            'ar_name' => 'required|max:255',
        ]);
        switch ($request->select_one) {
            case 'country':
                $country = new Country();
                $country->name = $request->name;
                $country->ar_name = $request->ar_name;
                if($country->save()) {
                    \Session::flash('success', 'تمت الاضافه بنجاح');
                    return Redirect()->route('locations.index');
                }
                break;
            case 'city':
                $request->validate([
                    'country_id' => 'required'
                ]);
                $city = new City();
                $city->name = $request->name;
                $city->ar_name = $request->ar_name;
                $city->country_id = $request->country_id;
                if($city->save()) {
                    \Session::flash('success', 'تمت الاضافه بنجاح');
                    return Redirect()->route('cities.index');
                }
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
        $country = Country::findOrFail($id);
        return view('dashboard.admins.process.location.country_edit',compact('country'));
    }

    public function cityEdit($id)
    {
        $city = City::findOrFail($id);
        $countries = Country::all();
        return view('dashboard.admins.process.location.city_edit',compact(['city' , 'countries']));
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
        switch ($request->select_one) {
            case 'country':
               $country = Country::findOrFail($id);
                $country->name = $request->name;
                $country->ar_name = $request->ar_name;
                if($country->save()) {
                    \Session::flash('success', 'تمت التعديل بنجاح');
                    return Redirect()->route('locations.index');
                }
                break;
            case 'city':
                $city = City::findOrFail($id);
                $city->name = $request->name;
                $city->ar_name = $request->ar_name;
                $city->country_id = $request->country_id;
                if($city->save()) {
                    \Session::flash('success', 'تمت التعديل بنجاح');
                    return Redirect()->route('cities.index');
                }
                break;
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
        $country = Country::findOrFail($id);
        $country->delete();
       \Session::flash('success','تم الحذف بنجاح');
       return Redirect()->route('locations.index');
    }
    public function cityDestroy($id)
    {
        
       
       $city = City::findOrFail($id);
       $city->delete();
       \Session::flash('success','تم الحذف بنجاح');
       return Redirect()->route('cities.index');
    }
}
