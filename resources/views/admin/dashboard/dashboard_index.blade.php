@extends('layouts.dashboard')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                <h5 class="text-white op-7 mb-2">Free Bootstrap 4 Admin Dashboard</h5>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">Overall statistics</div>
                    <div class="card-category">Daily information about statistics in system</div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-1" data-user="{{ $user }}"></div>
                            <h6 class="fw-bold mt-3 mb-0">Users</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-2"></div>
                            <h6 class="fw-bold mt-3 mb-0">Product</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-3"></div>
                            <h6 class="fw-bold mt-3 mb-0">Transaksi</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">Total income & spend statistics</div>
                    <div class="row py-3">
                        <div class="col-md-4 d-flex flex-column justify-content-around">
                            <div>
                                <h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
                                <h3 class="fw-bold">{{ $total_income }}</h3>
                            </div>
                            <div>
                                <h6 class="fw-bold text-uppercase text-danger op-8">Total Spend</h6>
                                <h3 class="fw-bold">{{ $total_spend }}</h3>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="chart-container">
                                {{-- <canvas ></canvas> --}}
                                {!! $chart->container() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Transaksi Statistics</div>
                        <div class="card-tools">
                            <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                <span class="btn-label">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                Export
                            </a>
                            <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span>
                                Print
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        {{-- <canvas id="statisticsChart"></canvas> --}}
                        {!! $chart_month->container() !!}
                    </div>
                    <div id="myChartLegend"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-title">Feed Activity</div>
                </div>

                <div class="card-body">
                    <ol class="activity-feed">
                        @foreach($activity as $act)
                        <li class="feed-item feed-item-secondary">
                            <time class="date" datetime="9-25">{{Carbon\Carbon::parse($act['updated_at']) ->format('d M Y')}}</time>
                            <span class="text">{{ $act['description']}} <strong> {{ $act['properties']['attributes']['name'] }}</strong>
                                <a href="#">by "{{ $act['username']}}"</a></span>
                        </li>
                        @endforeach
                        {{-- <li class="feed-item feed-item-success">
                            <time class="date" datetime="9-24">Sep 24</time>
                            <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                        </li>
                        <li class="feed-item feed-item-info">
                            <time class="date" datetime="9-23">Sep 23</time>
                            <span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
                        </li>
                        <li class="feed-item feed-item-warning">
                            <time class="date" datetime="9-21">Sep 21</time>
                            <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                        </li>
                        <li class="feed-item feed-item-danger">
                            <time class="date" datetime="9-18">Sep 18</time>
                            <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                        </li> --}}
                    </ol>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    Circles.create({
        id:'circles-1',
        radius:45,
        value: {{ $user }},
        maxValue:1000,
        width:7,
        text: {{ $user }},
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })
    Circles.create({
			id:'circles-2',
			radius:45,
			value:{{ $product }},
			maxValue:1000,
			width:7,
			text: {{ $product }},
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:{{ $transaksi }},
			maxValue:1000,
			width:7,
			text: {{ $transaksi }},
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})
    
</script>
{!! $chart->script() !!}
{!! $chart_month->script() !!}
@endpush