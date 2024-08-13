<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content>
    <meta name="keywords" content>

    <title>@yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{asset('site/assets/img/logo/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('site/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/all-fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/nice-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/style.css')}}">
    @yield('css')
</head>
<body class="home-2" dir="rtl">

<div class="preloader">
    <div class="loader-ripple">
        <div></div>
        <div></div>
    </div>
</div>


<header class="header">

    <div class="header-top">
        <div class="container">
            <div class="header-top-wrapper">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-10">
                        <div class="header-top-left">
                            <ul class="header-top-list">
                                <li><a href="">
                                        <span>خرید گیف کارت</span>
                                    </a>
                                </li>
                                <li><a href="">
                                        <span>خرید سی پی کالاف دیوتی موبایل</span>
                                    </a>
                                </li>
                                <li><a href="">
                                        <span>خرید جم فری فایر</span>
                                    </a>
                                </li>
                                <li><a href="">
                                        <span>خرید اکانت قانونی پلی استیشن</span>
                                    </a>
                                </li>
                                <li><a href="">
                                        <span>خرید اکانت پرمیوم</span>
                                    </a>
                                </li>
                                <li><a href="">
                                        <span>خرید اکانت تلگرام پرمیوم</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="header-top-right">
                            <ul class="header-top-list">
                                <li class="social">
                                    <div class="header-top-social">
                                        <span>ما را دنبال کنید: </span>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-telegram"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-linkedin"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-5 col-lg-3 col-xl-3">
                    <div class="header-middle-logo">
                        <a class="navbar-brand" href="{{route('site.home')}}">
                            <img src="{{asset('site/assets/img/logo/logo.png')}}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-6 col-xl-5">
                    <div class="header-middle-search">
                        <form action="{{route('site.search')}}" method="post">
                            @csrf
                            <div class="search-content">
                                <input type="text" class="form-control" placeholder="در اینجا جستجو کنید..."
                                       name="query">
                                <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-7 col-lg-3 col-xl-4">
                    <div class="header-middle-right">
                        <ul class="header-middle-list">
                            <li><a href="#" class="list-item"><i class="far fa-arrows-rotate"></i><span>0</span></a>
                            </li>
                            <li><a href="#" class="list-item"><i class="far fa-heart"></i><span>0</span></a></li>
                            <li class="dropdown-cart">
                                <a href="#" class="shop-cart list-item"><i class="far fa-shopping-bag"></i>
                                    <span>5</span></a>
                                <div class="dropdown-cart-menu">
                                    <div class="dropdown-cart-header">
                                        <span>03 مورد</span>
                                        <a href="#">مشاهده سبد خرید</a>
                                    </div>
                                    <ul class="dropdown-cart-list">
                                        <li>
                                            <div class="dropdown-cart-item">
                                                <div class="cart-img">
                                                    <a href="#">
                                                        <img src="#" alt="#"/>
                                                    </a>
                                                </div>
                                                <div class="cart-info">
                                                    <h4><a href="#">ایکسا ها ای 15 قرمز</a></h4>
                                                    <p class="cart-qty">1x - <span
                                                            class="cart-amount">200.00 ریال</span>
                                                    </p>
                                                </div>
                                                <a href="#" class="cart-remove" title="حذف این مورد"><i
                                                        class="far fa-times-circle"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-cart-item">
                                                <div class="cart-img">
                                                    <a href="#">
                                                        <img src="#" alt="#">
                                                    </a>
                                                </div>
                                                <div class="cart-info">
                                                    <h4><a href="#">ساعت آبی اپل</a></h4>
                                                    <p class="cart-qty">1x - <span class="cart-amount">120$</span>
                                                    </p>
                                                </div>
                                                <a href="#" class="cart-remove" title="حذف این مورد"><i
                                                        class="far fa-times-circle"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-cart-item">
                                                <div class="cart-img">
                                                    <a href="#">
                                                        <img src="{{asset('site/assets/img/product/p32.png')}}"
                                                             alt="#">
                                                    </a>
                                                </div>
                                                <div class="cart-info">
                                                    <h4><a href="#">ژاکت نارنجی</a></h4>
                                                    <p class="cart-qty">1x - <span class="cart-amount">330.00$</span>
                                                    </p>
                                                </div>
                                                <a href="#" class="cart-remove" title="حذف این مورد"><i
                                                        class="far fa-times-circle"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="dropdown-cart-bottom">
                                        <div class="dropdown-cart-total">
                                            <span>مجموع</span>
                                            <span class="total-amount">650.00 ریال</span>
                                        </div>
                                        <a href="#" class="theme-btn">تسویه حساب</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{route('site.home')}}">
                    <img src="{{asset('site/assets/img/logo/logo.png')}}" class="logo-scrolled" alt="logo">
                </a>
                <div class="category-all">
                    <button class="category-btn" type="button">
                        <i class="far fa-grid-2-plus"></i><span>همه دسته ها</span>
                    </button>
                    <ul class="main-category hide-category">
                        @foreach($category_info as $item)
                            <li>
                                <a href="">
                                    <span>{{$item['cat_title']}}</span><i class="far fa-angle-left"></i>
                                </a>
                                <div class="sub-category-mega">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="category-single">
                                                <div class="category-link">
                                                    <a href="#"><img
                                                            src="{{asset('site/assets/img/category_post/05.jpg')}}"
                                                            alt></a>
                                                    <a href="#">اسباب‌بازی‌های کودکان</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mobile-menu-right">
                    <div class="search-btn">
                        <button type="button" class="nav-right-link"><i class="far fa-search"></i></button>
                        <div class="mobile-search-form">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="در اینجا جستجو کنید...">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.home')}}">صفحه اصلی</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="">خرید آنلاین</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.google_play')}}">خرید از گوگل پلی</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.blog')}}">وبلاگ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.faq')}}">سوالات متداول</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.rule')}}">قوانین</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('site.about_us')}}">درباره ما</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('site.contact')}}">تماس با ما</a></li>
                    </ul>
                    <div class="nav-right">
                        <div class="nav-right-btn">
                            @if(Auth()->check())
                                @if($role_id == 2)
                                    <a href="{{route('user.dashboard')}}" class="theme-btn">
                                        {{$user_info['first_name'] . ' ' . $user_info['last_name'] }}
                                    </a>
                                @elseif($role_id == 3)
                                    <a href="{{route('admin_norm.dashboard')}}" class="theme-btn">
                                        {{$user_info['first_name'] . ' ' . $user_info['last_name'] }}
                                    </a>
                                @endif
                            @else
                                <a href="{{route('site_login')}}" class="theme-btn">ورود</a>
                                <a href="{{route('site.register')}}" class="theme-btn">ثبت نام</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<main class="main">

    @yield('content')
</main>

<footer class="footer-area">
    <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrapper pt-100 pb-40">
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box about-us">
                        <a href="#" class="footer-logo">
                            <img src="{{asset('site/assets/img/logo/logo-light.png')}}" alt>
                        </a>
                        <p class="mb-1">
                            ما انواع مختلفی از معابر در دسترس داریم، اما اکثریت آنها دچار تغییر شده اند
                            برخی از آنها تزریق شده است که حتی کمی باورپذیر به نظر نمی رسند.
                        </p>
                        <div class="footer-download">
                            <h5>برنامه موبایل ما را دریافت کنید</h5>
                            <div class="footer-download-btn">
                                <a href="#">
                                    <i class="fab fa-google-play"></i>
                                    <div class="download-btn-info">
                                        <span>آن را روشن کنید</span>
                                        <h6>گوگل پلی</h6>
                                    </div>
                                </a>
                                <a href="#">
                                    <i class="fab fa-app-store"></i>
                                    <div class="download-btn-info">
                                        <span>آن را روشن کنید</span>
                                        <h6>فروشگاه برنامه</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="footer-social">
                            <span>ما را دنبال کنید:</span>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">پیوندهای سریع</h4>
                        <ul class="footer-list">
                            <li><a href="{{route('site.about_us')}}"><i class="fas fa-caret-left"></i>درباره ما</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>فروشنده شوید</a></li>
                            <li><a href="{{route('site.contact')}}"><i class="fas fa-caret-left"></i>تماس با ما</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>اخبار به‌روزرسانی</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>شاهدات</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>شرایط خدمات</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>خط مشی رازداری</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">مرکز پشتیبانی</h4>
                        <ul class="footer-list">
                            <li><a href="#"><i class="fas fa-caret-left"></i>سؤالات متداول</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>نحوه خرید</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>مرکز پشتیبانی</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>سفارش خود را پیگیری کنید</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>خط مشی بازگشت</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>شرکت‌های وابسته ما</a></li>
                            <li><a href="#"><i class="fas fa-caret-left"></i>نقشه سایت</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">تماس بگیرید</h4>
                        <div class="footer-call">
                            <div class="footer-call-icon">
                                <i class="fal fa-headset"></i>
                            </div>
                            <div class="footer-call-info">
                                <p>24 ساعته به کمک نیاز دارید؟</p>
                                <a href="tel:+21236547898">09555555555</a>
                            </div>
                        </div>
                        <ul class="footer-contact">
                            <li><a href="tel:+21236547898"><i class="far fa-phone"></i>09333333333</a></li>
                            <li><i class="far fa-map-marker-alt"></i>نیویورک ، خیابان میلفورد</li>
                            <li><a href="/cdn-cgi/l/email-protection#375e59515877524f565a475b521954585a"><i
                                        class="far fa-envelope"></i><span class="__cf_email__"
                                                                          data-cfemail="345d5a525b74514c55594458511a575b59">ad@info.com</span></a>
                            </li>
                            <li><i class="far fa-clock"></i>دوشنبه تا جمعه (9:00 صبح تا 8:00 عصر)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="copyright-wrap">
                <div class="row">
                    <div class="col-12 col-md-6 align-self-center">
                        <p class="copyright-text">
                            © حق چاپ <span id="date">2024</span> <a href="#"> گومارت </a> کلیه حقوق محفوظ است.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 align-self-center">
                        <div class="footer-payment">
                            <span>می پذیریم:</span>
                            <img src="{{asset('site/assets//img/payment/visa.svg')}}" alt>
                            <img src="{{asset('site/assets//img/payment/mastercard.svg')}}" alt>
                            <img src="{{asset('site/assets//img/payment/amex.svg')}}" alt>
                            <img src="{{asset('site/assets//img/payment/discover.svg')}}" alt>
                            <img src="{{asset('site/assets//img/payment/paypal.svg')}}" alt>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>


<div class="modal quickview fade" id="quickview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="quickview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                    class="far fa-xmark"></i></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <img src="{{asset('site/assets/img/product/p11.png')}}" alt="#">
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h4 class="quickview-title">گوشی های بلوتوث برتر</h4>
                            <div class="quickview-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="rating-count"> (4 نظر مشتری)</span>
                            </div>
                            <div class="quickview-price">
                                <h5>
                                    <del>690 ریال</del>
                                    <span>650 ریال</span></h5>
                            </div>
                            <ul class="quickview-list">
                                <li>نام تجاری:<span>بیتس</span></li>
                                <li>دسته:<span>هدفون</span></li>
                                <li> موجودی:<span class="stock">موجود</span></li>
                                <li>کد:<span>676TYWV</span></li>
                            </ul>
                            <div class="quickview-cart">
                                <a href="#" class="theme-btn">افزودن به سبد خرید</a>
                            </div>
                            <div class="quickview-social">
                                <span>اشتراک گذاری:</span>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script data-cfasync="false"
        src="{{asset('site//cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
<script src="{{asset('site/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('site/assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('site/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('site/assets/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('site/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('site/assets/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('site/assets/js/jquery.appear.min.js')}}"></script>
<script src="{{asset('site/assets/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('site/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('site/assets/js/counter-up.js')}}"></script>
<script src="{{asset('site/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('site/assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('site/assets/js/countdown.min.js')}}"></script>
<script src="{{asset('site/assets/js/wow.min.js')}}"></script>
<script src="{{asset('site/assets/js/main.js')}}"></script>
<script src="{{asset('admin/assets/js/sweetalert.all.js')}}"></script>
@include('sweetalert::alert')
@yield('js')
</body>
</html>
