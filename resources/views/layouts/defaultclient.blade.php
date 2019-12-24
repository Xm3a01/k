<!DOCTYPE html>
<html lang=" {{app()->getLocale()}} ">
<head>

    @include('_include.head')
    @include('_include.message')
    @yield('stylesheet')

</head>
<body>
   
    <div class="site-wrap">
        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
              </div>
             </div>
            <div class="site-mobile-menu-body"></div>
        </div>
 @include('_include.user_navbar')

    @yield('content')
   
 

@include('_include.footer') 

   
@include('_include.jsfile') 
@yield('scripts')
@include('_include.message')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script>
        $('.ck_editor').ckeditor();

        CKEDITOR.config.extraPlugins = 'justify';
        CKEDITOR.config.extraPlugins = 'bidi';

    </script>
</div> 
</body>
</html>