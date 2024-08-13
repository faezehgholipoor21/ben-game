@extends('layouts.site_layout')
@section('title')
    سایت بازی | ورود
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            <div class="site-breadcrumb-bg"
                 style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">ورود به سیستم</h4>
                    <ul class="breadcrumb-menu">
                        <li>
                            <a href="{{route('site.home')}}">
                                <i class="far fa-home"></i>
                                صفحه اصلی
                            </a>
                        </li>
                        <li class="active">ورود به سیستم</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="login-area py-100">
            <div class="container">
                <div class="col-md-7 col-lg-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <img src="{{asset('site/assets/img/logo/logo.png')}}" alt>
                            <p>با حساب گومارت خود وارد شوید</p>
                        </div>
                        <form action="{{route('site_login_do')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>شناسه کاربری</label>
                                <input type="text" class="form-control" name="national_code" placeholder="شناسه کاربری">
                            </div>
                            <div class="form-group">
                                <label>رمز عبور</label>
                                <input type="password" class="form-control" name="password" placeholder="رمز عبور">
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn">
                                    <i class="far fa-sign-in"></i>
                                    ورود
                                </button>
                            </div>
                        </form>
                        <div class="login-footer">
                            <p>
                                حساب ندارید؟
                                <a href="{{route('site.register')}}">
                                    ثبت نام کنید.
                                </a>
                            </p>
                        </div>
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
