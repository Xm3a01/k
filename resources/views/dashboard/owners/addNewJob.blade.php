@extends('layouts.defultowner')
@section('content')
    
<div class="site-section bg-light"> 
    <div class="container">
      <div class="row pt-4">
        <div class="col-md-8 col-lg-8 my-5 pt-5">  
            <div class="bg-white"> 
                <h3 class="p-3"> {{__('New Job')}} </h3>  
                  <form method="POST" action=" {{route('owners.store' , app()->getLocale())}}"  class="form-row p-3 mx-2">
                    @csrf
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">{{ __('Job Role') }}</label>
                     <input class="form-control" list="roles" placeholder="{{__('Role')}}" name ="role" autocomplete="off">
                      <datalist id="roles">
                          @foreach ($roles as $role) 
                          <option value="{{ (app()->getLocale() == 'ar') ? $role->ar_name : $role->name}}">
                          @endforeach 
                      </datalist>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="inputEmail4">{{ __('Job Level') }}</label>
                        <input class="form-control" list="level" placeholder="{{__('Enter level')}}" name ="level" autocomplete="off">
                        <datalist id="level">
                            @foreach ($levels as $level) 
                            <option value="{{ (app()->getLocale() == 'ar') ? $level->ar_name : $level->name}}">
                            @endforeach 
                        </datalist>
                        </div>

                          <div class="form-group col-md-6">
                              <label for="inputEmail4">{{__('Country')}}</label>
                              <input list="country" name="country" id="" class="form-control" autocomplete="off">
                              <datalist id="country" dir="rtl" >
                                @foreach ($countries as $country)    
                                <option value="{{(app()->getLocale() == 'ar') ? $country->ar_name : $country->name}}">
                                @endforeach
                              </datalist>
                            </div>
                    
                            <div class="form-group col-md-6">
                              <label for="inputCity"> {{__('City')}}</label>
                              <input  name="city" list="city" id="" class="form-control">
                              <datalist id="city" >
                                @foreach ($cities as $city)   
                                <option value="{{ (app()->getLocale() == 'ar') ?  $city->ar_name : $city->name}}" >
                                @endforeach
                              </datalist>
                            </div>

                      <div class="form-group col-md-6">
                        <label class=" control-label"> {{__('Main Special')}}  </label>
                          <input name = "special" list="special" type="text" class=" form-control" placeholder=" {{__('Main Special')}} " autocomplete = "off">
                          <datalist id="special">
                            @foreach ($specials as $special)   
                              <option  value="{{ (app()->getLocale() == 'en') ? $special->name : $special->ar_name}} ">
                              @endforeach
                          </datalist>
                        </div> 

                    <div class="form-group col-md-6">
                        <label class=" control-label"> {{__('Sub Special')}}</label>
                        <input name = "sub_special" list="sub_special" type="text" class=" form-control" placeholder=" {{__('Sub Special')}} " autocomplete = "off">
                        <datalist id="sub_special">
                          @foreach ($sub_specials as $sub)   
                            <option  value="{{ (app()->getLocale() == 'en') ? $sub->name : $sub->ar_name}} ">
                            @endforeach
                        </datalist>
                       </div>

                       <div class="form-group col-md-6">
                        <label class=" control-label">{{__('Years of experience')}} </label>
                           <input type="text" class="form-control  " placeholder="{{__('Example: 1 month and 2 years')}}" name="experinse">
                       </div> 
                       
                       <div class="form-group col-md-6">
                        <label class=" control-label">  {{__('Job Status')}} </label>
                          <select class="form-control" name="status">
                              <option selected disabled value=""> {{__('Job Status')}}  </option>
                              <option value="Full time">  {{__('Full Time')}} </option>
                              <option value="Par time">  {{__('Part Time')}} </option>
                           </select>
                          </div> 
            
                       <div class="form-group col-md-12">
                            <label class= "control-label"> {{__('Salary')}}</label>
                            <input type="text" class="form-control  " placeholder="{{__('Example: 5000 - 8000')}}" name="selary">
                          </div>

                          <div class="form-group col-md-12">
                            <label class="control-label">  {{__('Job Describtion')}}</label>
                            <textarea class="form-control" rows="3" name="ar_description"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                              <label class="control-label"> {{__('Job Describtion By English')}}  </label>
                              <textarea class="form-control" rows="3" name="description"></textarea>
                              </div>

                            <div class="form-actions form-groub col-md-12">
                              <div class="row">
                                  <div class="col-md-12">
                                      <button type="submit" class="btn btn-primary btn-block">{{__('Save')}}</button>
                                  </div>
                              </div>
                          </div>
                        </form> 
                     </div> 
                </div>
             
          
           
          <div class="col-md-4 col-lg-4 my-5 pt-5">  
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
                            </datalist> 
                            </div> 
                          </div>
                        <div class="row form-group">
                          <div class="col-md-12">
                            <input type="submit" value="{{__('Search Now')}}" class="btn btn-primary btn-block px-3">
                          </div>
                        </div> 
                      </form> 
             
                      <div class="py-5 px-3 mt-3 bg-white">
                      <div class="d-block d-md-flex text-center">
                          <img src="{{asset('asset/images/lamp-dashboard-icon.png')}}" class="p-3 img-width justify-content-center" alt="">
                          <p>{{__('Get an unlimited number of candidates, advertise your job for 30 days and hire easily with Gulf Waves')}}</p>
                          </div>
                       
                       <div class="">
                           <a href="{{route('job.owner' , app()->getLocale())}}" class="d-flex justify-content-center" style="text-decoration: underline; font-size: 15px; font-weight: 600; cursor: pointer; color:#333">{{__('Search CVs Now')}}</a>
                       </div>
                    </div>
                  </div>  
                </div>
              </div>
            </div>




@endsection