@extends('layouts.frontend.master')
@section('content')
<main>
    <!--    breadcrumb-area start    -->
    <section class="breadcrumb-area pt-180 pb-180 pt-md-120 pb-md-120 pt-xs-100 pb-xs-100 bg-fix" data-overlay="black" data-opacity="7" data-background="{{asset('frontend/assets/img/bg/breadcrumb-bg-3.jpg')}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="breadcrumb-content">
                        <h3 class="title">Chi tiết huấn luyện viên</h3>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li class="active">Chi tiết huấn luyện viên</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--    breadcrumb-area end    -->

    <!-- trainer-details-area start -->
    <section class="trainer-details-area pt-130 pb-130">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="trainer-details-thumb mb-md-50 mb-xs-50">
                        <img src="{{asset($coach->avatar)}}" height="666px" alt="thumb">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <div class="trainer-details-content">
                        <h3>{{$coach->name}}
                        </h3>
                        <div class="star-vote">
                        <div class="star-style rating" style="background-image: url({{asset('images/5star1.png')}}); width:{{($avg_star/5*100)*1.16}}%"></div>
                        <div class="star-style star_background" style="background-image: url({{asset('images/5star2.png')}});"></div>
                    </div>
                        <div class="trainer-info mt-50 mb-40">
                            <div class="info-icon">
                                <i class="flaticon-email"></i>
                            </div>
                            <div class="info-content">
                                <h5>Email</h5>
                                <span>{{$coach->email}}</span>
                            </div>
                        </div>
                        <div class="trainer-info mb-40">
                            <div class="info-icon">
                                <i class="flaticon-whatsapp"></i>
                            </div>
                            <div class="info-content">
                                <h5>Số điện thoại</h5>
                                <span class="heading-color">+84 {{$coach->phone}}</span>
                            </div>
                        </div>
                        <div class="trainer-info">
                            <div class="info-icon">
                                <i class="flaticon-pin"></i>
                            </div>
                            <div class="info-content">
                                <h5>Địa chỉ</h5>
                                <span class="heading-color">{{$coach->address}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- trainer-details-area end -->

    <!-- testimonial-area-2 start -->
    <div>
        <div class="container position-relative">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-title-2 text-center bar-theme-color mb-35">
                        <h3>
                            Đánh giá
                        </h3>
                        <span>Rate</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="testimonial-slider-3 mb-80 mb-xs-0">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @if(count($rates) >0)
                                @foreach($rates as $rate)
                                <div class="swiper-slide single-slide">
                                    <div class="testimonial-wrap-3">
                                        <div class="author-info">
                                            <img src="{{asset($rate->user->avatar)}}" alt="author">
                                            <div class="author-content">
                                                <h4>{{$rate->user->name}}</h4>
                                                <span>@if($rate->user->id < 10) {{'00000'.$rate->user->id}} @elseif($rate->user->id < 100) {{'0000'.$rate->user->id}} @elseif($rate->user->id < 1000) {{'000'.$rate->user->id}} @elseif($rate->user->id < 10000) {{'00'.$rate->user->id}} @elseif($rate->user->id < 100000) {{'0'.$rate->user->id}} @else {{$rate->user->id}} @endif </span>
                                            </div>
                                        </div>
                                        <div class="testimonial-content">
                                            <p>
                                                {{$rate->note_pt}}
                                            </p>
                                            <div class="star">
                                                <div class="star-vote">
                                                    <div class="star-style rating" style="background-image: url(https://meter.com.vn//static/imgs/5star1.png); width:{{($rate->star_pt/5*100)*1.16}}%"></div>
                                                    <div class="star-style star_background" style="background-image: url(https://meter.com.vn//static/imgs/5star2.png);"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h4 style="text-align: center;">Chưa có đánh giá nào</h4>
                                @endif
                            </div>
                        </div>
                        <!-- If we need pagination -->
                       @if(count($rates) >0)
                       <a href="#"><span style="text-align:center">Xem thêm đánh giá</span></a>
                       @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection