@extends('admin.layouts.app', ['title' => 'Danh sách huấn luyện viên'])
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
                    <th>Môn Dạy</th>
                    <th>Hình Đại Diện</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($trainers as $trainer)
                  <tr>
                    <td><a target="_blank" href="#">{{$trainer->full_name}}</a></td>
                    <td>{{$trainer->age}}</td>
                    <td>{{$trainer->address}}</td>
                    <td>
                      @if($trainer->gender == 1)
                      <span class="badge badge-success">Nam</span>
                      @else
                      <span class="badge badge-warning">Nữ</span>
                      @endif
                    </td>
                    <td>{{$trainer->course_type->course_type_name}}</td>
                    <td class="text-center"><img class="direct-chat-img " width="50" height="50" src="upload/trainer/photo/{{$trainer->photo}}"></td>
                    <td class="text-center"><a href="{{ route('admin-edit-trainer',['id'=>$trainer->id])}}"><i class="ion-paintbrush" ></i></a>
                     &nbsp;<a href="{{ route('admin-delete-trainer',['id'=>$trainer->id])}}" data-method="DELETE" data-confirm="Bạn chắc chắn muốn xóa huẫn luyện viên  {{$trainer->full_name}}" class="delete ml-2"><i class="ion-ios-trash"></i></a></td>
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