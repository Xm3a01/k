@extends('layouts.defaultclient')
@section('content')

<div class="unit-5 overlay" style="background-image: url('{{asset('asset/images/hero_1.jpg')}}');">
    <div class="container text-center">
      <h2 class="mb-0">{{__('CV writing confrontations')}}</h2>
      <p class="mb-0 unit-6"><a href="index.html">{{__('Home')}}</a> <span class="sep">></span> <span>{{__('About Us')}}</span></p>
    </div>
  </div>
  <div class="container py-5">
  {{-- <h3 class="pt-3">{{ (app()->getLocale()=='ar') ? $guid->ar_title ?? '' : $guid->title ?? ''}}</h3> --}}
  <p class="">
      {!! (app()->getLocale()=='ar') ? $guid->ar_guid ?? '' : $guid->guid ?? '' !!}
 </p>
<strong>
    
</strong>

</div>

@endsection