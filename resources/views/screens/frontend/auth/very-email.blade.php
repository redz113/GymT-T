@extends('layouts.frontend.master')
@section('title', 'Xác Minh')
@section('content')
<main>
    <!-- contact-area start -->
    <div class="contact-area-2 pt-130 pb-130">
        <div class="container">
            <div class="row justify-content-between mt-100">
                <div class="col-md-6 col-lg-5">
                    <div class="contact-text text-left">
                        <div class="about-img-2 mb-70">
                            <img src="{{asset('frontend/assets/img/thumb/thumb-4.jpg')}}" alt="about">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7">
                    <div class="contact-form contact-form-2">
                        <h1 class="text-center">XÁC MINH</h1>
                        <form action="{{route('post_very_email', $email)}}" method="post">
                            @csrf
                            <div class="row">
                                @if(session()->has('error'))
                                <div  style="background-color: #f44336;" class="alert">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>Danger!</strong> {{session()->get('error')}}
                                </div>
                                @else
                                <div class="col-xl-12">
                                    <span class="text-danger"><strong>Mã xác minh gồm 6 chữ số đã được gửi về gmail của bạn !</strong></span>
                                </div>
                                @endif
                                <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="text" placeholder="Nhập mã xác minh" name="code" value="{{old('code')}}">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <button type="submit" class="btn btn-gra">
                                        XÁC MINH <i class="fas fa-angle-double-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection