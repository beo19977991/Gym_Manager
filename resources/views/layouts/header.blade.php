        <!-- Start Header area -->
        <header class="main-header header-style2" id="sticker">
            <div class="header-top-bar" style="margin-bottom: 0px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="top-bar-left">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="top-bar-right">
                                <ul>
                                    @if(isset($user_login))                                  
                                    <li><a href="#">{{$user_login->full_name}}</a></li>
                                    <li><a href="{{ route('logout')}}"><span> Đăng xuất</span></a></li>                                    
                                    @elseif(isset($trainer_login))
                                    <li><a href="#">{{$trainer_login->full_name}}</a></li>
                                    <li><a href="{{ route('logout_trainer')}}"><span> Đăng xuất</span></a></li>
                                    @elseif(isset($staff_login))
                                        @if($staff_login->role == 0)
                                            <li><a href="#">{{$staff_login->full_name}}</a></li>
                                            <li><a href="{{ route('logout_staff')}}"><span> Đăng xuất</span></a></li>
                                            <li><a href="{{ route('admin-home')}}">Trang quản trị</a></li>
                                        @else
                                            <li><a href="#">{{$staff_login->full_name}}</a></li>
                                            <li><a href="{{ route('logout_staff')}}"><span> Đăng xuất</span></a></li>
                                        @endif
                                    @else
                                    <li><a href="{{ route('select_login')}}">Đăng nhập</a></li>
                                    @endif 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-top-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <div class="logo-area">
                                <a href="index.html"><img src="img/logo-white.png" alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-10">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li class="active"><a href="#">Trang Chủ</a></li>
                                        <li><a href="#">Lớp Học</a></li>
                                        <li><a href="#">Lịch Học</a></li>
                                        <li><a href="#">Huấn Luyện Viên</a></li>
                                        <li><a href="#">Tin Tức</a></li>
                                        <li><a href="#">Bài Tập</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 hidden-sm">
                            <div class="header-top-right">
                                <ul>
                                    <li>
                                        <div class="header-top-search search-box">
                                            <form>
                                                <input class="search-text" type="text" placeholder="Search Here...">
                                                <a class="search-button" href="#">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </a>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End header Top Area -->
            <!-- mobile-menu-area start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                        <li><a href="#">Trang Chủ</a></li>
                                        <li><a href="#">Lớp Học</a></li>
                                        <li><a href="#">Lịch Học</a></li>
                                        <li><a href="#">Huấn Luyện Viên</a></li>
                                        <li><a href="#">Tin Tức</a></li>
                                        <li><a href="#">Bài Tập</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile-menu-area end -->
        </header>
    <!-- End Header area -->