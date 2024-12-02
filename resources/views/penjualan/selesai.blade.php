@extends('layouts.master')

@section('title')
{{ __('penjualan.sales_transaction') }}
@endsection

@section('breadcrumb')
    @parent
    <li class="active">{{ __('penjualan.sales_transaction') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                <div class="alert alert-success alert-dismissible">
                    <i class="fa fa-check icon"></i>
                    {{ __('penjualan.transaction_complete') }}
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('transaksi.baru') }}" class="btn btn-primary btn-flat">{{ __('penjualan.new_transaction') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection