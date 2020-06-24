<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GymStar | Đăng Nhập</title>
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
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
  <div class="login-logo">
    <b>Lựa chọn đăng nhập</b>
  </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>
      <form action="{{route('post_select_login')}}" method="POST">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-sm-6">
            <!-- radio -->
            <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="select_login" checked value = "1">
                <label class="form-check-label">Khách Hàng</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="select_login" value = "2">
                <label class="form-check-label">Huấn Luyện Viên</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="select_login" value = "3">
                <label class="form-check-label">Nhân Viên</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="select_login" value = "4">
                <label class="form-check-label">Quản Trị Viên</label>
            </div>
            </div>
        </div>
        <div class="row">
        <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Xác nhận</button>
            </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="css/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="css/dist/js/adminlte.min.js"></script>

</body>
</html>
