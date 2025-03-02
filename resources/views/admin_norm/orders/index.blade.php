@extends('layouts.admin_norm_layout')

@section('title')
    سایت بازی | همه سفارش ها
@endsection

@section('custom-css')
    <style>
        tr.is_force_tr, tr.is_force_tr td {
            background: #ffdfdf !important;
        }
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
                <div class="card">
                    <form method="post" action="{{route('admin_norm.order_search')}}">
                        @csrf
                        <div class="row p-4">
                            <div class="col-12 col-sm-6 col-md-3 mb-4">
                                <label>شماره سفارش</label>
                                <input type="text" name="order_number" class="form-control">
                            </div>

                            <div class="col-12 col-sm-6 col-md-3 mb-4">
                                <label>موبایل خریدار</label>
                                <input type="text" name="mobile" class="form-control">
                            </div>

                            <div class="col-12 col-sm-6  @if(!$searched) col-md-3 @else col-md-2 @endif mb-4">
                                <label>وضعیت سفارش</label>
                                <select name="status" class="form-control">
                                    @foreach($order_status as $order)
                                        <option value="{{$order['id']}}">{{$order['title']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if(!$searched)
                                <div class="col-12 col-sm-6 col-md-3 mb-4 mt-4">
                                    <button type="submit" class="btn btn-success w-100 mt-29">
                                        <i class="fa fa-search mr-2"></i>
                                        فیلتر کنید
                                    </button>
                                </div>
                            @else
                                <div class="col-12 col-md-2 mb-4">
                                    <a href="{{route('admin_norm.orders')}}"
                                       class="btn btn-danger w-100 mt-29">
                                        <i class="fa fa-times-circle mr-2"></i>
                                        حذف فیلتر
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-md-2 mb-4">
                                    <button type="submit" class="btn btn-success w-100 mt-29">
                                        <i class="fa fa-search mr-2"></i>
                                        فیلتر کنید
                                    </button>
                                </div>
                            @endif

                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless text-nowrap">
                        <thead>
                        <tr>
                            <th>خرید فوری</th>
                            <th>شماره سفارش</th>
                            <th>تعداد محصول</th>
                            <th>نام مشتری</th>
                            <th>تاریخ خرید</th>
                            <th>مجموع</th>
                            <th>وضعیت</th>
                            <th>اختصاص سفارش</th>
                            <th>عمل</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order_list as $order)
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
                                    {{\App\Helper\GetOrderDetailCount::get_order_detail_count($order['id']). ' ' . 'محصول'}}
                                </td>
                                <td>
                                    {{$order['userInfo']['first_name'].' '.$order['userInfo']['last_name']}}
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
                                            اختصاص داده شد به
                                            <br>
                                            {{$order['expertInfo']['first_name'].' '.$order['expertInfo']['last_name']}}
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
                                                   href="#">
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
