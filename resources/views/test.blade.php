@extends('layouts.app')
@section('content')
  <div class="card col-md-4 offset-md-4">
    <form action="{{route('test_one')}}" method="POST">
    @csrf
    <div id="app" class="">
      <v-select :items ="{{$cities}}" filterBy ="ar_name" filed_name ="role_id" title="اختار الدور الوظيفي" search="بحث" :test={{ App\City::find(this.id) }}></v-select>
   </div>
   <button type="submit">
     Ok
   </button>
  </form>
   
  </div>
@endsection
  <script src="{{asset('js/app.js')}}"></script>