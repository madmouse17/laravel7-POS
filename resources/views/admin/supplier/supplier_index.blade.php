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
                <a href="#">Manage Supplier</a>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Add Supplier
                </h4>
                <br>
                <div class="card-body">
                    <form role="form" action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group form-floating-label  {{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control input-solid" required="" name="name">
                            <label for="name" class="placeholder">Supplier Name</label>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-floating-label  {{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <input id="alamat" type="alamat" class="form-control input-solid" required="" name="alamat">
                            <label for="alamat" class="placeholder">Address</label>
                            @if ($errors->has('alamat'))
                            <span class="help-block">
                                <strong>{{ $errors->first('alamat') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-floating-label  {{ $errors->has('telp') ? ' has-error' : '' }}">
                            <input id="telp" type="text" class="form-control input-solid" required="" name="telp">
                            <label for="telp" class="placeholder">Telp</label>
                            @if ($errors->has('telp'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telp') }}</strong>
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
                <table id="supplier-table" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Address</th>
                            <th>Telp</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="POST" enctype="multipart/form-data" id="form-edit">
                    <input type="hidden" name="supplier_id" id="supplier_id">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group form-floating-label  {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name1" type="text" class="form-control input-solid" required="" name="name">
                        <label for="name" class="placeholder">Supplier Name</label>
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group form-floating-label  {{ $errors->has('alamat') ? ' has-error' : '' }}">
                        <input id="alamat1" type="text" class="form-control input-solid" required="" name="alamat">
                        <label for="alamat1" class="placeholder">
                            Address
                        </label>
                        @if ($errors->has('alamat'))
                        <span class="help-block">
                            <strong>{{ $errors->first('alamat') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group form-floating-label  {{ $errors->has('telp') ? ' has-error' : '' }}">
                        <input id="telp1" type="number" class="form-control input-solid" required="" name="telp">
                        <label for="telp" class="placeholder">Telp</label>
                        @if ($errors->has('telp'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telp') }}</strong>
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
            var supplierID = $(this).data('id'); 
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
                url: '/admin/supplier/'+supplierID,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                    $('#supplier-table').DataTable().ajax.reload();
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
    var table = $("#supplier-table").DataTable({
        rowReorder: {
            selector: 'td:nth-child(0)'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("admin/supplier_json") }}'
        },
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'alamat',
                name: 'alamat',
                orderable: false,
                searchable: false
            },
            {
                data: 'telp',
                name: 'telp',
                orderable: false,
                searchable: false
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
    $.get('supplier/' + cat_id + '/edit', function (data) {
        $('#editModal').modal('show');
        $('#category_id').val(data.id);
        $('#name1').val(data.name);
        $('#alamat1').val(data.alamat);
        $('#telp1').val(data.telp);
        $('#form-edit').attr("action", "/admin/supplier/update/" + data.id);
    })
});
</script>
@endpush