@extends('layouts.app', ['title' => 'Schedule'])
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

select:focus {
  width: 30%;
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
                    <h2>Bài Tập</h2>
                </div>
                <div class="breadcrum-area">
                    <ul class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active">Bài Tập</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Inner Banner area -->
@endsection
@section('content')
<!-- Start wrapper -->
<div class="wrapper">
    <!-- Start Classes page area -->
    <div class="our-classes-area padding-top">
        <div class="container">
            <div class="row">
                <!-- Gallery Section Area Start Here -->
                    <div class="gallery-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="isotop-classes-tab">                            
                                    <select class="exercise-search" name="" id="">

                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolioContainer zoom-gallery">    
                            @foreach($exercises as $exercise)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                                <div class="single-classes-area">
                                    <div class="classes-img">
                                        <video class="img-responsive" controls>
                                            <source src="upload/exercise/video/{{$exercise->video}}">
                                        </video>
                                    </div>
                                </div>
                                <div class="classes-title">
                                    <h3>{{$exercise->exercise_type->exercise_type_name}}</h3>
                                    <h3><a href="">{{$exercise->exercise_name}}</a></h3>
                                </div>
                            </div>
                            @endforeach                                    
                        </div>
                    </div>
                <!-- Gallery Section Area End Here -->
            </div>
        </div>
    </div>
    <!-- End Classes page area -->
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
    $('.exercise-search').select2({
        placeholder: "Tìm Kiếm...",
        minimumInputLength: 2,
        ajax: {
            url: "{{route('search-exercise')}}",
            dataType: 'json',
            type: "GET",
            data: function (term) {
                return {
                    term: term
                };
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        }
    });
    $(".exercise-search").change(function(){
        let exercise_id = $(this).val();
        $.ajax({
            url : "/page/ajax/exercise/" + exercise_id,
            method: "GET",
            success: function(result) {
                let video = result[0].video;
                let exercise_type_name = result[1].exercise_type_name;
                let exercise_name = result[0].exercise_name;
                html =      '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">'+
                                '<div class="single-classes-area">'+
                                    '<div class="classes-img">'+
                                        '<video class="img-responsive" controls>'+
                                            '<source src="upload/exercise/video/'+video+'">'+
                                        '</video>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="classes-title">'+
                                    '<h3>'+exercise_type_name+'</h3>'+
                                    '<h3><a href="">'+exercise_name+'</a></h3>'+
                                '</div>'+
                            '</div>';
                $('.zoom-gallery').html(html);
            }
        });
    });
});
</script>
@endsection