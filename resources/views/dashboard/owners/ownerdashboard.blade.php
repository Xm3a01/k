@extends('layouts.defultowner')
@section('content')
    
<div class="site-section bg-light  " style="padding-top:160px;"> 
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-lg-8 mb-5">  
            <div class="bg-white"> 
                <h3 class="p-3"> {{__('User activity')}}</h3> 
                <div class="row px-3">
                  <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="100">
                    <a href="#" class="h-100 feature-item"> 
                      <h2> {{__('User Login')}}  </h2>
                      <span class="counting px-2">{{Auth::user()->visit_count}} </span>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="200">
                    <a href="#" class="h-100 feature-item"> 
                      <h2> {{__('Currently posted jobs')}} </h2>
                      <span class="counting px-2">{{Auth::user()->jobs->count()}} </span>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="800">
                    <a href="#" class="h-100 feature-item"> 
                      <h2> {{__('Selected applicants')}} </h2>
                      <span class="counting px-2">{{Auth::user()->users->count()}} </span>
                    </a>
                  </div>
                </div>
                 </div>
                 <div class="mt-5">
                  <div class="row ">
                    <div class="col-md-6">
                      <div class="m-2 bg-white p-3  ">
                        <strong><h4 class="p-3 text-center"> {{__('Applicants data')}} </h4> </strong>
                        @foreach ($users as $user)
                            
                        <div class=" d-flex d-md-flex"> 
                            <strong> <a href = "{{route('delete.owner_cv' , [app()->getLocale() , $user->id])}}">x</a> </strong>
                                <img src=" {{asset(Storage::url($user->avatar))}} " alt="Image" class="rounded-circle  img-fluid p-1 w-30" width="25%">
                                <div class="px-3"> 
                                    <p class="m-0 pt-1 font-weight-bold"><a href="">{{$user->ar_name}}</a></p>
                                    <p class="m-0">{{$user->role}}</p> 
                                   </div>
                              </div>
                        @endforeach
                        </div>
                    </div>
                     
                  <div class="col-md-6">
                        <div class="m-2 bg-white">
                          <strong><h4 class="p-4 text-center"> {{__('Jobs declared')}} </h4> </strong> 
                         @if($jobs->count() <= 0)
                            <div class="px-3"> 
                                    <div class="text-center">
                                      <img src=" {{asset('asset/images/sadIcon.png')}} " alt="Image" class="img-fluid p-5">
                                      <p class="pb-3">{{__('There are no new jobs, advertise a new job and start receiving applications')}} </p>
                                      <div class="pb-3">
                                        <a href="{{route('owners.create' , app()->getLocale())}}" class="btn btn-primary">{{ __('Post a job')}}</a>
                                      </div>
                                  </div> 
                              </div>
                              @else
                              @foreach ($jobs as $job)
                            
                               <div class=" d-flex d-md-flex"> 
                                <img src="{{asset(Storage::url($job->owner->logo))}}" alt="Image" class="rounded-circle  img-fluid p-1 w-30" width="25%">
                                <div class="px-3"> 
                                    <p class="m-0 pt-1 font-weight-bold"><a href="">{{(app()->getLocale() == 'ar') ? $job->ar_sub_special : $job->sub_special}}</a></p>
                                    <p class="m-0">{{(app()->getLocale() == 'ar') ? $job->ar_role : $job->role}}</p> 
                                   </div>
                              </div>
                            @endforeach
                            @endif
                            </div>
                        </div>
                        
                  </div>
                </div>
                </div>
            
        
           
          <div class="col-md-4 col-lg-4 mb-5">  
              <form action="{{route('search.cv' , app()->getLocale())}}"  method="GET" class="px-3 py-2 bg-white"> 
                      <h5 class="p-2"> {{__('Quick search for CVs')}}</h5>
                        <div class="row form-group">
                          <div class="col-md-12">
                            <label class="font-weight-bold" for="email"> {{__('Job Title')}}  </label>
                            <input v-model="special" name = "special" list="special" type="text" class=" form-control  px-3" placeholder=" {{__('Job Title')}} " autocomplete = "off">
                            <datalist id="special">
                              @foreach ($sub_specials as $sub)   
                                <option  value="{{ (app()->getLocale() == 'en') ? $sub->name : $sub->ar_name}}">
                                @endforeach
                            </datalist>
                          </div> 
                        <div class="form-group col-md-12">
                              <label for="inputState" style="font-weight: 600;">{{__('Country')}}</label>
                              <input  v-model = "country" name = "place" list="country" type="text" class="form-control  px-3"  placeholder="{{__('City or Country')}}" autocomplete = "off">
                              <datalist id="country">
                                  @foreach ($countries as $county)
                                      <option value="{{ (app()->getLocale() == 'ar') ? $county->ar_name : $county->name}}">
                                  @endforeach
                            </datalist> 
                            </div> 
                          </div>
                        <div class="row form-group">
                          <div class="col-md-12">
                            <input type="submit" value="{{__('Search Now')}}" class="btn btn-primary btn-block px-3">
                          </div>
                        </div> 
                      </form> 
                      
                    <div class=" mt-5 ">
                        <div class="card p-3 text-center" style="border-radius: 5px; background: linear-gradient(124.25deg, #b0f3f7 0%, #01a0c7 100%);">
                            <div class="card-head  py-3">
                              <b> {{__('Start hiring now')}}</b>
                                    </div>
                                    <div class="card-content is-stretched t-inverse">
                                        <i class="icon is-research is-48 t-light"></i>
                                        <h3 class="t-inverse m20y">{{__('Two weeks of CV search')}}</h3>
                                       <h2 class="t-inverse py-3">$675</h2>
                              </div>
                         </div> 
                    </div>
                  </div>  
                </div>
              </div>
            </div> 

@endsection