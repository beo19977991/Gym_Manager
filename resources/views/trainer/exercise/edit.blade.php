@extends('trainer.layouts.app', ['title' => 'Sửa Bài tập'])
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
            <h1>Sửa Bài Tập</h1>
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
                <h3 class="card-title">Sửa Bài Tập</h3>
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
              <form action="{{route('trainer-edit-exercise',['id'=>$exercise->id])}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="card-body">
                <div class="form-group">
                    <label>Tên Loại Bài Tập</label>
                    <select class="form-control" name="exercise_type" id="exercise_type">
                      @foreach($exercise_types as $exercise_type)
                        <option 
                          @if($exercise->exercise_type->id == $exercise_type->id)
                          {{"selected"}}
                          @endif
                        value = "{{$exercise_type->id}}">{{$exercise_type->exercise_type_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tên Bài Tập</label>
                    <input type="text" name="exercise_name" class="form-control" id="exercise_name" placeholder="Nhập tên bài tập" value="{{$exercise->exercise_name}}">
                  </div>
                  <div class="form-group">
                    <label>Tên Huấn Luyện Viên</label>
                    <select class="form-control" name="trainer" id="trainer">
                      @foreach($trainers as $trainer)
                        <option 
                        @if($exercise->trainer->id == $trainer->id)
                          {{"selected"}}
                        @endif
                        value = "{{$trainer->id}}">{{$trainer->full_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Mô tả</Label>
                    <div class="mb-3">
                      <textarea class="textarea" name ="description"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {{$exercise->description}}
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Video</label>
                    <input class="form-control upload-video-file" type="file" name="video">
                    <video src="upload/exercise/video/{{$exercise->video}}" controls style="width:300px;height:150px"></video>
                  </div>
                  <div class="form-group">
                    <div style="display: none;" class='video-prev' class="pull-right">
                    <video height="200" width="300" class="video-preview" controls="controls"></video>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Sửa</button>
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
    $('.upload-video-file').on('change', function(){
      if (isVideo($(this).val())){
        $('.video-preview').attr('src', URL.createObjectURL(this.files[0]));
        $('.video-prev').show();
      }
      else
      {
        $('.upload-video-file').val('');
        $('.video-prev').hide();
        alert("Only video files are allowed to upload.")
      }
    });
    function isVideo(filename) {
      var ext = getExtension(filename);
      switch (ext.toLowerCase()) {
      case 'm4v':
      case 'avi':
      case 'mp4':
      case 'mov':
      case 'mpg':
      case 'mpeg':
          // etc
          return true;
      }
      return false;
    }
    function getExtension(filename) {
      var parts = filename.split('.');
      return parts[parts.length - 1];
    }
  })
</script>
@endsection