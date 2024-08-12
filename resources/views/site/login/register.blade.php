@extends('layouts.site_layout')
@section('title')
    سایت بازی
@endsection

@section('css')

@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const termsCheckbox = document.getElementById('agree');
            const registerButton = document.getElementById('registerBtn');

            termsCheckbox.addEventListener('change', function () {
                registerButton.disabled = !termsCheckbox.checked;
            });
        });
    </script>
@endsection

@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            <div class="site-breadcrumb-bg"
                 style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">
                        ثبت نام
                    </h4>
                    <ul class="breadcrumb-menu">
                        <li>
                            <a href="{{route('site.home')}}">
                                <i class="far fa-home"></i>
                                صفحه اصلی
                            </a>
                        </li>
                        <li class="active">ثبت نام</li>
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
                            <p>حساب گومارت رایگان خود را ایجاد کنید</p>
                        </div>
                        <form action="{{route('site.user_store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6 mt-3">
                                    <label>نام کامل</label>
                                    <input type="text" class="form-control" name="name" placeholder="نام شما">
                                </div>
                                <div class="col-12 col-md-6 mt-3">
                                    <label>نام خانوادگی کامل</label>
                                    <input type="text" class="form-control" name="family"
                                           placeholder="نام خانوادگی شما">
                                </div>
                                <div class="col-12 col-md-6 mt-3">
                                    <label>تلفن همراه</label>
                                    <input type="text" class="form-control" name="mobile" placeholder="تلفن همراه">
                                </div>
                                <div class="col-12 col-md-6 mt-3">
                                    <label>کد ملی</label>
                                    <input type="text" class="form-control" name="national_code" placeholder="کد ملی">
                                </div>
                                <div class="col-12 mt-3">
                                    <label>آدرس ایمیل</label>
                                    <input type="text" class="form-control" name="email" placeholder="ایمیل شما">
                                </div>
                                <div class="col-12 mt-3">
                                    <input class="form-check-input" type="checkbox" value id="agree">
                                    <label class="form-check-label" for="agree">
                                        من با
                                        <a href="#">
                                            شرایط خدمات
                                        </a>
                                        موافقم
                                    </label>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="theme-btn my_btn" disabled id="registerBtn">
                                        <i class="far fa-paper-plane"></i>
                                        ثبت نام
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="login-footer">
                            <p>
                                از قبل حساب کاربری دارید؟
                                <a href="{{route('site.login')}}">
                                    وارد شوید.
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
