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

        .copy_btn {
            background-color: #c3bfbf;
            border-radius: 6px;
            border: 1px solid #7e7e7e;
            cursor: pointer;
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
    </style>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {
            $('#expert_select').on('change', function () {
                alert('this');

                var expert_id = $(this).val();  // مقدار جدید که انتخاب شده
                var order_id = '{{$order_info['id']}}';  // ID سفارش از متغیر PHP

                // ارسال درخواست AJAX برای به‌روزرسانی مقدار review_expert_id در جدول users
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/panel/update_review_expert', // مسیر آپدیت رو تنظیم کنید
                    type: 'POST',
                    data: {
                        order_id: order_id,
                        review_expert_id: expert_id
                    },
                    success: function (response) {
                        if (response.success) {
                            show_sweetalert_success('کارشناس با موفقیت تغییر کرد!');
                        } else {
                            show_sweetalert_msg(response.message, 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        show_sweetalert_msg('خطای سمت سرور رخ داده است، لطفا دوباره تلاش کنید', 'error');
                    }
                });
            });
        });

        const question_modal = $("#QuestionModal");

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

        function change_order_status_report(order_status_report_id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route("admin.change_order_status_report")}}',
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
                                {{$jalali_date_order}}
                            </td>

                            <td>
                                {{@number_format($order_info['total_price'])}}
                            </td>

                            <td>
                                <select class="form-control" id="expert_select">
                                    @foreach($expert_list as $expert)
                                        <option value="{{$expert['id']}}"
                                                @if($order_info['review_expert_id'] == $expert['id']) selected="selected" @endif>
                                            {{$expert['first_name'] .' '. $expert['last_name']}}
                                        </option>
                                    @endforeach
                                </select>
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
                            <td>جزئیات اکانت محصول</td>
                            <td>قیمت واحد</td>
                            <td>تعداد</td>
                            <td>جمع</td>
                        </tr>
                        @foreach($order_detail_infos as $detail)
                            <tr>
                                <td>
                                    <img class="w-125px product_img"
                                         src="{{asset($detail['product_image'])}}">
                                </td>

                                <td>
                                    <p>
                                        {{$detail['product_name']}}
                                    </p>

                                    <p>
                                        <b> دسته:</b>
                                        <span class="badge badge-info">
                                        {{$detail['product_cat_title']}}
                                        </span>
                                    </p>

                                    <p>
                                        <b>اکانت:</b>
                                        <span class="badge badge-success">
                                        {{$detail['game_account_title']}}
                                        </span>
                                    </p>
                                </td>
                                <td>
                                    @foreach($detail['user_account_detail_info'] as $index => $user_acc)
                                        <p class="text-left mb-3" style="direction: rtl">
                                                    <span class="title_field">
                                                        {{$user_acc['fieldInfo']['label'] . ' ' . ':'}}
                                                    </span>
                                            <span class="value_field">
                                                        {{$user_acc['value']}}
                                                    </span>
                                            <button class="copy_btn" onclick="copyToClipboard(this)">📋</button>
                                        </p>
                                    @endforeach
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

        <div class="row clearfix mt-4">
            <div class="col-12">
                <p class="fw-bold">گزارشات</p>
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
                    <p class="p_modal_css">
                        <label class="text-left">گزارش</label>
                        <textarea class="form-control w-100" name="order_status_report"></textarea>
                    </p>

                    <button type="submit" class="btn btn-success">بله مطمئنم</button>
                    <button onclick="close_model()" type="button" class="btn btn-danger" data-dismiss="modal">خیر
                    </button>
                </form>

            </div>

        </div>

    </div>
@endsection

