@extends('layouts.frontend.master')
@section('title', 'Contact')
@section('content')
<main>
        <!--    breadcrumb-area start    -->
        <section class="breadcrumb-area pt-180 pb-180 pt-md-120 pb-md-120 pt-xs-100 pb-xs-100 bg-fix" data-overlay="black"
                 data-opacity="7" data-background="assets/img/bg/breadcrumb-bg-4.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="breadcrumb-content">
                            <h3 class="title">Liên Hệ</h3>
                            <ul>
                                <li><a href="index.html">Trang chủ</a></li>
                                <li class="active">Liên hệ</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--    breadcrumb-area end    -->
    
        <!-- contact-area start -->
        <div class="contact-area-2 pt-130 pb-130">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="contact-info contact-info-2 justify-content-end">
                            <div class="icon-box">
                                <i class="flaticon-whatsapp"></i>
                            </div>
                            <div class="info-content">
                                <h4>Liên hệ</h4>
                                <span>0347525140</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="contact-info contact-info-2 justify-content-end">
                            <div class="icon-box">
                                <i class="flaticon-email"></i>
                            </div>
                            <div class="info-content">
                                <h4>Email</h4>
                                <span>gymt&t@gmail.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="contact-info contact-info-2 d-flex">
                            <div class="icon-box">
                                <i class="flaticon-pin"></i>
                            </div>
                            <div class="info-content" style="max-width: 280px !important;">
                                <h4>Đại chỉ</h4>
                                <span>Công ty cổ phần công nghệ Giáo dục 1</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mt-100">
                    <div class="col-md-6 col-lg-5">
                        <div class="contact-text text-left">
                            <div class="section-title-2 bar-theme-color contact-title">
                                <h3>Bạn có thể để lại thông tin và liên hệ với chúng tôi</h3>
                            </div>
                            <p>
                                GYM T&T luôn sẵn lòng phục vụ các bạn
                            </p>
                        
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-7">
                        <div class="contact-form contact-form-2">
                            <form action="#">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="input-wrap input-icon icon-name">
                                            <input type="text" placeholder="Họ tên">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="input-wrap input-icon icon-phone">
                                            <input type="text" placeholder="Số điện thoại">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                    <div class="input-wrap input-icon icon-email">
                                            <input type="text" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="input-wrap input-icon icon-msg">
                                            <textarea rows="5" placeholder="Nội dung" spellcheck="false"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button type="submit" class="btn btn-gra">
                                            Gửi <i class="fas fa-angle-double-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact-area end -->
    </main>
@endsection