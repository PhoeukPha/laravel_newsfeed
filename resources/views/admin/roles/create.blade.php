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
                        <li class="breadcrumb-item "><a href="{{route('roles.index')}}">{{__('Role')}}</a></li>
                        <li class="breadcrumb-item">{{__('Add')}} {{__('Role')}}</li>
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
                            <span class="text-uppercase text-blue-steel text-bold">{{__('Add')}} {{__('Role')}}</span>
                        </div>
                        <form action="{{route('roles.store')}}" method="post">
                            @csrf
                            <div class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 form-group">
                                            <label for="name">{{ __('Role Name') }}</label><span style="color: red;">*</span>
                                            <input type="text" id="name" class="form-control" name="name" autofocus value="{{ old('name') }}" required placeholder="{{ __('Role Name') }}">
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                        </div>
                                        <div class="col-sm-12 col-md-4 form-group">
                                            <label for="name">{{ __('Description') }}</label>
                                            <input type="text" id="name" class="form-control" name="description" autofocus placeholder="{{ __('Description') }}">
                                        </div>
                                        <div class="col-sm-12 col-md-4 form-group">
                                            <label for="name">{{ __('Permission') }}</label>
                                            <div class="clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="check_all">
                                                    <label for="check_all">
                                                        {{ __('Check / Uncheck All') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach( $permissions as $group => $items )
                                            <div class="col-md-12">
                                                <div class="card group-checkbox">
                                                    <div class="card-header">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="checkbox" class="check_group" id="{{ $group }}">
                                                            <label for="{{ $group }}">
                                                                {{ str_replace('-', ' ', Str::title($group)) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach( $items as $item )
                                                                <div class="col-sm-3 form-group">
                                                                    <div class="icheck-primary d-inline">
                                                                        <input name="permission[]" type="checkbox" id="{{ $item['name'] }}" value="{{ $item['id'] }}">
                                                                        <label for="{{ $item['name'] }}" class="form-check-label">
                                                                            {{ str_replace('-',' ', Str::title($item['name']))}}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <button class="btn btn-sm btn-outline-info">Save</button>
                                </div>
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
    $('#check_all').click(function () {
        $('input:checkbox').prop('checked', this.checked);
    });

    $('.check_group').click(function () {
        $(this).closest('.group-checkbox').find('input:checkbox').prop('checked', this.checked);
    });
</script>
