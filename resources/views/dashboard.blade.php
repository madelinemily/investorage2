@extends('layouts.master')

@section('title')
{{ __('dashboard.title') }}
@endsection

@section('breadcrumb')
    @parent
    <li class="active">{{ __('dashboard.breadcrumb') }}</li>
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <!-- Language Toggle -->
<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-primary" id="toggle-language">
        {{ session('locale') == 'ko' ? 'English' : 'Bahasa' }}
    </button>
</div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $kategori }}</h3>

                <p>{{ __('dashboard.total_category') }}</p>
            </div>
            <div class="icon d-flex justify-content-center align-items-center rounded-circle" style="width: 70px; height: 70px; background-color: #2E4492;">
              <i class="ion ion-bag text-white" style="font-size: 30px;"></i>
            </div>
            <a href="{{ route('kategori.index') }}" class="small-box-footer">{{ __('dashboard.view') }} <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $produk }}</h3>

                <p>{{ __('dashboard.total_product') }}</p>
            </div>
            <div class="icon d-flex justify-content-center align-items-center rounded-circle" style="width: 70px; height: 70px; background-color: #2E4492;">
              <i class="ion ion-stats-bars text-white" style="font-size: 30px;"></i>
            </div>
            <a href="{{ route('produk.index') }}" class="small-box-footer">{{ __('dashboard.view') }} <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
            <h3>{{ $member }}</h3>

                <p>{{ __('dashboard.total_member') }}</p>
            </div>
            <div class="icon d-flex justify-content-center align-items-center rounded-circle" style="width: 70px; height: 70px; background-color: #2E4492;">
              <i class="ion ion-person-add text-white" style="font-size: 30px;"></i>
            </div>
            <a href="{{ route('member.index') }}" class="small-box-footer">{{ __('dashboard.view') }} <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
            <h3>{{ $supplier }}</h3>

                <p>{{ __('dashboard.total_supplier') }}</p>
            </div>
            <div class="icon d-flex justify-content-center align-items-center rounded-circle" style="width: 70px; height: 70px; background-color: #2E4492;">
              <i class="ion ion-pie-graph text-white" style="font-size: 30px;"></i>
            </div>
            <a href="{{ route('supplier.index') }}" class="small-box-footer">{{ __('dashboard.view') }} <i class="fa fa-arrow-circle-right"></i></a>
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
            <h3 class="box-title">{{ __("dashboard.grafik_pendapatan", [
        'tanggal_awal' => tanggal_indonesia($tanggal_awal, false),
        'tanggal_akhir' => tanggal_indonesia($tanggal_akhir, false)
    ]) }}</h3>
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
<script>
$(document).ready(function() {
    $('#toggle-language').click(function() {
        let currentLocale = '{{ session('locale') }}';
        let newLocale = currentLocale === 'ko' ? 'id' : 'ko';
        window.location.href = '/locale/' + newLocale;
    });
});
</script>


@push('scripts')
<!-- ChartJS -->
<script src="{{ asset('AdminLTE-2/bower_components/chart.js/Chart.js') }}"></script>
<script>
$(function() {
    // Get context with jQuery - using jQuery's .get() method.
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
    // This will get the first returned node in the jQuery collection.
    var salesChart = new Chart(salesChartCanvas);

    var salesChartData = {
        labels: {{ json_encode($data_tanggal) }},
        datasets: [
            {
                label: 'Pendapatan',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {{ json_encode($data_pendapatan) }}
            }
        ]
    };

    var salesChartOptions = {
        pointDot : false,
        responsive : true
    };

    salesChart.Line(salesChartData, salesChartOptions);
});
</script>
@endpush