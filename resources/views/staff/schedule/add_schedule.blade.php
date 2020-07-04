@extends('staff.layouts.app', ['title' => 'Lịch tập'])
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
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
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
                <span>Danh Sách Khóa Tập</span>
                <select name="course" id="course_id">
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="addScheduleForm()">Thêm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
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
              <h5 class="modal-title">Xác nhận</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <span>Bạn có chắc chắn muốn xóa lịch tập này cho khóa: &nbsp;</span><span class="title"></span>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary" onclick="deleteScheduleForm()">Xóa</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
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
              <div class="card" style="display:none">
                <div class="card-header">
                  <h4 class="card-title">Danh sách khóa tập</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events" >
                    @foreach($courses as $course)
                        <div class="external-event bg-primary" onclick="getCourseId({{$course->id}})" course_id="{{$course->id}}">{{$course->course_name}}
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
          <div class="col-md-9 ml-5">
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
    function deleteScheduleForm()
    {
        $.ajax({
            url: "admin/schedules/delete-schedule-calendar/" + id,
            method: "POST",
            data: {
            id : id,
            _token: "{{ csrf_token() }}"
            },
            success: function(result) {
            // console.log(result);
            $(".modal").modal('hide');

            location.reload();
            },
            error: function (err) {

            }
        })
    }
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
      dateClick: function(info) {
        console.log(info);
        let day = info.dateStr;
        let get_date_click = day.slice(0,10)
        var date_click = info.date;
        let get_time_click = date_click.getHours()+ ":" + date_click.getMinutes() + ":" +date_click.getSeconds();
        $(".date-click").text(get_date_click + " " + get_time_click);
        checDayClick(get_date_click,get_time_click);
      },
      eventClick: function(event) {
        id = event.event.id;
        $(".title").text(event.event.title);
        $("#modal").modal('show');
      },
    });
    calendar.render();
});
function addScheduleForm() {
  let mycourse_id = $("#course_id").val();
        let start_time = $(".date-click").text();
        $.ajax({
            url: "{{route('admin-post-add-schedule')}}",
            method: "POST",
            data: {
              course_id: mycourse_id,
              start_time: start_time,
              _token: "{{ csrf_token() }}"
            },
            success: function(result) {
                $("#text-day-click").modal('hide');
                location.reload();
            },
            error: function (err) {
            }
        })
    }

function checDayClick(date,time)
{
  console.log(date + " " + time );
  $('#text-day-click').modal('show');
  $.ajax({
            url: "admin/schedules/check-date-click/"+date+"/"+time,
            method: "POST",
            data: {
            _token: "{{ csrf_token() }}"
            },
            success: function(result) {
              console.log(result);
              $('#course_id').html(result);
              $('#text-day-click').modal('show');
            },
            error: function (err) {
            }
        })
}
</script>
@endsection
