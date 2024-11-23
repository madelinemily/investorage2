<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="margin-top: 2rem">
   
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        @if(auth()->user()->level == 0)
        <li class="header">MASTER</li>

        <li>
          <a href="{{ route('kategori.index') }}">
            <i class="fa fa-dashboard"></i> <span>Kategori</span>
          </a>
        </li>
        <li>
          <a href="{{ route('produk.index') }}">
            <i class="fa fa-dashboard"></i> <span>Produk</span>
          </a>
        </li>
        <li>
          <a href="{{ route('member.index') }}">
            <i class="fa fa-dashboard"></i> <span>Member</span>
          </a>
        </li>
        <li>
          <a href="{{ route(name: 'supplier.index') }}">
            <i class="fa fa-dashboard"></i> <span>Supplier</span>
          </a>
        </li>

        <li class="header">TRANSAKSI</li>

        <li>
          <a href="{{ route('pengeluaran.index') }}">
            <i class="fa fa-money"></i> <span>Pengeluaran</span>
          </a>
        </li>

        <li>
          <a href="{{ route('pembelian.index') }}">
            <i class="fa fa-download"></i> <span>Pembelian</span>
          </a>
        </li>

        <li>
          <a href="{{ route('penjualan.index')}}">
            <i class="fa fa-upload"></i> <span>Penjualan</span>
          </a>
        </li>

        <li>
          <a href="{{ route('transaksi.index')}}">
            <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Lama</span>
          </a>
        </li>

        <li>
          <a href="{{ route('transaksi.baru')}}">
            <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Baru</span>
          </a>
        </li>

        <li class="header">REPORT</li>

        <li>
          <a href="{{ route('laporan.index') }}">
            <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
          </a>
        </li>

        <li class="header">SYSTEM</li>

        <li>
          <a href="#">
            <i class="fa fa-users"></i> <span>User</span>
          </a>
        </li>

        <li>
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Pengaturan</span>
          </a>
        </li>

        @else
        <li>
          <a href="{{ route('produk.index') }}">
            <i class="fa fa-dashboard"></i> <span>Produk</span>
          </a>
        </li>
        @endif
    </section>

  </aside>