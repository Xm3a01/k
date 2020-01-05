
@extends('layouts.defaultclient')
@section('content')

<div class="container-fluid bg-light pt-5">
    <div class="row  justify-content-center pt-5"> 
       <div class="col-sm-6 col-md-6 col-md-offset-1 mt-4">   
        <div class="entry-content pb-1  px-3 bg-white my-3 shadow"> 
            <form method="POST" class="" action="{{route('users.update' , [app()->getLocale() , $expert->id])}}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')
                <input type="hidden" name="expert_form" value="exprt">
                    <h3 class="text-center pt-3 pb-3">بيانات الخبره</h3>
                    <label for="company_name">اسم الشركة</label>
                    <div class="field required-field">
                         <input type="text" class="input-text" name="company_name" id="company_name" placeholder="أدخل اسم الشركة" value=" {{$expert->company_name}} " maxlength="" required="">
                    </div>
                    <div class="row">

                    
                        <div class="col-md-3">
                     <label for="application">{{__('Start Year')}}</label>
                    <div class="field required-field ">
                       <input type="text" class="form-control" id="inputAddress2" placeholder="مثال: 1." name="start_year" value=" {{$expert->start_year}} ">
                    </div>
                        </div>
                    <div class="col-md-3">
                    <label for="application">{{__('Satrt month')}}</label>
                    <div class="field required-field ">
                       <input type="text" class="form-control" id="inputAddress2" placeholder="مثال: 1." name="start_month" value=" {{$expert->start_month}} ">
                    </div>
                    </div>
                    <div class="col-md-3">

                    <label for="application">{{__('End year')}}</label>
                    <div class="field required-field ">
                       <input type="text" class="form-control" id="inputAddress2" placeholder="مثال: 1." name="end_year" value=" {{$expert->end_year}} ">
                    </div>
                    </div>
                    <div class="col-md-3">
                     
                    <label for="application">{{__('End month')}}</label>
                    <div class="field required-field ">
                       <input type="text" class="form-control" id="inputAddress2" placeholder="مثال: 1." name="end_month" value=" {{$expert->end_month}} ">
                    </div>
                    </div>
                    </div>

                  <label>{{__('Country')}} </label>
                        <select name="country_id" id="inputState" class="form-control">
                            <option selected disabled>{{__('Country')}}</option>
                            @foreach ($countries as $country) 
                              <option {{$expert->country_id == $country->id ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->ar_name }}</option>
                        @endforeach
                    </select

                    <label for="inputEmail4">{{__('Role')}}</label>
                    <select name="role_id" id="inputState" class="form-control">
                        <option selected disabled>{{__('Role')}}</option>
                        @foreach ($roles as $role)  
                           <option {{ $expert->role_id == $role->id ? 'selected' : ''}} value="{{ $role->id }}">{{ $role->ar_name }}</option>
                        @endforeach
                     </select>

                    <label for="inputEmail4">{{__('Job Level')}}</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="مثال: اخصائي." name="level" value=" {{$expert->level}} ">
                          

                    <label for="inputEmail4">{{__('Specialization')}}</label>
                    <select name="special_id" id="inputState" class="form-control">
                        <option selected disabled>{{__('Specialization')}}</option>
                            @foreach ($specials as $special)  
                            <option {{$expert->special_id == $special->id ? 'selected' : ''}} value="{{ $special->id }}">{{ $special->ar_name }}</option>
                        @endforeach
                    </select>
            
                    <label for="job_description">الوصف</label> 
                    <textarea class="form-control" id="exampleFormControlTextarea1"
                    placeholder="أضف المشاريع التي عملت عليها، والأنشطة التي شاركت بها، والإنجازات التي حققتها من خلال سنوات دراستك.."
                    rows="3" name="ar_summary"> {{$expert->ar_summary}} </textarea>

                    <label for="job_description"> EN الوصف</label> 
                    <textarea class="form-control" id="exampleFormControlTextarea1"
                    placeholder="أضف المشاريع التي عملت عليها، والأنشطة التي شاركت بها، والإنجازات التي حققتها من خلال سنوات دراستك.."
                    rows="3" name="summary"> {{$expert->summary}} </textarea>
                            
                                
                   <label for="cert_pdf" class="file-field-label">{{__('Certificate')}}</label>  <small class="description file-field-description">
                           </small>
                    <input type="file" class="input-text listify-file-upload" data-file_types="pdf|doc|" name="cert_pdf" id="cert_pdf" placeholder="">
                  
                                    
                            <button type="submit" class="btn btn-primary btn-block mb-3">Save 
                            </button>
                    </form> 
             </div> 
           </div>
         </div>
    </div>
 
    
@endsection