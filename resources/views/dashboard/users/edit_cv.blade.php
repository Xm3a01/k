@extends('layouts.defaultclient')
@section('content')


<div class="site-section bg-light" style="padding: 120px 5px;">
    <div class="alert alert-primary p-4"  role="alert">
            يبحث أصحاب العمل عنك، الرجاء تحديث سيرتك الذاتية
          </div>
<div class="container">
<div class="row">
    <div class="col-md-8 col-lg-8 mb-5">  
        <div class="bg-white"> 
            <h3 class="p-3">وظائف قد تهمك</h3> 
            <div class="px-5"> 
                    <div class="text-center">
                      <img src=" {{asset('asset/images/sadIcon.png')}} " alt="Image" class="img-fluid p-5">
                     <p class="pb-3">
                        نعتذر، لم نعثر على وظائف تناسب المعلومات التي أضفتها إلى سيرتك الذاتية. يرجى تعديل سيرتك الذاتية لتتمكن من العثور على نتائج تطابقها بشكل أفضل.
                    </p>
                    <div class="pb-5">
                        <button class="btn btn-primary " href="mycv.html" type="button" >تعديل السيرة الذاتية</button>
                      </div>
                    </div> 
                  </div>
             </div>
             <div class="mt-5">
              <div class="row text-center">
                <div class="col-md-6">
                  <div class="m-2 bg-white">
                    <h6 class="p-2">من شاهد سيرتي الذاتية</h6> 
                    <div class="px-3"> 
                            <div class="text-center">
                              <img src="images/sadIcon.png" alt="Image" class="img-fluid p-5">
                             <p class="pb-3">
                           لم يشاهد احد بعد.. تابع لإكمال السيرة الذاتية   </p>
                           <p class=""> أكمل سيرتك الذاتية بنسبة 80% لتكون من ضمن 10% من الأشخاص الأكثر ظهورًا.</p>
                            <div class="pb-3">
                                <button class="btn btn-primary " type="button" >تحديث السيرة الذاتية</button>
                              </div>
                          </div> 
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="m-2 bg-white">
                    <h6 class="py-3">الوظائف التي قدمتها</h6> 
                    <div class="px-3"> 
                            <div class="text-center">
                              <div style="padding: 0 100px"><svg class="gauge is-danger" aria-valuenow="20" data-gauge="" aria-valuemax="100" aria-valuemin="0" role="progressbar" data-bayt-gauge="24" viewBox="0 0 126 126" preserveAspectRatio="xMidYMid meet"><circle class="circle" cx="63" cy="63" r="58" stroke-width="5" fill="transparent"></circle><path class="arc" stroke-width="5" stroke-linecap="round" fill="transparent" d="M63 5 A58 58 0 1 1 59.358 120.886"></path><text class="dividend" x="63" y="50%" dy="10.5" text-anchor="middle" style="font-size:31.5px;line-height:1;">{{ number_format($count, '1', '.', '') }}%</text><text class="text" x="63" y="50%" dy="6.3" text-anchor="middle" style="font-size:18.9px;line-height:1;"></text><path class="path" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d=""></path></svg></div>
                             <p class="pt-3 pb-5">
                              
                                نعتذر، لم نعثر على وظائف تناسب المعلومات التي أضفتها إلى سيرتك الذاتية. يرجى تعديل سيرتك الذاتية لتتمكن من العثور على نتائج تطابقها بشكل أفضل.
                            </p>
                            <div class="pb-3">
                                <button class="btn btn-primary " type="button" >تعديل السيرة الذاتية</button>
                              </div>
                          </div> 
                        </div>
                     </div>
                    </div>
                </div>
              </div>
             </div>
         
      
       
      <div class="col-md-4 col-lg-4 mb-5">  
          <form action="#" class="px-3 py-2 bg-white"> 
                  <h5 class="p-2">أنشئ تنبيهاً وظيفياً</h5>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label class="font-weight-bold" for="email">المسمي الوظيفي</label>
                        <input type="email" id="email" class="form-control" placeholder="مثال: مدير الموارد البشرية">
                      </div>
                 
                    <div class="form-group col-md-12">
                          <label for="inputState" style="font-weight: 600;">البلد</label>
                          <select id="inputState" class="form-control">
                            <option>الامارات</option>
                            <option>السعودية</option>
                          </select>
                        </div> 
                      </div>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <input type="submit" value="انشئ الان" class="btn btn-primary btn-block px-3">
                      </div>
                    </div> 
                  </form>
  
                  <div class="py-5 px-3 mt-3 bg-white">
                  <div class="d-block d-md-flex">
                      <img src="images/lamp-dashboard-icon.png" class="img-40 u-left-m m20 p-2" alt="">
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