@extends('dashboard.metronic')
@section('title')
    الشركه
@endsection
@section('content')

<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>    عن الشركة
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
        <span class="active">إضافة معلومات الشركة</span>
    </li>
</ul>
<!-- END PAGE BREA  DCRUMB -->
<!-- BEGIN PAGE BASE CONTENT --> 
<div class="row"> 
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
                <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green hide"></i>
                            <span class="caption-subject font-dark bold uppercase">إضافة معلومات الشركة  </span>
                        </div>
                    </div> 
    <div class="portlet-body form">
      <form class="form-horizontal" role="form" action="{{route('abouts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="select_one" value="about_company">
        <div class="form-body"> 
            <div class="form-group">
                <label class="col-md-3 control-label">نبذة عن الشركة</label>
                <div class="col-md-6">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="عن الشركة" name="about_company"></textarea>
                </div>
            </div>  
            <div class="form-group">
                <label class="col-md-3 control-label" >حمل فيديو</label>
                <div class="col-md-6">
                <input type="file" class="form-control" placeholder="ادخل رابط الفيديو " name="video">
                </div>
            </div>

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-social-dribbble font-green hide"></i>
                    <span class="caption-subject font-dark bold uppercase">  معلومات الاتصال  </span>
                </div>
             </div> 
            <div class="form-body"> 
                    <div class="form-group">
                            <label class="col-md-3 control-label">   العنوان</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" placeholder="ادخل  العنوان " name="location">
                            </div>
                          </div> 
                    <div class="form-group">
                            <label class="col-md-3 control-label"> البريد الالكتروني</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" placeholder="ادخل  البريد الالكتروني   " name="email">
                            </div>
                          </div>  
                            <div class="form-group">
                                <label class="col-md-3 control-label">   رقم الهاتف</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control" placeholder="ادخل رقم الهاتف    " name="phone">
                                </div>
                              </div> 
                </div>
            </div>

<div class="form-actions">
<div class="row">
<div class="col-md-offset-3 col-md-9">
<button type="submit" class="btn green">حفظ</button>

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