@extends('layouts.app', ['title' => 'Course Detail'])
@section('banner')
        <!-- Preloader Start Here -->
        <div id="preloader"></div>
        <!-- Preloader End Here -->
    <!-- Start Inner Banner area -->
    <div class="inner-banner-area">
        <div class="container">
            <div class="row">
                <div class="innter-title">
                    <h2>Chi Tiết Huấn Luyện Viên</h2>
                </div>
                <div class="breadcrum-area">
                    <ul class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active">{{$trainer->full_name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Inner Banner area -->
@endsection
@section('content')
    <!-- Start Trainer details area -->
    <div class="trainer-details-area padding-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="trainer-detail-image">
                        <div class="detail-image">
                            <img src="upload/trainer/photo/{{$trainer->photo}}">
                        </div>
                        <div class="trainer-info">
                            <p><span>Age:</span>{{$trainer->age}}</p>
                            <p><span>E-mail:</span>{{$trainer->email}}</p>
                            <p><span>Adress:</span>{{$trainer->address}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="trainer-detail-content">
                        <div class="detail-heading">
                            <h2>{{$trainer->full_name}}</h2>
                            <p><span class="degination">{{$trainer->course_type->course_type_name}}</span></p>
                            <p><span class="title">Giới Thiệu</span></p>
                            <p>{!!$trainer->description!!}</p>
                        </div>
                        <div class="detail-heading">
                            <p><span class="title">Huấn Luyện Các Lớp</span></p>
                            @if($course_trainers!= null)
                                @foreach($course_trainers as $course_trainer)
                                    <p><a href="{{route('page-course-detail',['id'=>$course_trainer->id])}}">{{$course_trainer->course_name}}</a>&nbsp;&nbsp;&nbsp;&nbsp;Từ ngày: {{\Carbon\Carbon::parse($course_trainer->start_time)->format('d-m-Y')}}&nbsp;&nbsp;&nbsp;&nbsp;Đến ngày: {{\Carbon\Carbon::parse($course_trainer->end_time)->format('d-m-Y')}}</p><br>
                                @endforeach
                            @else
                            <p>Chưa Tham Gia</p>
                            @endif
                        </div>
                        <div class="detail-heading">
                            <p><span class="title">Các Bài Viết</span></p>
                                @foreach($trainer_posts as $trainer_post)
                                <!-- Start Single Post -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 item">
                                        <div class="online-product">
                                            <a href="#"><img src="upload/trainerpost/photo/{{$trainer_post->photo}}" ></a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="name"><a href="#">{{$trainer_post->title}}</a></h3>
                                            <span class="regular-price">
                                                {{$trainer_post->preview}}
                                            </span>
                                        </div>
                                    </div>
                                <!-- End Single post -->
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Trainer details area -->
<!-- Start exercise trainer area -->
    <div class="trainer-details-area padding-space mt-0">
        <div class="feature-classes-area nav-on-hover">
            <div class="container">
                <div class="section-title">
                    <h2>Bài Tập Mẫu</h2>
                </div>
            </div>
            <div class="container">
                <div class="gym-carousel nav-control-top" data-loop="true" data-items="3" data-margin="15" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="2" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="3" data-r-medium-nav="true" data-r-medium-dots="false" data-r-large="3" data-r-large-nav="true" data-r-large-dots="false">
                    @foreach($exercise_trainers as $exercise)
                    <div class="single-product-classes">
                        <div class="single-product">
                            <video class="img-responsive" controls>
                                <source src="upload/exercise/video/{{$exercise->video}}">
                            </video>
                        </div>
                        <div class="product-content">
                            <h3>{{$exercise->exercise_type->exercise_type_name}}</h3>
                            <h3><a href="">{{$exercise->exercise_name}}</a></h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
<!-- End feature product area -->
            <!-- Start Expert trainers area -->
            <div class="expert-trainer-area nav-on-hover padding-space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="section-title">
                                <h2>Huấn Luyện Viên Khác</h2>
                            </div>
                            <div class="gym-carousel nav-control-top"
                                data-loop="true"
                                data-items="3"
                                data-margin="30"
                                data-autoplay="false"
                                data-autoplay-timeout="10000"
                                data-smart-speed="2000"
                                data-dots="false"
                                data-nav="true"
                                data-nav-speed="false"
                                data-r-x-small="1"
                                data-r-x-small-nav="true"
                                data-r-x-small-dots="false"
                                data-r-x-medium="2"
                                data-r-x-medium-nav="true"
                                data-r-x-medium-dots="false"
                                data-r-small="2"
                                data-r-small-nav="true"
                                data-r-small-dots="false"
                                data-r-medium="3"
                                data-r-medium-nav="true"
                                data-r-medium-dots="false"
                                data-r-large="3"
                                data-r-large-nav="true"
                                data-r-large-dots="false">
                                @foreach($trainer_others as $trainer_other)
                                <div class="single-trainer-item">
                                    <div class="trainer-item">
                                        <div class="trainer-img">
                                            <img src="upload/trainer/photo/{{$trainer_other->photo}}" alt="">
                                            <div class="trainer-overly">
                                                <h3><a href="">{{$trainer_other->full_name}}</a></h3>
                                                <span class="builder">{{$trainer_other->course_type->course_type_name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Expert tainers area -->
@endsection
@section('scripts')
@endsection