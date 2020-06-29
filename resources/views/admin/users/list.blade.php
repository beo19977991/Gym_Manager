@extends('admin.layouts.app', ['title' => 'List User'])
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ADMIN</h1>
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
                    <th>Hình Đại Diện</th>
                    <th>Thanh Toán</th>
                    <th>Hoạt Động</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($users as $user)
                  <tr>
                    <td><a target="_blank" href="#">{{$user->full_name}}</a></td>
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
                    <td class="text-center"><img class="direct-chat-img " width="50" height="50" src="upload/user/photo/{{$user->photo}}"></td>
                    <td>
                        @if($user->status == 0)
                        <span class="badge badge-danger">Chưa thanh toán</span>
                        @else
                        <span class="badge badge-success">Đã thanh toán</span>
                        @endif
                    </td>
                    <td>
                        <label class = "switch">
                            <div class ="card-body">
                                <input type="checkbox" class="switchblock" name="my-checkbox" data-bootstrap-switch user_id ="{{$user->id}}"
                                    @if($user->active == 1 )
                                    {{"checked"}}
                                    @endif
                                    />
                            </div>
                        </label>
                    </td>
                    <td class="text-center"><a href="{{ route('admin-edit-user',['id'=>$user->id])}}"><i class="ion-paintbrush" ></i></a>
                     &nbsp;<a href="{{ route('admin-delete-user',['id'=>$user->id])}}" data-method="DELETE" data-confirm="Bạn chắc chắn muốn xóa người dùng  {{$user->full_name}}" class="delete ml-2"><i class="ion-ios-trash"></i></a></td>
                  </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
          </div>
    <!-- ============= -->
  </div>
@endsection
@section('scripts')
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
    $('.switchblock').on('change',function(){
      var user_id = $(this).attr("user_id");
      $.ajax({url:"admin/ajax/user/"+user_id, success:function(data){
          $('.switchblock').html(data);
          console.log("admin/ajax/user/"+user_id);
      }});
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