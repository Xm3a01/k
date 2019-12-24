@extends('dashboard.metronic')
@section('title')
    شركاء النجاح
@endsection
@section('content')


         <!-- BEGIN PAGE HEAD-->
         <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>    شركاء النجاح    
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
                    <span class="active">إضافة شركاء النجاح  </span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT --> 
            
            <div class="mt-bootstrap-tables">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title"> 
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
                        <d <div class="table-toolbar pull-left">
                            <div class="btn-group">
                                <a data-toggle="modal" href="#add"  id="" class="btn green">   أضف شركة جديدة
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <table id="users-table" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> إسم الشركة  </th>
                                        <th>شعار الشركة  </th>
                                        <th> عمليات </th>
                                    </tr>
                                </thead>
                         
                                    <tbody> 
                                       @foreach ($parteners as $partener)
                                         <tr> 
                                            <td>{{$partener->id}}</td> 
                                            <td>{{$partener->partner_name}} </td>
                                            <td>{{$partener->partner_logo}} </td>
                                             <td>
                                            <form action="#" method="POST">
                                                    @csrf {{ method_field('DELETE') }}
                                                    <a data-toggle="modal"  href="#" class="btn dark btn-sm btn-outline bold uppercase">
                                                        <i class="fa fa-edit"> تعديل </i>
                                                    </a>
                                                    <button type="submit" class="btn red btn-sm btn-outline bold uppercase">
                                                        <i class="fa fa-trash">حذف</i>
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
            
            
            <div class="modal fade" id="add" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <img src=" {{asset('vendor/img/remove-icon-small.png')}} " alt="" srcset=""> </button>
                    <h4 class="modal-title"> إضافة شركاء النجاح</h4>
                    </div>
                <div class="modal-body">
                     BEGIN PAGE BASE CONTENT 
                  
                       <form class="form-horizontal" role="form" method="POST" action="{{route('abouts.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="select_one" value="partner">
                        <input type="hidden" name="about_id" value="{{ $about->id}}">
                                    <input type="hidden" name="partener_id" value="{{$partener->id}}">
                                    <div class="form-body">  
                        <div class="form-group">
                          <label class="col-md-3 control-label">  إسم الشركة  </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="ادخل  إسم الشركة     " name="partner_name">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-3 control-label">  شعار الشركة   </label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="partner_logo">
                            </div>
                        </div> 
                        
                        <div class="form-actions">
                        <div class="row">
                     <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn green">حفظ</button>
                   </div>
                 </div>
               </div>
               </div>
            </form>
          </div> 
        </div>
         /.modal-content 
    </div>
     /.modal-dialog 
</div>
<!-- /.modal -->
            
              

@endsection