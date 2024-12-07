@extends('layouts.admin_norm_layout')

@section('title')
    سایت بازی | همه سفارش ها
@endsection

@section('custom-css')
    <style>
        .not_available {
            color: orangered !important;
            background-color: #f3cebe;
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 11px;
        }

        .new_under_review {
            color: #0e5703 !important;
            background-color: #bef3df;
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 11px;
        }

        .refunding_the_amount {
            color: #030757 !important;
            background-color: #f69469;
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 11px;
        }

        .refunded {
            color: #022d3a !important;
            background-color: #eae710;
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 11px;
        }

        .no_response {
            color: #ffffff !important;
            background-color: #fd061a;
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 11px;
        }
        .completed {
            color: #ffffff !important;
            background-color: #03570e;
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
                    <h4 class="user-card-title">همه سفارش ها</h4>
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
                            <th>اختصاص سفارش</th>
                            <th>عمل</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order_list as $order)
                            <tr>
                                <td>
                                <span class="table-list-code">
                                    #{{$order['order_code']}}
                                </span>
                                </td>
                                <td>
                                    {{$order['jalali_date']}}
                                </td>
                                <td>
                                    {{@number_format($order['total_price'])}} ریال
                                </td>
                                <td>
                                <span class="{{$order['statusInfo']['order_class']}}">
                                     {{$order['statusInfo']['title']}}
                                </span>
                                </td>
                                <td>
                                    @if($order['review_expert_id'] != 0)
                                        <a href="#" disabled="disabled"
                                           class="btn btn-dark">
                                            <i class="fa fa-check"></i>
                                            اختصاص داده شد
                                        </a>
                                    @else
                                        <a href="{{route('admin_norm.order_allocation' , ['order_id' => $order['id']])}}"
                                           class="btn btn-primary">
                                            <i class="fa fa-check"></i>
                                            اختصاص سفارش
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="user-action-dropdown dropdown">
                                        <button class="btn btn-sm btn-outline-secondary" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="far fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                @if($order['review_expert_id'] == 0)
                                                <a class="dropdown-item"
                                                   href="{{route('admin_norm.order_detail' , ['order_id' => $order['id']])}}">
                                                    <i class="far fa-eye"></i>
                                                    جزئیات سفارش
                                                </a>
                                                @elseif($order['review_expert_id'] == auth()->user()->id)
                                                    <a class="dropdown-item"
                                                       href="{{route('admin_norm.order_detail' , ['order_id' => $order['id']])}}">
                                                        <i class="far fa-eye"></i>
                                                        جزئیات سفارش
                                                    </a>
                                                @else
                                                    <a class="dropdown-item" disabled="disabled" href="#" style="color: red">
                                                        <i class="far fa-do-not-enter" style="color: red"></i>
                                                        جزئیات سفارش
                                                    </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
