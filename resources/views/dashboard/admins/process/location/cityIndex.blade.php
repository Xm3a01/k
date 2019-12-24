@extends('dashboard.metronic')
@section('content')


 <!-- BEGIN PAGE HEAD-->
 <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1> جدول الموقع
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
            <span class="active">جدول المواقع</span>
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
                            <span class="caption-subject font-dark bold uppercase">جدول المدن</span>
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
                                <a href="{{route('cities.create')}}" id="sample_editable_1_new" class="btn green">  أضف مدينه جديد
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
    <table id="table-pagination" data-toggle="table"
        data-url="../assets/global/plugins/bootstrap-table/data/data2.json"
        data-height="299" data-pagination="true" data-search="true">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th data-field="coName" data-align="center" data-sortable="true">المدينه</th>
                <th data-field="ar_coName" data-align="center" data-sortable="true">المدينه بالعربيه</th>
                <th data-field="" data-align="center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)     
            <tr>
                <td> </td>
                <td> {{$city->name}} </td> 
                <td> {{$city->ar_name}} </td> 
                <td> 
                    <a class="edit" href="{{route('cities.edit', $city->id)}}"> edit </a>
                    <a class="delete" onclick="event.preventDefault(); document.getElementById('city-delete').submit();"> del </a>
                    <form action="{{route('cities.destroy', $city->id)}}" method="post" id="city-delete">
                    @csrf
                    @method('delete')
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
    <!-- END PAGE BASE CONTENT -->


@endsection