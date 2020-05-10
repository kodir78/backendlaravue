@php
$currentUser = Auth::user()
@endphp
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" target="_blank" class="nav-link">Visit Site</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown dropdown-menu-sm">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
          <i class="nav-icon fas fa-user"></i>&nbsp; {{ $currentUser->name }}
        </a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-menu-sm dropdown-menu-right">
          <li>
            <a href="{{ url('/edit-account') }}" class="dropdown-item"><i class="nav-icon fas fa-edit"></i> Change Profile </a>
          </li>
          <li><a href="#" class="dropdown-item"><i class="nav-icon fas fa-lock"></i> Change Password</a></li>
          <li class="dropdown-divider"></li>
          <li>
            <a href="{{ route('logout') }}" class="dropdown-item"
             onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt text-danger"></i> {{ __('Sign out') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->