
    <div class="site-navbar-wrap js-site-navbar bg-white">
            <div class="container-fluid">
              <div class="site-navbar bg-light">
                <div class="py-1">
                  <div class="row align-items-center">
                    <div class="">
                  <div class="mb-0 site-logo"><a href="{{route('home' , app()->getLocale())}}"><img src=" {{asset('asset/images/logo.png')}} " width="90%"></a></div>
                    </div>
                    <div class="">
                      <nav class="site-navigation" role="navigation">
                        <div class="container">
                          <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3 navmedia">
                            <a href="#" class="site-menu-toggle js-menu-toggle text-black">
                              <span class="icon-menu h3"></span>
                             </a>
                            </div>
      
                          <ul class="site-menu js-clone-nav d-none d-lg-block">
                            <li><a href="{{route('home' ,app()->getLocale())}}">{{__('Home')}}</a></li> 
                            @if(Auth::guard('owner')->check())
                            <li><a href="{{route('owners.index' , app()->getLocale())}}">{{ __('My Workspace')}}</a></li>
                            @endif
                            <li><a href="{{route('owners.create' , app()->getLocale())}}">{{ __('Post a job')}}</a></li>
                            <li ><a href="{{route('login' , app()->getLocale())}}">{{__('Job Seeker ?')}}</a></li>
                            <li><a href="{{route('home' ,app()->getLocale())}}">{{__('Contact Us')}}</a></li>
                          
                            @guest
                            <li><a class="add" href="{{ route('owner.login',app()->getLocale()) }}">{{ __('Login') }}</a></li>
                            @if (Route::has('register'))
                                <li >
                                    <a class="login" href="{{ route('owner.register',app()->getLocale()) }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                            @if(Auth::guard('owner')->check())
                            <li class="has-children mr-2">
                                  <a href=" {{route('owners.index' , app()->getLocale())}} ">{{Auth::user()->ar_name}}</a>
                                    <ul class="dropdown arrow-top">
                                      <li><a href=" {{route('owners.edit' , [app()->getLocale() , Auth::user()->id])}} ">{{__('Account Setting')}}</a></li>
                                      <li ><a href="{{route('owners.logout',app()->getLocale())}}" > <span><img src="images/logout.png" class="ml-1" alt=""></span><img src="images/more-circular.png" alt="">{{__('Logout')}}</a></li>
                                        </ul>
                                  </li>
                                @endif
                           @endguest
                           
                         @if(Route::current()->getName() != 'search.cv')
                            @foreach (config('app.available_locales') as $locale)
                              <li>
                                  <a class="text-right"
                                      href="{{ route(Route::currentRouteName(), [$locale , $id ?? '']) }}"
                                      @if (app()->getLocale() == $locale) style="display:none;" @endif>
                                       @if($locale == 'en') 
                                       {{ strtoupper($locale) }} <img SRC="{{asset('asset/images/en.png')}} " width="20%" class="rounded-circle border border-light">
                                       @else 
                                       {{ strtoupper($locale) }}
                                       <img  SRC="{{asset('asset/images/en.png')}} " width="20%" class="rounded-circle border border-light" alt="Lang">
                                       @endif
                                    </a> 
                              </li>
                           @endforeach
                           @endif
                        </ul> 
                        </div>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      