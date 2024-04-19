<form action="{{route('articles.index')}}" method="get">
    <div class="group-search">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="form-group mr-3">
                    <label for="title">{{__('Title')}}</label>
                    <input type="text" class="form-control" width="100%" id="title" name="title" placeholder="{{__('Enter Title')}}" value="{{ Request::query('title') }}">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group mr-3 column">
                    <label for="category_id">{{__('Menu')}}</label><br>
                    <select class="form-control select2" id="category_id" name="category_id">
                        <option value="" {{ Request::query('category_id') == '' ? 'selected' : '' }}>{{ __('Select') }}</option>
                        @foreach(App\Models\Category::orderby('id','desc')->where('status',1)->get() as $value)
                            <option value="{{ $value->id }}" {{ Request::query('category_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-3">
                    <label for="sub_category_id">{{__('Sub Menu')}}</label><br>
                    <select class="form-control select2" id="sub_category_id" name="sub_category_id">
                        <option value="" {{ Request::query('sub_category_id') == '' ? 'selected' : '' }}>{{ __('Select') }}</option>
                        @foreach(App\Models\SubCategory::orderby('id','desc')->where('status',1)->get() as $value)
                            <option value="{{ $value->id }}" {{ Request::query('sub_category_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
{{--                <div class="form-group mr-3">--}}
{{--                    <button type="button" class="btn btn-tool" onclick='exportTableToCSV("Task.csv")'>--}}
{{--                        Export CSV--}}
{{--                    </button>--}}
{{--                </div>--}}

                <div class="form-group mr-3">
                    <label for="page">{{__('Page')}}</label><br>
                    <select class="form-control select2" name="per_page" id="per_page">
                        <option value="" {{ Request::query('per_page') == '' ? 'selected' : '' }}>{{ __('Default') }}</option>
                        @foreach([50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000] as $value)
                            <option value="{{ $value }}" {{ Request::query('per_page') == $value ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">{{__('Action')}}</label>
                    <div class="group-action">
                        <button type="button" class="mr-2 btn-reset btn btn-sm btn-outline-success" onclick="exportTableToCSV('<?php echo date("Ymdhis").'.csv'; ?>')">
                            <i class="fas fa-file-export mr-2 mt-2"></i>{{__('Export')}}
                        </button>
                        <a href="{{route('articles.index')}}" class="mr-2 btn-reset btn btn-sm btn-outline-danger">
                            <i class="fa-solid fa-arrow-rotate-left mr-2 mt-2 fa-spin fa-spin-reverse"></i>{{__('Reset')}}
                        </a>
                        <button type="submit" class="btn btn-outline-info">
                            <i class="fa-solid fa-magnifying-glass mr-2 fa-fade"></i>{{__('Search')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
