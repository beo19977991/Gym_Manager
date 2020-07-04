@extends('trainer.layouts.app', ['title' => 'Add Exercise Type'])
@section('styles')
  <base href="{{asset(' ')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('css/plugins/summernote/summernote-bs4.css')}}">

@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm Loại Bài Tập</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
              <li class="breadcrumb-item active">{{$trainer_login->full_name}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm Loại Bài Tập</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
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
              <form action="{{route('trainer-add-exercise-type')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="card-body">
                  <div class="form-group">
                    <label>Tên Loại Khóa Tập</label>
                    <select class="form-control" name="course_type" id="course_type">
                      @foreach($course_types as $course_type)
                        <option value = "{{$course_type->id}}">{{$course_type->course_type_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tên Loại Bài Tập</label>
                    <input type="text" name="exercise_type_name" class="form-control" id="full_name" placeholder="Nhập tên loại bài tập">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- Summernote -->
<script src="css/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
@endsection