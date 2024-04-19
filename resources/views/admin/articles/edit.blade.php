@include('admin.layouts.header')
@include('admin.layouts.navigation')
{{--@include('admin.layouts.flash-message')--}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('Dashboard')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{route('articles.index')}}">{{__('Article')}}</a></li>
                        <li class="breadcrumb-item ">{{__('Edit Article')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header width-icon">
                            <i class="mr-2 fa fa-gg" aria-hidden="true"></i>
                            <span class="text-uppercase text-blue-steel text-bold">{{__('List all')}} {{__('Sub Category')}}</span>
                        </div>
                        <form action="{{route('articles.update',encrypt($data->id))}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {!! method_field('PUT') !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" autofocus required value="{{$data->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">{{__('Category')}} <span style="color: red">*</span></label>
                                            <select class="form-control select2" id="category_id" name="category_id" required>
                                                <option >{{__('Select')}}</option>
                                                @foreach(App\Models\Category::orderby('id','desc')->where('status',1)->get() as $cat)
                                                    <option value="{{$cat->id}}" @if($cat->id == $data->category_id) selected @endif>{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="sub_category_id">{{__('Sub Category')}}</label>
                                            <select class="form-control select2" id="sub_category_id" name="sub_category_id">
                                                <option value="">{{__('Select')}}</option>
                                                @foreach(App\Models\SubCategory::orderby('id','desc')->where('status',1)->where('category_id',$data->category_id)->get() as $cat)
                                                    <option value="{{$cat->id}}" @if($cat->id == $data->sub_category_id) selected @endif>{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" id="body" name="body" cols="30" rows="10">
                                                {{$data->body}}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="image">Thumbnail</label>
                                        <div class="form-input">
                                            <label for="thumbnail">Upload Image</label>
                                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" onchange="showPreview(event);" value="{{$data->thumbnail}}">
                                            <div class="preview">
                                                @if(!empty($data->thumbnail))
                                                    <img id="file-ip-1-preview" src="{{asset('frontend/assets/images/thumbnail')}}/{{$data->thumbnail}}">
                                                @else
                                                    <img id="file-ip-1-preview" src="{{asset('frontend/assets/images/thumbnail/default.gif')}}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-sm btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper --> 

@include('admin.layouts.footer')
<script type="text/javascript">
    function showPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    }

</script>
