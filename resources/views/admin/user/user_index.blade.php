@extends('layouts.dashboard')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">User</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('admin/beranda') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Management Data</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Manage User</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Add User
                    </h4>
                    <br>
                    <div class="card-body">
                        <form role="form" action="{{ url('/admin/user/') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-12 mb-2 d-flex justify-content-center">
                                    <div class="avatar avatar-xxl">
                                        <img src="#" id="profile-img-tag" alt="profile" class="avatar-img rounded-circle">

                                    </div>
                                </div>
                                <div class="col-md-12 mb-2 d-flex justify-content-center">
                                    <div class="form-group form-group-default  {{ $errors->has('profile') ? ' has-error' : '' }}">
                                        <input type="file" id="profile-img" name="profile" class="form-control" placeholder="Fill Name">
                                        @if ($errors->has('profile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('profile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group form-floating-label {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input id="inputFloatingLabel2" type="text" class="form-control input-solid" required="" name="name">
                                    <label for="inputFloatingLabel2" class="placeholder">Username</label>
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group form-floating-label  {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="email" class="form-control input-solid" required="" name="email">
                                    <label for="email" class="placeholder">Email</label>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group form-floating-label  {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" class="form-control input-solid" required="" name="password">
                                    <label for="password" class="placeholder">Password</label>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="password-confirm" type="password" class="form-control input-solid" required="" name="password_confirmation">
                                    <label for="password-confirm" class="placeholder">Retype-Password</label>
                                </div>
                            </div>
                    </div>
                </div>
                <button class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @push('scripts')
    <script type="text/javascript">
        function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#profile-img-tag,#profile-img-tagg').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    }
    }
    $("#profile-img, #profile-imgg").change(function(){
    readURL(this);
    });
    </script>
    @endpush