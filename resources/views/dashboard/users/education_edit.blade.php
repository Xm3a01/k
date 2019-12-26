
@extends('layouts.defaultclient')
@section('content')

<div class="container-fluid bg-light pt-5">
    <div class="row  justify-content-center pt-5"> 
       <div class="col-sm-6 col-md-6 col-md-offset-1 mt-4">   
        <div class="entry-content pb-1  px-3 bg-white my-3 shadow"> 
            <form action="{{route('users.update' , [app()->getLocale() , $education->id])}}" method="post" id="submit-job-form" class=" " enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')
                <input type="hidden" name="select" value="edu_form">
                    <h3 class="text-center pt-3 pb-3">التعليم</h3> 
                    <label for="application">{{__('Special')}}</label>
                    <select name="sub_special_id" id="inputState" class="form-control">
                        <option selected disabled>{{__('Special')}}</option>
                        @foreach ($sub_specials as $sub_special)  
                        <option {{$education->sub_special_id == $sub_special->id ? 'selected' : ''}} value="{{ $sub_special->id }}">{{ $sub_special->ar_name }}</option>
                        @endforeach
                    </select>
                    <label for="application">{{__('Arabic university')}}</label>
                    <div class="field required-field">
                            <input type="text" class="input-text" name="ar_university" id="inputAddress2" placeholder="مثال: جامعة هارفورد"value="{{$education->ar_university}}" >
                    </div>

                    <label for="application">{{__('university')}}</label>
                    <div class="field required-field">
                            <input type="text" class="form-control" name="university" id="inputAddress2" placeholder="مثال: جامعة هارفورد"value="{{$education->university}}" >
                    </div>
                        
                    
                    <label for="inputEmail4">اختر نوع الشهادة</label>
                    <select id="inputState" class="form-control" name="qualification">
                        <option  disabled>اختر نوع الشهادة</option>
                        <option selected hidden value=" {{ $education->qualification }} ">{{ $education->ar_qualification }}</option>
                        <option value="Diploma">{{__('Diploma')}}</option>
                        <option value="Bachelor">{{__('Bachelor')}}</option>
                        <option value="Master">{{__('Master')}}</option>
                        <option value="PH">{{__('PH')}}</option>
                    </select>   
                    <label for="datepicker">'تاريخ التخرج</label>
                    <div class="field ">
                       <input type="date" id="datepicker" width="276" class="form-control" name="grade_date"  value="{{$education->grade_date}}"/>
                    </div> 

                    <label for="datepicker">المعدل</label>
                    <div class="field ">
                       <input type="text" id="datepicker" width="276" class="form-control" name="grade"  value="{{$education->grade}}"/>
                    </div> 
                            
                          <br>  
                    <button type="submit" class="btn btn-primary btn-block mb-3"> save 
                    </button>
                    </form> 
             </div> 
           </div>
         </div>
    </div>
 
    
@endsection