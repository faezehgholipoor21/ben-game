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
                    <h4 class="breadcrumb-title">با ما تماس بگیرید</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{route('site.home')}}"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">با ما تماس بگیرید</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="contact-area py-100">
            <div class="container">
                <div class="contact-wrapper">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="contact-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="contact-info">
                                            <div class="contact-info-icon">
                                                <i class="fal fa-map-location-dot"></i>
                                            </div>
                                            <div class="contact-info-content">
                                                <h5>آدرس دفتر</h5>
                                                <p>{{$setting_contact_info['address']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-info">
                                            <div class="contact-info-icon">
                                                <i class="fal fa-headset"></i>
                                            </div>
                                            <div class="contact-info-content">
                                                <h5>با ما تماس بگیرید</h5>
                                                <p>{{$setting_contact_info['mobile']}}</p>
                                                <p>{{$setting_contact_info['phone']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-info">
                                            <div class="contact-info-icon">
                                                <i class="fal fa-envelopes"></i>
                                            </div>
                                            <div class="contact-info-content">
                                                <h5>به ما ایمیل بزنید</h5>
                                                <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                      data-cfemail="3d54535b527d58455c504d5158135e5250">
                                                        {{$setting_contact_info['email_one']}}
                                                    </a>
                                                </p>
                                                <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                      data-cfemail="a2d1d7d2d2cdd0d6e2c7dac3cfd2cec78cc1cdcf">
                                                        {{$setting_contact_info['email_two']}}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-info">
                                            <div class="contact-info-icon">
                                                <i class="fal fa-alarm-clock"></i>
                                            </div>
                                            <div class="contact-info-content">
                                                <h5>زمان باز</h5>
                                                <p>{{$setting_contact_info['open_store']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="contact-form">
                                <div class="contact-form-header">
                                    <h2> تماس بگیرید</h2>
                                    <p>این یک واقعیت ثابت شده است که خواننده از خواندنی ها حواسش پرت می شود
                                        محتوای یک صفحه کلماتی که حتی اندکی هنگام نگاه کردن به طرح آن. </p>
                                </div>
                                <form method="post" action="{{route('site.contact_store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                       name="contact_name" placeholder="نام " required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number"
                                                       class="form-control" name="contact_mobile" placeholder="موبایل" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control" name="contact_subject" placeholder="موضوع تو" required>
                                    </div>
                                    <div class="form-group">
                                    <textarea name="contact_content" cols="30" rows="4" class="form-control"
                                              placeholder="پیام خود را بنویسید"></textarea>
                                    </div>
                                    <button type="submit" class="theme-btn">ارسال
                                        پیام <i class="far fa-paper-plane"></i></button>
                                    <div class="col-md-12 my-3">
                                        <div class="form-messege text-success"></div>
                                    </div>
                                </form>
                            </div>
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
