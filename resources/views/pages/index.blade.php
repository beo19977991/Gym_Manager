@extends('layouts.app', ['title' => 'Home'])
@section('styles')
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-daygrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-timegrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-bootstrap/main.min.css') }}">
@endsection
@section('content')
    <!-- Start wrapper -->
    <div class="wrapper">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Preloader Start Here -->
        <div id="preloader"></div>
        <!-- Preloader End Here -->

        <!-- Start slider area  -->
        <div class="slider-area nav-slider slider2-caption slider-top-space-header4">
            <div class="bend niceties preview-2">
                <div id="ensign-nivoslider-2" class="slides">
                    <img src="img/slides/slide1.jpg" alt="image" title="#slider-direction-1" />
                    <img src="img/slides/slide2.jpg" alt="image" title="#slider-direction-2" />
                    <img src="img/slides/slide3.jpg" alt="image" title="#slider-direction-3" />
                </div>
                <!-- direction 1 -->
                <div id="slider-direction-1" class="t-cn slider-direction">
                    <!-- <div class="slider-progress"></div> -->
                    <div class="slider-content t-cn s-tb slider-1">
                        <div class="title-container s-tb-c title-compress">
                            <div data-wow-delay="0.1s" data-wow-duration="1s" class="tp-caption big-title rs-title customin customout bg-sld-cp-primary ">Gym<span> Star</span>
                            </div>
                            <div data-wow-delay="0.2s" data-wow-duration="2s" class="tp-caption small-content customin customout rs-title-small bg-sld-cp-primary tp-resizeme rs-parallaxlevel-0 ">
                            "Thành công không đến trong một sớm một chiều. Nó chỉ đến khi mỗi ngày bạn đều cố gắng làm tốt hơn ngày hôm qua. Và rồi thành công sẽ đến" - The Rock.
                            </div>
                        </div>
                        <div class="button"><a href="{{route('select_login')}}" class="btn custom-button" data-title="Join With Us">Tham gia ngay</a></div>
                    </div>
                </div>
                <!-- direction 2 -->
                <div id="slider-direction-2" class="t-cn slider-direction">
                    <div class="slider-progress"></div>
                    <div class="slider-content t-cn s-tb slider-2">
                        <div class="title-container s-tb-c title-compress">
                            <div data-wow-delay="0.1s" data-wow-duration="1s" class="tp-caption big-title rs-title customin customout bg-sld-cp-primary ">Gym <span>Star</span>
                            </div>
                            <div data-wow-delay="0.2s" data-wow-duration="2s" class="tp-caption small-content customin customout rs-title-small bg-sld-cp-primary tp-resizeme rs-parallaxlevel-0 ">
                            "Bạn sẽ cảm thấy tổn thương, chán nản, nhưng càng chăm chỉ, bạn sẽ càng thấy kết quả. Thân hình bạn đẹp đến mức nào cũng không tỉ lệ thuận với sức tạ bạn nâng mà tỉ lệ thuận với cách bạn nỗ lực nâng chúng đến mức nào" - Joe Manganlello.
                            </div>
                        </div>
                        <div class="button"><a href="{{route('select_login')}}" class="btn custom-button" data-title="Join With Us">Tham gia ngay</a></div>
                    </div>
                </div>
                <!-- direction 3 -->
                <div id="slider-direction-3" class="t-cn slider-direction">
                    <div class="slider-progress"></div>
                    <div class="slider-content t-cn s-tb slider-3">
                        <div class="title-container s-tb-c title-compress">
                            <div data-wow-delay="0.1s" data-wow-duration="1s" class="tp-caption big-title rs-title customin customout bg-sld-cp-primary ">Gym <span>Star</span>
                            </div>
                            <div data-wow-delay="0.2s" data-wow-duration="2s" class="tp-caption small-content customin customout rs-title-small bg-sld-cp-primary tp-resizeme rs-parallaxlevel-0 ">
                            "Tự hào về những gì bạn đã làm được. Sau tất cả, nếu nó dễ thì ai cũng làm rồi. Hãy chiến đấu thầm lặng với những người xung quanh bạn. Hãy là người chăm chỉ đến phòng Gym nhất tuần này".
                            </div>
                        </div>
                        <div class="button"><a href="{{route('select_login')}}" class="btn custom-button" data-title="Join With Us">Tham gia ngay</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End slider area-->
        <!-- Service 1 Area Start Here -->
        <div class="service1-area">
            <div class="container-fluid">
                <div class="row no-gutter service1-wrapper">
                @foreach($course_types as $course_type)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="service1-box">
                            <a href="#"><span class="flaticon-gym"></span></a>
                            <h3 class="title-bar"><a>{{$course_type->course_type_name}}</a></h3>
                            <p>{!!$course_type->description!!}</p>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <!-- Service 1 Area End Here -->
        <!-- Start being body builder area -->
        <div class="being-body-builder2">
            <div class="side-text"><span>Gym</span> Star</div>
            <div class="container">
                <div class="being-body-builder2-wrapper">
                    <div class="being-content">
                        <span>Giới thiệu về</span>
                        <h2><span>Gym</span> Star</h2>
                        <p>Đội ngũ huấn luyện viên chuyên nghiệp với tinh thần trách nhiệm đặt lên hàng đầu. Môi trường thân thiện, thoải mái. Giáo án luôn luôn đổi mới.</p>
                        <a class="btn sign-button" href="{{route('select_login')}}">Đăng ký ngay</a>
                    </div>
                    <div class="being-right-img">
                        <img src="img/being-builder.png" alt="being-builder">
                    </div>
                </div>
            </div>
        </div>
        <!-- End being body builder area -->
        <!-- Start feature classes area -->
        <div class="feature-classes-area bg-secondary">
            <div class="container">
                <h2 class="section-title-default title-bar-high">KHÓA TẬP MỚI</h2>
                <p class="sub-title-default">Mùa hè trở nên sôi động hơn khi đến với GymStar. Trở lại sau mùa dịch</p>
                <div class="row">
                    <div class="gym-carousel dot-control-textPrimary" data-loop="true" data-items="3" data-margin="0" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="3" data-r-large-nav="false" data-r-large-dots="true">
                        @foreach($new_courses as $new_course)
                        <div class="single-product-classes2">
                            <div class="single-product hvr-bounce-to-bottom">
                                <a><img class="img-responsive" width="345" heigth="220" src="upload/course/photo/{{$new_course->photo}}" ></a>
                                <div class="overlay-btn">
                                    <a target="_blank" href="{{ route('page-course-detail',['id'=>$new_course->id]) }}" class="btn-details">Xem Ngay</a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a target="_blank" href="{{ route('page-course-detail',['id'=>$new_course->id]) }}">{{$new_course->course_name}}</a></h3>
                                <ul>
                                    <li><i class="fa fa-user" aria-hidden="true"></i>{{$new_course->trainer->full_name}}</li>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>{{\Carbon\Carbon::parse($new_course->start_time)->format('d/m/Y')}}</li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End feature product area -->
        <!-- Start class schedule area -->
        <div class="class-schedule">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="section-title-white title-bar-high">Lịch Tập</h2>
                        <p class="sub-title-white">Lịch tập của các khóa trong tháng</p>
                        <!-- schedule here -->
                            <div class="card card-primary">
                                <div class="card-body p-0">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div>
                            <!-- /.card-body -->
                            </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End class schedule area -->
        <!-- Start Expert trainers area -->
        <div class="expert-trainer-area nav-on-hover">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="section-title-default title-bar-high">HUẤN LUYỆN VIÊN</h2>
                        <p class="sub-title-default">Đội ngũ huấn luyện viên chuyên nghiệp, tinh thần trách nhiệm với công việc, sẽ giúp đỡ các bạn trong quá trình tập luyện</p>
                        <div class="gym-carousel nav-control-middle" data-loop="true" data-items="3" data-margin="15" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="3" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="4" data-r-medium-nav="true" data-r-medium-dots="false" data-r-large="4" data-r-large-nav="true" data-r-large-dots="false">
                            @foreach($trainers as $trainer)
                            <div class="trainer-box">
                                <div class="trainer-box-wrapper">
                                    <div class="trainer-img-holder">
                                        <img src="upload/trainer/photo/{{$trainer->photo}}" class="img-responsive" alt="team">
                                        <div class="trainer-title-holder">
                                            <h3>{{$trainer->full_name}}</h3>
                                            <h4>{{$trainer->course_type->course_type_name}}</h4>
                                        </div>
                                    </div>
                                    <div class="trainer-content-holder">
                                        <div class="trainer-inner-content">
                                            <h3><a target="_blank" href="{{route('page-trainer-detail',['id'=>$trainer->id])}}">{{$trainer->full_name}}</a></h3>
                                            <h4>{{$trainer->course_type->course_type_name}}</h4>
                                            <p> {!!$trainer->description!!}</p>
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
                                <a class="custom-button" data-title="Đăng Ký Thành Viên" href="{{route('page-course-detail',['id'=>$course_max_discount->id])}}">Đăng ký thành viên</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Fitness class summer area -->
        <!-- Start latest news area -->
        <div class="latest-news-area bg-secondary">
            <div class="container">
                <h2 class="section-title-default title-bar-high">Thông báo mới nhất</h2>
                <p class="sub-title-default"></p>
            </div>
            <div class="container">
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="single-latest-news2">
                            <div class="single-news">
                                <div class="single-image hvr-shutter-out-horizontal">
                                    <img src="upload/post/photo/{{$post->photo}}" alt="news1" class="img-responsive">
                                </div>
                                <div class="date">{{\Carbon\Carbon::parse($post->created_at)->format('d')}}
                                    <br>{{\Carbon\Carbon::parse($post->created_at)->format('M')}}
                                    <br>{{\Carbon\Carbon::parse($post->created_at)->format('Y')}}</div>
                            </div>
                            <div class="news-content">
                                <h3><a href="{{route('page-post-detail',['id'=>$post->id])}}">{{$post->title}}</a></h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
<!--  -->
        <!-- Start feature classes area -->
        <div class="feature-classes-area nav-on-hover">
            <div class="container">
                <div class="section-title">
                    <h2>Bài Tập Mới</h2>
                </div>
            </div>
            <div class="container">
                <div class="gym-carousel nav-control-top" data-loop="true" data-items="3" data-margin="15" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="2" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="3" data-r-medium-nav="true" data-r-medium-dots="false" data-r-large="3" data-r-large-nav="true" data-r-large-dots="false">
                @foreach($exercises as $exercise)
                <div class="single-product-classes">
                        <div class="single-product">
                            <video class="img-responsive" controls>
                                <source src="upload/exercise/video/{{$exercise->video}}">
                            </video>
                        </div>
                        <div class="product-content">
                            <h3>Nhóm Cơ: <a href="#">{{$exercise->exercise_type->exercise_type_name}}</a></h3>
                            <h3>Huấn Luyện viên: <a href="{{route('page-trainer-detail',['id'=>$exercise->trainer->id])}}">{{  $exercise->trainer->full_name}}</a> </h3>
                            <h3>{{$exercise->exercise_name}}</h3>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <!-- End feature product area -->
<!--  -->
        <div class="latest-news-area bg-secondary">
            <div class="container">
                <h2 class="section-title-default title-bar-high">Bài viết mới nhất</h2>
                <p class="sub-title-default"></p>
            </div>
            <div class="container">
                <div class="row">
                    @foreach($trainer_posts as $trainer_post)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="single-latest-news2">
                            <div class="single-news">
                                <div class="single-image hvr-shutter-out-horizontal">
                                    <img src="upload/trainerpost/photo/{{$trainer_post->photo}}" alt="news1" class="img-responsive">
                                </div>
                                <div class="date">{{\Carbon\Carbon::parse($trainer_post->created_at)->format('d')}}
                                    <br>{{\Carbon\Carbon::parse($trainer_post->created_at)->format('M')}}
                                    <br>{{\Carbon\Carbon::parse($trainer_post->created_at)->format('Y')}}</div>
                            </div>
                            <div class="news-content">
                                <h3><a href="{{ route('page-trainer-post-detail',['id'=>$trainer_post->id])}}">{{$trainer_post->title}}</a></h3>
                                <p>{{$trainer_post->preview}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End latest news area -->
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
                            <h3>{{$course->price *1}}<span> vnđ</span></h3>
                            <ul>
                                <li>{{$course->course_type->course_type_name}}</li>
                                <li><span>Giảm Giá: </span>{{$course->discount *100}} <span>%</span></li>
                            </ul>
                            <a class="custom-button" data-title="Xem Ngay" target="_blank" href="{{route('page-course-detail',['id'=>$course->id])}}">Xem Ngay</a>
                        </div>
                    </div>                    
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Price Table area -->
    </div>
    <!-- End wrapper -->
@endsection
@section('scripts')
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('css/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('css/plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('css/plugins/fullcalendar-daygrid/main.min.js') }}"></script>
<script src="{{ asset('css/plugins/fullcalendar-timegrid/main.min.js') }}"></script>
<script src="{{ asset('css/plugins/fullcalendar-interaction/main.min.js') }}"></script>
<script src="{{ asset('css/plugins/fullcalendar-bootstrap/main.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('css/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $(document).ready(function() {
    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#calendar'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('calendar');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        console.log(eventEl);
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      'themeSystem': 'bootstrap',
      //Random default events
      events    : [
        @foreach($lessions as $lession)
        {
          id    : '{{$lession->id}}',
          title : '{{$lession->course->course_name}}',
          start : new Date('{{$lession->start_time}}'),
          end   : new Date('{{$lession->end_time}}'),
          backgroundColor: '{{$lession->course->color}}', //yellow
          borderColor    : '{{$lession->course->color}}' //yellow
        },
        @endforeach
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      eventClick: function(event) {

      },
    });
    calendar.render();
});
</script>
@endsection