@extends('layouts.app', ['title' => 'Trainer'])
@section('styles')
<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
    select {
    width: 180px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
    }
</style>
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
                    <h2>Huấn Luyện Viên</h2>
                </div>
                <div class="breadcrum-area">
                    <ul class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active">Huấn Luyện Viên</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Inner Banner area -->

@endsection
@section('content')
            <!-- Start Our trainer area -->
            <div class="our-trainer-area padding-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="isotop-classes-tab">                            
                                <select class="trainer-search" name="" id="">

                                </select>
                            </div>
                        </div>
                        @foreach($trainers as $trainer)
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="our-trainer-item">
                                <div class="trainer-image">
                                    <img src="upload/trainer/photo/{{$trainer->photo}}" alt="">
                                    <div class="trainer-overly">
                                        <h3><a href="{{route('page-trainer-detail',['id'=>$trainer->id])}}">{{$trainer->full_name}}</a></h3>
                                        <span class="builder">{{$trainer->course_type->course_type_name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- End Our trainer area -->
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
                                <a class="custom-button" data-title="Become A Member" href="#">Đăng ký thành viên</a>
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
                            <a class="custom-button" data-title="Become A Member" href="#">Xem Ngay</a>
                        </div>
                    </div>                    
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Price Table area -->
@endsection
@section('scripts')
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>

$(document).ready(function () {
    $('.trainer-search').select2({
        placeholder: "Tìm Kiếm...",
        minimumInputLength: 2,
        ajax: {
            url: "{{route('search-trainer')}}",
            dataType: 'json',
            type: "GET",
            data: function (term) {
                return {
                    term: term
                };
            },
            results: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.completeName,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
});
</script>
@endsection