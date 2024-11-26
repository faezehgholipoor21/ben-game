@extends('layouts.user_layout')

@section('title')
    پنل مشتری سایت بازی | جزئیات سفارش
@endsection

@section('custom-css')
    <style>
        .pro_img {
            width: 200px;
            height: 200px;
        }

        .back_btn {
            font-family: var(--body-font);
            padding: 8px 15px;
            font-size: 10px;
        }

    </style>
@endsection

@section('custom-js')
    <script>
        const question_modal = $("#QuestionModal");

        function showModal(select_element, order_id) {

            const selectedValue = select_element.value; // مقدار گزینه انتخاب‌شده

            let order_status = $('#order_status');
            let order_id_inp = $('#order_id');

            var action = "/admin-norm-panel/change_order_status/";
            question_modal.find('form').attr('action', action);

            order_status.val(selectedValue);
            order_id_inp.val(order_id);
            // نمایش مودال
            question_modal.modal('show');
        }

        function close_model() {
            question_modal.modal('hide');
        }

    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="user-card">
                <div class="user-card-header">
                    <h4 class="user-card-title">
                        جزئیات سفارش {{$order_info['order_code']}}
                    </h4>
                    <div class="user-card-header-right">
                        <a href="{{route('admin_norm.orders')}}" class="back_btn alert alert-danger">
                            <i class="fa fa-arrow-right pr-2"></i>
                            بازگشت به سفارشات
                        </a>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 mt-1">
                        <label>
                            وضعیت سفارش :
                        </label>
                        <div class="row alert alert-warning">
                            <div class="col-12 col-md-6 mb-3">
                                <p>
                                    {{$order_status_title}}
                                </p>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <p>
                                    <select class="form-control" id="options"
                                            onchange="showModal(this , '{{$order_info['id']}}')">
                                        <option value="" disabled selected>
                                            وضعیت سفارش را از اینجا تغیر دهید
                                        </option>
                                        @foreach($order_status_list as $status)
                                            <option value="{{$status['id']}}">
                                                {{$status['title']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </p>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="alert alert-info">

                    @foreach($order_detail_infos as $item)
                        <div class="row mb-5">
                            <div class="col-12 col-md-3 mt-1 text-center">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{{asset($item['product_image'])}}" class="pro_img m-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-9 mt-1">
                                <div class="row">
                                    <div class="col-12 mb-3 text-left">
                                        <label>
                                            عنوان محصول :
                                        </label>
                                        <p class="alert alert-primary p-2">
                                            {{$item['product_name']}}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3 text-left">
                                        <label>
                                            دسته محصول :
                                        </label>
                                        <p class="alert alert-primary p-2">
                                            {{$item['product_cat_title']}}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3 text-left">
                                        <label>
                                            دسته اکانت محصول :
                                        </label>
                                        <p class="alert alert-primary p-2">
                                            {{$item['game_account_title']}}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3 text-left">
                                        <label>
                                            قیمت :
                                        </label>
                                        <p class="alert alert-primary p-2  text-right">
                                            {{@number_format($item['bought_price']) . ' ریال '}}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3 text-left">
                                        <label>
                                            تعداد :
                                        </label>
                                        <p class="alert alert-primary p-2 text-right">
                                            {{$item['count']}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-12">
                            <label>
                                مبلغ نهایی سفارش
                            </label>
                            <p class="alert alert-success text-right">
                                {{@number_format($total_order_price)  . ' ریال '}}
                            </p>
                        </div>
                    </div>
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

