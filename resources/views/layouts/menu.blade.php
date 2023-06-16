<section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed btn-sm" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav main_nav">
                <li class="active">
                    <a href="{{url('/')}}">
                        <span class="fa fa-home desktop-home"></span>
                        <span class="mobile-show">Home</span>
                    </a>
                </li>
                @foreach($menu as $value)
                    @if(count($value->subcategory->where('status',1)) > 0)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$value->name}}</a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach($value->subcategory->where('status',1) as $subCat)
                                    <li><a href="{{route('getBySubCategory',$subCat->name)}}">{{$subCat->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li><a href="{{route('getByCategory',$value->name)}}">{{$value->name}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
</section>




{{--@foreach($category as $key => $value)--}}
{{--    <li class="dropdown nav-item dropright">--}}
{{--        @if(count($value->subCategory) > 0)--}}
{{--            <a href="#" class="nav-link" data-toggle="dropdown" id="">--}}
{{--                <span>--}}
{{--                    <i class="fa fa-laptop mr-2" aria-hidden="true"></i>--}}
{{--                    {{$value->name}}--}}
{{--                </span>--}}
{{--                <i class="fa fa-angle-right" aria-hidden="true"></i>--}}
{{--            </a>--}}
{{--        @else--}}
{{--            <a href="{{route('getfilter',$value->name,$value->id)}}" class="nav-link">--}}
{{--                <span>--}}
{{--                    <i class="fa fa-laptop mr-2" aria-hidden="true"></i>--}}
{{--                    {{$value->name}}--}}
{{--                </span>--}}
{{--            </a>--}}
{{--        @endif--}}
{{--        <ul class="dropdown-menu menu-right">--}}
{{--            <li class="nav-item">--}}
{{--                <ul class="nav flex-column">--}}
{{--                    @if($value->subCategory)--}}
{{--                        @foreach($value->subCategory as $sub)--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('getBrands',$sub->name)}}" class="nav-link {{$sub->id}}">{{$sub->name}}</a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}
{{--@endforeach--}}
