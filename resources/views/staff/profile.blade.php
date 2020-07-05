@extends('staff.layouts.app', ['title' => 'Add User'])
@section('content')
<!-- Content Here -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Trang Cá Nhân</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="upload/staff/photo/{{$staff->photo}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$staff->full_name}}</h3>
                <p class="text-muted text-center">Mã Nhân Viên: {{$staff->id}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Ngày Tham gia</b> <a class="float-right">{{\Carbon\Carbon::parse($staff->created_at)->format('d-m-Y')}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thông tin khác</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-mail-bulk mr-1"></i> Email</strong>

                <p class="text-muted">
                  {{$staff->email}}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Địa Chỉ</strong>

                <p class="text-muted">{{$staff->address}}</p>

                <hr>

                <strong><i class="fas fa-transgender mr-1"></i> Giới Tính</strong>
                    @if($staff->gender == 1)
                    <p class="text-muted">Nam</p>
                    @else
                    <p class="text-muted">Nữ</p>
                    @endif
                <hr>

                <strong><i class="far fa-question-circle mr-1"></i> Tuổi</strong>

                <p class="text-muted">{{$staff->age}}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                      Hiện Lịch sử tập luyện ở đây
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="settings">
                    <form action="{{route('post-staff-profile',['id'=>$staff->id])}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Họ Tên</label>
                        <div class="col-sm-10">
                          <input type="text" name="full_name" class="form-control" id="inputName" placeholder="Họ Tên" value="{{$staff->full_name}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{$staff->email}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Mật Khẩu</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" id="inputName2" placeholder="Name" value="{{$staff->password}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Tuổi</label>
                        <div class="col-sm-10">
                          <input type="text" name="age" class="form-control" placeholder="Tuổi" value="{{$staff->age}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Địa Chỉ</label>
                        <div class="col-sm-10">
                          <input type="text" name="address" class="form-control" placeholder="Địa Chỉ" value="{{$staff->address}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Giới Tính</label>
                        <div class="custom-control custom-radio">
                        <input class="form-check-input" type="radio" name="gender" @if($staff->gender == 1){{"checked"}}@endif value="1" id="male">
                            <label class="form-check-label">Nam</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="radio" name="gender" @if($staff->gender == 2){{"checked"}}@endif value="2" id="female">
                            <label class="form-check-label">Nữ</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Hình Đại Diện</label>
                        <div class="col-sm-10">
                        <p><img  src="upload/staff/photo/{{$staff->photo}}" > &nbsp;<img id="thumbnil" style="width:38%; margin-top:10px;"  src="" alt="image"/></p>
                        <input class="form-control" type="file" name="photo" accept="image/*"  onchange="showMyImage(this)">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Thay Đổi</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('scripts')
<script>
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