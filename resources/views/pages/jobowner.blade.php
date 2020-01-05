@extends('layouts.defultowner')
@section('content')
    

<div class="unit-5 overlay  " style="background-image: url(' {{asset('asset/images/hero_1.jpg')}} ');">
    <div class="container">
       <div class="row align-items-center">
           <div class="col-12" data-aos="fade">
               <div class="pb-4">
                   <h1 class="h3 text-center text-white pt-2">
                    {{__('Hire Job Seekers Quickly Search from')}}  {{$users->count()}}  {{__('CVs')}}  </h1>
                   </div>
                <form action="{{route('search.cv' ,app()->getLocale())}}" method="GET">
                   <div class="row mb-3">
                       <div class="col-md-9">
                           <div class="row">
                               <div class="col-md-6 mb-3 mb-md-0">
                                   <div class="input-wrap">
                                       <span class="icon icon-keyboard"></span> 
                                       <input type="text" class=" form-control border-0 px-3" list = "special" autocomplete ="off"  placeholder=" {{__('Search by Job title')}} " name="special">
                                           <datalist id="special">
                                               @foreach ($specials as $special)    
                                               <option value="{{app()->getLocale() == 'ar' ? $special->ar_name : $special->name}}">
                                               @endforeach
                                           </datalist>
                                   </div>
                               </div>
                               <div class="col-md-6 mb-3 mb-md-0">
                                   <div class="input-wrap">
                                       <span class="icon icon-room"></span>
                                       <input type="text" class="form-control border-0 px-3" list="country" autocomplete ="off" placeholder=" {{__('City or Country')}}  " name="place">
                                           <datalist id ="country">
                                               @foreach ($countries as $country)
                                               <option value="{{app()->getLocale() == 'ar' ? $country->ar_name : $country->name}}"> 
                                               @endforeach
                                           </datalist>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-3">
                           <input type="submit" class="btn btn-search  btn-block" style="    background-color: transparent!important;
                           border: 2px solid #fff;
                           border-radius: 5px;
                           color: #fff;
                           font-size: 20px;"
                               value=" {{__('CV Search')}} " data-toggle="modal" data-target="#exampleModal">
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>
</div>


<!--start feature-->
<div class="features text-center">
       <div class="container">
           <div class="row">
               <div class="col-sm-6 col-md-4">  <img src="{{asset('asset/images/ideaicon2.png')}}" alt="">
                    <p>{{__('Connect with the largest community of physicians in the Middle East from all medical disciplines and levels. More than 100 doctors join the Gulf Waves daily')}}</p>
               </div>
               <div class="col-sm-6 col-md-4"> <img src="{{asset('asset/images/ideaicon.png')}}">
                    <p>{{__('Hire the ideal candidate and increase your companys profits. Choose the right solution for you according to your budget and time')}}</p>
               </div>
               <div class="col-sm-6 col-md-4"> <img src="{{asset('asset/images/light-bulb.png')}}" width="6%" alt="">
                    <p>{{__('Market your company as the best place to work by creating a page for your company and a job site, and using effective marketing tools')}}</p>
               </div> 
           </div>
        </div>
   </div>
<!--ends feature-->

<!--start pricing-->
<div class="pricing text-center">
<div class="container">
   <h2 class="py-4"> {{__('Pricing')}}  </h2>
       	<div class="row justify-content-center">
       	    @foreach($prices as $price)
               <div class=" col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                           <h4 class="card-title"> {{__('Post a job')}} </h4>
                              <p class="card-text"> $ {{$price->price ?? '' }}/<span>Year</span> </p>
                            <ul class="list-group list-group-flush">
                               <li class="list-group-item">{{app()->getLocale() == 'ar' ? $price->have_one ?? '' : $price->have_two ?? ''}}</li>
                               <li class="list-group-item">{{app()->getLocale() == 'ar' ? $price->have_three ?? '' : $price->have_four ?? ''}}</li> 
                           </ul> 
                       </div>
                   </div>
               </div>
             @endforeach
           </div>
       </div>
</div>

<div class="py-5 bg-light text-center"> 
    <img src="{{asset('vendor/images/noimage_person.png')}}" class="rounded-circle pb-2" alt="" width="20%">
      <h2 class="pt-2">{{__('Contact us and we will be happy to help')}} </h2>    
     <h3 class="py-1 text-info"> {{__('Contact Us On')}}   002490910440407</h3>
</div>



@endsection