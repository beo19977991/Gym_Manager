@extends('trainer.layouts.app', ['title' => 'Danh sách Bài viết'])
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Huấn Luyện Viên</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Trang chủ</a></li>
              <li class="breadcrumb-item active">{{$trainer_login->full_name}}</li>
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
              <input type="text" id="myInput" placeholder="Tìm kiếm ...">
                <table id="example2" class="table table-bordered table-hover myTable mt-3">
                  <thead>
                  <tr>
                    <th>Tên Bài Viết</th>
                    <th>Tóm Tắt</th>
                    <th>Tên Người Viết</th>
                    <th>Nội dung</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($trainer_posts as $trainer_post)
                  <tr>
                    <td><a target="_blank" href="{{route('page-trainer-post-detail',['id'=>$trainer_post->id])}}">{{$trainer_post->title}}</a></td>
                    <td>{{$trainer_post->preview}}</td>
                    <td>{{$trainer_post->trainer->full_name}}</td>
                    <td>{!!$trainer_post->body!!}</td>
                    <td><img style="width:150px;height:100px" src="upload/trainerpost/photo/{{$trainer_post->photo}}"></td>
                    <td>
                    <a class="ml-2" href="{{ route('trainer-edit-post',['id'=>$trainer_post->id])}}"><i class="ion-paintbrush" ></i></a>
                    <a href="{{ route('trainer-delete-post',['id'=>$trainer_post->id])}}" data-method="DELETE" data-confirm="Bạn chắc chắn muốn xóa {{$trainer_post->title}}" class="delete ml-2"><i class="ion-ios-trash"></i></a>
                     </td>
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