@extends('layouts.defult')
@section('content')
    


<div class="unit-5 overlay" style="background-image: url('{{asset('asset/images/hero_1.jpg')}}');">
    <div class="container text-center">
      <h2 class="mb-0">{{   (app()->getLocale() == 'ar') ? $job->ar_role :  $job->role }}</h2>
      <p class="mb-0 unit-6"><a href="index.html">{{__('Home')}}</a> <span class="sep">></span> <span>{{__('Job Detail')}}</span></p>
    </div>
  </div> 
 
  <div class="site-section bg-light">
    <div class="container">
      <div class="row">
       <div class="col-md-12 col-lg-8">   
          <div class="p-5 mb-5 bg-white"> 
            <div class="mb-md-5">
             <div class="job-post-item-header d-flex align-items-center">
               <h3> {{(app()->getLocale() == 'ar') ? $job->ar_sub_special : $job->sub_special}} </h3>
                 <div class="ml-auto">
                <span class="border border-warning text-warning py-2 px-2 rounded "> {{  (app()->getLocale() == 'ar') ? $job->ar_status :  $job->status }} </span>
               </div>
             </div>
             
             <div class="job-post-item-body d-block d-md-flex py-3">
               <img src=" {{ asset(Storage::url($job->owner->logo)) }} " alt="Image" class="img-fluid rounded" width="75px" height="75px">
               <div class="m-3 align-self-center"><span class="fl-bigmug-line-portfolio23"></span> <a href="#"> {{ $job->owner->company_name }} </a></div>
               <div class="align-self-center pb-1"><span class="fl-bigmug-line-big104"></span> <span> {{ (app()->getLocale() == 'ar') ? $job->ar_city.' , '.$job->ar_counrty :  $job->city.' , '.$job->counrty }} </span></div>
             </div>
            </div> 
            
            <div class="img-border mb-5">  
                
            </div>
            
            <p class="py-2"> {{  (app()->getLocale() == 'ar') ? $job->ar_description :  $job->description}} </p>
           <p><a href="{{route('apply.notfy' ,[app()->getLocale() , $job->id])}}" class="btn btn-primary  py-2 px-2">{{__('Apply Job')}}</a></p>
          </div>
        </div>

        
           <div class="col-lg-4">
            <div class="p-4 mb-3 bg-white shadow rounded">
              <h3 class="h5 text-black mb-3"> {{__('Contact Information')}}</h3>
              <p class="mb-0 font-weight-bold">{{__('Phone number')}} </p>
              <p class="mb-4"><a href="#">{{(!is_null($about)) ? $about->phone : ''}}</a></p>

              <p class="mb-0 font-weight-bold"> {{__('E-Mail Address')}}   </p>
              <p class="mb-0"><a href="#">{{(!is_null($about)) ? $about->email : ''}}</a></p>

            </div>

            <div class="p-4 mb-3 bg-white shadow rounded">
              <h3 class="h5 text-black mb-3">{{__('More')}} </h3>
              <p> {{app()->getLocale() == 'ar' ? Str::limit($about->ar_about ?? '' , $limit = 180) : Str::limit($about->about ?? '' , $limit = 180)}} </p>
              <p><a href="#" class="btn btn-primary px-3 text-white pill"> {{__('Read More')}} </a></p>
            </div>

          </div>
 
        
      </div>
    </div>
  </div> 



@endsection