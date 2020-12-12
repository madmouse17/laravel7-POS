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
        <form id="form-submit" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Add {{ $data }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="invoice"># Invoice</label>
                                    <input id="invoice" type="text" class="form-control" name="invoice"
                                        placeholder="Invoice number..." data-bind="textInput: invoice_id" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="cashier_id">Cashier</label>
                                    <input id="cashier_id" type="text" class="form-control" name="cashier_id"
                                        value="{{ Auth::user()->username }}" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="product_select">Product</label>
                                    <div class="select2-input">
                                        <select name="product_select" id="product_select" class="form-control">
                                            <option value="">-- Select Product --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
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
                                    <tbody data-bind="foreach: products">
                                        <tr>
                                            <td><span data-bind="text: $index() + 1"></span></td>
                                            <td>
                                                <span data-bind="text: product"></span>
                                            </td>
                                            <td>
                                                <span data-bind="text: price"></span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" data-bind="textInput: qty" style="height: unset !important;">
                                            </td>
                                            <td>
                                                <span data-bind="text: total"></span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger align-right btn-sm" data-bind="click: $root.removeProduct">
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
                            <div class="card px-3 py-3" style="width: 100%;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label for="invoice">Subtotal</label>
                                            </div>
                                            <div class="d-flex">
                                                <span data-bind="text: subtotal"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount">Discount</label>
                                            <input id="discount" type="string" class="form-control" name="discount" placeholder="Discount..." data-bind="textInput: discount">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label for="invoice">Grand Total</label>
                                            </div>
                                            <div class="d-flex">
                                                <span data-bind="text: grandtotal"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment">Cash</label>
                                            <input id="payment" type="text" class="form-control" name="payment" placeholder="Cash..." data-bind="textInput: payment" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label for="invoice">Remain</label>
                                            </div>
                                            <div class="d-flex">
                                                <span data-bind="text: change"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-action">
                                <button type="submit" class="btn btn-warning btn-round align-right shadow">
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
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/plugin/knockout-3.5.1/knockout-3.5.1.js') }}"></script>
    <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        var submitUrl = "{{ route('my-transaksi.submit') }}";
        var searchProductRoute = "{{ route('product.search') }}";
    </script>
    <script src="{{ asset('js/admin/my-transaksi/knockout.js') }}"></script>
    <script src="{{ asset('js/admin/my-transaksi/select2.js') }}"></script>
    <script src="{{ asset('js/admin/my-transaksi/validation.js') }}"></script>
@endpush
