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
                                    <li><a>{{$user_login->full_name}}</a></li>
                                    <li><a href="{{ route('logout')}}"><span> Đăng xuất</span></a></li>
                                    <li><a href="{{ route('get-user-profile',['id'=>$user_login->id]) }}">Trang Cá Nhân</a></li>                                 
                                    @elseif(isset($trainer_login))
                                    <li><a>{{$trainer_login->full_name}}</a></li>
                                    <li><a href="{{ route('logout_trainer')}}"><span> Đăng xuất</span></a></li>
                                    <li><a href="{{ route('trainer-get-home')}}">Trang Quản Lý</a></li>
                                    @elseif(isset($staff_login))
                                        @if($staff_login->role == 0)
                                            <li><a>{{$staff_login->full_name}}</a></li>
                                            <li><a href="{{ route('logout_staff')}}"><span> Đăng xuất</span></a></li>
                                            <li><a href="{{ route('admin-home')}}">Trang Quản Trị</a></li>
                                        @else
                                            <li><a>{{$staff_login->full_name}}</a></li>
                                            <li><a href="{{ route('logout_staff')}}"><span> Đăng xuất</span></a></li>
                                            <li><a href="{{ route('staff-get-home')}}">Trang Quản Lý</a></li>
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
                                <a href="{{route('page-home')}}"><img src="img/logo-white.png" alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-10">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li class="{{Request::is('page/home*') ? 'active' : ''}}"><a href="{{route('page-home')}}">Trang Chủ</a></li>
                                        <li class="{{Request::is('page/course*') ? 'active' : ''}}"><a href="{{route('page-course')}}">Khóa Tập</a></li>
                                        <li class="{{Request::is('page/schedule*') ? 'active' : ''}}"><a href="{{route('page-schedule')}}">Lịch Tập</a></li>
                                        <li class="{{Request::is('page/trainer*') ? 'active' : ''}}"><a href="{{route('page-trainer')}}">Huấn Luyện Viên</a></li>
                                        <li class="{{Request::is('page/news*') ? 'active' : ''}}"><a href="{{route('page-news')}}">Tin Tức</a></li>
                                        <li class="{{Request::is('page/exercise*') ? 'active' : ''}}"><a href="{{route('page-exercise')}}">Bài Tập</a></li>
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
                                        <li class="{{Request::is('page/home*') ? 'active' : ''}}"><a href="{{route('page-home')}}">Trang Chủ</a></li>
                                        <li class="{{Request::is('page/course*') ? 'active' : ''}}"><a href="{{route('page-course')}}">Khóa Tập</a></li>
                                        <li class="{{Request::is('page/schedule*') ? 'active' : ''}}"><a href="{{route('page-schedule')}}">Lịch Tập</a></li>
                                        <li class="{{Request::is('page/trainer*') ? 'active' : ''}}"><a href="{{route('page-trainer')}}">Huấn Luyện Viên</a></li>
                                        <li class="{{Request::is('page/news*') ? 'active' : ''}}"><a href="{{route('page-news')}}">Tin Tức</a></li>
                                        <li class="{{Request::is('page/exercise*') ? 'active' : ''}}"><a href="{{route('page-exercise')}}">Bài Tập</a></li>
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