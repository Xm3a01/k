  
 @extends('layouts.defaultclient')
 @section('content')
 
    
    <div class="unit-5 overlay" style="background-image: url(' {{asset('asset/images/hero_1.jpg')}} ');">
      <div class="container text-center">
        <h2 class="mb-0 h3"> {{__('Add your CV')}}  </h2>
        <p class="mb-0 unit-6 p-3"><a href="index.html"> {{__('Home')}}</a> <span class="sep">></span> <span> {{__('Add your specialty')}}  </span>
        </p>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8 mb-5">
            <form id="regForm" action="{{route('users.update', $user->id)}}" class="p-5 bg-white shadow rounded" method="POST" autocomplete="off">     
                @csrf
                @method('PUT')
                <input type="hidden" name="select" value="user_edit">
                <input type="hidden" name="new_form" value="user_edit">
              <!-- Circles which indicates the steps of the form: -->
              <div class="text-center">
                <span class="step"></span>
                <span class="step"></span> 
              </div>

              <!-- One "tab" for each step in the form: -->
              <div class="tab">
                <div class="row form-group">
                  <h3>{{__('Personal Information')}}</h3>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="inputEmail4">{{__('Name')}} </label>
                      <input type="text" class="form-control" value="{{$user->ar_name}}"  name="ar_name"  placeholder="{{__('First Name')}} " required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4"> {{__('Name by English')}}  </label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}"   placeholder="{{__('Name by English')}}" required>
                      </div>
                  </div>
                  <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="inputEmail4">{{__('Last Name')}} </label>
                      <input type="text" class="form-control" value="{{$user->ar_last_name}}"  name="ar_last_name"  placeholder="{{__('Last Name')}} "  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4"> {{__('Last Name by English')}}  </label>
                        <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}"   placeholder="{{__('Last Name by English')}}" required>
                      </div>
                  </div>
                <!-- -->

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>{{__('Birth Date')}}</label>
                    <input type="date" id="datepicker" width="276" class="form-control" name="brithDate"  value ="{{$user->birthdate}}" required/>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">{{__('Place of Birth')}}</label>
                   <select name="birth_country_id" id="inputState" class="form-control" required>
                      <option selected disabled>{{__('Place of Birth')}}</option>
                      @foreach ($countries as $country)    
                      <option value="{{$country->id}}">{{(app()->getLocale() == 'ar') ? $country->ar_name : $country->name}}</option>
                      @endforeach
                   </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                      <label for="inputEmail4">{{__('Current Housing')}}</label>
                      <select name="country_id" id="inputState" class="form-control" required>
                          <option selected disabled>{{__('Current Housing')}}</option>
                          @foreach ($countries as $country)    
                          <option value="{{$country->id}}">{{(app()->getLocale() == 'ar') ? $country->ar_name : $country->name}}</option>
                          @endforeach
                       </select>
                    </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputState">{{__('Religion')}}</label>
                    <select id="inputState" class="form-control" name="religion" required>
                      <option value="{{$user->religion}}">{{(app()->getLocale() == 'ar') ? $user->ar_religion : $user->religion}}</option>
                      <option value="Muslime">{{__('Muslime')}}</option>
                      <option value="Christian">{{__('Christian')}}</option>
                       <option value="Other">{{__('Other')}}</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="inputState">{{__('Social Status')}} </label>
                    <select id="inputState" class="form-control" name="social_status" required> 
                      <option value="{{$user->social_status}}">{{(app()->getLocale() == 'ar') ? $user->ar_social_status : $user->social_status}}</option>
                      <option value="Married">{{__('Married')}}</option>
                      <option value="Single">{{__('Single')}}</option>
                    </select>
                  </div>

                </div>

                 <div class="form-row">

                   <div class="form-group col-md-6">
                   <label for="inputState">{{__('Passport No.')}}</label> 
                   <input type="text" class="form-control"   placeholder="" name="idint_1" value="{{$user->idint_1}}" required>
                     </div>
                     <div class="form-group col-md-6">
                       <label for="inputAddress2">{{__('National No.')}}</label>
                       <input type="text" class="form-control" id="inputAddress2" placeholder="" name="idint_2" value="{{$user->idint_2}}" required>
                     </div> 
                 </div>
                  
                </div>


              <div class="tab">
                <div class="row form-group">
                  <h3> {{__('Contact Information')}}  </h3>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress"> {{__('Phone Number')}}  </label>
                    <input name="phone" type="text" class="form-control" id="inputAddress" value="{{$user->phone}}" placeholder="  {{__('Enter Phone Number')}}" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputAddress">{{__('E-Mail Address')}}</label>
                    <input name="email" type="text" class="form-control" id="inputAddress"  value="{{$user->email}}" placeholder="  {{__('Enter E-Mail Address')}}" required>
                  </div> 
  
                    <div class="form-group col-md-12">
                      <label for="inputCity"> {{__('City')}}</label>
                      <select name="city_id" id="inputState" class="form-control" required>
                          <option selected disabled>{{__('City')}}</option>
                          @foreach ($cities as $city)    
                          <option value="{{$city->id}}">{{(app()->getLocale() == 'ar') ? $city->ar_name : $city->name}}</option>
                          @endforeach
                       </select>
                    </div> 
                   
                </div>
              </div>
              
              

            

              <div style="overflow:auto;">
                <div style="float:right;">
                  <button type="button" class="btn btn-primary" id="prevBtn" onclick=" nextPrev(-1)">{{__('Previous')}}</button>
                  <button type="button" class="btn btn-primary" id="nextBtn" onclick=" event.preventDefault(); nextPrev(1)">{{__('Next')}}</button>
                </div>
              </div>
         </form>
          </div>


          <div class="col-lg-4">
            <div class="p-4 mb-3 bg-white shadow rounded">
              <h3 class="h5 text-black mb-3"> {{__('Contact Information')}}</h3>
              <p class="mb-0 font-weight-bold">{{__('Phone Number')}} </p>
              <p class="mb-4"><a href="#">{{(!is_null($about)) ? $about->phone : ''}}</a></p>

              <p class="mb-0 font-weight-bold"> {{__('E-Mail Address')}}   </p>
              <p class="mb-0"><a href="#">{{(!is_null($about)) ? $about->email : ''}}</a></p>

            </div>

            <div class="p-4 mb-3 bg-white shadow rounded">
              <h3 class="h5 text-black mb-3">{{__('About Gulf Waves')}} </h3>
              <p> {{ (!is_null($about)) ? app()->getLocale() == 'ar' ?  $about->ar_about : $about->about : '' }} </p>
              <p><a href="{{route('about.footer' , app()->getLocale())}}" class="btn btn-primary px-3 text-white pill"> {{__('Read More')}} </a></p>
            </div>

          </div>

        </div>
      </div>
    </div>


 @endsection