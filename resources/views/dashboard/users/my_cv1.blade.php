@extends('layouts.defaultclient')
@section('stylesheet')

<style>
  .page-break {
      page-break-after: always;
  }
  </style>
@endsection
@section('content')
    <div class="site-section bg-light">
      <div class="container">
        <div class="row  pt-5 px-2 mt-4">
          <div class="col-lg-4 col-md-4 col-sm-12 ">
            <div class="bg-white rounded shadow">
              <div class="text-center">
                <img src="{{ asset(Storage::url($user->avatar)) }} " width="50%" class="rounded-circle p-2" alt="Image">
                <img src=" {{asset('asset/images/edit.png')}} " data-toggle="modal" data-target="#editimage" alt="" class="cursor-pointer align-left float-left" width="4.5%" height="2.5%" style="position:relative; top: 15px; Right: 12rem;" >
                
              </div>
              <ul>
                <li class="d-md-flex d-block">
                  <h5 class="p-2 font-weight-bold">{{(app()->getLocale() == 'ar') ? $user->ar_name : $user->name}}</h5>
                  </li> 
              </ul>
              <dl class="dlist is-fitted text-muted  p-2">
                <div class=" ">
                  <dt>{{__('Country')}} :  </dt>
                  <dd>{{(app()->getLocale() == 'ar') ? $user->ar_country.'-'.$user->ar_city : $user->country.' - '.$user->city}}</dd>
                </div>
                <div class=" ">
                  <dt>{{__('Education')}} :  </dt>
                  <dd><a href="" {{($user->university == null && $user->ar_university == null) ? 'data-toggle = "modal" data-target = "#educationinfo"' : ''}}>
                     {{($user->role == null && $user->ar_role == null) ? __('Add Education info') : (app()->getLocale() == 'ar') ? $user->ar_role :  $user->role}} 
                     - @foreach($user->educations as $key => $edu ) <br> {{$key + 1}} - {{(app()->getLocale() == 'ar') ? $edu->ar_qualification.' - '.$edu->ar_sub_special : $edu->qualification.' - '.$edu->sub_special}} @endforeach
                  </a></dd></br>
                </div>
                <div class=" ">
                  <dt>{{__('Experience')}} :  </dt>
                  @if(is_null($expert))
                  <dd><a href="" data-toggle="modal" data-target="#addexperience"> {{__('Add experience')}}</a></dd>
                  @else
                  <dd><a href="" data-toggle="modal" data-target="#addexperience">{{ $expert->end_year - $expert->start_year}} {{__('Years')}}  {{abs($expert->end_month - $expert->start_month)}} {{__('Months')}}</a></dd>
                  @endif
                </div>
              </dl>
              <div class="text-center p-3" id = "app">
                <a href="{{route('pdf.downlod' , [app()->getLocale() , $user->id])}}" id="download-attachment"
                  class="btn btn-outline-primary px-3  font-weight-bold">
                 {{__('Print')}} </a>
               </div> 
               <div class="p-3">
                  <hr> <p><span class="text-muted">آخر تحديث للسيرة الذاتية:</span> {{$user->updated_at}}</p>
              </div> 
            </div>
          </div> 
          
          <div class="col-lg-8 col-md-8 col-sm-12 ">
            <div class="">
              <!--comlete your cv-->
              <div class="{{(number_format($count, '0', '.', '')-50 >= 80) ? 'border-success' : 'border-danger' }} mb-3 text-center bg-white d-block d-md-flex rounded border-right">
                <div class="p-3">
                   <span class="{{(number_format($count, '0', '.', '')-50 >= 80) ? 'text-success':'text-danger' }} display-4">{{ number_format($count, '0', '.', '')-50}}%</span>
                </div>
                <p class="pt-4 mt-2">
                  أكمل سيرتك الذاتية بنسبة 80% لتكون من أبرز 10% من المستخدمين الأكثر ظهوراً. </p>
              </div>


              <!--------------- user info // cv info ----------------->
     <div class="bg-white mb-3 rounded">
        <div class="card ">
            <div class="card-header  d-flex justify-content-between">
              <h5>المعلومات الشخصية</h5>
              <a href="#personalinfo" data-toggle="modal"><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
            </div>
            <div class="card-body">
              <table class="table table-borderless">
                  <tr>
                    <th scope="col">{{__('Name')}}</th> 
                    <td>{{(app()->getLocale() == 'ar') ? $user->ar_name : $user->name}}</td>
                  </tr> 
                  <tr>
                    <th scope="col">{{__('Last name')}}</th> 
                    <td>{{(app()->getLocale() == 'ar') ? $user->ar_last_name : $user->last_name}}</td>
                  </tr> 
                  <tr>
                    <th scope="row">{{__('Gender')}}</th>
                    <td>{{(app()->getLocale() == 'ar') ? $user->ar_gender : $user->gender}}</td> 
                  </tr>
                  <tr>
                    <th scope="col">{{__('Place of Birth')}}</th> 
                    <td>{{(app()->getLocale() == 'ar') ? $user->ar_brith : $user->brith}}</td>
                  </tr>
                  <tr>
                    <th scope="col">{{__('Birth Date')}}</th> 
                    <td>{{$user->birthdate}}</td>
                  </tr>
                  <tr>
                    <th scope="col"> {{__('Current Housing')}}  </th> 
                    <td>{{(app()->getLocale() == 'ar') ? $user->ar_country : $user->country}}</td>
                  </tr>
                  <tr>
                    <th scope="col"> {{__('Social Status')}} </th> 
                    <td>{{(app()->getLocale() == 'ar') ? $user->ar_social_status : $user->social_status}}</td>
                  </tr>
                  <tr>
                    <th scope="col"> {{__('Religion')}}  </th> 
                    <td>{{(app()->getLocale() == 'ar') ? $user->ar_religion : $user->religion}}</td>
                  </tr>
                  <tr>
                    <th scope="col">{{__('Identity No')}}  </th> 
                    <td>{{$user->idint_1.' - '. $user->idint_2}}</td>
                  </tr>
              </table>
            </div>
          </div>
        </div>


    <div class="bg-white mb-3 rounded">
      <div class="card">
          <div class="card-header  d-flex justify-content-between">
            <h5> {{__('Contact Information')}} </h5>
            <a href="" data-toggle="modal" data-target="#contact" ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
          </div>
            <div class="card-body">
                <table class="table table-borderless">
                  <tr>
                    <th scope="col"> {{__('Phone number')}}  </th> 
                    <td>{{$user->phone_key.''. $user->phone}}</td>
                  </tr> 
                  <tr>
                    <th scope="row"> {{__('E-Mail Address')}}  </th>
                    <td>{{$user->email}}</td> 
                  </tr> 
                </table>
            </div>
        </div>
    </div>
{{-- Education info --}}
  <div class="bg-white mb-3 rounded" id = "app">
        <div class="card">
          <div class="card-body">
              <div class="card-header  d-flex justify-content-between">
                  <h5>  {{__('Education Information')}} </h5>
                  <a href="" data-toggle="modal" data-target="#addeducation"  > + </a>
                </div>
            @foreach ($user->educations as $education) 

                <div class="card-header  d-flex justify-content-between">
                 <a href="{{route('users.edit',[app()->getLocale() , $education->id])}}"><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                </div>


                @if(app()->getLocale() == 'ar')
                <table class="table table-borderless">
                  <tr> 
                      <td><span>{{$user->ar_role}}</span> - <span>{{$user->ar_sub_special}}</span>  , <span>{{$education->ar_qualification}}</span>
                    <div class="float-right d-flex d-md-flex">
                        <img src=" {{asset('asset/images/pencil2.png')}} " class="pl-2" alt="" srcset=""><img src=" {{asset('asset/images/clear-button.png')}} " alt="" srcset=""> 
                    </div> 
                    </td>  
                  </tr> 
                  <tr> 
                      <td> <span>{{__('University Of')}}</span> : <span>{{$education->ar_university}}</span></td> 
                  </tr>
                  <tr> 
                    <td><span>{{$user->ar_country}}</span>- <span>{{$user->ar_city}}</span></td>
                  </tr> 
                  {{-- <tr> 
                      <td><span>{{__('Language')}}</span> : <span>{{$user->ar_language}}</span></td>
                    </tr>
                    <tr> 
                        <td><span>{{__('Language level')}}</span> : <span>{{$user->ar_language_level}}</span></td>
                      </tr> --}}
                  <tr> 
                     <td><span>{{__('Date Of graduation')}}</span> : <span>{{$education->grade_date}}</span></td>
                    </tr>
                    <tr> 
                        <td><span>{{__('Rate')}}</span> : <span>{{$education->grade}}</span></td>
                      </tr>

                </table>
                @else 

                <table class="table table-borderless">
                    <tr> 
                        <td><span>{{$user->role}}</span> , - <span>{{$user->ar_sub_special}}</span> , <span>{{$education->qualification}}</span>
                      <div class="float-right d-flex d-md-flex">
                          <img src=" {{asset('asset/images/pencil2.png')}} " class="pl-2" alt="" srcset=""><img src=" {{asset('asset/images/clear-button.png')}} " alt="" srcset=""> 
                      </div> 
                      </td>  
                    </tr> 
                    <tr> 
                        <td> <span>{{__('University Of')}}</span> : <span>{{$education->university}}</span></td> 
                    </tr>
                    <tr> 
                      <td><span>{{$user->country}}</span>- <span>{{$user->city}}</span></td>
                    </tr> 
                    {{-- <tr> 
                        <td><span>{{__('Language')}}</span> : <span>{{$user->language}}</span></td>
                      </tr>
                      <tr> 
                          <td><span>{{__('Language level')}}</span> : <span>{{$user->language_level}}</span></td>
                        </tr> --}}
                    <tr> 
                       <td><span>{{__('Date Of graduation')}}</span> : <span>{{$education->grade_date}}</span></td>
                      </tr>
                      <tr> 
                          <td><span>{{__('Rate')}}</span> : <span>{{$education->grade}}</span></td>
                        </tr>
                  </table>
                  @endif
                @endforeach
            </div>
          </div>
        </div> 
 
    
        
      
    {{-- end education info --}}

   {{-- lanuage --}}
   <div class="bg-white mb-3 rounded">
      <div class="card">
          <div class="card-header  d-flex justify-content-between">
            <h5>{{__('Lanaguage')}}</h5>
            <br>  
          </div>
            <div class="card-body">
              @foreach ($user->languages as $lang)
              <a href=" {{route('lang.edit', [app()->getLocale() , $lang->id])}} " ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
              <br>
              @if(app()->getLocale() == 'ar')
                <table class="table table-borderless">
                  <tr>
                    <div class="float-right d-flex d-md-flex">
                        <img src=" {{asset('asset/images/pencil2.png')}} " class="pl-2" alt="" srcset=""><img src=" {{asset('asset/images/clear-button.png')}} " alt="" srcset=""> 
                    </div> 
                    </td>  
                  </tr> 
                  <tr> 
                      <td> <span>{{__('Language')}}</span> : <span>{{$lang->ar_language}}</span></td> 
                  </tr>
                  <tr> 
                    <td><span>{{('Language level')}}</span> - <span>{{$lang->ar_language_level}}</span></td>
                  </tr> 
  
                </table>
                @else
  
                <table class="table table-borderless">
                  <tr>
                    <div class="float-right d-flex d-md-flex">
                        <img src=" {{asset('asset/images/pencil2.png')}} " class="pl-2" alt="" srcset=""><img src=" {{asset('asset/images/clear-button.png')}} " alt="" srcset=""> 
                    </div> 
                    </td>  
                  </tr> 
                  <tr> 
                      <td> <span>{{__('Language')}}</span> : <span>{{$lang->language}}</span></td> 
                  </tr>
                  <tr> 
                    <td><span>{{('Language level')}}</span> - <span>{{$lang->language_level}}</span></td>
                  </tr> 
  
                </table>
                  @endif
              @endforeach
              <a href="#addlanguage" data-toggle= "modal"><h3  >{{__('Add lanaguage')}}</h3></a>

            </div>
        </div>
      </div> 
 {{-- end language --}}
 

   {{-- experince --}}
   <div class="bg-white mb-3 rounded">
      <div class="card">
          <div class="card-header  d-flex justify-content-between">
            <h5>{{__('Experience')}}</h5>
            <br>  
          </div>
            <div class="card-body">
              @foreach ($user->exps as $expert)
              <a href=" {{route('expert.edit', [app()->getLocale() , $expert->id])}} " ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
              <br>
              @if(app()->getLocale() == 'ar')
                <table class="table table-borderless">
                  <tr> 
                      <span>{{('Experience years')}}</span> : <span>{{$expert->end_year - $expert->start_year}}  {{__('Years')}}</span> &  <span>{{abs($expert->end_month - $expert->start_month)}} </span>
                    <div class="float-right d-flex d-md-flex">
                        <img src=" {{asset('asset/images/pencil2.png')}} " class="pl-2" alt="" srcset=""><img src=" {{asset('asset/images/clear-button.png')}} " alt="" srcset=""> 
                    </div> 
                    </td>  
                  </tr> 
                  <tr> 
                      <td> <span>{{__('University Of')}}</span> : <span>{{$expert->ar_level}}</span></td> 
                  </tr>
                  <tr> 
                    <td><span>{{$user->ar_country}}</span> - <span>{{$expert->company_name}}</span></td>
                  </tr> 
                  <tr> 
                     <td><span>{{__('Description')}}</span> : <span>{{$expert->ar_summary}}</span></td>
                    </tr>
  
                </table>
                @else
  
                <table class="table table-borderless">
                   <tr> 
                    <span>{{('Experience years')}}</span> : <span>{{$expert->end_year - $expert->start_year}}  {{__('Years')}}</span> &  <span>{{abs($expert->end_month - $expert->start_month)}} </span>
                    <div class="float-right d-flex d-md-flex">
                        <img src=" {{asset('asset/images/pencil2.png')}} " class="pl-2" alt="" srcset=""><img src=" {{asset('asset/images/clear-button.png')}} " alt="" srcset=""> 
                    </div> 
                    </td>  
                  </tr> 
                  <tr> 
                      <td> <span>{{__('Experience Level')}}</span> : <span>{{$expert->level}}</span></td> 
                  </tr>
                  <tr> 
                    <td><span>{{$user->country}}</span>- <span>{{$expert->company_name}}</span></td>
                  </tr> 
                  <tr> 
                     <td><span>{{__('Description')}}</span> : <span>{{$expert->summary}}</span></td>
                    </tr>
                </table>
                  @endif
              @endforeach
             <a href="" data-toggle= "modal" data-target="#addexperience"><h3  >{{__('Add experience')}}</h3></a>

            </div>
        </div>
      </div> 

       </div>
     </div>
   </div>
   </div>
   </div>
 {{-- end experience --}}


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
                    <form method="POST" class="form-row col-md-6" action="{{route('users.store' ,app()->getLocale() )}}" enctype="multipart/form-data" autocomplete="off">
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

<!-- change image model -->
 <div class="modal fade" id="editimage" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content fill-cont">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Change Password')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4" id="result"> 
                <div class="row justify-content-center">
                    <form class="form-row col-md-6" action="{{route('users.update',[app()->getLocale() , $user->id])}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="select" value = "user_edit">
                      <div class="col-md-12 mb-1">
                          <label for="avatar">{{__('Personal photo')}}</label>
                          <input type="file" name="avatar" class="form-control">
                       </div>
                    <div class="form-groub col-md-12">
                    <div class="text-center py-5">
                        <button class="btn btn-primary px-3 " type="submit"> {{__('Save')}} </button> 
                          </div>
                      </div>
  
                    </form>
                </div>
            </div>
        </div> 
    </div>
</div>
 <!-- end change image model -->

<!-- education model -->
 <div class="modal fade" id="addeducation" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-full" role="document">
    <div class="modal-content fill-cont">
        <div class="modal-header">
            <h5 class="modal-title"> {{__('Education info')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body p-4" id="result"> 
            <div class="row justify-content-center">
                <form method="POST" class="form-row col-md-6" action="{{route('users.store' ,app()->getLocale())}}" enctype="multipart/form-data" autocomplete="off">
                  @csrf
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                  <input type="hidden" name="select" value="add_edu">
                    <div class="form-group col-md-12">
                      <label for="inputEmail4">{{__('Certificates')}}</label>
                      <select id="inputState" class="form-control" name="qualification">
                        <option selected hidden value="">{{__('Choose the certificate type')}} </option>
                        <option value="Diploma">{{__('Diploma')}}</option>
                        <option value="Bachelor">{{__('Bachelor')}}</option>
                        <option value="Master">{{__('Master')}}</option>
                        <option value="PH">{{__('PH')}}</option>
                      </select>
                    </div>
                    <div class="form-group col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                          <label for="inputEmail4">{{__('Special')}}</label>
                          <input list ="subspecial" id="inputState" class="form-control" name="sub_special">
                         <datalist id="subspecial">
                      @foreach ($sub_specials as $special)     
                          <option value=" {{(app()->getLocale() == 'ar') ? $special->ar_name : $special->name }}">
                      @endforeach
                    </datalist>
                    </div>
                   </div>
                    <div class="form-group col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="inputEmail4">{{__('Arabic university')}}</label>
                          <input type="text" class="form-control" name="ar_university" id="inputAddress2" placeholder="{{__('Example: Harvard University')}} "value="{{$user->ar_university}}" >
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4"> {{__('university')}}</label>
                            <input type="text" class="form-control" name="university" id="inputAddress2" placeholder="eg. Harvard "value="{{$user->university}}" >
                        </div>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>تاريخ التخرج</label>
                        <input type="date" id="datepicker" width="276" class="form-control" name="grade_date"  value="{{$user->grade_date}}"/>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputEmail4">المعدل</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="مثال: 3.50 من 4.00" name="grade">
                      </div>
                    
                      <button class="btn btn-primary btn-outline" type="submit">save</button>
                  </div>
                </form>

            </div>
        </div>
    </div> 
  </div>
</div>
<!-- end education model -->

<!-- change password model -->
<div class="modal fade" id="changepassword" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-full" role="document">
      <div class="modal-content fill-cont">
          <div class="modal-header">
              <h5 class="modal-title">{{__('Change Password')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body p-4" id="result"> 
              <div class="row justify-content-center">
                  <form class="form-row col-md-6" action="{{route('users.update',[app()->getLocale() , $user->id])}}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value = "{{$user->id}}">
                       <div class="form-group col-md-6">
                      <label for="inputAddress">{{__('Password')}}</label>
                  <input type="password" name="password" class="form-control" id="inputAddress" required placeholder="{{__('Password')}}">
                </div>
                <div class="form-group  col-md-6">
                    <label for="password-confirm" class="">  {{ __('Confirm Password') }} </label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{__('Confirm Password')}}">
                    </div>
                  <div class="form-groub col-md-12">
                  <div class="text-center py-5">
                      <button class="btn btn-primary px-3 " type="submit"> {{__('Save')}} </button> 
                        </div>
                    </div>

                  </form>
              </div>
          </div>
      </div> 
  </div>
</div>
<!-- end change password model -->

<!-- add experience model -->
<div class="modal fade" id="addexperience" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
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
                  <form method="POST" class="form-row col-md-6" action="{{route('users.store', app()->getLocale())}}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">{{__('Last Comany')}}</label>
                    <input type="text" class="form-control" name="company_name" id="inputAddress2" placeholder="{{__('Last Comany')}}" >
                      </div>
                      <div class="form-group col-md-3">      
                            <label for="inputEmail4">{{__('Start year')}}</label>
                            <input type="text" class="form-control" name="start_year" id="inputAddress2" placeholder="2001 مثلا" >
                      </div>

                      <div class="form-group col-md-3">
                          <label>{{__('Start month')}}</label>
                          <input id="datepicker" width="276" class="form-control" name="start_month"  />
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputEmail4">{{__('End year')}}</label>
                          <input type="text" class="form-control" id="inputAddress2" placeholder="مثال: 2003." name="end_year">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">{{__('End month')}}</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="مثال: 1." name="end_month">
                          </div>

                        
                      <div class="form-group col-md-6">
                        <label for="inputEmail4">{{__('Role')}}</label>
                        <input list ="role" id="inputState" class="form-control" name="role">
                        <datalist id="role">   
                          @foreach ($roles as $role)  
                          <option value=" {{(app()->getLocale() == 'ar') ? $role->ar_name : $role->name }}">
                          @endforeach
                        </datalist>
                      </div>

                      <div class="form-group col-md-6">
                          <label for="inputEmail4">{{__('Level')}}</label>
                          <input list ="level" id="inputState" class="form-control" name="level">
                          <datalist id="level">   
                            @foreach ($levels as $level)  
                            <option value=" {{(app()->getLocale() == 'ar') ? $level->ar_name : $level->name }}">
                            @endforeach
                          </datalist>
                        </div>

                      <div class="form-group col-md-6">
                        <label for="inputEmail4">{{__('Sub specialization')}}</label>
                        <input list ="subspecial" id="inputState" class="form-control" name="expertspecial">
                        <datalist id="subspecial">
                          @foreach ($sub_specials as $special)     
                          <option aria-checked="true" value="{{(app()->getLocale() == 'ar') ? $user->ar_special : $user->special }}">
                          <option value=" {{(app()->getLocale() == 'ar') ? $special->ar_name : $special->name }}">
                          @endforeach
                        </datalist>
                        </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('Country')}}</label>
                                <input list="country" name="country" id="inputState" class="form-control" autocomplete="off">
                                <datalist id="country" dir="rtl" >
                                  @foreach ($countries as $country)    
                                  <option value="{{(app()->getLocale() == 'ar') ? $country->ar_name : $country->name}}">
                                  @endforeach
                                </datalist>
                              </div>

                       <div class="form-group col-md-12">
                        <label for="exampleFormControlTextarea1">{{__('Summary')}}</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1"
                          placeholder="أضف المشاريع التي عملت عليها، والأنشطة التي شاركت بها، والإنجازات التي حققتها من خلال سنوات دراستك.."
                          rows="3" name="summary">{{$user->summary}}</textarea>
                      </div>
                      <div class="form-group col-md-12">
                          <label for="exampleFormControlTextarea1">{{__('Arabic Summary')}}</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1"
                            placeholder="أضف المشاريع التي عملت عليها، والأنشطة التي شاركت بها، والإنجازات التي حققتها من خلال سنوات دراستك.."
                            rows="3" name="ar_summary"> {{$user->ar_summary}} </textarea>
                        </div>
                      <div class="col-md-12 mb-1">
                        <input type="file" name="cert_pdf">
                      </div>
                      
                        <button class="btn btn-primary btn-outline" type="submit">save</button>
                    </div>
                  </form>

              </div>
          </div>
      </div> 
  </div>
</div>
<!-- end add experience model -->
 
<!-- personal info model -->
  <div class="modal fade" id="personalinfo" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-full" role="document">
          <div class="modal-content fill-cont">
              <div class="modal-header">
                  <h5 class="modal-title"> {{__(' Edit personal data ')}}    </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body p-4" id="result"> 
                  <div class="row justify-content-center">
                        <form class="form-row col-md-6" method="POST" action="{{route('users.update',[app()->getLocale() , $user->id])}}" autocomplete="off">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="select" value="user_edit">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4"> {{__('Name')}}  </label>
                            <input type="text" class="form-control" value="{{$user->ar_name}}"  name="ar_name"  placeholder="{{__('Enter Name')}}">
                          </div>
                          <div class="form-group col-md-6">
                              <label for="inputEmail4">  {{__('Name by English')}}   </label>
                              <input type="text" class="form-control" name="name" value="{{$user->name}}"   placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> {{__('Last name')}}  </label>
                                <input type="text" class="form-control" value="{{$user->ar_last_name}}"  name="ar_last_name"  placeholder="{{__('Enter Last name')}}">
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="inputEmail4">  {{__('Last name by English')}}   </label>
                              <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}"   placeholder="...">
                            </div>
                            <div class="form-group col-md-6 pr-2">
                                <label for="inputState"
                                  style="vertical-align:bottom; display: table; margin-bottom: 0.5rem;">الجنس</label>
                                <div class="form-check form-check-inline">
                                  <input {{($user->gender == 'Male') ? 'checked' : '' }}  class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                    value="Male">
                                  <label class="form-check-label" for="inlineRadio1">{{__('Male')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input {{($user->gender == 'Female') ? 'checked' : '' }} class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                    value="Female">
                                  <label class="form-check-label" for="inlineRadio2">{{__('Female')}}</label>
                                </div>
                              </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4"> {{__(' Nationality')}}</label>
                            <input list="identity" id="inputState" class="form-control" name="identity" autocomplete="off" value="{{(app()->getLocale() == 'ar') ? $user->ar_country : $user->country}}">
                            <datalist id="identity" >
                                @foreach ($countries as $country)
                                <option  value="{{(app()->getLocale() == "ar") ? $country->ar_name : $country->name}}">      
                                @endforeach
                              </datalist>
                          </div> 
                          <div class="form-group col-md-6">
                            <label>{{__('Birth Date')}}</label>
                            <input type="date" id="datepicker" width="276" class="form-control" name="brithDate" value="{{$user->birthdate}}" />
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">{{__('Place of Birth')}}</label>
                            <input list="country" name="brith_country" id="inputState" class="form-control" autocomplete="off" value="{{(app()->getLocale() == 'ar') ? $user->ar_brith : $user->brith}}">
                            <datalist id="country" dir="rtl" >
                              @foreach ($countries as $country)    
                              <option value="{{(app()->getLocale() == 'ar') ? $country->ar_name : $country->name}}">
                              @endforeach
                            </datalist>
                          </div>

                          <div class="form-group col-md-6">
                              <label for="inputEmail4">{{__('Country')}}</label>
                              <input list="country" name="country" id="inputState" class="form-control" autocomplete="off" value="{{(app()->getLocale() == 'ar') ? $user->ar_country : $user->country}}">
                              <datalist id="country" >
                                @foreach ($countries as $country)    
                                <option value="{{(app()->getLocale() == 'ar') ? $country->ar_name : $country->name}}">
                                @endforeach
                              </datalist>
                            </div>
                            
                            <div class="form-group col-md-6">
                              <label for="inputEmail4">{{__('Role')}}</label>
                              <input list="role" name="role" id="inputState" class="form-control" autocomplete="off" value="{{(app()->getLocale() == 'ar') ? $user->ar_role : $user->role}}">
                              <datalist id="role" >
                                @foreach ($roles as $role)    
                                <option value="{{(app()->getLocale() == 'ar') ? $role->ar_name : $role->name}}">
                                @endforeach
                              </datalist>
                            </div>
        
                          <div class="form-group col-md-6">
                            <label for="inputState">{{('Religion')}}</label>
                            <select id="inputState" class="form-control" name="religion">
                              <option selected hidden value="{{$user->religion}}">{{(app()->getLocale() == 'ar') ? $user->ar_religion : $user->religion}}</option>
                              <option value="Muslime">{{__('Muslime')}}</option>
                              <option value="Christian">{{__('Christian')}}</option>
                              <option value="Gushin">{{__('Gushin')}}</option>
                              <option value="Other">{{__('Other')}}</option>

                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">  {{__('Social Status')}} </label>
                            <select id="inputState" class="form-control" name="social_status">
                                <option selected hidden value="{{$user->social_status}}">{{(app()->getLocale() == 'ar') ? $user->ar_social_status : $user->social_status}}</option>
                              <option value="Married">{{__('Married')}}</option>
                              <option value="Single">{{__('Single')}}</option>
                            </select>
                          </div>
                         
                          <div class="form-group col-md-6">
                          <label for="inputState">{{__('Passpord No')}}</label> 
                          <input type="text" class="form-control"   placeholder="" name="idint_1" value="{{$user->idint_1}}">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputAddress2">{{__('Nationality No')}}</label>
                              <input type="text" class="form-control" id="inputAddress2" placeholder="" name="idint_2" value="{{$user->idint_2}}">
                            </div> 
                          
                          <div class="form-groub col-md-12">
                          <div class="text-center py-5">
                              <button  class="btn btn-primary px-3 " type="submit"> حفظ </button> 
                                </div>
                            </div>

                        </div>
                      </form>
                  </div>
              </div> 
      </div>
  </div>
   </div>
<!-- end personl Modal -->
   
<!-- contact model -->
<div class="modal fade" id="contact" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content fill-cont">
            <div class="modal-header">
                <h5 class="modal-title">تعديل بيانات الاتصال</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4" id="result"> 
            <div class="row justify-content-center">
            <form  class="form-row col-md-6" action="{{route('users.update',[app()->getLocale() , $user->id])}}" method="post" autocomplete="off">
              @csrf
               @method('PUT')
                   <input type="hidden" name="user_id" value="{{$user->id}}" id="">
                        <div class="form-group col-md-6">
                            <label for="inputAddress">رقم الهاتف</label>
                            <input name="phone" type="text" class="form-control" id="inputAddress" value="{{$user->phone}}" placeholder="ادخل الايميل">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputAddress">الايميل</label>
                            <input name="email" type="text" class="form-control" id="inputAddress"  value="{{$user->email}}" placeholder="ادخل الايميل">
                          </div> 
                          <div class="form-group col-md-6">
                              <label for="inputAddress2">السكن الحالي</label>
                              <input  name="city" list="city" id="inputState" class="form-control" autocomplete="off">
                              <datalist id="city">
                               @foreach ($cities as $city)   
                               <option value="{{ (app()->getLocale() == 'ar') ?  $city->ar_name : $city->name}}" >
                               @endforeach
                              </datalist>
                            </div>
          
                            <div class="form-group col-md-6">
                              <label for="inputCity">المدينة</label>
                              <input  name="" list="city" id="inputState" class="form-control">
                              <datalist id="city" >
                               @foreach ($cities as $city)   
                               <option value="{{ (app()->getLocale() == 'ar') ?  $city->ar_name : $city->name}}" >
                               @endforeach
                              </datalist>
                            </div> 
                            
                          <div class="form-groub col-md-12">
                          <div class="text-center py-5">
                          <button class="btn btn-primary px-3 " type="submit"> حفظ </button> 
                          </div>
                      </div>
                  </form>
            </div>
        </div> 
    </div>
</div>
</div>
<!-- end contact model -->
 
 @endsection

 @section('scripts')
 {{-- <script src="{{asset('js/app.js')}}"></script> --}}

 <script src=" {{asset('asset/js/jquery.printPage.js')}} "></script>

 <script>
   $(document).ready(function(){
                  $('#download-attachment').printPage();
                  });
//  const app = new Vue({
//       el: '#app',


//       data: {

//           tag:false,
//           id: '',
//           re: []
        
//       },
//       mounted(){
          
//           },
//       methods: {
//         cvPrint() {
//            .print();
//            document.getElementById('print').print();
//         },
//       }

//       });
// </script>
 @endsection