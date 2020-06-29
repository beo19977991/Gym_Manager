@extends('admin.layouts.app', ['title' => 'Lịch tập chi tiết'])
@section('styles')
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-daygrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-timegrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/plugins/fullcalendar-bootstrap/main.min.css') }}">
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>{{$course->course_name}}</h1>
            <h3 id="course-start">{{$course->start_time}}</h3>
            <h3 id="course-end">{{$course->end_time}}</h3> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- modal xác nhập thêm lịch cho khóa tập -->
    <div class="modal" id="text-day-click" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lịch Tập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Ngày: </span><p class="date-click"></p>
                <span>Tên Khóa Tập: </span><p class="course_name"></p>
                <span>Thời gian bắt đầu: </span><p class="start_time" ></p>
            </div>
            <div class="modal-footer">
                <!-- <button type="submit" class="btn btn-primary" onclick="submitForm()">Save</button> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    <!-- modal xác nhập thêm lịch cho khóa tập -->
    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lịch Tập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Tên Khóa Tập: </span><p class="course_name"></p>
                <span>Thời gian bắt đầu: </span><p class="start_time" ></p>
            </div>
            <div class="modal-footer">
                <!-- <button type="submit" class="btn btn-primary" onclick="submitForm()">Save</button> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    <!-- modal cảnh báo-->
    <div class="modal wanning" id="warning" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lịch Tập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p>Ngày bạn chọn không thuộc trong phạm vi khóa học</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- end modal -->    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Danh sách Loại bài tập</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    @foreach($exercise_types as $exercise_type)
                        <div class="external-event bg-primary" onclick="getCourseId({{$exercise_type->id}})" course_id="{{$exercise_type->id}}">{{$exercise_type->exercise_type_name}}
                        </div>
                    @endforeach
                      <label for="drop-remove" style="display:none">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
                    <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        <!-- /.col -->
          </div>
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  <!-- /.content-wrapper -->
  </div>
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
    var id;
    var mindate = new Date();
    var maxdate = new Date();
    $(function () {
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

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',

      eventData: function(eventEl) {
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

      dateClick :function(info){
        console.log(info)
        var date_click = info.date;
        let daya = date_click.getFullYear() + "-" + (date_click.getMonth() + 1) + "-" + date_click.getDate();
        day = new Date(daya)
        console.log(day)
        $(".date-click").text(day);
        $('#text-day-click').modal('show');
      },
      dayRender :function(date)
      {
        var date_event = date.date;
        let day =date_event.getFullYear() + "-" + (date_event.getMonth() + 1) + "-" + date_event.getDate();
        let start_time = $('#course-start').html();
        let end_time = $('#course-end').html();
        let course_start = new Date(start_time);
        let course_end = new Date(end_time);
        var dates =date
        // console.log(dates)
        var events = calendar.getEvents();
          // events.forEach(function(event)
          // {
          //   //console.log("date: "+date)
          //   //date_start = new Date(event.start)
          //   //console.log(date_start === date.date)
          //   // {
          //   //   console.log("1")
          //   //   // date.date.el.style.background = "yellow";
          //   // }
          // });
      },
      eventReceive: function(info) {
        $(".course_name").text(info.event.title);
        let date_event = info.event.start
        let day = date_event.getFullYear() + "-" + (date_event.getMonth() + 1) + "-" + date_event.getDate()
        let time = date_event.getHours() + ":" + date_event.getMinutes(); + ":" + date_event.getSeconds();
        $(".start_time").text(day + " " + time);
        $("#modal").modal('show');
      },
    });
    calendar.render();
});
var course_id;
function submitForm() {
        let start_time = $(".start_time").text();
        $.ajax({
            url: "{{route('admin-post-create-calendar')}}",
            method: "POST",
            data: {
            course_id: course_id,
            start_time: start_time, 
            _token: "{{ csrf_token() }}"
            },
            success: function(result) {
                $(".modal").modal('hide');
            },
            error: function (err) {
                console.log("err");
            }
        })
    }
function getCourseId(id){
    course_id = id;
}
</script>
@endsection