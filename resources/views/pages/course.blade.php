@extends('layouts.app', ['title' => 'Course'])
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
                    <h2>Khóa Tập</h2>
                </div>
                <div class="breadcrum-area">
                    <ul class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active">Khóa Tập</li>
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
                                    <select class="course-search" name="" id="">

                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolioContainer zoom-gallery">    
                            @foreach($courses as $course)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                                <div class="single-classes-area">
                                    <div class="classes-img">
                                        <a href="#">
                                            <img src="img/classes/yoga.jpg" alt="yoga">
                                        </a>
                                    </div>
                                    <div class="classes-title">
                                        <h3>{{$course->course_type->course_type_name}}</h3>
                                        <h3><a href="{{route('page-course-detail',['id'=>$course->id])}}">{{$course->course_name}}</a></h3>
                                        <p class="date">{{\Carbon\Carbon::parse($course->start_time)->format('d-m-Y')}}{{" đến "}}{{\Carbon\Carbon::parse($course->end_time)->format('d-m-Y')}}</p>
                                    </div>
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
</div>
@endsection
@section('scripts')
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>

$(document).ready(function () {
    $('.course-search').select2({
        placeholder: "Tìm Kiếm...",
        minimumInputLength: 2,
        ajax: {
            url: "{{route('search-course')}}",
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

    $(".course-search").change(function(){
        let course_id = $(this).val();
        $.ajax({
            url : "/page/ajax/course/" + course_id,
            method: "GET",
            success: function(result) {
                let photo = result.photo;
                let type_name = result.course_type_name;
                let id = result.id;
                let name = result.course_name;
                let start_time = result.start_time;
                start_time = new Date(start_time);
                let end_time = result.end_time;
                end_time = new Date(end_time);
                html = '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">'+
                                '<div class="single-classes-area">' +
                                    '<div class="classes-img">' +
                                        '<a href="#">' +
                                            '<img src="upload/course/photo/'+photo+'" alt="yoga">' +
                                        '</a>' +
                                    '</div>' +
                                    '<div class="classes-title">' +
                                        '<h3>'+type_name+'</h3>' +
                                        '<h3><a href="page/course/detail/'+id+'">'+name+'</a></h3>' +
                                        '<p class="date">'+start_time.getDay() + "/" +(start_time.getMonth() + 1) +"/"+start_time.getYear() +' đến '+end_time.getDay() + "/" +(end_time.getMonth() + 1) +"/"+end_time.getYear() +'</p>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                $('.zoom-gallery').html(html);
            }
        });
    });
});
</script>
@endsection