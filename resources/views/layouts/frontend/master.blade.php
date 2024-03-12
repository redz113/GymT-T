<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/logo/favicon.png')}}">
    <!-- All CSS -->

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/spacing.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        .star-style {
            background-repeat: no-repeat;
            width: 115%;
            height: 100%;
            margin-left: -7px;
        }

        .rating {
            position: absolute;
            top: -1px;
            left: 0;
        }

        .fa-star {
            margin: 5px;
            width: 20px;
            height: 10px;
        }

        .star-vote {
            width: 100px;
            height: 20px;
            position: relative;
            margin-right: 10px;
            margin-left: 10px;
        }

        .single_capt_left {
            font-size: 20px;
        }

        .alert {
            padding: 20px;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
    @yield('style')
    <title>@yield('title')</title>
</head>

<body>
    <div id="preloader">
        <div class="preloader">
            <img src="{{asset('frontend/assets/img/logo/preloader.gif')}}" alt="preloader">
            <h4>...Đang Load ....</h4>
        </div>
    </div>
    @include('layouts.frontend.header')
    <!--    slide-bar start   -->
    @include('layouts.frontend.slidebar')
    <div class="body-overlay"></div>
    <!--    slide-bar End   -->
    <!--    search-bar start    -->
    <div class="search-area">
        <div class="search-area-bg"></div>
        <a href="#" class="search-close">
            <i class="far fa-times"></i>
        </a>
        <div class="search-form">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <form action="#" method="post">
                            <input type="text" placeholder="Search here...">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main>
        <!-- slider-area start -->
        @yield('banner_home')
        {{-- @include('layouts.frontend.banner_home') --}}
        <!-- slider-area end -->

        <!-- feature-area-2 start -->
        @yield('feature-area')
        {{-- @include('layouts.frontend.feature-area') --}}
        <!-- feature-area-2 end -->
        {{-- Nội dung  --}}

        @yield('content')

        {{-- kết thúc nội dung  --}}
        <!-- about-area-2 start -->
        @yield('about-area')
        {{-- @include('layouts.frontend.about-area') --}}
        <!-- about-area-2 end -->

        <!-- service-area-2 start -->


        @yield('service-area')
        {{-- @include('layouts.frontend.service-area') --}}
        <!-- service-area-2 end -->

        <!-- schedule-area-2 start -->
        @yield('schedule-area')
        {{-- @include('layouts.frontend.schedule-area') --}}
        <!-- schedule-area-2 end -->

        <!-- calculator-area start -->
        @yield('calculator-area')
        {{-- @include('layouts.frontend.calculator-area') --}}
        <!-- calculator-area end -->

        <!-- pricing-area start -->
        @yield('pricing-area')
        {{-- @include('layouts.frontend.pricing-area') --}}
        <!-- pricing-area end -->

        <!-- testimonial-area start -->
        @yield('testimonial-area')
        {{-- @include('layouts.frontend.testimonial-area') --}}
        <!-- testimonial-area end -->
        <!-- blog-area start -->
        @yield('blog-area')
        {{-- @include('layouts.frontend.blog-area') --}}
        <!-- blog-area end -->
    </main>

    <!-- //Footer -->
    @include('layouts.frontend.footer')
    <!--    search-bar End    -->
    <div id="scrollUp"><i class="fas fa-level-up-alt"></i></div>
    <!-- Optional JavaScript -->
    <script src="{{asset('frontend/assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.appear.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.knob.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/odometer.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/tilt.jquery.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/script.js')}}"></script>

    @yield('js')

</body>

</html>