@extends('layouts.defaultclient')
@section('content')


<div class="site-section bg-light" style="padding-top: 120px;">
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8 mb-5"> 
            <h3 class="py-3"> {{__('Jobs may interest you')}} </h3> 
                 @if(!App\Job::where('sub_special', Auth::user()->sub_special)))
                 
                 <div class="px-5"> 
                    <div class="text-center">
                      <img src=" {{asset('asset/images/sadIcon.png')}} " alt="Image" class="img-fluid p-5">
                     <p class="pb-3">
                        {{__('Sorry, we found no jobs that matched the information you added to your resume. Please edit your CV to find results that match it better')}}.
                    </p>
                    <div class="pb-5">
                        <button class="btn btn-primary " href="mycv.html" type="button" >{{__('Update Your CV')}}  </button>
                      </div>
                    </div> 
                  </div>
                  
                  @else
                    <div class="modrn-joblist scrolling"> 
                         <div class="rounded jobs-wrap">
                       @foreach($jobs as $job)
                          <a href="{{route('single.job' ,[app()->getLocale() , $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                                 <div class="company-logo blank-logo text-center text-md-left pl-3">
                                   <img src="{{ asset(Storage::url($job->owner->logo))}}" alt="Image" class="img-fluid mx-auto">
                                 </div>
                                 <div class="job-details h-100">
                                   <div class="p-3 align-self-center">
                                    <h3>{{(app()->getLocale() == 'ar') ? $job->ar_sub_special : $job->sub_special}}</h3>
                                    <div class="d-block d-lg-flex">
                                     <p class="m-0">{{$job->yearsOfExper}}</p>
                                      <span class="mr-3">{{date('F d, Y', strtotime($job->created_at))}}</span> 
                                        </div>
                                     <div class="d-block d-lg-flex"> 
                                       <div ><span class="icon-suitcase mr-1 ml-2"></span> {{$job->owner->company_name}}</div>
                                       <div class="mr-3" ><span class="icon-money mr-1"> {{$job->selary}} </span></div>
                                     </div>
                                     </div>
                                 </div>
                                 <div class="job-category align-self-center">
                                   <div class="p-3">
                                     <span class="text-info p-2 rounded border border-info">{{(app()->getLocale() == 'ar') ? $job->ar_status : $job->status}}</span>
                                   </div>
                                 </div>
                               </a> 
                            @endforeach
                                 
                         
                                </div> 
                           
                    </div> 
                    @endif
                </div>  

    <div class="col-md-4 col-lg-4 mb-5">  
     <div class="p_graph px-3 py-2 my-3 bg-white">
          <h6 class="p-2 font-weight-bold">{{app()->getLocale() == 'ar' ? $guid->ar_title : $guid->title }} </h6>
                <p class="" style="font-size: 14px; font-weight: 400;">
                    {!! app()->getLocale() == 'ar' ? Str::limit($guid->ar_guid , $limit=200) : Str::limit($guid->guid , $limit=200 ) !!}
                </p>
             <div class="">
             <a href="{{route('user.guid' , app()->getLocale())}}" class="py-3 d-flex justify-content-center" style="text-decoration: underline; font-size: 15px; font-weight: 600; cursor: pointer; color:#333">{{__('Write a professional resume')}}</a>
          </div>
     </div>
    
    
      <div class="f_alert">
            <form action="#" class="px-3 py-2 my-3 bg-white"> 
                <h5 class="p-2">{{__('Create an alert')}} </h5>
                  <div class="row form-group">
                    <div class="col-md-12">
                      <label class="font-weight-bold" for="email">  {{__('Email')}} </label>
                      <input type="email" id="email" class="form-control" placeholder="">
                    </div> 
                    
                    </div>
                  <div class="row form-group">
                    <div class="col-md-12">
                      <input type="submit" value=" {{__('Create now')}} " class="btn btn-primary btn-block px-3">
                    </div>
                  </div> 
                </form>

      </div>
      
            <div class="pt-5 px-3 pb-3 mt-3 bg-white">
                <div class="row">
                    <div class="col-md-4">
                      <img src=" {{asset('asset/images/ideaicon2.png')}} " class="img-40 u-left-m m20 p-2"     width="85px" alt="">
                    </div>
                   <div class="col-md-8 pr-0">
                    <p>{{__('Employers are constantly looking for new employees! Make sure to update your resume')}}</p>
                   </div>
                 </div>
                 <div class="text-center">
                     <a href="{{route('web.mycv' , app()->getLocale())}}" class="py-3 d-flex justify-content-center" style="text-decoration: underline; font-size: 15px; font-weight: 600; cursor: pointer; color:#333">{{__('Update your CV now')}}</a>
                 </div> 
            </div>
            
        </div>
      </div>
</div>

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
                  <form class="form-row col-md-6" action="{{route('users.update',[app()->getLocale() , $user->id])}}" method="POST">
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

@endsection


@section('scripts')
    <script src="asset('js/app.js')"></script>
    <script>
    const app = new Vue({

      el: '#app',

      data: {

      }
    });
    </script>
@endsection