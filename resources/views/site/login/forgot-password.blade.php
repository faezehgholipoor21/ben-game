@extends('layouts.site_layout')
@section('title')
    سایت بازی
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            <div class="site-breadcrumb-bg" style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">گذرواژه را فراموش کرده اید</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{route('site.home')}}"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">گذرواژه را فراموش کرده اید</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="login-area py-100">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <img src="{{asset('site/assets/img/logo/logo.png')}}" alt>
                            <p>گذرواژه حساب گومارت خود را بازنشانی کنید</p>
                        </div>
                        <form action="#">
                            <div class="form-group">
                                <label>آدرس ایمیل</label>
                                <input type="email" class="form-control" placeholder="ایمیل شما">
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn"><i class="far fa-key"></i> ارسال بازنشانی
                                    ارتباط دادن
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="newsletter-area pt-60 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="newsletter-content">
                            <h3>دریافت کوپن تخفیف <span>20%</span></h3>
                            <p>با مشترک شدن در خبرنامه ما</p>
                            <div class="subscribe-form">
                                <form action="#">
                                    <input type="email" class="form-control" placeholder="آدرس ایمیل معتبر شما">
                                    <button class="theme-btn" type="submit">
                                        اشتراک <i class="far fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="newsletter-img-1">
                <img src="{{asset('site/assets/img/newsletter/01.png')}}" alt>
            </div>
            <div class="newsletter-img-2">
                <img src="{{asset('site/assets/img/newsletter/02.png')}}" alt>
            </div>
        </div>

    </main>
@endsection
