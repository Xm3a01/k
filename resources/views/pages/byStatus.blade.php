@extends('layouts.defult')
@section('content')
 

<div class="unit-5 overlay" style="background-image: url(' {{asset('asset/images/hero_1.jpg')}} ');">
    <div class="container text-center">
      <h2 class="mb-0"> {{__('Job Status')}} </h2>
      <p class="mb-0 unit-6"><a href="index.html">Home</a> <span class="sep">></span> <span>Categories</span></p>
    </div>
  </div>
  <div class="site-section bg-light" id="scroll-here">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
            <h3 class="mb-4 new-job"> {{__('Jobs')}}  </h3>
            <div class="rounded jobs-wrap">
                         @foreach ($jobs as $job)
                            <a href="{{route('single.job' ,[app()->getLocale() , $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                                   <div class="company-logo blank-logo text-center text-md-left pl-3">
                                     <img src="{{ asset(Storage::url($job->owner->logo))}}" alt="Image" class="img-fluid mx-auto">
                                   </div>
                                   <div class="job-details h-100">
                                     <div class="p-3 align-self-center">
                                      <h3> {{(app()->getLocale() == 'ar') ? $job->ar_sub_special : $job->sub_special}} </h3>
                                      <div class="d-block d-lg-flex">
                                       <p class="m-0">{{$job->yearsOfExper}}</p>
                                        <span class="mr-3"> {{date('F d, Y', strtotime($job->created_at))}} </span> 
                                          </div>
                                       <div class="d-block d-lg-flex"> 
                                         <div ><span class="icon-suitcase mr-1 ml-2"></span> {{$job->owner->company_name}} </div>
                                         <div class="mr-3" ><span class="icon-money mr-1"> {{$job->selary}} </span></div>
                                       </div>
                                       </div>
                                   </div>
                                   <div class="job-category align-self-center">
                                     <div class="p-3">
                                       <span class="text-info p-2 rounded border border-info">{{(app()->getLocale() == 'ar') ? $job->ar_status : $job->status}}</span>
                                     </div>
                                   </div>
                                 </a> 
                              @endforeach 
                           
                                  </div> 
  
           <div class="col-md-12 text-center p-4" data-aos="fade-up" data-aos-delay="50">
              <a href="#" class="btn rounded p-2 mb-1">  {{__('More Jobs')}}  </a>
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



@endsection