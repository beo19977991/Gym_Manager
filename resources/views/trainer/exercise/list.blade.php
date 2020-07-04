@extends('trainer.layouts.app', ['title' => 'Exercise'])
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Trainer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
              <input type="text" id="myInput" placeholder="Tìm theo tên">
                <table id="example2" class="table table-bordered table-hover myTable mt-3">
                  <thead>
                  <tr>
                    <th>Tên Loại Bài Tập</th>
                    <th>Tên Bài Tập</th>
                    <th>Huấn Luyện Viên</th>
                    <th>Video</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($exercises as $exercise)
                  <tr>
                    <td><a target="_blank" href="#">{{$exercise->exercise_type->exercise_type_name}}</a></td>
                    <td>{{$exercise->exercise_name}}</td>
                    <td>{{$exercise->trainer->full_name}}</td>
                    <td><video src="upload/exercise/video/{{$exercise->video}}" controls style="width:150px;height:100px"></video></td>
                    <td>{!!$exercise->description!!}</td>
                    <td class="text-center"><a href="{{ route('trainer-edit-exercise',['id'=>$exercise->id])}}"><i class="ion-paintbrush" ></i></a>
                    <a href="{{ route('trainer-delete-exercise',['id'=>$exercise->id])}}" data-method="DELETE" data-confirm="Bạn chắc chắn muốn xóa {{$exercise->exercise_name}}" class="delete ml-2"><i class="ion-ios-trash"></i> </a></td>
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