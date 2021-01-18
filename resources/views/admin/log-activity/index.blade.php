@extends('layouts.dashboard')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Log Activities</h4>
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
                <a href="#">Log-Activity</a>
            </li>
        </ul>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="table-responsive">
            <table id="log-table" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Log Name</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Propeties</th>
                        <th>Date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
    var table = $("#log-table").DataTable({
        rowReorder: {
            selector: 'td:nth-child(0)'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("admin/log_json") }}'
        },
        columns: [
            {
                data: 'log_name',
                name: 'activity_log.log_name'
            },
            {
                data: 'username',
                name: 'users.username'
            },
            {
                data: 'description',
                name: 'activity_log.description'
            },
            {
                data: 'properties.attributes.name',
                name: 'activity_log.properties'
            },
            {
                data: 'updated_at',
                name: 'activity_log.updated_at'
            },
        ],

        responsive: true
    });
});
</script>

@endpush