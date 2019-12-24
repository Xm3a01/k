@extends('dashboard.metronic')
@section('title', ' جدول المستخدمين')
<!-- BEGIN CSS -->
@section('stylesheets')
<link rel="stylesheet" href="{{ asset('vendor/plugins/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{asset('vendor/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css')}}">
@endsection
<!-- END CSS -->
@section('content')
<!-- BEGIN PAGE-BAR -->
<div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1> جدول المستخدمين
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
            <span class="active">  المستخدمين  </span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="mt-bootstrap-tables">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green hide"></i>
                            <span class="caption-subject font-dark bold uppercase">جدول المستخدمين</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group pull-left">
                                <button class="btn green btn-outline dropdown-toggle"
                                    data-toggle="dropdown">الادوات
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" style="font-family: hacen">
                                    <li>
                                        <a href="javascript:;"> طباعة </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> طباعة ملف PDF </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> تصدير إلي إكسل </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar pull-left">
                            <div class="btn-group">
                                <a data-toggle="modal" href="#add_user"  id="sample_editable_1_new" class="btn green"> أضف مستخدم جديد 
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <table id="users-table" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>الأسم</th>
                                        <th>الاسم الاخير</th>
                                        <th>البريد</th>
                                        <th>تلفون</th>
                                        <th>الديانه</th>
                                        <th>المدينه</th>
                                        <th>رقم الهويه</th>
                                        <th>الحاله الاجتماعيه</th>
                                        <th>الدور الوظيفي</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                         
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->ar_name}}</td>
                                            <td>{{$user->ar_last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->ar_religion}}</td>
                                            <td>{{$user->ar_city}}</td>
                                            <td>{{$user->idint_1 .' - '.$user->idint_2}}</td>
                                            <td>{{$user->ar_social_status}}</td>
                                            <td>{{$user->ar_role}}</td>
                                            <td style="width:auto">
                                                <form action="{{route('cv.destroy', $user->id)}}" method="POST">
                                                    @csrf {{ method_field('DELETE') }}

                                                    <div class="action" >
                                                    
                                                        <button class="btn btn-info dropdown-toggle"
                                                            data-toggle="dropdown">الادوات
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" style="font-family: hacen">
                                                            <li>
                                                                    <a  href="{{route('exp.create' , $user->id)}}"  id="sample_editable_1_new" class="btn blue btn-sm btn-outline sbold uppercase">اضف خبره
                                                                            <i class="fa fa-plus"></i>
                                                                     </a>
                                                            </li>
                                                            <li>
                                                                    <a href ="{{route('user.edu' , $user->id)}}"  id="sample_editable_1_new" class="btn blue btn-sm btn-outline sbold uppercase">اضف تعليم
                                                                            <i class="fa fa-plus"></i>
                                                                     </a>
                                                            </li>
                                                            <li>
                                                                    <a href ="{{route('user.lang' , $user->id)}}"  id="sample_editable_1_new" class="btn blue btn-sm btn-outline sbold uppercase">اضف اللغه
                                                                            <i class="fa fa-plus"></i>
                                                                         </a>
                                                            </li>
                                                            <li>
                                                                    <a href="{{route('cv.edit', $user->id)}}"
                                                                            class="btn dark btn-sm btn-outline bold uppercase">
                                                                            <i class="fa fa-edit"> تعديل </i>
                                                                        </a>
                                                            </li>
                                                            <li>
                                                                    <button type="submit" class="btn red btn-sm btn-block btn-outline bold uppercase">
                                                                            <i class="fa fa-edit">حذف</i>
                                                                    </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                 
                                                </form>
                                            </td>
                                      </tr> 
                                                    
                                     @endforeach
                                 </tbody>
                          </table>
                    </div>
                    
                </div>
            </div>
            </div>
            </div>
            <!-- END DATATABLE -->

<!-- BEGIN ADD_company MODEL -->
    <div class="modal fade" id="add_user" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <img src=" {{asset('vendor/img/remove-icon-small.png')}} " alt="" srcset=""> </button>
                    <h4 class="modal-title">إضافة مستخدم جديد</h4>
                </div>
                <div class="modal-body">
                                <!-- BEGIN PAGE BASE CONTENT --> 
            <div class="row"> 
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="p-3"> 
            <div class="portlet-body form">
             <form class="form-horizontal" id="user-form-add" role="form" method="POST" action="{{route('cv.store')}}">
                @csrf
                <input type="hidden" name="select_user" value="user">
                <div class="form-body">
                    <h4 class="text-left m-3">البيانات الشخصية</h4><br>
                    <div class="form-group">
                        <label class="col-md-2 control-label"> الاسم الاول</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="ادخل الاسم الاول  " name="ar_name">
                          </div>  

                          <label class="col-md-1 control-label">الاسم الاخير</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="ادخل الاسم الثاني  " name="ar_last_name">
                          </div>  
                    </div>
                    <div class="form-group">
                            <label class="col-md-2 control-label">البريد الاكتروني</label>
                            <div class="col-md-4">
                                <input type="email" name="email" class="form-control  " placeholder=" ادخل البريد الاكتروني">
                            </div>
                            <label class="col-md-1 control-label">كلمة المرور</label>
                            <div class="col-md-4">
                                    <input type="password" name="password" class="form-control  " placeholder="كلمة المرور">
                             </div> 
                        </div>
                    
                    <div class="form-group">
                            <label class="col-md-2 control-label">الجنسية  </label>
                            <div class="col-md-4">
                           <input list="country" name="country" id="inputState" class="form-control" placeholder="الجنسيه" autocomplete="off">
                            </div>
                            <datalist id="country" dir="rtl" >
                              @foreach ($countries as $country)    
                              <option value="{{(app()->getLocale() == 'ar') ? $country->ar_name : $country->name}}">
                              @endforeach
                              </datalist>

                              <label class="col-md-1 control-label">العنوان</label>
                              <div class="col-md-4">
                            <input list="brith" name="brith" id="inputState" class="form-control" placeholder="مكان الميلاد" autocomplete="off">
                            </div>
                            <datalist id="brith" dir="rtl" >
                              @foreach ($cities as $city)    
                              <option value="{{(app()->getLocale() == 'ar') ? $city->ar_name : $city->name}}">
                              @endforeach
                              </datalist>
                        </div>

                        <div class="form-group">
                                <label class="col-md-2 control-label">المدينه</label>
                                <div class="col-md-4">
                                      <input list="city" name="city" id="inputState" class="form-control" placeholder="المدينه الحاليه" autocomplete="off">
                                    </div>
                                    <datalist id="city" dir="rtl" >
                                      @foreach ($cities as $city)    
                                      <option value="{{(app()->getLocale() == 'ar') ? $city->ar_name : $city->name}}">
                                      @endforeach
                                      </datalist>
                                  

                              <label class="col-md-1 control-label">تاريخ الميلاد</label>
                              <div class="col-md-4">
                                    <input type="date" class="form-control" name="birthdate" id="">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="col-md-2 control-label"> الديانة  </label>
                                <div class="col-md-4">
                                      <select class="form-control" name="religion">
                                          <option disabled selected>اختر الديانة  </option>
                                          <option value="Muslime">مسلم</option>
                                          <option value="Christian">مسيحي</option>
                                          <option value="Gushin">يهودي </option>
                                          <option value="Other">اخرى</option>
                                      </select>
                                  </div>

                              <label class="col-md-1 control-label">الحالة الاجتماعية</label>
                              <div class="col-md-4">
                                    <select class="form-control" name="social_status">
                                        <option disabled selected>اختر الحالة الاجتماعية  </option>
                                        <option value="Married">متزوج</option>
                                        <option value="Single">اعزب </option>
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="col-md-2 control-label">رقم الجواز</label>
                                <div class="col-md-4">
                                    <input type="text" name="idint_1" class="form-control" id="" placeholder="مثلا 233456765">
                                </div>
                                  <label class="col-md-1 control-label">الرقم الوطني</label>
                                  <div class="col-md-4">
                                        <input type="text" name="idint_2" class="form-control  " placeholder="مثلا 188-15-34-567-45">
                                    </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-2 control-label">التخصص</label>
                                <div class="col-md-4">
                                    <input list="special" name="sub_special" id="inputState" class="form-control" placeholder="التخصص " autocomplete="off">
                                    </div>
                                    <datalist id="special" dir="rtl" >
                                      @foreach ($sub_specials as $sub_special)    
                                      <option value="{{(app()->getLocale() == 'ar') ? $sub_special->ar_name : $sub_special->name}}">
                                      @endforeach
                                      </datalist>

                                <label class="col-md-1 control-label">الدور الوظيفي</label>
                                <div class="col-md-4">
                                    <input list="role" name="role" id="inputState" class="form-control" placeholder="الدور الوظيفي" autocomplete="off">
                                    </div>
                                    <datalist id="role" dir="rtl" >
                                      @foreach ($roles as $role)    
                                      <option value="{{(app()->getLocale() == 'ar') ? $role->ar_name : $role->name}}">
                                      @endforeach
                                      </datalist>
                            </div>

                            <br><h4 class="text-left m-3">بيانات الاتصال</h4><br>
                            <div class="form-group">
                                    <label class="col-md-2 control-label">رقم الهاتف</label>
                                    <div class="col-md-4">
                                            <input type="text" name="phone" class="form-control  " placeholder=" ادخل رقم الهاتف">
                                     </div> 
                                </div> 
                         </div>    
                        </form>
                    </div>
                </div> 
            </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn green" onclick="event.preventDefault(); document.getElementById('user-form-add').submit();">حفظ</button>
        </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
             

@endsection

<!-- BEGIN SCRIPTS -->
@section('scripts')
<script src="{{ asset('vendor/js/datatable.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
<script>
    //Datatable
    $(document).ready(function () {
        $('#users-table').DataTable();
    });

</script>
@endsection
<!-- END SCRIPTS -->
