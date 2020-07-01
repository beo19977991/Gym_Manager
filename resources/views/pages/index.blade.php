@extends('layouts.app', ['title' => 'Home'])
@section('content')
    <!-- Start wrapper -->
    <div class="wrapper">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Preloader Start Here -->
        <div id="preloader"></div>
        <!-- Preloader End Here -->

        <!-- Start slider area  -->
        <div class="slider-area nav-slider slider2-caption slider-top-space-header4">
            <div class="bend niceties preview-2">
                <div id="ensign-nivoslider-2" class="slides">
                    <img src="img/slides/slide1.jpg" alt="image" title="#slider-direction-1" />
                    <img src="img/slides/slide2.jpg" alt="image" title="#slider-direction-2" />
                    <img src="img/slides/slide3.jpg" alt="image" title="#slider-direction-3" />
                </div>
                <!-- direction 1 -->
                <div id="slider-direction-1" class="t-cn slider-direction">
                    <!-- <div class="slider-progress"></div> -->
                    <div class="slider-content t-cn s-tb slider-1">
                        <div class="title-container s-tb-c title-compress">
                            <div data-wow-delay="0.1s" data-wow-duration="1s" class="tp-caption big-title rs-title customin customout bg-sld-cp-primary ">Gym<span> Star</span>
                            </div>
                            <div data-wow-delay="0.2s" data-wow-duration="2s" class="tp-caption small-content customin customout rs-title-small bg-sld-cp-primary tp-resizeme rs-parallaxlevel-0 ">
                            "Thành công không đến trong một sớm một chiều. Nó chỉ đến khi mỗi ngày bạn đều cố gắng làm tốt hơn ngày hôm qua. Và rồi thành công sẽ đến" - The Rock.
                            </div>
                        </div>
                        <div class="button"><a href="#" class="btn custom-button" data-title="Join With Us">Tham gia ngay</a></div>
                    </div>
                </div>
                <!-- direction 2 -->
                <div id="slider-direction-2" class="t-cn slider-direction">
                    <div class="slider-progress"></div>
                    <div class="slider-content t-cn s-tb slider-2">
                        <div class="title-container s-tb-c title-compress">
                            <div data-wow-delay="0.1s" data-wow-duration="1s" class="tp-caption big-title rs-title customin customout bg-sld-cp-primary ">Gym <span>Star</span>
                            </div>
                            <div data-wow-delay="0.2s" data-wow-duration="2s" class="tp-caption small-content customin customout rs-title-small bg-sld-cp-primary tp-resizeme rs-parallaxlevel-0 ">
                            "Bạn sẽ cảm thấy tổn thương, chán nản, nhưng càng chăm chỉ, bạn sẽ càng thấy kết quả. Thân hình bạn đẹp đến mức nào cũng không tỉ lệ thuận với sức tạ bạn nâng mà tỉ lệ thuận với cách bạn nỗ lực nâng chúng đến mức nào" - Joe Manganlello.
                            </div>
                        </div>
                        <div class="button"><a href="#" class="btn custom-button" data-title="Join With Us">Tham gia ngay</a></div>
                    </div>
                </div>
                <!-- direction 3 -->
                <div id="slider-direction-3" class="t-cn slider-direction">
                    <div class="slider-progress"></div>
                    <div class="slider-content t-cn s-tb slider-3">
                        <div class="title-container s-tb-c title-compress">
                            <div data-wow-delay="0.1s" data-wow-duration="1s" class="tp-caption big-title rs-title customin customout bg-sld-cp-primary ">Gym <span>Star</span>
                            </div>
                            <div data-wow-delay="0.2s" data-wow-duration="2s" class="tp-caption small-content customin customout rs-title-small bg-sld-cp-primary tp-resizeme rs-parallaxlevel-0 ">
                            "Tự hào về những gì bạn đã làm được. Sau tất cả, nếu nó dễ thì ai cũng làm rồi. Hãy chiến đấu thầm lặng với những người xung quanh bạn. Hãy là người chăm chỉ đến phòng Gym nhất tuần này".
                            </div>
                        </div>
                        <div class="button"><a href="#" class="btn custom-button" data-title="Join With Us">Tham gia ngay</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End slider area-->
        <!-- Service 1 Area Start Here -->
        <div class="service1-area">
            <div class="container-fluid">
                <div class="row no-gutter service1-wrapper">
                @foreach($course_types as $course_type)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="service1-box">
                            <a href="#"><span class="flaticon-gym"></span></a>
                            <h3 class="title-bar"><a href="#">{{$course_type->course_type_name}}</a></h3>
                            <p>{!!$course_type->description!!}</p>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <!-- Service 1 Area End Here -->
        <!-- Start being body builder area -->
        <div class="being-body-builder2">
            <div class="side-text"><span>Gym</span> Star</div>
            <div class="container">
                <div class="being-body-builder2-wrapper">
                    <div class="being-content">
                        <span>Giới thiệu về</span>
                        <h2><span>Gym</span> Star</h2>
                        <p>Đội ngũ huấn luyện viên chuyên nghiệp với tinh thần trách nhiệm đặt lên hàng đầu. Môi trường thân thiện, thoải mái. Giáo án luôn luôn đổi mới.</p>
                        <a class="btn sign-button" href="#">Đăng ký ngay</a>
                    </div>
                    <div class="being-right-img">
                        <img src="img/being-builder.png" alt="being-builder">
                    </div>
                </div>
            </div>
        </div>
        <!-- End being body builder area -->
        <!-- Start feature classes area -->
        <div class="feature-classes-area bg-secondary">
            <div class="container">
                <h2 class="section-title-default title-bar-high">KHÓA TẬP MỚI</h2>
                <p class="sub-title-default">Mùa hè trở nên sôi động hơn khi đến với GymStar. Trở lại sau mùa dịch</p>
                <div class="row">
                    <div class="gym-carousel dot-control-textPrimary" data-loop="true" data-items="3" data-margin="0" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="3" data-r-large-nav="false" data-r-large-dots="true">
                        @foreach($new_courses as $new_course)
                        <div class="single-product-classes2">
                            <div class="single-product hvr-bounce-to-bottom">
                                <a href="#"><img class="img-responsive" width="345" heigth="220" src="upload/course/photo/{{$new_course->photo}}" ></a>
                                <div class="overlay-btn">
                                    <a href="#" class="btn-details">Xem Ngay</a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="#">{{$new_course->course_name}}</a></h3>
                                <ul>
                                    <li><i class="fa fa-user" aria-hidden="true"></i>{{$new_course->trainer->full_name}}</li>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>{{\Carbon\Carbon::parse($new_course->start_time)->format('d/m/Y')}}</li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End feature product area -->
        <!-- Start class schedule area -->
        <div class="class-schedule">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="section-title-white title-bar-high">CLASS SCHEDULE</h2>
                        <p class="sub-title-white">Rmply dummy text of the printing and typesetting industry dorem Ipsum has been the industry's standard dummy text ever since thewhen an unknown printer took a gal survived five centuries.</p>
                        <div class="class-schedule-wrap">
                            <!-- Tabs -->
                            <ul id="myTab" class="nav nav-tabs">
                                <li class="active"><a href="#monday" data-toggle="tab">Monday</a></li>
                                <li><a href="#tuesday" data-toggle="tab">Tuesday</a></li>
                                <li><a href="#wednesday" data-toggle="tab">Wednesday</a></li>
                                <li><a href="#thursday" data-toggle="tab">Thursday</a></li>
                                <li><a href="#friday" data-toggle="tab">Friday</a></li>
                                <li><a href="#saturday" data-toggle="tab">Saturday</a></li>
                                <li><a href="#sunday" data-toggle="tab">Sunday</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content class-schedule-tab">
                                <div class="tab-pane fade in active" id="monday">
                                    <ul class="odd">
                                        <li>Yoga</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Robert Smith</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Running</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Petter john</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="odd">
                                        <li>Gym</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Kazi Fahim</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Free Hand</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Jessy Reo</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="odd">
                                        <li>Weight Lifting</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Zara Keron</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Fitness</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Jack Sparrow</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="tuesday">
                                    <ul class="odd">
                                        <li>Yoga</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Robert Smith</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Running</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Petter john</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="odd">
                                        <li>Gym</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Kazi Fahim</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Free Hand</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Jessy Reo</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="odd">
                                        <li>Weight Lifting</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Zara Keron</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="wednesday">
                                    <ul class="odd">
                                        <li>Yoga</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Robert Smith</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Running</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Petter john</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="odd">
                                        <li>Gym</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Kazi Fahim</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Free Hand</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Jessy Reo</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="thursday">
                                    <ul class="odd">
                                        <li>Yoga</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Robert Smith</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Running</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Petter john</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="odd">
                                        <li>Gym</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Kazi Fahim</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Free Hand</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Jessy Reo</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="odd">
                                        <li>Weight Lifting</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Zara Keron</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="friday">
                                    <ul class="odd">
                                        <li>Yoga</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Robert Smith</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Running</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Petter john</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="saturday">
                                    <ul class="odd">
                                        <li>Yoga</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Robert Smith</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Running</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Petter john</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="odd">
                                        <li>Gym</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Kazi Fahim</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="sunday">
                                    <ul class="odd">
                                        <li>Yoga</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Robert Smith</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Running</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Petter john</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="odd">
                                        <li>Gym</li>
                                        <li>10.00 am - 12.00 pm</li>
                                        <li>Kazi Fahim</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                    <ul class="even">
                                        <li>Free Hand</li>
                                        <li>09.00 am - 12.00 pm</li>
                                        <li>Jessy Reo</li>
                                        <li><a href="#">Join Now!</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End class schedule area -->
        <!-- Start Expert trainers area -->
        <div class="expert-trainer-area nav-on-hover">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="section-title-default title-bar-high">HUẤN LUYỆN VIÊN</h2>
                        <p class="sub-title-default">Đội ngũ huấn luyện viên chuyên nghiệp, tinh thần trách nhiệm với công việc, sẽ giúp đỡ các bạn trong quá trình tập luyện</p>
                        <div class="gym-carousel nav-control-middle" data-loop="true" data-items="3" data-margin="15" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="3" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="4" data-r-medium-nav="true" data-r-medium-dots="false" data-r-large="4" data-r-large-nav="true" data-r-large-dots="false">
                            @foreach($trainers as $trainer)
                            <div class="trainer-box">
                                <div class="trainer-box-wrapper">
                                    <div class="trainer-img-holder">
                                        <img src="upload/trainer/photo/{{$trainer->photo}}" class="img-responsive" alt="team">
                                        <div class="trainer-title-holder">
                                            <h3>{{$trainer->full_name}}</h3>
                                            <h4>{{$trainer->course_type->course_type_name}}</h4>
                                        </div>
                                    </div>
                                    <div class="trainer-content-holder">
                                        <div class="trainer-inner-content">
                                            <h3><a href="#">{{$trainer->full_name}}</a></h3>
                                            <h4>{{$trainer->course_type->course_type_name}}</h4>
                                            <p> Giới thiệu huấn luyện viên</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Expert tainers area -->
        <!-- Start Fitness class summer area -->
        <div class="fitness-summer-area padding-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="fitness-summer">
                            <div class="fitness-content">
                                <h3><span>GymStar</span> Tham gia ngay</h3>
                                <p>Trong mùa hè này
                                    <br> Với ưu đãi lớn nhất <span>{{$course_max_discount->discount * 100}} %</span> Giảm giá
                                </p>
                                <a class="custom-button" data-title="Become A Member" href="#">Đăng ký thành viên</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Fitness class summer area -->
        <!-- Start online store area -->
        <div class="online-store-area nav-on-hover">
            <div class="container">
                <h2 class="section-title-default title-bar-high">Kho Hàng</h2>
                <p class="sub-title-default">Cung cấp các sản phẩm thiết yếu, các dụng cụ hỗ trợ tập luyện, thực phẩm tăng cân tăng cơ, với khẩu hiệu </br>
                <span> CHẤT LƯỢNG SẢN PHẨM LÀ ƯU TIÊN HÀNG ĐẦU</span>  
                </p>
            </div>
            <div class="container">
                <div class="gym-carousel nav-control-middle" data-loop="true" data-items="4" data-margin="5" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="3" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="4" data-r-medium-nav="true" data-r-medium-dots="false" data-r-large="4" data-r-large-nav="true" data-r-large-dots="false">
                    @foreach($products as $product)
                    <div class="single-product-store">
                        <div class="single-product">
                            <a href="#"><img src="upload/product/photo/{{$product->photo}}" alt="product"></a>
                            <div class="overlay"></div>
                            <div class="product-info">
                                <h3>{{$product->product_name}}</h3>
                                <h4>{!!$product->description!!}</h4>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="">{{$product->product_name}}</a></h3>
                            <span class="regular-price">
                                    <span class="product-price">{{$product->price}} vnđ</span>
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End online store area -->
        <!-- Start Price Table area -->
        <div class="price-table-area">
            <div class="container">
                <h2 class="section-title-white title-bar-high">KHÓA TẬP SẮP MỞ</h2>
                <p class="sub-title-white">Trong thời gian sắp tới, phòng tập sẽ mở các khóa tập sau. Các bạn theo dõi để đăng ký khóa tập phù hợp với bản thân</p>
            </div>
            <div class="container">
                <div class="row">
                    @foreach($courses as $course)
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 hvr-float-shadow">
                        <div class="price-table-box">
                            <span>{{$course->course_name}}</span>
                            <h3>{{$course->price}}<span>vnđ</span></h3>
                            <ul>
                                <li>{{$course->course_type->course_type_name}}</li>
                                <li><span>Discount: </span>{{$course->discount *100}} <span>%</span></li>
                            </ul>
                            <a class="custom-button" data-title="Become A Member" href="#">Xem Ngay</a>
                        </div>
                    </div>                    
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Price Table area -->
    </div>
    <!-- End wrapper -->
@endsection