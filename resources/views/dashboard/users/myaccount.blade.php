@extends('layouts.defaultclient')
@section('content')


<div class="site-section bg-light  " style="padding: 120px 5px;">
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8 mb-5"> 
          <h3 class="py-3">{{__('You may interest')}}</h3> 
                    <div class="modrn-joblist"> 
                         <div class="rounded jobs-wrap">
                                <a href="job-single.html" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                                 <div class="company-logo blank-logo text-center text-md-left pl-3">
                                   <img src="images/4.png" alt="Image" class="img-fluid mx-auto">
                                 </div>
                                 <div class="job-details h-100">
                                   <div class="p-3 align-self-center">
                                    <h3>web developer</h3>
                                    <div class="d-block d-lg-flex">
                                     <p class="m-0">دعم لتطوير المشاريع-الخرطوم</p>
                                      <span class="mr-3">26Aug</span> 
                                        </div>
                                     <div class="d-block d-lg-flex"> 
                                       <div ><span class="icon-suitcase mr-1 ml-2"></span>متوسط الخبرة</div>
                                       <div class="mr-3" >3000USD-5000USD<span class="icon-money mr-1"></span></div>
                                     </div>
                                     </div>
                                 </div>
                                 <div class="job-category align-self-center">
                                   <div class="p-3">
                                     <span class="text-info p-2 rounded border border-info">Full Time</span>
                                   </div>
                                 </div>
                               </a> 
            
                               <a href="job-single.html" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                                    <div class="company-logo blank-logo text-center text-md-left pl-3">
                                      <img src="images/2.png" alt="Image" class="img-fluid mx-auto">
                                    </div>
                                    <div class="job-details h-100">
                                      <div class="p-3 align-self-center">
                                       <h3>web developer</h3>
                                       <div class="d-block d-lg-flex">
                                        <p class="m-0">دعم لتطوير المشاريع-الخرطوم</p>
                                         <span class="mr-3">26Aug</span> 
                                           </div>
                                        <div class="d-block d-lg-flex"> 
                                          <div ><span class="icon-suitcase mr-1 ml-2"></span>متوسط الخبرة</div>
                                          <div class="mr-3" >3000USD-5000USD<span class="icon-money mr-1"></span></div>
                                        </div>
                                       </div>
                                    </div>
                                    <div class="job-category align-self-center">
                                            <div class="p-3">
                                              <span class="text-warning p-2 rounded border border-warning">Freelance</span>
                                            </div>
                                          </div>
                                  </a>  
            
                                      <a href="job-single.html" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                                            <div class="company-logo blank-logo text-center text-md-left pl-3">
                                              <img src="images/3.png" alt="Image" class="img-fluid mx-auto">
                                            </div>
                                            <div class="job-details h-100">
                                              <div class="p-3 align-self-center">
                                               <h3>web developer</h3>
                                               <div class="d-block d-lg-flex">
                                                <p class="m-0">دعم لتطوير المشاريع-الخرطوم</p>
                                                 <span class="mr-3">26Aug</span> 
                                                   </div>
                                                <div class="d-block d-lg-flex"> 
                                                  <div ><span class="icon-suitcase mr-1 ml-2"></span>متوسط الخبرة</div>
                                                  <div class="mr-3" >3000USD-5000USD<span class="icon-money mr-1"></span></div>
                                                </div>
                                               </div>
                                            </div>
                                            <div class="job-category align-self-center">
                                                    <div class="p-3">
                                                      <span class="text-warning p-2 rounded border border-warning">Freelance</span>
                                                    </div>
                                                  </div>
                                          </a> 
            
                                          <a href="job-single.html" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                                                <div class="company-logo blank-logo text-center text-md-left pl-3">
                                                  <img src="images/2.png" alt="Image" class="img-fluid mx-auto">
                                                </div>
                                                <div class="job-details h-100">
                                                  <div class="p-3 align-self-center">
                                                   <h3>web developer</h3>
                                                   <div class="d-block d-lg-flex">
                                                    <p class="m-0">دعم لتطوير المشاريع-الخرطوم</p>
                                                     <span class="mr-3">26Aug</span> 
                                                       </div>
                                                    <div class="d-block d-lg-flex"> 
                                                      <div ><span class="icon-suitcase mr-1 ml-2"></span>متوسط الخبرة</div>
                                                      <div class="mr-3" >3000USD-5000USD<span class="icon-money mr-1"></span></div>
                                                    </div>
                                                     </div>
                                                </div>
                                                <div class="job-category align-self-center">
                                                        <div class="p-3">
                                                          <span class="text-warning p-2 rounded border border-warning">Freelance</span>
                                                        </div>
                                                      </div>
                                              </a> 
            
                                  <div class="text-center pt-5" data-aos="fade-up" data-aos-delay="50"><a class="btn"
                                    href="new-post.html">{{__('More')}}</a>
                                </div>
                         
                                </div> 
                           
                    </div> 
            
                 
         </div>  

    <div class="col-md-4 col-lg-4 mb-5">  
        <form action="#" class="px-3 py-2 my-3 bg-white" autocomplete="off"> 
                <h5 class="p-2">{{__('Make job notification')}}</h5>
                  <div class="row form-group">
                    <div class="col-md-12">
                      <label class="font-weight-bold" for="email">{{__('Job name')}}</label>
                      <input type="email" id="email" class="form-control" placeholder="مثال: مدير الموارد البشرية">
                    </div>
               
                  <div class="form-group col-md-12">
                        <label for="inputState" style="font-weight: 600;">{{__('Country')}}</label>
                        <select id="inputState" class="form-control">
                          <option>الامارات</option>
                          <option>السعودية</option>
                        </select>
                      </div> 
                    </div>
                  <div class="row form-group">
                    <div class="col-md-12">
                      <input type="submit" value="{{__('Save')}}" class="btn btn-primary btn-block px-3">
                    </div>
                  </div> 
                </form>

                <div class="py-5 px-3 mt-3 bg-white">
                <div class="d-block d-md-flex">
                    <img src=" {{asset('asset/images/ideaicon2.png')}} " class="img-40 u-left-m m20 p-2"     width="85px" alt="">
                    <p>يبحث أصحاب العمل باستمرار عن موظفين جدد! فاحرص على تحديث سيرتك الذاتية.</p>
                    </div>
                 
                 <div class="">
                     <a href="" class="d-flex justify-content-center" style="text-decoration: underline; font-size: 15px; font-weight: 600; cursor: pointer; color:#333">حدث سيرتك الذاتية الان</a>
                 </div>
              </div>
            </div>
        </div>
      </div>
    </div>




@endsection