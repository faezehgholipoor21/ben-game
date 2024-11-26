<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content>
    <meta name="keywords" content>

    <title>
        @yield('title')
    </title>

    <link rel="icon" type="image/x-icon" href="{{asset('site/assets/img/logo/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('site/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/all-fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/nice-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/dropify/css/dropify.min.css')}}">


    <style>
        .header-top{
            padding: 10px 0 12px;
            position: relative;
            background: var(--theme-color) !important;
            z-index: 4;
        }
        .header-top-list li a i{
            color: var(--color-white) !important;
        }
        .user_image{
            width: 90px;
            height: 90px;
        }
    </style>
    @yield('custom-css')
</head>
<body>

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
                        <a class="navbar-brand" href="#">
                            <img src="{{asset('site/assets/img/logo/logo.png')}}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-6 col-xl-5">
                    <div class="header-middle-search">
                        <form action="#">
                            <div class="search-content">
                                <input type="text" class="form-control" placeholder="در اینجا جستجو کنید...">
                                <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-7 col-lg-3 col-xl-4">
                    <div class="header-middle-right">
                        <ul class="header-middle-list">
                            <li class="dropdown-cart">
                                <a href="#" class="shop-cart list-item">
                                    <i class="far fa-shopping-bag"></i>
                                    <span>5</span>
                                </a>
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
                                                        <img src="{{asset('site/assets/img/product/p47.png')}}" alt="#">
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
                                                        <img src="{{asset('site/assets/img/product/p12.png')}}" alt="#">
                                                    </a>
                                                </div>
                                                <div class="cart-info">
                                                    <h4><a href="#">ساعت آبی اپل</a></h4>
                                                    <p class="cart-qty">1x - <span class="cart-amount">120$</span></p>
                                                </div>
                                                <a href="#" class="cart-remove" title="حذف این مورد"><i
                                                        class="far fa-times-circle"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-cart-item">
                                                <div class="cart-img">
                                                    <a href="#"><img src="{{asset('site/assets/img/product/p32.png')}}" alt="#"></a>
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
                <a class="navbar-brand" href="#">
                    <img src="{{asset('site/assets/img/logo/logo.png')}}" class="logo-scrolled" alt="logo">
                </a>
                <div class="mobile-menu-right">
                    <div class="search-btn">
                        <button type="button" class="nav-right-link">
                            <i class="far fa-search"></i>
                        </button>
                        <div class="mobile-search-form">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="در اینجا جستجو کنید...">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-mobile-icon">
                            <i class="far fa-bars"></i>
                        </span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.home')}}">
                                صفحه اصلی
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.products')}}">
                                خرید آنلاین
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.google_play')}}">
                                خرید از گوگل پلی
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.blog')}}">
                                وبلاگ
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.faq')}}">
                                سوالات متداول
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('site.rule')}}">
                                قوانین
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('site.about_us')}}">
                                درباره ما
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('site.contact')}}">
                                تماس با ما
                            </a>
                        </li>
                    </ul>
                    <div class="nav-right">
                        <div class="nav-right-btn">
                            <a href="#" class="theme-btn">فروشنده شوید</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<main class="main">
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">داشبورد مشتری</h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{route('site.home')}}" target="_blank">
                            <i class="far fa-home"></i>
                            صفحه اصلی
                        </a>
                    </li>
                    <li class="active">داشبورد مشتری</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="user-area bg py-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="sidebar-top">
                            <div class="sidebar-profile-img">
                                <img src="{{asset($user_info['user_image'])}}" alt="" class="user_image">
                                <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                                <input type="file" class="profile-img-file">
                            </div>
                            <h5>
                                {{$user_info['first_name'] .' '. $user_info['last_name']}}
                            </h5>
                        </div>
                        <ul class="sidebar-list">
                            <li>
                                <a class="active" href="{{route('user.dashboard')}}">
                                    <i class="far fa-gauge-high"></i>
                                    داشبورد مشتری
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="far fa-user"></i>
                                    نمایه من
                                </a>
                            </li>
                            {{--                            <li>--}}
                            {{--                                <a href="#">--}}
                            {{--                                    <i class="far fa-layer-group"></i>--}}
                            {{--                                    محصولات--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            {{--                            <li>--}}
                            {{--                                <a href="#">--}}
                            {{--                                    <i class="far fa-upload"></i>--}}
                            {{--                                    افزودن محصول جدید--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            <li>
                                <a href="{{route('user.orders')}}">
                                    <i class="far fa-shopping-bag"></i>
                                    همه سفارش‌ها
                                    <span class="badge badge-danger">02</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="far fa-wallet"></i>
                                    کیف پول
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="far fa-credit-card"></i>
                                    تراکنش
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="far fa-bell"></i>
                                    اعلان
                                    <span class="badge badge-danger">02</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="far fa-envelope"></i>
                                    پیام‌ها
                                    <span class="badge badge-danger">02</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="far fa-gear"></i>
                                    تنظیمات
                                </a>
                            </li>
                            <li>
                                <a href="{{route('site_logout')}}">
                                    <i class="far fa-sign-out"></i>
                                    خروج
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

<footer class="footer-area">
    <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrapper pt-100 pb-70">
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box about-us">
                        <a href="#" class="footer-logo">
                            <img src="{{asset('site/assets/img/logo/logo-light.png')}}" alt>
                        </a>
                        <p class="mb-1">
                            ما انواع مختلفی از معابر در دسترس داریم، اما عمده آن دچار تغییر شده است
                            به شکلی با تزریق
                        </p>
                        <div class="footer-call">
                            <div class="footer-call-icon">
                                <i class="fal fa-headset"></i>
                            </div>
                            <div class="footer-call-info">
                                <p>24 ساعته به کمک نیاز دارید؟</p>
                                <a href="tel:+21236547898">09555555555</a>
                            </div>
                        </div>
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
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">پیوندهای سریع</h4>
                        <ul class="footer-list">
                            <li><a href="#">درباره ما</a></li>
                            <li><a href="#">فروشنده شوید</a></li>
                            <li><a href="#">با ما تماس بگیرید</a></li>
                            <li><a href="#">اخبار به‌روزرسانی</a></li>
                            <li><a href="#">شاهدات</a></li>
                            <li><a href="#">شرایط خدمات</a></li>
                            <li><a href="#">خط مشی رازداری</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">مرور رده</h4>
                        <ul class="footer-list">
                            <li><a href="#">لوازم جانبی</a></li>
                            <li><a href="#">خانه و باغ</a></li>
                            <li><a href="#">الکترونیک</a></li>
                            <li><a href="#">سلامت و زیبایی</a></li>
                            <li><a href="#">مواد غذایی</a></li>
                            <li><a href="#">اسباب‌بازی‌های کودک</a></li>
                            <li><a href="#">موسیقی و ویدیو</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">مرکز پشتیبانی</h4>
                        <ul class="footer-list">
                            <li><a href="#">سؤالات متداول</a></li>
                            <li><a href="#">نحوه خرید</a></li>
                            <li><a href="#">مرکز پشتیبانی</a></li>
                            <li><a href="#">سفارش خود را پیگیری کنید</a></li>
                            <li><a href="#">خط مشی بازگشت</a></li>
                            <li><a href="#">شرکت‌های وابسته ما</a></li>
                            <li><a href="#">نقشه سایت</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">تماس بگیرید</h4>
                        <p>از امروز با ما در تماس باشید. ما آماده کمک به شما هستیم.</p>
                        <ul class="footer-contact">
                            <li><a href="tel:+21236547898"><i class="far fa-phone"></i>09333333333</a></li>
                            <li><i class="far fa-map-marker-alt"></i>نیویورک ، خیابان میلفورد</li>
                            <li><a href="/cdn-cgi/l/email-protection#d9b0b7bfb699bca1b8b4a9b5bcf7bab6b4"><i
                                        class="far fa-envelope"></i><span class="__cf_email__"
                                                                          data-cfemail="7e171018113e1b061f130e121b501d1113">ad@info.com</span></a>
                            </li>
                            <li><i class="far fa-clock"></i>دوشنبه تا جمعه (9:00 صبح تا 8:00 عصر)</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="footer-top-link">
                        <h5>پیوندهای برتر</h5>
                        <div class="footer-top-link-info">
                            <a href="#">فروشندگان برتر</a>
                            <a href="#">موارد جدید</a>
                            <a href="#">لوازم جانبی</a>
                            <a href="#">الکترونیک</a>
                            <a href="#">مواد غذایی</a>
                            <a href="#">زیبایی</a>
                            <a href="#">سلامت</a>
                            <a href="#">اسباب‌بازی‌های کودک</a>
                            <a href="#">موسیقی</a>
                            <a href="#">مبلمان</a>
                            <a href="#">هدایا</a>
                            <a href="#">ورزش</a>
                            <a href="#">خودرو</a>
                            <a href="#">تماشا کنید</a>
                            <a href="#">نقشه سایت</a>
                            <a href="#">شرکت‌های وابسته ما</a>
                            <a href="#">خط مشی بازگشت</a>
                            <a href="#">ویدئو</a>
                            <a href="#">خانه و باغ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="copyright-wrap">
                <div class="row">
                    <div class="col-12 col-lg-4 align-self-center">
                        <div class="footer-payment">
                            <span>می پذیریم:</span>
                            <img src="assets//img/payment/visa.svg" alt>
                            <img src="assets//img/payment/mastercard.svg" alt>
                            <img src="assets//img/payment/amex.svg" alt>
                            <img src="assets//img/payment/discover.svg" alt>
                            <img src="assets//img/payment/paypal.svg" alt>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 align-self-center">
                        <p class="copyright-text">
                            © حق چاپ <span id="date">2024</span> <a href="#"> گومارت </a> کلیه حقوق محفوظ است.
                        </p>
                    </div>
                    <div class="col-12 col-lg-4 align-self-center">
                        <div class="footer-social">
                            <span>ما را دنبال کنید:</span>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>


<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
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
<script src="{{asset('site/assets/js/apexcharts.min.js')}}"></script>
<script src="{{asset('site/assets/js/apexchart-custom.js')}}"></script>
<script src="{{asset('site/assets/js/main.js')}}"></script>
<script src="{{asset('admin/assets/vendor/dropify/js/dropify.js')}}"></script>
<script src="{{asset('/vendor/sweetalert/sweetalert.all.js')}}"></script>
@include('sweetalert::alert')
@yield('custom-js')
</body>
</html>
