<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Trang Cá Nhân</title>
  <base href="{{asset('')}}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('css/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-daygrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-timegrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-bootstrap/main.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
@include('admin.layouts.header')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('page-home')}}" class="brand-link">
      <img src=""  class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">GymSTar</span>
    </a>
</aside>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Trang Cá Nhân</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="upload/user/photo/{{$user->photo}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->full_name}}</h3>
                <p class="text-muted text-center">Mã Khách Hàng: {{$user->id}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Ngày Tham gia</b> <a class="float-right">{{\Carbon\Carbon::parse($user->created_at)->format('d-m-Y')}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Khóa Tập</b> 
                        @if($user->course_id ==0)
                        <a class="float-right">Chưa Tham Gia</a>
                        @else
                        <a class="float-right">{{$user->course->course_name}}</a>
                        @endif
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thông tin khác</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-mail-bulk mr-1"></i> Email</strong>

                <p class="text-muted">
                  {{$user->email}}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Địa Chỉ</strong>

                <p class="text-muted">{{$user->address}}</p>

                <hr>

                <strong><i class="fas fa-transgender mr-1"></i> Giới Tính</strong>
                    @if($user->gender == 1)
                    <p class="text-muted">Nam</p>
                    @else
                    <p class="text-muted">Nữ</p>
                    @endif
                <hr>

                <strong><i class="far fa-question-circle mr-1"></i> Tuổi</strong>

                <p class="text-muted">{{$user->age}}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Hoạt động</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Lịch sử</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Thay đổi thông tin cá nhân</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                      <div class="post">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="upload/user/photo/{{$user->photo}}" alt="user image">
                          <span class="username">
                            <a href="#">{{$user->full_name}}</a>
                          </span>
                          <span class="description">Khóa Tập đang tham gia - <a href="{{route('page-course-detail',['id'=>$user->course_id])}}" target="_blank" rel="noopener noreferrer">{{$user->course->course_name}}</a></span>
                          <span class="description">Bắt đầu - {{ \Carbon\Carbon::parse($user->course->start_time)->format('d-m-Y') }} Kết thúc - {{ \Carbon\Carbon::parse($user->course->end_time)->format('d-m-Y') }}</span>
                        </div>
                        <!-- /.user-block -->
                        <p>Huấn Luyện Viên - <a href="{{route('page-trainer-detail',['id'=>$user->course->trainer->id])}}" target="_blank" rel="noopener noreferrer">{{$user->course->trainer->full_name}}</a></p>
                        <p>
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
                        </p>
                      </div>
                    <!-- /.post -->
                  </div>
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      @foreach($histories as $history)
                        @if($history->status == 1)
                        <div class="time-label">
                            <span class="bg-primary">
                            {{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y') }}
                            </span>
                        </div>
                        <div>
                          <i class="fas fa-user bg-info"></i>
                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($history->created_at)->format('H:i:s') }}</span>
                            <h3 class="timeline-header border-0"><a href="#">{{$user->full_name}}</a> Đã Đăng ký khóa tập {{$history->course->course_name}}
                            </h3>
                          </div>
                        </div>
                        @else
                        <div class="time-label">
                            <span class="bg-danger">
                            {{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y') }}
                            </span>
                        </div>
                        <div>
                          <i class="fas fa-user bg-info"></i>
                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($history->created_at)->format('H:i:s') }}</span>
                            <h3 class="timeline-header border-0"><a href="#">{{$user->full_name}}</a> Đã Hủy Đăng ký khóa tập {{$history->course->course_name}}
                            </h3>
                          </div>
                        </div>
                        @endif
                      @endforeach
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="settings">
                    <form action="{{route('post-user-profile',['id'=>$user->id])}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Họ Tên</label>
                        <div class="col-sm-10">
                          <input type="text" name="full_name" class="form-control" id="inputName" placeholder="Họ Tên" value="{{$user->full_name}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{$user->email}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Mật Khẩu</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" id="inputName2" placeholder="Name" value="{{$user->password}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Tuổi</label>
                        <div class="col-sm-10">
                          <input type="text" name="age" class="form-control" placeholder="Tuổi" value="{{$user->age}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Địa Chỉ</label>
                        <div class="col-sm-10">
                          <input type="text" name="address" class="form-control" placeholder="Địa Chỉ" value="{{$user->address}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Giới Tính</label>
                        <div class="custom-control custom-radio">
                        <input class="form-check-input" type="radio" name="gender" @if($user->gender == 1){{"checked"}}@endif value="1" id="male">
                            <label class="form-check-label">Nam</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="radio" name="gender" @if($user->gender == 2){{"checked"}}@endif value="2" id="female">
                            <label class="form-check-label">Nữ</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Hình Đại Diện</label>
                        <div class="col-sm-10">
                        <p><img  src="upload/user/photo/{{$user->photo}}" > &nbsp;<img id="thumbnil" style="width:38%; margin-top:10px;"  src="" alt="image"/></p>
                        <input class="form-control" type="file" name="photo" accept="image/*"  onchange="showMyImage(this)">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Thay Đổi</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@include('admin.layouts.footer')
</div>
<!-- jQuery -->
<script src="{{ asset('css/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('css/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('css/dist/js/adminlte.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('css/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
<!-- OPTIONAL SCRIPTS -->

<script src="{{ asset('css/dist/js/demo.js') }}"></script>
<script src="{{ asset('css/dist/js/pages/dashboard3.js') }}"></script>

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
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
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
  function showMyImage(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {           
      var file = files[i];
      var imageType = /image.*/;     
      if (!file.type.match(imageType)) {
          continue;
      }           
      var img=document.getElementById("thumbnil");            
          img.file = file;    
      var reader = new FileReader();
          reader.onload = (function(aImg) { 
            return function(e) { 
              aImg.src = e.target.result; 
            }; 
          })(img);
          reader.readAsDataURL(file);
    }    
  }
</script>
</body>
</html>
