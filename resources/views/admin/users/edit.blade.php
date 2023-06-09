@include('admin.layouts.header')
@include('admin.layouts.navigation')
@include('admin.layouts.sweetalert2')
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('Dashboard')}}</a></li>
                        <li class="breadcrumb-item "><a href="{{route('users.index')}}">{{__('User')}}</a></li>
                        <li class="breadcrumb-item ">{{__('Edit')}} {{__('User')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header width-icon">
                    <i class="mr-2 fa fa-gg" aria-hidden="true"></i>
                    <span class="text-uppercase text-blue-steel text-bold">{{__('Edit')}} {{__('User')}}</span>
                </div>
                <form method="post" action="{{route('users.update',encrypt($data->id))}}" enctype="multipart/form-data">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-row">
                                    <label class="control-label col-md-4">{{__('First Name')}}
                                        <span style="color: red;">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="first_name" placeholder="{{__('Input')}} {{__('First Name')}}" value="{{$data->first_name}}">
                                        @error('first_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div> <!-- First Name ^ -->
                                <div class="form-group form-row">
                                    <label class="control-label col-md-4">{{__('Last Name')}}
                                        <span style="color: red;">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="last_name" placeholder="{{__('Input')}} {{__('Last Name')}}" value="{{$data->last_name}}">
                                        @error('last_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div> <!-- Last Name ^ -->
                                <div class="form-group form-row">
                                    <label class="control-label col-md-4">{{__('E-mail')}}
                                        <span style="color: red;">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </span>
                                            </div>
                                            <input type="email" class="form-control" name="email" placeholder="{{__('Input')}} {{__('E-mail')}}" aria-describedby="basic-addon1" value="{{$data->email}}">
                                        </div>
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div> <!-- Email ^ -->
                                <div class="form-group form-row">
                                    <label class="control-label col-md-4">{{__('Phone Number')}}
                                        <span style="color: red;">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_number" placeholder="{{__('Input')}} {{__('Phone Number')}}" aria-describedby="basic-addon1" value="{{$data->phone_number}}">
                                        </div>
                                        @error('phone_number')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div> <!-- Phone Number ^ -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-row">
                                    <label class="control-label col-md-4">{{__('Gender')}}
                                        <span style="color: red;">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <select name="gender" id="gender" class="form-control select2">
                                            <option>{{__('Select')}} {{__('Gender')}}</option>
                                            <option value="male" @if($data->gender == 'male') selected @endif>{{__('male')}}</option>
                                            <option value="female" @if($data->gender == 'female') selected @endif>{{__('female')}}</option>
                                        </select>
                                        @error('gender')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div> <!-- Gender ^ -->
                                <div class="form-group form-row">
                                    <label class="control-label col-md-4">{{__('Username')}}
                                        <span style="color: red;">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="username" placeholder="{{__('Input')}} {{__('Username')}}" value="{{$data->username}}">
                                        @error('username')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div> <!-- Username ^ -->
                                <div class="form-group form-row">
                                    <label class="control-label col-md-4">{{__('Role')}}
                                        <span style="color: red;">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <select name="role_id" id="role_id" class="form-control select2">
                                            <option>{{__('Select')}} {{__('Role')}}</option>
                                            @foreach(DB::table("roles")->get() as $r)
                                                <option value="{{$r->id}}" {{ $data->roles->contains($r->id) ? 'selected' : '' }}>{{$r->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div> <!-- Role ^ -->
                                <div class="form-group form-row">
                                    <label class="control-label col-md-4">{{__('Address')}}</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-address-book" aria-hidden="true"></i>
                                        </span>
                                            </div>
                                            <input type="text" class="form-control" name="address" placeholder="{{__('Input')}} {{__('Address')}}" aria-describedby="basic-addon1" value="{{$data->address}}">
                                        </div>
                                        @error('address')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div> <!-- Address ^ -->
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-outline-info">{{__('Update')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.layouts.footer')
