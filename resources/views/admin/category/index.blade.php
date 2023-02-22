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
                        <li class="breadcrumb-item ">{{__('Category')}}</li>
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
                                    <button type="button" class="btn btn-sm btn-add" data-toggle="modal" data-target="#addCategory">
                                        <i class="mr-2 fa fa-plus-circle" aria-hidden="true"></i>{{__('Add New')}}
                                    </button>
                                </div>
                            <i class="mr-2 fa fa-gg" aria-hidden="true"></i>
                            <span class="text-uppercase text-blue-steel text-bold">{{__('List all')}} {{__('Company')}}</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <div class="dataTabkes_wrapper ">
                                    <table id="table_categories" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th class="th-header" style="width: 50px">{{__('No')}}</th>
                                            <th class="th-header">{{__('Name')}}</th>
                                            <th class="th-header" style="width: 130px">{{__('Create at')}}</th>
                                            <th class="th-header" style="width: 50px">{{__('Status')}}</th>
                                            <th class="th-header" style="width: 70px">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key => $value)
                                            <tr>
                                                <td class="tr-body text-center">{{$key+1}}</td>
                                                <td class="tr-body">{{$value->name}}</td>
                                                <td class="tr-body">{{ Carbon\Carbon::parse($value->created_at)->diffForHumans()}} </td>
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
                                                    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editmodal{{$value->id}}">
                                                        <i class="fa fa-pencil text-blue" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit-->
                                            <div class="modal fade editmodal" id="editmodal{{$value->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">{{__('Update')}} {{__('Category')}}</h5>
                                                        </div>
                                                        <form action="{{route('categories.update',$value->id)}}" method="post" >
                                                            @csrf
                                                            {{ method_field('PUT') }}
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="categories_name control-label">{{__('Name')}} <span style="color: red;">*</span></label>
                                                                    <input type="text" class="form-control" name="categories_name_edit" id="categories_name_edit" placeholder="{{__('Enter Category Name')}}" value="{{$value->name}}">
                                                                    @error('categories_name_edit')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-outline-save">{{__('Update')}}</button>
                                                                <button type="button" class="btn btn-outline-cancel" data-dismiss="modal">{{__('Cancel')}}</button>
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
<!-- Modal Add-->
<div class="modal fade" id="addCategory" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{__('Add')}} {{__('Category')}}</h5>
            </div>
            <form action="{{route('categories.store')}}" method="post" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categories_name control-label">{{__('Name')}} <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="categories_name" id="categories_name" placeholder="{{__('Enter Category Name')}}" autofocus>
                        @error('categories_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-save">{{__('Save')}}</button>
                    <button type="button" class="btn btn-outline-cancel" data-dismiss="modal">{{__('Cancel')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>



@include('admin.layouts.footer')
<script>

    function changeCategoryStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;
        // let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: `categories/change-status`,
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
