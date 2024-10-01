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
            <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell" style="font-size: 20px;"></i>
              <span class="badge bg-danger">3</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li class="dropdown-header">Notifications</li>
              <li><a class="dropdown-item" href="#">You have 3 new notifications</a></li>
              <li><a class="dropdown-item" href="#">Another notification</a></li>
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

<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
  @csrf
</form>