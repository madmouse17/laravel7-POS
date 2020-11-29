@extends('layouts.dashboard')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Categories</h4>
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
                <a href="#">Manage Categories</a>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Add Categories
                </h4>
                <br>
                <div class="card-body">
                    <form role="form" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group form-floating-label  {{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="name" class="form-control input-solid" required="" name="name">
                            <label for="name" class="placeholder">Category Name</label>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success align-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="table-responsive">
                <table id="category-table" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Category Name</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="POST" enctype="multipart/form-data" id="form-edit">
                    <input type="hidden" name="category_id" id="category_id">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group form-floating-label  {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name1" type="name" class="form-control input-solid" required="" name="name">
                        <label for="name" class="placeholder">Category Name</label>
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
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
    // HAPUS
$(document).on('click', '#hapus', function () {
            var categoryID = $(this).data('id'); 
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
                url: '/admin/categories/'+categoryID,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                    $('#category-table').DataTable().ajax.reload();
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
// datatable
    $(document).ready(function () {
    var table = $("#category-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("admin/category_json") }}'
        },
        columns: [{
                data: 'name',
                name: 'name'
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
// edit modal
$(document).on('click', '#edit', function () {
    var cat_id = $(this).data('id');
    $.get('categories/' + cat_id + '/edit', function (data) {
        $('#editModal').modal('show');
        $('#category_id').val(data.id);
        $('#name1').val(data.name);
        $('#form-edit').attr("action", "/admin/categories/update/" + data.id);
    })
});
</script>
@endpush