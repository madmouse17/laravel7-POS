@extends('layouts.dashboard')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Role & Permissions</h4>
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
                <a href="#">Management Role</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Manage Role</a>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Add Role & Permissions
                </h4>
                <br>
                <div class="card-body">
                    <form role="form" action="{{ route('role.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group form-floating-label  {{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control input-solid" required="" name="name">
                            <label for="name" class="placeholder">Name</label>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-check">
                            <label for="">Permission :</label>
                            @foreach($permission as $value)
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $value->id }} ">
                                <span class="form-check-sign"> {{ $value->name }}</span>
                            </label>
                            @endforeach
                        </div>
                        {{-- <strong>Permission:</strong>
                        <br />
                        @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                        <br />
                        @endforeach --}}
                        @can('role-create')
                        <div class="card-action">
                            <button class="btn btn-success align-right">Save</button>
                        </div>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="table-responsive">
                <table id="role-table" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- EDIT-MODAL --}}

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Role & Permissions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="POST" enctype="multipart/form-data" id="form-edit">
                    <input type="hidden" name="role_id" id="role_id">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group form-floating-label  {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name1" type="text" class="form-control input-solid" required="" name="name">
                        <label for="name" class="placeholder">Name</label>
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-check">
                        <label for="">Permission :</label><br>
                        @foreach($permission as $value)
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $value->id }}" {{-- @if($role->permission)
                            @if(in_array($value->id, $role->permission->pluck('id')->toArray() ))
                            checked
                            @endif
                            @endif --}}>
                            <span class="form-check-sign"> {{ $value->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success center">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
    // datatable
$(document).ready(function () {
    var table = $("#role-table").DataTable({
        rowReorder: {
            selector: 'td:nth-child(0)'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("admin/role_json") }}'
        },
        columns: [
            {
                data: 'name',
                name: 'name',
                orderable: false,
                searchable: false
            },
   
            {
                data: 'created_at',
                name: 'created_at',
            },
            {
                data: 'updated_at',
                name: 'updated_at',
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

  // HAPUS
  $(document).on('click', '#hapus', function () {
            var roleID = $(this).data('id'); 
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
                url: '/admin/role/'+roleID,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                    $('#role-table').DataTable().ajax.reload();
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
// edit modal
$(document).on('click', '#edit', function () {
    var role_id = $(this).data('id');
    $.get('role/' + role_id + '/edit', function (data) {
        $('#editModal').modal('show');
        $('#role_id').val(data.id);
        $('#name1').val(data.name);
        // $('#permission1').val(data.permission_id);
        $('#form-edit').attr("action", "/admin/role/update/" + data.id);
    })

});
</script>
@endpush