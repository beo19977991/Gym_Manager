@extends('admin.layouts.app', ['title' => 'Danh sách khóa tập'])
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
                <table id="example2" class="table table-bordered table-hover myTable">
                  <thead>
                  <tr>
                    <th>Tên Loại Khóa Tập</th>
                    <th>Huấn Luyện Viên</th>
                    <th>Tên Khóa Tập</th>
                    <th>Mô Tả</th>
                    <th>Giá</th>
                    <th>Giảm Giá</th>
                    <th>Ảnh</th>
                    <th>Sửa|Xóa</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($courses as $course)
                  <tr>
                    <td><a target="_blank" href="#">{{$course->course_type->course_type_name}}</a></td>
                    <td><a target="_blank" href="">{{$course->trainer->full_name}}</a></td>
                    <td><a target="_blank" href="">{{$course->course_name}}</a></td>
                    <td>{!!$course->description!!}</td>
                    <td>{{$course->price}}</td>
                    <td>{{$course->discount}}</td>
                    <td><img style="width:150px;height:100px" src="upload/course/photo/{{$course->photo}}"></td>
                    <td><i class="ion-paintbrush" ></i> &nbsp;<a href="{{ route('admin-edit-course',['id'=>$course->id])}}">Sửa</a></br>
                    <i class="ion-ios-trash"></i> &nbsp;<a href="{{ route('admin-delete-course',['id'=>$course->id])}}" data-method="DELETE" data-confirm="Bạn chắc chắn muốn xóa {{$course->course_name}}" class="delete">Xóa</a></td>
                  </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Tên Loại Khóa Tập</th>
                    <th>Huấn Luyện Viên</th>
                    <th>Tên Khóa Tập</th>
                    <th>Mô Tả</th>
                    <th>Giá</th>
                    <th>Giảm Giá</th>
                    <th>Ảnh</th>
                    <th>Sửa|Xóa</th>
                  </tr>
                  </tfoot>
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
      $('.myTable tr').filter(function() {
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
  });
</script>
@endsection