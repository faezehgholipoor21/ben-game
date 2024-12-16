@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | سفارشات
@endsection

@section('custom-css')
    <style>
        tr.is_force_tr, tr.is_force_tr td {
            background: #ffdfdf !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>سفارشات</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">
                                    پنل مدیریت
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">سفارشات</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <form method="post" action="{{route('admin.users.search')}}" class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 mb-4">
                                <label>نام</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="col-12 col-sm-6 col-md-3 mb-4">
                                <label>نام خانوادگی</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>

                            <div class="col-12 col-sm-6  @if(!$searched) col-md-3 @else col-md-2 @endif mb-4">
                                <label>جنسیت</label>
                                <select name="gender" class="form-control">
                                    <option value="">همه</option>
                                    <option value="1">مرد</option>
                                    <option value="2">زن</option>
                                </select>
                            </div>

                            @if(!$searched)
                                <div class="col-12 col-sm-6 col-md-3 mb-4">
                                    <button type="submit" class="btn btn-success w-100 mt-29">
                                        <i class="fa fa-search mr-2"></i>
                                        فیلتر کنید
                                    </button>
                                </div>
                            @else
                                <div class="col-12 col-md-2 mb-4">
                                    <a href="{{route('admin.users')}}" class="btn btn-danger w-100 mt-29">
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

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>خرید فوری</th>
                                <th>شماره سفارش</th>
                                <th>تعداد محصول</th>
                                <th>نام و نام خانوادگی</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                                <th>کارشناس سفارش</th>
                                <th>مجموع (ریال)</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($orders->all()))
                                @php
                                    $row = (($orders->currentPage() - 1) * $orders->perPage() ) + 1;
                                @endphp
                            @else
                                @php
                                    $row = 1;
                                @endphp
                            @endif
                            @foreach($orders as $order)
                                <tr @if($order['is_force'] == 1) class="is_force_tr" @endif>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>

                                    <td class="w60">
                                        @if($order['is_force'] == 1)
                                            <i class="fa fa-check text-success"></i>
                                        @else
                                            <i class="fa fa-times text-danger"></i>
                                        @endif
                                    </td>

                                    <td class="w60">
                                        <span>{{$order['order_code']}}</span>
                                    </td>
                                    <td>
                                        {{\App\Helper\GetOrderDetailCount::get_order_detail_count($order['id']). ' ' . 'محصول'}}
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$order['userInfo']['first_name'] . ' ' . $order['userInfo']['last_name']}}
                                        </p>
                                    </td>

                                    <td>
                                        <span class="mb-0">
                                            {{$order['jalali_date']}}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge badge-info">
                                            {{$order['statusInfo']['title']}}
                                        </span>
                                    </td>

                                    <td>
                                        @if($order['expertInfo'] !== null)
                                            <span class="badge badge-success">
                                                {{$order['expertInfo']['first_name'] . ' ' . $order['expertInfo']['last_name']}}
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                               تعیین نشده
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <span>
                                            {{@number_format($order['total_price'])}}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.order_detail',['order_id' => $order['id']])}}">
                                            <button class="btn btn-primary">
                                                <i class="icon-eye"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $row++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection


