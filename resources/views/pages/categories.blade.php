@extends('layouts.defult')
@section('content')
 

<div class="unit-5 overlay" style="background-image: url(' {{asset('asset/images/hero_1.jpg')}} ');">
    <div class="container text-center">
      <h2 class="mb-0">اشهر الاصناف</h2>
      <p class="mb-0 unit-6"><a href="index.html">Home</a> <span class="sep">></span> <span>Categories</span></p>
    </div>
  </div>
  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center mb-4 section-heading">
          <h2 class="pt-3">الاصناف الاشهر</h2>
        </div>
      </div>
      <div class="row">
         @foreach ($roles as $role)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="100">
          <a href="#" class="h-100 feature-item">
            <span class="d-block icon flaticon-calculator mb-3 text-primary"></span>
            <h2>{{app()->getLocale() == 'ar' ? $role->ar_name : $role->name}}</h2>
            <span class="counting">{{App\Job::where('role_id' , $role->id)->where('selected',0)->count()}}</span>
          </a>
        </div>
        @endforeach
        
      </div>

    </div>
  </div>



@endsection