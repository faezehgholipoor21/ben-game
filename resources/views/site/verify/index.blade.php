@extends('layouts.site_layout')

@section('title')
    سایت بازی | انجام تراکنش
@endsection

@section('custom-css')
@endsection

@section('custom-js')
@endsection

@section('content')
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">انجام تراکنش</h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{route('site.home')}}" target="_blank">
                            <i class="far fa-home"></i>
                            صفحه اصلی
                        </a>
                    </li>
                    <li class="active">انجام تراکنش</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="shop-cart py-100">
        <div class="container">
            <div class="shop-cart-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12">
                                @if(intval($order['payment_status_id']) === 2)
                                    <p class="alert alert-success">
                                        خرید شما با موفقیت انجام شد. شماره تراکنش : {{$order['transaction_number']}}
                                    </p>
                                @else
                                    <p class="alert alert-danger">
                                        خرید شما ناموفق بود. شماره تراکنش : {{$order['transaction_number']}}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="cart-table">
                            <div class="table-responsive">
                                <table class="table cart_table">
                                    <thead>
                                    <tr>
                                        <th>تصویر</th>
                                        <th>نام محصول</th>
                                        <th>تعداد</th>
                                        <th>قیمت کل (تومان)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_price = 0 ;
                                    @endphp
                                    @foreach($products as $item)
                                        @php
                                            $price = $item['bought_price'] ;
                                            $total_price += $price * $item['count'] ;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="shop-cart-img">
                                                    <a href="#">
                                                        <img
                                                            src="{{\App\Helper\GetProductMainImage::get_product_main_image($item['product_id'], true)}}"
                                                            alt>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="shop-cart-content">
                                                    <h5 class="shop-cart-name">
                                                        <a href="#">
                                                            {{$item['product']['product_name']}}
                                                        </a>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                {{$item['count']}}
                                            </td>
                                            <td>
                                                <div class="shop-cart-price">
                                                    <span class="tr_price">{{number_format($price * $item['count'])}}</span>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="shop-cart-summary">
                            <h5>فاکتور</h5>
                            <ul>
                                <li>
                                    <strong>تخفیف محاسبه شده:</strong>
                                    <span> {{@number_format($order['discount_price'])}} تومان</span>
                                </li>
                                {{--                                <li><strong>ارسال:</strong> <span>رایگان</span></li>--}}
                                <li class="shop-cart-total">
                                    <strong>پرداخت شده:</strong>
                                    <span class="show_total_price_with_tax">
                                            {{@number_format($order['total_price'])}} تومان
                                        </span>
                                </li>
                            </ul>
                            <div class="text-end mt-40">
                                <a href="{{route('user.dashboard')}}" class="theme-btn w-100 d-block">
                                    پنل کاربری
                                    <i class="fas fa-arrow-left-long"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
