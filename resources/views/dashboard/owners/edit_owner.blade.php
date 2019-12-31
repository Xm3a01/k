@extends('layouts.defultowner')
@section('content')
    
<div class="site-section bg-light  " style="padding-top:160px;"> 
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-lg-8 mb-5">  
            <div class="bg-white"> 
                <h3 class="p-3"> {{__('Setting')}} </h3> 
                <div class="row container">
                    <div class="col-md-6">{{__('Account Info')}} <p> <code> <small>{{__('Edit your account eg. email ,passowrd')}} </small> </code></p></div>
                    <div class="col-md-6"> <a href="#account" class="float-right" data-toggle="modal"><small>{{__('Edit')}}</small></a>  </div><br>
                    <div class="col-md-6"> {{__('Comapny Info')}} <p> <code> <small> {{__('Edit your company info eg. company name , company role')}}</small> </code></p></div>
                    <div class="col-md-6"><a href="#company" data-toggle="modal" class="float-right"><small>{{__('Edit')}}</small></a> </div><br>
                    <div class="col-md-6">{{__('Job info')}}<p> <code> <small>{{__('Edit your job eg. Job title ,job role')}} </small> </code></p></div>
                    <div class="col-md-6">  <a href=" {{route('job.setting' , [app()->getLocale() , $owner->id])}} " class="float-right"><small>|{{(!$owner->jobs->isEmpty()) ? __('Edit') : ''}}</small></a>  <a class="float-right" href=" {{route('owners.create' , app()->getLocale())}} "><small>{{__('Add')}}</small></a></div>
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
                                <option  value="{{ (app()->getLocale() == 'en') ? $sub->name : $sub->ar_name}} ">
                                @endforeach
                            </datalist>
                          </div> 
                        <div class="form-group col-md-12">
                              <label for="inputState" style="font-weight: 600;">{{__('Country')}}</label>
                              <input  v-model = "country" name = "place" list="country" type="text" class="form-control  px-3"  placeholder="{{__('City or Country')}}" autocomplete = "off">
                              <datalist id="country" v-if="country">
                                  @foreach ($countries as $county)
                                      <option value="{{ (app()->getLocale() == 'ar') ? $county->ar_name : $county->name}} ">
                                  @endforeach
                                  @foreach ($cities as $city)
                                      <option value="{{(app()->getLocale() == 'ar') ? $city->ar_name : $city->name}} ">
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
                                        <h3 class="t-inverse m20y"> {{__('Two weeks of CV search')}}</h3>
                                       <h2 class="t-inverse py-3">$675</h2>
                              </div>
                         </div> 
                    </div>
                  </div>
               </div>
             </div>
         </div> 
    {{-- Start Modal --}}

    <!-- language model -->
   <div class="modal fade" id="account" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title"> {{__('Account Info')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result"> 
                    <div class="row justify-content-center">
                        
                        <form method="POST" class="form-row col-md-6" action="{{route('owners.update' ,[app()->getLocale() , $owner->id] )}}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="select" value="account">
                         
                      <div class="form-row">
                          <div class="form-group col-md-6">
                                       <label for="name" > {{ __('Name') }} </label>
                                        <input id="name" type="text" class="form-control"  name="ar_name" value="{{ $owner->ar_name }}"  autocomplete="name" autofocus>
                                    </div>
                          
                       <div class="form-group col-md-6">
                        <label for="name" > {{ __('Name by English') }} </label>
                                
                                <input id="name" type="text" class="form-control"  name="name" value="{{ $owner->name }}"  autocomplete="name" autofocus>
                            </div> 

                             <div class="form-group col-md-6">
                                            <label for="ar_last_name" > {{ __('Last Name') }} </label>
                                                    
                                                    <input id="ar_last_name" type="text" class="form-control" name="ar_last_name" value="{{ $owner->ar_last_name }}"   autofocus>
                        
                                                </div>
                                                
                            <div class="form-group col-md-6">
                                <label for="last_name" > {{ __('Last Name by English') }} </label>
                                        
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $owner->last_name }}"  autocomplete="last_name" autofocus>
            
                                    </div>

                                   
                    
            
                        <div class="form-group col-md-12">
                                <label for="email" class=" "> {{ __('E-Mail Address') }} </label>
                
                                    <input id="email" type="email" class="form-control " name="email" value="{{ $owner->email }}"  autocomplete="email">

                                </div>


                            <div class="form-group col-md-12 pr-2">
                                    <label for="inputState"
                                    style="vertical-align:bottom; display: table; margin-bottom: 0.5rem;"> {{__('Gender')}}</label>
                                    <div class="form-check form-check-inline">
                                    <input {{($owner->gender == 'Male') ? 'checked' : ''}}  class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                        value="Male">
                                    <label class="form-check-label" for="inlineRadio1">{{__('Male')}}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input {{($owner->gender == 'Female') ? 'checked' : ''}} class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                        value="Female">
                                    <label class="form-check-label" for="inlineRadio2">{{__('Female')}}</label>
                                    </div>
                                </div>
                        
                
                            <div class="form-group  col-md-6">
                            <label for="password"  > {{ __('Password') }} </label>
    
                                <input id="password" type="password" class="form-control" name="password"  >
                            </div>
                    

                        <div class="form-group  col-md-6">
                            <label for="password-confirm" class="">  {{ __('Confirm Password') }} </label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  >
                            </div>
                            </div>
                                
                                <button class="btn btn-primary btn-block" type="submit">{{__('Save')}}</button>
                            </div>
                            </form>
    
                    </div>
                </div>
            </div> 
        </div>
    </div> 
    <!-- end language model -->

    <!-- language model -->
   <div class="modal fade" id="company" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Company Data')}}  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
              <div class="modal-body p-4" id="result"> 
             <div class="row justify-content-center">
              <form action="{{route('owners.update' , [app()->getLocale() , Auth::user()->id])}}" method="post" id="submit-job-form" class=" " enctype="multipart/form-data">
                @csrf
                @method('PUT')
                 <!-- Company Information Fields -->
                   <input type="hidden" name="select" value="company">
                     <label for="company_name"> {{__('Company Name')}}   </label>
                    <div class="field required-field">
                         <input type="text" class="input-text" name="company_name" id="company_name" placeholder="أدخل اسم الشركة" value=" {{$owner->company_name}} " maxlength="" >
                    </div>

                    <label for="application"> {{__('Work email / URL')}}  </label>
                    <div class="field required-field">
                        <input type="text" class="input-text" name="company_email" id="application" value=" {{$owner->company_email}} " placeholder="Enter an email address or website URL" value="" maxlength="" >
                    </div>
                        
                    
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">{{__('Role')}}</label>
                        <select name="role_id" id="inputState" class="form-control">
                            <option selected disabled>{{__('Role')}}</option>
                            @foreach ($roles as $role)  
                            <option {{ $owner->role_id == $role->id ? 'selected' : ''}} value="{{ $role->id }}">{{ $role->ar_name }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('Country')}}</label>
                            <select name="country_id" id="inputState" class="form-control">
                                <option selected disabled>{{__('Country')}}</option>
                                @foreach ($countries as $country) 
                                <option {{$owner->country_id == $country->id ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->ar_name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('City')}}</label>
                            <select name="city_id" id="inputState" class="form-control">
                                <option selected disabled>{{__('City')}}</option>
                                @foreach ($cities as $city) 
                                <option {{$owner->city_id == $country->id ? 'selected' : ''}} value="{{ $city->id }}">{{ $city->ar_name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
             
                      
                        <label for="job_description"> {{__('Description')}}  </label> 
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ar_description"> {{$owner->ar_description }} </textarea>
                           
                        <label for="job_description">{{__('Description by English')}}</label> 
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{  $owner->description}} </textarea>

                           
                                
                    <label for="company_logo" class="file-field-label">{{__('Logo')}}</label>  <small class="description file-field-description">
                            Maximum file size: 2 MB.	</small> 
                    <input type="file" class="input-text listify-file-upload" data-file_types="jpg|jpeg|gif|png" name="company_logo" value=" {{$owner->logo}} " id="company_logo" placeholder="">
                     <button type="submit" class="btn btn-primary btn-block my-3">{{__('Edit')}}</button>
                    </form> 
    
                    </div>
                </div>
            </div> 
        </div>
    </div> 
    <!-- end language model -->

    <!-- language model -->
   <div class="modal fade" id="addlanguage" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title"> {{__('Experinces info')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result"> 
                    <div class="row justify-content-center">
                        <form method="POST" class="form-row col-md-6" action="{{route('users.store' ,app()->getLocale() )}}" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="select" value="lang">
                         
                              
                            <div class="form-group  col-md-6">
                              <label for="inputEmail4">{{__('Language')}}</label>
                              <select id="inputState" class="form-control"  name = "language">
                                 <option disabled selected  value="" > {{__('Select language')}} </option>
                             
                                <option value="Arabic " >{{(app()->getLocale() == 'ar') ? 'عربي' : 'Arabic' }}</option>
                                <option value="English " >{{(app()->getLocale() == 'ar') ? 'انجليزي' : 'English' }}</option>
                              </select>
                            </div>
    
                            <div class=" form-group  col-md-6">
                              <label for="inputEmail4">{{__('Language level')}}</label>
                              <select id="inputState" class="form-control"  name = "language_level">
                                <option disabled selected  value="" > {{__('Select language level')}} </option>
                               
                                <option value="Beginner " >{{(app()->getLocale() == 'ar') ? 'مبتدئي' : 'Beginner' }}</option>
                                <option value="Intermediate " >{{(app()->getLocale() == 'ar') ? 'متوسط' : 'Intermediate' }}</option>
                                <option value="Mother tounge " >{{(app()->getLocale() == 'ar') ? 'للغه الاساسيه' : 'Mother tounge' }}</option>
                              </select>
                            </div>
                              
                              <button class="btn btn-primary " type="submit">save</button>
                          </div>
                        </form>
    
                    </div>
                </div>
            </div> 
        </div>
    </div> 
    <!-- end language model -->



@endsection