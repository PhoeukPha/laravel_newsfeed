@include('layouts.header')
  <body>
    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    <div class="container">
      <header id="header">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_bottom">
              <div class="logo_area"><a href="index.html" class="logo"><img
                    src="{{asset('frontend/assets/images/logo.jpg')}}" alt=""></a></div>
              <div class="add_banner"><a href="#"><img
                    src="{{asset('frontend/assets/images/addbanner_728x90_V1.jpg')}}" alt=""></a></div>
            </div>
          </div>
        </div>
      </header>

        @include('layouts.menu')
        @include('layouts.trending')
        @include('layouts.slide')
        @include('layouts.content')
        @include('layouts.footer')

    </div>
    <script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.li-scroller.1.0.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.newsTicker.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.fancybox.pack.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom.js')}}"></script>
  </body>
</html>
