@include('layouts.header')
<body>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
    <header id="header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="header_bottom">
                    <div class="logo_area"><a href="" class="logo"><img
                                src="{{asset('frontend/assets/images/logo.jpg')}}" alt=""></a></div>
                    <div class="add_banner"><a href="#"><img
                                src="{{asset('frontend/assets/images/addbanner_728x90_V1.jpg')}}" alt=""></a></div>
                </div>
            </div>
        </div>
    </header>

    @include('layouts.menu')
    <section id="contentSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="left_content">
                    <div class="error_page">
                        <h3>We Are Sorry</h3>
                        <h1>404</h1>
                        <p>Unfortunately, the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exists</p>
                        <span></span>
                        <a href="{{url('/')}}" class="wow fadeInLeftBig">Go to home page</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    <div class="single_sidebar">
                        <h2><span>Popular Post</span></h2>
                        <ul class="spost_nav">
                            @foreach(\App\Models\Article::orderby('viewer','desc')->where('status',1)->limit(4)->get() as $value)
                                <li>
                                    <div class="media wow fadeInDown">
                                        <a href="{{route('article.detail',$value->slug)}}" class="media-left">
                                            <img alt="" src="{{asset('frontend/assets/images/thumbnail')}}/{{$value->thumbnail}}">
                                        </a>
                                        <div class="media-body">
                                            <a href="{{route('article.detail',$value->slug)}}" class="catg_title"> {{$value->title}}</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_sidebar wow fadeInDown">
                        <h2><span>Sponsor</span></h2>
                        <a class="sideAdd" href="#">
                            <img src="{{asset('frontend/assets/images/add_img.jpg')}}" alt="">
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
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
