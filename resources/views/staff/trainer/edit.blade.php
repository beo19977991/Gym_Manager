@extends('staff.layouts.app', ['title' => 'Edit Trainer'])
@section('styles')
  <base href="{{asset(' ')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('css/plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sửa Thông Tin Huấn Luyện Viên</h3>
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
              <form action="{{route('staff-edit-trainer',['id'=>$trainer->id])}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="card-body">
                  <div class="form-group">
                    <label>Họ và Tên</label>
                    <input type="text" name="full_name" class="form-control" id="full_name" value="{{$trainer->full_name}}">
                  </div>
                  <div class="form-group">
                    <label>Môn Dạy</label>
                      <select class="form-control" name="course_type" id="course_type">
                        @foreach($course_types as $course_type)
                          <option
                          @if($trainer->course_type->id == $course_type->id)
                          {{"selected"}}
                          @endif
                          value = "{{$course_type->id}}">{{$course_type->course_type_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{$trainer->email}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" value = "{{$trainer->password}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nhập lại mật khẩu</label>
                    <input type="password" name="repeat_password" class="form-control" id="exampleInputPassword1" value = "{{$trainer->password}}">
                  </div>
                  <div class="form-group">
                    <label>Tuổi</label>
                    <input type="text" name="age" class="form-control" id="age" value ="{{$trainer->age}}">
                  </div>
                  <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" id="address" value ="{{$trainer->address}}">
                  </div>
                  <div class="form-group">
                    <label>Hình đại diện</label>
                    <p><img style ="width:400px; height:200px" src="upload/trainer/photo/{{$trainer->photo}}" ></p>
                    <input class="form-control" type="file" name="photo" accept="image/*"  onchange="showMyImage(this)">
                  </div>
                  <div class="form-group">
                    <label>Mô tả</Label>
                    <div class="mb-3">
                      <textarea class="textarea" name ="description"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      {!!$trainer->description!!}
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <img id="thumbnil" style="width:20%; margin-top:10px;"  src="" alt="image"/>
                  </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                        <input class="form-check-input" type="radio" name="gender" @if($trainer->gender == 1){{"checked"}}@endif value="1" id="male">
                            <label class="form-check-label">Nam</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="radio" name="gender" @if($trainer->gender == 2){{"checked"}}@endif value="2" id="female">
                            <label class="form-check-label">Nữ</label>
                        </div>
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
    $('.textarea').summernote();
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