<section id="sliderSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="slick_slider">
                @foreach($slide as $value)
                    <div class="single_iteam">
                        <a href="{{route('article.detail',$value->slug)}}">
                            <img src="{{asset('frontend/assets/images/thumbnail')}}/{{$value->thumbnail}}" alt="">
                        </a>
                        <div class="slider_article">
                            <h2><a class="slider_tittle" href="{{route('article.detail',$value->slug)}}">{{$value->title}}</a></h2>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="latest_post">
                <h2><span>Latest post</span></h2>
                <div class="latest_post_container">
                    <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                    <ul class="latest_postnav">
                        @foreach($last_post as $val)
                        <li>
                            <div class="media">
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
                    <div id="next-button"><i class="fa fa-chevron-down"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>
