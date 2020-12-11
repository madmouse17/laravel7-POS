@extends('layouts.dashboard')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Products</h4>
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
                <a href="#">Manage Products</a>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Add Products
                </h4>
                <br>
                <div class="card-body">
                    <form role="form" action="{{ route('product.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group form-floating-label  {{ $errors->has('barcode') ? ' has-error' : '' }}">
                            <input id="barcode" type="number" class="form-control input-solid" required="" name="barcode">
                            <label for="barcode" class="placeholder">Barcode</label>
                            @if ($errors->has('barcode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('barcode') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-floating-label  {{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control input-solid" required="" name="name">
                            <label for="name" class="placeholder">Products Name</label>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-floating-label {{ $errors->has('category_id') ? ' has-error' : '' }}" ">
                            <select class=" form-control input-solid id="selectFloatingLabel2" required="" name="category_id">
                            <option value=''>&nbsp;</option>
                            @foreach($category as $ct)
                            <option value="{{$ct->id}}">{{$ct->name}}</option>
                            @endforeach
                            </select>
                            <label for="selectFloatingLabel2" class="placeholder">Categories</label>
                            @if ($errors->has('category_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-floating-label  {{ $errors->has('buy') ? ' has-error' : '' }}">
                            <input id="buy" type="number" class="form-control input-solid" required="" name="buy">
                            <label for="buy" class="placeholder">Buy</label>
                            @if ($errors->has('buy'))
                            <span class="help-block">
                                <strong>{{ $errors->first('buy') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-floating-label  {{ $errors->has('sell') ? ' has-error' : '' }}">
                            <input id="sell" type="number" class="form-control input-solid" required="" name="sell">
                            <label for="sell" class="placeholder">Sell</label>
                            @if ($errors->has('sell'))
                            <span class="help-block">
                                <strong>{{ $errors->first('sell') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-floating-label  {{ $errors->has('stock') ? ' has-error' : '' }}">
                            <input id="stock" type="number" class="form-control input-solid" required="" name="stock">
                            <label for="stock" class="placeholder">Stock</label>
                            @if ($errors->has('stock'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stock') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-floating-label  {{ $errors->has('supplier_id') ? ' has-error' : '' }}"">
                            <select class=" form-control input-solid id="selectFloatingLabel2" required="" name="supplier_id">
                            <option value=''>&nbsp;</option>
                            @foreach($supplier as $sp)
                            <option value="{{$sp->id}}">{{$sp->name}}</option>
                            @endforeach
                            </select>
                            <label for="selectFloatingLabel2" class="placeholder">Supplier</label>
                            @if ($errors->has('supplier_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('supplier_id') }}</strong>
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
                <table id="product-table" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Buy</th>
                            <th>Sell</th>
                            <th>Stock</th>
                            <th>Supplier</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="POST" enctype="multipart/form-data" id="form-edit">
                    <input type="hidden" name="product_id" id="product_id">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group form-floating-label  {{ $errors->has('barcode') ? ' has-error' : '' }}">
                        <input id="barcode1" type="number" class="form-control input-solid" required="" name="barcode">
                        <label for="barcode" class="placeholder">barcode</label>
                        @if ($errors->has('barcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('barcode') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group form-floating-label  {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name1" type="text" class="form-control input-solid" required="" name="name">
                        <label for="name" class="placeholder">Product Name</label>
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group form-floating-label {{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <select class=" form-control input-solid id=" selectFloatingLabel2" required="" name="category_id" id="category_id1">
                            @foreach($category as $ct)
                            <option value="{{$ct->id}}">{{$ct->name}} </option>@endforeach
                        </select>
                        <label for="selectFloatingLabel2" class="placeholder">Categories</label>
                        @if ($errors->has('category_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class=" form-group form-floating-label {{ $errors->has('buy') ? ' has-error' : '' }}">
                        <input id="buy1" type="number" class="form-control input-solid" required="" name="buy">
                        <label for="buy" class="placeholder">buy</label>
                        @if ($errors->has('buy'))
                        <span class="help-block">
                            <strong>{{ $errors->first('buy') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group form-floating-label  {{ $errors->has('sell') ? ' has-error' : '' }}">
                        <input id="sell1" type="number" class="form-control input-solid" required="" name="sell">
                        <label for="sell" class="placeholder">sell</label>
                        @if ($errors->has('sell'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sell') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group form-floating-label  {{ $errors->has('stock') ? ' has-error' : '' }}">
                        <input id="stock1" type="number" class="form-control input-solid" required="" name="stock">
                        <label for="stock" class="placeholder">stock</label>
                        @if ($errors->has('stock'))
                        <span class="help-block">
                            <strong>{{ $errors->first('stock') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group form-floating-label {{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                        <select class=" form-control input-solid id=" selectFloatingLabel2" required="" name="supplier_id" id="supplier_id1">
                            @foreach($supplier as $sp)
                            <option value="{{$sp->id}}">{{$sp->name}} </option>@endforeach
                        </select>
                        <label for="selectFloatingLabel2" class="placeholder">Supplier</label>
                        @if ($errors->has('supplier_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('supplier_id') }}</strong>
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
    // datatable
$(document).ready(function () {
    var table = $("#product-table").DataTable({
        rowReorder: {
            selector: 'td:nth-child(0)'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("admin/product_json") }}'
        },
        columns: [
            {
                data: 'barcode',
                name: 'products.barcode',
                orderable: false,
                searchable: false
            },{
                data: 'name',
                name: 'products.name'
            },
            {
                data: 'category.name',
                name: 'category.name',
            },
            {
                data: 'buy',
                name: 'products.buy',
            },
            {
                data: 'sell',
                name: 'products.sell',
            },
            {
                data: 'stock',
                name: 'products.stock',
            },
            {
                data: 'supplier.name',
                name: 'supplier.name',
            },
            {
                data: 'created_at',
                name: 'products.created_at',
            },
            {
                data: 'updated_at',
                name: 'products.updated_at',
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
            var productID = $(this).data('id'); 
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
                url: '/admin/product/'+productID,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                    $('#product-table').DataTable().ajax.reload();
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
    var pro_id = $(this).data('id');
    $.get('product/' + pro_id + '/edit', function (data) {
        $('#editModal').modal('show');
        $('#product_id').val(data.id);
        $('#barcode1').val(data.barcode);
        $('#name1').val(data.name);
        $('#category_id1').val(data.category_id);
        $('#buy1').val(data.buy);
        $('#sell1').val(data.sell);
        $('#stock1').val(data.stock);
        $('#supplier_id1').val(data.supplier_id);
        $('#form-edit').attr("action", "/admin/product/update/" + data.id);
    })

});
</script>
@endpush