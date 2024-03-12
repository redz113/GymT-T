<header class="header-area header-style-5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-xl-center">
            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                <div class="logo-area">
                    <a href="{{route('home')}}"><img src="{{asset('frontend/assets/img/logo/favicon.png')}}" alt="Logo"><strong style="color:white; font-size:30px;margin-top: -150px">GYM T&T</strong ></a>
                </div>
            </div>
            <div class="col-xl-8 d-xl-flex justify-content-center align-items-center d-none">
                <nav class="main-menu main-menu-white">
                    <ul>
                        <li class="has">
                            <a href="{{route('home')}}">Trang Chủ</a>
                        </li>
                        <li class="has-dropdown">
                            <a href="#">Trang</a>
                            <ul class="sub-menu">
                                <li><a href="#">Thông Tin</a></li>
                                <li><a href="#">Tính Chỉ Số IBM</a></li>
                            </ul>
                        </li>
                        <li class="has">
                            <a href="{{route('package_client.index')}}">Gói Tập</a>
                        </li>
                        <li class="has">
                            <a href="{{route('training.index')}}">Huấn Luyện Viên</a>
                        </li>
                        <li class="has">
                            <a href="{{route('post_client.index')}}">Bài Viết</a>
                        </li>
                        <li class="has">
                            <a href="{{route('contact_client.view')}}">Liên Hệ</a>
                        </li>

                    </ul>
                </nav>
                <div class="attr-menu attr-white">
                    <ul>
                        {{-- <li>
                            <a href="#" class="open-search"><i class="far fa-search"></i></a>
                        </li>
                        <li>
                            <a href="cart-page.html"><i class="far fa-shopping-bag"></i></a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-9 col-md-9 col-6 d-flex justify-content-end align-items-center">
                <div class="attr-menu attr-white d-none d-xl-none d-lg-inline-block d-md-inline-block pr-60">
                    <ul>
                        <li>
                            <a href="#" class="open-search"><i class="far fa-search"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="far fa-shopping-bag"></i></a>
                        </li>
                    </ul>
                </div>
                <a href="javascript:void(0);" class="hamburger-menu">
                    <div class="hamburger-btn">
                        <div class="hamburger-bar"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</header>