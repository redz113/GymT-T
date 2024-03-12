@extends('layouts.frontend.master')
@section('title', 'Đăng ký')
@section('content')
<main>
    <!-- contact-area start -->
    <div class="contact-area-2 pt-130 pb-130">
        <div class="container">
        <h1 class="text-center">ĐĂNG KÝ</h1>
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
                        <form action="{{route('postSignup')}}" method="post">
                            @csrf
                            <div class="row" style="margin-bottom: 28px">
                            @if(session()->has('error'))
                                <div  style="background-color: #f44336;" class="alert">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>Danger!</strong> {{session()->get('error')}}
                                </div>
                                @endif
                                <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="text" @error('name') style="border: 3px solid red" @enderror placeholder="Nhập vào họ và tên" name="name" value="{{old('name')}}">
                                    </div>
                                    @error('name')
                                    <div class="col-xl-12">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="text" @error('phone') style="border: 3px solid red" @enderror placeholder="Nhập vào số điện thoại" name="phone" value="{{old('phone')}}">
                                    </div>
                                    @error('phone')
                                    <div class="col-xl-12">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="email" @error('email') style="border: 3px solid red" @enderror placeholder="Nhập vào địa chỉ email" name="email" value="{{old('email')}}">
                                    </div>
                                    @error('email')
                                    <div class="col-xl-12">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-xl-6">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="password" @error('password') style="border: 3px solid red" @enderror placeholder="Nhập vào mật khẩu" name="password">
                                    </div>
                                    @error('password')
                                    <div class="col-xl-12">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-xl-6">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="password" @error('password_confirm') style="border: 3px solid red" @enderror placeholder="Nhập lại mật khẩu" name="password_confirm">
                                    </div>
                                    @error('password_confirm')
                                    <div class="col-xl-12">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-msg">
                                        <select name="gender" @error('gender') style="border: 3px solid red" @enderror>
                                            <option selected disabled>Chọn giới tính</option>
                                            <option @if(old('gender')==1 ) selected @endif value="1">Nam</option>
                                            <option @if(old('gender')==2 ) selected @endif value="2">Nữ</option>
                                            <option @if(old('gender')==3 ) selected @endif value="3">Khác</option>
                                        </select>
                                       
                                    </div>
                                    @error('gender')
                                        <div class="col-xl-12">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                </div>
                                <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="text" @error('address') style="border: 3px solid red" @enderror placeholder="Nhập vào địa chỉ" name="address" value="{{old('address')}}">
                                    </div>
                                    @error('address')
                                    <div class="col-xl-12">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <p className="mb-4 pb-lg-2" style="color: '#393f81'">Bạn đã có tài khoản ? <a href="{{route('login')}}" style="color: '#393f81'">Đăng nhập</a></p>
                                <button type="submit" class="btn btn-gra">
                                    ĐĂNG KÝ <i class="fas fa-angle-double-right"></i>
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