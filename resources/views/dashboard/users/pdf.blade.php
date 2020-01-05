<!DOCTYPE html>
<html lang=" {{app()->getLocale()}} ">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        
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

<style>
    .cursor-pointer {
      display:none;
}

   .m-btn {
       border-radius: 20px;
       background:green;
       color: #fff;
       width:auto;
       display:none;
   }
</style>
    <div class="site-section bg-light "> 
      <div class="container">
        <div class="row  pt-5 px-2 mt-4">
          <div class="col-lg-4 col-md-4 col-sm-12 top2 pt-5">
            <div class="bg-white rounded shadow">
              <div class="text-center">
                <img src="{{ asset(Storage::url($user->avatar)) }} " class="rounded-circle p-2" alt="Image" style="width:159px; height:159px">
                <img src=" {{asset('asset/images/edit.png')}} " data-toggle="modal" data-target="#editimage" alt="" class="cursor-pointer edit-img" width="4.5%" height="2.5%">
                </div>
              <ul>
                <li class="d-md-flex d-block">
                  <h5 class="py-2 px-4 font-weight-bold">{{(app()->getLocale() == 'ar') ? $user->ar_name.' '.$user->ar_last_name : $user->name.' '.$user->last_name}}</h5>
                  </li> 
              </ul>
                <table class="table table-borderless mx-3">
                  <tr>
                  <th width="25%">{{__('Country')}} </th>
                  <td>@if(app()->getLocale() == 'ar')
                   {{$user->country->ar_name ?? ''}} - {{$user->city->ar_name ?? '' }}
                   @else
                   {{$user->country->name ?? '' }} -  {{$user->city->name ?? ''}}
                   @endif</td>
                  </tr>
                
                  <tr>
                  <th>{{__('Education')}} </th>
                  <td>
                    <a href="" data-toggle = "modal" data-target = "#educationinfo">
                     {{($user->role_id  == null) ? __('Add Education info') : (app()->getLocale() == 'ar') ? $user->role->ar_name ?? '' :  $user->role->name ?? ''}} 
                        @foreach($user->educations as $key => $education ) @if($user->educations->contains($education))  <br> {{$key + 1}} - {{(app()->getLocale() == 'ar') ? $education->ar_qualification.' - '.$education['special']['ar_name'] ?? '': $education->qualification.' - '.$education['special']['name'] ?? ''}} @endif @endforeach
                       {{-- @foreach($user->educations as $education ) {{$education['sub_special']['ar_name']}} @endforeach  --}}
                    {{-- {{(app()->getLocale() == 'ar') ? $user->sub_special->ar_name ?? '':$user->sub_special->name ?? ''}} --}}
                    </a></td>
                  </tr>
                
                  <tr>
                  <th>{{__('Experience')}} </th>
                  @if(is_null($expert))
                  <td><a href="" data-toggle="modal" data-target="#addexperience"> {{__('Add Experience')}}</a></td>
                  @else
                  <td><a href="" data-toggle="modal" data-target="#addexperience">{{ abs($expert->end_year - $expert->start_year) }} {{__('Years')}}  {{abs($expert->end_month - $expert->start_month)}} {{__('Months')}}</a></td>
                  @endif
                </tr>
              </table>
               <div class="text-center p-3">
               </div> 
               <div class="p-3">
                  
              </div> 
            </div>
          </div> 
          <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="top1">
                <!--comlete your cv-->
                
                <!--------------- user info // cv info ----------------->
                <div class="bg-white mb-3 rounded">
                    <div class="card ">
                        <div class="card-header  d-flex justify-content-between">
                          <h5 class="font-weight-bold"> {{__('Personal Information')}}  </h5>
                          <a href="#personalinfo" data-toggle="modal"><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                        </div>
                        <div class="card-body">
                          <table class="table table-borderless">
                              <tr>
                                <th scope="col">{{__('First Name')}}</th> 
                                <td>{{(app()->getLocale() == 'ar') ? $user->ar_name : $user->name}}</td>
                              </tr> 
                              <tr>
                                <th scope="col">{{__('Last Name')}}</th> 
                                <td>{{(app()->getLocale() == 'ar') ? $user->ar_last_name : $user->last_name}}</td>
                              </tr> 
                              <tr>
                                <th scope="col">{{__('Specialization')}}</th> 
                                <td>{{(app()->getLocale() == 'ar') ? $user->special->ar_name ?? '' : $user->special->name ?? ''}}</td>
                              </tr> 
                              <th scope="row">{{__('Job Level')}}</th>
                                <td>{{ $user->level ?? ''}}</td> 
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
                                <td>{{(app()->getLocale() == 'ar') ? $user->country->ar_name ?? '' : $user->country->name ?? ''}}</td>
                              </tr>
                              <tr>
                                <th scope="col"> {{__('Current City')}}  </th> 
                                <td>{{(app()->getLocale() == 'ar') ? $user->city->ar_name ?? '' : $user->city->name ?? ''}}</td>
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
                        <h5 class="font-weight-bold"> {{__('Contact Information')}} </h5>
                        <a href="" data-toggle="modal" data-target="#contact" ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                      </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                              <tr>
                                <th scope="col"> {{__('Phone Number')}}  </th> 
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
                
                
                <!-- Education info -->
                  <div class="bg-white mb-3 rounded" id = "app">
                   <div class="card">
                     <div class="card-header  d-flex justify-content-between">
                       <h5 class="m-0 font-weight-bold">  {{__('Education Information')}} </h5>
                        <a href="" data-toggle="modal" data-target="#addeducation" ><img src=" {{asset('asset/images/pluss.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                      </div>
                    <div class=""> 
                                
                    @foreach ($user->educations as $education) 
                
                      @if($user->educations->contains($education)) 
                        @if(app()->getLocale() == 'ar')
                        <div class="card-body d-flex justify-content-between">
                        <table class="table table-borderless">
                          <tr> 
                              <th scope="col"> {{__('Qualification')}}  </th> 
                              <td> <span>{{$education['special']['ar_name'] ?? ''}}</span> - <span>{{$user->role->ar_name}}</span> - <span>{{$education->ar_qualification}}</span></td>
                          </tr> 
                          <tr> 
                             <th scope="col">{{__('University')}}</th>
                             <td> {{$education->ar_university}}</td> 
                          </tr>
                          <tr> 
                             <th scope="col">{{__('Area')}}</th>
                             <td><span>{{$user->country->ar_name}}</span>- <span>{{$user->city->ar_name}}</span></td>
                          </tr> 
                          <tr> 
                             <th scope="col">{{__('Graduation Date')}}</th>
                             <td>{{$education->grade_date}}</td>
                          </tr>
                          <tr> 
                             <th scope="col">{{__('Average')}}</th>
                             <td>{{$education->grade}}</td>
                          </tr> 
                        </table>
                             <a href="{{route('users.edit',[app()->getLocale() , $education->id])}}"><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                            <form  action ="{{route('users.destroy',[app()->getLocale() , $education->id] )}}" method='post'>
                            @csrf
                            @method('DELETE')
                            <input type ="hidden" name ="select" value ="edu">
                             <button type ="submit" class ="delete" ><img src=" {{asset('asset/images/cross.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></button>
                            </form>
                          </div>
                          
                        @else 
                        
                        <div class="card-body d-flex justify-content-between">
                           <table class="table table-borderless">
                             <tr> 
                                <th scope="col"> {{__('Qualification')}}  </th> 
                                <td><span>{{$user->role->name}}</span> - <span>{{$education['special']['name'] ?? ''}}</span> -  <span>{{$education->qualification}}</span></td>  
                             </tr> 
                             <tr> 
                                <th scope="col">{{__('University Of')}}</th>
                                <td>{{$education->university}}</td> 
                             </tr>
                             <tr> 
                              <th scope="col">{{__('Area')}}</th>
                              <td>{{$user->city->name}}</td>
                             </tr> 
                             <tr> 
                               <th scope="col">{{__('Date Of graduation')}}</th>
                               <td>{{$education->grade_date}}</td>
                             </tr>
                             <tr> 
                              <th scope="col">{{__('Rate')}}</th>
                              <td>{{$education->grade}}</td>
                            </tr>
                            </table>
                             <a href="{{route('users.edit',[app()->getLocale() , $education->id])}}"><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                            <form  action ="{{route('users.destroy',[app()->getLocale() , $education->id] )}}" method='post'>
                            @csrf
                            @method('DELETE')
                            <input type ="hidden" name ="select" value ="edu">
                             <button type ="submit" class ="delete" ><img src=" {{asset('asset/images/cross.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></button>
                            </form>
                            </div>
                          
                            @endif
                            @endif 
                                @endforeach
                            </div>
                          </div>
                         </div>
                         
                 
                <!-- language info -->  
                   <div class="bg-white mb-3 rounded">
                      <div class="card">
                          <div class="card-header  d-flex justify-content-between">
                            <h5 class="font-weight-bold">{{__('Languages')}}</h5>
                            <a href="#addlanguage" data-toggle= "modal"> <img src=" {{asset('asset/images/pluss.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a>
                           </div>
                            <div class="">
                              @foreach ($user->languages as $lang)
                              
                                @if(app()->getLocale() == 'ar')
                                
                              <div class="card-body d-flex justify-content-between">
                                <table class="table table-borderless">
                                   <tr> 
                                     <th scope="col"> {{__('Language')}}  </th> 
                                     <td>{{$lang->ar_language}}</td> 
                                  </tr>
                                  <tr>  
                                      <th scope="col"> {{__('Language Level')}}  </th> 
                                      <td>{{$lang->ar_language_level}} </td>
                                  </tr> 
                  
                                </table>
                                 <a href=" {{route('lang.edit', [app()->getLocale() , $lang->id])}} " ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                                <form  action ="{{route('users.destroy',[app()->getLocale() , $lang->id] )}}" method='post'>
                                @csrf
                                @method('DELETE')
                                <input type ="hidden" name ="select" value ="lang">
                                 <button type ="submit" class ="delete" ><img src=" {{asset('asset/images/cross.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></button>
                                 </form>
                              </div>
                                @else
                                <div class="card-body d-flex justify-content-between">
                                 <table class="table table-borderless">
                                <tr> 
                                    <th scope="col"> {{__('Language')}}  </th> 
                                    <td> {{$lang->language}}</td> 
                                  </tr>
                                  <tr> 
                                    <th scope="col"> {{__('Language Level')}}  </th> 
                                    <td>{{$lang->language_level}}</td>
                                  </tr> 
                  
                                </table>
                                 <a href=" {{route('lang.edit', [app()->getLocale() , $lang->id])}} " ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                                 <form  action ="{{route('users.destroy',[app()->getLocale() , $lang->id] )}}" method='post'>
                                @csrf
                                @method('DELETE')
                                <input type ="hidden" name ="select" value ="lang">
                                 <button type ="submit" class ="delete" ><img src=" {{asset('asset/images/cross.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></button>
                                 </form>
                           
                                </div>
                                  @endif
                              @endforeach
                             
                            </div>
                        </div>
                      </div>  
                 
                
                <!-- Experience info -->
                <div class="bg-white mb-3 rounded">
                      <div class="card">
                          <div class="card-header  d-flex justify-content-between">
                           <h5 class="font-weight-bold">{{__('Experience')}}</h5>
                            <a href="#addexperience" data-toggle= "modal"> <img src=" {{asset('asset/images/pluss.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a>
                           </div>
                            <div class=""> 
                              @foreach ($user->exps as $expert)
                              
                              @if($user->exps->contains($expert)) 
                                @if(app()->getLocale() == 'ar')
                                <div class="card-body d-flex justify-content-between">
                                <table class="table table-borderless">
                                   <tr> 
                                     <th scope="col"> {{__('Experience years')}}  </th> 
                                    <td><span>{{$expert->end_year - $expert->start_year}}  {{__('Year')}}</span> &  <span>{{abs($expert->end_month - $expert->start_month)}} {{__('Month')}}</span> </td>
                                    </tr> 
                                     <tr> 
                                     <th scope="col">{{__('Job Level')}}</th> 
                                     <td>{{$expert->level ?? ''}}</td> 
                                  </tr> 
                                  <tr> 
                                     <th scope="col">{{__('Inistitute')}} </th> 
                                     <td><span>{{$expert->company_name}}</span> - <span>{{$user->country->ar_name}}</span></td>
                                  </tr> 
                                  <tr> 
                                    <th scope="col">{{__('Description')}}</th> 
                                    <td> <p></p>{{Str::limit($expert->ar_summary , $limit = 40)}}<p></p></td>
                                    </tr>
                                    
                                    <tr> 
                                    <th scope="col">{{__('File')}}</th> 
                                   <td> <form method = "POST" action ="{{route('user.download' ,$user->id)}}" enctype="multipart/form-data"> 
                                        @csrf
                                        <input  type ="hidden" name='f' value ="{{$expert->expert_pdf}}">
                                        <button class ="delete m-btn"> {{__('Download')}}  </button>
                                       </form> </td>
                                    </tr>
                  
                                </table>
                                  <a href=" {{route('expert.edit', [app()->getLocale() , $expert->id])}} " ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                                   <form method = "POST" action ="{{route('users.destroy' , [app()->getLocale() , $expert->id])}}" enctype="multipart/form-data">
                                  @csrf
                                  @method('DELETE')
                                  <input type = "hidden" name ="select" value = "expert_delete" >
                                   <button class ="delete" type ="submit"><img src=" {{asset('asset/images/cross.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></button>
                                  </form>
                              </div>
                                @else
                                <div class="card-body d-flex justify-content-between">
                                 <table class="table table-borderless">
                                    <tr>
                                        <th scope="col"> {{('Experience years')}}  </th> 
                                        <td><span>{{$expert->end_year - $expert->start_year}}  {{__('Years')}}</span> &  <span>{{abs($expert->end_month - $expert->start_month)}} </span> </td>
                                    </tr>  
                                  <tr> 
                                    <th scope="col"> {{__('Job Level')}}  </th>  
                                    <td> {{$expert->level ?? ''}} </td> 
                                  </tr>
                                  <tr>
                                    <th scope="col">{{__('Inistitute')}} </th> 
                                    <td><span>{{$user->country->name}}</span>- <span>{{$expert->company_name}}</span></td>
                                  </tr> 
                                  <tr> 
                                    <th scope="col">{{__('Description')}}</th> 
                                    <td> {{Str::limit($expert->summary , $limit = 40)}}</td>
                                    </tr>
                                    <tr> 
                                    <th scope="col">{{__('File')}}</th> 
                                   <td> <form method = "POST" action ="{{route('user.download' ,$user->id)}}" enctype="multipart/form-data"> 
                                        @csrf
                                        <input  type ="hidden" name='f' value ="{{$expert->expert_pdf}}">
                                        <button class ="delete m-btn"> <i class="fa fa-download" aria-hidden="true"></i> Download </button>
                                       </form> </td>
                                    </tr>
                                 </table>
                                 <a href=" {{route('expert.edit', [app()->getLocale() , $expert->id])}} " ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                                   <form method = "POST" action ="{{route('users.destroy' , [app()->getLocale() , $expert->id])}}" enctype="multipart/form-data">
                                  @csrf
                                  @method('DELETE')
                                  <input type = "hidden" name ="select" value = "expert_delete" >
                                   <button class ="delete" type ="submit"><img src=" {{asset('asset/images/cross.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></button>
                                  </form>
                                  </div>
                                  @endif
                                 @endif
                              @endforeach
                
                            </div>
                        </div>
                      </div> 
                
                  
                {{-- attachment --}}
                <div class="bg-white mb-3 rounded">
                    <div class="card">
                        <div class="card-header  d-flex justify-content-between">
                          <h5 class="font-weight-bold">{{__('Attachment')}}</h5>
                          <a href="#addAttch" data-toggle= "modal"> <img src=" {{asset('asset/images/pluss.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a>
                         </div>
                          <div class="">
                            @foreach ($user->files as $file)
                              
                            <div class="card-body d-flex justify-content-between">
                              <table class="table table-borderless">
                                 <tr> 
                                   <th scope="col"> {{__('Name')}}  </th> 
                            
                                   <td>
                                       <form method = "POST" action ="{{route('user.download' ,$user->id)}}" enctype="multipart/form-data"> 
                                        @csrf
                                        <input  type ="hidden" name='f' value ="{{$file->attch}}">
                                        <input  type ="hidden" name='name' value ="{{app()->getLocale() == 'ar' ? $file->ar_name : $file->name}}">
                                        <button class ="delete m-btn"> <i class="fa fa-download" aria-hidden="true"></i> {{app()->getLocale() == 'ar' ? $file->ar_name : $file->name}}</button>
                                       </form>
                                       
                                    </td> 
                                   
                                </tr>
                
                              </table>
                               <a href=" {{route('attch.edit', [app()->getLocale() , $file->id])}} " ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                              <form method = "POST" action ="{{route('users.destroy' , [app()->getLocale() , $file->id])}}" enctype="multipart/form-data">
                                  @csrf
                                  @method('DELETE')
                                  <input type = "hidden" name ="select" value = "attch_delete" >
                                <button class ="delete" type ="submit"><img src=" {{asset('asset/images/cross.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></button>
                              </form>
                            </div>
                            @endforeach
                           
                          </div>
                      </div>
                    </div> 
                {{-- end attachment --}}
                
                {{-- reference --}}
                <div class="bg-white mb-3 rounded">
                    <div class="card">
                        <div class="card-header  d-flex justify-content-between">
                          <h5 class="font-weight-bold">{{__('References')}}</h5>
                          <a href="#addRef" data-toggle= "modal"> <img src=" {{asset('asset/images/pluss.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a>
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
                                    <th scope="col"> {{__('Phone')}}  </th> 
                                    <td>{{$ref->phone}}</td> 
                                 </tr>
                
                              </table>
                               <a href=" {{route('ref.edit', [app()->getLocale() , $ref->id])}} " ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                              <form action = "{{route('users.destroy' , [app()->getLocale() , $ref->id])}}" method = "POST">
                                  @csrf
                                  @method('DELETE')
                                  <input type="hidden" name = "select" value = "ref">
                                 <button class ="delete"><img src=" {{asset('asset/images/cross.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></button>
                              </form>
                            </div>
                            @endforeach
                           
                          </div>
                      </div>
                    </div> 
                    
            </div>
            </div>
        </div>
      </div>
    </div>
{{-- end reference --}}

<!--ref-->
 

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