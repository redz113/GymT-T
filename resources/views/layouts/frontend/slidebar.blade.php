<aside class="slide-bar">
    <div class="close-mobile-menu">
        <a href="javascript:void(0);"><i class="fas fa-times"></i></a>
    </div>
    <nav class="side-mobile-menu">
        <ul id="mobile-menu-active">
            <li class="has-children">
                <a href="{{ route('home') }}">HOME</a>
                <ul class="sub-menu">
                    <li><a href="index.html">Homepage One</a></li>
                    <li><a href="index-2.html">Homepage Two</a></li>
                    <li><a href="index-3.html">Homepage Three</a></li>
                    <li><a href="index-4.html">Homepage Four</a></li>
                    <li><a href="index-5.html">Homepage Five</a></li>
                </ul>
            </li>
            <li class="has-dropdown">
                <a href="#">Trang</a>
                <ul class="sub-menu">
                    <li><a href="about.html">About Page</a></li>
                    <li><a href="bmi-calculator.html">BMI Calculator</a></li>
                    <li><a href="service.html">Service Page</a></li>
                    <li><a href="trainer.html">Trainer Page</a></li>
                    <li><a href="trainer-details.html">Trainer Details</a></li>
                    <li><a href="pricing.html">Pricing Page</a></li>
                    <li><a href="404.html">404 Page</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a href="class.html">CLASSES</a>
                <ul class="sub-menu">
                    <li><a href="class.html">Class Page</a></li>
                    <li><a href="class-2.html">Class Two</a></li>
                    <li><a href="class-schedule.html">Class Schedule</a></li>
                    <li><a href="class-details.html">Class Details One</a></li>
                    <li><a href="class-details-2.html">Class Details Two</a></li>
                    <li><a href="class-details-3.html">Class Details Three</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a href="gallery.html">Gallery</a>
                <ul class="sub-menu">
                    <li><a href="gallery.html">Gallery Page</a></li>
                    <li><a href="gallery-2.html">Gallery Page Two</a></li>
                    <li><a href="gallery-carousel.html">Gallery Carousel</a></li>
                    <li><a href="gallery-details.html">Gallery Details</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a href="blog.html">BLOG</a>
                <ul class="sub-menu">
                    <li><a href="blog-grid.html">Blog Grid</a></li>
                    <li><a href="blog.html">Blog Standard</a></li>
                    <li><a href="blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a href="shop.html">SHOP</a>
                <ul class="sub-menu">
                    <li><a href="shop.html">Shop Page</a></li>
                    <li><a href="shop-2.html">Shop Two</a></li>
                    <li><a href="shop-details.html">Shop Details</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a href="contact.html">Contact</a>
                <ul class="sub-menu">
                    <li><a href="contact.html">Contact Page</a></li>
                    <li><a href="contact-2.html">Contact Two</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    {{-- <div class="sidebar-widget-wrapper">
        <div class="mt-8 text-center">
            <img src="{{asset(Auth::check() ? Auth::user()->avatar : 'https://vtv1.mediacdn.vn/thumb_w/650/2014/incognito-chrome-spicytricks-1420018283508.jpg')}}" alt="" class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28 rounded-circle">
            <h5 class="hidden mt-4 text-xl font-semibold text-gray-600 lg:block">{{Auth::check() ? Auth::user()->name : 'Đăng nhập'}}</h5>
            @if(Auth::check())
            <a href="{{route('logout')}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                </svg></a>
            @else
            <a href="{{route('login')}}">
                <span class="svg-icon svg-icon-primary svg-icon-2x">
                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Sign-out.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) " />
                            <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1" />
                            <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) " />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </a>
            @endif
        </div>
    </div>     --}}
    <div class="sidebar-widget-wrapper">
        <div class="sidebar-widget logo-side">
            <a href="{{ route('home') }}">
                <img src="{{asset('frontend/assets/img/logo/logo.png')}}" alt="logo">
            </a>
        </div>

        <div class="sidebar-widget">
            <div class="d-flex justify-content-around align-items-center">
                <div class="">
                    <div class="about-thumb-wrap text-center mb-30">
                        <img style="border-radius: 50%; width: 70px; height: 70px;" src="{{asset(Auth::check() ? Auth::user()->avatar : 'https://vtv1.mediacdn.vn/thumb_w/650/2014/incognito-chrome-spicytricks-1420018283508.jpg')}}" alt="about">
                    </div>
                </div>
                <div class="">
                    <div class="info-wdget">
                        @if(Auth::check())
                        <h4 class="widget-title">{{Auth::user()->name}}</h4>
                        @endif
                    </div>
                    @if(Auth::check())
                        <a href="{{route('logout')}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                            </svg></a>
                        @else
                        <a href="{{route('login')}}">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Sign-out.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) " />
                                        <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1" />
                                        <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) " />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </a>
                        @endif
                </div>

            </div>
        </div>
        @if(Auth::check())
            <div class="sidebar-widget">
                <div class="info-wdget">
                    @hasrole('member')
                        <a href="{{route('account.schedule')}}" style="background-color: #eb5b40; border-radius: 30px; padding: 15px 20px 15px 20px;" class="btn btn-primary">Tài khoản của tôi</a>
                    @endhasrole

                    @hasrole('coach|coachbx')
                        <a href="{{route('accountPt.profile')}}" style="background-color: #eb5b40; border-radius: 30px; padding: 15px 20px 15px 20px;" class="btn btn-primary">Tài khoản của tôi</a>
                    @endhasrole
                    

                    @hasrole('admin')
                        <a href="{{route('admin.index')}}" style="background-color: #eb5b40; border-radius: 30px; padding: 15px 20px 15px 20px;" class="btn btn-primary">Đến trang quản trị</a>
                    @endhasrole
                    
                </div>
            </div>
        @endif
        
        <div class="sidebar-widget">
            <div class="info-wdget">
                <h4 class="widget-title">Số Điện Thoại</h4>
                @if(Auth::check())
                    <p> +0{{ auth::user()->phone }} </p>
                @endif
            </div>
        </div>

        <div class="sidebar-widget">
            <div class="info-wdget">
                <h4 class="widget-title">Email Liên Hệ</h4>
                @if(Auth::check())
                    <p>{{ auth::user()->email }}</p>
                @endif
            </div>
        </div>

        <div class="sidebar-widget">
            <div class="instagram">
                <a href="#">
                    <img src="{{asset('frontend/assets/img/widget/gallery-1.jpg')}}" alt="instagram">
                </a>
                <a href="#">
                    <img src="{{asset('frontend/assets/img/widget/gallery-2.jpg')}}" alt="instagram">
                </a>
                <a href="#">
                    <img src="{{asset('frontend/assets/img/widget/gallery-3.jpg')}}" alt="instagram">
                </a>
                <a href="#">
                    <img src="{{asset('frontend/assets/img/widget/gallery-4.jpg')}}" alt="instagram">
                </a>
                <a href="#">
                    <img src="{{asset('frontend/assets/img/widget/gallery-1.jpg')}}" alt="instagram">
                </a>
                <a href="#">
                    <img src="{{asset('frontend/assets/img/widget/gallery-2.jpg')}}" alt="instagram">
                </a>
            </div>
        </div>

        <div class="sidebar-widget">
            <div class="social-widget">
                <a href="#">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fab fa-google-plus-g"></i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
</aside>