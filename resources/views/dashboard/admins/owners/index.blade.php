@extends('dashboard.metronic')
@section('content')


 <!-- BEGIN PAGE HEAD-->
 <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1> جدول اصحاب العمل
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
            <span class="active">  اصحاب العمل</span>
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
                            <span class="caption-subject font-dark bold uppercase">جــدول اصحاب العمل</span>
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
                                <a  href="{{route('companies.create')}}" id="sample_editable_1_new" class="btn green">  اضف صاحب عمل
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
    <table id="table-pagination" data-toggle="table"
        data-height="299" data-pagination="true" data-search="true">
        <thead>
            <tr>
                <th data-sortable="true">#</th>
                <th data-sortable="true">الاسم</th>
                <th data-sortable="true">البريد</th>
                <th data-sortable="true">التلفون</th>
                <th data-sortable="true">اسم الشركه</th>
                <th data-sortable="true">بريد الشركه</th>
                <th data-sortable="true">الدور الوظيفي</th>
                <th data-sortable="true">الدوله</th>
                <th data-sortable="true">الجنس</th>
                <th data-sortable="true">التاريخ</th>
                <th data-sortable="true">التحكم</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($owners as $owner)     
            <tr>
                <td data-search="true">{{$owner->id}} </td>
                <td data-search="true"> {{$owner->ar_name}} </td>
                <td data-search="true"> {{$owner->email}}</td>
                <td data-search="true"> {{$owner->phone}}</td>
                <td data-search="true"> {{$owner->company_name}}</td>
                <td data-search="true"> {{$owner->company_email}} </td>
                @foreach ($owner->roles as $role) 
                <td data-search="true"> {{$role->ar_name}}</td>
                @endforeach
                @foreach ($owner->countries as $country) 
                <td data-search="true"> {{$country->ar_name}}</td>
                @endforeach
                <td data-search="true"> {{$owner->ar_gender}} </td>
                <td data-search="true" class="center"> {{$owner->created_at}} </td>
                <td data-search="true" class="center"> 
                    <form method="POST"  action="{{route('companies.destroy' , $owner->id)}}" id="delete-owner">
                      @csrf
                      @method('delete')
                      <a class="" href="{{route('companies.edit',$owner->id)}}"><i class="fa fa-edit"></i></a>

                     <button type="submit">
                            <i class="fa fa-trash"></i>
                      </button>

                    <a class="" href="{{route('jobs.create',$owner->id)}}"><i class="fa fa-plus">اضافة عمل</i></a>
                      
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

@section('scripts')
    <script>
    </script>
@endsection