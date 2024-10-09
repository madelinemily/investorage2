<header class="main-header">
  <!-- Logo -->
  <a href="{{ route('dashboard') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="images/logo_small.png" alt=""></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="images/logo.png" alt=""></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <div>
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu d-flex align-items-center">
        <ul class="nav navbar-nav d-flex align-items-center">
          <!-- Notification Icon -->
          <li class="nav-item dropdown me-3">
            <!-- Lonceng dengan link untuk membuka dropdown -->
            <a href="#" class="nav-link" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell" style="font-size: 20px;"></i>
              <!-- Badge dengan jumlah notifikasi -->
              @php
              $notifications = session('low_stock_notifications', []);
              $notificationCount = count($notifications);
              @endphp
              @if($notificationCount > 0)
              <span class="badge bg-danger">{{ $notificationCount }}</span>
              @endif
            </a>

            <!-- Dropdown menu yang akan muncul setelah ikon diklik -->
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
              <li class="dropdown-header">Notifications</li>

              <!-- Loop notifikasi jika ada -->
              @if($notificationCount > 0)
              @foreach($notifications as $notification)
              <li><a class="dropdown-item" href="#">{{ $notification }}</a></li>
              @endforeach
              @else
              <li><a class="dropdown-item" href="#">No new notifications</a></li>
              @endif

              <li><a class="dropdown-item" href="#">See all notifications</a></li>
            </ul>
          </li>



          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
              <img src="images/person.jpg" class="user-image img-profil" alt="User Image">
              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ url(auth()->user()->foto ?? '') }}" class="img-circle img-profil" alt="User Image">

                <p>
                  {{ auth()->user()->name }} - {{ auth()->user()->email }}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat"
                    onclick="$('#logout-form').submit()">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>

<!-- Script di bagian bawah untuk memaksa dropdown berfungsi -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen dropdown dan ikon lonceng
        const bellIcon = document.getElementById('notificationDropdown');
        const dropdownMenu = new bootstrap.Dropdown(bellIcon);

        // Event listener untuk memastikan dropdown muncul saat lonceng di klik
        bellIcon.addEventListener('click', function (e) {
            e.preventDefault();
            dropdownMenu.toggle();  // Menggunakan Bootstrap's dropdown toggle
        });
    });
</script>

<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
  @csrf
</form>