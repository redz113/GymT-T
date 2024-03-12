@extends('layouts.frontend.master')
@section('title', 'Trang chủ')
@section('content')
<div class="team-area-2 bg-off-white pt-130 pb-130">
    <div class="container">
        @if(session('msg'))
            <div class="row mb-50">
                <div style="color: black" class="alert alert-danger alert-dismissible fade show">
                    <strong>Error: </strong> {{ session('msg') }}
                </div>
            </div>
        @endif
        <div class="row mb-50">

            <div class="col-md-12 col-lg-9 col-xl-6 order--1">
                <div class="tab-content product-tab-content" id="product-tabs-content">
                    <div class="tab-pane fade active show" id="p-tab-1" role="tabpanel" aria-labelledby="p-tabs-1">
                        <img src="{{asset($package->avatar)}}" alt="product">
                    </div>
                    <div class="tab-pane fade" id="p-tab-2" role="tabpanel" aria-labelledby="p-tabs-2">
                        <img src="{{asset($package->avatar)}}" alt="product">
                    </div>
                    <div class="tab-pane fade" id="p-tab-3" role="tabpanel" aria-labelledby="p-tabs-3">
                        <img src="{{asset($package->avatar)}}" alt="product">
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-lg-8 col-xl-4">
                <div class="product-details mt-lg-40 mt-md-40 mt-xs-40">
                    <h3>{{$package->package_name}}</h3>

                    <div class="star-vote">
                        <div class="star-style rating" style="background-image: url({{asset('images/5star1.png')}}); width:{{($star_rate/5*100)*1.16}}%"></div>
                        <div class="star-style star_background" style="background-image: url({{asset('images/5star2.png')}});"></div>
                    </div>

                    <span class="price">{{number_format($package->into_price,0,'.','.')}} VND</span>
                    <div class="">
                            @php
                                if(isset($package->week_session_pt) && $package->week_session_pt > 0){
                                    echo "<strong>Số buổi tập với PT / Tuần: </strong>
                                        <span> $package->week_session_pt Buổi </span>
                                    ";
                                }
                            @endphp
					</div>

                    <p class="">
                        {{$package->short_description}}
                    </p>
                    <div class="product-action-box mb-30">
                        <div class="add-to-cart">
                            <a href="{{route('order.index', $package->id)}}" class="btn btn-gra">Đăng Ký Ngay</a>
                        </div>
                    </div>
                    <div class="product-share">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-11 col-lg-11">
                <div class="review-tab-wrapper">
                    <div class="nav review-tab" id="review-tabs" role="tablist">
                        <a class="active show" id="r-tabs-1" data-toggle="tab" href="#r-tab-1" role="tab" aria-controls="r-tab-1" aria-selected="true">
                            Mô Tả
                        </a>
                        <a id="r-tabs-3" data-toggle="tab" href="#r-tab-3" role="tab" aria-controls="r-tab-3" aria-selected="false">
                            Đánh Giá
                        </a>
                    </div>
                    <div class="tab-content review-tab-content" id="review-tabs-content">
                        <div class="tab-pane fade active show" id="r-tab-1" role="tabpanel" aria-labelledby="r-tabs-1">
                            {!!$package->description !!}
                        </div>
                        <div class="tab-pane fade" id="r-tab-3" role="tabpanel" aria-labelledby="r-tabs-3">
                            <div class="stars container bg-light px-3 py-2">
                                <div class="col-sm-8 col-md-10 col-11 position-relative" style="left:30px">
                                    <div class="text-justify darker mt-4 float-right w-full">
                                        @if(count($rates) > 0)
                                        @foreach($rates as $item)
                                        <div>
                                            <img src="{{asset($item->user->avatar)}}" alt="" class="rounded-circle" width="40" height="40" />
                                            <div style="display: grid;grid-template-columns:6fr 1fr">
                                                <div>
                                                    <b style="padding-right: 20px;">{{$item->user->name}}</b>
                                                    <span>- {{date('d/m/Y', strtotime($item->created_at))}}</span>
                                                </div>
                                                <div class="star">
                                                    <div class="star-vote">
                                                        <div class="star-style rating" style="background-image: url({{asset('images/5star1.png')}}); width:{{($item->star_package/5*100)*1.16}}%"></div>
                                                        <div class="star-style star_background" style="background-image: url({{asset('images/5star2.png')}});"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                {{$item->note_package}}
                                            </p>
                                            <br>
                                        </div>
                                        @endforeach
                                        @else
                                        <div>
                                            <span>Chưa có đánh giá nào</span>
                                        </div>
                                        @endif
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
@endsection