@extends('staff.layouts.app', ['title' => 'User'])
@section('content')
<!-- Content Here -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Thông tin khách hàng</h1>
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
                       src="upload/user/photo/{{$user->photo}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->full_name}}</h3>
                <p class="text-muted text-center">Mã khách Hàng: {{$user->id}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Ngày Tham gia</b> <a class="float-right">{{\Carbon\Carbon::parse($user->created_at)->format('d-m-Y')}}</a>
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
                  {{$user->email}}
                </p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Địa Chỉ</strong>
                <p class="text-muted">{{$user->address}}</p>
                <hr>
                <strong><i class="fas fa-transgender mr-1"></i> Giới Tính</strong>
                    @if($user->gender == 1)
                    <p class="text-muted">Nam</p>
                    @else
                    <p class="text-muted">Nữ</p>
                    @endif
                <hr>
                <strong><i class="far fa-question-circle mr-1"></i> Tuổi</strong>
                <p class="text-muted">{{$user->age}}</p>
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
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><span class="bg-primary">Thông tin</span> </a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">

                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                    @foreach($histories as $history)
                      @if($history->status == 1)
                      <div class="time-label">
                          <span class="bg-primary">
                          {{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y') }}
                          </span>
                      </div>
                      <div>
                        <i class="fas fa-user bg-info"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($history->created_at)->format('H:i:s') }}</span>
                          <h3 class="timeline-header border-0"><a href="#">{{$user->full_name}}</a> Đã Đăng ký khóa tập {{$history->course->course_name}}
                          </h3>
                        </div>
                      </div>
                      @else
                      <div class="time-label">
                          <span class="bg-danger">
                          {{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y') }}
                          </span>
                      </div>
                      <div>
                        <i class="fas fa-user bg-info"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($history->created_at)->format('H:i:s') }}</span>
                          <h3 class="timeline-header border-0"><a href="#">{{$user->full_name}}</a> Đã Hủy Đăng ký khóa tập {{$history->course->course_name}}
                          </h3>
                        </div>
                      </div>
                      @endif
                    @endforeach
                    </div>
                  </div>
                  <!-- /.tab-pane -->
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

@endsection