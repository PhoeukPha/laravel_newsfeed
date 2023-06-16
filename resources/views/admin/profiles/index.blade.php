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
                        <li class="breadcrumb-item ">{{__('Profile')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline ">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if(!auth()->user()->avatar)
                                    <img src="{{asset('admin/dist/img/users/default.png')}}"
                                         class="profile-user-img img-fluid img-circle" alt="User Image">
                                @else
                                    <img src="{{asset('admin/dist/img/users')}}/{{auth()->user()->avatar}}"
                                         class="profile-user-img img-fluid img-circle" alt="User Image">
                                @endif
                            </div>
                            <h3 class="profile-username text-center">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h3>
                            <p class="text-muted text-center text-uppercase">{{auth()->user()->email}}</p>
                            <ul class="list-group list-group-unbordered" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <li class="list-group-item text-uppercase">
                                    <a href="#v-pills-info"  data-toggle="pill" role="presentation" class="nav-link active" >
                                        <i class="mr-2 fa fa-cog" aria-hidden="true"></i>
                                        {{__('Personal Info')}}
                                    </a>
                                </li>
                                <li class="list-group-item text-uppercase">
                                    <a href="#v-pills-avatar" data-toggle="pill" role="presentation" class="nav-link">
                                        <i class="mr-2 fa fa-user" aria-hidden="true"></i>
                                        {{__('Change avatar')}}
                                    </a>
                                </li>
                                <li class="list-group-item text-uppercase">
                                    <a href="#v-pills-pass"  data-toggle="pill" role="presentation" class="nav-link">
                                        <i class="mr-2 fa fa-unlock-alt" aria-hidden="true"></i>
                                        {{__('Change Password')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel" aria-labelledby="v-pills-info-tab">
                            <div class="card card-primary card-outline ">
                                <div class="card-header text-uppercase font-weight-bold">
                                    {{__('Personal Info')}}
                                </div>
                                <form method="post" action="{{route('profiles.update',auth()->user()->id)}}">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class="card-body">
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('First Name')}}
                                                <span style="color: red;">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="first_name"
                                                       placeholder="{{__('Input')}} {{__('First Name')}}" value="{{auth()->user()->first_name}}">
                                                @error('first_name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- First Name ^ -->
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('Last Name')}}
                                                <span style="color: red;">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="last_name"
                                                       placeholder="{{__('Input')}} {{__('Last Name')}}" value="{{auth()->user()->last_name}}">
                                                @error('last_name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- Last Name ^ -->
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('E-mail')}}
                                                <span style="color: red;">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" placeholder="{{__('Input')}} {{__('E-mail')}}" aria-describedby="basic-addon1"
                                                           value="{{auth()->user()->email}}">
                                                </div>
                                                @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- Email ^ -->
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('Phone Number')}}
                                                <span style="color: red;">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="phone_number" placeholder="{{__('Input')}} {{__('Phone Number')}}" aria-describedby="basic-addon1"
                                                           value="{{auth()->user()->phone_number}}">
                                                </div>
                                                @error('phone_number')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- Phone Number ^ -->
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('Gender')}}
                                                <span style="color: red;">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <select name="gender" class="form-control">
                                                    <option>{{__('Select')}} {{__('Gender')}}</option>
                                                    <option value="male"
                                                            @if(auth()->user()->gender=='male') selected @endif>{{__('male')}}
                                                    </option>
                                                    <option value="female"
                                                            @if(auth()->user()->gender=='female') selected @endif>{{__('female')}}
                                                    </option>
                                                </select>
                                                @error('gender')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- Gender ^ -->
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('Username')}}
                                                <span style="color: red;">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="username"
                                                       placeholder="{{__('Input')}} {{__('Username')}}" value="{{auth()->user()->username}}">
                                                @error('username')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- Username ^ -->
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('Address')}}</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-address-book" aria-hidden="true"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="address" placeholder="{{__('Input')}} {{__('Address')}}" aria-describedby="basic-addon1"
                                                           value="{{auth()->user()->address}}">
                                                </div>
                                                @error('address')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- Address ^ -->
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-outline-info">{{__('Update')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-avatar" role="tabpanel" aria-labelledby="v-pills-avatar-tab">
                            <div class="card card-primary card-outline ">
                                <div class="card-header text-uppercase font-weight-bold">
                                    {{__('Change avatar')}}
                                </div>
                                <form method="post" action="{{route('profiles.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    {{--                                    {{ method_field('PUT') }}--}}
                                    <div class="card-body">
                                        <div class="form-input">
                                            <div class="preview">
                                                @if(auth()->user()->avatar)
                                                    <img id="preview" src="{{asset('admin/dist/img/users')}}/{{auth()->user()->avatar}}">
                                                @else
                                                    <img id="preview" src="{{asset('admin/dist/img/users/default.png')}}">
                                                @endif
                                            </div>
                                            <label for="images">{{__('Select')}} {{__('Image')}}</label>
                                            {{--                                            <input type="text" class="form-control" name="first_name" value="{{auth()->user()->first_name}}" hidden>--}}
                                            <input type="file" id="images" name="image" accept="image/,.png,.jpg,.jpng,.gif" onchange="showPreview(event);">
                                        </div>
                                        @error('image')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-outline-info">{{__('Update')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-pass" role="tabpanel" aria-labelledby="v-pills-pass-tab">
                            <div class="card card-primary card-outline ">
                                <div class="card-header text-uppercase font-weight-bold">
                                    {{__('Change Password')}}
                                </div>
                                <form method="post" action="{{url('admin/profiles/password')}}">
                                    @csrf
                                    {{ method_field('POST') }}
                                    <div class="card-body">
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('Current Password')}}
                                                <span style="color: red;">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" name="current_password" placeholder="{{__('Input')}} {{__('Current Password')}}">
                                                @error('current_password')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- Password ^ -->
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('New Password')}}
                                                <span style="color: red;">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" name="new_password" placeholder="{{__('Input')}} {{__('New Password')}}">
                                                @error('new_password')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- Password ^ -->
                                        <div class="form-group form-row">
                                            <label class="control-label col-md-3">{{__('Confirm Password')}}
                                                <span style="color: red;">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" name="confirm_pass" placeholder="{{__('Confirm Password')}}">
                                                @error('confirm_pass')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- Confirm Password ^ -->
                                        <div class="text-right">
                                            <button type="submit" name="form_pass" class="btn btn-outline-info">{{__('Update')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.layouts.footer')
