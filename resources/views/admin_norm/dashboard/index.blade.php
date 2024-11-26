@extends('layouts.admin_norm_layout')

@section('Title')
    پنل ادمین معمولی
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="user-card">
        <h4 class="user-card-title">خلاصه</h4>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="dashboard-widget color-1">
                    <div class="dashboard-widget-info">
                        <h1>{{$full_order_count}}</h1>
                        <span>سفارشات</span>
                    </div>
                    <div class="dashboard-widget-icon">
                        <i class="fal fa-shopping-bag"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="dashboard-widget color-2">
                    <div class="dashboard-widget-info">
                        <h1>{{number_format('1250000')}} تومان</h1>
                        <span>خرید کل</span>
                    </div>
                    <div class="dashboard-widget-icon">
                        <i class="fal fa-credit-card"></i>
                    </div>
                </div>
            </div>
{{--            <div class="col-12 col-md-6">--}}
{{--                <div class="dashboard-widget color-3">--}}
{{--                    <div class="dashboard-widget-info">--}}
{{--                        <h1>{{number_format('520000')}} تومان</h1>--}}
{{--                        <span>کیف پول شما</span>--}}
{{--                    </div>--}}
{{--                    <div class="dashboard-widget-icon">--}}
{{--                        <i class="fal fa-wallet"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
