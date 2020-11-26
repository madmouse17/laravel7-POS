@extends('layouts.dashboard')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">View Profile</h4>
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
                <a href="#">View Profile</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="width: 14rem;">
                <img class="card-img-top" src="{{ asset('/storage/profile/'.Auth::user()->profile) }}" alt="Card image cap">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nama : {{ Auth::user()->name }}</li>
                    <li class="list-group-item">Email : {{ Auth::user()->email }}</li>
                    <li class="list-group-item">Created At : {{  date('d M Y', strtotime(Auth::user()->created_at))}}</li>
                    <li class="list-group-item">Updated At : {{  date('d M Y', strtotime(Auth::user()->updated_at))}}</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <form role="form" action="{{ url('/admin/profile/update') }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-4 d-flex justify-content-center">
                                <div class="avatar avatar-xxl">
                                    <img src="{{ asset('/storage/profile/'.Auth::user()->profile) }}" id="profile-img-tag" alt="profile" class="avatar-img rounded-circle">
                                    <div class="form-group form-group-default  {{ $errors->has('profile') ? ' has-error' : '' }}">
                                        <input type="file" id="profile-img" name="profile" class="form-control-file" placeholder="Fill Name">
                                        <input type="hidden" name="profile_name" value="value=" {{ Auth::user()->profile }}"">
                                        @if ($errors->has('profile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('profile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-12 mb-4 d-flex justify-content-center input-icon" {{ $errors->has('name') ? ' has-error' : '' }}>
                            <span class=" input-icon-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control input-solid" required="" name="name" placeholder="Username" value="{{ Auth::user()->name }}" autofocus>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            <div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('profile.store') }}" method="POST">
                        @csrf
                        <div class="form-group form-floating-label  {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control input-solid" required="" name="password">
                            <label for="password" class="placeholder">Password</label>
                            <input type="checkbox" id="show-password"> Show Password
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
                <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
{{-- show image --}}
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
$("#profile-img, #profile-imgg").change(function () {
    readURL(this);
});

// show password
$(document).ready(function () {
    $('#show-password').click(function () {
        if ($(this).is(':checked')) {
            $('#password').attr('type', 'text');
            $('#password-confirm').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
            $('#password-confirm').attr('type', 'password');
        }
    });
});
</script>
@endpush