@extends('layouts.app', ['title' => 'News'])
@section('styles')
@endsection
@section('banner')
<!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Start Inner Banner area -->
    <div class="inner-banner-area">
        <div class="container">
            <div class="row">
                <div class="innter-title">
                    <h2>Tin Tức</h2>
                </div>
                <div class="breadcrum-area">
                    <ul class="breadcrumb">
                        <li><a href="{{route('page-home')}}">Trang chủ</a></li>
                        <li class="active">Tin Tức</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Inner Banner area -->
@endsection
@section('content')
            <!-- Start latest news area -->
            <div class="news-page-area padding-space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            @foreach($posts as $post)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="single-news-page">
                                    <div class="single-news">
                                        <img src="upload/post/photo/{{$post->photo}}" alt="">
                                        <div class="date">{{\Carbon\Carbon::parse($post->created_at)->format('d')}}<br>{{\Carbon\Carbon::parse($post->created_at)->format('M')}}<br>{{\Carbon\Carbon::parse($post->created_at)->format('Y')}}</div>
                                    </div>
                                    <div class="news-content">
                                        <h3><a href="{{route('page-post-detail',['id'=>$post->id])}}">{{$post->title}}</a></h3>
                                        <a class="read-more" href="{{route('page-post-detail',['id'=>$post->id])}}">Xem nhiều hơn</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach()
                            @foreach($trainer_posts as $trainer_post)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="single-news-page">
                                    <div class="single-news">
                                        <img src="upload/trainerpost/photo/{{$trainer_post->photo}}" alt="">
                                        <div class="date">{{\Carbon\Carbon::parse($trainer_post->created_at)->format('d')}}<br>{{\Carbon\Carbon::parse($trainer_post->created_at)->format('M')}}<br>{{\Carbon\Carbon::parse($trainer_post->created_at)->format('Y')}}</div>
                                    </div>
                                    <div class="news-content">
                                        <h3><a href="{{route('page-trainer-post-detail',['id'=>$trainer_post->id])}}">{{$trainer_post->title}}</a></h3>
                                        <a class="read-more" href="{{route('page-trainer-post-detail',['id'=>$trainer_post->id])}}">Xem nhiều hơn</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach()
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="right-sidebar">
                                <div class="single-sidebar">
                                    <h3>Các Môn Học Hiện Có</h3>
                                    <div class="categories">
                                        <ul>
                                            @foreach($course_types as $course_type)
                                            <li><a href="">{{$course_type->course_type_name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="single-sidebar sidebar-last">
                                    <h3>Archives</h3>
                                    <div class="archives-list">
                                        <table style="width:100%; border:0;">
                                            <tbody>
                                                @foreach($new_posts as $new_post)
                                                <tr>
                                                    <td><a href="">{{$new_post->title}}</a></td>
                                                    <td>{{\Carbon\Carbon::parse($new_post->created_at)->format('d')}}<span>{{\Carbon\Carbon::parse($new_post->created_at)->format('M')}}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start latest news area -->

        <!-- Start Fitness class summer area -->
        <div class="fitness-summer-area padding-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="fitness-summer">
                            <div class="fitness-content">
                                <h3><span>GymStar</span> Tham gia ngay</h3>
                                <p>Trong mùa hè này
                                    <br> Với ưu đãi lớn nhất <span>{{$course_max_discount->discount * 100}} %</span> Giảm giá
                                </p>
                                <a class="custom-button" data-title="Đăng ký thành viên" href="{{route('page-course-detail',['id'=>$course_max_discount->id])}}">Đăng ký thành viên</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Fitness class summer area -->
        <!-- Start Price Table area -->
        <div class="price-table-area">
            <div class="container">
                <h2 class="section-title-white title-bar-high">KHÓA TẬP SẮP MỞ</h2>
                <p class="sub-title-white">Trong thời gian sắp tới, phòng tập sẽ mở các khóa tập sau. Các bạn theo dõi để đăng ký khóa tập phù hợp với bản thân</p>
            </div>
            <div class="container">
                <div class="row">
                    @foreach($courses as $course)
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 hvr-float-shadow">
                        <div class="price-table-box">
                            <span>{{$course->course_name}}</span>
                            <h3>{{$course->price}}<span>vnđ</span></h3>
                            <ul>
                                <li>{{$course->course_type->course_type_name}}</li>
                                <li><span>Discount: </span>{{$course->discount *100}} <span>%</span></li>
                            </ul>
                            <a class="custom-button" data-title="Xem Ngay" href="{{route('page-course-detail',['id'=>$course->id])}}">Xem Ngay</a>
                        </div>
                    </div>                    
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Price Table area -->
@endsection
@section('scripts')
@endsection