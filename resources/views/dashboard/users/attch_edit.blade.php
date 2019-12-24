
@extends('layouts.defaultclient')
@section('content')

<div class="container-fluid bg-light pt-5">
    <div class="row  justify-content-center pt-5"> 
       <div class="col-sm-6 col-md-6 col-md-offset-1 mt-4">   
        <div class="entry-content pb-1  px-3 bg-white my-3 shadow"> 
            <form method="POST" class="" action="{{route('users.update' , [app()->getLocale() , $attch->id])}}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')
                <input type="hidden" name="select" value= "attch">
                       <div class="form-group col-md-12">
                      <label for="inputAddress">{{__('Arabic name')}}</label>
                  <input type="text" name="ar_name" class="form-control" id="inputAddress"  placeholder="{{__('Arabic name')}}" value = "{{$attch->ar_name}}">
                </div>
                <div class="form-group  col-md-12">
                    <label for="password-confirm" class="">  {{ __('') }} </label>
                        <input id="password-confirm" type="text" class="form-control" name="name" autocomplete="new-password" placeholder="{{__('Name')}}" value = "{{$attch->name}}">
                    </div>
                    <div class="form-group  col-md-12">
                    <label for="password-confirm" class="">  {{ __('') }} </label>
                        <input id="password-confirm" type="file" class="form-control" name="attch" autocomplete="new-password" placeholder="{{__('')}}" >
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
 
    
@endsection