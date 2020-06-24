<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GymStar | Đăng Ký</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="css/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Đăng ký</b>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Đăng ký thành viên mới</p>

      <form action="register" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Họ Tên" name="full_name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Mật Khẩu" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="repeat_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Tuổi" name="age">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class=""></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Địa Chỉ" name="address">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="file" class="custom-file-input" placeholder="avatar" id="photo" name="photo">
          <label class="custom-file-label" for="customFile">Hình Đại Diện</label>
        </div>
        <div class="input-group mb-3">
          <div class="col-sm-6">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" checked="checked" value="1" id="male">
                <label class="form-check-label">Nam</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input class="form-check-input" type="radio" name="gender" value="2" id="female">
                <label class="form-check-label">Nữ</label>
            </div>
          </div>
        </div>
        <div class="row">
        <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
            </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="{{ route('login)}}" class="text-center">Tôi đã có tài khoản</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="css/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="css/dist/js/adminlte.min.js"></script>
</body>
</html>

