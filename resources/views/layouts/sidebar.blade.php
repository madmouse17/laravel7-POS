<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2 avatar avatar-online">
                    <img src="{{ asset('storage/profile/'.Auth::user()->profile) }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->username }}
                            <span class="user-level">{{ Auth::user()->name }}</span>

                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ (Request::path() == 'admin/beranda') ? 'active' : '' }}">
                    <a href="{{ url('admin/beranda') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        {{-- <span class="caret"></span> --}}
                    </a>
                    {{-- <div class="collapse" id="dashboard">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ url('admin/beranda') }}">
                    <span class="sub-item">Dashboard 1</span>
                    </a>
                </li>
                <li>
                    <a href="../demo2/index.html">
                        <span class="sub-item">Dashboard 2</span>
                    </a>
                </li>
            </ul>
        </div> --}}
        </li>
        <li class="nav-section">
            <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Main Menu</h4>
        </li>
        <li class="nav-item {{ (Request::path() == 'admin/user' || Request::path() == 'admin/supplier'|| Request::path() == 'admin/category'|| Request::path() == 'admin/product') ? 'active submenu' : '' }}">
            <a data-toggle="collapse" href="#base">
                <i class="fas fa-layer-group"></i>
                <p>Management Data</p>
                <span class="caret"></span>
            </a>
            <div class="collapse {{ (Request::path() == 'admin/user' || Request::path() == 'admin/supplier'|| Request::path() == 'admin/category'|| Request::path() == 'admin/product') ? 'show' : '' }}" id="base">
                <ul class="nav nav-collapse">
                    @can('user-list')
                    <li class="{{ (Request::path() == 'admin/user') ? 'active' : '' }}">
                        <a href=" {{ url('admin/user') }}">
                            <span class="sub-item">Manage User</span>
                        </a>
                    </li>
                    @endcan
                    @can('supplier-list')
                    <li class="{{ (Request::path() == 'admin/supplier') ? 'active' : '' }}">
                        <a href="{{ route('supplier.index') }}">
                            <span class="sub-item">Manage Supplier</span>
                        </a>
                    </li>
                    @endcan
                    <li class="{{ (Request::path() == 'admin/category') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}">
                            <span class="sub-item">Manage Categories</span>
                        </a>
                    </li>
                    @can('product-list')
                    <li class="{{ (Request::path() == 'admin/product') ? 'active' : '' }}">
                        <a href="{{ route('product.index') }}">
                            <span class="sub-item">Manage Product</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>
        <li class="nav-item {{ (Request::path() == 'admin/report' || Request::path() == 'admin/my-transaksi') ? 'active submenu' : '' }}">
            <a data-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Management Transaksi</p>
                <span class="caret"></span>
            </a>
            <div class="collapse {{ (Request::path() == 'admin/report' || Request::path() == 'admin/my-transaksi') ? 'show' : '' }}" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                    {{-- <li class="{{ (Request::path() == 'admin/transaksi') ? 'active' : '' }}">
                    <a href="{{ route('transaksi.index') }}">
                        <span class="sub-item">Transaksi</span>
                    </a>
        </li> --}}
        <li class="{{ (Request::path() == 'admin/my-transaksi') ? 'active' : '' }}">
            <a href="{{ route('my-transaksi') }}">
                <span class="sub-item">My Transaksi</span>
            </a>
        </li>
        <li class="{{ (Request::path() == 'admin/report') ? 'active' : '' }}">
            <a href="{{ route('my-transaksi.report') }}">
                <span class="sub-item">Report Transaksi</span>
            </a>
        </li>
        </ul>
    </div>
    </li>
    @can('role-list')
    <li class="nav-item {{ (Request::path() == 'admin/role') ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#forms">
            <i class="fas fa-pen-square"></i>
            <p>Management Role</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ (Request::path() == 'admin/role') ? 'show' : '' }}" id="forms">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{ url('admin/role') }}">
                        <span class="sub-item">Manage Role</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endcan
    {{-- <li class="nav-item">
        <a data-toggle="collapse" href="#tables">
            <i class="fas fa-table"></i>
            <p>Tables</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="tables">
            <ul class="nav nav-collapse">
                <li>
                    <a href="tables/tables.html">
                        <span class="sub-item">Basic Table</span>
                    </a>
                </li>
                <li>
                    <a href="tables/datatables.html">
                        <span class="sub-item">Datatables</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a data-toggle="collapse" href="#maps">
            <i class="fas fa-map-marker-alt"></i>
            <p>Maps</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="maps">
            <ul class="nav nav-collapse">
                <li>
                    <a href="maps/jqvmap.html">
                        <span class="sub-item">JQVMap</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a data-toggle="collapse" href="#charts">
            <i class="far fa-chart-bar"></i>
            <p>Charts</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="charts">
            <ul class="nav nav-collapse">
                <li>
                    <a href="charts/charts.html">
                        <span class="sub-item">Chart Js</span>
                    </a>
                </li>
                <li>
                    <a href="charts/sparkline.html">
                        <span class="sub-item">Sparkline</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a href="widgets.html">
            <i class="fas fa-desktop"></i>
            <p>Widgets</p>
            <span class="badge badge-success">4</span>
        </a>
    </li>
    <li class="nav-item">
        <a data-toggle="collapse" href="#submenu">
            <i class="fas fa-bars"></i>
            <p>Menu Levels</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="submenu">
            <ul class="nav nav-collapse">
                <li>
                    <a data-toggle="collapse" href="#subnav1">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="subnav1">
                        <ul class="nav nav-collapse subnav">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#subnav2">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="subnav2">
                        <ul class="nav nav-collapse subnav">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#">
                        <span class="sub-item">Level 1</span>
                    </a>
                </li>
            </ul>
        </div>
    </li> --}}
    {{-- <li class="mx-4 mt-2">
                    <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a>
                </li> --}}
    </ul>
</div>
</div>
</div>
<!-- End Sidebar -->