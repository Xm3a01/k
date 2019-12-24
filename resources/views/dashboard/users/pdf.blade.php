<!DOCTYPE html>
<html lang=" {{app()->getLocale()}} ">
<head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
         <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if(app()->getLocale() == 'ar')
        <title> {{ config('app.ar_name' )}} </title>
        @else
        <title> {{ config('app.name' )}} </title>
        @endif 
        <link rel="icon" type="image/x-icon" href="{{asset('asset/images/logo.png')}}" />
        
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Work+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href=" {{asset('asset/fonts/icomoon/style.css')}} ">
        
        <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('asset/css/magnific-popup.css')}}">
        <link rel="stylesheet" href=" {{asset('asset/css/jquery-ui.css')}} ">
        <link rel="stylesheet" href=" {{asset('asset/css/owl.carousel.min.css')}} ">
        <link rel="stylesheet" href=" {{asset('asset/css/owl.theme.default.min.css')}} ">
        <link rel="stylesheet" href=" {{asset('asset/css/bootstrap-datepicker.css')}} ">
        <link rel="stylesheet" href=" {{asset('asset/css/animate.css')}} ">
         
        <link href="{{asset('vendor/css/toastr-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href=" {{asset('asset/css/fontawesome.min.css')}} ">  
        <link rel="stylesheet" href=" {{asset('asset/fonts/flaticon/font/flaticon.css')}} ">
        
        <link rel="stylesheet" href=" {{asset('asset/css/aos.css')}} ">
        <link rel="stylesheet" href=" {{asset('asset/css/style.css')}} ">
        
        @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href=" {{asset('asset/css/bootstrap-rtl.css')}}">
        <link rel="stylesheet" href=" {{asset('asset/css/style-ar.css')}}">
        @endif
        <style>
         @media print {
            .break {
                page-break-after: always;
                font-size:35px;
                color:#000;
            }
          }
        </style>
</head>
<body>
    
    <div class="site-section bg-light">
        <div class="container">
          <div class="row  pt-5 px-2 mt-4">
            <div class="col-lg-12 col-md-12 col-sm-12 top2">
              <div class="bg-white rounded  shadow">
                <div class="text-center py-2">
                  <img src="{{ asset(Storage::url($user->avatar)) }}" width="30%" class="rounded-circle p-2" alt="Image">
                 </div>
                <ul>
                  <li class="d-md-flex d-block">
                    <h1 class="px-5 font-weight-bold text-center">{{(app()->getLocale() == 'ar') ? $user->ar_name : $user->name}} {{(app()->getLocale() == 'ar') ? $user->ar_last_name : $user->last_name}}</h1>
                    </li> 
                </ul>
                <dl class="dlist is-fitted text-muted  pt-3 pb-5 px-3 break">
                  <div class="text-center p-2"> 
                    <dd>{{(app()->getLocale() == 'ar') ? $user->ar_country.'-'.$user->ar_city : $user->country.' - '.$user->city}}</dd>
                  </div>
                  <div class="text-center py-3 px-3">
                     <dd>{{ (app()->getLocale() == 'ar') ? $user->ar_role :  $user->role}} 
                        @foreach($user->educations as $key => $edu ) <br> {{$key + 1}} - {{(app()->getLocale() == 'ar') ? $edu->ar_qualification.'  '.$edu->ar_special : $edu->qualification.'  '.$edu->special}} @endforeach 
                      </dd>
                  </div> 
                 </dl>
                 
              </div>
            </div> 
            <div class="col-lg-12 col-md-12 col-sm-12 top2">
            <div class="top1">
             <!--------------- user info // cv info ----------------->
             <div class="bg-white mb-5 rounded break py-4">
               <div class="card pt-5">
                  <div class="card-header  d-flex justify-content-between">
                    <h2 class="font-weight-bold"> {{__('Personal Information')}}  </h2>
                    {{-- <a href="#personalinfo" data-toggle="modal"><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a>  --}}
                  </div>
                  <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                          <th scope="col"><h3>{{__('Name')}}</h3></th> 
                          <td><h3>{{(app()->getLocale() == 'ar') ? $user->ar_name : $user->name}} {{(app()->getLocale() == 'ar') ? $user->ar_last_name : $user->last_name}}</h3></td>
                        </tr>  
                        <tr>
                          <th scope="row"><h3>{{__('Gender')}}</h3></th>
                          <td><h3>{{(app()->getLocale() == 'ar') ? $user->ar_gender : $user->gender}}</h3></td> 
                        </tr>
                        <tr>
                          <th scope="col"><h3>{{__('Place of Birth')}}</h3></th> 
                          <td><h3>{{(app()->getLocale() == 'ar') ? $user->ar_brith : $user->brith}}</h3></td>
                        </tr>
                        <tr>
                          <th scope="col"><h3>{{__('Birth Date')}}</h3></th> 
                          <td><h3>{{$user->birthdate}}</h3></td>
                        </tr>
                        <tr>
                          <th scope="col"> <h3>{{__('Current Housing')}} </h3> </th> 
                          <td> <h3>{{(app()->getLocale() == 'ar') ? $user->ar_country : $user->country}}</h3></td>
                        </tr>
                        <tr>
                          <th scope="col"> <h3>{{__('Social Status')}}</h3> </th> 
                          <td> <h3>{{(app()->getLocale() == 'ar') ? $user->ar_social_status : $user->social_status}}</h3></td>
                        </tr>
                        <tr>
                          <th scope="col"> <h3>{{__('Religion')}} </h3> </th> 
                          <td> <h3>{{(app()->getLocale() == 'ar') ? $user->ar_religion : $user->religion}}</h3></td>
                        </tr>
                        <tr>
                          <th scope="col"><h3>{{__('Identity No')}} </h3> </th> 
                          <td> <h3>{{$user->idint_1.' - '. $user->idint_2}} </h3></td>
                        </tr>
                    </table>
                  </div>
                </div>
               <div class="card py-5">
                <div class="card-header  d-flex justify-content-between">
                  <h2 class="font-weight-bold"> {{__('Contact Information')}} </h2>
                  </div>
                  <div class="card-body">
                      <table class="table table-borderless">
                        <tr>
                          <th scope="col">  <h3>{{__('Phone Number')}}  </h3> </th> 
                          <td> <h3>{{$user->phone_key.''. $user->phone}} </h3></td>
                        </tr> 
                        <tr>
                          <th scope="row"> <h3> {{__('E-Mail Address')}}  </h3> </th>
                          <td> <h3>{{$user->email}} </h3></td> 
                        </tr> 
                      </table>
                  </div>
              </div> 
            </div>
          </div>
        </div>
        <br>
     <div class="col-lg-12 col-md-12 col-sm-12 top2">
         
       <div class="card py-5">
       <div class="card-header d-flex justify-content-between">
         <h2 class="m-0 font-weight-bold">  {{__('Education Information')}} </h2>
        </div>
       <div class=""> 
        @foreach ($user->educations as $education) 
          @if(app()->getLocale() == 'ar')
          <div class="card-body d-flex justify-content-between">
          <table class="table table-borderless">
            <tr> 
                <th scope="col"><h3> {{__('Qualification')}}  </h3></th> 
                <td><h3><span>{{$user->ar_role}}</span>  <span>{{$user->ar_sub_special}}</span>  <span>{{$education->ar_qualification}}</span></h3></td>
            </tr> 
            <tr> 
               <th scope="col"><h3>{{__('University')}}</h3></th>
               <td> <h3>{{$education->ar_university}}</h3></td> 
            </tr>
            <tr> 
               <th scope="col"><h3>{{__('Area')}}</h3></th>
               <td><h3><span>{{$user->ar_country}}</span>- <span>{{$user->ar_city}}</span></h3></td>
            </tr> 
            <tr> 
               <th scope="col"><h3>{{__('Date Of graduation')}}</h3></th>
               <td><h3>{{$education->grade_date}}</h3></td>
            </tr>
            <tr> 
               <th scope="col"><h3>{{__('Average')}}</h3></th>
               <td><h3>{{$education->grade}}</h3></td>
            </tr> 
          </table>
        </div>
            
          @else 
          
          <div class="card-body d-flex justify-content-between">
             <table class="table table-borderless">
               <tr> 
                  <th scope="col"> {{__('Qualification')}}  </th> 
                  <td><span>{{$user->role}}</span> , - <span>{{$user->ar_sub_special}}</span> , <span>{{$education->qualification}}</span></td>  
                </tr> 
               <tr> 
                  <th scope="col">{{__('University')}}</th>
                  <td>{{$education->university}}</td> 
                </tr>
               <tr> 
                <th scope="col">{{__('Area')}}</th>
                <td>{{$user->city}}</td>
               </tr> 
               <tr> 
                 <th scope="col">{{__('Date Of graduation')}}</th>
                 <td>{{$education->grade_date}}</td>
               </tr>
               <tr> 
                <th scope="col">{{__('Average')}}</th>
                <td>{{$education->grade}}</td>
              </tr>
              </table>
             </div>
            
              @endif
                    
                  @endforeach
              </div>
            </div>
   
       <div class="card py-5">
            <div class="card-header  d-flex justify-content-between">
              <h2 class="font-weight-bold">{{__('Language')}}</h2>
              {{-- <a href="#addlanguage" data-toggle= "modal"> <img src=" {{asset('asset/images/pluss.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> --}}
             </div>
              <div class="">
                @foreach ($user->languages as $lang)
                
                  @if(app()->getLocale() == 'ar')
                  
                <div class="card-body d-flex justify-content-between">
                  <table class="table table-borderless">
                     <tr> 
                       <th scope="col"><h3> {{__('Language')}} </h3> </th> 
                       <td><h3>{{$lang->ar_language}}</h3><h3>{{$lang->ar_language_level}} </h3></td> 
                    </tr> 
                  </table>
                  </div>
                  @else
                  <div class="card-body d-flex justify-content-between">
                   <table class="table table-borderless">
                    <tr> 
                       <th scope="col"><h3> {{__('Language')}} </h3> </th> 
                       <td><h3>{{$lang->ar_language}}</h3><h3>{{$lang->ar_language_level}}</h3></td> 
                      </tr>
    
                   </table>
                   </div>
                    @endif
                @endforeach
               
              </div>
          </div>
     </div>
     
     
     {{-- experince --}}
    <div class="col-lg-12 col-md-12 col-sm-12 top2">
      <div class="bg-white mb-3 rounded">
        <div class="card py-5">
           <div class="card-header  d-flex justify-content-between">
              <h2 class="font-weight-bold">{{__('Experience')}}</h2>
              </div>
              <div class="card-body">
                @foreach ($user->exps as $expert)
                 @if(app()->getLocale() == 'ar')
                   <table class="table table-borderless">
                            <tr> 
                                 <th scope="col"> <h3>{{__('Experience years')}}  </h3></th> 
                                <td><h3><span>{{$expert->end_year - $expert->start_year}}  {{__('Year')}}</span> &  <span>{{abs($expert->end_month - $expert->start_month)}} {{__('Month')}}</span> </h3></td>
                            </tr> 
                             <tr> 
                                 <th scope="col"><h3>{{__('Job Title')}}</h3></th> 
                                 <td><h3>{{$expert->ar_level}}</h3></td> 
                            </tr> 
                            <tr> 
                                 <th scope="col"><h3>{{__('Inistitute')}}</h3> </th> 
                                 <td><h3><span>{{$expert->company_name}}</span> - <span>{{$user->ar_country}}</span></h3></td>
                            </tr> 
                            <tr> 
                                <th scope="col"><h3>{{__('Description')}}</h3></th> 
                                <td> <h3>{{$expert->ar_summary}}</h3></td>
                            </tr>
          
                        </table>
                  @else
    
                  <table class="table table-borderless">
                                   <tr> 
                                     <th scope="col"> <h3>{{__('Experience years')}} </h3> </th> 
                                    <td><h3><span>{{$expert->end_year - $expert->start_year}}  {{__('Year')}}</span> &  <span>{{abs($expert->end_month - $expert->start_month)}} {{__('Month')}}</span> </h3></td>
                                    </tr> 
                                     <tr> 
                                     <h3><th scope="col">{{__('Job Title')}}</h3></th> 
                                     <h3><td>{{$expert->ar_level}}</h3></td> 
                                  </tr> 
                                  <tr> 
                                     <h3><th scope="col">{{__('Inistitute')}} </th> </h3>
                                     <h3><td><span>{{$expert->company_name}}</span> - <span>{{$user->ar_country}}</span></td></h3>
                                  </tr> 
                                  <tr> 
                                    <h3><th scope="col">{{__('Description')}}</th> </h3>
                                    <h3><td> {{$expert->ar_summary}}</td></h3>
                                    </tr>
                  
                                </table>
                                
                    @endif
                @endforeach
               
              </div>
          </div>
          </div>
      
      {{-- attachment --}}
     <div class="bg-white mb-3 rounded break">
        <div class="card py-5">
              <div class="card-header  d-flex justify-content-between">
                <h5 class="font-weight-bold">{{__('Attachment')}}</h5>
                {{-- <a href="#addlanguage" data-toggle= "modal"> <img src=" {{asset('asset/images/pluss.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> --}}
               </div>
                <div class="">
                  @foreach ($user->files as $file)
                    
                  <div class="card-body d-flex justify-content-between">
                    <table class="table table-borderless">
                       <tr> 
                         <th scope="col"> {{__('Name')}}  </th> 
                         <td><a href="{{asset(Storage::url($file->file))}}"></a>{{app()->getLocale() == 'ar' ? $file->ar_name : $file->name}}</td> 
                      </tr>
      
                    </table>
                    </div>
                  @endforeach
                 
                </div>
            </div>
          </div> 
         
      
      {{-- reference --}}
      <div class="bg-white mb-3 rounded">
          <div class="card">
              <div class="card-header  d-flex justify-content-between">
                <h5 class="font-weight-bold">{{__('References')}}</h5>
                </div>
                <div class="">
                  @foreach ($user->references as $ref)
                    
                  <div class="card-body d-flex justify-content-between">
                    <table class="table table-borderless">
                       <tr> 
                         <th scope="col"> {{__('Name')}}  </th> 
                         <td> {{app()->getLocale() == 'ar' ? $ref->ar_name : $ref->name}} </td> 
                      </tr>
      
                      <tr> 
                          <th scope="col"> {{__('Email')}}  </th> 
                          <td> {{$ref->email}} </td> 
                       </tr>
      
                       <tr> 
                          <th scope="col"> {{__('Phone Number')}}  </th> 
                          <td>{{$ref->phone}}</td> 
                       </tr>
      
                    </table>
                </div>
                  @endforeach
                 
                </div>
            </div>
          </div> 
</div>
    
      
    </div>
  </div>
</div>

            <script src=" {{asset('asset/js/jquery-3.3.1.min.js')}} "></script>
            <script src=" {{asset('asset/js/jquery-migrate-3.0.1.min.js')}} "></script>
            <script src=" {{asset('asset/js/jquery-ui.js')}} "></script>
            <script src=" {{asset('asset/js/popper.min.js')}} "></script>
            <script src=" {{asset('asset/js/bootstrap.min.js')}} "></script>
            <script src=" {{asset('asset/js/owl.carousel.min.js')}} "></script>
            <script src=" {{asset('asset/js/jquery.stellar.min.js')}} "></script>
            <script src=" {{asset('asset/js/jquery.countdown.min.js')}} "></script>
            <script src=" {{asset('asset/js/jquery.magnific-popup.min.js')}} "></script>
            <script src=" {{asset('asset/js/bootstrap-datepicker.min.js')}} "></script>
            <script src=" {{asset('asset/js/aos.js')}} "></script>
            <script src=" {{asset('asset/js/mediaelement-and-player.min.js')}} "></script>
            <script src=" {{asset('asset/js/main.js')}} "></script>
            <script src="{{asset('vendor/js/toastr.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('vendor/js/ui-toastr.min.js')}}" type="text/javascript"></script>

</body>
</html>