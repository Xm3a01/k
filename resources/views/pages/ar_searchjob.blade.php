@extends('layouts.defult')
@section('stylesheet')
<link rel="stylesheet" href=" {{asset('asset/css/style1.css')}} ">
@endsection
@section('content')

<div class="unit-5 overlay" style="background-image: url('{{asset('asset/images/hero_1.jpg')}}');">
    <div class="container text-center">
        <h2 class="h4mb-0"> </h2>
        <p class="mb-0 unit-6 p-3"><a href="index.html">{{__('Home')}}</a> <span class="sep">></span> <span{{__('Search Job')}}>  </span></p>
    </div>
</div>

<section class="mb-5"> 
<div class="container-fluid">
<div class="row">
    <div class="col-md-3 border-right">
    </div>

<div class="col-md-9 scrolling">
<div class="modrn-joblist ">
        <div class="tags-bar">
            <span> {{$one}} <i class="close-tag">1</i></span>
            <span> {{$tow}} <i class="close-tag">2</i></span> 
        </div>
 <!-- Tags Bar -->
    <div class="filterbar">
        <!--<span class="emlthis">ة</a></span>-->
            <h5 class="pt-2">  تنائج البحث {{ ($jobs->count() > 0) ? $jobs->count(): ($Ijobs->count() > 0 ? $Ijobs->count() : $all->count().' كل نتائج البحث' )  }}   </h5>
        </div> 
    </div>  
    
    <div class="rounded jobs-wrap">   
   @if($Ijobs->count() <= 0 && $jobs->count() <= 0)
            @foreach($all as $job)
            <a href="{{route('single.job' ,[app()->getLocale() , $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                <div class="company-logo blank-logo text-center text-md-left pl-3">
                    <img src="{{asset(Storage::url($job->owner->logo))}}" alt="Image" class="img-fluid mx-auto">
                </div>
                <div class="job-details h-100">
                    <div class="p-3 align-self-center">
                    <h3> {{ $job->sub_special->ar_name ?? '' }} - {{ $job->special->ar_name ?? '' }}</h3>
                    <div class="d-block d-lg-flex">
                    <p class="m-0"> {{ $job->yearsOfExper }} </p>
                        <span class="mr-3"> {{ date('F d, Y', strtotime($job->created_at)) }} </span></div>
                    <div class="d-block d-lg-flex"> 
                        <div > <span class="icon-suitcase mr-1 ml-2"> </span> {{  $job->owner->company_name}} </div>
                        <div class="mr-3" > <span class="icon-money mr-1"> </span> {{ $job->selary }} </div>
                    </div>
                    <p class="m-0 text-primary"> {{  $job->description}} </div>
                </div>
                <div class="job-category align-self-center">
                        <div class="p-3">
                            <span class="text-warning p-2 rounded border border-warning"> {{ $job->status}} </span>
                        </div>
                        </div>
                </a> 
            @endforeach
           @endif

            @foreach($jobs as $job)
                  <a href="{{route('single.job' ,[app()->getLocale() , $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                        <div class="company-logo blank-logo text-center text-md-left pl-3">
                          <img src="{{asset(Storage::url($job->owner->logo))}}" alt="Image" class="img-fluid mx-auto">
                        </div>
                        <div class="job-details h-100">
                          <div class="p-3 align-self-center">
                           <h3> {{ $job->sub_special->ar_name ?? '' }} - {{ $job->special->ar_name ?? '' }} </h3>
                           <div class="d-block d-lg-flex">
                            <p class="m-0"> {{$job->yearsOfExper}} </p>
                             <span class="mr-3"> {{date('F d, Y', strtotime($job->created_at))}} </span> 
                               </div>
                            <div class="d-block d-lg-flex"> 
                              <div ><span class="icon-suitcase mr-1 ml-2"></span> {{  $job->owner->company_name }} </div>
                              <div class="mr-3" ><span class="icon-money mr-1"> {{$job->selary }} </span></div>
                            </div>
                            <p class="m-0 text-primary"> {{   $job->ar_description }} </div>
                        </div>
                        <div class="job-category align-self-center">
                                <div class="p-3">
                                  <span class="text-warning p-2 rounded border border-warning"> {{ $job->ar_status}} </span>
                                </div>
                              </div>
                      </a> 
                      
                @endforeach
                      
                @foreach($Ijobs as $job)
                  <a href="{{route('single.job' ,[app()->getLocale() , $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                    <div class="company-logo blank-logo text-center text-md-left pl-3">
                        <img src="{{asset(Storage::url($job->owner->logo))}}" alt="Image" class="img-fluid mx-auto">
                    </div>
                    <div class="job-details h-100">
                        <div class="p-3 align-self-center">
                        <h3> {{ $job->sub_special->ar_name ?? '' }} - {{ $job->special->ar_name ?? '' }} </h3>
                        <div class="d-block d-lg-flex">
                        <p class="m-0"> {{ $job->yearsOfExper }} </p>
                            <span class="mr-3"> {{ date('F d, Y', strtotime($job->created_at)) }} </span></div>
                        <div class="d-block d-lg-flex"> 
                            <div > <span class="icon-suitcase mr-1 ml-2"> </span> {{  $job->owner->company_name}} </div>
                            <div class="mr-3" > <span class="icon-money mr-1"> </span> {{ $job->selary }} </div>
                        </div>
                        <p class="m-0 text-primary"> {{  $job->description}} </div>
                    </div>
                    <div class="job-category align-self-center">
                            <div class="p-3">
                                <span class="text-warning p-2 rounded border border-warning"> {{ $job->status}} </span>
                            </div>
                            </div>
                    </a> 
                      
                @endforeach

            </div>
     
            </div> 
       
            </div> 
            
            
        </div> 
        </div>
        </section>



@endsection