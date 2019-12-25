@extends('dashboard.metronic')
@section('content')


<div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1> جدول المجالات
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
            <span class="active">  تعديل الاخبار  </span>
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
                        <span class="caption-subject font-dark bold uppercase"> تعديل الاخبار</span>
                    </div>
                 </div> 
        <div class="portlet-body form">
            <form class="form-horizontal" role="form" method="POST" action="{{route('news.update',$news->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
            <div class="form-group">
                    <label class="col-md-3 control-label"> العنوان </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="ادخل العنوان " name="ar_title" value="{{$news->ar_title}}">
                        </div>
                </div> 
                <div class="form-group">
                        <label class="col-md-3 control-label"> العنوان باللغه الانجليزيه</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="ادخل العنوان باللغه الانجليزيه " name="title" value="{{$news->title}}">
                            </div>
                    </div> 
                    <div class="form-group">
                                <label class="col-md-3 control-label"> المحتوى باللغه العربيه </label>
                                <div class="col-md-6">
                                    <textarea class="form-control" placeholder="ادخل  المحتوى باللغه العربيه" name="ar_contant"> {{$news->ar_contant}} </textarea>
                                </div>
                            </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label"> المحتوى باللغه الانجليزيه</label>
                            <div class="col-md-6">
                                    <textarea class="form-control" placeholder="ادخل المحتوى باللغه الانجليزيه" name="contant"> {{$news->contant}} </textarea>
                            </div>
                        </div> 

                        <div class="form-group">
                                <label class="col-md-3 control-label"> الصوره</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" placeholder="" name="photo">
                                    </div>
                         </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">حفظ</button>
            </form>
        </div>
    </div> 
</div>
</div>



@endsection