@extends('layouts.defult')
@section('content')
    
   
<div class="unit-5 overlay" style="background-image: url('{{asset('asset/images/hero_1.jpg')}}');">
    <div class="container text-center">
      <h2 class="mb-0">{{__('Contact Us')}}</h2>
      <p class="mb-0 unit-6"><a href="index.html">{{__('Home')}}</a> <span class="sep">></span> <span>{{__('About Us')}}</span></p>
    </div>
  </div> 
 
  <div class="p-3 pt-5 bg-light">
      <div class="container">
      <div class="row">
     
        <div class="col-md-12 col-lg-8 mb-5"> 
        
          <form action="{{route('contact.send' , app()->getLocale())}}" class="p-5 bg-white" method ="POST">
              @csrf
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="font-weight-bold" for="fullname">   {{__('Full Name')}}</label>
                <input type="text" id="fullname" class="form-control" placeholder="{{__('Enter Full Name')}}" name = "full_name">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="font-weight-bold" for="fullname">   {{__('Subject')}}</label>
                <input type="text" id="fullname" class="form-control" placeholder="{{__('Enter Subject')}}" name = "subject">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="email"> {{__('Email')}} </label>
                <input type="email" id="email" class="form-control" placeholder="{{__('Enter Email')}}" name ="email">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="font-weight-bold" for="phone">{{__('Phone Number')}}</label>
                <input type="text" id="phone" class="form-control" placeholder="{{__('Enter Phone Number')}}   " name ="phone">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="message"> {{__('Coment')}}</label> 
                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder=" {{__('Leave a comment')}} "></textarea>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <input type="submit" value="{{__('Send Coment')}} " class="btn btn-primary pill px-3">
              </div>
            </div>


          </form>
        </div>

         <div class="col-lg-4">  
            <div class="p-4 mb-3 bg-white shadow rounded">
              <h3 class="h5 text-black mb-3">{{__('About Company')}} </h3>
              <p> {{ (!is_null($about)) ? app()->getLocale() == 'ar' ?  $about->ar_about : $about->about : '' }} </p>
              <p class="text-center"><a href="{{route('about.footer' , app()->getLocale())}}" class="btn btn-primary px-3 text-white pill"> {{__('Read More')}} </a></p>
            </div>

          </div>

      </div>
    </div>
  </div>

  <div class="pt-5 px-3 quick-contact-info text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div>
            <h2 class="h4"> {{__('Location')}} </h2>
            <p class="mb-5">{{ app()->getLocale() == 'ar' ? $about->ar_location ?? '' : $about->location ?? ''}}</p>
          </div>
        </div>
        <div class="col-md-4">
          <div>
            <h2 class="h4"> {{__('Work Time')}} </h2>
            <p class="m-0"> Saturday to Thurthday </p>
            <p class=" ">7:30 - 3:30</p> 
          </div>
        </div>
        <div class="col-md-4">
          <h2 class="h4"> {{__('Stay Connected')}} </h2>
          <p class="mb-5">{{__('Email')}}: {{$about->email ?? ''}} <br>
           {{__('Phone Number')}}: {{$about->phone ?? ''}} </p>
        </div>
      </div>
    </div>
  </div>


   

@endsection