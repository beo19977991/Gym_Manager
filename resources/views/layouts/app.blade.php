<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from radiustheme.com/demo/html/gymedge/multi-page/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Nov 2018 09:38:45 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GymStar-{{$title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('')}}">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="{{asset('image/x-icon')}}" href="favicon.ico">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- Owl Caousel CSS 
        ============================================ -->
    <link rel="stylesheet" href="{{asset('vendor/OwlCarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/OwlCarousel/owl.theme.default.min.css')}}">
    <!-- meanmenu CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('css/meanmenu.min.css')}}">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- nivo slider CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('css/custom-slider/css/nivo-slider.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/custom-slider/css/preview.css')}}" type="text/css" media="screen" />
    <!-- flaticon CSS
        ============================================ -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/flaticon.css')}}">
    <!-- Wow CSS
        ============================================ -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site.css')}}">
    <!-- Switch Style CSS 
        ============================================ -->
    <link rel="stylesheet" href="{{asset('css/hover-min.css')}}">
    <!-- Magic popup CSS 
        ============================================-->
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- modernizr JS
        ============================================ -->
    <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>
    @yield('styles')
</head>

<body>
@include('layouts.header')
@yield('banner')
@yield('content')
@include('layouts.footer')
    <a href="#" class="scrollToTop"></a>
    <!-- jquery
        ============================================ -->
    <script src="{{asset('js/vendor/jquery-1.11.3.min.js')}}"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-tabcollapse.js')}}"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="{{asset('js/jquery.meanmenu.min.js')}}"></script>
    <!-- Owl Cauosel JS 
        ============================================ -->
    <script src="{{asset('vendor/OwlCarousel/owl.carousel.min.js')}}" type="text/javascript"></script>
    <!-- Nivo slider js
        ============================================ -->
    <script src="{{asset('css/custom-slider/js/jquery.nivo.slider.js')}}" type="text/javascript"></script>
    <script src="{{asset('css/custom-slider/home.js')}}" type="text/javascript"></script>
    <!-- Zoom JS
        ============================================ -->
    <script src="{{asset('js/jquery.zoom.js')}}"></script>
    <!-- Isotope JS
        ============================================ -->
    <script src="{{asset('js/isotope.pkgd.js')}}"></script>
    <!-- Counter Up JS
        ============================================ -->
    <script src="{{asset('js/waypoints.min.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
    <!-- Magic Popup js 
        ============================================-->
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>
    <!-- Wow JS
        ============================================ -->
    <script src="{{asset('js/wow.min.js')}}"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="{{asset('js/plugins.js')}}"></script>
    <!-- main JS
        ============================================ -->
    <script src="{{asset('js/main.js')}}"></script>
    
    @yield('scripts')
</body>


<!-- Mirrored from radiustheme.com/demo/html/gymedge/multi-page/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Nov 2018 09:39:00 GMT -->
</html>
