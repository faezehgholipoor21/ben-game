@extends('layouts.user_layout')

@section('title')
    پنل مشتری سایت بازی | سفارشات مشتری
@endsection

@section('custom-css')
    <style>
        .my_test {
            color: orangered !important;
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
                    <h4 class="user-card-title">سفارشات</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless text-nowrap">
                        <thead>
                        <tr>
                            <th>خرید فوری</th>
                            <th>شماره سفارش</th>
                            <th>تاریخ خرید</th>
                            <th>مجموع</th>
                            <th>وضعیت</th>
                            <th>عمل</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($my_order_list as $order)
                            <tr @if($order['is_force'] == 1) class="is_force_tr" @endif>
                                <td class="w60">
                                    @if($order['is_force'] == 1)
                                        <i class="fa fa-check text-success"></i>
                                    @else
                                        <i class="fa fa-times text-danger"></i>
                                    @endif
                                </td>
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
                                    <div class="user-action-dropdown dropdown">
                                        <button class="btn btn-sm btn-outline-secondary" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="far fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{route('user.order_detail' , ['order_id' => $order['id']])}}">
                                                    <i class="far fa-eye"></i>
                                                    جزئیات سفارش
                                                </a>
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

