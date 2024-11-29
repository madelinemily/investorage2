@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Dashboard</li>
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $kategori }}</h3>

                <p>Total Kategori</p>
            </div>
            <div class="icon d-flex justify-content-center align-items-center rounded-circle" style="width: 70px; height: 70px; background-color: #2E4492;">
              <i class="ion ion-bag text-white" style="font-size: 30px;"></i>
            </div>
            <a href="{{ route('kategori.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $produk }}</h3>

                <p>Total Produk</p>
            </div>
            <div class="icon d-flex justify-content-center align-items-center rounded-circle" style="width: 70px; height: 70px; background-color: #2E4492;">
              <i class="ion ion-stats-bars text-white" style="font-size: 30px;"></i>
            </div>
            <a href="{{ route('produk.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
            <h3>{{ $member }}</h3>

                <p>Total Member</p>
            </div>
            <div class="icon d-flex justify-content-center align-items-center rounded-circle" style="width: 70px; height: 70px; background-color: #2E4492;">
              <i class="ion ion-person-add text-white" style="font-size: 30px;"></i>
            </div>
            <a href="{{ route('member.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
            <h3>{{ $supplier }}</h3>

                <p>Total Supplier</p>
            </div>
            <div class="icon d-flex justify-content-center align-items-center rounded-circle" style="width: 70px; height: 70px; background-color: #2E4492;">
              <i class="ion ion-pie-graph text-white" style="font-size: 30px;"></i>
            </div>
            <a href="{{ route('supplier.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Grafik Pendapatan {{ tanggal_indonesia($tanggal_awal, false) }} s/d {{ tanggal_indonesia($tanggal_akhir, false) }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="salesChart" style="height: 180px;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->
@endsection

@push('scripts')
<!-- ChartJS -->
<script src="{{ asset('AdminLTE-2/bower_components/chart.js/Chart.js') }}"></script>
@endpush