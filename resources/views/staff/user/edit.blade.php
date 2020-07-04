@extends('staff.layouts.app', ['title' => 'Edit User'])
@section('content')
<!-- Content Here -->
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
                <h3 class="card-title">Sửa Thông Tin Khách Hàng</h3>
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
              <form action="{{route('staff-get-edit-user',['id'=>$user->id])}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="card-body">
                  <div class="form-group">
                    <label>Họ và Tên</label>
                    <input type="text" name="full_name" class="form-control" id="full_name" value="{{$user->full_name}}">
                  </div>
                  <div class="form-group">
                        <label>Khóa Học</label>
                        <select class="form-control" name="course" id="course">
                          @foreach($courses as $course)
                          <option
                            @if($user->course_id == $course->id && $user->course_id != 0)
                            {{"selected"}}
                            @endif
                            value = "{{$course->id}}">{{$course->course_name}}</option>
                          @endforeach
                        </select>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{$user->email}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" value = "{{$user->password}}">
                  </div>
                  <div class="form-group">
                    <label>Tuổi</label>
                    <input type="text" name="age" class="form-control" id="age" value ="{{$user->age}}">
                  </div>
                  <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" id="address" value ="{{$user->address}}">
                  </div>
                  <div class="form-group">
                    <label>Hình đại diện</label>
                    <p><img style ="width:400px; height:200px" src="upload/user/photo/{{$user->photo}}" ></p>
                    <input class="form-control" type="file" name="photo" accept="image/*"  onchange="showMyImage(this)">
                  </div>
                  <div class="form-group">
                    <img id="thumbnil" style="width:20%; margin-top:10px;"  src="" alt="image"/>
                  </div>
                  <div class="form-group">
                      <div class="custom-control custom-radio">
                      <input class="form-check-input" type="radio" name="gender" @if($user->gender == 1){{"checked"}}@endif value="1" id="male">
                          <label class="form-check-label">Nam</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="gender" @if($user->gender == 2){{"checked"}}@endif value="2" id="female">
                          <label class="form-check-label">Nữ</label>
                      </div>
                  </div>    
                  <div class="form-group">
                    <label>Giá khóa tập</label>
                    <input type="text" name="price" id="price" class="form-control" disabled 
                    @if($user->course_id == 0 )
                      value="0 vnđ"
                    @else
                      value ="{{$user->course->price * 1 }} vnđ">
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Giảm giá</label>
                    <input type="text" name="discount" id="discount" class="form-control" disabled 
                    @if($user->course_id == 0)
                      value = "0 %"
                    @else
                      value="{{$user->course->discount * 100}} %">
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Giá phải trả</label>
                    <input type="text" name="cost" id="cost" class="form-control" disabled 
                    @if($user->course_id == 0)
                    value="0 vnđ"
                    @else
                    value="{{$user->course->price * (1 - $user->course->discount)}} vnd">
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Thanh Toán</label>
                    <div class="custom-control custom-radio">
                      <input class="form-check-input" type="radio" name="status" @if($user->status == 1){{"checked"}}@endif value="1" id="paid">
                          <label class="form-check-label">Đã thanh toán</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="status" @if($user->status == 0){{"checked"}}@endif value="0" id="unpaid">
                          <label class="form-check-label">Chưa thanh toán</label>
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
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(function(){
    $('#course').change(function(){
      var course_id = $(this).val();
      $.get("manager/ajax/edit_user/"+course_id,function(data){
        let price = data.price * 1;
        let discount = data.discount;
        let cost = price * (1-discount);
        $('#price').val(price+" vnđ");
        $('#discount').val(discount+" %");
        $('#cost').val(cost+" vnđ");
      });
    });
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