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
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body text-center">
                <h1>{{ __('kasir.welcome') }}</h1>
                <h2>{{ __('kasir.role') }}</h2>
                <br>
                <a href="{{ route('transaksi.baru') }}" class="btn btn-success btn-lg">{{ __('kasir.new_transaction') }}</a>
                <br>
                <img src="/images/cashier.png" alt="">
            </div>
        </div>
    </div>
</div>
<!-- /.row (main row) -->
@endsection