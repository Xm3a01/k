@extends('layouts.defultowner')
@section('content')

<div class="unit-5 overlay" style="background-image: url('{{asset('asset/images/hero_1.jpg')}}');">
    <div class="container text-center">
        <h2 class="h3"> {{__('Try searching for free.. You dont need to use a credit card')}}  </h2>
        <p class="mb-0 unit-6 p-3"><a href="index.html">{{__('Home')}}</a> <span class="sep">></span> <span >  {{__('Search CVs Now')}}</span></p>
    </div>
</div>
 
<!-- Start post Area -->
<section class="post-area section-gap">
        <div class="container">
            <div class="row justify-content-center d-flex">
                <div class="col-lg-8 post-list scrolling"> 
                
                  @if($users->count() <= 0 && $orUsers->count() <= 0)
                    <div><code><h2>{{app()->getLocale() == 'ar' ? 'الاتوجد نتائج بحث !' : 'No resulti found !'}}</h2></code></div>
                    @endif
                        @foreach ($users as $user)
                        @if(is_null($user->owner_id))
                        <div class="single-post justify-content-between">
                        <div class="thumb d-flex flex-row justify-content-between">
                        <div class="title d-flex flex-row">
                            <img src=" {{asset(Storage::url($user->avatar))}} " width="110px" class=" py-1" alt=""> 
                              <div class="titles"> 
                                    <p class="m-0">{{$user->name}} <span>-</span><span> {{$user->asub_special}} </span></p>
                                    <h6>{{$user->brith}}</h6>
                                    <h6>{{ $user->birthdate}}</h6>&ensp;&ensp;
                                    
                                    <div class=" d-flex flex-row">			
                                    <h6></h6>
                                </div>
                               
                                </div> 
                             </div> 
                             <ul class="btns"> 
                                <li><a href="{{route('nofy.cv' , [app()->getLocale() , $user->id])}}" class="add"> {{__('Upgrade to see CV')}} </a></li>
                            </ul>
                         </div>
                        @foreach ($user->exps as $exp)
                        <div class="details"> 
                            <hr>
                            <p>{{$exp->summary}} </p>
                            <p class=" "><span class="lnr lnr-map"></span>{{$exp->expert_year}}  سنه</p>
                            <p class=" "><span class="lnr lnr-database"></span> الراتب المتوقع: {{$exp->selary}}</p>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @endforeach

                 @foreach ($orUsers as $exp)
                    @if(is_null($exp->user->owner_id))
                    <div class="single-post justify-content-between">
                        <div class="thumb d-flex flex-row justify-content-between">
                        <div class="title d-flex flex-row">
                            <img src=" {{asset(Storage::url($exp->user->avatar))}} " width="110px" class=" py-1" alt=""> 
                              <div class="titles"> 
                                    <p class="m-0">{{$exp->user->name}} <span>-</span><span> {{$exp->user->sub_special}} </span></p>
                                    <h6>{{$exp->user->brith}}</h6>
                                    <h6>{{ $exp->user->birthdate}}</h6>&ensp;&ensp;
                                    
                                    <div class=" d-flex flex-row">			
                                    <h6>#</h6>
                                </div>
                               
                                </div> 
                             </div> 
                             <ul class="btns"> 
                                <li><a href="{{route('nofy.cv' , [app()->getLocale() , $exp->user->id])}}" class="add"> {{__('Upgrade to see CV')}} </a></li>
                            </ul>
                         </div>
                     
                        <div class="details"> 
                            <hr>
                            <p>{{$exp->summary}} </p>
                            <p class=" "><span class="lnr lnr-map"></span>{{$exp->expert_year}}  سنه</p>
                            <p class=" "><span class="lnr lnr-database"></span> الراتب المتوقع: {{$exp->selary}}</p>
                        </div>
                    </div>
                    @endif
                    {{-- @if(is_null($exp->user->owner_id)) --}}
                    {{-- {{$exp->user}} --}}
                    {{-- @endif --}}
                    @endforeach
                
                
                    {{--@foreach ($users as $user)
                    @if(!$user->owner_id)
                    <div class="single-post justify-content-between">
                        <div class="thumb d-flex flex-row justify-content-between">
                        <div class="title d-flex flex-row">
                            <img src=" {{asset(Storage::url($user->avatar))}} " width="110px" class=" py-1" alt=""> 
                              <div class="titles"> 
                                    <p class="m-0">{{$user->name}} <span>-</span><span> {{$user->sub_special}} </span></p>
                                    <h6>{{$user->brith}}</h6>
                                    <h6>{{ $user->birthdate}}</h6>&ensp;&ensp;
                                    
                                    <div class=" d-flex flex-row">			
                                    <h6></h6>
                                </div>
                               
                                </div> 
                             </div> 
                             <ul class="btns"> 
                                <li><a href="{{route('nofy.cv' , [app()->getLocale() , $user->id])}}" class="add"> {{__('Upgrade to see CV')}} </a></li>
                            </ul>
                         </div>
                            @foreach ($user->exps as $exp)
                        <div class="details"> 
                            <hr>
                            <p>{{$exp->summary}} </p>
                            <p class=" "><span class="lnr lnr-map"></span>{{$exp->expert_year}}  Years</p>
                            <p class=" "><span class="lnr lnr-database"></span> Expect Selary: {{$exp->selary}}</p>
                        </div>
                             @endforeach
                    </div>
                    @endif
                    @endforeach--}}
                         
                    {{-- <div class="col-md-12 text-center mt-5 add-more text-white" data-aos="fade-up" data-aos-delay="50">
                            <a href="#" class="btn rounded p-2 mb-5"><span class="icon-plus-circle"></span> {{__('More')}}    </a>
                          </div> --}}
                 
                </div>
                <div class="col-lg-4 sidebar">
                    <div class="single-slidebar">
                        <h4>Jobs by Location</h4>
                        <ul class="cat-list">
                            @foreach (App\Country::all() as $country)  
                            <li><a class="justify-content-between d-flex" href="category.html"><p>{{ $country->name}}</p><span></span></a></li>
                            @endforeach
                        </ul>
                    </div>

                                         

                    <div class="single-slidebar">
                        <h4>{{__('Job Title')}}</h4>
                        <ul class="cat-list" aria-disabled="true">
                            @foreach (App\Role::all() as $role)
                            <li><a class="justify-content-between d-flex" href="category.html"><p>{{ $role->name}}</p><span></span></a></li>
                            @endforeach
                        </ul>
                    </div>

             
                </div>
            </div>
        </div>	
    </section>
    <!-- End post Area -->



@endsection