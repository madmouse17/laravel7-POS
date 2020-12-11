@extends('layouts.dashboard')

@section('content')
<div class="container">
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
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Add {{ $data }}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('add.product')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group {{ $errors->has('invoice_id') ? ' has-error' : '' }}">
                                <label for="invoice"># Invoice</label>
                                <input id="invoice" type="text" class="form-control input-solid" name="invoice"
                                    placeholder="Invoice number..." autofocus required>
                                @if ($errors->has('invoice_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('invoice_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('cashier_id') ? ' has-error' : '' }}">
                                <label for="cashier_id">Cashier</label>
                                <input id="cashier_id" type="text" class="form-control input-solid" name="cashier_id"
                                    value="{{ Auth::user()->username }}" readonly required>
                                @if ($errors->has('user_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="barcode">Barcode</label>
                                <div class="input-icon">
                                    <input type="text" id="barcode" class="form-control" placeholder="Barcode..."
                                        name="barcode">
                                    <span class="input-icon-addon">
                                        <button class="btn btn-primary btn-round btn-xs" data-toggle="modal"
                                            data-target="#modal-item">
                                            <span class="btn-label">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group  {{ $errors->has('qty') ? ' has-error' : '' }}">
                                <label for="qty" class="placeholder">Qty</label>
                                <input id="qty" type="number" class="form-control input-solid" name="qty"
                                    placeholder="0.00" required>
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
                                <button class="btn btn-primary btn-round align-right"><span class="btn-label"><i
                                            class="fas fa-shopping-cart "></i></span>Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="row">
                <div class="card" style="width: 90%;">
                    <div class="table-responsive">
                        <table id="transaksi-table" class="table table-striped table-hover">
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
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>
                                        <button type="button" class="btn btn-danger align-right btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card" style="width: 100%;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('invoice') ? ' has-error' : '' }}">
                                    <label for="invoice">Subtotal</label>
                                    <input id="invoice" type="number" class="form-control input-solid" required=""
                                        name="invoice" readonly>
                                    @if ($errors->has('invoice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invoice') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('discount') ? ' has-error' : '' }}">
                                    <label for="discount">Discount</label>
                                    <input id="discount" type="string" class="form-control input-solid" name="discount"
                                        value="200">
                                    @if ($errors->has('discount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('discount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('invoice') ? ' has-error' : '' }}">
                                    <label for="invoice">Grand Total</label>
                                    <input id="invoice" type="number" class="form-control input-solid" required=""
                                        name="grand_total">
                                    @if ($errors->has('invoice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invoice') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('invoice') ? ' has-error' : '' }}">
                                    <label for="invoice">Cash</label>
                                    <input id="invoice" type="number" class="form-control input-solid" required=""
                                        name="invoice">
                                    @if ($errors->has('invoice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invoice') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('invoice') ? ' has-error' : '' }}">
                                    <label for="invoice">Remain</label>
                                    <input id="invoice" type="number" class="form-control input-solid" required=""
                                        name="invoice">
                                    @if ($errors->has('invoice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invoice') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-action">
                        <button class="btn btn-warning btn-round align-right shadow">
                            <span class="btn-label">
                                <i class="fas fa-paper-plane"></i>
                                Pay
                            </span>
                        </button>
                    </div>
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
