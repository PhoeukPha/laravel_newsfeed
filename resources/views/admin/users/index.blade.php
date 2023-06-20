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
                        <li class="breadcrumb-item ">{{__('User')}}</li>
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
                            @can('user-create')
                            <div class="float-right">
                                <a class="btn btn-sm btn-outline-info" href="{{route('users.create')}}">
                                    <i class="mr-2 fa fa-plus-circle" aria-hidden="true"></i>{{__('Add New')}}
                                </a>
                            </div>
                            @endcan
                                <i class="mr-2 fa-solid fa-list"></i>
                            <span class="text-uppercase text-blue-steel text-bold">{{__('List all')}} {{__('Users')}}</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <div class="dataTabkes_wrapper ">
                                    <table id="table_roles" class="table table-bordered table-striped table-hover table-sm datatable">
                                        <thead>
                                        <tr>
                                            <th class="th-header" style="width: 50px">{{__('No')}}</th>
                                            <th class="th-header">{{__('First Name')}}</th>
                                            <th class="th-header">{{__('Last Name')}}</th>
                                            <th class="th-header">{{__('Username')}}</th>
                                            <th class="th-header">{{__('Gender')}}</th>
                                            <th class="th-header">{{__('Phone Number')}}</th>
                                            <th class="th-header">{{__('E-mail')}}</th>
                                            <th class="th-header">{{__('Role')}}</th>
                                            <th class="th-header" style="width: 130px;">{{__('Create at')}}</th>
                                            <th class="th-header" style="width: 50px;">{{__('Status')}}</th>
                                            @canany(['user-edit','user-delete'])
                                            <th class="th-header text-center" style="width: 100px;">{{__('Action')}}</th>
                                            @endcanany
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key => $user)
                                            <tr>
                                                <td class="tr-body text-center">{{$key+1}}</td>
                                                <td class="tr-body">{{$user->first_name ?? 'N/A'}}</td>
                                                <td class="tr-body">{{$user->last_name ?? 'N/A'}}</td>
                                                <td class="tr-body">{{$user->username ?? 'N/A'}}</td>
                                                <td class="tr-body">{{$user->gender ?? 'N/A'}}</td>
                                                <td class="tr-body">{{$user->phone_number ?? 'N/A'}}</td>
                                                <td class="tr-body">{{$user->email ?? 'N/A'}}</td>
                                                <td class="tr-body">{{$user->getRoleNames()[0]}}</td>
                                                <td class="tr-body">{{ Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                                                <td class="tr-body text-center">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   {{($user->status) ? 'checked' : ''}}
                                                                   onclick="changeUserStatus(event.target, {{ $user->id }});" id="status{{$user->id}}">
                                                            <label class="custom-control-label pointer" for="status{{$user->id}}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                @canany(['user-edit','user-delete'])
                                                <td class="tr-body text-center">
                                                    @can('user-edit')
                                                    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#resetPassword" data-id="{{ encrypt($user->id) }}" title="{{__('Reset')}}">
                                                        <i class="fa fa-repeat text-info" aria-hidden="true"></i>
                                                    </button>
                                                    @endcan
                                                    @can('user-delete')
                                                    <a class="fa fa-pencil text-blue" href="{{route('users.show',encrypt($user->id))}}" data-toggle="tooltip" title="{{__('Edit')}}"></a>
                                                    <a href="#modal{{$user->id}}" data-toggle="modal" title="{{__('Delete')}}" class="btn btn-sm btn-icon">
                                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                    </a>
                                                    @endcan
                                                </td>
                                                @endcanany
                                            </tr>
                                            <!-- Modal Delete-->
                                            <div class="modal fade" id="modal{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{route('users.destroy',encrypt($user->id))}}" method="post">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{__('Delete')}} {{__('User')}}</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{__('Are you sure you want to delete this')}} {{__('User')}}?
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

<!-- Modal Reset Password-->
<div class="modal fade" id="resetPassword" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('users.reset-password') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordLabel">
                        <i class="fas fa-user-lock"></i> <span id="title"></span>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="col-12 form-group">
                            <label for="password" class="col-form-label">{{ __('New Password') }}</label> <span class="text-danger">*</span>
                            <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('New Password') }}" required>
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="confirm-password" class="col-form-label">{{ __('Confirm Password') }}</label> <span class="text-danger">*</span>
                            <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="{{ __('Confirm Password') }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-outline-save">{{__('Reset')}}</button>
                        <button type="button" class="btn btn-sm btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('admin.layouts.footer')
<script>
    @if(count($errors) >0)
        $('#resetPassword').modal('show');
    @endif
    $('#resetPassword').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var userId = button.data('id')
        var modal = $(this)

        modal.find('.modal-title #title').text("Reset User's Password!");
        modal.find('.modal-body #user_id').val(userId);
    });
    function changeUserStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;
        // let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: `users/change-status`,
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
