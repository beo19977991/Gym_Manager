@extends('layouts.app', ['title' => 'Course Detail'])
@section('styles')
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-daygrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-timegrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-bootstrap/main.min.css') }}">
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
                    <h2>Chi Tiết Khóa Tập</h2>
                </div>
                <div class="breadcrum-area">
                    <ul class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active">{{$course->course_name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Inner Banner area -->
@endsection
@section('content')
            <!-- Start details classes area -->
            <div class="classes-detail-area padding-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <div class="single-class-detail">
                                <div class="class-content">
                                    <div class="detail-img">
                                        <img  src="upload/course/photo/{{$course->photo}}" >
                                    </div>
                                    <div class="class-heading">
                                        <h3 id="course_id" value="{{$course->course_id}}">{{$course->course_name}}</h3>
                                        <ul>
                                            <li><i class="fa fa-clock-o" aria-hidden="true"></i>Thời gian bắt đầu: {{\Carbon\Carbon::parse($course->start_time)->format('d-m-Y')}}&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>Thời gian kết thúc: {{\Carbon\Carbon::parse($course->end_time)->format('d-m-Y')}}</li>
                                            <li><i class="fa fa-user" aria-hidden="true"></i>Huấn luyện viên : <a href="">{{$course->trainer->full_name}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <h3>Giới thiệu về khóa tập</h3>
                                        <p>{!!$course->description!!}</p>
                                        <h3>Giá</h3>
                                        <p>{{$course->price * 1}} vnđ</p>
                                        <h3>Ưu đãi</h3>
                                        <p>Giảm giá: {{$course->discount *100}}%</p>
                                    </div>
                                    <div class="content">
                                        <h3>Lịch Tập</h3>
                                            <!-- schedule here -->
                                            <div class="card card-primary">
                                                <div class="card-body p-0">
                                                    <!-- THE CALENDAR -->
                                                    <div id="calendar"></div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="choose-body">
                                        <h3>Mô tả Huấn luyện viên</h3>
                                        <p>{!!$course->trainer->description!!}</p>
                                        <h3>Danh Sách Khách Hàng Đã Đăng Ký</h3>
                                        <ul class="choose-list">
                                            @foreach($customers as $customer)
                                            <li><a href="">{{$customer->full_name}}</a></li>
                                            @endforeach
                                        </ul>
                                        @if(isset($user_login) && $user_login->course_id == 0 && $user_login->active == 1 &&  $course->number_member < $course->number)
                                        <a href="{{route('page-course-register',['id'=>$course->id])}}" class="custom-button" data-title="Đăng Ký Ngay">Đăng Ký Ngay</a>
                                        @elseif(isset($user_login) && $user_login->course_id == $course->id && $user_login ->status == 0)
                                        <a href="{{route('page-course-cancel-register',['id'=>$course->id])}}" class="custom-button" data-title="Hủy Đăng Ký">Hủy Đăng Ký</a>
                                        @elseif(isset($user_login) && $user_login->course_id == 0 && $user_login->active == 1 && $course->number_member >= $course->number )
                                        <a class="custom-button" data-title="Khóa Tập {{$course->course_name}} Đã Đủ Số Lượng">Khóa Tập {{$course->course_name}} Đã Đủ Số Lượng}</a>
                                        @elseif(isset($user_login))
                                        <a class="custom-button" data-title="Bạn Đã Đăng Ký Khóa Tập {{$user_login->course->course_name}}">Bạn Đã Đăng Ký Khóa Tập {{$user_login->course->course_name}}</a>
                                        @else
                                        <a class="custom-button" data-title="...">...</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Start Related classes -->
                            <div class="related-classes-area nav-on-hover padding-space">
                                <div class="section-title">
                                    <h2>Related Classes</h2>
                                </div>
                                <div class="gym-carousel nav-control-top zoom-gallery"
                                    data-loop="true"
                                    data-items="3"
                                    data-margin="15"
                                    data-autoplay="false"
                                    data-autoplay-timeout="10000"
                                    data-smart-speed="2000"
                                    data-dots="false"
                                    data-nav="true"
                                    data-nav-speed="false"
                                    data-r-x-small="1"
                                    data-r-x-small-nav="true"
                                    data-r-x-small-dots="false"
                                    data-r-x-medium="1"
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
                                    <div class="single-related-classes">
                                        <div class="classes-img">
                                            <a href="#">
                                                <img src="img/classes/yoga.jpg" alt="">
                                            </a>
                                            <div class="classes-overlay">
                                                <a class="elv-zoom" href="img/classes/yoga.jpg" title="Classic Yoga"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="classes-title">
                                            <h3><a href="single-classes.html">Classic Yoga</a></h3>
                                            <p class="date">09.00 am - 10.00 Am</p>
                                        </div>
                                    </div>
                                    <div class="single-related-classes">
                                        <div class="classes-img">
                                            <a href="#">
                                                <img src="img/classes/running.jpg" alt="">
                                            </a>
                                            <div class="classes-overlay">
                                                <a class="elv-zoom" href="img/classes/running.jpg" title="Running"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="classes-title">
                                            <h3><a href="single-classes.html">Running</a></h3>
                                            <p class="date">09.00 am - 10.00 Am</p>
                                        </div>
                                    </div>
                                    <div class="single-related-classes">
                                        <div class="classes-img">
                                            <a href="#">
                                                <img src="img/classes/meditation.jpg" alt="">
                                            </a>
                                            <div class="classes-overlay">
                                                <a class="elv-zoom" href="img/classes/meditation.jpg" title="Meditation"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="classes-title">
                                            <h3><a href="single-classes.html">Meditation</a></h3>
                                            <p class="date">09.00 am - 10.00 Am</p>
                                        </div>
                                    </div>
                                    <div class="single-related-classes">
                                        <div class="classes-img">
                                            <a href="#">
                                                <img src="img/classes/karate.jpg" alt="">
                                            </a>
                                            <div class="classes-overlay">
                                                <a class="elv-zoom" href="img/classes/karate.jpg" title="Classic Yoga"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="classes-title">
                                            <h3><a href="single-classes.html">Classic Yoga</a></h3>
                                            <p class="date">09.00 am - 10.00 Am</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Related classes -->
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="right-sidebar">
                                <div class="single-sidebar">
                                    <h3>Search</h3>
                                    <div class="sidebar-search">
                                        <input type="text" placeholder="Search here...">
                                        <span><button type="submit"><i class="fa fa-search"></i></button></span>
                                    </div>
                                </div>
                                <div class="single-sidebar">
                                    <h3>Categories</h3>
                                    <div class="categories">
                                        <ul>
                                            <li><a href="classes.html">Fitness Classes</a></li>
                                            <li><a href="classes.html">Body Building</a></li>
                                            <li><a href="classes.html">Trainer</a></li>
                                            <li><a href="classes.html">Running</a></li>
                                            <li><a href="classes.html">Yoga</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="single-sidebar">
                                    <h3>Happy Client’s</h3>
                                    <div class="happy-clients">
                                        <div class="single-clients">
                                            <p><i class="fa fa-quote-left" aria-hidden="true"></i></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntua.</p>
                                            <div class="client-heading">
                                                <h4><a href="#">Kazi Fahim</a></h4>
                                                <p>CEO PsdBoss</p>
                                            </div>
                                        </div>
                                        <div class="single-clients">
                                            <p><i class="fa fa-quote-left" aria-hidden="true"></i></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntua.</p>
                                            <div class="client-heading">
                                                <h4><a href="#">Devid Manik</a></h4>
                                                <p>CEO PsdBoss</p>
                                            </div>
                                        </div>
                                        <div class="single-clients">
                                            <p><i class="fa fa-quote-left" aria-hidden="true"></i></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntua.</p>
                                            <div class="client-heading">
                                                <h4><a href="#">Devid Hogg</a></h4>
                                                <p>CEO PsdBoss</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-sidebar sidebar-last">
                                    <div class="join-us">
                                        <img src="img/join-us.jpg" alt="">
                                        <div class="join-content">
                                            <div class="percent"><span>25%</span> off</div>
                                            <p>Dsed do eiusmod tempor incididunt.</p>
                                            <a class="custom-button" href="#" data-title="Join Us Now!">Join Us Now!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End details classes area -->
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