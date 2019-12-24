@extends('dashboard.metronic')
@section('content')

 <!-- BEGIN PAGE HEAD-->
 <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1> {{$job->ar_company_name}}
            </h1>
        </div> 
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">الرئيسية</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">تعديل العمل  </span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT --> 
<div class="row"> 
<div class="col-md-12 ">
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light bordered">
            <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green hide"></i>
                        <span class="caption-subject font-dark bold uppercase">تعديل الوظيفه للشركه : {{$job->ar_company_name}}</span>
                    </div>
                 </div> 
        <div class="portlet-body form">
            <form class="form-horizontal" role="form" method="POST" action="{{route('jobs.update' , $job->id)}}">
                @csrf
                @method('PUT')
                <div class="form-body"> 
                  {{-- <input  type="hidden" name="owner_id" value="{{$owner->id}}"> --}}
                  <div class="form-group">
                      <label class="col-md-3 control-label">الدور الوظيفي</label>
                      <div class="col-md-6">
                       <select name="role_id" id="inputState" class="form-control">
                          @foreach ($roles as $role)  
                          <option selected value="{{ $job->id }}">{{ $roles->find($job->role_id) }}</option>
                          <option value="{{ $role->id }}">{{ $role->ar_name }}</option>
                          @endforeach
                        </select>
                      </div>      
                  </div>

                  <div class="form-group">
                          <label class="col-md-3 control-label">المستوى الوظيفي</label>
                          <div class="col-md-6">
                           <select name="level_id" id="inputState" class="form-control">
                              @foreach ($levels as $level)  
                              <option selected value="{{ $job->id }}">{{ $levels->find($job->level_id) }}</option>
                              <option value="{{ $level->id }}">{{ $level->ar_name }}</option>
                              @endforeach
                            </select>
                          </div>      
                      </div>


                      <div class="form-group">
                              <label class="col-md-3 control-label"> الدوله</label>
                              <div class="col-md-6">
                               <select name="country_id" id="inputState" class="form-control">
                                  @foreach ($countries as $country) 
                                  <option selected value="{{ $levels->find($job->level_id)->id }}">{{ $levels->find($job->level_id)->ar_name }}</option>
                                  <option value="{{ $country->id }}">{{ $country->ar_name }}</option>
                                  @endforeach
                                </select>
                              </div>      
                          </div>

                          <div class="form-group">
                                  <label class="col-md-3 control-label">المدينه </label>
                                  <div class="col-md-6">
                                   <select name="city_id" id="inputState" class="form-control">
                                      @foreach ($cities as $city)
                                      <option selected value="{{ $cities->find($job->city_id)->id }}">{{ $cities->find($job->city_id)->ar_name }}</option>   
                                      <option value="{{ $city->id }}">{{ $city->ar_name }}</option>
                                      @endforeach
                                    </select>
                                  </div>      
                              </div>

                              <div class="form-group">
                                      <label class="col-md-3 control-label"> التخصص الاساسي</label>
                                      <div class="col-md-6">
                                       <select name="special_id" id="inputState" class="form-control">
                                          @foreach ($specials as $special) 
                                          <option selected value="{{ $specials->find($job->special_id)->id }}">{{ $specials->find($job->special_id)->ar_name }}</option>
                                          <option value="{{ $special->id }}">{{ $special->ar_name }}</option>
                                          @endforeach
                                        </select>
                                      </div>      
                                  </div>

                                  <div class="form-group">
                                          <label class="col-md-3 control-label"> التخصص الفرعي</label>
                                          <div class="col-md-6">
                                           <select name="sub_special_id" id="inputState" class="form-control">
                                              @foreach ($sub_specials as $sub_special)
                                              <option selected value="{{ $sub_specials->find($job->sub_special_id)->id }}">{{ $sub_specials->find($job->sub_special_id)->ar_name }}</option>
                                              <option value="{{ $sub_special->id }}">{{ $sub_special->ar_name }}</option>
                                              @endforeach
                                            </select>
                                          </div>      
                                      </div>
                    
                      <div class="form-group">
                            <label class="col-md-3 control-label"> سنين الخبرة المطلوبة</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control  " placeholder="مثال: 1 شهر و2 سنة " name="experinse" value="{{$job->yearsOfExper}}">
                             </div>
                        </div>
                    
                        
                        <div class="form-group">
                                <label class="col-md-3 control-label">حالة العمل</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="status">
                                        <option value="" selected disabled>حالة العمل</option>
                                        <option value="Full time">دوام كامل</option>
                                        <option value="Part time">دوام جزئي</option>
                                    </select>
                                </div>
                            </div>
                    
                            <div class="form-group ">
                                    <label class="col-md-3 control-label">الراتب</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control  " placeholder="مثال: 2500 - 5000" name="selary" value="{{$job->selary}}">
                                      </div>
                                </div>

                            <div class="form-group">
                                    <label class="col-md-3 control-label">الوصف الوظيفي</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="3" name="ar_description">{{$job->ar_description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">حفظ</button>
                                        <button type="button" class="btn default">إلغاء</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>

            <!-- END PAGE BASE CONTENT -->
                         


@endsection