@extends('layouts.frontend.master')
@section('title', 'Trang chủ')
@section('banner_home')
    @include('layouts.frontend.banner_home')
@endsection

@section('feature-area')
    @include('layouts.frontend.feature-area')
@endsection

@section('about-area')
    @include('layouts.frontend.about-area')
@endsection

@section('service-area')
    @include('layouts.frontend.service-area')
@endsection

@section('schedule-area')
    {{-- @include('layouts.frontend.schedule-area') --}}
@endsection

@section('calculator-area')
    @include('layouts.frontend.calculator-area')
@endsection

@section('pricing-area')
    @include('layouts.frontend.pricing-area')
@endsection

@section('testimonial-area')
    {{-- @include('layouts.frontend.testimonial-area') --}}
@endsection

@section('blog-area')
    @include('layouts.frontend.blog-area')
@endsection
