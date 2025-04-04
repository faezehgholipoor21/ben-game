@extends('layouts.site_layout')

@section('title')
@endsection

@section('custom-css')
    <style>
        #my_full_screen_loader {
            width: 100%;
            height: 100%;
            position: fixed;
            right: 0;
            top: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
            display: none;
        }

        #my_full_screen_loader img {
            width: 200px;
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            left: 0;
            margin: auto;
        }
        .help_text{
            font-size: 13px;
            color: red;
        }
    </style>
@endsection

@section('custom-js')
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    <script>
        let my_fullscreen_loader = $("#my_full_screen_loader");

    </script>
@endsection

@section('content')
    <div id="my_full_screen_loader">
        <img src="{{asset('site/assets/img/my_circlur_loader.svg')}}">
    </div>
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">تسویه حساب</h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{route('site.home')}}" target="_blank">
                            <i class="far fa-home"></i>
                            صفحه اصلی
                        </a>
                    </li>
                    <li class="active">تسویه حساب</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop-checkout py-100">
        <div class="container">
            <div class="shop-checkout-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shop-checkout-step">
                            <div class="accordion" id="shopCheckout">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#checkoutStep1" aria-expanded="true"
                                                aria-controls="checkoutStep1">
                                            اطلاعات کاربری
                                        </button>
                                    </h2>
                                    <div id="checkoutStep1" class="accordion-collapse collapse show"
                                         data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="shop-checkout-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>نام</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$user_info['first_name']}}"
                                                                   placeholder="نام" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>نام خانوادگی</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$user_info['lastname']}}"
                                                                   placeholder="نام خانوادگی" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>ایمیل</label>
                                                            <input type="email" class="form-control"
                                                                   value="{{$user_info['email']}}"
                                                                   placeholder="آدرس ایمیل" dir="ltr" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>تلفن</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$user_info['mobile']}}"
                                                                   placeholder="شماره تلفن" dir="ltr" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div id="checkoutStep2" class="accordion-collapse collapse"
                                         data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="shop-checkout-form">
                                                <form action="#">
                                                    <div class="row">

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>نام</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="نام">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>نام خانوادگی</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="نام خانوادگی">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>ایمیل</label>
                                                                <input type="email" class="form-control"
                                                                       placeholder="آدرس ایمیل">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>تلفن</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="شماره تلفن">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#checkoutStep3"
                                                aria-expanded="false" aria-controls="checkoutStep3">
                                            اطلاعات پرداخت شما
                                        </button>
                                    </h2>
                                    <div id="checkoutStep3" class="accordion-collapse collapse show"
                                         data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="shop-checkout-payment">
                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="pills-tab-4" data-bs-toggle="pill"
                                                           data-bs-target="#pills-4" type="button" role="tab"
                                                           aria-controls="pills-4" aria-selected="false">
                                                            <div class="checkout-payment-img cod">
                                                                <img
                                                                        src="{{asset('site/assets/img/payment/zarinpal-logo-min.png')}}"
                                                                        alt>
                                                            </div>
                                                            <span>پرداخت زرین پال</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="shop-cart-summary">
                            <h5>خلاصه سبد خرید</h5>
                            <ul>
                                <li>
                                    <strong>قیمت کل :</strong>
                                    <span class="show_total_price_without_tax">
                                            {{number_format($main_total_price)}} تومان
                                    </span>
                                </li>
                                <li class="help_text">
                                    قیمت کل با احتساب تخفیف و بدون احتساب مالیات است
                                </li>
                                <li>
                                    <strong>مالیات:</strong>
                                    <span class="show_tax_price">
                                            {{@number_format($tax_price)}} تومان
                                        </span>
                                </li>
                                <li>
                                    <strong>تخفیف باشگاه:</strong>
                                    <span>
                                            {{$club_percentage}} درصد
                                        </span>
                                </li>
                                @if($main_discount)
                                    <li>
                                        <strong>تخفیف :</strong>
                                        <span>
                                                {{$main_discount}} تومان
                                            </span>
                                    </li>
                                @endif

                                <li class="shop-cart-total">
                                    <strong>مجموع:</strong>
                                    <span class="show_total_price_with_tax">
                                            {{@number_format($final_price_after_club)}} تومان
                                        </span>
                                </li>
                            </ul>
                            <form class="text-end mt-40" action="{{route('site.submitOrder')}}" method="post">
                                @csrf
                                <input type="hidden" value="1" name="gateway">
                                <button type="submit" class="theme-btn w-100 d-block">
                                    پرداخت
                                    <i class="fas fa-arrow-left-long"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
