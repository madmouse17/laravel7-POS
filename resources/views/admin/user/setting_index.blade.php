@extends('layouts.dashboard')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Setting</h4>
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
                <a href="#">Setting</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Icon
                    </h4>
                    <br>
                    <div class="card-body">
                        <form role="form" action="#" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 mb-4 d-flex">
                                        <div class="avatar avatar-xxl">
                                            <img src="#" id="profile-img-tag" alt="profile" class="avatar-img rounded-circle">
                                            <div class="form-group form-group-default  {{ $errors->has('profile') ? ' has-error' : '' }}">
                                                <input type="file" id="profile-img" name="profile" class="form-control-file" placeholder="Fill Name">
                                                @if ($errors->has('profile'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('profile') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p>*silahkan upload berformat <strong>.ICO</strong></p>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-primary align-right">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Logo
                    </div>
                    <br>
                    <div class="card-body">
                        <form role="form" action="#" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 mb-4 d-flex">
                                        <div class="avatar avatar-xxl">
                                            <img src="#" id="profile-img-tag" alt="profile" class="avatar-img rounded-circle">
                                            <div class="form-group form-group-default  {{ $errors->has('profile') ? ' has-error' : '' }}">
                                                <input type="file" id="profile-img" name="profile" class="form-control-file" placeholder="Fill Name">
                                                @if ($errors->has('profile'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('profile') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-primary align-right">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail
                    </div>
                    <div class="card-body">
                        <form role="form" action="#" method="POST">
                            {{ csrf_field() }}
                            <div class="container">
                                <div class="row">
                                    <div class="form-group form-floating-label  {{ $errors->has('perusahaan') ? ' has-error' : '' }}">
                                        <input id="perusahaan" type="text" class="form-control input-solid" required="" name="perusahaan">
                                        <label for="perusahaan" class="placeholder">Nama Perusahaan</label>
                                        @if ($errors->has('perusahaan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('perusahaan') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group form-floating-label  {{ $errors->has('tagline') ? ' has-error' : '' }}">
                                        <input id="tagline" type="text" class="form-control input-solid" required="" name="tagline">
                                        <label for="tagline" class="placeholder">Tagline</label>
                                        @if ($errors->has('tagline'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tagline') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-primary align-right">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection