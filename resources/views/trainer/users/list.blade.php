<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Trang Quản Lý</title>
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

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!-- Exercise Type start -->
          <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Loại Bài Tập
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Loại Bài Tập</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Loại Bài Tập</p>
                </a>
              </li>
            </ul>
          </li>
        <!-- Exercise Type end -->
        <!-- Exercise Type start -->
          <li class="nav-item has-treeview">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 Bài Tập
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Bài Tập</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Bài Tập</p>
                </a>
              </li>
            </ul>
          </li>
        <!-- Exercise Type end -->
    </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Content Here -->
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