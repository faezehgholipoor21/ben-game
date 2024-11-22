@extends('layouts.user_layout')

@section('title')
    پنل مشتری سایت بازی | سفارشات مشتری
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
    <div class="row">
        <div class="col-lg-12">
            <div class="user-card">
                <div class="user-card-header">
                    <h4 class="user-card-title">سفارشات من</h4>
{{--                    <div class="user-card-header-right">--}}
{{--                        <a href="#" class="theme-btn">مشاهده همه سفارش‌ها</a>--}}
{{--                    </div>--}}
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless text-nowrap">
                        <thead>
                        <tr>
                            <th>شماره سفارش</th>
                            <th>تاریخ خرید</th>
                            <th>مجموع</th>
                            <th>وضعیت</th>
                            <th>عمل</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="table-list-code">#35VR5K54</span></td>
                            <td>21 فروردین 1402</td>
                            <td>3650 ریال</td>
                            <td><span class="badge badge-info">عدم پاسخ</span></td>
                            <td>
                                <div class="user-action-dropdown dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="far fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{route('user.order_detail')}}">
                                                <i class="far fa-eye"></i>
                                                جزئیات سفارش
                                            </a>
                                        </li>
                                        {{--                                                            <li>--}}
                                        {{--                                                                <a class="dropdown-item" href="#">--}}
                                        {{--                                                                    <i class="far fa-pen-swirl"></i>--}}
                                        {{--                                                                    عدم پاسخ--}}
                                        {{--                                                                </a>--}}
                                        {{--                                                            </li>--}}
                                        {{--                                                            <li>--}}
                                        {{--                                                                <a class="dropdown-item" href="#">--}}
                                        {{--                                                                    <i class="far fa-circle-dashed"></i>--}}
                                        {{--                                                                    در حال پردازش--}}
                                        {{--                                                                </a>--}}
                                        {{--                                                            </li>--}}
                                        {{--                                                            <li>--}}
                                        {{--                                                                <a class="dropdown-item" href="#">--}}
                                        {{--                                                                    <i class="far fa-check-circle"></i>--}}
                                        {{--                                                                    تکمیل شد--}}
                                        {{--                                                                </a>--}}
                                        {{--                                                            </li>--}}
                                        {{--                                                            <li>--}}
                                        {{--                                                                <a class="dropdown-item" href="#">--}}
                                        {{--                                                                    <i class="far fa-xmark-circle"></i>--}}
                                        {{--                                                                    لغو--}}
                                        {{--                                                                </a>--}}
                                        {{--                                                            </li>--}}
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="table-list-code">#35VR5K54</span></td>
                            <td>21 فروردین 1402</td>
                            <td>3650 ریال</td>
                            <td><span class="badge badge-primary">نیاز به احراز هویت</span></td>
                            <td>
                                <div class="user-action-dropdown dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="far fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item"
                                               href="vendor-order-detail.html"><i
                                                    class="far fa-eye"></i> جزئیات سفارش</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-pen-swirl"></i> عدم پاسخ</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-circle-dashed"></i> در حال پردازش</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-check-circle"></i> تکمیل شد</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-xmark-circle"></i> لغو</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="table-list-code">#35VR5K54</span></td>
                            <td>21 فروردین 1402</td>
                            <td>3650 ریال</td>
                            <td><span class="my_test">موجود نبودن آیتم یا مغایرت محصول</span></td>
                            <td>
                                <div class="user-action-dropdown dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="far fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item"
                                               href="vendor-order-detail.html"><i
                                                    class="far fa-eye"></i> جزئیات سفارش</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-pen-swirl"></i> عدم پاسخ</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-circle-dashed"></i> در حال پردازش</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-check-circle"></i> تکمیل شد</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-xmark-circle"></i> لغو</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="table-list-code">#35VR5K54</span></td>
                            <td>21 فروردین 1402</td>
                            <td>3650 ریال</td>
                            <td><span class="badge badge-danger">اطلاعات اشتباه</span></td>
                            <td>
                                <div class="user-action-dropdown dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="far fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-eye"></i>
                                                جزئیات سفارش
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-pen-swirl"></i>
                                                عدم پاسخ
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-circle-dashed"></i>
                                                در حال پردازش
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-check-circle"></i>
                                                تکمیل شد
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-xmark-circle"></i>
                                                لغو
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="table-list-code">#35VR5K54</span></td>
                            <td>21 فروردین 1402</td>
                            <td>3650 ریال</td>
                            <td><span class="badge badge-success">تکمیل شد</span></td>
                            <td>
                                <div class="user-action-dropdown dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="far fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-eye"></i>
                                                جزئیات سفارش
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-pen-swirl"></i>
                                                عدم پاسخ
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-circle-dashed"></i>
                                                در حال پردازش
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-check-circle"></i>
                                                تکمیل شد
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-xmark-circle"></i>
                                                لغو
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="table-list-code">#35VR5K54</span></td>
                            <td>21 فروردین 1402</td>
                            <td>3650 ریال</td>
                            <td><span class="badge badge-success">تکمیل شد</span></td>
                            <td>
                                <div class="user-action-dropdown dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="far fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item"
                                               href="#">
                                                <i class="far fa-eye"></i>
                                                جزئیات سفارش
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-pen-swirl"></i>
                                                عدم پاسخ
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-circle-dashed"></i>
                                                در حال پردازش
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-check-circle"></i>
                                                تکمیل شد
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="far fa-xmark-circle"></i>
                                                لغو
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="table-list-code">#35VR5K54</span></td>
                            <td>21 فروردین 1402</td>
                            <td>3650 ریال</td>
                            <td><span class="badge badge-success">تکمیل شد</span></td>
                            <td>
                                <div class="user-action-dropdown dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="far fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item"
                                               href="vendor-order-detail.html"><i
                                                    class="far fa-eye"></i> جزئیات سفارش</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-pen-swirl"></i> عدم پاسخ</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-circle-dashed"></i> در حال پردازش</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-check-circle"></i> تکمیل شد</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="far fa-xmark-circle"></i> لغو</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

