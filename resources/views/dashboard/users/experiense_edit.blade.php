
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

                    <label for="inputEmail4">{{__('Role')}}</label>
                    <input list ="role" id="inputState" class="form-control" autocomplete= "off" name="role" value=" {{(app()->getLocale() == 'ar') ? $expert->ar_role : $expert->role}} ">
                    <datalist id="role">   
                        @foreach ($roles as $role)  
                        <option value=" {{(app()->getLocale() == 'ar') ? $role->ar_name : $role->name }}">
                        @endforeach
                    </datalist>

                    <label for="inputEmail4">{{__('Level')}}</label>
                    <input list ="level" id="inputState" class="form-control" autocomplete= "off" name="level" value="{{(app()->getLocale() == 'ar') ? $expert->ar_level : $expert->level }}">
                        <datalist id="level">   
                            @foreach ($levels as $level)  
                            <option value=" {{(app()->getLocale() == 'ar') ? $level->ar_name : $level->name }}">
                            @endforeach
                        </datalist>
                          

                    <label for="inputEmail4">{{__('Sub specialization')}}</label>
                    <input list ="subspecial" id="inputState" class="form-control" autocomplete= "off" name="expertspecial" value=" {{(app()->getLocale() == 'ar') ? $expert->user->ar_sub_special : $expert->user->role }}">
                        <datalist id="subspecial">
                        @foreach ($sub_specials as $special)     
                        <option value=" {{(app()->getLocale() == 'ar') ? $special->ar_name : $special->name }}">
                        @endforeach
                    </datalist>
            
                    <label for="job_description">الوصف</label> 
                    <textarea class="form-control" id="exampleFormControlTextarea1"
                    placeholder="أضف المشاريع التي عملت عليها، والأنشطة التي شاركت بها، والإنجازات التي حققتها من خلال سنوات دراستك.."
                    rows="3" name="ar_summary"> {{$expert->ar_summary}} </textarea>

                    <label for="job_description"> EN الوصف</label> 
                    <textarea class="form-control" id="exampleFormControlTextarea1"
                    placeholder="أضف المشاريع التي عملت عليها، والأنشطة التي شاركت بها، والإنجازات التي حققتها من خلال سنوات دراستك.."
                    rows="3" name="summary"> {{$expert->summary}} </textarea>
                            
                                
                   <label for="cert_pdf" class="file-field-label">{{__('Certificate')}}</label>  <small class="description file-field-description">
                            Maximum file size: -.	</small>
                    <input type="file" class="input-text listify-file-upload" data-file_types="pdf|doc|" name="cert_pdf" id="cert_pdf" placeholder="">
                  
                                    
                            <button type="submit" class="btn btn-primary btn-block mb-3">Save 
                            </button>
                    </form> 
             </div> 
           </div>
         </div>
    </div>
 
    
@endsection