@extends('dashboard.metronic')
@section('title', ' جدول الخبرات')
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
            <h1> جدول الخبرات
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
            <span class="active">جدول الخبرات</span>
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
                            <span class="caption-subject font-dark bold uppercase">جدول الخبرات</span>
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
                        <table id="users-table" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th>صاحب الخبره</th>
                                <th>الدور الوظيفي</th>
                                <th>التخصص</th>
                                <th>سنين الخبره</th>
                                <th>المستوى الوظيفي</th>
                                <th>بدية العمل  في الخبره</th>
                                <th>نهايه العمل في الخبر</th>
                                <th>الوصف</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @foreach($experiences as $experience)
                            <tr>
                                <td>{{$experience->id}}</td>
                                <td>{{$experience->user->ar_name}}</td>
                                <td>{{$experience->ar_role}}</td>
                                <td>{{$experience->ar_sub_special}}</td>
                                <td>{{$experience->expert_year.' سنوات'}}</td>
                                <td>{{$experience->ar_level}}</td>
                                <td>{{$experience->start_month .'/'.$experience->start_year }}</td>
                                <td>{{$experience->end_month .'/'.$experience->end_year }}</td>
                                <td>{{ $experience->ar_summary }}</td>
                                <td>
                                <form action="{{route('experiences.destroy', $experience->id)}}" method="POST">
                                    @csrf {{ method_field('DELETE') }}
                                    <a href="{{route('experiences.edit', $experience->id)}}"
                                        class="btn dark btn-sm btn-outline sbold uppercase">
                                        <i class="fa fa-edit"> تعديل </i>
                                    </a>
                                    <button type="submit" class="btn red btn-sm btn-outline sbold uppercase">
                                        <i class="fa fa-edit">حذف</i>
                                    </button>
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
