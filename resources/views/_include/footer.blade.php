
<footer class="site-footer" style="font-size: 14px">
    <div class="container">
       <div class="row">
        <div class="col-md-4">
            @php
              $about = App\About::latest()->first();
            @endphp
          <h3 class="footer-heading mb-4 text-white"> {{__('About Company')}}  </h3>
             <p>{{app()->getLocale() == 'ar' ? Str::limit($about->ar_about ?? '' , $limit = 180) : Str::limit($about->about ?? '' , $limit = 180)}}</p>
              <p><a href="{{route('about.footer' , app()->getLocale())}}" class="btn btn-primary pill text-white mb-3">{{__('More')}} </a></p>
        </div>    
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6 mb-3">
              <h3 class="footer-heading mb-4 text-white"> {{__('Quick Menu')}} </h3>
              <ul class="list-unstyled mb-3">
                <li><a href="{{route('job.owner' , app()->getLocale())}}"> {{__('Employer?')}} </a></li>
                <li><a href="{{route('users.index' , app()->getLocale())}}">{{__('Add your CV')}} </a></li>
                <li><a href="{{route('web.contact' , app()->getLocale())}}"> {{__('Contact US')}} </a></li>
                <li><a href="{{route('about.footer' , app()->getLocale())}}">{{__('About Us')}} </a></li>
                </ul>
            </div>
            <div class="col-md-6 mb-3">
              <h3 class="footer-heading mb-4 text-white">{{__('Location')}}</h3>
                <ul class="list-unstyled mb-3">
                  <p class="mb-0">{{ app()->getLocale() == 'ar' ? $about->ar_location ?? '' : $about->location ?? ''}}</p>
                 </ul>
            </div>
          </div>
        </div>


        <div class="col-md-2 ">
          <div class="">
            <h3 class="footer-heading mb-4 text-white">{{__('Social Media')}}  </h3>
          </div>
          <div class="col-md-12 p-0 mb-3">
            <p>
              <a href="https://www.facebook.com/amwajalkhalij/" class="p-2"><span class="icon-facebook"></span></a>
              <a href="#" class="p-2"><span class="icon-twitter"></span></a>
              <a href="#" class="p-2"><span class="icon-instagram"></span></a> 

            </p>
          </div>
        </div>
      </div>
      <div class="row pt-3   text-center">
        <div class="col-md-12">
          <p> 
            <script>
              document.write(new Date().getFullYear());
            </script> {{__('All rights reserved for')}} | {{__('Amwage Alkhaleeg')}}
               {{__('by')}} <a href="https://daam.sd" target="_blank"> {{__('Daam for projects development')}} </a>
          </p>
        </div>

      </div>
    </div>
  </footer>
