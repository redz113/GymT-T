@extends('layouts.frontend.master')
@section('content')
<main>
	<section class="breadcrumb-area pt-180 pb-180 pt-md-120 pb-md-120 pt-xs-100 pb-xs-100 bg-fix" data-overlay="black" data-opacity="7" data-background="{{asset('frontend/assets/img/bg/breadcrumb-bg-2.jpg')}}">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<div class="breadcrumb-content">
						<h3 class="title">Trang gói tập</h3>
						<ul>
							<li><a href="{{route('home')}}">Trang chủ</a></li>
							<li class="active">Gói tập</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="container" style="margin-top: 12px;">
		<div class="row justify-content-center align-items-center">
			<div class="section-title-2 bar-theme-color text-center mb-35">
				<h3>
					Top 3 Gói Tập Được Đăng Ký Nhiều Nhất
				</h3>
			</div>
		</div>
		<div class="row justify-content-center">
			@foreach($top as $i)
			<div class="col-lg-4 col-md-7">
				<div class="pricing-wrap mt-30 mb-30">
					<h3 style="color: white; white-space: nowrap;">{{$i["item"]->package_name}}</h3>
					<p style="color: white; min-height: 56px">
						{{$i["item"]->short_description}}
					</p>
					
					<span class="price">{{number_format($i["item"]->into_price,0,'.','.')}} VNĐ</span>
					<a href="{{route('package_client.detail', $i["item"]->id)}}" class="order-btn">
						Xem gói tập <i class="fas fa-angle-double-right"></i>
					</a>
					<div class="shape">
						<img height="200px" width="500px" src="{{asset($i["item"]->avatar)}}" alt="shape">
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-xl-12">
				<div class="section-title-2 bar-theme-color text-center mb-35">
					<h3>
						Gói Tập Đăng Ký Tập Ngay
					</h3>
					{{-- <span>Pricing</span> --}}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12">
				@php
				$i=0;
				@endphp
				@foreach($packages as $item)

				<div class="{{$i++ % 2 == 0 ? 'pricing-wrap-2 mb-80' : 'pricing-wrap-2 active mb-80'}}">
					<div class="row no-gutters align-items-center">
						<div class="col-lg-4">
							<div class="pricing-title">
								<h3>{{$item->package_name}}</h3>
								<del style="font-size: 31px;color:black">{{number_format($item->price, 0, '.','.')}} </del> <sup style="font-size: 31px;color:black">đ</sup>
								<span style="font-size: 55px;">{{number_format($item->into_price, 0, '.','.')}} <sup>đ</sup></span>
								<p style="color: black;">Gảm {{$item->price_sale}} %</p>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pricing-list">
								<ul>
									<li><i class="far fa-check-circle"></i> Môn tập : {{$item->subject->subject_name}}</li>
									@if($item->set_pt == 1)
									<li><i class="far fa-check-circle"></i> {{$item->total_session_pt }} buổi tập có PT </li>
									<li><i class="far fa-check-circle"></i> {{$item->week_session_pt}} buổi PT / tuần</li>
									@else
									<li><i class="far fa-check-circle"></i> Gói tập không PT</li>
									@endif
								</ul>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pricing-content">
								<a href="{{route('package_client.detail', $item->id)}}" class="btn btn-gra mt-30">
									Xem gói tập <i class="fas fa-angle-double-right"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</main>
@endsection