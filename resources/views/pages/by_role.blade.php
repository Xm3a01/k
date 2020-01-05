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
<div class="container">
<div class="row">
  
<div class="col-md-12 scrolling">
<div class="modrn-joblist ">
 <!-- Tags Bar -->
    <div class="filterbar">
        <!--<span class="emlthis">ة</a></span>-->
            <h5 class="pt-2"> {{ $jobs->count()}}  {{__('Research results')}} </h5>
        </div> 
    </div>  
    
    <div class="rounded jobs-wrap">   
    @foreach($jobs as $job)
          <a href="{{route('single.job' ,[app()->getLocale() , $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                <div class="company-logo blank-logo text-center text-md-left pl-3">
                  <img src="{{asset(Storage::url($job->owner->logo))}}" alt="Image" class="img-fluid mx-auto">
                </div>
                <div class="job-details h-100">
                  <div class="p-3 align-self-center">
                   <h3> {{ app()->getLocale() ==  'ar' ? $job->special->ar_name ?? '' : $job->special->name ?? ''}} - {{(app()->getLocale() == 'ar') ? $job->sub_special->ar_name ?? '' : $job->sub_special->name ?? ''}}</h3>
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

            </div>
     
            </div> 
        
   {{-- <div class="col-lg-4 col-md-12 col-sm-12 block-16" data-aos="fade-up" data-aos-delay="200">
    <div class="ad d-flex">
      <h2 class="h3"> {{__('Ad space')}} </h2>
      </div>
     <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner pb-5">
       @foreach($advs as $key => $adv)
          <div class="carousel-item  {{$key == 0 ? 'active' : ''}}">
            <div class="p-0 section-heading overflow-auto">
               <div class=" m-3">
                  <div class="card p-3 text-center scrolling adspace">
                      <div class="card-head h4  py-3">
                        {{app()->getLocale() == 'ar' ? $adv->ar_title : $adv->title}} 
                            </div>
                            <div class="card-content is-stretched t-inverse"> 
                                <h6 class="t-inverse m20y" style=" height: 300px;">{{app()->getLocale() == 'ar' ? $adv->ar_adv : $adv->adv}}</h6>
                              <form name="process_cart5117" id="checkout-form5117"   class="py-3" autocomplete="off">
                                <a class="btn btn-primary text-white" href="{{route('web.contact' , app()->getLocale())}}">   {{__('Contact with Us')}}</a>
                            </form>
                          </div>
                        </div> 
                    </div>
                  </div>  
                </div> 
               @endforeach        
              </div> 
            </div> 
        </div> --}}
   
     
</div> 


</div> 
</div>
</section>



@endsection