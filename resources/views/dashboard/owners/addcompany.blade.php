@extends('layouts.defultowner')
@section('content')

<div class="container-fluid bg-light pt-5">
    <div class="row  justify-content-center pt-5"> 
       <div class="col-sm-6 col-md-6 col-md-offset-1 mt-4">   
        <div class="entry-content pb-1  px-3 bg-white my-3 shadow"> 
            <form action="{{route('owners.update' , [app()->getLocale() , Auth::user()->id])}}" method="post" id="submit-job-form" class=" " enctype="multipart/form-data">
                @csrf
                @method('PUT')
                 <!-- Company Information Fields -->
                 <input type="hidden" name="select" value="company">
                    <h3 class="text-center pt-3 pb-3">{{__('Company Data')}} </h3>
                    <div class="form-row">
                        
                    <div class="form-group col-md-12">
                    <label for="company_name"> {{__('Company Name')}} </label>
                    <div class="field required-field">
                         <input type="text" class="input-text" name="company_name" id="company_name" placeholder="{{__('Company Name')}}" value="" maxlength="" required="">
                    </div>
                    </div>
                    
                     <div class="form-group col-md-12">
                    <label for="application"> {{__('Work email / URL')}} </label>
                    <div class="field required-field">
                        <input type="text" class="input-text" name="company_email" id="application" placeholder="{{__('Enter an email address or website URL')}}" value="" maxlength="" required="">
                    </div>
                    </div> 
                 
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">{{__('Role')}}</label>
                        <select name="role_id" id="inputState" class="form-control">
                                <option selected disabled>{{__('Role')}}</option>
                                @foreach ($roles as $role)  
                                <option  value="{{ $role->id }}">{{ $role->ar_name }}</option>
                                @endforeach
                            </select>
                        </div> 

                    <div class="form-group col-md-12">
                        <label for="inputEmail4">{{__('Country')}}</label>
                        <select name="country_id" id="inputState" class="form-control">
                                  <option selected disabled>الدوله</option>
                                @foreach ($countries as $country) 
                                  <option  value="{{ $country->id }}">{{ $country->ar_name }}</option>
                                @endforeach
                            </select>
                        </div> 
                     
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('City')}}</label>
                            <select name="city_id" id="inputState" class="form-control">
                                    <option selected disabled>{{__('City')}}</option>
                                  @foreach ($cities as $city) 
                                    <option  value="{{ $city->id }}">{{ $city->ar_name }}</option>
                                  @endforeach
                                </select>
                            </div>
                         
                          <div class="form-group col-md-12">
                            <label for="job_description">{{__('Description by Arabic')}}</label> 
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ar_description"></textarea>
                        </div>
                         
                       <div class="form-group col-md-12">
                        <label for="job_description">{{__('Description by English')}}</label> 
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                        </div>
                        
                      
                            
                             <div class="form-group col-md-12">
                                <label for="company_logo" class="file-field-label">{{__('Logo')}}</label>  <small class="description file-field-description">
                                        Maximum file size: 2 MB.	</small>
                                <input type="file" class="input-text listify-file-upload form-control" data-file_types="jpg|jpeg|gif|png" name="company_logo" id="company_logo" placeholder="">
                                 </div>
                                 </div>
                                    
                            <button type="submit" class="btn btn-primary btn-block my-3">{{__('Register')}}</button>
                    </form> 
             </div> 
           </div>
           <div class="col-md-4 pt-3">
                <div class="mt-4 ml-3  bg-white p-3 shadow">
                <h3 class=" "> {{__('Search CV')}} </h3>
                <ul class="steps">
                    <li class="step-active">{{__('Find the best CVs quickly')}}</li>
                    <li class="step-active">{{__('Receive Job Seeakers CVs interested in working for you')}}</li>
                    <li class="step-active">{{__('Connect with the competencies that suit your company through the Gulf Waves website')}}</li>
                    <li class="step-active">{{__('With Gulf Waves, join the largest community of physicians in the Middle East of all medical specialties and professional levels')}}</li>
                </ul> 
              
                  <h3 class=" ">  {{__('Job Postings')}} </h3>
                  <ul class="steps">
                      <li class="step-active">{{__('Post your jobs before the category of professionals that interest you')}} </li>
                      <li class="step-active">{{__('Advertise your job to reach the perfect employee through Gulf Waves Middle East')}}</li>
                      <li class="step-active">{{__('Fast and local support 24/7 provided by Gulf Waves Office')}}</li>
                      <li class="step-active">{{__('We speak Arabic and English')}}</li> 
                  </ul> 
                </div>
        
            </div>
         </div>
    </div>
 
    
@endsection