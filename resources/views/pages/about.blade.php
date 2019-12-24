@extends('layouts.defult')
@section('content')
    
    
<div class="unit-5 overlay" style="background-image: url(' {{asset('asset/images/hero_1.jpg')}} ');">
    <div class="container text-center">
      <h2 class="mb-0"> {{__('About Company')}}  </h2>
      <p class="mb-0 unit-6"><a href="index.html">{{__('Home')}}</a> <span class="sep">></span> <span>{{__('About Us')}}</span></p>
    </div>
  </div>

  
  <div class="site-section" data-aos="fade">
    <div class="container">
      <div class="row align-items-center">
            <div class="col-md-6 ml-auto">
                    <div class="text-left mb-3 section-heading">
                      <h2>{{__('About Us')}} </h2>
                    </div> 
                    <p class="mb-4 h6 font-italic lineheight1-5">&ldquo; {{app()->getLocale() == 'ar' ? $about->ar_about ?? '' : $about->about ?? ''}} &rdquo;</p>
                    <p>&mdash; <strong class="text-black font-weight-bold"></strong></p>
                    <p><a href="{{Storage::url($about->video ?? '')}}" class="popup-vimeo text-uppercase"> {{__('Watch video')}}    <span class="icon-arrow-left small"></span></a></p>
                  </div>
        <div class="col-md-6 mb-5 mb-md-0"> 
            <div class="img-border">
              <a href="{{Storage::url($about->video ?? '')}}" class="popup-vimeo image-play">
                <span class="icon-wrap">
                  <span class="icon icon-play"></span>
                </span>
                <img src=" {{asset('asset/images/hero_1.jpg')}} " alt="Image" class="img-fluid rounded">
              </a>
            </div> 
        </div>
       
      </div>
    </div>
  </div>
  

  <div class="site-section bg-light mt-5">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <!-- <div class="col-md-7 text-center"> -->
          <div class="col-md-6 text-center mb-2 section-heading">
            <h2 class="mb-3"> {{__('Meet Our Team')}}  </h2>
            <p> {{__('Great things in business are achieved by a team')}}</p>
          </div>
          
        <!-- </div> -->
      </div>
      <div class="row team pb-5">
      @foreach($about->employees as $employee)
        <div class="col-lg-2 col-md-4 col-sm-6 col-12" data-aos="fade" data-aos-delay="100">
          <div class="person text-center">
            <img src="{{Storage::url($employee->employee_photo)}}" alt="Image placeholder">
            <h2>{{app()->getLocale() == 'ar' ? $employee->ar_employee_name : $employee->employee_name}}</h2>
            <p>{{$employee->employee_position}}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- END section -->


@endsection