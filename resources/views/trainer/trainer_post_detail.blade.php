@extends('layouts.app', ['title' => 'Trainer Post Detail'])
@section('banner')
        <!-- Preloader Start Here -->
        <div id="preloader"></div>
        <!-- Preloader End Here -->
    <!-- Start Inner Banner area -->
    <div class="inner-banner-area">
        <div class="container">
            <div class="row">
                <div class="innter-title">
                    <h2>Chi Tiết Bài Viết</h2>
                </div>
                <div class="breadcrum-area">
                    <ul class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Inner Banner area -->
@endsection
@section('content')
            <!-- Start details classes area -->
            <div class="news-detail-area padding-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <div class="single-news-detail">
                                <div class="class-content">
                                    <div class="detail-img">
                                        <img src="upload/trainerpost/photo/{{$trainer_post->photo}}" alt="detail-img">
                                    </div>
                                    <div class="class-heading">
                                        <h3>{{$trainer_post->title}}</h3>
                                        <ul>
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i>{{\Carbon\Carbon::parse($trainer_post->created_at)->format('d M Y')}}</li>
                                            <li><i class="fa fa-user" aria-hidden="true"></i>Huấn Luyện Viên : <a href="#">{{$trainer_post->trainer->full_name}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <p>{{$trainer_post->body}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="right-sidebar">
                                <div class="single-sidebar">
                                    <h3>Các Môn Hiện Có</h3>
                                    <div class="categories">
                                        <ul>
                                            @foreach($course_types as $course_type)
                                            <li>{{$course_type->course_type_name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="single-sidebar">
                                    <h3>Tin Tức Mới Nhất</h3>
                                    <div class="archives-list">
                                        <table style="width:100%; border:0;">
                                            <tbody>
                                                @foreach($posts as $post)
                                                <tr>
                                                    <td><a href="{{route('page-post-detail',['id'=>$post->id])}}">{{$post->title}}</a></td>
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
            <!-- End details classes area -->
@endsection