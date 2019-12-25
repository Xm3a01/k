@extends('layouts.defult')

@section('content')

 
<div class="bg-light modeltop " id="login" >
  <div class="container  justify-content-center " role="document">
    <div class=" row  justify-content-center ">
     <div class="col-md-4 shadow1 mb-5  bg-white">
        <div class="border-bottom">
            <strong> <h5 class="text-center pt-5 pb-3" id="exampleModalLabel"> {{ __('Create your account now')}}</h5></strong>
            </div>
        <div class="py-2 ">  
          <form class="p-2 " method="POST" action="{{route('users.register.submit',app()->getLocale())}}">
            @csrf
             <div class="form-row"> 
                <div class="form-group col-md-12">
                    <label for="name" > {{ __('First Name') }} </label>
                            
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                <div class="form-group col-md-12">
                    <label for="name"  > {{ __('Last Name') }} </label>
                      <input id="name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
        <div class="form-group col-md-12">
                <label for="email" class=" "> {{ __('E-Mail Address') }} </label>
 
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-12 pr-2">
                    <label for="inputState"
                      style="vertical-align:bottom; display: table; margin-bottom: 0.5rem;">{{__('Gender')}}</label>
                    <div class="form-check form-check-inline">
                      <input checked  class="form-check-input radio" type="radio" name="gender" id="inlineRadio1"
                        value="Male">
                      <label class="form-check-label" for="inlineRadio1">{{__('Male')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                        value="Female">
                      <label class="form-check-label" for="inlineRadio2">{{__('Female')}}</label>
                    </div>
                  </div>
            
                <div class="form-group col-md-12 mb-1">
                    <label for="inputEmail4">{{ __('Role') }}</label>
                       <select name="role_id" class="form-control" >
                           <option selected disabled >{{ __('Role') }}</option>
                           @foreach ($roles as $role)
                               <option value="{{$role->id}}"> {{app()->getLocale() == 'ar' ? $role->ar_name : $role->name}} </option>
                           @endforeach
                       </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="password"  > {{ __('Password') }} </label>
 
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                 

                    <div class="form-group  col-md-12">
                        <label for="password-confirm" class="">  {{ __('Confirm Password') }} </label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        </div>
                    <div class="form-group my-2">
                            <div class="col-md-12 p-0 ">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection