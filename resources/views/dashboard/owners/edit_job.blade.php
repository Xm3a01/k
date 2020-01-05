@extends('layouts.defultowner')
@section('content')
    
<div class="site-section bg-light  " style="padding-top:160px;"> 
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-lg-8 mb-5">  
            <div class="bg-white"> 
                <h3 class="p-3"> {{__('Jobs')}} </h3> 
                <div class="row container">
                @foreach ($owner->jobs as $job)
                <div class="col-md-6">   
                <div class=" d-flex d-md-flex"> 
                    <img src="{{Storage::url($owner->logo)}}" alt="Image" class="rounded-circle  img-fluid p-1 w-30" width="25%">
                    <div class="px-3"> 
                        <p class="m-0 pt-1 font-weight-bold"><a href="">{{(app()->getLocale() == 'ar') ? $job->ar_sub_special : $job->sub_special}}</a> <small> ({{$owner->company_name}}) </small></p>
                        <p class="m-0">{{(app()->getLocale() == 'ar') ? $job->ar_role : $job->role}}</p> 
                    </div>
                </div>
            </div>
            <div class="col-md-6"> <a href="#job" data-toggle="modal"><small>Edit</small></a> | <a onclick=" event.preventDefault(); document.getElementById('delete-job').submit() " ><small> <code>Delete</code> </small></a> </div><br>
            <form id="delete-job" action=" {{route('owners.destroy' , [app()->getLocale() , $job->id])}} " method="post" style="display:none">
                @csrf
                @method('DELETE')
                <input type="hidden" name="select" value="delete_job">

            </form>

           <div class="modal fade" id="job" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-full" role="document">
                    <div class="modal-content fill-cont">
                        <div class="modal-header">
                            <h5 class="modal-title"> {{__('Job Edit')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body p-4" id="result"> 
                    <div class="row justify-content-center">
                        <form method="POST" action=" {{route('owners.update' , [app()->getLocale() , $job->id])}}"  class="form-row col-md-6">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="select" value="job">
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">{{ __('Job Role ') }}</label>
                            <select name="role_id" id="inputState" class="form-control">
                                <option selected disabled>{{ __('Job Role ') }}</option>
                                @foreach ($roles as $role)  
                                <option {{ $job->role_id == $role->id ? 'selected' : ''}} value="{{ $role->id }}">{{ $role->ar_name }}</option>
                                @endforeach
                             </select>
                           </div>
                            
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Job Level') }}</label>
                                <input type="text" class="form-control  " placeholder="اخصائي : مثلا" name="level">
                           </div>

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">{{__('Country')}}</label>
                                    <select name="country_id" id="inputState" class="form-control">
                                        <option selected disabled>{{__('Country')}}</option>
                                        @foreach ($countries as $country) 
                                        <option {{$job->country_id == $country->id ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->ar_name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                            
                                    <div class="form-group col-md-6">
                                    <label for="inputCity"> {{__(' City  ')}}</label>
                                    <select name="country_id" id="inputState" class="form-control">
                                        <option selected disabled>{{__('Country')}}</option>
                                        @foreach ($cities as $city) 
                                        <option {{$job->city_id == $city->id ? 'selected' : ''}} value="{{ $city->id }}">{{ $city->ar_name }}</option>
                                        @endforeach
                                      </select>
                                    </div>

                            <div class="form-group col-md-6">
                                <label class=" control-label">{{__('Specialization')}}</label>
                                <select name="sub_special_id" id="inputState" class="form-control">
                                    <option selected disabled>{{__('Specialization')}}</option>
                                    @foreach ($specials as $special)  
                                    <option {{$job->special_id == $special->id ? 'selected' : ''}} value="{{ $special->id }}">{{ $special->ar_name }}</option>
                                    @endforeach
                                  </select>
                                </div> 

                            <div class="form-group col-md-6">
                                <label class=" control-label">التخصص الفرعي</label>
                                <select name="sub_special_id" id="inputState" class="form-control">
                                    <option selected disabled>التخصص الفرعي</option>
                                    @foreach ($sub_specials as $sub_special)  
                                    <option {{$job->sub_special_id == $sub_special->id ? 'selected' : ''}} value="{{ $sub_special->id }}">{{ $sub_special->ar_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class=" control-label"> سنين الخبرة المطلوبة</label>
                                <input type="text" class="form-control  " placeholder="مثال: 1 شهر و2 سنة " name="experinse" value="{{$job->yearsOfExper}}">
                            </div> 
                            
                            <div class="form-group col-md-6">
                                <label class=" control-label">حالة العمل</label>
                                <select class="form-control" name="status">
                                    <option disabled value="">حالة العمل</option>
                                    <option selected hidden value=" {{$job->status}} "> {{(app()->getLocale() == 'ar') ? $job->ar_status : $job->status }} </option>
                                    <option value="Full time">دوام كامل</option>
                                    <option value="Par time">دوام جزئي</option>
                                </select>
                                </div> 
                    
                            <div class="form-group col-md-12">
                                    <label class= "control-label">الراتب</label>
                                    <input type="text" class="form-control  " placeholder="مثال: 2500 - 5000" name="selary" value="{{$job->selary}}">
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="control-label">الوصف الوظيفي</label>
                                    <textarea class="form-control" rows="3" name="ar_description"> {{$job->ar_description}} </textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                    <label class="control-label">  الوصف الوظيفي بالانجليزي</label>
                                    <textarea class="form-control" rows="3" name="description"> {{$job->description}} </textarea>
                                    </div>

                                    <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-12">
                                            <button type="submit" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
            
                            </div>
                        </div>
                    </div> 
                </div>
        </div> 
            <!-- end language model -->
         @endforeach
        </div>
        </div>
        </div>
          <div class="col-md-4 col-lg-4 mb-5">  
              <form action="{{route('search.cv' , app()->getLocale())}}"  method="GET" class="px-3 py-2 bg-white"> 
                      <h5 class="p-2">بحث سريع عن السير الذاتية</h5>
                        <div class="row form-group">
                          <div class="col-md-12">
                            <label class="font-weight-bold" for="email">المسمي الوظيفي</label>
                            <input v-model="special" name = "special" list="special" type="text" class=" form-control  px-3" placeholder=" {{__('Job Title')}} " autocomplete = "off">
                            <datalist id="special">
                              @foreach ($specials as $sub)   
                                <option  value="{{ (app()->getLocale() == 'en') ? $sub->name : $sub->ar_name}} ">
                                @endforeach
                            </datalist>
                          </div> 
                        <div class="form-group col-md-12">
                              <label for="inputState" style="font-weight: 600;">البلد</label>
                              <input  v-model = "country" name = "place" list="country" type="text" class="form-control  px-3"  placeholder="{{__('City or Country')}}" autocomplete = "off">
                              <datalist id="country" v-if="country">
                                  @foreach ($countries as $county)
                                      <option value="{{ (app()->getLocale() == 'ar') ? $county->ar_name : $county->name}} ">
                                  @endforeach
                                  @foreach ($cities as $city)
                                      <option value="{{(app()->getLocale() == 'ar') ? $city->ar_name : $city->name}} ">
                                    @endforeach
                            </datalist> 
                            </div> 
                          </div>
                        <div class="row form-group">
                          <div class="col-md-12">
                            <input type="submit" value="ابحث الان" class="btn btn-primary btn-block px-3">
                          </div>
                        </div> 
                      </form> 
                      
                    <div class=" mt-5 ">
                        <div class="card p-3 text-center" style="border-radius: 5px; background: linear-gradient(124.25deg, #b0f3f7 0%, #01a0c7 100%);">
                            <div class="card-head  py-3">
                              <b>ابدأ بالتوظيف الآن!</b>
                                    </div>
                                    <div class="card-content is-stretched t-inverse">
                                        <i class="icon is-research is-48 t-light"></i>
                                        <h3 class="t-inverse m20y">أسبوعين من البحث عن السير الذاتية</h3>
                                       <h2 class="t-inverse py-3">$675</h2>
                                  </div>
                            </div> 
                        </div>
                    </div>  
                    </div>
                </div>
                </div> 
    {{-- Start Modal --}}



@endsection