<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('page-home')}}" class="brand-link">
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
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Khách Hàng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('staff-get-list-user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Khách Hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('staff-get-add-user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Khách Hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('staff-list-user-register')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thống Kê</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- customer end -->
          <!-- trainer start -->
          <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Huấn Luyện Viên
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('staff-list-trainer') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Huấn Luyện Viên</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('staff-add-trainer') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Huấn Luyện Viên</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- trainer end -->
        <!-- Course Type start -->
        <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Loại Khóa Tập
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('staff-list-course-type')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Loại Khóa Tập</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('staff-add-course-type') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Loại Khóa Tập</p>
                </a>
              </li>
            </ul>
        </li>
        <!-- Course Type end -->
        <!-- Course start -->
        <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Khóa Tập
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('staff-list-course')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Khóa Tập</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('staff-add-course')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Khóa Tập</p>
                </a>
              </li>
            </ul>
        </li>
          <!-- Course end -->
        <!-- Exercise start -->
        <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tin tức
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('staff-list-post') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Tin Tức</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('staff-add-post') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Tin Tức</p>
                </a>
              </li>
            </ul>
        </li>
            <!-- Schedule start -->
            <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Lịch tập
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('staff-add-schedule')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lịch</p>
                </a>
              </li>
            </ul>
        </li>
    <!-- Schedule end -->
          <!-- Product Type start -->
          <!-- <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Loại Sản Phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('staff-list-product-type') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Loại Sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('staff-add-product-type')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Loại Sản Phẩm</p>
                </a>
              </li>
            </ul>
        </li> -->
    <!-- Product type end -->
          <!-- Product start -->
          <!-- <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sản Phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('staff-list-product')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('staff-add-product')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Sản Phẩm</p>
                </a>
              </li>
            </ul>
        </li> -->
    <!-- Product end -->
    </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>