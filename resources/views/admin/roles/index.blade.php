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
                        <li class="breadcrumb-item ">{{__('Role')}}</li>
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
                            @can('role-create')
                            <div class="float-right">
                                <a class="btn btn-sm btn-outline-info" href="{{route('roles.create')}}">
                                    <i class="mr-2 fa fa-plus-circle" aria-hidden="true"></i>{{__('Add New')}}
                                </a>
                            </div>
                            @endcan
                                <i class="mr-2 fa-solid fa-list"></i>
                            <span class="text-uppercase text-blue-steel text-bold">{{__('List all')}} {{__('Roles')}}</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <div class="dataTabkes_wrapper ">
                                    <table id="table_roles" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th class="th-header" style="width: 50px">{{__('No')}}</th>
                                            <th class="th-header">{{__('Name')}}</th>
                                            <th class="th-header">{{__('Description')}}</th>
                                            <th class="th-header" style="width: 110px;">{{__('Create at')}}</th>
                                            <th class="th-header" style="width: 110px;">{{__('Guard Name')}}</th>
                                            <th class="th-header" style="width: 50px;">{{__('Status')}}</th>
                                            @canany(['role-edit','role-delete'])
                                            <th class="th-header text-center" style="width: 100px;">{{__('Action')}}</th>
                                            @endcanany
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key => $role)
                                            <tr>
                                                <td class="tr-body text-center">{{$key+1}}</td>
                                                <td class="tr-body">{{$role->name}}</td>
                                                <td class="tr-body">{{$role->description ?? 'N/A'}}</td>
                                                <td class="tr-body">{{ Carbon\Carbon::parse($role->created_at)->diffForHumans()}}</td>
                                                <td class="tr-body">{{ $role->guard_name }}</td>
                                                <td class="tr-body text-center">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   {{($role->status) ? 'checked' : ''}}
                                                                   onclick="changeUserStatus(event.target, {{ $role->id }});" id="status{{$role->id}}">
                                                            <label class="custom-control-label pointer" for="status{{$role->id}}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="tr-body text-center">
                                                    @can('role-edit')
                                                    <a class="btn btn-sm" href="{{route('roles.edit',encrypt($role->id))}}">
                                                        <i class="fa fa-pencil text-blue" aria-hidden="true"></i>
                                                    </a>
                                                    @endcan
                                                    @can('role-delete')
                                                    <a href="#modal{{$role->id}}" data-toggle="modal" title="{{__('Delete')}}" class="btn btn-sm btn-icon">
                                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                    </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            <!-- Modal Delete-->
                                            <div class="modal fade" id="modal{{$role->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{route('roles.destroy',encrypt($role->id))}}" method="post">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{__('Delete')}} {{__('Role')}}</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{__('Are you sure you want to delete this')}} {{__('Role')}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-sm bg-danger">{{__('Delete')}}</button>
                                                                <button type="button" class="btn btn-sm btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
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

    function changeUserStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;
        // let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{route('roles.changeStatus')}}',
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
