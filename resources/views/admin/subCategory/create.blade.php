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
                        <li class="breadcrumb-item"><a href="{{route('subCategory.index')}}">{{__('Sub Category')}}</a></li>
                        <li class="breadcrumb-item ">{{__('Add Sub Category')}}</li>
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
                <div class="col-lg-6 col-6">
                    <div class="card">
                        <div class="card-header width-icon">
                            <i class="mr-2 fa fa-gg" aria-hidden="true"></i>
                            <span class="text-uppercase text-blue-steel text-bold">{{__('List all')}} {{__('Sub Category')}}</span>
                        </div>
                        <form action="{{route('subCategory.store')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">{{__('Category')}} <span style="color: red">*</span></label>
                                    <select class="form-control select2" id="category_id" name="category_id" required>
                                        <option >{{__('Select')}}</option>
                                        @foreach(\App\Models\Category::where('status',1)->get() as $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-success float-right">Save</button>
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
