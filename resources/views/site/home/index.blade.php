@extends('layouts.site_layout')
@section('title')
    سایت بازی
@endsection

@section('custom-css')
@endsection

@section('custom-js')
@endsection

@section('content')
    <div class="hero-section2">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="hero-slider-wrap">
                        <div class="hero-slider owl-carousel owl-theme">
                            @foreach($slider_info as $slider)
                                <div class="hero-single">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-md-12 col-lg-7">
                                                <div class="hero-content">
                                                    <h6 class="hero-sub-title" data-animation="fadeInUp"
                                                        data-delay=".25s">
                                                        {{$slider['discount_text']}}
                                                    </h6>
                                                    <h1 class="hero-title" data-animation="fadeInRight"
                                                        data-delay=".50s">
                                                        {{$slider['bold_text']}}
                                                    </h1>
                                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                                        {{$slider['description']}}
                                                    </p>
                                                    <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                                        <a href="#" class="theme-btn">
                                                            اکنون خرید کنید
                                                            <i class="fas fa-arrow-left"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-5">
                                                <div class="hero-right">
                                                    <div class="hero-img">
                                                        <img src="{{asset($slider['src'])}}" alt
                                                             data-animation="fadeInRight" data-delay=".25s">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-banner">
                        <div class="container">
                            <div class="row">
                                @foreach($banner_info as $banner)
                                    <div class="col-md-6 col-lg-12 px-lg-0">
                                        <div class="banner-item">
                                            <img src="{{asset($banner['src'])}}" alt="{{$banner['tiny_text']}}">
                                            <div class="banner-content">
                                                <p>
                                                    {{$banner['tiny_text']}}
                                                </p>
                                                <h3>
                                                    {{$banner['bold_text']}}
                                                </h3>
                                                <a href="#">خرید کنید</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="feature-area2 mt-20">
        <div class="container">
            <div class="feature-wrap">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fal fa-truck"></i>
                            </div>
                            <div class="feature-content">
                                <h4>تحویل رایگان</h4>
                                <p>سفارش‌های بیش از 120 ریال</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fal fa-sync"></i>
                            </div>
                            <div class="feature-content">
                                <h4>بازپرداخت</h4>
                                <p>بازگرداندن ظرف 30 روز</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fal fa-wallet"></i>
                            </div>
                            <div class="feature-content">
                                <h4>پرداخت مطمئن</h4>
                                <p>پرداخت 100% ایمن</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fal fa-headset"></i>
                            </div>
                            <div class="feature-content">
                                <h4>پشتیبانی 24/7</h4>
                                <p>با ما تماس بگیرید</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="category-area2 py-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <h2 class="site-title">
                            دسترسی سریع به دسته های اصلی
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($categories as $category)
                    <div class="col-6 col-md-4 col-lg-2 text-center">
                        <div class="category-item">
                            <a href="{{route('site.category_index' , ['cat_id' => $category['id']])}}">
                                <div class="category-info">
                                    <div class="icon">
                                        <img src="{{asset($category['cat_image'])}}" alt>
                                    </div>
                                    <div class="content">
                                        <h4>{{$category['cat_title']}}</h4>
                                        <p>{{\App\Helper\CalculateSubCatCount::calculate_sub_cat_count($category['id'])}}
                                            مورد</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <div class="small-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="banner-item">
                        <img src="{{asset('site/assets/img/banner/mini-banner-1.jpg')}}" alt>
                        <div class="banner-content">
                            <p>مجموعه های داغ</p>
                            <h3> بهترین فروش سفر <br>مجموعه‌های </h3>
                            <a href="#">اکنون کشف کنید</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="banner-item">
                        <img src="{{asset('site/assets/img/banner/mini-banner-2.jpg')}}" alt>
                        <div class="banner-content">
                            <p>مجموعه‌های اپل</p>
                            <h3>ساعت هوشمند اپل <br> کالکشن</h3>
                            <a href="#">اکنون خرید کنید</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="banner-item">
                        <img src="{{asset('site/assets/img/banner/mini-banner-3.jpg')}}" alt>
                        <div class="banner-content">
                            <p>مجموعه‌های کفش</p>
                            <h3>فصل تابستان <br> کفش تا <span>50%</span> تخفیف</h3>
                            <a href="#">اکنون کشف کنید</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pt-80 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading-inline">
                        <h2 class="site-title">
                            <img src="{{asset('site/assets/img/icon/hot.svg')}}" alt>
                            بازی های موبایل
                        </h2>
                    </div>
                </div>
            </div>
            @if(!empty($category_mobile->all()))
                <div class="product-slider owl-carousel owl-theme">
                    @foreach($category_mobile as $category)
                        <div class="product-item">
                            <div class="product-img">
                                <span class="type new">جدید</span>
                                <a href="{{route('site.category_detail' , ['cat_id' => $category['id']])}}">
                                    <img src="{{asset($category['cat_image'])}}" alt>
                                </a>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title">
                                    <a href="{{route('site.category_detail' , ['cat_id' => $category['id']])}}">
                                        {{$category['cat_title']}}
                                    </a>
                                </h3>
                                <div class="product-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="alert alert-warning">
                    هنوز بازی ای ثبت نشده است
                </p>
            @endif
        </div>
    </div>


    <div class="deal-area">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-12 col-lg-6">
                    <div class="deal-img">
                        <img src="{{asset('site/assets/img/deal/01.jpg')}}" alt="#">
                    </div>
                </div>
                <div class="col-12 col-lg-6 align-self-center">
                    <div class="deal-content">
                        <span class="deal-sub-title">تخفیف امروز با 20% تخفیف</span>
                        <h3 class="deal-title">کیف ساحلی تابستانی با لوازم جانبی زنانه زیبا.</h3>
                        <p class="deal-text">تنوع‌های زیادی از قسمت‌ها وجود دارد، اما اکثریت آن‌ها را دارند
                            دچار تغییر در برخی از اشکال کلمات حتی کمی باور به نظر می رسد.</p>
                        <h3 class="deal-price"><span>1020 ریال</span>
                            <del>1200 ریال</del>
                        </h3>
                        <div class="col-lg-9">
                            <div class="deal-countdown" dir="ltr">
                                <div class="countdown" data-countdown="2030/12/30"></div>
                            </div>
                        </div>
                        <div class="deal-btn">
                            <a href="#" class="theme-btn">اکنون بخرید<i class="fas fa-arrow-left"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area py-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading-inline">
                        <h2 class="site-title"><img src="{{asset('site/assets/img/icon/new.svg')}}" alt>موارد جدید</h2>
                        <a href="#">مشاهده بیشتر <i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="product-slider owl-carousel owl-theme">
                <div class="product-item">
                    <div class="product-img">
                        <span class="type new">جدید</span>
                        <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p27.png')}}" alt></a>
                        <div class="product-action-wrap">
                            <div class="product-action">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-tooltip="tooltip"
                                   title="نمایش سریع"><i class="far fa-eye"></i></a>
                                <a href="#" data-tooltip="tooltip" title="اضافه کردن به علاقه مندی ها"><i
                                        class="far fa-heart"></i></a>
                                <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i
                                        class="far fa-arrows-repeat"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title"><a href="shop-single.html">ایرفون بلوتوث</a></h3>
                        <div class="product-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="product-bottom">
                            <div class="product-price">
                                <span>100.00 ریال</span>
                            </div>
                            <button type="button" class="product-cart-btn" data-bs-placement="right"
                                    data-tooltip="tooltip" title="افزودن به سبد خرید">
                                <i class="far fa-shopping-bag"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-img">
                        <span class="type new">جدید</span>
                        <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p10.png')}}" alt></a>
                        <div class="product-action-wrap">
                            <div class="product-action">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-tooltip="tooltip"
                                   title="نمایش سریع"><i class="far fa-eye"></i></a>
                                <a href="#" data-tooltip="tooltip" title="اضافه کردن به علاقه مندی ها"><i
                                        class="far fa-heart"></i></a>
                                <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i
                                        class="far fa-arrows-repeat"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title"><a href="shop-single.html">ایرفون بلوتوث</a></h3>
                        <div class="product-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="product-bottom">
                            <div class="product-price">
                                <span>100.00 ریال</span>
                            </div>
                            <button type="button" class="product-cart-btn" data-bs-placement="right"
                                    data-tooltip="tooltip" title="افزودن به سبد خرید">
                                <i class="far fa-shopping-bag"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-img">
                        <span class="type new">جدید</span>
                        <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p42.png')}}" alt></a>
                        <div class="product-action-wrap">
                            <div class="product-action">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-tooltip="tooltip"
                                   title="نمایش سریع"><i class="far fa-eye"></i></a>
                                <a href="#" data-tooltip="tooltip" title="اضافه کردن به علاقه مندی ها"><i
                                        class="far fa-heart"></i></a>
                                <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i
                                        class="far fa-arrows-repeat"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title"><a href="shop-single.html">ایرفون بلوتوث</a></h3>
                        <div class="product-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="product-bottom">
                            <div class="product-price">
                                <span>100.00 ریال</span>
                            </div>
                            <button type="button" class="product-cart-btn" data-bs-placement="right"
                                    data-tooltip="tooltip" title="افزودن به سبد خرید">
                                <i class="far fa-shopping-bag"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-img">
                        <span class="type new">جدید</span>
                        <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p43.png')}}" alt></a>
                        <div class="product-action-wrap">
                            <div class="product-action">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-tooltip="tooltip"
                                   title="نمایش سریع"><i class="far fa-eye"></i></a>
                                <a href="#" data-tooltip="tooltip" title="اضافه کردن به علاقه مندی ها"><i
                                        class="far fa-heart"></i></a>
                                <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i
                                        class="far fa-arrows-repeat"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title"><a href="shop-single.html">ایرفون بلوتوث</a></h3>
                        <div class="product-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="product-bottom">
                            <div class="product-price">
                                <del>120 ریال</del>
                                <span>100.00 ریال</span>
                            </div>
                            <button type="button" class="product-cart-btn" data-bs-placement="right"
                                    data-tooltip="tooltip" title="افزودن به سبد خرید">
                                <i class="far fa-shopping-bag"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-img">
                        <span class="type new">جدید</span>
                        <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p35.png')}}" alt></a>
                        <div class="product-action-wrap">
                            <div class="product-action">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-tooltip="tooltip"
                                   title="نمایش سریع"><i class="far fa-eye"></i></a>
                                <a href="#" data-tooltip="tooltip" title="اضافه کردن به علاقه مندی ها"><i
                                        class="far fa-heart"></i></a>
                                <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i
                                        class="far fa-arrows-repeat"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title"><a href="shop-single.html">ایرفون بلوتوث</a></h3>
                        <div class="product-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="product-bottom">
                            <div class="product-price">
                                <span>100.00 ریال</span>
                            </div>
                            <button type="button" class="product-cart-btn" data-bs-placement="right"
                                    data-tooltip="tooltip" title="افزودن به سبد خرید">
                                <i class="far fa-shopping-bag"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="big-banner mt-100">
        <div class="container">
            <div class="banner-wrap" style="background-image: url({{asset('site/assets/img/banner/big-banner.jpg')}});">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="banner-content">
                            <div class="banner-info">
                                <h6>مجموعه‌های مگا</h6>
                                <h2>فروش بسیار زیاد تا <span>40%</span> تخفیف</h2>
                                <p>در فروشگاه‌های فروش ما</p>
                            </div>
                            <a href="#" class="theme-btn">اکنون خرید کنید<i class="fas fa-arrow-left"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="product-list pt-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="product-list-box">
                        <h2 class="product-list-title">در فروش</h2>
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p39.png')}}"
                                                                alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single.html">عینک پلیسی عالی</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <del>60.00</del>
                                    <span>40.00 ریال</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="right" data-tooltip="tooltip"
                               title="افزودن به سبد خرید"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p2.png')}}"
                                                                alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single.html">عینک پلیسی عالی</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <del>60.00</del>
                                    <span>40.00 ریال</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="right" data-tooltip="tooltip"
                               title="افزودن به سبد خرید"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p3.png')}}"
                                                                alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single.html">عینک پلیسی عالی</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <del>60.00</del>
                                    <span>40.00 ریال</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="right" data-tooltip="tooltip"
                               title="افزودن به سبد خرید"><i class="far fa-shopping-bag"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="product-list-box">
                        <h2 class="product-list-title">پرفروش ترین</h2>
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p4.png')}}"
                                                                alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single.html">عینک پلیسی عالی</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <del>60.00</del>
                                    <span>40.00 ریال</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="right" data-tooltip="tooltip"
                               title="افزودن به سبد خرید"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p5.png')}}"
                                                                alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single.html">عینک پلیسی عالی</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <del>60.00</del>
                                    <span>40.00 ریال</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="right" data-tooltip="tooltip"
                               title="افزودن به سبد خرید"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p6.png')}}"
                                                                alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single.html">عینک پلیسی عالی</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <del>60.00</del>
                                    <span>40.00 ریال</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="right" data-tooltip="tooltip"
                               title="افزودن به سبد خرید"><i class="far fa-shopping-bag"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="product-list-box">
                        <h2 class="product-list-title">برترین رتبه</h2>
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p7.png')}}"
                                                                alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single.html">عینک پلیسی عالی</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <del>60.00</del>
                                    <span>40.00 ریال</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="right" data-tooltip="tooltip"
                               title="افزودن به سبد خرید"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p8.png')}}"
                                                                alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single.html">عینک پلیسی عالی</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <del>60.00</del>
                                    <span>40.00 ریال</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="right" data-tooltip="tooltip"
                               title="افزودن به سبد خرید"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single.html"><img src="{{asset('site/assets/img/product/p26.png')}}"
                                                                alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single.html">عینک پلیسی عالی</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <del>60.00</del>
                                    <span>40.00 ریال</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="right" data-tooltip="tooltip"
                               title="افزودن به سبد خرید"><i class="far fa-shopping-bag"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="blog-area py-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">وبلاگ ما</span>
                        <h2 class="site-title">آخرین اخبار و <span>وبلاگ</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="blog-item-img">
                            <img src="{{asset('site/assets/img/blog/01.jpg')}}" alt="Thumb">
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <li><a href="#"><i class="far fa-user-circle"></i> توسط آلیشیا دیویس</a></li>
                                    <li><a href="#"><i class="far fa-calendar-alt"></i> 29 بهمن 1402</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title">
                                <a href="#">تغییرهای زیادی از قسمت‌های موجود وجود دارد که اکثر آنها دچار مشکل
                                    شده‌اند.</a>
                            </h4>
                            <p>تغییرهای زیادی وجود دارد که اکثر آنها دچار تغییرات تصادفی شده‌اند
                                کلمات.</p>
                            <a class="theme-btn" href="#">بیشتر بخوانید<i class="fas fa-arrow-left-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="blog-item wow fadeInUp" data-wow-delay=".50s">
                        <div class="blog-item-img">
                            <img src="{{asset('site/assets/img/blog/02.jpg')}}" alt="Thumb">
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <li><a href="#"><i class="far fa-user-circle"></i> توسط آلیشیا دیویس</a></li>
                                    <li><a href="#"><i class="far fa-calendar-alt"></i> 29 بهمن 1402</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title">
                                <a href="#">تغییرهای زیادی از قسمت‌های موجود وجود دارد که اکثر آنها دچار مشکل
                                    شده‌اند.</a>
                            </h4>
                            <p>تغییرهای زیادی وجود دارد که اکثر آنها دچار تغییرات تصادفی شده‌اند
                                کلمات.</p>
                            <a class="theme-btn" href="#">بیشتر بخوانید<i class="fas fa-arrow-left-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="blog-item wow fadeInUp" data-wow-delay=".75s">
                        <div class="blog-item-img">
                            <img src="{{asset('site/assets/img/blog/03.jpg')}}" alt="Thumb">
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <li><a href="#"><i class="far fa-user-circle"></i> توسط آلیشیا دیویس</a></li>
                                    <li><a href="#"><i class="far fa-calendar-alt"></i> 29 بهمن 1402</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title">
                                <a href="#">تغییرهای زیادی از قسمت‌های موجود وجود دارد که اکثر آنها دچار مشکل
                                    شده‌اند.</a>
                            </h4>
                            <p>تغییرهای زیادی وجود دارد که اکثر آنها دچار تغییرات تصادفی شده‌اند
                                کلمات.</p>
                            <a class="theme-btn" href="#">بیشتر بخوانید<i class="fas fa-arrow-left-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
