<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_post_content">
                    @foreach(\App\Models\Category::orderby('created_at','desc')->where('status',1)->get() as $value)
                        <h2><span>{{$value->name}}</span></h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="business_catgnav wow fadeInDown">
                                    @foreach(\App\Models\Article::orderby('created_at','desc')->where('category_id',$value->id)->limit(1)->get() as $val)
                                    <li>
                                        <figure class="bsbig_fig">
                                            <a href="{{route('article.detail',$val->slug)}}" class="featured_img">
                                                <img alt="" src="{{asset('frontend/assets/images/thumbnail')}}/{{$val->thumbnail}}">
                                                <span class="overlay"></span>
                                            </a>
                                            <figcaption>
                                                <a href="{{route('article.detail',$val->slug)}}">{{$val->title}}</a>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="spost_nav">
                                    @foreach(\App\Models\Article::orderby('created_at','desc')->where('category_id',$value->id)->limit(4)->offset(1)->get() as $val)
                                    <li>
                                        <div class="media wow fadeInDown">
                                            <a href="{{route('article.detail',$val->slug)}}" class="media-left">
                                                <img alt="" src="{{asset('frontend/assets/images/thumbnail')}}/{{$val->thumbnail}}">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{route('article.detail',$val->slug)}}" class="catg_title">{{$val->title}}</a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
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
