@extends('layouts.frontend.master')
@section('content')
<main>
    <!--    breadcrumb-area start    -->
    <section class="breadcrumb-area pt-180 pb-180 pt-md-120 pb-md-120 pt-xs-100 pb-xs-100 bg-fix" data-overlay="black" data-opacity="7" data-background="{{asset('frontend/assets/img/bg/breadcrumb-bg-2.jpg')}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="breadcrumb-content">
                        <h3 class="title">Huấn luyện viên</h3>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li class="active">Huấn luyện viên</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--    breadcrumb-area end    -->

    <!-- team-area start -->
    <div class="team-area-2 bg-off-white pt-130 pb-130">
        <div class="container">
            <div class="row align-items-center mb-60">
                <div class="col-xl-9">
                    <div class="section-title-2 bar-theme-color team-title-2">
                        <span>Trainer</span>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($coachs as $item)
                <div class="col-lg-4 col-md-8">
                    <div class="team-wrap mb-30">
                        <div class="team-img">
                            <img height="450px" src="{{asset($item->avatar)}}" alt="">
                            <div class="team-social-link">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-google"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h3><a href="{{route('training.detail',$item->id)}}">{{$item->name}}</a></h3>
                            <span>Huấn luyện viên Gym</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <div class="gray-bg"></div>
    </div>
    <!-- team-area end -->

    <!-- team-area-4 start -->
    <div class="team-area-4 pt-130 pb-100">
        <div class="container">
            <div class="row align-items-center mb-60">
                <div class="col-xl-9">
                    <div class="section-title-2 bar-theme-color team-title-2">
                        <span>TOP</span>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($top as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="team-wrap-4 mb-30">
                        <div class="team-img">
                            <img src="{{asset($item["item"]->avatar)}}" alt="img">
                        </div>
                        <div class="team-content">
                            <h3><a href="{{route('training.detail',$item["item"]->id)}}">{{$item["item"]->name}}</a></h3>
                            <span>MÃ THÀNH VIÊN: @if($item["item"]->id < 10) {{'00000'.$item["item"]->id}} @elseif($item["item"]->id < 100) {{'0000'.$item["item"]->id}} @elseif($item["item"]->id < 1000) {{'000'.$item["item"]->id}} @elseif($item["item"]->id < 10000) {{'00'.$item["item"]->id}} @elseif($item["item"]->id < 100000) {{'0'.$item["item"]->id}} @else {{$item["item"]->id}} @endif</span>
                                                    <div class="team-social-link">
                                                        <ul>
                                                            <li>
                                                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="fab fa-twitter"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="fab fa-instagram"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-3 col-md-6">
                    <div class="join-our-team join-team-spacing mb-30">
                        <h3>Top 3 Huấn Luyện Viên</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- team-area-4 end -->
</main>
@endsection