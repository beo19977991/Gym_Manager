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
          <a href="{{ route('logout_admin') }}" class="nav-link">Đăng xuất</a>
        </li>
      @endif
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
      <img src=""  class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">GymSTar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <!-- customer start -->
          <li class="nav-item has-treeview">
            <a href="{{route('admin-list-user')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Khách Hàng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin-list-user') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Khách Hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-add-user') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Khách Hàng</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- customer end -->
          <!-- trainer start -->
          <li class="nav-item has-treeview">
            <a href="{{ route('admin-list-trainer') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Huấn Luyện Viên
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin-list-trainer') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Huấn Luyện Viên</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-add-trainer') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Huấn Luyện Viên</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- trainer end -->
        <!-- Course Type start -->
        <li class="nav-item has-treeview">
            <a href="{{ route('admin-list-course-type')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Loại Khóa Học
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin-list-course-type')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Loại Khóa Học</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-add-course-type')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Loại Khóa Học</p>
                </a>
              </li>
            </ul>
        </li>
        <!-- Course Type end -->
        <!-- Course start -->
        <li class="nav-item has-treeview">
            <a href="{{ route('admin-list-course') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Khóa Học
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin-list-course') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Khóa Học</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-add-course') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Khóa Học</p>
                </a>
              </li>
            </ul>
        </li>
          <!-- Course end -->
    <!-- Exercise Type start -->
        <li class="nav-item has-treeview">
            <a href="{{ route('admin-list-exercise-type')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Loại Bài Tập
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin-list-exercise-type')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Loại Bài Tập</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-add-exercise-type') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Loại Bài Tập</p>
                </a>
              </li>
            </ul>
        </li>
    <!-- Exercise Type end -->
    <!-- Exercise start -->
        <li class="nav-item has-treeview">
            <a href="{{ route('admin-list-exercise')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Bài Tập
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin-list-exercise')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Bài Tập</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-add-exercise')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Bài Tập</p>
                </a>
              </li>
            </ul>
        </li>
    <!-- Exercise end -->
        <!-- Lession start -->
        <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Lịch
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin-schedule') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tạo lịch tập</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-get-delete-lession') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Xóa Lịch Tập</p>
                </a>
              </li>
            </ul>
        </li>
    <!-- Lession end -->
    </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>