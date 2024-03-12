@extends('layouts.frontend.master')
@section('title', 'Đăng Nhập')
@section('content')
<main>
    <div class="contact-area-2 pt-130 pb-130">
        <div class="container">
            <h1 class="text-center">ĐĂNG NHẬP</h1>
            <div class="row justify-content-between mt-100">
                <div class="col-md-6 col-lg-5">
                    <div class="contact-text text-left">
                        <div class="about-img-2 mb-70 h-50">
                            <img src="{{asset('frontend/assets/img/thumb/thumb-4.jpg')}}" alt="about">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7">
                    <div class="contact-form contact-form-2">


                        <form action="{{route('postLogin')}}" method="post">
                            @csrf

                            <div class="row">
                                @if(session()->has('error'))
                                <div  style="background-color: #f44336;" class="alert">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>Danger!</strong> {{session()->get('error')}}
                                </div>
                                @endif
                                @if(session()->has('success'))
                                <div  style="background-color: green;" class="alert">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>Success!</strong> {{session()->get('success')}}
                                </div>
                                @endif
                                <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="text" @error('email') style="border: 3px solid red" @enderror placeholder="Địa chỉ email" name="email" value="{{old('email')}}">
                                    </div>
                                    @error('email')
                                    <div class="col-xl-12">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-xl-12" style="margin-bottom:28px">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="password" @error('password') style="border: 3px solid red" @enderror placeholder="Mật khẩu" name="password" value="{{old('password')}}">
                                    </div>
                                    @error('password')
                                    <div class="col-xl-12">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-xl-12">
                                    <a className="small text-muted" href="{{route('forgotPassword')}}">Quên mật khẩu ?</a>
                                    <p className="mb-4 pb-lg-2" style="color: '#393f81'">Bạn chưa có tài khoản ? <a href="{{route('signup')}}" style="color: '#393f81'">Đăng ký</a></p>
                                    <button type="submit" class="btn btn-gra">
                                        ĐĂNG NHẬP <i class="fas fa-angle-double-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection