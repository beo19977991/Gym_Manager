<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin-{{$title}}</title>
  <base href="{{asset('')}}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('css/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
@include('admin.layouts.header')
@include('admin.layouts.right')
@yield('content')
@include('admin.layouts.footer')
</div>
<!-- jQuery -->
<script src="{{ asset('css/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('css/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('css/dist/js/adminlte.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('css/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
<!-- OPTIONAL SCRIPTS -->

<script src="{{ asset('css/dist/js/demo.js') }}"></script>
<script src="{{ asset('css/dist/js/pages/dashboard3.js') }}"></script>
@yield('scripts')
</body>
</html>