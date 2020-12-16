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
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ $data }}
                    </h4>
                </div>
                <div class="card-body">

                    <form role="form" action="{{ route('my-transaksi.download') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group  {{ $errors->has('start') ? ' has-error' : '' }}">
                            <label for="start">Start</label>
                            <input id="start" type="date" class="form-control input-solid datepicker" required="" name="start">
                            @if ($errors->has('start'))
                            <span class="help-block">
                                <strong>{{ $errors->first('start') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('end') ? ' has-error' : '' }}">
                            <label for="end">End</label>
                            <input id="end" type="date" class="form-control input-solid datepicker" required="" name="end">
                            @if ($errors->has('end'))
                            <span class="help-block">
                                <strong>{{ $errors->first('end') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-primary btn-round align-right shadow" formtarget="_blank">
                                <span class="btn-label">
                                    <i class="fa fa-book"> Download</i>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script type="text/javascript">
    $('.datepicker').datepicker({
    format: 'yyyy/mm/dd'
 });
</script>
{{-- @push('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

@endpush --}}