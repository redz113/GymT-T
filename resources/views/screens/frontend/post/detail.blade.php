@extends('layouts.frontend.master')
@section('content')
<main>
<section class="breadcrumb-area pt-180 pb-180 pt-md-120 pb-md-120 pt-xs-100 pb-xs-100 bg-fix" data-overlay="black"
	         data-opacity="7" data-background="{{asset('frontend/assets/img/bg/breadcrumb-bg-2.jpg')}}">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<div class="breadcrumb-content">
						<h3 class="title">Trang bài viết</h3>
						<ul>
							<li><a href="{{route('home')}}">Trang chủ</a></li>
							<li class="active">Bài viết</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div style="margin-top: 12px;">
		<div class="row justify-content-center m-auto">
			<div class="col-xl-8 col-lg-8">
				<div class="blog-standard-details-posts">
					<div class="blog-details-wrap mb-40">
						<div class="blog-thumb mb-35">
							<a href="blog-details.html">
								<img height="600px" src="{{asset($post->avatar)}}" alt="blog">
							</a>
						</div>
						<div class="blog-meta">
							<span><i class="fas fa-calendar-alt"></i> {{date('d/m/Y', strtotime($post->created_at))}}</span>
							<span><i class="far fa-user"></i> {{$post->user->name}}</span>
						</div>
						<div class="blog-title">
							<h3>
								{{$post->title}}
							</h3>
						</div>
						<div class="blog-content" style="margin-top: 66px;">
							{!!$post->content_post!!}
						</div>
					</div>
					<div class="related-news mt-60">
						<h3>Bài viết liên quan</h3>
						<div class="row" style="display: grid;grid-template-columns:1fr 1fr">
							@foreach($related as $item)
							<div class="blog-wrap-2 mb-30">
								<div class="blog-thumb mb-35">
									<a href="{{route('post_client.detail', $item->id)}}">
										<img style="border: 0.5px dotted #999999;" height="250px" src="{{asset($item->avatar)}}" alt="Bài viết">
									</a>
								</div>
								<div class="blog-meta">
									<span><i class="fas fa-calendar-alt"></i> {{date('d/m/Y',strtotime($item->created_at))}}</span>
									<span><i class="far fa-user"></i>{{$item->user->name}}</span>
								</div>
								<div class="blog-content">
									<h3>
										<a href="{{route('post_client.detail', $item->id)}}">
											{{$item->title}}
										</a>
									</h3>
									<a href="{{route('post_client.detail', $item->id)}}" class="read-more">
										Đọc thêm <i class="fas fa-angle-double-right"></i>
									</a>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</main>
@endsection