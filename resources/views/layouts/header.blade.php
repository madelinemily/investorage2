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
        <ul class="nav navbar-nav d-flex flex-row align-items-center">
          <!-- Toggle Language  -->
           <!-- Dropdown Language -->
<li class="nav-item dropdown me-4">
   <a href="#" class="nav-link dropdown-toggle" id="dropdownLanguage" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa fa-language" style="font-size: 20px;"></i>
   </a>
   <ul class="dropdown-menu" aria-labelledby="dropdownLanguage">
      <li>
         <a href="{{ route('locale', ['locale' => 'id']) }}" class="dropdown-item">
            <div class="media">
               <div class="media-body">
                  <h3 class="dropdown-item-title">Bahasa Indonesia</h3>
               </div>
            </div>
         </a>
      </li>
      <li>
         <a href="{{ route('locale', ['locale' => 'ko']) }}" class="dropdown-item">
            <div class="media">
               <div class="media-body">
                  <h3 class="dropdown-item-title">Bahasa Korea</h3>
               </div>
            </div>
         </a>
      </li>
   </ul>
</li>

        
        <!-- Notification Icon -->
          <li class="nav-item dropdown me-4">
            <!-- Lonceng dengan link untuk membuka dropdown -->
            <a href="#" class="nav-link" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell" style="font-size: 20px;"></i>
              <!-- Badge dengan jumlah notifikasi -->
              @if($notifications->isNotEmpty())
    <span>{{ $notifications->count() }}</span>
@endif



              
            </a>

            <!-- Dropdown menu yang akan muncul setelah ikon diklik -->
            <!-- Dropdown menu yang akan muncul setelah ikon diklik -->
<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
  <li class="dropdown-header">Notifications</li>
  @if(count($notifications) > 0)
    @foreach($notifications as $notification)
      <li>
        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
          <span>{{ $notification->message }}</span>
          <button class="btn btn-sm btn-danger remove-notification" data-id="{{ $notification->id }}">Mark as Read</button>
        </a>
      </li>
    @endforeach
  @else
    <li><a class="dropdown-item" href="#">No new notifications</a></li>
  @endif
  <li><a class="dropdown-item" href="{{ route('notifications.index') }}">See all notifications</a></li> <!-- Ganti dengan route yang menampilkan semua notifikasi -->
</ul>

          </li>



          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
              <img src="{{ url(auth()->user()->foto ?? '') }}" class="user-image img-profil" alt="User Image">
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
                  <a href="{{ route('user.profil') }}" class="btn btn-default btn-flat">Profil</a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
       // Add click event for each notification item
       const notificationItems = document.querySelectorAll('.dropdown-item');
       
       notificationItems.forEach(item => {
           item.addEventListener('click', function () {
               const notificationId = item.getAttribute('data-id');
               
               // Make an AJAX request to mark the notification as read
               fetch(`/notifications/${notificationId}/read`, {
                   method: 'POST',
                   headers: {
                       'Content-Type': 'application/json',
                       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                   },
                   body: JSON.stringify({
                       id: notificationId
                   })
               })
               .then(response => response.json())
               .then(data => {
                   if (data.success) {
                       // Optionally, hide the badge or update the UI
                       const notificationBadge = document.querySelector('.badge');
                       if (notificationBadge) {
                           notificationBadge.style.display = 'none'; // Hide the badge if no more unread notifications
                       }
                   }
               });
           });
       });
   });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Event listener untuk tombol "Mark as Read"
    document.querySelectorAll('.remove-notification').forEach(button => {
        button.addEventListener('click', function () {
            const notificationId = this.getAttribute('data-id');

            // Kirim AJAX request ke server
            fetch(`/notifications/${notificationId}/read`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    }
})
.then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
})
.then(data => {
    if (data.success) {
        // Hapus notifikasi dari dropdown
        const notificationItem = document.querySelector(`.dropdown-item[data-id="${notificationId}"]`);
        if (notificationItem) {
            notificationItem.remove();
        }

        // Update badge
        const badge = document.querySelector('.fa-bell + span');
        const currentCount = parseInt(badge.textContent, 10) || 0;
        if (currentCount > 0) {
            badge.textContent = currentCount - 1;
        }

        // Jika tidak ada notifikasi unread lagi, sembunyikan badge
        if (currentCount - 1 === 0) {
            badge.style.display = 'none';
        }

        location.reload();
    }
})
.catch(error => {
    console.error('Error:', error);
});

        });
    });
});

</script>

<!-- Script di bagian bawah untuk memaksa dropdown berfungsi -->
<!-- <script>
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
</script> -->


<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
  @csrf
</form>