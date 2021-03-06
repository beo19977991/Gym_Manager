@extends('staff.layouts.app', ['title' => 'Home'])
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Staff</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$staff_login->full_name}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
              <!-- /.card-header -->
              @if(count($errors) >0)
                        <div class ="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}</br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                @endif
              <div class="card-body">
              <input type="text" id="myInput" placeholder="Tìm theo tên">
            <table id="example2" class="table table-bordered table-hover myTable mt-3">
                  <thead>
                  <tr>
                    <th>Họ Tên</th>
                    <th>Tuổi </th>
                    <th>Địa Chỉ</th>
                    <th>Giới Tính</th>
                    <th>Khóa Học</th>
                    <th>Thời Hạn Thẻ</th>
                    <th>Hình Đại Diện</th>
                    <th>Thanh Toán</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($users as $user)
                  <tr>
                    <td><a target="_blank" href="{{ route('staff-user-detail',['id'=>$user->id]) }}">{{$user->full_name}}</a></td>
                    <td>{{$user->age}}</td>
                    <td>{{$user->address}}</td>
                    <td>
                    @if($user->gender == 1)
                    <span>Nam</span>
                    @else
                    <span>Nữ</span>
                    @endif
                    </td>
                    <td>
                        @if($user->course_id == 0)
                        <span>Chưa tham gia</span>
                        @else
                        {{$user->course->course_name}}
                        @endif
                    </td>
                    <td>
                      @if($user->course_id == 0)
                        <span>Chưa tham gia</span>
                        @else
                          @if(floor(((strtotime($user->course->end_time) - strtotime($current)))/(60*60*24)) <= 0)
                          <span class="badge badge-danger"> Khóa tập đã kết thúc {{floor((abs(strtotime($user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                          @elseif(floor(((strtotime($user->course->end_time) - strtotime($current)))/(60*60*24)) <= 5 && floor(((strtotime($user->course->end_time) - strtotime($current)))/(60*60*24)) > 0)
                          <span class="badge badge-warning"> Còn {{floor((abs(strtotime($user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                          @else
                          <span class="badge badge-primary"> Còn {{floor((abs(strtotime($user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                          @endif
                      @endif
                    </td>
                    <td class="text-center"><img class="direct-chat-img " width="50" height="50" src="upload/user/photo/{{$user->photo}}"></td>
                    <td>
                        @if($user->status == 0)
                        <span class="badge badge-danger">Chưa thanh toán</span>
                        @else
                        <span class="badge badge-success">Đã thanh toán</span>
                        @endif
                    </td>
                    <td class="text-center"><a class="ml-2" href="{{ route('staff-get-edit-user',['id'=>$user->id])}}"><i class="ion-paintbrush" ></i></a></br>
                     <a href="{{ route('staff-get-delete-user',['id'=>$user->id])}}" data-method="DELETE" data-confirm="Bạn chắc chắn muốn xóa người dùng  {{$user->full_name}}" class="delete ml-2"><i class="ion-ios-trash"></i></a></td>
                  </tr>
                @endforeach
                  </tbody>
            </table>
              </div>
          </div>
</div>
    <!-- ============= -->
@endsection
@section('scripts')
<!-- Bootstrap Switch -->
<script src="{{ asset('css/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('css/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('css/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('css/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('css/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#myInput').keyup(function(event){
      event.preventDefault();
      /* Act on the event */
      var tukhoa = $(this).val().toLowerCase();
      $('tbody tr').filter(function() {
         $(this).toggle($(this).text().toLowerCase().indexOf(tukhoa)>-1);
      });
    });
    var deleteLinks = document.querySelectorAll('.delete');
    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            var choice = confirm(this.getAttribute('data-confirm'));

            if (choice) {
                window.location.href = this.getAttribute('href');
            }
        });
    }
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  });
</script>
@endsection