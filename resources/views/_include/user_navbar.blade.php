
    <div class="site-navbar-wrap js-site-navbar bg-white">

            <div class="container-fluid">
              <div class="site-navbar bg-light">
                <div class="py-1">
                  <div class="row align-items-center">
                    <div class="">
                  <div class="mb-0 site-logo"><a href="{{route('home' , app()->getLocale())}}"><img src=" {{asset('asset/images/logo.png')}} " width="85%"></a></div>
                    </div>
                    <div class="">
                      <nav class="site-navigation" role="navigation">
                        <div class="container">
                          <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
                            <a href="#" class="site-menu-toggle js-menu-toggle text-black">
                              <span class="icon-menu h3"></span>
                             </a>
                            </div>
      
                          <ul class="site-menu js-clone-nav d-none d-lg-block">
                            <li><a href="{{route('home',app()->getLocale())}}">{{__('Home')}}</a></li>
                            <li><a href="{{route('web.mycv' , app()->getLocale())}}"> {{ __('My CV') }}  </a></li> 
                            <li class="has-children">
                              <a href="#">{{ __('Jobs') }} </a>
                              <ul class="dropdown arrow-top text-center" style="width:15em;">
                                  <table class="table table-borderless">
                                   <tr class="border-bottom"><td>  {{ __('Search by') }}   </td></tr> 
                                      <tr> <td><a href="{{route('job.full' , app()->getLocale())}}">{{__('Full Time')}} </a></td></tr>
                                      <tr><td><a href="{{route('job.part' , app()->getLocale())}}">{{__('Part Time')}} </a></td></tr> 
                                  </table>  
                              </ul>
                            </li>
                            <li><a href="{{route('web.contact' , app()->getLocale())}}">{{__('Contact Us')}}</a></li> 
                            <li><a href="{{route('users.index' ,app()->getLocale())}}" class="add">  {{__('Search by Job title')}}    </a></li>
                            <li class="has-children m-2">
                                    <a href="">{{(app()->getLocale() == 'ar') ? Auth::user()->ar_name : Auth::user()->name}}</a>
                                    <ul class="dropdown arrow-top">
                                      <li><a href="" data-toggle="modal" data-target ="#changepassword" >{{__('Account Setting')}}</a></li>
                                      <li ><a href="{{route('users.logout',app()->getLocale())}}" >  <img src="{{asset('images/more-circular.png')}}" alt="">  {{__('Logout')}}   </a></li>
                                       </ul>
                                  </li> 
                                  
                                  @if(Route::current()->getName() != 'search.job')
                                  @foreach (config('app.available_locales') as $locale)
                                  <li>
                                      <a class="text-right"
                                          href="{{ route(Route::currentRouteName(),[$locale , $id ?? '']) }}"
                                          @if (app()->getLocale() == $locale) style="display:none;" @endif>
                                           @if($locale == 'en') 
                                           {{ strtoupper($locale) }} <img SRC="{{asset('asset/images/en.png')}} " width="20%" class="rounded-circle border border-light">
                                           @else 
                                           {{ strtoupper($locale) }}
                                           <img  SRC="{{asset('asset/images/ar.png')}} " width="20%" class="rounded-circle border border-light" alt="Lang">
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
      