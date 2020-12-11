@extends('layouts.dashboard')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">{{ $data }}</h4>
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
                <a href="#">Management {{ $data }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ $data }}</a>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Add {{ $data }}
                </h4>
                <br>
                <form action="{{route('add.product')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group form-group-default  {{ $errors->has('invoice') ? ' has-error' : '' }}">
                            <label for="invoice">Invoice</label>
                            <input id="invoice" type="text" class="form-control input-solid" required="" name="invoice" value="12345" readonly>
                            @if ($errors->has('invoice'))
                            <span class="help-block">
                                <strong>{{ $errors->first('invoice') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-group-default   {{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label for="user_id">Cashier</label>
                            <input id="user_id" type="text" class="form-control input-solid" required="" name="user_id" value="{{ Auth::user()->username }}" readonly>
                            @if ($errors->has('user_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('barcode') ? ' has-error' : '' }}">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="barcode" name="barcode">
                                <span class="input-icon-addon">
                                    <button class="btn btn-primary btn-round btn-xs" data-toggle="modal" data-target="#modal-item"><span class="btn-label"><i class="fa fa-search"></i></span></button>
                                </span>
                            </div>
                            @if ($errors->has('barcode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('barcode') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-floating-label  {{ $errors->has('qty') ? ' has-error' : '' }}">
                            <input id="qty" type="number" class="form-control input-solid" required="" name="qty">
                            <label for="qty" class="placeholder">qty</label>
                            @if ($errors->has('qty'))
                            <span class="help-block">
                                <strong>{{ $errors->first('qty') }}</strong>
                            </span>
                            @endif
                        </div>
                        <input type="hidden" id="product_id" name="product_id">
                        <input id="barcode" name="barcode">
                        <input id="name" name="name">
                        <input id="sell" name="sell">
                        <input id="buy" name="buy">
                        <input id="stock" name="stock">
                        <div class="card-action">
                            <button class="btn btn-primary btn-round align-right"><span class="btn-label"><i class="fas fa-shopping-cart "></i></span>Add</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8 row">
    <div class="card">
        <div class="table-responsive">
            <table id="transaksi-table" class="display table table-striped table-hover">
                <thead>

                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cart_data as $index=>$item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item['name']}} </td>
                        <td>{{ $item['pricesingle']}} </td>
                        <td>{{ $item['qty']}} </td>
                        <td>{{ $item['price']}} </td>
                        <td>
                            <form action="{{route('remove.product',$item['rowId'])}}" method="POST">
                                @csrf
                                <button type="button" class="btn btn-danger align-right btn-sm" onclick="this.closest('form').submit();return false;"><i class="fas fa-trash"></i></button>

                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Empty Cart</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="form-group form-group-default  {{ $errors->has('invoice') ? ' has-error' : '' }}">
                <label for="invoice">Subtotal</label>
                <input id="invoice" type="number" class="form-control input-solid" required="" name="invoice" value="{{ $data_total['sub_total']}}" readonly>
                @if ($errors->has('invoice'))
                <span class="help-block">
                    <strong>{{ $errors->first('invoice') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group form-group-default  {{ $errors->has('discount') ? ' has-error' : '' }}">
                <label for="discount">Discount</label>
                <input id="discount" type="string" class="form-control input-solid" name="discount" value="200">
                @if ($errors->has('discount'))
                <span class="help-block">
                    <strong>{{ $errors->first('discount') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group form-group-default  {{ $errors->has('invoice') ? ' has-error' : '' }}">
                <label for="invoice">Grand Total</label>
                <input id="invoice" type="number" class="form-control input-solid" required="" name="grand_total" value="{{ $data_total['total']}}">
                @if ($errors->has('invoice'))
                <span class="help-block">
                    <strong>{{ $errors->first('invoice') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="form-group form-group-default  {{ $errors->has('invoice') ? ' has-error' : '' }}">
                <label for="invoice">Cash</label>
                <input id="invoice" type="number" class="form-control input-solid" required="" name="invoice">
                @if ($errors->has('invoice'))
                <span class="help-block">
                    <strong>{{ $errors->first('invoice') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group form-group-default  {{ $errors->has('invoice') ? ' has-error' : '' }}">
                <label for="invoice">Remain</label>
                <input id="invoice" type="number" class="form-control input-solid" required="" name="invoice">
                @if ($errors->has('invoice'))
                <span class="help-block">
                    <strong>{{ $errors->first('invoice') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="card-action">
        <button class="btn btn-warning btn-round align-right"><span class="btn-label"><i class="fas fa-paper-plane"></i></span>Pay</button>
    </div>
</div>
</div>
{{-- barcode modal --}}
<div class="modal fade" id="modal-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="product-table" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Product Name</th>
                                <th>Sell</th>
                                <th>Buy</th>
                                <th>Stocks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
    var table = $("#product-table").DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("admin/lihatproduct_json") }}'
        },
        columns: [{
                data: 'barcode',
                name: 'barcode'
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'sell',
                name: 'sell',
                orderable: false,
                searchable: false
            },
            {
                data: 'buy',
                name: 'buy',
                orderable: false,
                searchable: false
            },
            {
                data: 'stock',
                name: 'stock',
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
$(document).on('click', '#select', function () {
    var product_id = $(this).data('id');
    var barcode = $(this).data('barcode');
    var name = $(this).data('name');
    var sell = $(this).data('sell');
    var buy = $(this).data('buy');
    var stock = $(this).data('stock');
    $('#product_id').val(product_id);
    $('#barcode').val(barcode);
    $('#name').val(name);
    $('#sell').val(sell);
    $('#buy').val(buy);
    $('#stock').val(stock);
    $('#modal-item').modal('hide');
});
// $(document).on('click', '#select', function () {
//     var cat_id = $(this).data('id');
//     $.post('admin/transaksi/addProduct/' + cat_id + )
// });
</script>
@endpush