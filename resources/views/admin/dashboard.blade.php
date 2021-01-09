@extends('layouts.admin.app')

@section('title', 'Welcome to Snack666')

@section('navbar')
@parent
<!-- <p>Navbar</p> -->
@endsection

@section('content')
<!-- ============================================================== -->
<!-- pagehader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h3 class="mb-2">Sales Dashboard </h3>
            <p class="pageheader-text">Lorem ipsum dolor sit ametllam fermentum ipsum eu porta consectetur adipiscing elit.Nullam vehicula nulla ut egestas rhoncus.</p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sales Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- pagehader  -->
<!-- ============================================================== -->
<div class="row">
    <!-- metric -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Customers</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-primary">{{ $totalCustomers }}</h1>
                </div>
                <!-- <div class="metric-label d-inline-block float-right text-success">
                                    <i class="fa fa-fw fa-caret-up"></i><span>5.27%</span>
                                </div> -->
            </div>
            <!-- <div id="sparkline-1"></div> -->
        </div>
    </div>
    <!-- /. metric -->
    <!-- metric -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Order</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-primary">{{ $totalOrders }}</h1>
                </div>
                <!-- <div class="metric-label d-inline-block float-right text-danger">
                                    <i class="fa fa-fw fa-caret-down"></i><span>1.08%</span>
                                </div> -->
            </div>
            <!-- <div id="sparkline-2"></div> -->
        </div>
    </div>
    <!-- /. metric -->
    <!-- metric -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Revenue</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-primary">${{ $totalRevenue / 100 }}</h1>
                </div>
                <!-- <div class="metric-label d-inline-block float-right text-danger">
                                    <i class="fa fa-fw fa-caret-down"></i><span>7.00%</span>
                                </div> -->
            </div>
            <!-- <div id="sparkline-3"> -->
        </div>
    </div>
</div>
<!-- /. metric -->
<!-- metric -->
<!-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Growth</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1 text-primary">+28.45% </h1>
                                </div>
                                <div class="metric-label d-inline-block float-right text-success">
                                    <i class="fa fa-fw fa-caret-up"></i><span>4.87%</span>
                                </div>
                            </div>
                            <div id="sparkline-4"></div>
                        </div>
                    </div> -->
<!-- /. metric -->

@endsection