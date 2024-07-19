@extends('layouts.site_layout')
@section('title')
    سایت بازی
@endsection

@section('css')
    <style>
        .my_img {
            width: 100px;
        }
    </style>
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
                    <h4 class="breadcrumb-title">راهنما</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{asset('site.home')}}"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">راهنما</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="help-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="help-search">
                            <h3>چگونه می توانیم کمک کنیم؟</h3>
                            <p>سوال بپرسید. موضوعات را مرور کنید. پاسخ ها را پیدا کنید.</p>
                            <div class="help-search-form">
                                <form action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="جستوجو کنید...">
                                        <button type="submit"><i class="fal fa-search"></i></button>
                                        <div class="help-search-keyword">
                                            <span>پیشنهادات:</span>
                                            <a href="#">پرداخت</a>،
                                            <a href="#">بازپرداخت</a>،
                                            <a href="#">ارسال</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($rule_info as $item)
                        <div class="col-lg-4">
                            <div class="help-item">
                                <div class="help-icon">
                                    <i class="fal">
                                        <img src="{{asset($item['image_src'])}}" alt="" class="my_img">
                                    </i>
                                </div>
                                <div class="help-content">
                                    <h4>{{$item['title']}}</h4>
                                    <p>{!! $item['topic'] !!}</p>
                                    <a href="{{route('site.rule_detail',['id' => $item['id']])}}" class="theme-btn">
                                        بیشتر بخوانید
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="help-bottom">
                    <h4> پاسخ را پیدا نکردید؟ ما می توانیم کمک کنیم.</h4>
                    <p>با ما تماس بگیرید و در اسرع وقت با شما تماس خواهیم گرفت.</p>
                    <a href="#" class="theme-btn">یک بلیت ارسال کنید</a>
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
