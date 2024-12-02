@extends('layouts.admin_layout')

@section('title')
    پنل مشتری سایت بازی | جزئیات سفارش
@endsection

@section('custom-css')
    <style>
        .product_img {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        }
    </style>
@endsection

@section('custom-js')
    <script>
        const question_modal = $("#QuestionModal");

        function showModal(select_element, order_id) {

            const selectedValue = select_element.value;

            let order_status = $('#order_status');
            let order_id_inp = $('#order_id');

            let action = "/panel/change_order_status";
            question_modal.find('form').attr('action', action);

            order_status.val(selectedValue);
            order_id_inp.val(order_id);
            question_modal.modal('show');
        }

        function close_model() {
            question_modal.modal('hide');
        }
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>جزئیات سفارش {{$order_info['order_code']}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">جزئیات
                                سفارش {{$order_info['order_code']}}</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.orders')}}" class="btn btn-sm btn-danger">
                        <i class="fa fa-arrow-right mr-2"></i>
                        بازگشت به مدیریت سفارشات
                    </a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover table-custom spacing8">
                        <tr>
                            <td>شماره سفارش</td>
                            <td>تاریخ ثبت</td>
                            <td>مبلغ کل</td>
                            <td>کارشناس</td>
                            <td>کاربر</td>
                            <td>وضعیت</td>
                        </tr>
                        <tr>
                            <td>
                                {{$order_info['order_code']}}
                            </td>

                            <td>
                                {{$order_info['jalali_date']}}
                            </td>

                            <td>
                                {{@number_format($order_info['total_price'])}}
                            </td>

                            <td>
                                @if($order_info['expertInfo'] !== null)
                                    <span class="badge badge-success">
                                                {{$order_info['expertInfo']['first_name'] . ' ' . $order_info['expertInfo']['last_name']}}
                                            </span>
                                @else
                                    <span class="badge badge-danger">
                                               تعیین نشده
                                            </span>
                                @endif
                            </td>

                            <td>
                                {{$order_info['userInfo']['first_name'] . ' ' . $order_info['userInfo']['last_name']}}
                            </td>

                            <td>
                                <select class="form-control form-control-sm" id="options"
                                        onchange="showModal(this , '{{$order_info['id']}}')">
                                    <option value="" disabled selected>
                                        وضعیت سفارش را از اینجا تغیر دهید
                                    </option>
                                    @foreach($order_status_list as $status)
                                        <option
                                            @if($status['id'] == $order_info['order_status']) selected="selected" @endif
                                        value="{{$status['id']}}">
                                            {{$status['title']}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>


            </div>
        </div>

        <div class="row clearfix mt-4">
            <div class="col-12">
                <p class="fw-bold">فاکتور</p>
                <div class="table-responsive">
                    <table class="table table-hover table-custom spacing8">
                        <tr>
                            <td>تصویر</td>
                            <td>اطلاعات</td>
                            <td>قیمت واحد</td>
                            <td>تعداد</td>
                            <td>جمع</td>
                        </tr>
                        @foreach($order_info['orderDetail'] as $detail)
                            <tr>
                                <td>
                                    <img class="w-125px product_img"
                                         src="{{asset(\App\Helper\GetProductMainImage::get_product_main_image($detail['product_id']))}}">
                                </td>

                                <td>
                                    <p>
                                        {{$detail['product']['product_name']}}
                                    </p>

                                    <p>
                                        <b> دسته:</b>
                                        <span class="badge badge-info">
                                        {{$detail['product']['categoryInfo']['cat_title']}}
                                        </span>
                                    </p>

                                    <p>
                                        <b>اکانت:</b>
                                        <span class="badge badge-success">
                                        {{$detail['product']['accountInfo']['account_name']}}
                                        </span>
                                    </p>

                                    <p>
                                        <b>فیلد ها:</b>
                                        @if(count($detail['product']['accountInfo']['fieldInfo']) > 0)
                                            @foreach($detail['product']['accountInfo']['fieldInfo'] as $field)
                                                <span class="badge badge-success">
                                                 {{$field['field_title']}}
                                             </span>
                                            @endforeach
                                        @else
                                            <span class="badge badge-danger">
                                                 تعریف نشده
                                             </span>
                                        @endif
                                    </p>
                                </td>

                                <td>
                                    {{@number_format($detail['bought_price'])}}
                                </td>

                                <td>
                                    {{$detail['count']}}
                                </td>

                                <td>
                                    {{@number_format($detail['bought_price'] * $detail['count'])}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- The Modal -->
    <div class="modal" id="QuestionModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">تایید تغییر وضعیت</h4>
                    {{--                    <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p id="modal-text" class="alert alert-danger">
                        آیا از تغییر وضعیت اطمینان دارید؟
                    </p>
                </div>

                <!-- Modal footer -->
                <form action="" method="post" class="modal-footer">
                    @csrf
                    <input type="hidden" id="order_status" name="order_status" value="">
                    <input type="hidden" id="order_id" name="order_id" value="">
                    <button type="submit" class="btn btn-success">بله مطمئنم</button>
                    <button onclick="close_model()" type="button" class="btn btn-danger" data-dismiss="modal">خیر
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

