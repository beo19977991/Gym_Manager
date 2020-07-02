  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @if(isset($staff_login))
        <li class="nav-item d-none d-sm-inline-block">
          <a href="" class="nav-link">{{$staff_login->full_name}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('get-staff-profile',['id'=>$staff_login->id]) }}" class="nav-link">Trang cá nhân</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('logout_admin') }}" class="nav-link">Đăng xuất</a>
        </li>
        @elseif(isset($user_login))
        <li class="nav-item d-none d-sm-inline-block">
          <a href="" class="nav-link">{{$user_login->full_name}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('logout') }}" class="nav-link">Đăng xuất</a>
        </li>
        @elseif(isset($trainer_login))
        <li class="nav-item d-none d-sm-inline-block">
          <a href="" class="nav-link">{{$trainer_login->full_name}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('get-trainer-profile',['id'=>$staff_login->id]) }}" class="nav-link">Trang cá nhân</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('logout_trainer') }}" class="nav-link">Đăng xuất</a>
        </li>
      @endif
    </ul>
  </nav>
  <!-- /.navbar -->