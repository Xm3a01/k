@extends('layouts.defaultclient')
@section('content')
  
      
<div class="site-section bg-light">
  <div class="container">
  <div class="row  pt-5 px-2 mt-4 justify-content-center"> 
  <div class="col-lg-8 col-md-8 col-sm-12 ">
<div class="">
    <div class="bg-white mb-3 rounded">
            <div class="card">
                <div class="card-header  d-flex justify-content-between">
                  <h5>{{__('Password')}}</h5>
                  <a href="" data-toggle="modal" data-target="#password" ><img src=" {{asset('asset/images/edit.png')}} " alt=""  class="p-1 align-left float-left   cursor-pointer"></a> 
                </div>
                  <div class="card-body ">
                      <table class="table table-borderless">
                      <tr class="py-2">
                        <th scope="col"> {{__('Change Password')}}</th> 
                       </tr>  
                      </table>
                  </div>
              </div>
          </div>
         </div>
       </div>
     </div>
   </div>
 </div>


<!-- change password model -->
<div class="modal fade" id="password" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
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
                          <input name="user_id" value = "{{$user->id}}">
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