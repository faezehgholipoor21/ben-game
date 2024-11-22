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
    </style>
@endsection

@section('custom-js')
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    <script>
        let my_fullscreen_loader = $("#my_full_screen_loader");

        function remove_comma(number) {
            return parseInt(number.replace(',', ''));
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
            var rgx = /(\d+)(\d{3})/;
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
            var cookieName = name + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var cookieArray = decodedCookie.split(';');

            for (var i = 0; i < cookieArray.length; i++) {
                var cookie = cookieArray[i];
                while (cookie.charAt(0) === ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(cookieName) === 0) {
                    return cookie.substring(cookieName.length, cookie.length);
                }
            }

            return null;
        }

        function updateCart(count, product_id) {
            my_fullscreen_loader.slideDown();

            var cart_cookie = getCookie('cart');
            var show_total_price_with_tax = $('.show_total_price_with_tax');
            var show_total_price_without_tax = $('.show_total_price_without_tax');
            var show_total_price = $('.show_total_price');
            var show_tax_price = $('.show_tax_price');
            var tbl_total_price = $('.tbl_total_price');
            var cart_table_tr = $('.cart_table').find('tr');
            let tr_price = 0;
            let tr_count = 0;

            for (let i = 1; i < cart_table_tr.length - 1; i++) {
                tr_price = remove_comma(cart_table_tr.eq(i).find('.tr_price').text());
                tr_count = parseInt(cart_table_tr.eq(i).find('.quantity').val());
                console.log(tr_price);
                cart_table_tr.eq(i).find('.tbl_total_price').text(putComma(tr_price * tr_count));

            }

            if (cart_cookie === null) {
                location.reload();
            }

            var data = {
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
                        show_total_price_with_tax.text(response.total_price);
                        show_total_price_without_tax.text(response.pure_total_price);
                        show_tax_price.text(response.tax);
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
                if (quantity_value + 1 >= parseInt(max)) {
                    $(tag).val(parseInt(max));
                    show_sweetalert_msg(' موجودی انبار  ' + max + ' عدد است ', 'error')
                } else {
                    quantity.val(quantity_value + 1)
                }
            }

            if (parseInt(quantity.val()) !== quantity_value) {
                updateCart(quantity.val(), product_id)
            }
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
            @if(!empty($cart))
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
                                            <th>قیمت (ریال)</th>
                                            <th>مقدار</th>
                                            <th>قیمت کل (ریال)</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $total_price = 0 ;
                                        @endphp
                                        @foreach($cart as $item)
                                            @php
                                                $price = $item->product->product_price ;
                                                $count = $item['count'] ;
                                                $inventory = $item->product->inventory ;
                                                $total_price += $price * $count ;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="shop-cart-img">
                                                        <a href="#">
                                                            <img
                                                                src="{{\App\Helper\GetProductMainImage::get_product_main_image($item['product_id'])}}"
                                                                alt>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="shop-cart-content">
                                                        <h5 class="shop-cart-name">
                                                            <a href="#">
                                                                {{$item->product->product_name}}
                                                            </a>
                                                        </h5>
                                                        {{--                                                    <div class="shop-cart-info">--}}
                                                        {{--                                                        <p><span>نوع:</span>هدفون</p>--}}
                                                        {{--                                                        <p><span>رنگ:</span>سیاه</p>--}}
                                                        {{--                                                    </div>--}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="shop-cart-price">
                                                        <span class="tr_price">{{number_format($price)}}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="shop-cart-qty" dir="ltr">
                                                        <button onclick="changeCartQuantity(this,'-')"
                                                                class="minus-btn">
                                                            <i class="fal fa-minus"></i>
                                                        </button>
                                                        <input type="hidden" class="product_id"
                                                               value="{{$item['product_id']}}">
                                                        <input class="quantity" type="text"
                                                               value="{{$count}}" max="{{$inventory}}">
                                                        <button onclick="changeCartQuantity(this,'+', '{{$inventory}}')"
                                                                class="plus-btn">
                                                            <i class="fal fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="shop-cart-subtotal">
                                                        <span
                                                            class="tbl_total_price">{{number_format($count * $price)}}</span>
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
                                            <a href="#" class="theme-btn"> ادامه خرید <span
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
                                        <strong>قیمت کل :</strong>
                                        <span class="show_total_price_without_tax">
                                            {{number_format($total_price)}} ریال
                                        </span>
                                    </li>
                                    <li>
                                        <strong>تخفیف:</strong>
                                        <span>5.00 ریال</span>
                                    </li>
                                    {{--                                <li><strong>ارسال:</strong> <span>رایگان</span></li>--}}
                                    <li>
                                        <strong>مالیات:</strong>
                                        <span class="show_tax_price">
                                            {{@number_format($total_price * 0.1)}} ریال
                                        </span>
                                    </li>
                                    <li class="shop-cart-total">
                                        <strong>مجموع:</strong>
                                        <span class="show_total_price_with_tax">
                                            {{@number_format(($total_price) + $total_price * 0.1)}} ریال
                                        </span>
                                    </li>
                                </ul>
                                <div class="text-end mt-40">
                                    <a href="#" class="theme-btn">
                                        اکنون تسویه حساب کنید
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
        </div>
    </div>


    <div class="newsletter-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="newsletter-content">
                        <h3>دریافت کوپن تخفیف <span>20%</span></h3>
                        <p>با مشترک شدن در خبرنامه ما</p>
                        <div class="subscribe-form">
                            <form action="#">
                                <input type="email" class="form-control" placeholder="آدرس ایمیل معتبر شما">
                                <button class="theme-btn" type="submit">
                                    اشتراک <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="newsletter-img-1">--}}
        {{--            <img src="assets/img/newsletter/01.png" alt>--}}
        {{--        </div>--}}
        {{--        <div class="newsletter-img-2">--}}
        {{--            <img src="assets/img/newsletter/02.png" alt>--}}
        {{--        </div>--}}
    </div>
@endsection
