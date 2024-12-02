<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="margin-top: 2rem">
   
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        @if(auth()->user()->level == 1)
        <li class="header">{{ __('sidebar.master') }}</li>

        <li>
          <a href="{{ route('kategori.index') }}">
            <i class="fa fa-dashboard"></i> <span>{{ __('sidebar.kategori') }}</span>
          </a>
        </li>
        <li>
          <a href="{{ route('produk.index') }}">
            <i class="fa fa-dashboard"></i> <span>{{ __('sidebar.produk') }}</span>
          </a>
        </li>
        <li>
          <a href="{{ route('member.index') }}">
            <i class="fa fa-dashboard"></i> <span>{{ __('sidebar.member') }}</span>
          </a>
        </li>
        <li>
          <a href="{{ route(name: 'supplier.index') }}">
            <i class="fa fa-dashboard"></i> <span>{{ __('sidebar.supplier') }}</span>
          </a>
        </li>

        <li class="header">{{ __('sidebar.transaksi') }}</li>

        <li>
          <a href="{{ route('pengeluaran.index') }}">
            <i class="fa fa-money"></i> <span>{{ __('sidebar.pengeluaran') }}</span>
          </a>
        </li>

        <li>
          <a href="{{ route('pembelian.index') }}">
            <i class="fa fa-download"></i> <span>{{ __('sidebar.pembelian') }}</span>
          </a>
        </li>

        <li>
          <a href="{{ route('penjualan.index')}}">
            <i class="fa fa-upload"></i> <span>{{ __('sidebar.penjualan') }}</span>
          </a>
        </li>

        <li>
          <a href="{{ route('transaksi.index')}}">
            <i class="fa fa-cart-arrow-down"></i> <span>{{ __('sidebar.transaksi_lama') }}</span>
          </a>
        </li>

        <li>
          <a href="{{ route('transaksi.baru')}}">
            <i class="fa fa-cart-arrow-down"></i> <span>{{ __('sidebar.transaksi_baru') }}</span>
          </a>
        </li>

        <li class="header">{{ __('sidebar.report') }}</li>

        <li>
          <a href="{{ route('laporan.index') }}">
            <i class="fa fa-file-pdf-o"></i> <span>{{ __('sidebar.laporan') }}</span>
          </a>
        </li>

        <li class="header">{{ __('sidebar.system') }}</li>

        <li>
          <a href="{{ route('user.index') }}">
            <i class="fa fa-users"></i> <span>{{ __('sidebar.user') }}</span>
          </a>
        </li>

        <li>
          <a href="#">
            <i class="fa fa-cogs"></i> <span>{{ __('sidebar.pengaturan') }}</span>
          </a>
        </li>

        @else
        <li>
          <a href="{{ route('transaksi.index')}}">
            <i class="fa fa-cart-arrow-down"></i> <span>{{ __('sidebar.transaksi_lama') }}</span>
          </a>
        </li>

        <li>
          <a href="{{ route('transaksi.baru')}}">
            <i class="fa fa-cart-arrow-down"></i> <span>{{ __('sidebar.transaksi_baru') }}</span>
          </a>
        </li>
        @endif
    </section>

  </aside>