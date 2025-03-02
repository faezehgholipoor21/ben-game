@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | تعیین قیمت دلار
@endsection

@section('custom-css')
    <style>
        .w-100px {
            width: 100px;
        }

        .w-70px {
            width: 70px;
        }
    </style>
@endsection

@section('custom-js')
    <script>


        function formatNumber(input) {
            // حذف همه کاراکترهای غیر از عدد
            let value = input.value.replace(/\D/g, '');

            // جدا کردن اعداد به صورت سه‌رقمی
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // تنظیم مقدار جدید در input
            input.value = value;
        }
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>تعیین قیمت دلار</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تعیین قیمت دلار</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12 col-md-3">
                <form action="{{route('admin.dollar_price_update')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label>قیمت روز دلار به تومان</label>
                                    <input name="price" type="text" class="form-control"
                                           placeholder="لطفا قیمت روز دلار را وارد کنید"
                                           oninput="formatNumber(this)">
                                </div>
                                <div class="col-12 mb-4">
                                    <button class="btn btn-success w-100">
                                        <i class="fa fa-pencil mr-2"></i>
                                        ویرایش قیمت روز دلار
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-md-9">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8 text-left">
                            <tr>
                                <th>#</th>
                                <th>قیمت روز دلار به تومان</th>
                            </tr>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        {{@number_format($dollarPrice['price'])}}
                                    </td>
                                </tr>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@endsection

