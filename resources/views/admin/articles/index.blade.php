@include('admin.layouts.header')
@include('admin.layouts.navigation')
@include('admin.layouts.sweetalert2')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('Dashboard')}}</a></li>
                        <li class="breadcrumb-item ">{{__('Articles')}}</li>
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
                                <div class="float-right">
                                    <a href="{{route('articles.create')}}" class="btn btn-sm btn-add">
                                        <i class="mr-2 fa fa-plus-circle" aria-hidden="true"></i>{{__('Add New')}}
                                    </a>
                                </div>
                            <i class="mr-2 fa fa-gg" aria-hidden="true"></i>
                            <span class="text-uppercase text-blue-steel text-bold">{{__('List all')}} {{__('Sub Category')}}</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <div class="dataTabkes_wrapper ">
                                    <table id="table_categories" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th class="th-header" style="width: 50px">{{__('No')}}</th>
                                            <th class="th-header">{{__('Title')}}</th>
                                            <th class="th-header" style="width: 130px">{{__('Category')}}</th>
                                            <th class="th-header" style="width: 130px">{{__('Sub Category')}}</th>
                                            <th class="th-header" style="width: 130px">{{__('Create at')}}</th>
                                            <th class="th-header" style="width: 50px">{{__('Viewer')}}</th>
                                            <th class="th-header" style="width: 50px">{{__('Status')}}</th>
                                            <th class="th-header" style="width: 80px">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key => $value)
                                            <tr>
                                                <td class="tr-body text-center">{{$key+1}}</td>
                                                <td class="tr-body">{{$value->title}}</td>
                                                <td class="tr-body">{{$value->category->name}}</td>
                                                <td class="tr-body">{{$value->subcategory->name ?? 'N/A'}}</td>
                                                <td class="tr-body">{{ Carbon\Carbon::parse($value->created_at)->diffForHumans()}} </td>
                                                <td class="tr-body">{{$value->viewer}}</td>
                                                <td class="tr-body text-center">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   {{($value->status) ? 'checked' : ''}}
                                                                   onclick="changeCategoryStatus(event.target, {{ $value->id }});" id="status{{$value->id}}">
                                                            <label class="custom-control-label pointer" for="status{{$value->id}}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="tr-body text-center">
                                                    <a href="{{route('articles.show',encrypt($value->id))}}" class="btn btn-sm" title="Edit">
                                                        <i class="fa fa-pencil text-blue" aria-hidden="true"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$value->id}}">
                                                        <i class="fa-solid fa-trash-can text-red"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal Delete-->
                                            <div class="modal fade" id="staticBackdrop{{$value->id}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{route('articles.destroy',encrypt($value->id))}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {!! method_field('DELETE') !!}
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete</h1>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{__('Are you sure!. Do you want to delete?')}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
                                                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                          @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('admin.layouts.footer')
<script>

    function changeCategoryStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;
        // let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: `articles/change-status`,
            type: 'post',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: status
            },
            success: function (result) {
            }
        });
    }

</script>
