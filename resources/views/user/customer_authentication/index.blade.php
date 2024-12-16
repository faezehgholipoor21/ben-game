@extends('layouts.user_layout')

@section('title')
    سایت بازی | احراز هویت مشتری
@endsection

@section('custom-css')
    <style>
        .title_css {
            font-size: 13px;
        }

        .card-input {
            font-family: Arial, sans-serif;
            font-size: 16px;
            letter-spacing: 4px;
            width: 100%;
            /*max-width: 300px;*/
            padding: 8px;
            box-sizing: border-box;
            text-align: center;
            direction: ltr;
        }
        .auth_img{
            width: 300px;
            height: 200px;
        }

    </style>
@endsection

@section('custom-js')
    <script>
        $(".dropify").dropify();

        function formatCardNumber(event) {
            const input = event.target;
            let value = input.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters

            // Limit the input to 16 digits
            if (value.length > 16) {
                value = value.slice(0, 16);
            }

            // Insert dashes every 4 digits
            const formattedValue = value.match(/.{1,4}/g)?.join(' ') || '';

            input.value = formattedValue;
        }
    </script>
@endsection

@section('content')
    <div class="user-card">
        <h4 class="user-card-title">احراز هویت</h4>

            <div class="row">
                <div class="col-12">
                    @if($user_info['user_status_id'] === 3)
                        <form action="{{route('user.authentication_store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <p class="alert alert-danger text-center">
                                        شما هنوز احراز هویت نشده اید ، لطفا اطلاعات را وارد نمایید . تا در اسرع وقت برای احراز
                                        هویت
                                        شما
                                        اقدام شود.
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="title_css">
                                        عکس روی کارت ملی صاحب حساب بانکی
                                        <span class="text-danger">
                        (لطفا عکس با کیفیت آپلود نمایید)
                    </span>
                                    </label>
                                    <input type="file" class="form-control dropify" name="national_card_image">
                                </div>
                                <input type="hidden" name="user_id" value="{{$user_info['id']}}">
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="title_css">
                                        عکس کارت بانکی صاحب حساب بانکی
                                        <span class="text-danger">
                         (لطفا رمز و cvv2 را مخفی نمایید)
                    </span>
                                    </label>
                                    <input type="file" class="form-control dropify" name="bank_card_image">
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="title_css">
                                        نام صاحب حساب
                                    </label>
                                    <input type="text" class="form-control" name="account_bank_name">
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="title_css">
                                        نام خانوادگی صاحب حساب
                                    </label>
                                    <input type="text" class="form-control" name="account_bank_family">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="title_css">
                                        شماره کارت بانکی
                                    </label>
                                    <input type="text" class="form-control card-input" name="bank_card_number"
                                           id="bank_card_number" maxlength="19"
                                           placeholder="---- ---- ---- ----" oninput="formatCardNumber(event)">
                                </div>
                                <div class="col-12 text-right">
                                    <button type="submit" class="theme-btn">
                                        <i class="fa fa-save"></i>
                                        ثبت مشخصات
                                    </button>
                                </div>
                            </div>

                        </form>

                    @elseif($user_info['user_status_id'] === 1)
                        <div class="row">
                            <div class="col-12">
                                <p class="alert alert-warning">
                                    احراز هویت شما در دست بررسی میباشد ، به محض احراز به شما اطلاع داده می شود.
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="alert alert-info">
                                    مشخصاتی که شما برای احراز بارگذاری کردید.
                                </p>
                            </div>
                            <div class="col-12 col-md-6 mb-3 text-center">
                                <p style="text-align: right !important;">
                                    عکس روی کارت ملی صاحب حساب
                                </p>
                                <img src="{{asset($user_bank_info['national_card_image'])}}" class="auth_img">
                            </div>
                            <div class="col-12 col-md-6 mb-3 text-center">
                                <p style="text-align: right !important;">
                                    عکس کارت بانکی صاحب حساب
                                </p>
                                <img src="{{asset($user_bank_info['bank_card_image'])}}" class="auth_img">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <p>
                                    نام و نام خانوادگی صاحب حساب
                                </p>
                                <input type="text" class="form-control" disabled="disabled" value="{{$user_bank_info['account_bank_name'] . ' ' . $user_bank_info['account_bank_family']}}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <p>
                                    شماره کارت صاحب حساب
                                </p>
                                <input type="text" class="form-control" dir="ltr" disabled="disabled" value="{{$user_bank_info['bank_card_number']}}">
                            </div>
                        </div>
                    @else
                        <p class="alert alert-success">
                            شما احراز هویت شدید ، ازینکه از فروشگاه ما خرید میکنید ، ممنونیم.
                        </p>
                    @endif
                </div>
            </div>
    </div>
@endsection

