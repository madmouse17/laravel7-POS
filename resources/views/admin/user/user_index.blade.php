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
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 mb-4 d-flex justify-content-center">
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
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <div class="form-group input-icon{{ $errors->has('username') ? ' has-error' : '' }} ">
                                            <span class=" input-icon-addon">
                                                <i class="fas fa-at"></i>
                                            </span>
                                            <input type="text" class="form-control input-solid" required="" name="username" placeholder="Username">

                                            @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <div class="form-group input-icon  {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <span class=" input-icon-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input id="email" type="email" class="form-control input-solid" required="" name="email" placeholder="Example@mail.com">
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group input-icon  {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <span class=" input-icon-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input id="name" type="name" class="form-control input-solid" required="" name="name" placeholder="Full Name">
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
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
                            <div class="card-action">
                                <button class="btn btn-success align-right">Save</button>
                            </div>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
    <div class="card">
        <div class="table-responsive">
            <table id="users-table" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>FullName</th>
                        <th>Profile</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    {{-- EDIT-MODAL --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="" method="POST" enctype="multipart/form-data" id="form-edit">
                        <input type="hidden" name="user_id" id="user_id">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="col-md-12 mb-2 d-flex justify-content-center">
                                <div class="avatar avatar-xxl">
                                    <img src="" id="profile-img-tagg" width="90px" height="90px" class="avatar-img rounded-circle" />
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="form-group {{ $errors->has('profile') ? ' has-error' : '' }}">
                                    <input type="file" class="form-control-file" id="profile-imgg" name="profile">
                                    <input type="hidden" name="profile_name">
                                    @if ($errors->has('profile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6" {{ $errors->has('username') ? ' has-error' : '' }}>
                                <label for="username1">Username</label>
                                <input type="text" class="form-control" id="username1" name="username" autofocus>
                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6" {{ $errors->has('email') ? ' has-error' : '' }}>
                                <label for="email1">E mail</label>
                                <input type="email" class="form-control" id="email1" name="email" value="">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" {{ $errors->has('name') ? ' has-error' : '' }}>
                            <label for="name1">Full Name</label>
                            <input type="text" class="form-control" id="name1" name="name">
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group" {{ $errors->has('password') ? ' has-error' : '' }}>
                            <label for="password1">Password</label>
                            <input type="password" class="form-control" id="password1" name="password" value="">
                            <input type="checkbox" id="show-password1"> Show Password
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password-confirm1">Re-type Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password-confirm1">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">
    // HAPUS
$(document).on('click', '#hapus', function () {
            var userID = $(this).data('id'); 
            csrf_token = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
            $.ajax({
                url: '/admin/user/'+userID,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                    $('#users-table').DataTable().ajax.reload();
                    swal({
                        type: 'success',
                        title: 'Success!',
                        text: 'Data has been deleted!'
                    });
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        }
        });
    });

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

$(document).ready(function () {
    var table = $("#users-table").DataTable({
        rowReorder: {
            selector: 'td:nth-child(0)'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("admin/json") }}'
        },
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'profile',
                name: 'profile',
                orderable: false,
                searchable: false,
                "render": function (data, type, full, meta) {
                    return "<div class=\"avatar avatar-xl\"><img src=\"../../../../storage/profile/" + data + "\" class=\"avatar-img rounded-circle\" /></div>";
                }
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],

        responsive: true
    });
});
$(document).on('click', '#edit', function () {
    var use_id = $(this).data('id');
    $.get('user/' + use_id + '/edit', function (data) {
        $('#editModal').modal('show');
        $('#user_id').val(data.id);
        $('#name1').val(data.name);
        $('#email1').val(data.email);
        $('#username1').val(data.username);
        $('#password1').val(data.password);
        $('#profile-img-tagg').attr("src", "/storage/profile/" + data.profile);
        $('#form-edit').attr("action", "/admin/user/update/" + data.id);
    })
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
// show password modal
$(document).ready(function () {
    $('#show-password1').click(function () {
        if ($(this).is(':checked')) {
            $('#password1').attr('type', 'text');
            $('#password-confirm1').attr('type', 'text');

        } else {
            $('#password1').attr('type', 'password');
            $('#password-confirm1').attr('type', 'password');
        }
    });
});

</script>
@endpush