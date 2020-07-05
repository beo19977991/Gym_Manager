@extends('admin.layouts.app', ['title' => 'Sửa khóa tập'])
@section('styles')
  <base href="{{asset(' ')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('css/plugins/summernote/summernote-bs4.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('css/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sửa Khóa Tập</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
              <li class="breadcrumb-item active">{{$staff_login->full_name}}</li>
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
                <h3 class="card-title">Sửa Khóa Tập</h3>
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
              <form action="{{route('admin-edit-course',['id'=>$course->id])}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="card-body">
                  <div class="form-group">
                    <label>Tên Loại Khóa Tập</label>
                    <select class="form-control" name="course_type" id="course_type">
                      @foreach($course_types as $course_type)
                        <option 
                          @if($course_type->id == $course->course_type->id)
                          {{"selected"}}
                          @endif
                        value = "{{$course_type->id}}">{{$course_type->course_type_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tên Huấn Luyện Viên</label>
                    <select class="form-control" name="trainer" id="trainer">
                      @foreach($trainers as $trainer)
                        <option
                        @if($trainer->id == $course->trainer->id)
                        {{"selected"}}
                        @endif
                        value = "{{$trainer->id}}">{{$trainer->full_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tên Khóa Tập</label>
                    <input type="text" name="course_name" class="form-control" id="address" placeholder="Nhập Tên Khóa Tập" value="{{$course->course_name}}">
                  </div>
                  <div class="form-group">
                    <label>Mô tả</Label>
                    <div class="mb-3">
                      <textarea class="textarea" name ="description"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {!!$course->description!!}
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Giá</label>
                    <input type="text" name="price" class="form-control" id="address" placeholder="Nhập Giá Khóa Tập" value="{{$course->price}}">
                  </div>
                  <div class="form-group">
                    <label>Giảm Giá</label>
                    <input type="text" name="discount" class="form-control" id="address" placeholder="Nhập Giảm Giá Khóa Tập" value="{{$course->discount}}">
                  </div>
                  <div class="form-group">
                    <label>Start Time</label>
                      <input type="text" class="form-control" id="start_time" name="start_time" value="{{ Carbon\Carbon::parse($course->start_time)->format('Y-m-d') }}"/>
                  </div>
                  <div class="form-group">
                    <label>End Time</label>
                      <input type="text" class="form-control" id="end_time" name="end_time" value="{{ Carbon\Carbon::parse($course->end_time)->format('Y-m-d') }}" />
                  </div>
                  <div class="form-group">
                    <label>Số Lượng Khách Hàng</label>
                    <input type="text" name="number_member" class="form-control" id="address" placeholder="Nhập Số Lượng Khách Hàng" value="{{$course->number_member}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Ảnh</label>                  
                    <input class="form-control" type="file" name="photo" accept="image/*"  onchange="showMyImage(this)">
                    <img class="mt-2" style="width:150px;height:100px" src="upload/course/photo/{{$course->photo}}">
                  </div>
                  <div class="form-group mt-2">
                    <img id="thumbnil" style="width:20%; margin-top:10px;"  src="" alt="image"/>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote();
    $('#course_type').change(function(){
      var course_type_id = $(this).val();
      $.get("admin/ajax/add-trainer/"+course_type_id,function(data){
        $('#trainer').html(data);
      });
    });
    $( "#start_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#end_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
  })
  function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
</script>
@endsection