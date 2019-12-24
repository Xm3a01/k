
@extends('layouts.defaultclient')
@section('content')

<div class="container-fluid bg-light pt-5">
    <div class="row  justify-content-center pt-5"> 
       <div class="col-sm-6 col-md-6 col-md-offset-1 mt-4">   
        <div class="entry-content pb-1  px-3 bg-white my-3 shadow"> 
            <form method="POST" class="" action="{{route('users.update' , [app()->getLocale() , $lang->id])}}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')
                      <input type="hidden" name="select" value="lang">

                    <div class ="row">
                        <div class=" col-md-6">
                          <label for="inputEmail4">{{__('Language')}}</label>
                          <select id="inputState" class="form-control"  name = "language">
                             <option disabled  value="" > {{__('Select language')}} </option>
                             <option  selected value="{{$lang->language}}" > {{(app()->getLocale() == 'ar') ? $lang->ar_language : $lang->language }} </option> 
                            <option value="Arabic " >{{(app()->getLocale() == 'ar') ? 'عربي' : 'Arabic' }}</option>
                            <option value="English " >{{(app()->getLocale() == 'ar') ? 'انجليزي' : 'English' }}</option>
                          </select>
                        </div>

                        <div class=" col-md-6">
                          <label for="inputEmail4">{{__('Language level')}}</label>
                          <select id="inputState" class="form-control"  name = "language_level">
                            <option disabled  value="" > {{__('Select language level')}} </option>
                            <option  selected value="{{$lang->language_level}}" > {{(app()->getLocale() == 'ar') ? $lang->ar_language_level : $lang->language_level }} </option> 
                            <option value="Beginner " >{{(app()->getLocale() == 'ar') ? 'مبتدئي' : 'Beginner' }}</option>
                            <option value="Intermediate " >{{(app()->getLocale() == 'ar') ? 'متوسط' : 'Intermediate' }}</option>
                            <option value="Mother tounge " >{{(app()->getLocale() == 'ar') ? 'للغه الاساسيه' : 'Mother tounge' }}</option>
                          </select>
                        </div>
                        </div>
                          <br>
                            <button class="btn btn-primary " type="submit">save</button>
                    </form>

             </div> 
           </div>
         </div>
    </div>
 
    
@endsection