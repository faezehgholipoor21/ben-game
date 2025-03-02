@extends('layouts.admin_norm_layout')

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

        .title_field {
            background-color: #cfe2ff;
            border: 1px solid #9ec5fe;
            padding: 4px;
            margin: 3px 3px;
            border-radius: 5px;
        }

        .value_field {
            background-color: #bac3d1;
            border: 1px solid #9ec5fe;
            padding: 4px;
            margin: 3px 3px;
            border-radius: 5px;
        }

        .copy-btn {
            cursor: pointer;
            background-color: #939393;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .p_modal_css {
            width: 100%;
            text-align: right !important;
        }
        .table_danger {
            background-color: #f8b2b2 !important;
        }

        .table_success {
            background-color: #b0f3b0 !important;
        }
        .user-area .table td:first-child{
            border-top-left-radius :0 !important;
            border-bottom-left-radius:0 !important;
        }
        .user-area .table td:last-child{
            border-radius: 0;
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

        function show_sweetalert_success(msg) {
            new swal({
                html: "<p class='my_toast_txt'>" + msg + "</p>",
                toast: true,
                icon: "success",
                showConfirmButton: false,
                position: 'top',
                timerProgressBar: true,
                timer: 3500
            });
        }

        function copyToClipboard(button) {
            let text = button.previousElementSibling.innerText.trim();

            navigator.clipboard.writeText(text).then(() => {
                show_sweetalert_success("متن کپی شد!");
            }).catch(err => {
                console.error("خطا در کپی کردن متن: ", err);
            });
        }

        function show_sweetalert_msg(msg, icon) {
            new swal({
                html: "<p class='my_toast_txt'>" + msg + "</p>",
                toast: true,
                icon: icon,
                showConfirmButton: false,
                position: 'top',
                timerProgressBar: true,
                timer: 3500
            });
        }
        function change_order_status_report(order_status_report_id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route("admin_norm.change_order_status_report")}}',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    order_status_report_id: order_status_report_id,
                }),
                success: function (response) {
                    if (response.error) {
                        show_sweetalert_msg(response.message, 'error');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        show_sweetalert_msg(response.message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function (xhr, status, error) {
                    show_sweetalert_msg('خطای سمت سرور رخ داده است، لطفا دوباره تلاش کنید', 'error');
                }
            });
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
                                    {{$order_info['statusInfo']['title']}}
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
                                    <div class="col-12 col-md-6 mb-3 text-left">
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
                                        <label class="alert">
                                            جزئیات اکانت محصول :
                                        </label>
                                        @foreach($item['user_account_detail_info'] as $index => $user_acc)
                                            <p class="text-left mb-3" style="direction: rtl">
                                                    <span class="title_field">
                                                        {{$user_acc['fieldInfo']['label'] . ' ' . ':'}}
                                                    </span>
                                                <span class="value_field">
                                                        {{$user_acc['value']}}
                                                    </span>
                                                <button class="copy-btn" onclick="copyToClipboard(this)">📋</button>
                                            </p>
                                        @endforeach
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
                <div class="alert alert-warning">
                    <div class="row clearfix mt-4">
                        <div class="col-12">
                            <label>گزارش</label>
                            <div class="table-responsive">
                                <table class="table table-hover table-custom spacing8">
                                    <tr>
                                        <td>نویسنده گزارش</td>
                                        <td>متن</td>
                                        <td>تاریخ</td>
                                        <td>وضعیت</td>
                                    </tr>
                                    @foreach($order_status_report as $report)
                                        <tr>
                                            <td class="{{$report['read'] == 0 ? 'table_danger' : ($report['read'] == 1 ? 'table_success' : '')}}">
                                                {{\App\Helper\GetUsernameWithUserId::get_username_with_user_id($report['author'])}}
                                            </td>
                                            <td style="word-wrap: break-word; white-space: normal;"
                                                class="{{$report['read'] == 0 ? 'table_danger' : ($report['read'] == 1 ? 'table_success' : '')}}">
                                                {{$report['report_text']}}
                                            </td>
                                            <td class="{{$report['read'] == 0 ? 'table_danger' : ($report['read'] == 1 ? 'table_success' : '')}}">
                                                {{$report['jalali_date']}}
                                            </td>
                                            <td class="{{$report['read'] == 0 ? 'table_danger' : ($report['read'] == 1 ? 'table_success' : '')}}">
                                                @if($report['read'] == 0)
                                                    <a onclick="change_order_status_report({{$report['id']}})"
                                                       class="btn btn-danger small" disabled="disabled">
                                                        <i class="fa fa-check-square"></i>
                                                        بررسی نشده
                                                    </a>
                                                @elseif($report['read'] == 1)
                                                    <a class="btn btn-success small">
                                                        <i class="fa fa-check-square-o"></i>
                                                        بررسی شده
                                                    </a>

                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
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
                    <p class="p_modal_css">
                        <label class="text-left">گزارش</label>
                    </p>
                    <textarea class="form-control w-100" name="order_status_report"></textarea>
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

