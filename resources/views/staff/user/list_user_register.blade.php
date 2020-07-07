@extends('staff.layouts.app', ['title' => 'Home'])
@section('content')
<!-- Content Here -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Thống Kê</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Danh sách khách hàng đăng ký trong năm</a></li>
                  <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Danh sách khách hàng đăng ký trong tháng</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Danh sách khách hàng đăng ký trong ngày</a></li>
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">
                <div class="tab-pane" id="settings">
                    <table id="example2" class="table table-bordered table-hover myTable mt-3">
                            <thead>
                            <tr>
                                <th>Họ Tên</th>
                                <th>Tuổi </th>
                                <th>Địa Chỉ</th>
                                <th>Giới Tính</th>
                                <th>Khóa Học</th>
                                <th>Thời Hạn Thẻ</th>
                                <th>Hình Đại Diện</th>
                                <th>Thanh Toán</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($histories_year as $history_year)
                            <tr>
                                <td><a target="_blank" href="{{ route('staff-user-detail',['id'=>$history_year->user->id]) }}">{{$history_year->user->full_name}}</a></td>
                                <td>{{$history_year->user->age}}</td>
                                <td>{{$history_year->user->address}}</td>
                                <td>
                                @if($history_year->user->gender == 1)
                                <span>Nam</span>
                                @else
                                <span>Nữ</span>
                                @endif
                                </td>
                                <td>
                                    @if($history_year->user->course_id == 0)
                                    <span>Chưa tham gia</span>
                                    @else
                                    {{$history_year->user->course->course_name}}
                                    @endif
                                </td>
                                <td>
                                @if($history_year->user->course_id == 0)
                                    <span>Chưa tham gia</span>
                                    @else
                                    @if(floor(((strtotime($history_year->user->course->end_time) - strtotime($current)))/(60*60*24)) <= 0)
                                    <span class="badge badge-danger"> Khóa tập đã kết thúc {{floor((abs(strtotime($history_year->user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                                    @elseif(floor(((strtotime($history_year->user->course->end_time) - strtotime($current)))/(60*60*24)) <= 5 && floor(((strtotime($history_year->user->course->end_time) - strtotime($current)))/(60*60*24)) > 0)
                                    <span class="badge badge-warning"> Còn {{floor((abs(strtotime($history_year->user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                                    @else
                                    <span class="badge badge-primary"> Còn {{floor((abs(strtotime($history_year->user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                                    @endif
                                @endif
                                </td>
                                <td class="text-center"><img class="direct-chat-img " width="50" height="50" src="upload/user/photo/{{$history_year->user->photo}}"></td>
                                <td>
                                    @if($history_year->user->status == 0)
                                    <span class="badge badge-danger">Chưa thanh toán</span>
                                    @else
                                    <span class="badge badge-success">Đã thanh toán</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                <div class="active tab-pane" id="activity">
                    <table id="example2" class="table table-bordered table-hover myTable mt-3">
                        <thead>
                        <tr>
                            <th>Họ Tên</th>
                            <th>Tuổi </th>
                            <th>Địa Chỉ</th>
                            <th>Giới Tính</th>
                            <th>Khóa Học</th>
                            <th>Thời Hạn Thẻ</th>
                            <th>Hình Đại Diện</th>
                            <th>Thanh Toán</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($histories_month as $history_month)
                        <tr>
                            <td><a target="_blank" href="{{ route('staff-user-detail',['id'=>$history_month->user->id]) }}">{{$history_month->user->full_name}}</a></td>
                            <td>{{$history_month->user->age}}</td>
                            <td>{{$history_month->user->address}}</td>
                            <td>
                            @if($history_month->user->gender == 1)
                            <span>Nam</span>
                            @else
                            <span>Nữ</span>
                            @endif
                            </td>
                            <td>
                                @if($history_month->user->course_id == 0)
                                <span>Chưa tham gia</span>
                                @else
                                {{$history_month->user->course->course_name}}
                                @endif
                            </td>
                            <td>
                            @if($history_month->user->course_id == 0)
                                <span>Chưa tham gia</span>
                                @else
                                @if(floor(((strtotime($history_month->user->course->end_time) - strtotime($current)))/(60*60*24)) <= 0)
                                <span class="badge badge-danger"> Khóa tập đã kết thúc {{floor((abs(strtotime($history_month->user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                                @elseif(floor(((strtotime($history_month->user->course->end_time) - strtotime($current)))/(60*60*24)) <= 5 && floor(((strtotime($history_month->user->course->end_time) - strtotime($current)))/(60*60*24)) > 0)
                                <span class="badge badge-warning"> Còn {{floor((abs(strtotime($history_month->user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                                @else
                                <span class="badge badge-primary"> Còn {{floor((abs(strtotime($history_month->user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                                @endif
                            @endif
                            </td>
                            <td class="text-center"><img class="direct-chat-img " width="50" height="50" src="upload/user/photo/{{$history_month->user->photo}}"></td>
                            <td>
                                @if($history_month->user->status == 0)
                                <span class="badge badge-danger">Chưa thanh toán</span>
                                @else
                                <span class="badge badge-success">Đã thanh toán</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover myTable mt-3">
                        <tr>
                            <td><span class="badge badge-primary">Doanh thu</span></td>
                            <td>{{$price_year}} vnđ</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-danger">Thực tế thu được</span></td>
                            <td>{{$collected_year}} vnđ</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-warning">Số Tiền Còn Lại</span></td>
                            <td>{{$price_year - $collected_year}} vnđ</td>
                        </tr>
                    </table>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                  <table id="example2" class="table table-bordered table-hover myTable mt-3">
                        <thead>
                        <tr>
                            <th>Họ Tên</th>
                            <th>Tuổi </th>
                            <th>Địa Chỉ</th>
                            <th>Giới Tính</th>
                            <th>Khóa Học</th>
                            <th>Thời Hạn Thẻ</th>
                            <th>Hình Đại Diện</th>
                            <th>Thanh Toán</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($histories_day as $history_day)
                        <tr>
                            <td><a target="_blank" href="{{ route('staff-user-detail',['id'=>$history_day->user->id]) }}">{{$history_day->user->full_name}}</a></td>
                            <td>{{$history_day->user->age}}</td>
                            <td>{{$history_day->user->address}}</td>
                            <td>
                            @if($history_day->user->gender == 1)
                            <span>Nam</span>
                            @else
                            <span>Nữ</span>
                            @endif
                            </td>
                            <td>
                                @if($history_day->user->course_id == 0)
                                <span>Chưa tham gia</span>
                                @else
                                {{$history_day->user->course->course_name}}
                                @endif
                            </td>
                            <td>
                            @if($history_day->user->course_id == 0)
                                <span>Chưa tham gia</span>
                                @else
                                @if(floor(((strtotime($history_day->user->course->end_time) - strtotime($current)))/(60*60*24)) <= 0)
                                <span class="badge badge-danger"> Khóa tập đã kết thúc {{floor((abs(strtotime($history_day->user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                                @elseif(floor(((strtotime($history_day->user->course->end_time) - strtotime($current)))/(60*60*24)) <= 5 && floor(((strtotime($history_day->user->course->end_time) - strtotime($current)))/(60*60*24)) > 0)
                                <span class="badge badge-warning"> Còn {{floor((abs(strtotime($history_day->user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                                @else
                                <span class="badge badge-primary"> Còn {{floor((abs(strtotime($history_day->user->course->end_time) - strtotime($current)))/(60*60*24))}} ngày</span>
                                @endif
                            @endif
                            </td>
                            <td class="text-center"><img class="direct-chat-img " width="50" height="50" src="upload/user/photo/{{$history_day->user->photo}}"></td>
                            <td>
                                @if($history_day->user->status == 0)
                                <span class="badge badge-danger">Chưa thanh toán</span>
                                @else
                                <span class="badge badge-success">Đã thanh toán</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover myTable mt-3">
                        <tr>
                            <td><span class="badge badge-primary">Doanh thu</span></td>
                            <td>{{$price_day}} vnđ</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-success">Thực tế thu được</span></td>
                            <td>{{$collected_day}} vnđ</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-warning">Số Tiền Còn Lại</span></td>
                            <td>{{$price_day - $collected_day}} vnđ</td>
                        </tr>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
</div>
@endsection