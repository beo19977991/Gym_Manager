@extends('layouts.app', ['title' => 'Product'])
@section('banner')
        <!-- Preloader Start Here -->
        <div id="preloader"></div>
        <!-- Preloader End Here -->
    <!-- Start Inner Banner area -->
    <div class="inner-banner-area">
        <div class="container">
            <div class="row">
                <div class="innter-title">
                    <h2>Cửa Hàng</h2>
                </div>
                <div class="breadcrum-area">
                    <ul class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active">Cửa Hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Inner Banner area -->
@endsection
@section('content')
            <!-- Start Online Store area -->
            <div class="online-store-grid padding-space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <div class="online-grid-item">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="gried-view">
                                        <!-- Start online grid view -->
                                        <div class="category-product-grid">
                                            @foreach($products as $product)
                                            <!-- Start Single product -->
                                            <div class="col-lg-4 col-md-4 col-sm-6 item">
                                                <div class="online-product">
                                                    <a href="#"><img src="upload/product/photo/{{$product->photo}}"></a>
                                                </div>
                                                <div class="product-content">
                                                    <h3 class="name"><a href="">{{$product->product_name}}</a></h3>
                                                    <span class="regular-price">
                                                        <span class="product-price">{{$product->price}} vnđ</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- End Single product -->
                                            @endforeach
                                        </div>
                                        <!-- End online grid view -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="right-sidebar">
                                <div class="single-sidebar">
                                    <h3>Best Seller</h3>
                                    <div class="best-seller">
                                        <div class="single-best-seller">
                                            <div class="seller-left pull-left">
                                                <a href="#"><img src="img/product/product1.png" alt=""></a>
                                            </div>
                                            <div class="seller-right media-body">
                                                <div class="seller-content">
                                                    <div class="seller-title"><a href="single-product.html">Product title Here</a></div>
                                                    <div class="review">
                                                        <ul>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li class="inactive"><a href="#"><i class="fa fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-price">
                                                        <ul>
                                                            <li class="discount">$80</li>
                                                            <li class="final">$90</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-best-seller">
                                            <div class="seller-left pull-left">
                                                <a href="#"><img src="img/product/product2.png" alt=""></a>
                                            </div>
                                            <div class="seller-right media-body">
                                                <div class="seller-content">
                                                    <div class="seller-title"><a href="single-product.html">Product title Here</a></div>
                                                    <div class="review">
                                                        <ul>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li class="inactive"><a href="#"><i class="fa fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-price">
                                                        <ul>
                                                            <li class="discount">$80</li>
                                                            <li class="final">$90</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-best-seller last-item">
                                            <div class="seller-left pull-left">
                                                <a href="#"><img src="img/product/product3.png" alt=""></a>
                                            </div>
                                            <div class="seller-right media-body">
                                                <div class="seller-content">
                                                    <div class="seller-title"><a href="single-product.html">Product title Here</a></div>
                                                    <div class="review">
                                                        <ul>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            <li class="inactive"><a href="#"><i class="fa fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-price">
                                                        <ul>
                                                            <li class="discount">$80</li>
                                                            <li class="final">$90</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Online Store area -->
@endsection