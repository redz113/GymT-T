@extends('layouts.frontend.master')
@section('title', 'Cập nhật mật khẩu')
@section('content')
<main>
    <div class="contact-area-2 pt-130 pb-130">
        <div class="container">
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
                        <form action="{{route('postResetPassword',$email)}}" method="post">
                            @csrf
                            <div class="row">
                                @if(session()->has('error'))
                                <div  style="background-color: #f44336;" class="alert">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>Danger!</strong> {{session()->get('error')}}
                                </div>
                                @endif
                                <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="password"   placeholder="Nhập mật khẩu mới" name="password" value="{{old('password')}}">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-msg">
                                        <input type="password"  placeholder="Nhập lại mật khẩu mới" name="re_password" value="{{old('re_password')}}">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary">Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection