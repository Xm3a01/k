@extends('dashboard.metronic')
@section('content')


<div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1> جدول الاعلانات
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
            <span class="active">إضافة اعلان جديد  </span>
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
                        <span class="caption-subject font-dark bold uppercase">إضافة اعلان جديد</span>
                    </div>
                 </div> 
        <div class="portlet-body form">
            <form class="form-horizontal" role="form" method="POST" action="{{route('advs.update',$adv->id)}}" enctype ="multipart/form-data">
                @csrf
                @method('PUT')
                <input type ="hidden" name ="select" value ="adv">
                <div class="form-body">
                        <div class="form-group">
                                <label class="col-md-3 control-label"> الاعلان بالعربي</label>
                                <div class="col-md-6">
                                    <textarea  class="form-control"  name="ar_adv" >{{$adv->ar_adv}}</textarea>
                                    </div>
                            </div> 
                            <div class="form-group">
                                    <label class="col-md-3 control-label">الاعلان بالانجليزي</label>
                                    <div class="col-md-6">
                                        <textarea  class="form-control"  name="adv" >{{$adv->adv}}</textarea>
                                        </div>
                                </div> 
                                <div class="form-group">
                                        <label class="col-md-3 control-label">العنوان بالعربيه</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="  " name="ar_title" value="{{$adv->ar_title}}">
                                            </div>
                                    </div> 
                                    <div class="form-group">
                                            <label class="col-md-3 control-label">العنوان انجليزي</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder=" " name="title"  value="{{$adv->title}}">
                                                </div>
                                        </div> 
                                        
                                        <div class="form-group">
                                        <label class="col-md-3 control-label"> الصوره  </label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" name="img">
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



@endsection