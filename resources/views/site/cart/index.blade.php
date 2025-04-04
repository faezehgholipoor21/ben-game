@extends('layouts.site_layout')

@section('title')
    سایت بازی | سبد خرید
@endsection

@section('custom-css')
    <style>
        #my_full_screen_loader {
            width: 100%;
            height: 100%;
            position: fixed;
            right: 0;
            top: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
            display: none;
        }

        #my_full_screen_loader img {
            width: 200px;
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            left: 0;
            margin: auto;
        }
        .help_text{
            font-size: 13px;
            color: red;
        }
    </style>
@endsection

@section('custom-js')
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    <script>
        let my_fullscreen_loader = $("#my_full_screen_loader");

        function remove_comma(number) {
            return parseFloat(number.replace(/,/g, ''));
        }

        function putComma(Number) {
            Number += '';
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            x = Number.split('.');
            y = x[0];
            z = x.length > 1 ? '.' + x[1] : '';
            let rgx = /(\d+)(\d{3})/;
            while (rgx.test(y))
                y = y.replace(rgx, '$1' + ',' + '$2');
            return y + z;
        }

        function show_sweetalert_msg(msg, icon) {
            new swal({
                title: msg,
                toast: true,
                icon: icon,
                showConfirmButton: false,
                position: 'top',
                timerProgressBar: true,
                timer: 3500
            });
        }

        function getCookie(name) {
            let cookieName = name + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let cookieArray = decodedCookie.split(';');

            for (let i = 0; i < cookieArray.length; i++) {
                let cookie = cookieArray[i];
                while (cookie.charAt(0) === ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(cookieName) === 0) {
                    return cookie.substring(cookieName.length, cookie.length);
                }
            }

            return null;
        }

        function updateCart(count, product_id, tag) {
            my_fullscreen_loader.slideDown();

            let cart_cookie = getCookie('cart_id');
            let show_total_price_wit_tax = $('.show_total_price_with_tax');
            let show_total_price_without_tax = $('.show_total_price_without_tax');
            let tbl_total_price = $('.tbl_total_price');
            let show_tax_price = $('.show_tax_price');
            let cart_table_tr = $('.cart_table').find('tr');
            let tr_price = 0;
            let tr_count = 0;


            for (let i = 1; i <= cart_table_tr.length - 1; i++) {
                tr_price = remove_comma(cart_table_tr.eq(i).find('.tbl_price').text());
                tr_count = parseInt(cart_table_tr.eq(i).find('.quantity').val());
                cart_table_tr.eq(i).find('.tbl_total_price').text(tr_price * tr_count);

                console.log('cart_table_tr = ' + cart_table_tr + 'tr_count = ' + tr_count + 'tr_price=' + tr_price + 'tbl_price == ' + cart_table_tr.eq(i).find('.tbl_price').text());
            }

            if (cart_cookie === null) {
                location.reload();
            }

            let data = {
                product_id: product_id ?? '0',
                count: count.toString(),
                cookie: cart_cookie.toString(),
            };

            $.ajax({
                url: '{{route("api.updateCart")}}',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(data),
                headers: {
                    "Accept": "application/json"
                },
                success: function (response) {
                    if (response.error) {
                        show_sweetalert_msg(response.message, 'error');
                        setTimeout(() => {
                            // location.reload();
                        }, 2000);
                    } else {
                        show_sweetalert_msg(response.message, 'success');

                        show_total_price_wit_tax.text(response.total_price);
                        show_total_price_without_tax.text(response.pure_total_price);
                        show_tax_price.text(response.tax);

                        let price = remove_comma($(tag).parents('tr').find('.tr_price').text())
                        //
                        // $(tag).parents('tr').find('.tbl_total_price').text(putComma(price * parseInt(count)))

                        my_fullscreen_loader.slideUp();
                    }
                },
                error: function (xhr, status, error) {
                    show_sweetalert_msg('خطای سمت سرور رخ داده است، لطفا دوباره تلاش کنید', 'error');
                }
            });
        }

        function changeCartQuantity(tag, sign, max) {
            let quantity = $(tag).parents('.shop-cart-qty').find('.quantity');
            let product_id = $(tag).parents('.shop-cart-qty').find('.product_id').val();
            let quantity_value = parseInt(quantity.val());

            if (sign === '-') {
                if (quantity_value > 1) {
                    quantity.val(quantity_value - 1)
                }
            } else {
                if (quantity_value + 1 > parseInt(max)) {

                    $(tag).val(parseInt(max));
                    show_sweetalert_msg(' موجودی انبار  ' + max + ' عدد است ', 'error')
                } else {
                    quantity.val(quantity_value + 1)
                }
            }

            if (parseInt(quantity.val()) !== quantity_value) {

                updateCart(quantity.val(), product_id, tag)
            }
        }

        $(document).ready(function () {
            $(".minus-btn").click(function () {
                changeCartQuantity(this, "-", 100); // مقدار 100 به عنوان حداکثر تعداد فرضی
            });

            $(".plus-btn").click(function () {
                let max = $(this).data("max");
                console.log(max);
                changeCartQuantity(this, "+", max);
            });
        });

        function delete_cart() {

        }

    </script>

@endsection

@section('content')
    <div id="my_full_screen_loader">
        <img src="{{asset('site/assets/img/my_circlur_loader.svg')}}">
    </div>
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">سبد خرید</h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{route('site.home')}}" target="_blank">
                            <i class="far fa-home"></i>
                            صفحه اصلی
                        </a>
                    </li>
                    <li class="active">مشاهده سبد خرید</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="shop-cart py-100">
        <div class="container">
            @if($cartModel)
                @if(count($cartModel->getProducts())!=0)
                    <div class="shop-cart-wrap">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="cart-table">
                                    <div class="table-responsive">
                                        <table class="table cart_table">
                                            <thead>
                                            <tr>
                                                <th>تصویر</th>
                                                <th>نام محصول</th>
                                                <th>مقدار</th>
                                                <th>قیمت واحد (تومان)</th>
                                                <th>قیمت کل (تومان)</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $total_price = 0 ;
                                            @endphp
                                            @foreach($cartModel->getProducts() as $item)
                                                <tr>
                                                    <td>
                                                        <div class="shop-cart-img">
                                                            <a href="#">
                                                                <img
                                                                    src="{{\App\Helper\GetProductMainImage::get_product_main_image($item['id'])}}"
                                                                    alt>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="shop-cart-content">
                                                            <h5 class="shop-cart-name">
                                                                <a href="#">
                                                                    {{$item['name']}}
                                                                </a>
                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="shop-cart-qty" dir="ltr">
                                                            <input type="hidden" class="product_id"
                                                                   value="{{$item['id']}}">
                                                            <button class="minus-btn"><i class="fal fa-minus"></i>
                                                            </button>
                                                            <input class="quantity" type="text"
                                                                   value="{{$item['quantity']}}" disabled>
                                                            <button class="plus-btn" data-max="{{$item['inventory']}}">
                                                                <i class="fal fa-plus"></i></button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="shop-cart-subtotal">
                                                        <span
                                                            class="tbl_price">{{number_format($item['main_price'])}}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="shop-cart-subtotal">
                                                        <span
                                                            class="tbl_total_price">{{number_format($item['final_price'])}}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="shop-cart-remove">
                                                            <i class="far fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="shop-cart-footer">
                                    <div class="row">
                                        <div class="col-md-7 col-lg-6">
                                            <div class="shop-cart-coupon">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="کد کوپن شما">
                                                    <button class="theme-btn" type="submit">اعمال کوپن</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-6">
                                            <div class="shop-cart-btn text-md-end">
                                                <a href="{{route('site.products')}}" class="theme-btn"> ادامه خرید <span
                                                        class="fas fa-arrow-left"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="shop-cart-summary">
                                    <h5>خلاصه سبد خرید</h5>
                                    <ul>
                                        <li>
                                            <strong> قیمت کل :</strong>
                                            <span class="show_total_price_without_tax">
                                            {{number_format($main_total_price)}} تومان
                                        </span>
                                        </li>
                                        <li class="help_text">
                                            قیمت کل با احتساب تخفیف و بدون احتساب مالیات است
                                        </li>
                                        <li>
                                            <strong>مالیات:</strong>
                                            <span class="show_tax_price">
                                            {{@number_format($tax_price)}} تومان
                                        </span>
                                        </li>
                                        <li>
                                            <strong>تخفیف باشگاه:</strong>
                                            <span>
                                            {{$club_percentage}} درصد
                                        </span>
                                        </li>
                                        @if($main_discount)
                                        <li>
                                            <strong>تخفیف :</strong>
                                            <span>
                                                {{$main_discount}} تومان
                                            </span>
                                        </li>
                                        @endif
                                        <li class="shop-cart-total">
                                            <strong>مجموع:</strong>
                                            <span class="show_total_price_with_tax">
                                            {{@number_format($final_price_after_club)}} تومان
                                        </span>
                                        </li>
                                    </ul>
                                    <div class="text-end mt-40">
                                        <a href="{{route('site.checkout')}}" class="theme-btn w-100 d-block">
                                            تسویه حساب
                                            <i class="fas fa-arrow-left-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            <p class="alert alert-danger mb-0">
                                <i class="far fa-shopping-bag"></i>
                                سبد خرید شما خالی می باشد.
                                <a href="{{route('site.products')}}" class="btn btn-warning p-2">
                                    برو به فروشگاه
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                @endif
            @else
                <div class="row">
                    <div class="col-12">
                        <p class="alert alert-danger mb-0">
                            <i class="far fa-shopping-bag"></i>
                            سبد خرید شما خالی می باشد.
                            <a href="{{route('site.products')}}" class="btn btn-warning p-2">
                                برو به فروشگاه
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </p>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
