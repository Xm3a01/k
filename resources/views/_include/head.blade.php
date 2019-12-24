<meta charset="UTF-8">

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

<link rel="stylesheet" href=" {{asset('asset/css/scrolling.css')}} ">