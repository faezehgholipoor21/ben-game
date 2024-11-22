@extends('layouts.user_layout')

@section('title')
    پنل مشتری سایت بازی | جزئیات سفارش
@endsection

@section('custom-css')
    <style>
        .pro_img{
            width: 200px;
            height: 200px;
        }
        .back_btn {
            font-family: var(--body-font);
            padding: 8px 15px;
            font-size: 10px;
        }
        .status_css{
            font-family: var(--body-font);
            padding: 8px 15px;
            font-size: 15px;
            border-radius: 10px;
            background-color: #f5f490;
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
                    <h4 class="user-card-title">سفارش محصول فلان</h4>
                    <div class="user-card-header-right">
                        <a href="{{route('user.orders')}}" class="back_btn alert alert-danger">
                            <i class="fa fa-arrow-right pr-2"></i>
                            بازگشت به سفارشات
                        </a>
                    </div>
                </div>
                <div class="alert  alert-info">

                <div class="row">
                        <div class="col-12">
                            <img src="{{asset('site/assets/products/product_1718302676.png')}}" class="pro_img">
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <label>
                                عنوان محصول :
                            </label>
                            <p>
                                بازی فلان
                            </p>
                        </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label>
                            وضعیت سفارش :
                        </label>
                        <p class="status_css">
                            عدم پاسخ
                        </p>
                    </div>
                        <div class="col-12 col-md-6 mt-3">
                            <label>
                                دسته محصول :
                            </label>
                            <p>
                                اکانت قانونی پلی استیشن
                            </p>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <label>
                                دسته اکانت محصول :
                            </label>
                            <p>
                                اکانت قانونی پلی استیشن
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

