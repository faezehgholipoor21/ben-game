@extends('layouts.user_layout')

@section('title')
    پنل مشتری سایت بازی | جزئیات سفارش
@endsection

@section('custom-css')
    <style>
        .pro_img{
            width: 150px;
            height: 150px;
        }
        .back_btn {
            font-family: var(--body-font);
            padding: 8px 15px;
            font-size: 10px;
        }
        .account_css{
            border: 1px solid #c5c2c2;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
@endsection

@section('custom-js')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="user-card">
                <div class="user-card-header">
                    <h4 class="user-card-title">
                        جزئیات سفارش {{$order_info['order_code']}} به مبلغ نهایی {{@number_format($total_order_price)  . ' ریال '}}
                    </h4>
                    <div class="user-card-header-right">
                        <a href="{{route('user.orders')}}" class="back_btn alert alert-danger">
                            <i class="fa fa-arrow-right pr-2"></i>
                            بازگشت به سفارشات
                        </a>
                    </div>
                </div>
                <div class="alert alert-info">
                    @foreach($order_detail_infos as $item)
                        <div class="row mb-5">
                            <div class="col-12 col-md-3 mt-1 text-center">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{{asset($item['product_image'])}}" class="pro_img m-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-9 mt-1">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3 text-left">
                                        <label>
                                            عنوان محصول :
                                        </label>
                                        <p class="alert alert-primary p-2">
                                            {{$item['product_name']}}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3 text-left">
                                        <label>
                                            دسته محصول :
                                        </label>
                                        <p class="alert alert-primary p-2">
                                            {{$item['product_cat_title']}}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3 text-left">
                                        <label>
                                            دسته اکانت محصول :
                                        </label>
                                        <p class="alert alert-primary p-2">
                                            {{$item['game_account_title']}}
                                        </p>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3 text-left">
                                        <label>
                                            قیمت :
                                        </label>
                                        <p class="alert alert-primary p-2  text-right">
                                            {{@number_format($item['bought_price']) . ' ریال '}}
                                        </p>
                                    </div>
                                    <div class="col-12 mt-3 text-left account_css">
                                        <label>
                                            جزئیات اکانت محصول :
                                        </label>
                                        <p>
                                            @foreach($item['user_account_detail_info'] as $user_acc)
                                                <span class="text-left mb-3" style="direction: rtl">
                                                    <span class="title_field">
                                                        {{$user_acc['fieldInfo']['label'] . ' ' . ':'}}
                                                    </span>
                                                <span class="value_field">
                                                        {{$user_acc['value']}}
                                                    </span>
                                            </span>
                                                <span class="text-danger">{{' ' . '|' . ' '}}</span>
                                            @endforeach
                                        </p>

                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

