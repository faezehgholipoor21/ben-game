@extends('layouts.user_layout')

@section('title')
    سایت بازی | پنل مشتری
@endsection

@section('custom-css')
    <style>
        .my_test{
            color:orangered !important;
            background-color: #f3cebe;
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 11px;
        }
    </style>
@endsection

@section('custom-js')
@endsection

@section('content')
    <div class="user-card">
        <h4 class="user-card-title">خلاصه</h4>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="dashboard-widget color-1">
                    <div class="dashboard-widget-info">
                        <h1>15</h1>
                        <span>سفارشات</span>
                    </div>
                    <div class="dashboard-widget-icon">
                        <i class="fal fa-shopping-bag"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
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
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="dashboard-widget color-3">
                    <div class="dashboard-widget-info">
                        <h1>{{number_format('520000')}} تومان</h1>
                        <span>کیف پول شما</span>
                    </div>
                    <div class="dashboard-widget-icon">
                        <i class="fal fa-wallet"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
