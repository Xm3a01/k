@extends('layouts.defult')
@section('content')

<div class="bg-light modeltop " id="login" >
    <div class="container  justify-content-center " role="document">
        <div class=" row  justify-content-center ">
          <div class="col-md-4 bg-white shadow1 mb-5">
            <div class="border-bottom">
                <strong> <h5 class="text-center pt-5 pb-3" id="exampleModalLabel">   {{ __('Login') }}  </h5></strong>
            </div>
            <div class="pt-2">  
               <form action="{{ route('login', app()->getLocale()) }}" class="p-2 " method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="email" class="">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                   </div>
                         
                <div class="form-group col-md-12">
                    <label for="password">{{ __('Password') }}</label>
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                <div class="form-group col-md-6">
                       <div class="form-check float-left p-0 mx-3">
                            <input class="form-check-input checkin" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label " for="remember">
                                {{ __('Remember Me') }}
                            </label>
                      </div>
                  </div>

                {{-- <div class="form-group col-md-6"> 
                        @if (Route::has('password.request'))
                            <a class="text-left" href="{{ route('password.request', app()->getLocale()) }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif 
                    </div> --}}

                <div class="form-group col-md-12 text-center"> 
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Login') }}
                    </button>
                        </div>
                </div>
            </form>  
                  @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request' , app()->getLocale()) }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                  <p class="text-center p-3"> <u><a href="{{route('register' , app()->getLocale())}}" class="text-center">{{ __('Dont have account? register now') }} </a></u></p>
            </div>
          </div>
        </div>
      </div>
</div>


      @endsection
    